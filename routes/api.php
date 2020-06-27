<?php

use Illuminate\Http\Request;

Route::group(
    [
        'namespace' => 'Api',
        'as' => 'api'
    ], function(){
    
    
    Route::get('/trips/all','TripsController@getAllTrips');
    Route::post('/trip/book/data','TripsController@getTripBookingData');
    Route::post('/trip/book','TripsController@book');
    Route::get('/stations/all','TripsController@getStations');
    Route::post('/lines/search','TripsController@getLines');
    
});