@extends('layouts.app') @section('title') Registrarse @endsection @section('content')
<script src="https://www.google.com/recaptcha/api.js"></script>
<div class="container container-register">
    <div class="row justify-content-center">
        <div class="col-md-8 col-register">
            <div class="card pt-2 border-0 d-flex align-items-center" style="border-radius:25px; @if($rol != 'cliente') min-height: 95vh; @else min-height: 80vh; @endif box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; position: relative;">

                <h3 class="mt-3 text-center d-block">{{str_replace('-', ' ', ucfirst($rol))}}</h3>
                @if($rol == 'pianista-premium')
                <span class="d-block mt-3 w-100 text-center">El registro de pianista <i>free</i> se hará como <i>premium</i></span>
                <small class="d-block w-100 text-center">(gratis en 2022)</small>
                <small class="d-block w-100 text-center">El 1 de Enero de 2023 automáticamente volverás al plan gratuito.</small> @endif
                <hr style="border-top: 1px solid #ccc; width:85%; margin-bottom: 0px;" />
                <div class="card-body">
                    <form method="POST" action="{{ route('register.create') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-12 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required> @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="surname" class="col-md-12 col-form-label text-md-end">{{ __('Apellido') }}</label>

                            <div class="col-md-12">
                                <input id="surname" type="text" class="@error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required> @error('surname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                            </div>
                        </div>

                        @if($rol != 'cliente')

                        <div class="row mb-3">
                            <label for="phone" class="col-md-12 col-form-label text-md-end">{{ __('Móvil de contacto') }}</label>

                            <div class="col-md-12">
                                <input style="height: 45px; border-color: #6b7280;" id="phone" type="phone" class="@error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required minlength="9" maxlength="9"> @error('phone')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> @enderror
                            </div>
                        </div>

                        @endif

                        <div class="row mb-3">
                            <label for="email" class="col-md-12 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"> @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-12 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-12 col-form-label text-md-end">{{ __('Confirmar contraseña') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group" style="display:flex; justify-content:center;">
                            {!! NoCaptcha::renderJs('es', true, 'recaptchaCallback') !!} {!! NoCaptcha::display() !!}
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn">
                                    {{ __('Finalizar registro') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection