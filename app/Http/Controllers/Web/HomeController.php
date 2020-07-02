<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
 
    function index() {

        $request = Request::create('/api/stations/all', 'GET');
        $stations = json_decode(Route::dispatch($request)->getContent());        
        $data = [ 'stations' => $stations ];
        return view('welcome')->with($data);
        
    }

}
