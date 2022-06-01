@extends('layouts.admin')

@section('content')
@if(count($histories)>0)
<p class="w-100 text-center">Solicitudes de contacto</p>
<table style="font-size: 15px" data-toggle="table" data-locale="es-ES" data-filter-control="true" data-search="true"
    data-page-list="[10, 20, 30]" data-page-size="10" data-buttons-class="xs btn-light" data-pagination="true" class="table-borderless">
    <thead class="thead-light">
        <tr>
            <th data-field="ref" data-align="center" data-filter-control="input">Referencia</th>
            <th data-field="cli" data-align="center" data-filter-control="input">Cliente</th>
            <th data-field="pianista" data-align="center" data-filter-control="input">Pianista</th>
            <th data-field="ensayos" data-align="center" data-filter-control="input">Ensayos<br>Num</th>
            <th data-field="email" data-align="center" data-filter-control="input">Email</th>
            <th data-field="tlf" data-align="center" data-filter-control="input">Teléfono</th>
            <th data-field="pagada" data-align="center" data-filter-control="input">Pagada</th>
            <th data-field="precio" data-align="center" data-filter-control="input">Precio<br>Pagado</th>
            <th data-field="localización" data-align="center" data-filter-control="input">Localización</th>
            <th data-field="esp" data-align="center" data-filter-control="input">Especialidad</th>
            <th data-field="acc" data-align="center" data-filter-control="input">Evento<br>Acompañar</th>
            <th data-field="partitura" data-align="center" data-filter-control="input">Partitura</th>
            <th data-field="aceptada" data-align="center" data-filter-control="input">Aceptada</th>
            <th data-field="code" data-align="center" data-filter-control="input">Código<br>Factura</th>
            <th data-field="pdf" data-align="center" data-filter-control="input">Factura</th>
            <th data-field="created" data-align="center" data-filter-control="input">Fecha<br>creación</th>
            <th data-field="updated" data-align="center" data-filter-control="input">Última<br>actualización</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($contact_requests as $cont)
        
            <tr>
                <td>{{$cont->reference}}</td>
                @if(isset($cont->client))
                    <td>
                        {{$cont->client->fullname}}
                        <br/>
                        {{$cont->client->email}}
                    </td>
                @else
                    <td>Este cliente ya no existe</td>
                @endif
                @if(isset($cont->user))
                    <td>
                        {{$cont->user->fullname}}
                        <br/>
                        {{$cont->user->email}}
                        <br/>
                        {{$cont->user->getRoleNames()[0]}}
                    </td>
                @else
                    <td>Este pianista ya no existe</td>
                @endif
                <td>
                    @if($cont->rehearsals == 1)
                        Sí
                        <br />
                        Número: {{$cont->num_rehearsals}}
                    @else
                        no
                    @endif
                </td>
                <td>{{$cont->email}}</td>
                <td>{{$cont->phone}}</td>
                <td>
                    @if($cont->user->getRoleNames()[0] == 'pianista-premium')
                    Pianista Premium
                    @else
                        @if($cont->unblocked == 1)
                        Pagada
                        @else
                        No Pagada
                        @endif
                    @endif
                </td>
                <td>
                    @if(!is_null($cont->price))
                        {{$cont->price}}
                    @else
                        -
                    @endif
                </td>
                <td>{{$cont->location}}</td>
                <td>{{$cont->specialty}}</td>
                <td>{{$cont->accompaniment}}</td>
                <td>
                    @if(!is_null($cont->pdf))
                    <a href="{{url('solicitudes/get-pdf/'.$cont->pdf)}}"  target="_blank" class="text-dark" style="font-size:24px;"><i class="fa-solid fa-file-pdf"></i></a>
                    @else
                    -
                    @endif
                </td>

                <td>
                    @if(is_null($cont->accepted))
                        Pendiente
                    @endif

                    @if($cont->accepted == '0')
                        Rechazada
                    @endif

                    @if($cont->accepted == 1)
                        Aceptada
                    @endif
                </td>

                <td>
                    @if(!is_null($cont->code))
                        {{$cont->code}}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if(!is_null($cont->pdf_invoice))
                        <a href="{{url('configuracion-premium/get-invoice/'.$cont->pdf_invoice)}}"  target="_blank" class="text-dark" style="font-size:24px;"><i class="fa-solid fa-file-pdf"></i></a>
                    @else
                        -
                    @endif
                </td>
                <td>{{\Carbon\Carbon::parse($hist->created_at)->format('d/m/Y')}}</td>
                <td>{{\Carbon\Carbon::parse($hist->updated_at)->format('d/m/Y')}}</td>
            <tr>

        @endforeach
    </tbody>
</table>
@else
<p class="w-100 text-center">Aún no hay ningún registro.</p>
@endif
@endsection