<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>SIEES</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/main.js') }}" defer></script>

  <script src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

  {{-- Bootstrap --}}
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous">
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  {{-- Datatables --}}
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">
  </script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js">
  </script>
  <script
    src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
  </script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
  </script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
  </script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js">
  </script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js">
  </script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <link
    href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css"
    rel="stylesheet">
  <link
    href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"
    rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  {{-- @vite('resources/css/app.css') --}}
</head>

<body>
  <div id="app">
    <div class="navigation">

      <ul>
        <li class="list perfil dropdown">
          <a class="dropdown-toggle d-flex align-items-center" href="#"
            role="button" data-bs-toggle="dropdown" style="color:#333333">
            <svg xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-user-square-rounded"
              width="24" height="24" viewBox="0 0 24 24"
              stroke-width="1.5" stroke="currentColor" fill="none"
              stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
              <path
                d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
              <path d="M6 20.05v-.05a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.05" />
            </svg>
            <div class="d-flex flex-column">
              <span class="title">
                {{ Auth::user()->name }}
              </span>
              <span class="email">
                {{ Auth::user()->email }}
              </span>
            </div>
          </a>

          <form action="{{ route('logout') }}" method="POST"
            class="dropdown-menu rounded-5 overflow-hidden p-0">
            @csrf
            <button type="submit"
              class="dropdown-item fw-bold d-flex align-items-center gap-2 py-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                <path d="M15 12h-12l3 -3" />
                <path d="M6 15l-3 -3" />
              </svg>
              Cerrar sesión
            </button>
          </form>
        </li>
        <li class="list {{ Request::is('/') ? 'active' : '' }}">
          <b></b>
          <a href="{{ route('home') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
              width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
              stroke="currentColor" fill="none" stroke-linecap="round"
              stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path
                d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18" />
              <path d="M13 8l2 0" />
              <path d="M13 12l2 0" />
            </svg>
            <span class="title">Home</span>
          </a>
        </li>
        <li class="list {{ Request::is('preguntas') ? 'active' : '' }}">
          <b></b>
          <a href="{{ route('preguntas.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
              width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
              stroke="currentColor" fill="none" stroke-linecap="round"
              stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M8 9h8" />
              <path d="M8 13h6" />
              <path
                d="M14.5 18.5l-2.5 2.5l-3 -3h-3a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
              <path d="M19 22v.01" />
              <path
                d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
            </svg>
            <span class="title">Agregar pregunta</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="toggle">
      <svg xmlns="http://www.w3.org/2000/svg" class="open" width="24"
        height="24" viewBox="0 0 24 24" stroke-width="2"
        stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 6l16 0" />
        <path d="M4 12l16 0" />
        <path d="M4 18l16 0" />
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" class="icon close"
        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
        stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 6h16" />
        <path d="M7 12h13" />
        <path d="M10 18h10" />
      </svg>
    </div>

    <main class="py-4">
      <div class="container">
        @yield('content')
      </div>
    </main>
  </div>

</body>

@stack('scripts')

</html>
