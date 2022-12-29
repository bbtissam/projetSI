<?php

namespace Database\Factories;

use App\Models\TypeVoiture;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeVoitureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model=TypeVoiture::class;

    public function definition()
    {
        return [
           "nom"=> array_rand(["audi","bmw","4x4","toyota"],1)
        ];
    }
}
