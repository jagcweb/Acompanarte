@extends('layouts.app')

@section('content')
@if(Auth::user()->getRoleNames()[0] == 'cliente')
<div class="card">
    <div class="card-body">
        @if($contact_request->user->getRoleNames()[0] == 'pianista')
        <p class="text-center w-100">Nombre: <b>{{mb_substr($contact_request->user->name, 0, 1)}}*****</b></p>
        <p class="text-center w-100">Email: <b>{{mb_substr($contact_request->user->email, 0, 1)}}********@****.***</b></p>
        <p class="text-center w-100">Teléfono: <b>{{mb_substr($contact_request->user->phone, 0, 1)}}*******</b></p>
        @else
        <p class="text-center w-100">Nombre: <b>{{$contact_request->name}}</b></p>
        <p class="text-center w-100">Email: <b>{{$contact_request->email}}</b></p>
        <p class="text-center w-100">Teléfono: <b>{{$contact_request->phone}}</b></p>
        @endif
        <p class="text-center w-100">Evento a acompañar escogido: <b>{{$contact_request->accompaniment}}</b></p>

        @if($contact_request->rehearsals == 1)
        <p class="text-center w-100">Número de ensayos: <b>{{$contact_request->num_rehearsals}}</b></p>
        @else
        <p class="text-center w-100"><b>Sin ensayos</b></p>
        @endif

        <p class="text-center w-100">Tu mensaje: <b>{{$contact_request->message}}</b></p>

        @if($contact_request->user->getRoleNames()[0] == 'pianista')
        <p class="text-center w-100 mt-5">Los datos del pianista están ocultos hasta que este desbloquee su solicitud.
        </p>
        @endif
    </div>
</div>
@else
<div class="card">
    <div class="card-body">
        @if(Auth::user()->getRoleNames()[0] == 'pianista' && $contact_request->unblocked != 1)
        <p class="text-center w-100">Nombre: <b>{{mb_substr($contact_request->name, 0, 1)}}*****</b></p>
        <p class="text-center w-100">Email: <b>{{mb_substr($contact_request->email, 0, 1)}}********@****.***</b></p>
        <p class="text-center w-100">Teléfono: <b>{{mb_substr($contact_request->phone, 0, 1)}}*******</b></p>
        <p class="text-center w-100">Ciudad: <b>{{mb_substr($contact_request->location, 0, 1)}}*****</b></p>
        <p class="text-center w-100">Especialidad: <b>{{mb_substr($contact_request->specialty, 0, 1)}}*****</b></p>
        <p class="text-center w-100">Evento a acompañar: <b>{{mb_substr($contact_request->accompaniment, 0, 1)}}*****</b></p>
            @if(!is_null($contact_request->pdf))
                <p class="text-center w-100">Partitura: <i style="font-size: 18px;" class="fa-solid fa-file-pdf"></i></p>
            @endif
        @else
        <p class="text-center w-100">Nombre: <b>{{$contact_request->name}}</b></p>
        <p class="text-center w-100">Email: <b>{{$contact_request->email}}</b></p>
        <p class="text-center w-100">Teléfono: <b>{{$contact_request->phone}}</b></p>
        <p class="text-center w-100">Ciudad: <b>{{$contact_request->location}}</b></p>
        <p class="text-center w-100">Especialidad: <b>{{$contact_request->specialty}}</b></p>
        <p class="text-center w-100">Evento a acompañar: <b>{{$contact_request->accompaniment}}</b></p>
            @if(!is_null($contact_request->pdf))
                <p class="text-center w-100">
                    Partitura: 
                    <a style="color:#000; cursor: pointer;" href="{{url('configuracion-premium/get-invoice/'.$contact_request->pdf)}}" title="Ver Partitura">
                        <i style="font-size: 18px;" class="fa-solid fa-file-pdf"></i>
                    </a>
                </p>
            @endif
        @endif
        <p class="text-center w-100">Evento a acompañar: <b>{{$contact_request->accompaniment}}</b></p>

        @if($contact_request->rehearsals == 1)
        <p class="text-center w-100">Número de ensayos: <b>{{$contact_request->num_rehearsals}}</b></p>
        @else
        <p class="text-center w-100"><b>Sin ensayos</b></p>
        @endif

        @if(Auth::user()->getRoleNames()[0] == 'pianista')
        @if($contact_request->unblocked != 1)
        <p class="text-center w-100 mt-5">Esta solicitud de contacto está bloqueada porque no eres un usuario premium.
            Conviértete <a href="{{route('configuration_premium.index')}}" target="_blank">AQUÍ</a> y consulta todas las
            ventajas.</p>
        <a href="{{ route('configuration_premium.payment', ['param' => \Crypt::encryptString($contact_request->id)]) }}"
            class="w-100 btn btn-dark text-center mt-3" style="color:#fff;">
            Desbloquear solicitud de contacto en un pago de 
            @if(!is_null($price->discount))
            <del>{{number_format($price->price, 2)}}€</del> - {{number_format($price->price - ($price->price * $price->discount / 100), 2)}}€
            @else
            {{number_format($price->price, 2)}}€
            @endif
        </a>
        @else
        <p class="text-center w-100 mt-5">Pagada ({{\Carbon\Carbon::parse($contact_request->updated_at)->format('d/m/Y H:i')}}) - {{number_format($contact_request->price)}}€</p>
        @endif
        @endif
    </div>
</div>
@endif
@endsection