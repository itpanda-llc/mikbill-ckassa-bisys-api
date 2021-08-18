<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

declare(strict_types=1);

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Payment
 * @package Panda\MikBill\CKassa\BiSysApi
 * Состояние платежа
 */
class Process
{
    /**
     * Код статуса "Платеж обрабатывается у оператора"
     */
    private const ACCEPT_CODE = Code::PROCESS_PAY_ERROR;

    /**
     * Статус "Платеж обрабатывается у оператора"
     */
    private const ACCEPT_STATUS = Text::PROCESS_PAY_ERROR;

    /**
     * Код статуса "Платеж обрабатан"
     */
    private const CREDIT_CODE = Code::DEFAULT;

    /**
     * Статус "Платеж обрабатан"
     */
    private const CREDIT_STATUS = Text::CREDIT_PAY_OK;

    /**
     * @param string $status Статус платежа
     * @return int Код ошибки
     */
    public static function getCode(string $status): int
    {
        return ($status === '0')
            ? self::ACCEPT_CODE
            : self::CREDIT_CODE;
    }

    /**
     * @param string $status Статус платежа
     * @return string Текст ошибки
     */
    public static function getStatus(string $status): string
    {
        return ($status === '0')
            ? self::ACCEPT_STATUS
            : self::CREDIT_STATUS;
    }
}
