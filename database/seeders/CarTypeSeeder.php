<?php

namespace Database\Seeders;

use App\Models\CarType;
use Illuminate\Database\Seeder;

class CarTypeSeeder extends Seeder
{

    public function run()
    {
        CarType::create([
            'name'  => 'Small',
        ]);
        CarType::create([
            'name'  => 'Medium',
        ]);
        CarType::create([
            'name'  => 'Premium',
        ]);
    }
}
