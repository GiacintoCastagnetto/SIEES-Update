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

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  {{-- @vite('resources/css/app.css') --}}
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md shadow-sm"
      style="background-color: rgba(10,10,10,255)">


      <div class="container"
        style="text-align: center; display: block !important">
        <a class="navbar-brand" style="text-align:center"
          href="{{ url('/') }}">

          <!--img class="responsive-img" width="100%" style="margin: auto;width: 400px;"
                        src="{{ asset('img/siaee.jpeg') }}" alt=""-->

          <img class="responsive-img" width="100%"
            style="margin: auto;width: 350px;"
            src="{{ asset('img/LogoSIEES.jpg') }}" alt="">
          <!--Nuevo Logo por cambio de nombre a SIEES, anteriormente SIAEE -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
  </div>
</body>

</html>
