<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Code
 * @package Panda\MikBill\CKassa\BiSysApi
 * Код ответа
 */
class Code
{
    /**
     * Успешное выполнение операции
     */
    public const DEFAULT = 0;

    /**
     * Платеж уже был проведен
     */
    public const DUPLICATE_PAY_ERROR = 1;

    /**
     * Платеж ожидает обработки у оператора
     */
    public const PROCESS_PAY_ERROR = 2;

    /**
     * Запрос выполнен с неразрешенного адреса
     */
    public const ADDRESS_ERROR = 10;

    /**
     * Указаны не все необходимые параметры
     */
    public const PARAM_ERROR = 11;

    /**
     * Неверная цифровая подпись
     */
    public const SIGN_ERROR = 13;

    /**
     * Указанный номер счета отсутствует
     */
    public const SEARCH_ACCOUNT_ERROR = 20;

    /**
     * Неверные параметры платежа
     */
    public const PAY_PARAM_ERROR = 29;

    /**
     * Был другой платеж с указанным номером
     */
    public const PAY_AGENT_ERROR = 30;

    /**
     * Временная техническая ошибка
     */
    public const TEMP_ERROR = 90;

    /**
     * Прочие ошибки
     */
    public const OTHER_ERROR = 99;
}
