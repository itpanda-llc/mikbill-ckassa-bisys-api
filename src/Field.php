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
class Field
{
    /**
     * Имя клиента
     */
    public const CLIENT_NAME = 'client_name';

    /**
     * Баланс клиента
     */
    public const BALANCE = 'balance';

    /**
     * Аккаунт
     */
    public const ACCOUNT = 'account';

    /**
     * Размер платежа
     */
    public const PAY_AMOUNT = 'pay_amount';

    /**
     * Идентификатор платежа
     */
    public const REG_ID = 'reg_id';

    /**
     * Дата регистрации платежа
     */
    public const REG_DATE = 'reg_date';

    /**
     * Статус платежа
     */
    public const STATUS = 'status';
}
