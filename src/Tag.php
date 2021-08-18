<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Tag
 * @package Panda\MikBill\CKassa\BiSysApi
 * Наименование полей в ответе
 */
class Tag
{
    /**
     * Ответ
     */
    public const RESPONSE = 'response';

    /**
     * Параметры
     */
    public const PARAMS = 'params';

    /**
     * Код ошибки
     */
    public const ERR_CODE = 'err_code';

    /**
     * Текст ошибки
     */
    public const ERR_TEXT = 'err_text';

    /**
     * Имя клиента
     */
    public const CLIENT_NAME = 'client_name';

    /**
     * Баланс клиента
     */
    public const BALANCE = 'balance';

    /**
     * Идентификатор платежа
     */
    public const REG_ID = 'reg_id';

    /**
     * Дата регистрации платежа
     */
    public const REG_DATE = 'reg_date';

    /**
     * Подпись запроса
     */
    public const SIGN = 'sign';
}
