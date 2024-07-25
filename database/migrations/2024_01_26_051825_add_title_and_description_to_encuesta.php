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
        Schema::table('encuesta', function (Blueprint $table) {
            $table->string('titulo')->nullable();
            $table->text('descripcion')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encuesta', function (Blueprint $table) {
            $table->dropColumn('titulo');
            $table->dropColumn('descripcion');
        });
    }
};
