<?php

namespace App\Listeners;

use App\Events\OfferVisited;
use App\Models\OfferVisit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class OfferVisitSubscribtion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param OfferVisited $event
     * @return void
     */
    public function handle(OfferVisited $event)
    {
        $offer = $event->getOffer();
        DB::beginTransaction();
       try {
            $visited = OfferVisit::where('offer_id', $offer->id)->where('ip', $event->getIp())->first();
            if (empty($visited)) {
                $visit = new OfferVisit();
                $visit->offer_id = $offer->id;
                $visit->ip = $event->getIp();
                $visit->save();
                $offer->visits += 1;
                $offer->save();
            }
           DB::commit();
       } catch (\Exception $e) {
           DB::rollBack();
           throw $e;
       }
    }
}
