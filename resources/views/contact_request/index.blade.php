@extends('layouts.app')

@section('content')
<h4 class="text-center w-100">Solicitudes de contacto</h4>

@foreach($contact_requests as $cont)
<a style="color:#000;" href="{{route('contact_request.detail', ['id' => \Crypt::encryptString($cont->id)])}}">
    <div class="card">
        <div class="card-body">
            <p>Referencia: <b>{{$cont->reference}}</b></p>
            <small>{{$cont->created_at}}</small>
            <br>
            @if(is_null($cont->accepted))
                <span class="text-muted">Pendiente</span>
            @endif

            @if($cont->accepted == '0')
                <span class="text-danger">Rechazada</span>
            @endif

            @if($cont->accepted == 1)
                <span class="text-success">Aceptada</span>
            @endif
        </div>
    </div>
</a>
@endforeach
@endsection