<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Text
 * @package Panda\MikBill\CKassa\BiSysApi
 * Сообщения ответа
 */
class Text
{
    /**
     * Код: 0
     */
    public const SEARCH_ACCOUNT_OK = 'Клиент найден';

    /**
     * Код: 0
     */
    public const ACCEPT_PAY_OK = 'Платеж принят';

    /**
     * Код: 0
     */
    public const CREDIT_PAY_OK = 'Платеж обработан';

    /**
     * Код: 1
     */
    public const DUPLICATE_PAY_ERROR = 'Платеж уже был проведен';

    /**
     * Код: 2
     */
    public const PROCESS_PAY_ERROR = 'Платеж ожидает обработки у оператора';

    /**
     * Код: 10
     */
    public const ADDRESS_ERROR = 'Запрос выполнен с неразрешенного адреса';

    /**
     * Код: 11
     */
    public const PARAM_ERROR = 'Указаны не все необходимые параметры';

    /**
     * Код: 13
     */
    public const SIGN_ERROR = 'Неверная цифровая подпись';

    /**
     * Код: 20
     */
    public const SEARCH_ACCOUNT_ERROR = 'Указанный номер счета отсутствует';

    /**
     * Код: 29
     */
    public const SEARCH_PAY_ID_ERROR = 'Указанный номер платежа отсутствует';

    /**
     * Код: 30
     */
    public const PAY_AGENT_ERROR = 'Был другой платеж с указанным номером';

    /**
     * Код: 90
     */
    public const TEMP_ERROR = 'Временная техническая ошибка';
}
