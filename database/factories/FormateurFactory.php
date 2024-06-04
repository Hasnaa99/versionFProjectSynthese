<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Hash;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formateur>
 */
class FormateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "matricule" => fake()->numberBetween(10000,20000),
            "nom" => fake()->firstName(),
            "prenom" => fake()->lastName(),
            "cin" => fake()->randomLetter . fake()->randomNumber(6, true),
            "email" => fake()->email(),
            "password" => Hash::make('password123'),
            "date_embauche" => fake()->date(),
        ];
    }
}
