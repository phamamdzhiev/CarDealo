<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferCreationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'new_or_used' => 'required',
            'car_brand' => 'required',
            'car_year' => 'required',
            'car_model' => 'required',
            'car_fuel' => 'required',
            'car_transmission' => 'required',
            'car_cm3' => 'required',
            'car_hp' => 'required',
            'car_extras' => 'required',
            'car_color' => 'required',
            'car_category' => 'required',
            'car_offer_title' => 'required',
            'car_price' => 'required',
            'car_has_price' => 'required',
            'car_offer_city' => 'required',
            'car_offer_region' => 'required',
        ];
    }
}
