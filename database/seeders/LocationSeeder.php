<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{

    public function run()
    {
        Location::create([
            'name'  => 'Podgorica City Centre',
        ]);
        Location::create([
            'name'  => 'Podgorica Airport',
        ]);
        Location::create([
            'name'  => 'Tivat City Centre',
        ]);
        Location::create([
            'name'  => 'Tivat Airport',
        ]);
        Location::create([
            'name'  => 'Budva',
        ]);
        Location::create([
            'name'  => 'Kotor Kamelija',
        ]);
        Location::create([
            'name'  => 'Kotor Old Town',
        ]);
        Location::create([
            'name'  => 'Zabljak',
        ]);
        Location::create([
            'name'  => 'Berane',
        ]);
        Location::create([
            'name'  => 'Niksic',
        ]);
        Location::create([
            'name'  => 'Kolasin',
        ]);
    }
}
