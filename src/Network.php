<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

declare(strict_types=1);

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Network
 * @package Panda\MikBill\CKassa\BiSysApi
 * Разрешенные адреса
 */
class Network
{
    /**
     * @param string $address Адрес
     * @param string $network Сеть
     * @return bool Результат принадлежности к сети
     */
    public static function check(string $address,
                                 string $network): bool
    {
        list($net, $mask) = explode('/', $network);
        $mask = pow(2, (32 - (int) $mask)) - 1;

        return (!((ip2long($address) ^ (ip2long($net) & ~$mask))
            & ~$mask));
    }
}
