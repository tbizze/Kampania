<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Roda um conjunto de Seeder.
        $this->call([
            
            // Permissões e usuário.
            PermissionSeeder::class,    //criar funções e permissões
            UserSeeder::class,          // criar usuários
            
            // Módulo Pessoas.
            PessEstCivilSeeder::class,
            PessGpoSeeder::class,
            PessoaSeeder::class,
            
            // Módulo campanha.
            CampGpoSeeder::class,
            CampSitSeeder::class,
            CampanhaSeeder::class,
            CampPessoaPivotSeeder::class,

        ]);

        //Roda somente uma Seeder específica.
        //$this->call(UserSeeder::class);
    }
}
