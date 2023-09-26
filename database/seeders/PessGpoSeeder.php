<?php

namespace Database\Seeders;

use App\Models\PessGpo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PessGpoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //PessGpo::factory(4)->create();

        $items = [
            [
                'nome' => 'Campanha Nova Matriz',
                'notas' => 'É a pessoa que aderiu a campanha de arrecadação para Nova Matriz.'
            ],
            [
                'nome' => 'Dízimo',
                'notas' => 'É a pessoa que oferta seu dízimo na comunidade.'
            ],
            [
                'nome' => 'Agente de pastoral',
                'notas' => 'É a pessoa que está engajada em pastoral, movimento ou ministério na Comunidade.'
            ],
        ];

        foreach ($items as $item) {
            PessGpo::create($item);
        }
    }
}
