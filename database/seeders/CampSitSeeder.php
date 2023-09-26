<?php

namespace Database\Seeders;

use App\Models\CampSit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampSitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //CampSit::factory(4)->create();

        $items = [
            [
                'nome' => 'Regular',
                'notas' => 'É a pessoa contribui sem falha.'
            ],
            [
                'nome' => 'Pouco regular',
                'notas' => 'É a pessoa que ocasionalmente contribui.'
            ],
            [
                'nome' => 'Irregular',
                'notas' => 'É a pessoa que raramente contribui.'
            ],
            [
                'nome' => 'Cancelado',
                'notas' => 'É a pessoa que desistiu e/ou abandonou.'
            ],
        ];

        foreach ($items as $item) {
            CampSit::create($item);
        }
    }
}
