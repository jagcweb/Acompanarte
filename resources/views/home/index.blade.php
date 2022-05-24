@extends('layouts.app')

@section('css')
<link href="{{url('assets')}}/css/home.css" rel="stylesheet" />
@endsection

@section('content')
<img src="{{url('mi-perfil/get-image/'.Auth::user()->image)}}" />
<div class="s004">
    <form method="POST" action="{{route('search_professor.index')}}">
        @csrf
        <fieldset>
        <legend>Encuentra a tu pianista</legend>
        <div class="searcher-div">
            @include('partials.specialty-select')
            @include('partials.accompaniment-select')
            <input class="searcher-input" type="text" name="location" placeholder="Localidad" />
            <button class="btn-search" type="submit">Buscar</button>
        </div>
        <div class="suggestion-wrap">
            {{-- <span>Test</span>
            <span>Test</span>
            <span>Test</span>
            <span>Test</span>
            <span>Test</span> --}}
        </div>
        </fieldset>
        <div id="suggestions">
                
        </div>
    </form>
</div>
@if(Auth::user() && !Auth::user()->config_professor)
<p class="w-100 text-center">Rellena la <a href="{{route('configuration_professor.index')}}">configuración</a> de tu cuenta para aparecer a clientes!</p>
@else
<p class="w-100 text-center">Ya eres mostrado a clientes!</p>
@endif
<script src="{{url('assets')}}/js/extention/choices.js"></script>
<script src="{{url('assets')}}/js/home.js"></script>
<script src="{{url('assets')}}/js/specialty.js"></script>
<script>
var textPresetVal = new Choices('#choices-text-preset-values',
{
    removeItemButton: true,
});
</script>
@endsection

@section('scripts')
@endsection
