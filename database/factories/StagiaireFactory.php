<?php
// database/factories/StagiaireFactory.php
namespace Database\Factories;

use App\Models\Stagiaire;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Groupe;

class StagiaireFactory extends Factory
{
    protected $model = Stagiaire::class;

    public function definition()
    {
        $groupe = Groupe::inRandomOrder()->first();

        return [
            'cef' => $this->faker->numberBetween(100, 1000),
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'date_naissance' => $this->faker->date(),
            'groupe_id' => $groupe->id,
        ];
    }
}
