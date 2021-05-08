<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{

    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'from_date' => $this->faker->date(),
            'to_date'=> $this->faker->date(),
            'total_price' => rand(30, 2000),
            'vehicle_id' => rand(1, 10),
            'client_id' => rand(1, 10),
            'rent_location_id' => rand(1, 20),
            'return_location_id' => rand(1, 20), 
        ];
    }
}
