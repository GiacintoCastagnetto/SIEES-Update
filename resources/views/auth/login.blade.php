{{-- Todas las partes donde comento cuidado al modificar se puede modificar el estilo pero tener cuidado con la accion
--}}

@extends('layouts.app')

@section('content')
  <div class="container">
    
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header" style="text-align: center;margin: 0;padding: 0;">
            <img class="responsive-img" width="100%"
              src="{{ asset('img/FotoCabeza.jpg') }}" alt="">
          </div>

          <div class="card-body">
            {{-- Cuidado con modificar la ruta action --}}
            <form method="POST" action="{{ route('login') }}">
              {{-- No mover lo que dice csrf --}}
              @csrf

              <div class="form-group row">
                <label for="email"
                  class="col-md-4 col-form-label text-md-right">Correo
                  electrónico</label>

                <div class="col-md-6">
                  {{-- Cuidado con modificar las validaciones y errores en el input mail --}}
                  <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required
                    autocomplete="email" autofocus>

                  {{-- Cuidado con modificar mensaje de error --}}
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password"
                  class="col-md-4 col-form-label text-md-right">Contraseña</label>

                <div class="col-md-6">
                  {{-- Cuidado con modificar las validaciones y errores en el input --}}
                  <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                  {{-- Cuidado con modificar mensaje de error --}}
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              {{-- Esto no es tan importante --}}
              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                      name="remember" id="remember"
                      {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                      Recuérdame
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary"
                    style="background-color: rgb(44, 102, 110);border-color: #2c666e;">
                    Iniciar sesión
                  </button>
                  {{-- Cuidado con modificar este codigo --}}
                  @if (Route::has('password.request'))
                    <a class="btn btn-link" style="color: #2c666e;"
                      href="{{ route('password.request') }}">
                      ¿Olvidaste tu contraseña?
                    </a>
                  @endif
                </div>
              </div>
            </form>
          </div>
          <footer class="card-footer">
            <div class="description">
              Desarrollado por los alumnos de <i><a href="https://www.ingenieria.uaslp.mx/CienciasComputacion/Paginas/Oferta-Academica/4453">Ingeniería en Sistemas Inteligentes</a></i> 
              <div>
              <a href="https://www.jacobflores.dev/" target="_blank">Francisco Jacob Flores Rodríguez</a>
              |
              <a href="https://www.linkedin.com/in/hectorgamezgonzalez/" target="_blank">Héctor Gámez González</a>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
  </div>
@endsection

<style>
  .description {
    text-align: center
  }
</style>