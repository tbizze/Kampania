<?php

namespace Database\Seeders;

use App\Models\OperacaoTp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperacaoTpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $items = [
            [
                'nome' => 'Esécie',
                'notas' => 'Operações em espécies.'
            ],
            [
                'nome' => 'Pix',
                'notas' => 'Operações via PIX.'
            ],
            [
                'nome' => 'Cartão débito',
                'notas' => 'Operações com cartão débito.'
            ],
            [
                'nome' => 'Cartão crédito',
                'notas' => 'Operações com cartão crédito.'
            ],
        ];

        foreach ($items as $item) {
            OperacaoTp::create($item);
        }
    }
}
