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
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('description')->after('name'); //Descrição da permissão.
            $table->string('model')->after('name'); //Não afeta a funcionalidade. Mas para agrupar na listagem de permissões, por itens afins.
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->string('description')->after('name'); //Descrição da função.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn(['description','model']);
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
