@extends('layouts.app')

@section('content')
@if(\Auth::user()->getRoleNames()[0] == 'pianista')
    @include('professor_premium.partials.-convertirse')
@endif

@if(\Auth::user()->getRoleNames()[0] == 'pianista-premium')
    @include('professor_premium.partials.-premium')
@endif

@include('professor_premium.partials.-table_history')
@endsection