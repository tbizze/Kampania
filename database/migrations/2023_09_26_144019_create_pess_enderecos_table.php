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
        Schema::create('pess_enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('logradouro', 130)->nullable();
            $table->string('numero', 6)->nullable();
            $table->string('complemento', 20)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('cep', 8)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('uf', 2)->nullable();
            $table->boolean('principal')->default(true);
            $table->string('notas')->nullable();

            // Chave estrangeira: Estado civil.
            $table->foreignId('pessoa_id')->nullable()->constrained('pessoas');
            
            $table->timestamps(); // Data criação e edição.
            $table->softDeletes(); // Recurso p/ guardar na lixeira.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pess_enderecos');
    }
};
