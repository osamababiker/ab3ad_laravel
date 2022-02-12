<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Offer;

class OffersController extends Controller
{
    public function getTable(){
        $offers = Offer::where('isDeleted',0)->get();
        return view('dashboard/offers/table',compact(['offers']));
    }
}
