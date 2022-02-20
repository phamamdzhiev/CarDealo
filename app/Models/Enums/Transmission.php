<?php

namespace App\Models\Enums;

final class Transmission extends BaseEnum
{
    public const MANUAL = 1;
    public const AUTOMATIC = 2;
    public const SEMI_AUTOMATIC = 3;

    public const HR = [
        self::MANUAL => ['name' => 'Ръчни'],
        self::AUTOMATIC => ['name' => 'Автоматични'],
        self::SEMI_AUTOMATIC => ['name' => 'Полу-Автоматични']
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
