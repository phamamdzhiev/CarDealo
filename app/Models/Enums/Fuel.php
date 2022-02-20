<?php

namespace App\Models\Enums;

final class Fuel extends BaseEnum
{
    public const PETROL = 1;
    public const DIESEL = 2;
    public const HYBRID = 3;
    public const ELECTRICITY = 4;

    public const HR = [
        self::PETROL => ['name' => 'Бензин'],
        self::DIESEL => ['name' => 'Дизел'],
        self::HYBRID => ['name' => 'Хибрид'],
        self::ELECTRICITY => ['name' => 'Електрически'],
    ];

    /**
     * @param array $offer
     * @param string $key
     * @param array|null $value
     * @return array
     */
    public static function parse(array $offer, string $key, ?array $value = null): array
    {
        return parent::parse($offer, $key, self::HR[$offer[$key]]);
    }

}
