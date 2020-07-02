<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trip;
use App\Line;
use App\Seat;
use Illuminate\Support\Facades\Validator;
use App\Rules\Notset;

/**
 * this api simply take the trip stations in order
 * and build the trip data
 * including all trip lines and parent trip lines
 */
class TripsdataController extends Controller
{

    protected $parentLines = [];
    protected $parentLinesTracker = [];
    protected $parentLinesHolder = [];

    function buildTripData(Request $request){

        $rules = [
            'station' => 'required',
            // 'bus_name' => 'required|unique:trips'
            'bus_name' => 'required'
        ];
        
        $validate = $this->validateInputs($request, $rules);
        
        if(!$validate['status']){
            return $this->responseBody($validate['status'], $validate['data']);
        }
    
        # get stations pairs which present the trip lines
        $lastLineInsertedId = Line::latest('id')->first();
        $lastLineInsertedId = (!empty($lastLineInsertedId)) ? $lastLineInsertedId->id : 0;
        
        $stations = $request->station;
        $stationsCount = count($stations);
        $pairs = [];
        for($i=0; $i<$stationsCount; $i++){
            
            if($i+1 == $stationsCount)
                break;

            $pairs[] = [
                'from' => $stations[$i],
                'to' => $stations[$i+1],
                'parts' => [['child_line_id' => $i+$lastLineInsertedId+1]]
            ];
        }

        $pairsCount = count($pairs);
        
        # get parent lines (which include other lines)
        $this->getParentLinesRecurisevly($pairs);
        $this->insertTripData($request->bus_name, array_merge($pairs, ...$this->parentLinesHolder));
        return $this->responseBody(1, 'trip inserted successfully');
        // return array_merge($pairs, ...$this->parentLinesHolder);

    }

    function getParentLinesRecurisevly($pairs){
        
        $pairsCount = count($pairs);

        for($i=0; $i<$pairsCount; $i++){
            
            if($i+1 == $pairsCount)
                break;
                
            $this->parentLinesTracker[] = [
                'from' => $pairs[$i]['from'],
                'to' => $pairs[$i+1]['to'],
                'parts' => array_unique(array_merge($pairs[$i]['parts'], $pairs[$i+1]['parts']), SORT_REGULAR)
            ];

        }

        if(count($this->parentLinesTracker) == 0){
            return;
        } else {
            $this->parentLinesHolder[]= $this->parentLinesTracker;
            $this->parentLines = $this->parentLinesTracker;
            $this->parentLinesTracker = [];
            return $this->getParentLinesRecurisevly($this->parentLines);
        }

    }

    function insertTripData($tripBusName, $parentLines){
        
        # insert trip id, bus name
        $tripId = Trip::insertGetId([
            'bus_name' => $tripBusName
        ]);

        # insert seats
        $seats = [];
        foreach(range(1,12) as $seatNum){
            $seats[] = [
                'number' => 's'.$seatNum.$tripId,
                'trip_id' => $tripId
            ];
        }
        Seat::insert($seats);

        # insert lines and line_parts
        foreach($parentLines as $pair){

            $line = Line::create([
                'from_id' => $pair['from'],
                'to_id' => $pair['to'],
                'trip_id' => $tripId
            ]);

            $line->parts()->createMany($pair['parts']);
            
        }
    
        return $this->responseBody(1, 'inserted successfully');


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
