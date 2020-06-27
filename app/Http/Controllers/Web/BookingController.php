<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{

    public function bookingData(Request $request){

        $tripId = $request->trip_id;
        $lineId = $request->line_id;
        
        $request = Request::create('/api/trip/book/data', 'POST');
        $bookingData = json_decode(Route::dispatch($request)->getContent());

        $data = [
            'tripId' => $tripId,
            'lineId' => $lineId,
            'availableSeats' => $bookingData->availableSeats
        ];
        
        return view('show_booking')->withData($data);    

    }
    
    public function book(Request $request){

        $request = Request::create('/api/trip/book', 'POST');
        $booking = json_decode(Route::dispatch($request)->getContent());
        return redirect()->route('home')->withMsg('Trip Booked');
        
    }

}
