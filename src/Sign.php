<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

declare(strict_types=1);

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Sign
 * @package Panda\MikBill\CKassa\BiSysApi
 * Параметры подписи
 */
class Sign
{
    /**
     *
     * @param string $params Параметры запроса
     * @param string $sign Подпись запроса
     * @return bool Подпись запроса
     */
    public static function check(string $params,
                                 string $sign): bool
    {
        return (mb_strtoupper($sign,
                Charset::UTF_8) === self::get($params));
    }

    /**
     * @param string ...$strings Строки
     * @return string Подпись запроса
     */
    public static function get(string ...$strings): string
    {
        $strings[] = $_ENV['SIGN_PASSWORD'];

        return mb_strtoupper(md5(implode($strings)), Charset::UTF_8);
    }
}
