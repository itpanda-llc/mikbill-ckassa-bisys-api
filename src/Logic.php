<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

declare(strict_types=1);

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Logic
 * @package Panda\MikBill\CKassa\BiSysApi
 * Проверка запроса и формирование ответа
 */
class Logic
{
    /**
     * @var string|null Параметры запроса
     */
    private $params;

    /**
     * @var string|null Тип запроса
     */
    private $act;

    /**
     * @var string|null Аккаунт
     */
    private $account;

    /**
     * @var string|null Размер платежа
     */
    private $payAmount;

    /**
     * @var string|null Номер платежа
     */
    private $payId;

    /**
     * @var string|null Дата платежа
     */
    private $payDate;

    /**
     * @var string|null Подпись
     */
    private $sign;

    /**
     * @var string Заголовок (HTTP-статус)
     */
    public $status = Status::OK_200;

    /**
     * @var string|null Контент
     */
    public $content;

    public function __construct()
    {
        $query = (!empty($_POST[Param::PARAMS]))
            ? $_POST[Param::PARAMS]
            : null;

        if (!is_null($query)) {
            $this->params = Param::get($query, Param::PARAMS);
            $this->act = Param::get($query, Param::ACT);
            $this->account = Param::get($query, Param::ACCOUNT);
            $this->payAmount = Param::get($query, Param::PAY_AMOUNT);
            $this->payId = Param::get($query, Param::PAY_ID);
            $this->payDate = Param::get($query, Param::PAY_DATE);
            $this->sign = Param::get($query, Param::SIGN);
        }
    }

    public function run(): void
    {
        if ((is_null($this->params)) || (is_null($this->sign))) {
            $this->content = Response::getError(Code::PARAM_ERROR,
                Text::PARAM_ERROR);

            return;
        }

        if (!Sign::check($this->params, $this->sign)) {
            $this->content = Response::getError(Code::SIGN_ERROR,
                Text::SIGN_ERROR);

            return;
        }

        foreach (explode(",", $_ENV['NETWORK_LIST']) as $v) {
            if (Network::check($_SERVER['REMOTE_ADDR'], $v)) {
                $this->content = null;

                break;
            }

            $this->content = Response::getError(Code::ADDRESS_ERROR,
                Text::ADDRESS_ERROR,
                $this->sign);
        }

        if (!is_null($this->content)) return;

        try {
            $acts = (new \ReflectionClass(Act::class))->getConstants();
        } catch (\ReflectionException $e) {
            throw new Exception\DebugException($e->getMessage());
        }

        if (!in_array($this->act, $acts, true)) {
            $this->content = Response::getError(Code::PARAM_ERROR,
                Text::PARAM_ERROR,
                $this->sign);

            return;
        }

        if ($this->act === Act::CHECK) {
            if (is_null($this->account)) {
                $this->content = Response::getError(Code::PARAM_ERROR,
                    Text::PARAM_ERROR,
                    $this->sign);

                return;
            }

            $this->content =
                (!is_null($account = Query::getAccount($this->account)))
                    ? Response::getAccount($account, $this->sign)
                    : Response::getError(Code::SEARCH_ACCOUNT_ERROR,
                        Text::SEARCH_ACCOUNT_ERROR,
                        $this->sign);

            return;
        }

        if ($this->act === Act::PAYMENT) {
            if ((is_null($this->account)) || (is_null($this->payAmount))
                || (is_null($this->payId)) || (is_null($this->payDate)))
            {
                $this->content = Response::getError(Code::PARAM_ERROR,
                    Text::PARAM_ERROR,
                    $this->sign);

                return;
            }

            if (!is_null($payment = Query::getPayment($this->payId))) {
                $this->content = (($payment[Field::ACCOUNT] === $this->account)
                    && ($payment[Field::PAY_AMOUNT] === $this->payAmount))
                    ? Response::getPayment($payment,
                        Code::DUPLICATE_PAY_ERROR,
                        Text::DUPLICATE_PAY_ERROR,
                        $this->sign)
                    : Response::getError(Code::PAY_AGENT_ERROR,
                        Text::PAY_AGENT_ERROR,
                        $this->sign);

                return;
            }

            if (is_null(Query::getAccount($this->account))) {
                $this->content = Response::getError(Code::SEARCH_ACCOUNT_ERROR,
                    Text::SEARCH_ACCOUNT_ERROR,
                    $this->sign);

                return;
            }

            if ((!Query::checkCategory()) && (!Query::addCategory())) {
                $this->content = Response::getError(Code::TEMP_ERROR,
                    Text::TEMP_ERROR,
                    $this->sign);

                return;
            }

            Transaction::begin();

            if ((!Query::addPayment($this->account, $this->payAmount, $this->payId))
                || (!Query::setPayment($this->payId)))
            {
                Transaction::rollBack();

                $this->content = Response::getError(Code::TEMP_ERROR,
                    Text::TEMP_ERROR,
                    $this->sign);

                return;
            }

            Transaction::commit();

            if (!is_null($payment = Query::getPayment($this->payId))) {
                $this->content = Response::getPayment($payment,
                    Code::DEFAULT,
                    Text::ACCEPT_PAY_OK,
                    $this->sign);

                return;
            }
        }

        if ($this->act === Act::STATUS) {
            if (is_null($this->payId)) {
                $this->content = Response::getError(Code::PARAM_ERROR,
                    Text::PARAM_ERROR,
                    $this->sign);

                return;
            }

            $this->content =
                (!is_null($payment = Query::getPayment($this->payId)))
                    ? Response::getPayment($payment,
                        Process::getCode($payment[Field::STATUS]),
                        Process::getStatus($payment[Field::STATUS]),
                        $this->sign)
                    : Response::getError(Code::PAY_PARAM_ERROR,
                        Text::SEARCH_PAY_ID_ERROR,
                        $this->sign);

            return;
        }
    }
}
