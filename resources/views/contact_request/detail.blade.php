@extends('layouts.app')

@section('title') Solicitud {{$contact_request}} @endsection
@section('content')
<div class="row p-2">
    <div class="col-lg-6 col-md-8 col-sm-12 mx-auto ">
        @if(Auth::user()->getRoleNames()[0] == 'cliente')
        <div class="card">
            <div class="card-body">
                <p class="text-center w-100">Referencia: <b>{{$contact_request->reference}}</b></p>
                @if(isset($contact_request->user))
                @if($contact_request->user->getRoleNames()[0] == 'pianista')
                <p class="text-center w-100">Nombre: <b>{{mb_substr($contact_request->user->name, 0, 1)}}*****</b></p>
                <p class="text-center w-100">Email: <b>{{mb_substr($contact_request->user->email, 0,
                        1)}}********@****.***</b></p>
                <p class="text-center w-100">Teléfono: <b>{{mb_substr($contact_request->user->phone, 0, 1)}}*******</b>
                </p>
                @else
                <p class="text-center w-100">Nombre: <b>{{$contact_request->name}}</b></p>
                <p class="text-center w-100">Email: <b>{{$contact_request->email}}</b></p>
                <p class="text-center w-100">Teléfono: <b>{{$contact_request->phone}}</b></p>
                @endif
                <p class="text-center w-100">Especialidad: <b>{{$contact_request->specialty}}</b></p>
                <p class="text-center w-100">Evento a acompañar escogido: <b>{{$contact_request->accompaniment}}</b></p>

                @if($contact_request->rehearsals == 1)
                <p class="text-center w-100">Número de ensayos: <b>{{$contact_request->num_rehearsals}}</b></p>
                @else
                <p class="text-center w-100"><b>Sin ensayos</b></p>
                @endif


                @if($contact_request->user->getRoleNames()[0] == 'pianista')
                <p class="text-center w-100 mt-5">Los datos del pianista están ocultos hasta que este desbloquee su
                    solicitud.
                </p>
                @endif
                @else
                <p>Este usuario ya no existe.</p>
                @endif
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body">
                <p class="text-center w-100">Referencia: <b>{{$contact_request->reference}}</b></p>
                @if(isset($contact_request->client))
                @if(Auth::user()->getRoleNames()[0] == 'pianista' && $contact_request->unblocked != 1)
                <p class="text-center w-100">Nombre: <b>{{mb_substr($contact_request->name, 0, 1)}}*****</b></p>
                <p class="text-center w-100">Email: <b>{{mb_substr($contact_request->email, 0, 1)}}********@****.***</b>
                </p>
                <p class="text-center w-100">Teléfono: <b>{{mb_substr($contact_request->phone, 0, 1)}}*******</b></p>
                <p class="text-center w-100">Ciudad: <b>{{mb_substr($contact_request->location, 0, 1)}}*****</b></p>
                <p class="text-center w-100">Especialidad: <b>{{mb_substr($contact_request->specialty, 0, 1)}}*****</b>
                </p>
                <p class="text-center w-100">Evento a acompañar: <b>{{mb_substr($contact_request->accompaniment, 0,
                        1)}}*****</b></p>
                @if(!is_null($contact_request->pdf))
                <p class="text-center w-100">Partitura: <i style="font-size: 18px;" class="fa-solid fa-file-pdf"></i>
                </p>
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
                    <a style="color:#000; cursor: pointer;" target="_blank"
                        href="{{url('solicitudes/get-pdf/'.$contact_request->pdf)}}" title="Ver Partitura">
                        <i style="font-size: 18px;" class="fa-solid fa-file-pdf"></i>
                    </a>
                </p>
                @endif
                @endif

                @if($contact_request->rehearsals == 1)
                <p class="text-center w-100">Número de ensayos: <b>{{$contact_request->num_rehearsals}}</b></p>
                @else
                <p class="text-center w-100"><b>Sin ensayos</b></p>
                @endif

                @if(Auth::user()->getRoleNames()[0] == 'pianista')
                @if($contact_request->unblocked != 1)
                <p class="text-center w-100 mt-5">Esta solicitud de contacto está bloqueada porque no eres un usuario
                    premium.
                    Conviértete <a href="{{route('configuration_premium.index')}}" target="_blank">AQUÍ</a> y consulta
                    todas las
                    ventajas.</p>
                <a href="{{ route('configuration_premium.payment', ['param' => \Crypt::encryptString($contact_request->id)]) }}"
                    class="w-100 btn btn-dark text-center mt-3" style="color:#fff;">
                    Desbloquear solicitud de contacto en un pago de
                    @if(!is_null($price->discount))
                    <del>{{number_format($price->price, 2)}}€</del> - {{number_format($price->price - ($price->price *
                    $price->discount / 100), 2)}}€
                    @else
                    {{number_format($price->price, 2)}}€
                    @endif
                </a>
                @else
                <p class="text-center w-100 mt-5">
                    Pagada ({{\Carbon\Carbon::parse($contact_request->updated_at)->format('d/m/Y H:i')}}) -
                    {{number_format($contact_request->price)}}€ -
                    <a style="color:#000; cursor: pointer;" target="_blank" title="Ver Factura"
                        href="{{url('configuracion-premium/get-invoice/'.$contact_request->code.'.pdf')}}"><i
                            style="font-size: 18px;" class="fa-solid fa-file-pdf"></i></a>
                </p>
                @endif
                @endif

                @if(Auth::user()->getRoleNames()[0] == 'pianista-premium' || Auth::user()->getRoleNames()[0] ==
                'pianista' && $contact_request->unblocked == 1)
                @if(is_null($contact_request->accepted))
                <div class="w-100 d-flex justify-content-center flex-row">
                    <a href="{{route('contact_request.accept', ['id' => \Crypt::encryptString($contact_request->id)])}}"
                        style="color:#fff; background: green; max-width:200px;" class="btn">Aceptar</a>
                    <a href="{{route('contact_request.decline', ['id' => \Crypt::encryptString($contact_request->id)])}}"
                        style="color:#fff; background: red; max-width:200px; margin-left:15px;" class="btn">Rechazar</a>
                </div>
                @endif

                @if(is_null($contact_request->accepted))
                <p class="w-100 text-center text-muted">Pendiente</p>
                @endif

                @if($contact_request->accepted == '0')
                <p class="w-100 text-center text-danger">Rechazada</p>
                @endif

                @if($contact_request->accepted == 1)
                <p class="w-100 text-center text-success">Aceptada</p>
                <p class="w-100 text-center text-dark">¡Ya puedes contactar a través del teléfono o email faciltiados!</p>
                @endif
                @endif
                @else
                <p>Este usuario ya no existe.</p>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection