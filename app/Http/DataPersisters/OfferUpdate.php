<?php namespace App\Http\DataPersisters;

use App\Http\Requests\OfferUpdateRequest;
use App\Models\Offer;

class OfferUpdate
{

    /**
     * @var OfferUpdateRequest
     */
    private $offerUpdateRequest;

    /**
     * @param OfferUpdateRequest $offerUpdateRequest
     */
    public function __construct(OfferUpdateRequest $offerUpdateRequest)
    {
        $this->offerUpdateRequest = $offerUpdateRequest;
    }

    /**
     * @param Offer $offer
     * @return bool
     */
    public function update(Offer $offer): bool
    {
        $data = $this->offerUpdateRequest->validated();

        $offer->price = $data['price'];
        $offer->has_price = $data['hasPrice'];
        $offer->title = $data['title'];
        $offer->description = $data['description'];
        return $offer->save();
    }
}
