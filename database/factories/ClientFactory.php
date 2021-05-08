<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'country_id'=> rand(1, 10),
            'identification_document_no'=> rand(1, 400),
            'email'=> $this->faker->safeEmail(),
            'phone_no'=> $this->faker->phoneNumber,
            'date_of_first_reservation'=> $this->faker->date(),
            'date_of_last_reservation'=> $this->faker->date(),
            'remarks'=> $this->faker->text()
        ];
    }
}
