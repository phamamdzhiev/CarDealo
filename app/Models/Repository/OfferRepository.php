<?php
namespace App\Models\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class OfferRepository
{
    /**
     * @param array $columns
     * @return Builder
     */
    public function getSingleOfferQuery(
        array $columns = [
            'offers.uid',
            'offers.title',
            'offers.price',
            'offers.description',
            'vehicles.year',
            'vehicles.hp',
            'vehicles.km',
            'vehicles.cm3',
            'cities.name',
            'images.image'
        ]
    ): Builder
    {
        return DB::table('offers')
                ->join('vehicles', 'vehicles.offer_id', '=', 'offers.id')
                ->join('images', 'images.offer_id', '=', 'offers.id')
            /**
             * Vanko tyk slojih where, shototo inache hvash vsichki snimki i vav FO mi vrushta edna obqva po nqkolko puti cikala,
             * ne znam dali tyk trqbvashe da se sloji no ROBOTI, za sq. Ako nes go opravi pls.
             */
                        ->where('images.is_main', '=', 1)
                ->join('cities', 'cities.id', '=', 'offers.city_id')
                ->join('vehicles_types', 'vehicles.type_id', '=', 'vehicles_types.id')
                ->join('merchants', 'merchants.user_id', '=', 'offers.user_id')
                ->select($columns);
    }
}
