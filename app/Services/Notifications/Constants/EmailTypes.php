<?php

namespace App\Services\Notifications\Constants;

class EmailTypes
{
    const USER_REGISTERED = 1;
    const TOPIC_CREATED = 2;
    const FORGET_PASSWORD = 3;

    public static function toString(): array
    {
        return [
            self::USER_REGISTERED => 'ثبت نام کاربر',
            self::TOPIC_CREATED => 'ارسال مقاله جدید',
            self::FORGET_PASSWORD => 'فراموشی رمزعبور'
        ];
    }
}
