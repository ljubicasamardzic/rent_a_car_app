<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipment;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        Reservation::factory(10)->create();

        foreach(Reservation::all() as $reservation) {
            $equipment = Equipment::inRandomOrder()->take(rand(1, 2))->pluck('id');
            $reservation->equipment()->attach($equipment, ['quantity' => rand(1, 3)]);
        }
    }
}
