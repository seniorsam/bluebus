<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Station;


class TripsdataController extends Controller
{

    function createTripForm() {
        $data = [ 'stations' => Station::get() ];
        return view('trip_create')->with($data);
    }
 
    function createTrip(Request $request) {

        $request = Request::create('/api/trip/data/build', 'POST');
        $data = json_decode(Route::dispatch($request)->getContent());

        // validation fails
        if(!$data->status){
            return $data->data;
        }

        return redirect()->route('home')->withMsg($data->data);
        
        
    }

}
