<?php

namespace App\Http\Controllers;

use App\Models\PreguntaEncuesta;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Pregunta;
use App\Models\Encuesta;
use App\Models\Respuesta;
use App\Models\RespuestaEncuesta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiRestController extends Controller
{
  public function listaPregunta(Request $request)
  {
    return Datatables::of(
      DB::select(
        'SELECT
            p.id, p.pregunta, a.area, t.tema, me.nombre AS metrica_evaluacion, COUNT(pe.id) AS numero_respuestas
        FROM
            pregunta p
        INNER JOIN area a ON p.id_area = a.id
        INNER JOIN tema t ON p.id_tema = t.id
        INNER JOIN metrica_evaluacion me ON p.id_metrica_evaluacion = me.id
        LEFT JOIN pregunta_encuesta pe ON p.id = pe.pregunta_id
        GROUP BY p.id, p.pregunta, a.area, t.tema, me.nombre'
      )
    )->toJson();
  }

  public function listaEncuesta(Request $request)
  {
    return Datatables::of(Encuesta::getAllEncuestasWithDetails())->toJson();
  }


  public function preguntasEncuesta(Request $request)
  {
    $preguntas = Encuesta::find($request->id_encuesta)->preguntas()->get();

    $preguntas_with_details = [];

    foreach ($preguntas as $pregunta) {
      $preguntas_with_details[] = [
        'id' => $pregunta->id,
        'pregunta' => $pregunta->pregunta,
        'respuestas' => $pregunta->getRespuestaArray(),
        'area' => $pregunta->getNombreArea(),
        'tema' => $pregunta->getNombreTema(),
        'metricaEvaluacion' => $pregunta->getNombreMetricaEvaluacion(),
      ];
    }

    return Datatables::of($preguntas_with_details)->toJson();
  }

  /**
   * Return a question's answers.
   *
   * `id`, `employer`, `token_encuesta`, `respuesta`.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function listaRespuestaPregunta(Request $request)
  {
    $pregunta = Pregunta::find($request->id_pregunta);
    $encuestas = $pregunta->encuestas()->get();

    $encuestas_with_details = [];

    foreach ($encuestas as $encuesta) {
      $encuestas_with_details[] = [
        'id' => $encuesta->id,
        'empleador' => [
          'nombre' => $encuesta->nombre,
          'empresa' => $encuesta->empresa,
          'puesto' => $encuesta->puesto,
        ],
        'respuestas' => $encuesta->preguntas()->find($pregunta->id)->getRespuestaArray(),
        'fechas' => [
          'created_at' => $encuesta->created_at?->format('Y-m-d'),
          'updated_at' => $encuesta->updated_at?->format('Y-m-d'),
        ],
      ];
    }

    return Datatables::of($encuestas_with_details)->toJson();
  }

  public function agregaPregunta(Request $request)
  {
    $pregunta = new Pregunta();
    $pregunta->id_area = $request->area;
    $pregunta->id_tema = $request->tema;
    $pregunta->pregunta = $request->pregunta;
    $pregunta->save();

    return response()->json(
      array(
        "success" => true,
        "message" => "Guardado"
      ),
      200
    );
  }

  public function muestraPregunta(Request $request)
  {

    // Validate the request data
    $validator = Validator::make($request->all(), [
      'token_encuesta' => 'required|string',
    ]);

    if ($validator->fails()) {
      return redirect()->route('home')->withErrors($validator)->withInput();
    }

    $validated = $validator->validated();
    $token_encuesta = $validated['token_encuesta'];
    $encuesta = Encuesta::where('token_encuesta', $token_encuesta)->get()->first();

    [
      'nombre' => $nombre,
      'empresa' => $empresa,
      'puesto' => $puesto,
    ] = $encuesta;

    $empleador = [$nombre, $empresa, $puesto];

    // Verificar si los datos del encuestado han sido ingresados. Si hay cadenas
    // vacías en el arreglo, entonces no se han ingresado los datos.
    $hasRegistered = !in_array("", $empleador);

    if (!$hasRegistered) {
      // Route is `/encuesta/{token_encuesta}`, return its view.
      return view(
        'poll.poll',
        [
          "token_encuesta" => $token_encuesta,
          "success" => true,
          'hasRegistered' => $hasRegistered,
          'empleador' => $empleador,
        ]
      );
    }

    $preguntas = $encuesta->preguntasSinRespuesta()->get();
    $pregunta = $preguntas->first();

    dd([
      'encuestado' => $empleador,
      'hasRegistered' => $hasRegistered,
      'validated' => $validated,
      'encuesta' => $encuesta,
      'preguntas' => $preguntas,
      'pregunta' => $pregunta,
    ]);

    return response()->json(
      array(
        "success" => true,
        "pregunta" => $pregunta
      ),
      200
    );
  }

  public function siguientePreguntaHumanidades(Request $request)
  {
    $this->validate($request, [
      'id_pregunta' => 'required',
      'respuesta' => 'required',
      'token_encuesta' => 'required',
      'preguntas' => 'required',
    ]);


    $encuesta = Encuesta::where('token_encuesta', $request->token_encuesta)->first();
    if ($encuesta->realizado === 1) {
      return response()->json(
        array(
          "success" => false,
        ),
        200
      );
    }


    $respuesta = new Respuesta();
    $respuesta->id_pregunta = $request->id_pregunta;
    $respuesta->respuesta = $request->respuesta;
    $respuesta->save();

    $aux_respuesta = Respuesta::all();
    $id_respuesta = $aux_respuesta[count($aux_respuesta) - 1]->id;

    $enc_res = new RespuestaEncuesta();
    $enc_res->id_encuesta = $encuesta->id;
    $enc_res->id_respuesta = $id_respuesta;
    $enc_res->save();

    $pregunta = Pregunta::where('id_area', 2)
      ->whereNotIn('id', $request->preguntas)
      ->inRandomOrder()
      ->first();

    return response()->json(
      array(
        "success" => true,
        "pregunta" => $pregunta
      ),
      200
    );
  }

  public function siguientePregunta(Request $request)
  {

    $this->validate($request, [
      'id_pregunta' => 'required',
      'tema' => 'required',
      'respuesta' => 'required',
      'token_encuesta' => 'required',
      'preguntas' => 'required'
    ]);

    $encuesta = Encuesta::where('token_encuesta', $request->token_encuesta)->first();
    if ($encuesta->realizado === 1) {
      return response()->json(
        array(
          "success" => false,
        ),
        200
      );
    }


    if ($request->id_pregunta == -1) {
      $pregunta = Pregunta::where("id_tema", $request->tema)->where("id_area", 1)->inRandomOrder()->first();
      return response()->json(
        array(
          "success" => true,
          "pregunta" => $pregunta
        ),
        200
      );
    }

    $respuesta = new Respuesta();
    $respuesta->id_pregunta = $request->id_pregunta;
    $respuesta->respuesta = $request->respuesta;
    $respuesta->save();

    $aux_respuesta = Respuesta::all();
    $id_respuesta = $aux_respuesta[count($aux_respuesta) - 1]->id;

    $enc_res = new RespuestaEncuesta();
    $enc_res->id_encuesta = $encuesta->id;
    $enc_res->id_respuesta = $id_respuesta;
    $enc_res->save();

    $pregunta = RespuestaEncuesta::where("id_encuesta", $encuesta->id)->get();

    if ($pregunta->count() === 9) {
      $encuesta->realizado = 1;
      $encuesta->save();
      return response()->json(
        array(
          "success" => true,
          "pregunta" => null
        ),
        200
      );
    }

    $pregunta = Pregunta::where('id_area', 1)
      ->where("id_tema", $request->tema)
      ->whereNotIn('id', $request->preguntas)
      ->inRandomOrder()
      ->first();

    return response()->json(
      array(
        "success" => true,
        "pregunta" => $pregunta
      ),
      200
    );
  }
}
