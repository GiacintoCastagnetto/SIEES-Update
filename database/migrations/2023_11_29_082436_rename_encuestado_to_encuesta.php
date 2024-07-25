<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameEncuestadoToEncuesta extends Migration
{
  const E_TABLE_NAME = 'encuestado';
  const E_NEW_TABLE_NAME = 'encuesta';

  // Respuesta encuestado
  const RE_OLD_TABLE_NAME = 'respuesta_encuestado';
  const RE_OLD_FIELD_NAME = 'id_encuestado';
  const RE_NEW_TABLE_NAME = 'respuesta_encuesta';
  const RE_NEW_FIELD_NAME = 'id_encuesta';

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (Schema::hasTable(self::E_TABLE_NAME)) {
      Schema::rename(self::E_TABLE_NAME, self::E_NEW_TABLE_NAME);
    }
    Schema::table(self::E_NEW_TABLE_NAME, function (Blueprint $table) {
      $table->renameColumn('token_encuestado', 'token_encuesta');
    });

    if (!Schema::hasTable('respuesta_encuesta')) {
      Schema::rename('respuesta_encuestado', 'respuesta_encuesta');
    }
    Schema::table('respuesta_encuesta', function (Blueprint $table) {
      $table->renameColumn('id_encuestado', 'id_encuesta');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    if (Schema::hasTable(self::E_NEW_TABLE_NAME)) {
      Schema::rename(self::E_NEW_TABLE_NAME, self::E_TABLE_NAME);
    }
    Schema::table(
      self::E_NEW_TABLE_NAME,
      function (Blueprint $table) {
        $table->renameColumn('token_encuesta', 'token_encuestado');
      }
    );

    if (Schema::hasTable('respuesta_encuesta')) {
      Schema::rename('respuesta_encuesta', 'respuesta_encuestado');
    }
    Schema::table('respuesta_encuestado', function (Blueprint $table) {
      $table->renameColumn('id_encuesta', 'id_encuestado');
    });
  }
}
