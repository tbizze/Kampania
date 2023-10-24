<?php

namespace Database\Seeders;

use App\Models\Campanha;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampanhaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //Campanha::factory(3)->create();

        $items = [
            [
                'nome_campanha' => 'Nova Matriz 2022',
                'dt_inicio' => '2022-11-30',
                'notas' => 'Primeira etapa da campanha.'
            ],
            [
                'nome_campanha' => 'Dízimo',
                'dt_inicio' => '2022-11-30',
                'notas' => 'Primeira etapa da campanha.'
            ],
        ];

        foreach ($items as $item) {
            Campanha::create($item);
        }
    }
}
