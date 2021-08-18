<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

declare(strict_types=1);

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Param
 * @package Panda\MikBill\CKassa\BiSysApi
 * Параметры запроса
 */
class Param
{
    /**
     * Параметры
     */
    public const PARAMS = 'params';

    /**
     * Тип запроса
     */
    public const ACT = 'act';

    /**
     * Идентификатор плательщика
     */
    public const ACCOUNT = 'account';

    /**
     * Сумма платежа
     */
    public const PAY_AMOUNT = 'pay_amount';

    /**
     * Уникальный номер платежа
     */
    public const PAY_ID = 'pay_id';

    /**
     * Дата платежа
     */
    public const PAY_DATE = 'pay_date';

    /**
     * Подпись запроса
     */
    public const SIGN = 'sign';

    /**
     * @param string $query Строка с параметрами
     * @param string $param Наименование параметра
     * @return string|null Значение параметра
     */
    public static function get(string $query,
                               string $param): ?string
    {
        preg_match(sprintf("|<%s>(.+)</%1\$s|si",
            $param),
            $query,
            $matches);

        return $matches[1] ?? null;
    }
}
