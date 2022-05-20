@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center d-block">Iniciar sesión</h2>
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email *') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña *') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn">
                                    {{ __('Iniciar sesión') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link mt-3" href="{{ route('password.request') }}">
                                    {{ __('¿Has olvidado tu contraseña?') }}
                                </a>
                            @endif
                            </div>
                        </div>
                    </form>

                    <p class="w-100 text-center mt-3" style="font-size: 20px;">Iniciar sesión con Google</p>

                    <p class="w-100 text-center" style="font-size: 20px;">Iniciar sesión con Facebook</p>

                    <div class="mt-4" style="display: flex; width: 100%; justify-content: center; align-items: center; flex-direction: row;">
                        <span>¿No tienes cuenta?</span>
                        <li class="nav-item dropdown ml-2" style="list-style: none;">
                            <a style="color:#000; border:1px solid #ccc;" href="{{route('register.index', ['rol' => 'cliente'])}}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                ¡Regístrate!
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{route('register.index', ['rol' => 'cliente'])}}" class="dropdown-item">Cliente</a>
                                <a href="{{route('register.index', ['rol' => 'pianista'])}}" class="dropdown-item">pianista</a>
                            </div>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
