@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center d-block">Disponibilidad geográfica</h2>

            @if(Auth::user()->config_professor)
                @include('professor_config.partials.-update')
            @else
                @include('professor_config.partials.-save')
            @endif
        </div>
    </div>
</div>
<script src="{{url('assets')}}/js/specialty.js"></script>
<script src="{{url('assets')}}/js/config_professor.js"></script>
@endsection