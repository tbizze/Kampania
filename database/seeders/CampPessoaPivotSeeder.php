<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CampPessoaPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $pessoas = Pessoa::all();
        $valores = [20.00, 30.00, 50.00, 100.00];

        foreach ($pessoas as $pessoa) {
                        
            // Associa Pessoa criada a um grupo de pessoas [1- Campanha 2022].
            $campanha_id = 1;
            
            //Sincroniza
            $pessoa->campanhaItens()->attach($campanha_id,[
                'notif_email' => (bool)rand(0,1), 
                'notif_whatsapp' => (bool)rand(0,1),
                'dt_adesao' => Carbon::now()->subDays(rand(0, 30))->format('Y-m-d'),
                'dt_encerramento' => Carbon::now()->subDays(rand(0, 30))->format('Y-m-d'),
                'camp_gpo_id' => rand(1,4),
                'camp_sit_id' => rand(1,4),
                'valor' => Arr::random($valores),
            ]);
        }
    }
}
