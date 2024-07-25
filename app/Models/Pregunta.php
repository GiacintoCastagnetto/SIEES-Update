<?php

namespace App\Models;

use App\Models\Area;
use App\Models\MetricaEvaluacion;
use App\Models\Tema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
  use HasFactory;
  protected $table = 'pregunta';
  protected $primaryKey = 'id';
  protected $connection = 'mysql';
  public $timestamps = true;
  public $incrementing = true;

  protected $fillable = [
    'id_area',
    'id_tema',
    'pregunta',
    'id_metrica_evaluacion',
    'opciones'
  ];

  /**
   * Receives an array of strings and returns a string with the values separated
   * by `;`.
   *
   * @param array $opciones Array of strings
   * @return string
   *
   * @example - `['a', 'b', 'c']` will return `'a;b;c'`.
   */
  public static function transformOpcionesArrayToString($opciones = [])
  {
    return implode(';', $opciones);
  }

  public function getRespuestaToBeStored($respuesta)
  {
    if ($this->isMultipleChoice()) {
      return self::transformOpcionesArrayToString($respuesta);
    }

    return $respuesta;
  }

  public function getRespuestaArray()
  {
    $respuesta = $this->pivot->respuesta;

    if (!$respuesta) return [];

    return $this->isMultipleChoice() ? explode(';', $respuesta) : [$respuesta];
  }

  public function getOpciones()
  {
    if ($this->isLikert()) {
      return [
        'Totalmente en desacuerdo',
        'En desacuerdo',
        'Ni de acuerdo ni en desacuerdo',
        'De acuerdo',
        'Totalmente de acuerdo',
      ];
    }

    if ($this->isOpen()) {
      return [];
    }

    return explode(';', $this->opciones ?? '');
  }


  public function isLikert()
  {
    return $this->id_metrica_evaluacion === MetricaEvaluacion::LIKERT_METRIC_ID;
  }

  public function isOpen()
  {
    return $this->id_metrica_evaluacion === MetricaEvaluacion::OPEN_METRIC_ID;
  }

  public function isMultipleChoice()
  {
    return $this->id_metrica_evaluacion === MetricaEvaluacion::MULTIPLE_CHOICE_METRIC_ID;
  }


  public function metrica_evaluacion()
  {
    return $this->hasOne(MetricaEvaluacion::class, 'id', 'id_metrica_evaluacion');
  }

  public function getNombreMetricaEvaluacion()
  {
    return $this->metrica_evaluacion->nombre;
  }

  public function area()
  {
    return $this->belongsTo(Area::class, 'id_area');
  }

  public function getNombreArea()
  {
    return $this->area->area;
  }
  public function tema()
  {
    return $this->belongsTo(Tema::class, 'id_tema');
  }
  public function getNombreTema()
  {
    return $this->tema->tema;
  }

  public function encuestas()
  {
    return $this->belongsToMany(Encuesta::class, 'pregunta_encuesta', 'pregunta_id', 'encuesta_id');
  }
}
