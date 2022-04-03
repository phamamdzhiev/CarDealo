<?php
namespace App\Http\DataPersisters;

use App\Http\Requests\OfferCreationRequest;
use App\Models\Offer;
use App\Models\Vehicle;
use App\Models\VehicleBoat;
use App\Models\VehicleCaravan;
use App\Models\VehicleExtra;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Auth;

class OfferPersister
{
    /**
     * @var Auth
     */
    private $auth;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @param OfferCreationRequest $offerCreationRequest
     * @param Auth $auth
     */
    public function __construct(OfferCreationRequest $offerCreationRequest, Auth $auth)
    {
        $this->auth = $auth;
        $this->data = $offerCreationRequest->validated();
    }

    /**
     * @return Offer
     */
    public function persist(): Offer
    {
        $offer = Offer::create([
            'title' => $this->data['title'],
            'price' => $this->data['price'],
            'description' => $this->data['description'],
            'user_id' => $this->auth::id(),
            'is_approved' => false,
            'city_id' => $this->data['city'],
            'condition' => $this->data['condition'],
            'has_price' => $this->data['hasPrice'],
            'uid' => new Expression('uuid_v4()')
        ]);

        $vehicle = $this->persistVehicle($offer);
        $this->persistExtras($vehicle);

        return $offer;
    }

    /**
     * @param Offer $offer
     * @return Vehicle
     */
    private function persistVehicle(Offer $offer): Vehicle
    {
        $vehicle = Vehicle::create([
            'year' => $this->data['year'],
            'hp' => $this->data['hp'],
            'km' => $this->data['km'],
            'cm3' => $this->data['cm3'],
            'fuel_id' => $this->data['engine']['id'],
            'transmission_id' => $this->data['transmission']['id'],
            'color_id' => $this->data['color'],
            'brand_id' => $this->data['brand']['id'],
            'model_id' => $this->data['model']['id']?? null,
            'offer_id' => $offer->id,
            'type_id' => $this->data['vehicleType']
        ]);

        /*
        switch ($this->data->vehicleCategory) {
            case 5 :
                $this->persistVehicleCaravan($vehicle);
                break;
            case 6 :
                $this->persistVehicleBoat($vehicle);
        }*/

        return $vehicle;
    }

    /**
     * @todo
     * @param Vehicle $vehicle
     * @return VehicleBoat
     */
    private function persistVehicleBoat(Vehicle $vehicle): VehicleBoat
    {
        return Vehicle::create([
            'vehicle_id' => $vehicle->id,
            'working_hours' => '',
            'model' => '',
            'engine_number' => '',
            'width' => '',
            'height' => '',
            'wade' => ''
        ]);
    }

    /**
     * @todo
     * @param Vehicle $vehicle
     * @return VehicleCaravan
     */
    private function persistVehicleCaravan(Vehicle $vehicle): VehicleCaravan
    {
        return  Vehicle::create([
            'vehicle_id' => $vehicle->id,
            'wc' => '',
            'material_id' => '',
            'heating_id' => '',
            'model' => ''
        ]);

    }

    /**
     * @param Vehicle $vehicle
     * @return array<VehicleExtra>
     */
    private function persistExtras(Vehicle $vehicle): array
    {
        if (isset($this->data['extras'])) {
            $extraList = [];
            foreach ($this->data['extras'] as $extraRow) {
                $extraList[] = VehicleExtra::create(['vehicle_id' => $vehicle->id, 'extra_id' => $extraRow]);
            }

            return $extraList;
        }
        
    }
}
