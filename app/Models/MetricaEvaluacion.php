<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetricaEvaluacion extends Model
{
  use HasFactory;
  protected $table = 'metrica_evaluacion';
  protected $primaryKey = 'id';
  protected $connection = 'mysql';
  public $timestamps = true;
  public $incrementing = true;

  protected $fillable = [
    'nombre',
    'descripcion'
  ];

  const LIKERT_METRIC_ID = 1;
  const OPEN_METRIC_ID = 2;
  const MULTIPLE_CHOICE_METRIC_ID = 3;

  public function preguntas()
  {
    return $this->hasMany(Pregunta::class, 'id_metrica_evaluacion', 'id');
  }
}
