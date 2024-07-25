<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Encuesta;
use App\Models\Pregunta;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    // Recuperar datos de la sesión
    $url = $request->session()->get('url');
    $status = $request->session()->get('status');

    // Limpiar datos de la sesión después de recuperarlos
    $request->session()->forget(['url', 'status', 'preguntas']);

    // Resto del código para cargar las preguntas y mostrar la vista
    $preguntas = Pregunta::all();
    return view('home', compact('url', 'status', 'preguntas'));
  }

  public function generaUrl(Request $request){
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'preguntas' => 'required|array|min:1',
        // Validar el número de encuestas
        'numeroEncuestas' => 'required|integer|min:1',  
        'titulo' => 'required|string|min:1|max:255',
        'descripcion' => 'required|string|min:1|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->route('home')->withErrors($validator)->withInput();
    }

    // Obtén el número de encuestas desde la solicitud
    $numeroEncuestas = $request->input('numeroEncuestas');

    // Array para almacenar los enlaces generados
    $urls = []; 
   
    // Crea múltiples encuestas y enlaces
    for ($i = 0; $i < $numeroEncuestas; $i++) {
        $encuesta = new Encuesta();
        $encuesta->token_encuesta = Str::random(32);
        $encuesta->nombre = $request->input('nombre') ?? "";
        $encuesta->empresa = $request->input('empresa') ?? "";
        $encuesta->puesto = $request->input('puesto') ?? "";
        $encuesta->descripcion = $request->input('descripcion') ?? "";
        $encuesta->titulo = $request->input('titulo') ?? "";

        $encuesta->save(); // Save the Encuesta to get an ID

        $encuesta->preguntas()->attach($request->input('preguntas'));

        $url = $encuesta->token_encuesta;

        // Aquí puedes hacer algo con el enlace, por ejemplo, almacenarlo o mostrarlo
        // Puedes almacenar los enlaces en una base de datos, en un array, o enviarlos por correo electrónico, dependiendo de tus necesidades.
        // Ejemplo: guardar los enlaces en un array
        $urls[] = $url;
    }

    $request->session()->flash('status', "Se han generado la(s) $numeroEncuestas  encuesta(s) con éxito");
    $request->session()->flash('urls', $urls);

   // dd(compact('urls', 'request'));
    // Redirigir a la página principal
    return redirect()->route('home');
  }

  public function resultadoEncuesta(Request $request, $id)
  {
    $encuesta = Encuesta::find($id);
    return view('resultado', ['encuesta' => $encuesta]);
  }

  public function resultadoPregunta(Request $request, $id)
  {
    $pregunta = Pregunta::find($id);
    return view('resultado_pregunta', ['pregunta' => $pregunta]);
  }
}
