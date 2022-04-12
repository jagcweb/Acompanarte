@extends('layouts.app')

@section('css')
<link href="{{url('assets')}}/css/home.css" rel="stylesheet" />
@endsection

@section('content')
<div class="s004">
    @if(!\Auth::user())
    <p>Para buscar profesores inicia sesión</p>
    @else
        @if(\Auth::user()->getRoleNames()[0] == "cliente")
        <form method="POST" action="{{route('search_professor.index')}}">
            @csrf
            <fieldset>
            <legend>Encuentra a tu profesor</legend>
            <div class="inner-form">
                <div class="input-field searcher">
                {{-- <input class="form-control" id="choices-text-preset-values" type="text" placeholder="Escribe una localidad..." /> --}}
                <input class="form-control searcher-input" type="text" placeholder="Escribe una comunidad autónoma, provincia o localidad..." />
                <button class="btn-search" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 26 26">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                    </svg>
                </button>
                </div>
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
        @else
            @if(!\Auth::user()->user)
            <p>Rellena la <a href="{{route('configuration_professor.index')}}">configuración</a> de tu cuenta para aparecer a clientes!</p>
            @else
            <p>Ya eres mostrado a clientes!</p>
            @endif
        @endif
    @endif
</div>
<script src="{{url('assets')}}/js/extention/choices.js"></script>
<script src="{{url('assets')}}/js/home.js"></script>
<script>
var textPresetVal = new Choices('#choices-text-preset-values',
{
    removeItemButton: true,
});
</script>
@endsection

@section('scripts')
@endsection
