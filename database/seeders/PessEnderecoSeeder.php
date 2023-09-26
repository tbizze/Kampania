<?php

namespace Database\Seeders;

use App\Models\PessEndereco;
use App\Models\Pessoa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PessEnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pessoas = Pessoa::all();

        foreach ($pessoas as $pessoa) {
            PessEndereco::factory()->create([
                'pessoa_id' => $pessoa->id,
            ]);
        }
    }
}
