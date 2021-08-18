# MikBill-CKassa-BiSys-API

API для интеграции биллинговой системы ["MikBill"](https://mikbill.pro) с платежной системой ["Центральная касса"](https://ckassa.ru)

[![Packagist Downloads](https://img.shields.io/packagist/dt/itpanda-llc/mikbill-ckassa-bisys-api)](https://packagist.org/packages/itpanda-llc/mikbill-ckassa-bisys-api/stats)
![Packagist License](https://img.shields.io/packagist/l/itpanda-llc/mikbill-ckassa-bisys-api)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/itpanda-llc/mikbill-ckassa-bisys-api)

## Ссылки

* [Разработка](https://github.com/itpanda-llc)
* [О проекте (MikBill)](https://mikbill.pro)
* [О проекте (Центральная касса)](https://ckassa.ru)
* [Документация (MikBill)](https://wiki.mikbill.pro)
* [Документация (API Центральная касса)](https://docs.ckassa.ru/doc/shop-api/#spec-1)

## Возможности

* Проверка параметров будущего платежа
* Проведение платежа
* Проверка статуса платежа

## Требования

* PHP >= 7.2
* libxml
* MBString
* PDO
* SimpleXML
* vlucas/phpdotenv ^5.3

## Установка

```shell script
composer require itpanda-llc/mikbill-ckassa-bisys-api
```

## Конфигурация

* Копирование файла [".env.example"](.env.example) в ".env"

```shell script
copy .env.example .env
```

* Указание параметров в файле ".env"
* Указание путей к интерфейсу в файле ["index.php"](examples/www/mikbill/admin/api/ckassa/bisys/index.php), предварительно размещенного в каталоге веб-сервера

## Примеры ответов интерфейса

```xml
<?xml version="1.0" encoding="utf-8"?>
<response>
    <params>
        <err_code>0</err_code>
        <err_text>Клиент найден</err_text>
        <client_name>П****** М***** М*********</client_name>
        <balance>0.00</balance>
    </params>
    <sign>234F1D19DB3529D3264B65AF71C4713A</sign>
</response>
```

```xml
<?xml version="1.0" encoding="utf-8"?>
<response>
    <params>
        <err_code>0</err_code>
        <err_text>Платеж принят</err_text>
        <reg_id>1911229</reg_id>
        <reg_date>2019-11-30T13:41:31</reg_date>
    </params>
    <sign>97A05DF49214366B6092E9C20BD50CDF</sign>
</response>
```

```xml
<?xml version="1.0" encoding="utf-8"?>
<response>
    <params>
        <err_code>1</err_code>
        <err_text>Платеж уже был проведен</err_text>
        <reg_id>1911229</reg_id>
        <reg_date>2019-11-30T13:41:31</reg_date>
    </params>
    <sign>7C575CF89A465A1B3A4C1E6F383E81E7</sign>
</response>
```

```xml
<?xml version="1.0" encoding="utf-8"?>
<response>
    <params>
        <err_code>2</err_code>
        <err_text>Платеж ожидает обработки у оператора</err_text>
        <reg_id>1911229</reg_id>
        <reg_date>2019-11-30T13:41:31</reg_date>
    </params>
    <sign>FAEE70E199E6A0D601D3BC46C55C723D</sign>
</response>
```

```xml
<?xml version="1.0" encoding="utf-8"?>
<response>
    <params>
        <err_code>0</err_code>
        <err_text>Платеж обработан</err_text>
        <reg_id>1911229</reg_id>
        <reg_date>2019-11-30T13:41:31</reg_date>
    </params>
    <sign>1F7C240928CF65276C5D1A3D3FC389EB</sign>
</response>
```

```xml
<?xml version="1.0" encoding="utf-8"?>
<response>
    <params>
        <err_code>11</err_code>
        <err_text>Указаны не все необходимые параметры</err_text>
    </params>
</response>
```

```xml
<?xml version="1.0" encoding="utf-8"?>
<response>
    <params>
        <err_code>13</err_code>
        <err_text>Неверная цифровая подпись</err_text>
    </params>
</response>
```

```xml
<?xml version="1.0" encoding="utf-8"?>
<response>
    <params>
        <err_code>20</err_code>
        <err_text>Указанный номер счета отсутствует</err_text>
    </params>
    <sign>641BAA1236527308625A4AB1ED4665ED</sign>
</response>
```
