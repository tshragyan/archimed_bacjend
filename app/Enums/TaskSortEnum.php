<?php

namespace App\Enums;

enum TaskSortEnum: string
{
    case NAME = 'name';
    case EMAIL = 'email';
    case STATUS = 'status';
    public static function toArray()
    {
        return [
            self::NAME->value,
            self::EMAIL->value,
            self::STATUS->value,
        ];
    }
}
