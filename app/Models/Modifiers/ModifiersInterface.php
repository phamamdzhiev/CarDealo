<?php
namespace App\Models\Modifiers;

use Illuminate\Database\Query\Builder;

interface ModifiersInterface
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void;
}
