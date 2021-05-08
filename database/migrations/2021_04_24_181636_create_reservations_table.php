<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('client_id')->constrained('clients');
            $table->date('from_date')->now();
            $table->date('to_date');
            $table->integer('total_price');
            $table->foreignId('rent_location_id')->constrained('locations');
            $table->foreignId('return_location_id')->constrained('locations');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
