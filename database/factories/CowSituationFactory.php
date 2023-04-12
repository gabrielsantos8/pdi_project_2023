<?php

namespace Database\Factories;

use App\Models\CowSituation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CowSituationFactory extends Factory
{

    protected $model = CowSituation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descricao' => 'Situ Test',
        ];
    }
}
