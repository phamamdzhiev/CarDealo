<?php

namespace App\Models\Enums;

class BaseEnum
{
    /**
     * @param array $offer
     * @param string $key
     * @param array|null $value
     * @return array
     */
    public static function parse(array $offer, string $key, ?array $value): array
    {
        $offer[$key] = $value;
        return $offer;
    }


}
