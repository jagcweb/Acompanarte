@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center d-block">Cambiar contraseña</h2>
            <div class="card">
                
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="check-1" class="col-md-4 col-form-label text-md-end">{{ __('Desactivar Notificaciones') }}</label>
                            <input type="checkbox" id="check-1" value="first_checkbox" class="form-control @error('check-1') is-invalid @enderror" name="check-1" required />

                            @error('check-1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
