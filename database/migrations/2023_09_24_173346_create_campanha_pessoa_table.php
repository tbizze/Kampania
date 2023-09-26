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
        Schema::create('campanha_pessoa', function (Blueprint $table) {
            $table->id();
            // Informações da adesão
            $table->date('dt_adesao')->nullable();
            $table->date('dt_encerramento')->nullable();
            $table->decimal('valor')->nullable();
            $table->boolean('notif_email')->nullable();
            $table->boolean('notif_whatsapp')->nullable();
            
            // Chave primária
            $table->foreignId('pessoa_id')->references('id')->on('pessoas');
            $table->foreignId('campanha_id')->references('id')->on('campanhas');

            // Chave estrangeira: grupo e situação
            $table->foreignId('camp_sit_id')->nullable()->constrained('camp_sits');
            $table->foreignId('camp_gpo_id')->nullable()->constrained('camp_gpos');

            $table->timestamps(); // Data criação e edição.
            $table->softDeletes(); // Recurso p/ guardar na lixeira.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campanha_pessoa');
    }
};
