<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trip;
use App\Booking;
use App\Station;
use App\Line;
use App\LinePart;
use Illuminate\Support\Facades\Validator;

class TripsController extends Controller
{

    # get all available lines
    public function getLines(Request $request){

        $rules = [
            'from_id' => 'required',
            'to_id' => 'required',
        ];

        $validate = $this->validateInputs($request, $rules);
        
        if(!$validate['status']){
            return $this->responseBody($validate['status'], $validate['data']);
        }
        

        $fromId = $request->from_id;
        $toId = $request->to_id;

        $lines = Line::where([['from_id', '=', $fromId], ['to_id', '=', $toId]])
                ->with(
                    'parts',
                    'stationFrom', 
                    'stationTo',
                    'trip',
                    'trip.seats'
                )->get();
        
        return $this->responseBody(1, $lines);
        
    }

    # get all stations
    public function getStations(){
        return Station::get();

    }

    # get trip current bookings
    public function getTripBookingData(Request $request){

        $rules = [
            'trip_id' => 'required',
            'line_id' => 'required',
        ];

        $validate = $this->validateInputs($request, $rules);
        
        if(!$validate['status']){
            return $this->responseBody($validate['status'], $validate['data']);
        }

        $tripId = $request->trip_id;
        $lineId = $request->line_id;
        
        $tripBookings = Booking::with('line', 'line.parts', 'trip.seats')
                ->where('trip_id', $tripId)
                ->get();        

        $requiredTripLines = LinePart::where('parent_line_id', $lineId)->pluck('line_id');

        # if no bookings available for this trip we will return required line with all seats available
        if($tripBookings->count() == 0){
            $trip = Trip::with('seats')->find($tripId);
            foreach($requiredTripLines as $k => $v){
                $t[$v]['bookedSeats'] = [];
                $t[$v]['availableSeats'] = $trip->seats->pluck('id', 'number')->toArray();
            }
            return $this->combineTripLinesData($t);
        }

        # all trip seats
        $tripSeats = $tripBookings[0]->trip->seats->pluck('id', 'number');
        $tripBookingdData = []; 
        
        # get all lines booked seats
        # we loop through parts because some lines including sub lines(parts)
        foreach($tripBookings as $booking){
            foreach($booking->line->parts as $part){
                $tripBookingdData[$part->line_id]['bookedSeats'][] = $booking->seat_id;
            }
        }

        $requiredLineBookingData = $this->getRequiredLineBookingData($tripBookingdData, $requiredTripLines, $tripSeats);
        return $this->responseBody(1, $requiredLineBookingData);

    }

    # extract the required booking lines from the whole trip bookings
    public function getRequiredLineBookingData($tripBookingdData, $requiredTripLines, $tripSeats){

        $output = [];
        $outputCombined = [];
        
        foreach($requiredTripLines as $k => $v){
            if(isset($tripBookingdData[$v])){
                $output[$v] = $tripBookingdData[$v];
                $output[$v]['availableSeats'] = $tripSeats->diff($tripBookingdData[$v]['bookedSeats'])->toArray();
            } else {
                $output[$v]['bookedSeats'] = [];
                $output[$v]['availableSeats'] = $tripSeats->toArray();
            }
        }
       
        return $this->combineTripLinesData($output);

    }

    # if required booking line including sub lines we need to combine all these lines in one as last step 
    public function combineTripLinesData($data){

        $data = collect($data);
        if(count($data) > 1){
            $availableSeats = call_user_func_array('array_intersect', $data->pluck('availableSeats')->toArray() );
        }else{
            $availableSeats = $data->pluck('availableSeats')->toArray()[0];
        }
        $outputCombined['availableSeats'] = $availableSeats;
        return $outputCombined;
    }

    # book a trip
    public function book(Request $request){

        $rules = [
            'trip_id' => 'required',
            'line_id' => 'required',
            'seat_id' => 'required',
        ];

        $validate = $this->validateInputs($request, $rules);
        
        if(!$validate['status']){
            return $this->responseBody($validate['status'], $validate['data']);
        }

        $lineId = $request->line_id;
        $tripId = $request->trip_id;
        $seatId = $request->seat_id;
        
        $booking = Booking::create([
            'userip' => $request->ip(),
            'line_id' => $lineId,
            'trip_id' => $tripId,
            'seat_id' => $seatId
        ]);

        return $this->responseBody(1, $booking);
    }

    public function responseBody($status, $data = []){
        return [
            'status' => $status,
            'data' => $data
        ];
    }

    public function validateInputs($request, $rules){
        
        $output = ['status' => '', 'msg' => ''];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            $output['status'] = 0;
            $output['data'] = $validator->errors()->all();
        } else {
            $output['status'] = 1;
            $output['data'] = null;
        }

        return $output;

    }


}
