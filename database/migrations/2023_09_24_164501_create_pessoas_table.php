<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            //$table->unsignedInteger('estado_civil_id')->nullable();
            //$table->foreign('estado_civil_id')->references('id')->on('pessoa_estado_civil');
            $table->string('cpf_cnpj', 14)->unique()->nullable();
            $table->string('rg_ie', 20)->nullable();
            $table->string('codigo', 15)->nullable();
            $table->string('nome', 130)->index();
            $table->string('sexo', 1);
            $table->date('dt_nasc')->nullable();
            $table->string('profissao',75)->nullable();
            $table->string('conjuge', 130)->nullable();
            $table->date('dt_casamento')->nullable();
            $table->string('celular', 11)->nullable();
            $table->string('email', 130)->nullable();
            $table->string('notas')->nullable();

            // Chave estrangeira: Estado civil.
            $table->foreignId('pess_est_civil_id')->nullable()->constrained('pess_est_civils');
            /* $table->foreignId('pess_est_civil_id')
                ->references('id')->on('pess_est_civis'); */
	            //->onDelete('cascade');
            //$table->foreignId('pess_est_civil_id')->constrained('pess_est_civis');
            $table->timestamps(); // Data criação e edição.
            $table->softDeletes(); // Recurso p/ guardar na lixeira.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas');
    }
};
