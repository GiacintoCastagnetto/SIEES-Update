<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOpcionesToPregunta extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('pregunta', function (Blueprint $table) {
      $table->string('opciones')->after('id_metrica_evaluacion')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('pregunta', function (Blueprint $table) {
      $table->dropColumn('opciones');
    });
  }
}
