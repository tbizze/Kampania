<?php

namespace Database\Seeders;

use App\Models\CampGpo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampGpoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //CampGpo::factory(4)->create();

        $items = [
            [
                'nome' => 'Matriz',
                'notas' => 'Pessoas engajadas na comunidade S. José.'
            ],
            [
                'nome' => 'NSra. Apda.',
                'notas' => 'Pessoas engajadas na comunidade N. Senhora Aparecida.'
            ],
            [
                'nome' => 'SS. Trindade',
                'notas' => 'Pessoas engajadas na comunidade SS. Trindade.'
            ],
            [
                'nome' => 'Outro',
                'notas' => 'Outros grupos de pessoas.'
            ],
        ];

        foreach ($items as $item) {
            CampGpo::create($item);
        }
    }
}
