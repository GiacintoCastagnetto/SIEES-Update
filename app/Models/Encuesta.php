<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
  use HasFactory;
  protected $table = 'encuesta';
  protected $primaryKey = 'id';
  protected $connection = 'mysql';
  public $timestamps = true;
  public $incrementing = true;


  protected $fillable = [
    'id',
    'token_encuesta',
    'nombre',
    'empresa',
    'puesto',
    'realizado',
    'titulo',
    'descripcion',
  ];

  public static function getEncuestaByToken($token)
  {
    return Encuesta::where('token_encuesta', $token)->first();
  }

  public function getTotalPreguntas()
  {
    return $this->preguntas()->count();
  }

  public function getPreguntasRespondidas()
  {
    return $this->getTotalPreguntas() - $this->preguntasSinRespuesta()->count();
  }

  public function getEmpleador()
  {
    return [
      'nombre' => $this->nombre,
      'empresa' => $this->empresa,
      'puesto' => $this->puesto,
    ];
  }

  public function hasRegistered()
  {
    // Verificar si los datos del empleador han sido ingresados. Si hay cadenas
    // vacías en el arreglo, entonces no se han ingresado los datos.
    return !in_array("", $this->getEmpleador());
  }

  public function hasBeenAnswered()
  {
    return $this->preguntasSinRespuesta()->count() === 0;
  }


  public function getStatusLabels()
  {
    $badges = [];


    $badges[] = $this->hasRegistered() ? [
      'text' => 'El usuario se ha registrado',
      'class' => 'text-bg-success'
    ] : [
      'text' => 'El usuario no se ha registrado',
      'class' => 'text-bg-warning'
    ];

    if ($this->getTotalPreguntas() === 0) {
      $badges[] = [
        'text' => 'No hay preguntas',
        'class' => 'text-bg-danger'
      ];

      return $badges;
    }

    $badges[] = $this->hasBeenAnswered() ? [
      'text' => 'Realizada',
      'class' => 'text-bg-success'
    ] : [
      'text' => "Pendiente ({$this->getPreguntasRespondidas()}/{$this->getTotalPreguntas()})",
      'class' => 'text-bg-warning'
    ];

    return $badges;
  }

  public function getDetailsOfEncuesta()
  {
    return [
      ...$this->toArray(),
      'preguntas' => [
        'total' => $this->getTotalPreguntas(),
        'respondidas' => $this->getPreguntasRespondidas(),
      ]
    ];
  }

  public static function getEncuestaWithDetails($id)
  {
    return Encuesta::find($id)->getDetailsOfEncuesta();
  }

  public static function getAllEncuestasWithDetails()
  {
    $encuestas = Encuesta::all();

    $encuestasWithDetails = [];

    foreach ($encuestas as $encuesta) {
      $encuestasWithDetails[] = $encuesta->getDetailsOfEncuesta();
    }

    return $encuestasWithDetails;
  }


  public function preguntas()
  {
    return $this->belongsToMany(Pregunta::class, 'pregunta_encuesta')->using(PreguntaEncuesta::class)->withPivot('respuesta');
  }

  public function siguientePregunta()
  {
    return $this->preguntasSinRespuesta()->first();
  }

  public function preguntasSinRespuesta()
  {
    return $this->preguntas()->wherePivotNull('respuesta');
  }
}
