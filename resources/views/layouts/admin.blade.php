<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Encuentra a tu pianista de confianza ;)">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | Acompañarte</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />

  <!-- Styles -->
  <link href="../../css/app.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="{{url('assets')}}/images/Searchs_004.webp">
  <link rel="shortcut icon" sizes="192x192" href="{{url('assets')}}/images/Searchs_004.webp">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="{{url('assets')}}/css/all.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.20.0/dist/bootstrap-table.min.css">
  @yield('css')


  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>

  <script src="https://unpkg.com/bootstrap-table@1.20.0/dist/bootstrap-table.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.20.0/dist/locale/bootstrap-table-es-ES.min.js"></script>
  @yield('scripts')

</head>

<body>
  <header style="background: transparent;">
    <nav>
      <a href="{{route('home')}}">
        <h1>Acompañarte</h1>
      </a>
      <ul class="nav navbar-nav ms-auto">
        <li class="nav-item" style="margin-top:-4px; color:#e8b210;">ADMINISTRADOR </li>
        <li class="nav-item dropdown dropdown-user">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            @if(Auth::user()->image)
            <img src="{{url('mi-perfil/get-image/'.Auth::user()->image)}}" alt="Acompañarte avatar"
              class="rounded-circle" width="40" />
            @else
            <img src="{{url('assets')}}/images/user.png" alt="Acompañarte avatar" class="rounded-circle" width="40" />
            @endif
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <small class="text-center d-block">¡Bienvenido <b>{{\Auth::user()->name}}</b>!</small>
            <div class="dropdown-divider"></div>
            <a href="{{route('dashboard.user')}}" class="dropdown-item">Todos los usuarios</a>
            <a href="{{route('dashboard.history')}}" class="dropdown-item">Historial de suscripciones</a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </nav>
  </header>
  <main class="py-4">
    @include('partials.msg')
    <div class="content">
      @yield('content')
    </div>
  </main>
  @yield('js')
</body>

</html>