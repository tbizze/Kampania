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
        Schema::create('contribuicoes', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor');
            $table->string('periodo',10);

            $table->decimal('val_operacao')->nullable();
            $table->date('dt_operacao')->nullable();

            // Chave estrangeira: grupo e situação
            $table->foreignId('conta_id')->nullable()->constrained('contas');
            $table->foreignId('operacao_tp_id')->nullable()->constrained('operacao_tps');
            $table->foreignId('campanha_pessoa_id')->nullable()->constrained('campanha_pessoa');

            $table->timestamps(); // Data criação e edição.
            $table->softDeletes(); // Recurso p/ guardar na lixeira.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contribuicoes');
    }
};
