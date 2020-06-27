<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Line;

class SearchController extends Controller
{
    function search(Request $request){

        $request = Request::create('/api/lines/search', 'POST');
        $data = json_decode(Route::dispatch($request)->getContent());

        // validation fails
        if(!$data->status){
            return $data->data;
        }

        $data = [
            'lines' => $data->data
        ];

        return view('search')->with($data);    

    }
}
