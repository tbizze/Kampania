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
        Schema::create('pess_est_civils', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 30);
            $table->string('notas')->nullable();

            $table->timestamps(); // Data criação e edição.
            $table->softDeletes(); // Recurso p/ guardar na lixeira.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pess_est_civils');
    }
};
