<?php

namespace Database\Seeders;

use App\Models\PessEstCivil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PessEstCivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //PessEstCivil::factory(4)->create();
        $items = [
            [
                'nome' => 'Solteiro',
                'notas' => 'É a pessoa que nunca se casou, independente se possui um relacionamento estável ou não.'
            ],
            [
                'nome' => 'Casado',
                'notas' => 'É o indivíduo que possui uma união matrimonial através do casamento civil, independente do regime de bens adotado.'
            ],
            [
                'nome' => 'Viúvo',
                'notas' => 'É o indivíduo que o cônjuge (marido ou esposa) faleceu.'
            ],
            [
                'nome' => "Separado",
                'notas' => 'É quem não vive mais com o companheiro, porém ainda não está divorciado.'
            ],
            [
                'nome' => "Divorciado",
                'notas' => 'É a pessoa que teve homologado seu pedido de divórcio através da justiça, ou de uma escritura.'
            ],
            [
                'nome' => "União estável",
                'notas' => 'É a pessoa que possui um relacionamento estável, mas que não fez contrato matrimonial de casamento civil.'
            ],
        ];

        foreach ($items as $item) {
            PessEstCivil::create($item);
        }
    }
}
