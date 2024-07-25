<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaEncuesta extends Model
{
  use HasFactory;
  protected $table = 'respuesta_encuesta';
  protected $primaryKey = 'id';
  protected $connection = 'mysql';
  public $timestamps = true;
  public $incrementing = false;


  protected $fillable = [
    'id_encuesta',
    'id_respuesta'
  ];
}
