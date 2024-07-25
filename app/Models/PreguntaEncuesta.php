<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PreguntaEncuesta  extends Pivot
{
  use HasFactory;

  protected $table = 'pregunta_encuesta';
  protected $primaryKey = 'id';
  protected $fillable = [
    'pregunta_id',
    'encuesta_id',
    'respuesta'
  ];
  public $timestamps = true;
}
