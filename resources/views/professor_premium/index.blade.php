@extends('layouts.app')

@section('title') Suscripción Premium @endsection
@section('content')
@if(\Auth::user()->getRoleNames()[0] == 'pianista')
    @include('professor_premium.partials.-convertirse')
@endif

@if(\Auth::user()->getRoleNames()[0] == 'pianista-premium')
    @if(isset(Auth::user()->suscription))
        @include('professor_premium.partials.-premium')
    @else
        <p class="text-center">Estás disfrutando de ser un Pianista Premium de manera gratuita.</p>
        <p class="text-center">¡Enhorabuena! Has de ser muy especial :)</p>
    @endif
@endif

@include('professor_premium.partials.-table_history')
@endsection