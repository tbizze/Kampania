<?php

namespace Database\Seeders;

use App\Models\Conta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $items = [
            [
                'nome' => 'Caixa',
                'notas' => 'Movimento em espécies.'
            ],
            [
                'nome' => 'Bradesco',
                'notas' => 'Conta corrente Bradesco.'
            ],
            [
                'nome' => 'PagSeguro',
                'notas' => 'Conta digital PagSeguro.'
            ],
        ];

        foreach ($items as $item) {
            Conta::create($item);
        }
    }
}
