<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBluebusTables extends Migration
{
    
    public function up()
    {

        Schema::create('stations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('seats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->unsignedBigInteger('trip_id');
            $table->timestamps();
        });

        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bus_name');
            $table->timestamps();
        });

        Schema::create('lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('from_id');
            $table->unsignedBigInteger('to_id');
            $table->unsignedBigInteger('trip_id');
            $table->timestamps();
        });

        Schema::create('line_parts', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_line_id');
            $table->unsignedBigInteger('line_id');
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userip');
            $table->unsignedBigInteger('line_id');
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('seat_id');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('buses');
        Schema::dropIfExists('seats');
        Schema::dropIfExists('stations');
        Schema::dropIfExists('trips');
        Schema::dropIfExists('lines');
        Schema::dropIfExists('line_parts');
        Schema::dropIfExists('bookings');
    }
}
