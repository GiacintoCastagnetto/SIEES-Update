@extends('layouts.encuesta')

@section('content')
  <div class="container">
    <div class="banner">
      <img class="responsive-img" src="{{ asset('img/uaslp.png') }}"
        alt="Logo UASLP">
    </div>
    <div class="card">
      <div class="text-align: center !important;">
        <h1>Encuesta empleadores</h1>
      </div>

      @if ($errors->any())
        <div class="errors">
          <ul class="d-flex list-unstyled gap-2">
            @foreach ($errors->all() as $error)
              <li class="alert alert-danger m-0">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if (!$hasAnswered)
        <form action="{{ route('encuestas.store') }}" method="POST">
          @csrf
          <input type="text" name="token_encuesta"
            value="{{ $token_encuesta }}" hidden>

          <!-- Si aún no ha ingresado sus datos completos -->
          @if (!$hasRegistered)
            <div id="state">
              <div class="row">
                <div class="col s12 m4 l2"></div>
                <div class="col s12 m4 l8">
                  <div>
                    <p>Nombre del empleador:</p>
                    <p>
                      <label>
                        <input name="nombre_empleador" id="nombre"
                          type="text"
                          value="{{ $empleador['nombre'] ?? '' }}" />
                      </label>
                    </p>
                    <p>Nombre de la empresa:</p>
                    <p>
                      <label>
                        <input name="empresa" id="empresa" type="text"
                          value="{{ $empleador['empresa'] ?? '' }}" />
                      </label>
                    </p>
                    <p>Puesto del empleador:</p>
                    <p>
                      <label>
                        <input name="puesto" id="puesto" type="text"
                          value="{{ $empleador['puesto'] ?? '' }}" />
                      </label>
                    </p>
                  </div>
                </div>
                <div class="col s12 m4 l2"></div>
              </div>
              <!-- Agregr aqui para descargar el plan de estudios-->
              <h6> ¿Desea ver el plan de estudios antes de comenzar? </h6>
              <a href={{ url('plan-de-estudios/PE_ISI-nov-2023.pdf') }}
                target="_blank">
                Descargar plan de estudios ISI
              </a>
            </div>

            <!-- De lo contrario, mostrar cada pregunta. -->
          @else
            <div class="row">
              <div class="col s12 m4 l2"></div>
              <div class="col s12 m4 l8">
                <input type="text" hidden value="{{ $pregunta->id }}"
                  name="pregunta">
                <div>
                  <p>{{ $pregunta->pregunta }}</p>
                </div>


                <!-- Opciones -->
                <div class="options">


                  @if ($pregunta->isLikert())
                    <p class="fw-bold mb-0">
                      {{ $pregunta->metrica_evaluacion->nombre }}
                    </p>
                    <p>{{ $pregunta->metrica_evaluacion->descripcion }}</p>
                    <label for="likert-select">Selecciona una opción del 1 al
                      7:</label>
                    <select name="respuesta" id="likert-select"
                      class="form-control">
                      @for ($i = 1; $i <= 7; $i++)
                        <option value="{{ $i }}">{{ $i }}
                        </option>
                      @endfor
                    </select>
                  @endif

                  <!--Si es opcion multiple -->
                  @if ($pregunta->isMultipleChoice())
                    <label>Selecciona una o más opciones</label>
                    <select name="respuesta[]" id="selectPreguntas"
                      class="form-control" multiple>
                      <!-- Opción predeterminada -->
                      @foreach ($opciones as $opcion)
                        <option value="{{ $opcion }}"> {{ $opcion }}
                        </option>
                      @endforeach
                    </select>
                  @endif

                  <!--Si es abierta -->
                  @if ($pregunta->isOpen())
                    <label>Escribe tu respuesta: Existe un limite de 255
                      caracteres</label>
                    <input type="text" autofocus name="respuesta"
                      class="form-control" minlength="1" maxlength="255">
                  @endif
                </div>
              </div>
              <div class="col s12 m4 l2"></div>
              <hr style="width: 70%">
            </div>
          @endif

          <div class="text-align: center !important;">
            <button type="submit" id="empezar"
              class="waves-effect waves-light btn-large">
              {{ $hasRegistered ? 'Siguiente' : 'Empezar' }}
            </button>
          </div>
        </form>

        <!-- Si ya se contestaron todas las preguntas, mostrar mensaje de agradecimiento. -->
      @else
        <div class="greetings">
          <h2>
            ¡Gracias por responder! ✅
          </h2>
          <p>La encuesta ha finalizado</p>
        </div>
      @endif
    </div>
  </div>

  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    rel="stylesheet">
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js">
  </script>
  <script>
    $(document).ready(function() {
      $('#selectPreguntas').select2();
    });
  </script>
@endsection

<style>
  .errors {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 1rem;

    & li {
      list-style: none;
      padding: 1rem;
      border-radius: .25rem;
      border: solid 2px red;
      background-color: #f8d7da;
    }
  }

  .select2 {
    width: 100% !important;
  }

  .options {
    display: flex;
    flex-direction: column;
    gap: .5rem;

    & input {
      border-bottom: solid 1px lightgrey !important;
      width: 100% !important;
    }
  }

  select {
    display: block !important;
    height: auto !important;
  }

  .container {
    padding: 1rem 1rem 2rem;
    margin: auto;
    min-height: 100vh;
    /* flex column */
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 1.5rem;
  }

  .card {
    padding: 2rem;
    /* display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center; */
  }

  .banner {
    text-align: center;
    width: 100%;

    & img {
      width: 100%;
      max-width: 300px !important;
    }
  }

  h1 {
    font-weight: 900;
  }

  .greetings {
    text-align: center;
  }

  h2 {
    font-weight: 900;
    font-size: 1.75rem !important;
    margin: 0 !important;
  }

  p {
    font-size: 1.25rem;
  }
</style>
