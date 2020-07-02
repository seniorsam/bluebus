<?php

Route::group(['namespace' => 'Web'], function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/book/data', 'BookingController@bookingData')->name('trip.book.data');
    Route::post('/book', 'BookingController@book')->name('trip.book');
    Route::post('/search', 'SearchController@search')->name('trip.search');
    Route::get('/trip/create', 'TripsdataController@createTripForm')->name('trip.create.form');
    Route::post('/trip/create', 'TripsdataController@createTrip')->name('trip.create');
});
