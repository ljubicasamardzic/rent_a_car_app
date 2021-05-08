<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Reservation;
use App\Models\EquipmentReservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentReservationFactory extends Factory
{

    protected $model = EquipmentReservation::class;

    public function definition()
    {
        return [
            'equipment_id'   => Equipment::all()->random()->id,
            'reservation_id'   => Reservation::all()->random()->id,
            'quantity' => rand(1, 4)
        ];
    }
}
