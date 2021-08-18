<?php

/**
 * Файл из репозитория MikBill-CKassa-BiSys-API
 * @link https://github.com/itpanda-llc/mikbill-ckassa-bisys-api
 */

namespace Panda\MikBill\CKassa\BiSysApi;

/**
 * Class Sql
 * @package Panda\MikBill\CKassa\BiSysApi
 * SQL-запросы
 */
class Sql
{
    /**
     * Получение аккаунта
     */
    public const GET_ACCOUNT = "
        SELECT
            CONCAT(
                SUBSTRING(
                    @surname :=
                    (
                        SUBSTRING(
                            `users`.`fio`,
                            1,
                            (
                                LOCATE(
                                    ' ',
                                    `users`.`fio`
                                ) - 1
                            )
                        )
                    ),
                    1,
                    1 
                ),
                REPEAT(
                    '*', 
                    (
                        LENGTH(
                            @surname
                        ) - 1
                    )
                ),
                ' ',
                SUBSTRING(
                    @name :=
                    (
                        SUBSTRING(
                            @name :=
                            (
                                SUBSTRING(
                                    `users`.`fio`,
                                    @locate :=
                                    (
                                        LOCATE(
                                            ' ',
                                            SUBSTRING(
                                                `users`.`fio`,
                                                1,
                                                (
                                                    LOCATE(
                                                        ' ',
                                                        `users`.`fio`
                                                    ) + 1
                                                )
                                            )
                                        ) + 1
                                    )
                                )
                            ),
                            1,
                            IF(
                                0 != @lengthName :=
                                (
                                    LENGTH(
                                        SUBSTRING(
                                            @name,
                                            1,
                                            (
                                                LOCATE(
                                                    ' ',
                                                    @name
                                                ) - 1
                                            )
                                        )
                                    )
                                ),
                                @lengthName,
                                LENGTH(@name)
                            )
                        )
                    ),
                    1,
                    1
                ),
                REPEAT(
                    '*',
                    (
                        LENGTH(
                            @name
                        ) - 1
                    )
                ),
                IF(
                    @name != @middleName :=
                    (
                        SUBSTRING(
                            SUBSTRING(
                                `users`.`fio`,
                                @locate
                            ),
                            (
                                LOCATE(
                                    ' ',
                                    SUBSTRING(
                                        `users`.`fio`,
                                        @locate
                                    )
                                ) + 1
                            )
                        )
                    ),
                    CONCAT(
                        ' ',
                        SUBSTRING(
                            @middleName,
                            1,
                            1
                        ),
                        REPEAT(
                            '*',
                            (
                                LENGTH(
                                    @middleName
                                ) - 1
                            )
                        )
                    ),
                    ''
                )
            ) AS
                `" . Field::CLIENT_NAME . "`,
            ROUND(
                `users`.`deposit`,
                2
            ) AS
                `" . Field::BALANCE . "`
        FROM
            `users`
        WHERE
            `users`.`fio` != ''
                AND
            `users`.`user` = " . Holder::ACCOUNT;

    /**
     * Получение платежа
     */
    public const GET_PAYMENT = "
        SELECT
            IF(
                `addons_pay_api`.`transaction_id` = 0,
                CONCAT(
                    DATE_FORMAT(
                        NOW(),
                        '%y%m'
                    ),
                    `addons_pay_api`.`record_id`
                ),
                `addons_pay_api`.`transaction_id`
            ) AS
                `" . Field::REG_ID . "`,
            DATE_FORMAT(
                `addons_pay_api`.`creation_time`,
                '%Y-%m-%dT%H:%i:%s'
            ) AS 
                `" . Field::REG_DATE . "`,
            `addons_pay_api`.`status` AS
                `" . Field::STATUS . "`,
            ROUND(
                `addons_pay_api`.`amount` * 100
            ) AS
                `" . Field::PAY_AMOUNT . "`,
            `users`.`user` AS
                `" . Field::ACCOUNT . "`
        FROM
            `addons_pay_api`
        LEFT JOIN
            `users`
                ON
                    `users`.`uid` = `addons_pay_api`.`user_ref`
        WHERE
            `addons_pay_api`.`category` = " . Holder::CATEGORY_ID . "
                AND
            `addons_pay_api`.`misc_id` = " . Holder::PAY_ID;

    /**
     * Проверка категории платежа
     */
    public const CHECK_CATEGORY = "
        SELECT
            `addons_pay_api_category`.`category`
        FROM
            `addons_pay_api_category`
        WHERE
            `addons_pay_api_category`.`category` = " . Holder::CATEGORY_ID;

    /**
     * Добавление категории платежа
     */
    public const ADD_CATEGORY = "
        INSERT INTO 
            `addons_pay_api_category` (
                `category`,
                `categoryname`
            )
        VALUES (
            " . Holder::CATEGORY_ID . ",
            " . Holder::CATEGORY_NAME . "
        )";

    /**
     * Добавление платежа
     */
    public const ADD_PAYMENT = "
        INSERT INTO
            `addons_pay_api` (
                `misc_id`,
                `category`,
                `user_ref`,
                `amount`,
                `creation_time`,
                `update_time`,
                `comment`
            )
        VALUES (
            " . Holder::PAY_ID . ",
            " . Holder::CATEGORY_ID . ",
            (
                SELECT
                    `users`.`uid`
                FROM
                    `users`
                WHERE
                    `users`.`user` = " . Holder::ACCOUNT . "
            ),
            " . Holder::PAY_AMOUNT . " / 100,
            NOW(),
            NOW(),
            " . Holder::PAYMENT_COMMENT . "
        )";

    /**
     * Подготовление платежа
     */
    public const SET_PAYMENT = "
        UPDATE
            `addons_pay_api`
        SET
            `addons_pay_api`.`transaction_id`
                =
            CONCAT(
                DATE_FORMAT(
                    NOW(),
                    '%y%m'
                ),
                `addons_pay_api`.`record_id`
            )
        WHERE
            `addons_pay_api`.`misc_id`= " . Holder::PAY_ID;
}
