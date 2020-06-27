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
        
        // validation fails
        if(!$bookingData->status){
            return $bookingData->data;
        }

        $data = [
            'tripId' => $tripId,
            'lineId' => $lineId,
            'availableSeats' => $bookingData->data->availableSeats
        ];
        
        return view('show_booking')->withData($data);    

    }
    
    public function book(Request $request){

        $request = Request::create('/api/trip/book', 'POST');
        $booking = json_decode(Route::dispatch($request)->getContent());

        // validation fails
        if(!$booking->status){
            return $booking->data;
        }

        return redirect()->route('home')->withMsg('Trip Booked');
        
    }

}
