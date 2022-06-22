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

  <title>@yield('title') | Encuentra Pianista</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />

  <!-- Styles -->
  <link href="../../css/app.css" rel="stylesheet">
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

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-1CXB93E84K"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-1CXB93E84K');
  </script>
  <script type="text/javascript" src="https://cookieconsent.popupsmart.com/src/js/popper.js"></script>
  <script>
    window.start.init({Palette:"palette2",Mode:"banner bottom",Theme:"classic",Message:"Esta web usa cookies que han de ser aceptadas para su correcto funcionamiento.",ButtonText:"Aceptar",LinkText:"Leer más",Location:"https://blog.encuentrapianista.com/politica-de-cookies/",Time:"0",})
  </script>

  @yield('scripts')

</head>

<body style="position:relative;">
  <div class="preloader bubblingG"
    style="margin:0px; padding:0px; width:100%; min-height:100vh; position: absolute; background:#fff!important; z-index:9999999;">
    <p style="position: absolute; top:45%; left:50%; transform: translate(-50%, -50%);">Encuentra Pianista...</p>
    <span id="bubblingG_1" style="position: absolute; top:50%; left:48.8%; transform: translate(-50%, -50%);">
    </span>
    <span id="bubblingG_2" style="position: absolute; top:50%; left:50%; transform: translate(-50%, -50%);">
    </span>
    <span id="bubblingG_3" style="position: absolute; top:50%; left:51.2%; transform: translate(-50%, -50%);">
    </span>
  </div>
  <header style="background: transparent;">
    <nav>
      <a href="{{route('home')}}">
        <img src="{{url('assets')}}/images/logo.png" class="main-logo"/>
      </a>
      @if(Auth::user())
      <ul class="nav navbar-nav ms-auto">
        <li class="nav-item">
          <a href="https://blog.encuentrapianista.com/" target="_blank" class="nav-link">
            Blog <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </a>
        </li>
        <li class="dropdown nav-item" style="list-style: none; margin-top:-2px; position:relative; cursor: pointer;">
          <i style="font-size:18px; color: #fff;" class="fa-solid fa-bell dropdown-toggle"
            data-bs-toggle="dropdown"></i>
          @php $pending = \App\Models\Notification::where('user_id', Auth::user()->id)->where('read', 0)->count();
          @endphp
          @if($pending > 0)
          <span
            style="position: absolute; top: 10%; right: 0; width:7px; height:7px; background:red; border-radius:9999px;"></span>
          @endif
          <style>
            .dropdown-menu {
              min-width: 250px;
            }
          </style>
          <div class="dropdown-menu"
            style="font-size:13px; border:none; border-radius:20px; padding:15px; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px!important;">
            <span class="mt-2 d-block text-center">Notificaciones</span>
            <hr>

            @if(count(Auth::user()->notifications)>0)
            <small class="float-right"><a style="color:#000;" href="{{route('notification.deleteAll')}}">Borrar
                todas</a></small>
            <br>
            <br>
            @foreach (\Auth::user()->notifications as $notif)
            @if($notif->read != 1)
            <div class="text-center w-100 mb-3"
              style="position: relative; box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
              @else
              <div class="text-center w-100 mb-3" style="position: relative; background:#ccc;">
                @endif
                <a href="{{route('notification.markAsRead', ['id' => \Crypt::encryptString($notif->id)])}}"
                  style="color:#000; cursor: pointer; line-height:50px;">{{$notif->text}}</a>
                <a href="{{route('notification.delete', ['id' => \Crypt::encryptString($notif->id)])}}"
                  style="color:red; position: absolute; top:5%; right: 5%; font-size:18px;"><i
                    class="fa-solid fa-xmark"></i></a>
                @if($notif->read == 1)
                <small style="position: absolute; top:5%; left: 5%;">Leído</small>
                @endif
              </div>
              @endforeach
              @else
              <p class="w-100 text-center mt-4">Aún no tienes notificaciones :)</p>
              @endif
            </div>
        </li>
        <li class="nav-item dropdown dropdown-user">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="border:none !important">
            @if(Auth::user()->image)

            <div style="width:45px; height:45px; position: relative;">
              <img src="{{url('/mi-perfil/get-image/'.Auth::user()->image)}}" alt="Encuentra Pianista avatar"
                class="rounded-circle" width="45" height="45" />
              @if(Auth::user()->verified)
              <span
                style="font-size:13px; z-index:9999; position: absolute; top: 0; right: 0; width: 20px; height: 20px; background:#000; border-radius:999px; text-align:center; color:#fff;">#</span>
              @endif
            </div>
            @else
            <div style="width:45px; height:45px; position: relative;">
              <img src="{{url('assets')}}/images/user.png" alt="Encuentra Pianista avatar" class="rounded-circle"
                width="45" height="45" />
              @if(Auth::user()->verified)
              <span
                style="font-size:13px; z-index:9999; position: absolute; top: 0; right: 0; width: 20px; height: 20px; background:#000; border-radius:999px; text-align:center; color:#fff;">#</span>
              @endif
            </div>
            @endif
          </a>
          <div class="dropdown-menu dropdown-menu-end"
            style="border:none; border-radius: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            <small class="text-center d-block">
              ¡Bienvenido
              <b>{{\Auth::user()->name}}</b>!
              @if(Auth::user()->getRoleNames()[0] == "pianista-premium")
              <span>- PREMIUM</span>
              @endif
            </small>
            <div class="dropdown-divider"></div>
            @if(\Auth::user()->getRoleNames()[0] == "pianista-premium")
            <a href="{{route('configuration_premium.index')}}" class="dropdown-item">Datos de tu cuenta premium</a>
            <div class="dropdown-divider"></div>
            @endif
            @if(\Auth::user()->getRoleNames()[0] == "pianista")
            <a href="{{route('configuration_premium.index')}}" class="dropdown-item">Hazte Premium</a>
            <div class="dropdown-divider"></div>
            @endif
            @if(\Auth::user()->getRoleNames()[0] != "cliente")
            <a href="{{route('configuration_professor.index')}}" class="dropdown-item">Cuenta de pianista</a>
            <div class="dropdown-divider"></div>
            @endif
            <a href="{{route('contact_request.index')}}" class="dropdown-item">Solicitudes de contacto</a>
            <div class="dropdown-divider"></div>
            @if(\Auth::user()->getRoleNames()[0] != "cliente")
            <a href="{{route('user.profile', ['username' => Auth::user()->username])}}" class="dropdown-item">Ver mi
              perfil</a>
            @endif
            <a href="{{route('user.index')}}" class="dropdown-item">Mi cuenta</a>
            {{--<a href="{{route('configuration.index')}}" class="dropdown-item">Configuración</a>--}}
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
      </ul>
      @else
      <ul>
        <li class="nav-item">
          <a href="https://google.es" class="nav-link blog-link">
            Blog <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="{{route('register.index', ['rol' => 'pianista-premium'])}}" class="nav-link nav-link-styles">
            Soy pianista
          </a>
        </li> --}}
        <li><a href="{{route('login')}}" class="nav-link nav-link-styles">Iniciar sesión</a></li>
      </ul>
      @endif
    </nav>
  </header>
  <main class="py-4">
    @include('partials.msg')
    <div class="content" style="margin-top: 80px;">
      @yield('content')
    </div>
  </main>
  <footer>
    <div class="policy mt-3">
      <a href="https://blog.encuentrapianista.com/politica-de-cookies/" target="_blank">Política de Cookies</a>
      <a href="https://blog.encuentrapianista.com/politica-privacidad/" target="_blank">Política de Privacidad</a>
      <a href="https://blog.encuentrapianista.com/condiciones-generales-de-uso/" target="_blank">Condiciones generales
        de uso</a>
      <a href="https://blog.encuentrapianista.com/faqs/" target="_blank">FAQs</a>
      <a href="https://blog.encuentrapianista.com/verifica-tu-perfil/" target="_blank">Proceso de Verificación</a>
      <a href="https://blog.encuentrapianista.com/contacta/" target="_blank">Atención al Cliente</a>
    </div>

    <div class="social mt-3 mb-3">
      <a href="https://blog.encuentrapianista.com/politica-de-cookies/" class="tw" target="_blank">d</a>
      <a href="https://blog.encuentrapianista.com/politica-de-cookies/" class="fb" target="_blank">c</a>
      <a href="https://blog.encuentrapianista.com/politica-de-cookies/" class="insta" target="_blank">f</a>
    </div>
  </footer>
  @yield('js')
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {
          document.querySelector('.preloader').style.display = 'none';
      });
  </script>
</body>

</html>