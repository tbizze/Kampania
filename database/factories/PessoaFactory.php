<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pessoa>
 */
class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'celular' => preg_replace("/[^0-9]/", "", $this->faker->phonenumber),
            'notas'=> $this->faker->sentence,
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'pess_est_civil_id' => $this->faker->numberBetween(1, 4), 
            'codigo'=> 'A-'.$this->faker->numberBetween(1, 100),
            'dt_nasc' => $this->faker->dateTimeBetween($startDate='now -90 years',$endDate='now -10 years'),
            'dt_casamento' => $this->faker->dateTimeBetween($startDate='-30 years',$endDate='now'),
            
            'rg_ie'=> $this->faker->rg(),
            'cpf_cnpj'=> $this->faker->cpf(false), // O parâmetro 'false' cria o CPF sem os pontos/máscara.
            //'cpf_cnpj'=> preg_replace("/[^0-9]/", "", $this->faker->cpf(false)),
            
            'conjuge'=> $this->faker->name(),
            'profissao'=> $this->faker->sentence(2),
        ];
    }
}
