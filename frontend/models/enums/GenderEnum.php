<?php

namespace frontend\models\enums;

enum GenderEnum: string
{
    case MALE = 'male';
    case FEMALE = 'female';

    public static function getValues(): array
    {
        return [
            self::MALE->value,
            self::FEMALE->value,
        ];
    }
}