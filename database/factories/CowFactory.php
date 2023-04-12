<?php

namespace Database\Factories;

use App\Models\Cow;
use Illuminate\Database\Eloquent\Factories\Factory;

class CowFactory extends Factory
{

    protected $model = Cow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'nascimento' => $this->faker->dateTimeBetween('-3 years', '+1 month'),
            'dataprimeiracria' => $this->faker->dateTimeBetween('-2 months', '+1 month'),
            'ultimacria' => $this->faker->dateTimeBetween('-2 months', '+1 month'),
            'litrosleite' => rand(10, 30),
            'cow_situation_id' => 1
        ];
    }
}
