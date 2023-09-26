<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PessEndereco>
 */
class PessEnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'logradouro' => $this->faker->street_prefix(), // . ' ' . $this->faker->street_name(),
            'logradouro' => $this->faker->streetAddress(),
            //'numero' => $this->faker->building_number(), 
            'numero' => $this->faker->numberBetween(1, 2750), 
            'bairro' => $this->faker->sentence(3),
            'complemento'=> 'AP-' . $this->faker->numberBetween(1, 150),
            'cep' => preg_replace("/[^0-9]/", "", $this->faker->postcode(false)),
            'cidade' => $this->faker->city(),
            'uf'=> $this->faker->stateAbbr(),
            'notas'=> $this->faker->sentence(3),
        ];
    }
}
