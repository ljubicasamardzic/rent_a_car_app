<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{

    public function run()
    {
        Equipment::create([
            'name'  => 'Baby Seat',
            'max_quantity' => 3
        ]);
        Equipment::create([
            'name'  => 'GPS Device',
            'max_quantity' => 1
        ]);
        Equipment::create([
            'name'  => 'Bike Rack',
            'max_quantity' => 1
        ]);
        Equipment::create([
            'name'  => 'Luggage Rack',
            'max_quantity' => 1
        ]);
        Equipment::create([
            'name'  => 'Mobility Device',
            'max_quantity' => 2
        ]);

    }
}
