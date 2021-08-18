<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

declare(strict_types=1);

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Response
 * @package Panda\MikBill\CKassa\BiSysApi
 * Формирование ответа
 */
class Response
{
    /**
     * @param int $errCode Код ошибки
     * @param string $errText Текст ошибки
     * @param string|null $sign Подпись запроса
     * @return string Контент
     */
    public static function getError(int $errCode,
                                    string $errText,
                                    string $sign = null): string
    {
        $paramsSxe = ($sxe = self::getXmlElement())
            ->addChild(Tag::PARAMS);

        $paramsSxe->addChild(Tag::ERR_CODE, (string) $errCode);
        $paramsSxe->addChild(Tag::ERR_TEXT, $errText);

        if (!is_null($sign)) {
            $params = $paramsSxe->{Tag::ERR_CODE}->asXML();
            $params .= $paramsSxe->{Tag::ERR_TEXT}->asXML();

            $sxe->addChild(Tag::SIGN, Sign::get($params, $sign));
        }

        return $sxe->asXML();
    }

    /**
     * @param array $account Аккаунт
     * @param string $sign Подпись запроса
     * @return string Контент
     */
    public static function getAccount(array $account,
                                      string $sign): string
    {
        $paramsSxe = ($sxe = self::getXmlElement())
            ->addChild(Tag::PARAMS);

        $params = $paramsSxe
            ->addChild(Tag::ERR_CODE, (string) Code::DEFAULT)
            ->asXML();
        $params .= $paramsSxe
            ->addChild(Tag::ERR_TEXT, Text::SEARCH_ACCOUNT_OK)
            ->asXML();
        $params .= $paramsSxe
            ->addChild(Tag::CLIENT_NAME, $account[Field::CLIENT_NAME])
            ->asXML();
        $params .= $paramsSxe
            ->addChild(Tag::BALANCE, $account[Field::BALANCE])
            ->asXML();

        $sxe->addChild(Tag::SIGN, Sign::get($params, $sign));

        return $sxe->asXML();
    }

    /**
     * @param array $payment Платеж
     * @param int|null $errCode Код ошибки
     * @param string|null $errText Текст ошибки
     * @param string $sign Подпись запроса
     * @return string Контент
     */
    public static function getPayment(array $payment,
                                      int $errCode,
                                      string $errText,
                                      string $sign): string
    {
        $paramsSxe = ($sxe = self::getXmlElement())
            ->addChild(Tag::PARAMS);

        $params = $paramsSxe
            ->addChild(Tag::ERR_CODE, (string) $errCode)
            ->asXML();
        $params .= $paramsSxe
            ->addChild(Tag::ERR_TEXT, $errText)
            ->asXML();
        $params .= $paramsSxe
            ->addChild(Tag::REG_ID, $payment[Field::REG_ID])
            ->asXML();
        $params .= $paramsSxe
            ->addChild(Tag::REG_DATE, $payment[Field::REG_DATE])
            ->asXML();

        $sxe->addChild(Tag::SIGN, Sign::get($params, $sign));

        return $sxe->asXML();
    }

    /**
     * @return \SimpleXMLElement Контент
     */
    private static function getXmlElement(): \SimpleXMLElement
    {
        try {
            return new \SimpleXMLElement(
                sprintf("<?xml version=\"1.0\" encoding=\"%s\"?><%s/>",
                    $_ENV['RESPONSE_CHARSET'],
                    Tag::RESPONSE));
        } catch (\Exception $e) {
            throw new Exception\DebugException($e->getMessage());
        }
    }
}
