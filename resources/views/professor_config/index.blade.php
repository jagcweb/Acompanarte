@extends('layouts.app')

@section('title') Configuración @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center d-block">Configura tu perfil</h2>

            @if(Auth::user()->config_professor)
                @include('professor_config.partials.-update')
            @else
                @include('professor_config.partials.-save')
            @endif
        </div>
    </div>
</div>

{{-- @if(Auth::user()->getRoleNames()[0] == 'pianista-premium')
<div class="container">
    <div class="mt-4 row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->verified != 1)
                        <p>¿Quieres ser un pianista verificado?</p>

                        <p>Envíanos un email a <a href="mailto:admin@encuentrapianista.com">admin@encuentrapianista.com</a> incluyendo tu email de registro y un PDF con las titulaciones. Responderemos a su email en 24-48h (laborables) y si cumple los requisitos, pasará a ser un pianista verificado.</p>

                    @else
                        <p>¡Enhorabuena! Ya eres un pianista verificado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif --}}
<script src="{{url('assets')}}/js/specialty.js"></script>
<script src="{{url('assets')}}/js/config_professor.js"></script>
@endsection