<?php

namespace App\Enums;

enum Genders: int
{
    case MALE = 0;
    case FEMALE = 1;

    public function title()
    {
        return match ($this) {
            self::MALE => __("Male"),
            self::FEMALE => __("Female"),
        };
    }

    public static function options()
    {
        return collect(self::cases())->mapWithKeys(function ($item) {
            return [$item->value => self::from($item->value)->title()];
        });
    }
}
