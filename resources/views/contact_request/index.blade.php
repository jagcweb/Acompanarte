@extends('layouts.app')

@section('content')
<h4 class="text-center w-100">Solicitudes de contacto</h4>

@foreach($contact_requests as $cont)
<a style="color:#000;" href="{{route('contact_request.detail', ['id' => $cont->id])}}">
    <div class="card">
        <div class="card-body">
            <p>Contacto número {{$cont->id}}</p>
            <small>{{$cont->created_at}}</small>
        </div>
    </div>
</a>
@endforeach
@endsection