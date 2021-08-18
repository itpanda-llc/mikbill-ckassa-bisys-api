<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Holder
 * @package Panda\MikBill\CKassa\BiSysApi
 * Наименования параметров (SQL-запросы)
 */
class Holder
{
    /**
     * Идентификатор плательщика
     */
    public const ACCOUNT = ':account';

    /**
     * Номер категории платежа
     */
    public const CATEGORY_ID = ':categoryId';

    /**
     * Номер категории платежа
     */
    public const CATEGORY_NAME = ':categoryName';

    /**
     * Сумма платежа
     */
    public const PAY_AMOUNT = ':payAmount';

    /**
     * Уникальный номер платежа
     */
    public const PAY_ID = ':payId';

    /**
     * Комментарий платежа
     */
    public const PAYMENT_COMMENT = ':paymentComment';
}
