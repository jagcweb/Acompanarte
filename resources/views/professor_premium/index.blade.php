@extends('layouts.app')

@section('content')
@if(\Auth::user()->getRoleNames()[0] == 'profesor')
    @include('professor_premium.partials.-convertirse')
@endif

@if(\Auth::user()->getRoleNames()[0] == 'profesor-premium')
    @include('professor_premium.partials.-premium')
@endif
@endsection