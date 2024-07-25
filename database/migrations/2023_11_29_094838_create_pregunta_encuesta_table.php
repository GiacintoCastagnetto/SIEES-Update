<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntaEncuestaTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pregunta_encuesta', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->foreignId('pregunta_id')->references('id')->on('pregunta')
        ->onDelete('cascade');
      $table->foreignId('encuesta_id')->references('id')->on('encuesta')
        ->onDelete('cascade');
      $table->string('respuesta')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('pregunta_encuesta');
  }
}
