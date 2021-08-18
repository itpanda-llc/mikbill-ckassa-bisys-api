<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Act
 * @package Panda\MikBill\CKassa\BiSysApi
 * Типы запросов
 */
class Act
{
    /**
     * Проверка параметров платежа
     */
    public const CHECK = '1';

    /**
     * Проведение платежа
     */
    public const PAYMENT = '2';

    /**
     * Проверка статуса платежа
     */
    public const STATUS = '4';
}
