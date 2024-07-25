<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pregunta;

class UpdatePreguntasSeeder extends Seeder
{
    // Constante para representar el ID de la métrica de escala de Likert.
    const ESCALA_LIKERT_ID = 1;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            // Actualizar todas las preguntas para que tengan id_metrica_evaluacion igual a la constante.
            Pregunta::query()->update(['id_metrica_evaluacion' => self::ESCALA_LIKERT_ID]);

            $this->command->info('Actualización exitosa.');
        } catch (\Exception $e) {
            $this->command->error('Error al actualizar las preguntas: ' . $e->getMessage());
        }
    }
}
