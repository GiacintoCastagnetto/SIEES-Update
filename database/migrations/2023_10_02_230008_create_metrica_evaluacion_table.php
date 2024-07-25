<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMetricaEvaluacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metrica_evaluacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('metrica_evaluacion')->insert(
            [
                [
                    'nombre' => 'Escala de Likert',
                    'descripcion' => 'Permite conocer el nivel de acuerdo y desacuerdo de las personas sobre un tema.'
                ],
                [
                    'nombre' => 'Abierta',
                    'descripcion' => 'Respuesta libre.'
                ],
                [
                    'nombre' => 'Opción múltiple',
                    'descripcion' => 'Diversas opciones, sin ser parte de una escala.'
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metrica_evaluacion');
    }
}
