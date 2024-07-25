<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePreguntaRequest;
use App\Http\Requests\UpdatePreguntaRequest;
use App\Models\Tema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PreguntaController extends Controller
{
  const COMPUTER_SCIENCE_AREA_ID = 1;
  const MULTIPLE_CHOICE_METRIC_ID = 3;

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $metrics = DB::select('select * from metrica_evaluacion');
    $tema = Tema::all()->where("id_area", self::COMPUTER_SCIENCE_AREA_ID);

    return view('poll.addquestion', [
      'temas' => $tema,
      'metrics' => $metrics
    ]);
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
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StorePreguntaRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StorePreguntaRequest $request)
  {
    $isMultipleChoice = $request->input('metrica') == self::MULTIPLE_CHOICE_METRIC_ID;
    // Validate 'opciones' as an array only if 'metrica' is MULTIPLE_CHOICE_METRIC_ID
    $opcionesValidator = $isMultipleChoice ? 'array' : '';

    $validator = Validator::make($request->all(), [
      'pregunta' => 'required',
      'tema' => 'required|numeric',
      'metrica' => 'required|numeric',
      'opciones' => $opcionesValidator,
    ], [
      'pregunta.*' => 'Ingresa una pregunta',
      'tema.*' => 'Selecciona un tema',
      'metrica.*' => 'Selecciona una métrica de evaluación',
      'opciones.array' => 'Se requiere al menos una opción para la pregunta',
    ]);

    if ($validator->fails()) {
      return redirect()
        ->route('preguntas.index')
        ->withErrors($validator)
        ->withInput();
    }

    $validated = $validator->validated();


    $pregunta = new Pregunta();

    $pregunta->id_tema = $validated['tema'];
    $pregunta->id_metrica_evaluacion = $validated['metrica'];
    $pregunta->pregunta = $validated['pregunta'];
    $pregunta->id_area = self::COMPUTER_SCIENCE_AREA_ID;

    // Save the opciones string to the 'opciones' field in the database only if 'metrica' is MULTIPLE_CHOICE_METRIC_ID
    if ($isMultipleChoice) {
      // If 'metrica' is not MULTIPLE_CHOICE_METRIC_ID, set opcionesString to
      // null or an empty string
      $pregunta->opciones = Pregunta::transformOpcionesArrayToString($validated['opciones']);
    }

    $pregunta->save();

    $request->session()->flash('status', 'Pregunta agregada correctamente');

    // Redirect to a different route after storing the question
    return redirect()->route('preguntas.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Pregunta  $pregunta
   * @return \Illuminate\Http\Response
   */
  public function show(Pregunta $pregunta)
  {
    return view('resultado_pregunta', ['pregunta' => $pregunta]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Pregunta  $pregunta
   * @return \Illuminate\Http\Response
   */
  public function edit(Pregunta $pregunta)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdatePreguntaRequest  $request
   * @param  \App\Models\Pregunta  $pregunta
   * @return \Illuminate\Http\Response
   */
  public function update(UpdatePreguntaRequest $request, Pregunta $pregunta)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Pregunta  $pregunta
   * @return \Illuminate\Http\Response
   */
  public function destroy(Pregunta $pregunta)
  {
    //
  }
}
