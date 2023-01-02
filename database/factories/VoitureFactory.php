<?php

namespace Database\Factories;

use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoitureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model=Voiture::class;

    public function definition()
    {
        return [
            "titre"=>$this->faker->lastName,
            "matricule"=>$this->faker->swiftBicNumber,
            "modele"=>$this->faker->lastName,
            "image"=>"images/téléchargement.png",
            "kilometrage"=>$this->faker->numberBetween(50,100),
            "nbrPlace"=>$this->faker->numberBetween(2,8),
            "description"=>$this->faker->text(),
            "prix"=>$this->faker->numberBetween($min = 150, $max = 500),
            "type_voiture_id"=>rand(1,4),
            "estDisponible"=>rand(0,1),
            
        ];
    }
}
