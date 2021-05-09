<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition()
    {
        return [
            'plate_no' => $this->faker->name(),
            'production_year' => $this->faker->year(),
            'car_type_id' => rand(1, 5),
            'no_of_seats' => rand(2, 5),
            'price_per_day' => rand(25, 90)
        ];
    }
}
