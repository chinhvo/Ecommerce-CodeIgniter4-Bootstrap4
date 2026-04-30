<?php

namespace App\Core;

class BlogType
{
    public const TECHNICAL = 1;
    public const CUSTOMER = 2;
    public const PROMOTION = 3;
    public const GENERAL_NEWS = 4;

    public static function labels(): array
    {
        return [
            self::TECHNICAL => 'Kỹ thuật',
            self::CUSTOMER => 'Khách hàng',
            self::PROMOTION => 'Khuyến mãi',
            self::GENERAL_NEWS => 'Tin thức chung',
        ];
    }

    public static function normalize($value): int
    {
        $value = (int) $value;
        $labels = self::labels();

        if (!isset($labels[$value])) {
            return self::GENERAL_NEWS;
        }

        return $value;
    }
}
