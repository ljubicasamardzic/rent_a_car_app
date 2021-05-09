<?php

namespace Database\Seeders;

use App\Models\CarType;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CarTypeSeeder::class,
            LocationSeeder::class,
            EquipmentSeeder::class, 
            VehicleSeeder::class,
            PhotoSeeder::class
        ]);

        \App\Models\User::factory(2)->create();
        // \App\Models\CarType::factory(5)->create();
        \App\Models\Country::factory(10)->create();
        // \App\Models\Equipment::factory(5)->create();
        // \App\Models\Location::factory(20)->create();
        // \App\Models\Vehicle::factory(10)->create();
        \App\Models\Client::factory(10)->create();
        // \App\Models\Reservation::factory(10)->create();
        // \App\Models\EquipmentReservation::factory(10)->create();

        $this->call([
            ReservationSeeder::class,
        ]);
       
    }
}
