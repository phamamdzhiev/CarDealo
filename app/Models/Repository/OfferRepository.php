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
            'cities.name as city',
            'images.image',
            'brands.name as brand',
            'models.name as model'
        ]
    ): Builder
    {
        return DB::table('offers')
                ->join('vehicles', 'vehicles.offer_id', '=', 'offers.id')
                ->join('images', 'images.offer_id', '=', 'offers.id')
                ->join('brands', 'vehicles.brand_id', '=', 'brands.id')
                ->join('models', 'vehicles.model_id', '=', 'models.id')
                ->where('images.is_main', '=', 1)
                ->join('cities', 'cities.id', '=', 'offers.city_id')
                ->join('vehicles_types', 'vehicles.type_id', '=', 'vehicles_types.id')
                ->join('merchants', 'merchants.user_id', '=', 'offers.user_id')
                ->orderBy('offers.created_at', 'desc')
                ->select($columns);
    }
}
