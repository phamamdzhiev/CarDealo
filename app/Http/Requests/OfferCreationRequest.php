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
            'vehicleType' => 'required',
            'vehicleCategory' => 'required',
            'condition' => 'required',
            'brand.id' => 'required',
            'year' => 'required',
            'extras' => 'required',
            'color' => 'required',
            'transmission.id' => 'required',
            'engine.id' => 'required',
            'hp' => 'required',
            'cm3' => 'required',
            'km' => 'required',
            'title' => 'required',
            'description' => 'required',
            'hasPrice' => 'required',
            'region' => 'required',
            'city' => 'required',
        ];
    }

    /**
     * @param $keys
     * @return array|mixed
     */
    public function all($keys = null)
    {
        return json_decode($this->input('offer'), true);
    }
}
