<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

declare(strict_types=1);

require_once '/var/mikbill/__ext/vendor/autoload.php';

use Panda\MikBill\CKassa\BiSysApi;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(
    '/var/mikbill/__ext/vendor/itpanda-llc/mikbill-ckassa-bisys-api/');

try {
    $dotenv->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    header(BiSysApi\Status::INTERNAL_500);
    print_r(BiSysApi\Response::getError(BiSysApi\Code::OTHER_ERROR,
        $e->getMessage()));
}

header(sprintf("%s; charset=%s",
    BiSysApi\Content::TEXT_XML,
    $_ENV['RESPONSE_CHARSET']));

$logic = new BiSysApi\Logic;

try {
    $logic->run();

    header($logic->status);
    print_r($logic->content);
} catch (BiSysApi\Exception\SystemException
    | BiSysApi\Exception\DebugException $e) {
    header(BiSysApi\Status::INTERNAL_500);
    print_r(BiSysApi\Response::getError(BiSysApi\Code::OTHER_ERROR,
        $e->getMessage()));
}
