@extends('layouts.admin') @section('content')
<div class="w-100">
    <p>Precios actualmente:</p>
    @foreach($prices as $price) 
        @if(!is_null($price->discount))
            <p>
                <span class="text-center">{{$price->type}}: {{$price->price}}€ - dto {{$price->discount}}% ({{$price->price - ($price->price * $price->discount /100)}})</span>
                <a data-toggle="modal" data-target="#ajustar-precio-{{$price->id}}"><i style="font-size:18px; cursor: pointer;" class="fa-solid fa-pen-to-square"></i></a>
            </span>
        @else
            <p>
                <span class="text-center">{{$price->type}}: {{$price->price}}€</span>
                <a data-toggle="modal" data-target="#ajustar-precio-{{$price->id}}"><i style="font-size:18px; cursor: pointer;" class="fa-solid fa-pen-to-square"></i></a>
            </p>
        @endif 
        @include('partials.modals.admin.ajustar_precios')
    @endforeach
</div>
@endsection