<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{

    public function run()
    {
        Vehicle::create([
            'plate_no'  => 'HN AF674',
            'production_year' => 2020,
            'car_type_id' => 1,
            'no_of_seats' => 5,
            'price_per_day' => 35,
            'remarks' => 'Remark 1'
        ]);
        Vehicle::create([
            'plate_no'  => 'HN AF675',
            'production_year' => 2021,
            'car_type_id' => 2,
            'no_of_seats' => 5,
            'price_per_day' => 50,
            'remarks' => 'Remark 2'
        ]);
        Vehicle::create([
            'plate_no'  => 'TV AF676',
            'production_year' => 2020,
            'car_type_id' => 3,
            'no_of_seats' => 5,
            'price_per_day' => 60,
            'remarks' => 'Remark 3'
        ]);
        Vehicle::create([
            'plate_no'  => 'TV AF677',
            'production_year' => 2020,
            'car_type_id' => 1,
            'no_of_seats' => 5,
            'price_per_day' => 40,
            'remarks' => 'Remark 4'
        ]);
        Vehicle::create([
            'plate_no'  => 'BD AF678',
            'production_year' => 2020,
            'car_type_id' => 2,
            'no_of_seats' => 5,
            'price_per_day' => 45,
            'remarks' => 'Remark 5'
        ]);
        Vehicle::create([
            'plate_no'  => 'BD AF679',
            'production_year' => 2020,
            'car_type_id' => 3,
            'no_of_seats' => 5,
            'price_per_day' => 60,
            'remarks' => 'Remark 6'
        ]);
        Vehicle::create([
            'plate_no'  => 'KO AF680',
            'production_year' => 2020,
            'car_type_id' => 2,
            'no_of_seats' => 5,
            'price_per_day' => 70,
            'remarks' => 'Remark 7'
        ]);
        Vehicle::create([
            'plate_no'  => 'KO AF681',
            'production_year' => 2020,
            'car_type_id' => 3,
            'no_of_seats' => 5,
            'price_per_day' => 80,
            'remarks' => 'Remark 8'
        ]);
        Vehicle::create([
            'plate_no'  => 'PG AF682',
            'production_year' => 2020,
            'car_type_id' => 2,
            'no_of_seats' => 5,
            'price_per_day' => 25,
            'remarks' => 'Remark 9'
        ]);
        Vehicle::create([
            'plate_no'  => 'PG AF683',
            'production_year' => 2020,
            'car_type_id' => 3,
            'no_of_seats' => 5,
            'price_per_day' => 100,
            'remarks' => 'Remark 10'
        ]);
    }
}
