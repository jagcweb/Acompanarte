@extends('layouts.app')

@section('title') Iniciar Sesión @endsection
@section('content')
<style>
    .regist-div{
        width: 100%; display:flex; justify-content: space-around; flex-direction:row; padding:0px 25px;
    }

    @media (max-width: 700px) {
        .regist-div{
            flex-direction: column;
        }
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card pt-2 border-0 d-flex align-items-center"
                style="border-radius:25px; min-height: 40vh; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <h2 class="text-center mt-3 mb-4 d-block">Iniciar sesión</h2>
                <hr style="border-top: 1px solid #ccc; width:85%; margin-bottom: 0px; margin-top: 0px;" />
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email *') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña *')
                                }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="@error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">

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
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

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
                                <a class="btn btn-link mt-3 w-100 text-center d-block" href="{{ route('password.request') }}">
                                    {{ __('¿Has olvidado tu contraseña?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>

                    {{-- <p class="w-100 text-center mt-3" style="font-size: 20px;">Iniciar sesión con Google</p>

                    <p class="w-100 text-center" style="font-size: 20px;">Iniciar sesión con Facebook</p> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row w-100 mt-4">
    <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 mx-auto">
        <p class="w-100 text-center">¿No tienes cuenta?</p> 
        <div class="regist-div">
            <div class="card w-100 m-3">
                <div class="card-body"
                    style="display:flex; justify-content: space-between; flex-direction:column; min-height:300px;">
                    <span class="d-block text-center" style="font-size:20px;"><b>Busco</b> pianista</span>
                    <img style="margin: 0 auto;" src="https://via.placeholder.com/175" />
                    <a
                    style="text-decoration: none; display: block width: 100%; border: none; border-radius: 99999px;background: #222c2b; color: #fff; height:40px; text-align: center; line-height: 40px;"
                    class="mt-3"
                    href="{{route('register.index', ['rol' => 'cliente'])}}">
                        Registrarme
                    </a>
                </div>
            </div>
            <div class="card w-100 m-3">
                <div class="card-body"
                    style="display:flex; justify-content: space-between; flex-direction:column;  min-height:300px;">
                    <span class="d-block text-center" style="font-size:20px;"><b>Soy</b> pianista</span>
                    <img style="margin: 0 auto;" src="https://via.placeholder.com/175" />
                    <a
                    style="text-decoration: none; display: block width: 100%; border: none; border-radius: 99999px;background: #222c2b; color: #fff; height:40px; text-align: center; line-height: 40px;"
                    class="mt-3"
                    href="{{route('register.index', ['rol' => 'pianista-premium'])}}">
                        Registrarme
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection