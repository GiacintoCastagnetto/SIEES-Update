<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEncuestaRequest;
use App\Http\Requests\UpdateEncuestaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EncuestaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store or update employer details in the given Encuesta.
   *
   * @param  \App\Models\Encuesta  $encuesta
   * @param  array  $validatedData
   * @return void
   */
  private function storeOrUpdateEmployerDetails(Encuesta $encuesta, array $validatedData)
  {
    $encuesta->nombre = $validatedData['nombre_empleador'] ?? "";
    $encuesta->empresa = $validatedData['empresa'] ?? "";
    $encuesta->puesto = $validatedData['puesto'] ?? "";
    $encuesta->save();
  }

  /**
   * Handle storing question responses in the given Encuesta.
   *
   * @param  \App\Models\Encuesta  $encuesta
   * @param  array  $validatedData
   * @return void
   */
  private function storeQuestionResponse(Encuesta $encuesta, array $validatedData)
  {
    $pregunta = Pregunta::find($validatedData['pregunta']);

    $respuesta = $pregunta->getRespuestaToBeStored($validatedData['respuesta']);
    $encuesta->preguntas()->updateExistingPivot($pregunta->id, ['respuesta' => $respuesta]);

    $encuesta->save();
  }

  private function validateQuestionResponse(
    StoreEncuestaRequest $request,
    Encuesta $encuesta
  ) {
    $employee_rules = [
      'nombre_empleador' => 'nullable|string',
      'empresa' => 'nullable|string',
      'puesto' => 'nullable|string',
    ];
    $answer_rules = [
      'pregunta' => 'required|integer',
      'respuesta' => 'required',
    ];


    // Se espera el registro de un empleado o la respuesta a una pregunta.
    $validator_rules = $encuesta->hasRegistered() === false
      ? $employee_rules : $answer_rules;

    return Validator::make($request->all(), $validator_rules);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreEncuestaRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreEncuestaRequest $request)
  {
    $token_encuesta = $request->input('token_encuesta');
    $encuesta = Encuesta::where('token_encuesta', $token_encuesta)->first();

    $validator = $this->validateQuestionResponse($request, $encuesta);

    if ($validator->fails()) {
      return redirect()
        ->route('encuesta', $token_encuesta)
        ->withErrors($validator)
        ->withInput();
    }

    if (!$encuesta->hasRegistered()) {
      $this->storeOrUpdateEmployerDetails($encuesta, $validator->validated());
    } else {
      $this->storeQuestionResponse($encuesta, $validator->validated());
    }


    return redirect()->route('encuesta', ['token' => $token_encuesta]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Encuesta  $encuesta
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $token)
  {
    if (!$token) {
      return redirect()->route('home');
    }

    $encuesta = Encuesta::getEncuestaByToken($token);
    $hasAnswered = $encuesta->hasBeenAnswered();

    if ($hasAnswered) {
      return view(
        'poll.poll',
        [
          'hasAnswered' => $hasAnswered,
        ]
      );
    }

    $pregunta = $encuesta->siguientePregunta();
    $opciones = $pregunta->getOpciones();

    // Route is `/encuesta/{token_encuesta}`, return its view.
    return view(
      'poll.poll',
      [
        "token_encuesta" => $token,
        'hasRegistered' => $encuesta->hasRegistered(),
        'empleador' => $encuesta->getEmpleador(),
        'pregunta' => $pregunta,
        'hasAnswered' => $hasAnswered,
        'opciones' => $opciones,
      ]
    );
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Encuesta  $encuesta
   * @return \Illuminate\Http\Response
   */
  public function edit(Encuesta $encuesta)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateEncuestaRequest  $request
   * @param  \App\Models\Encuesta  $encuesta
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateEncuestaRequest $request, Encuesta $encuesta)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Encuesta  $encuesta
   * @return \Illuminate\Http\Response
   */
  public function destroy(Encuesta $encuesta)
  {
    //
  }
}
