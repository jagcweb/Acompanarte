@extends('layouts.app')
@section('title') Solicitudes de contacto @endsection
@section('content')
<h4 class="text-center w-100">Solicitudes de contacto</h4>

@foreach($contact_requests as $cont)
<div class="row p-2">
    <div class="col-lg-6 col-md-8 col-sm-12 mx-auto ">
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
    </div>
</div>
@endforeach
@endsection