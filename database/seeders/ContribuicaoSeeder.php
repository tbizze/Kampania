<?php

namespace Database\Seeders;

use App\Models\CampPessoaPivot;
use App\Models\Contribuicao;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContribuicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $pessoas = CampPessoaPivot::get()->whereIn('id', [1,2,3,4,5]);
        $valores = [20.00, 30.00, 50.00, 100.00];

        foreach ($pessoas as $pessoa) {

            $data = Carbon::now()->subDays(rand(0, 30))->format('Y-m-d');
            $valor = Arr::random($valores);

            Contribuicao::factory()->create([
                'periodo' => Carbon::parse($data)->format('m/Y'),
                'valor' => $valor,
                
                'val_operacao' => $valor,
                'dt_operacao' => $data,

                'operacao_tp_id' => rand(1,4),
                'conta_id' => rand(1,3),
                'campanha_pessoa_id' => 1//$pessoas->id,
                
            ]);
        }
    }
}
