<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Status
 * @package Panda\MikBill\CKassa\BiSysApi
 * Заголовки ответов (HTTP-статус)
 */
class Status
{
    /**
     * 200 OK
     */
    public const OK_200 = 'HTTP/1.0 200 OK';

    /**
     * 500 Internal
     */
    public const INTERNAL_500 = 'HTTP/1.0 500 Internal';
}
