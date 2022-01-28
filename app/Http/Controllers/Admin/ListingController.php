<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Offer::all();
        return view('admin.listings', compact('listings'));
    }
}
