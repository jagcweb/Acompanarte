@extends('layouts.admin')

@section('content')
@if(count($histories)>0)
<p class="w-100 text-center">Historial de pagos de suscripción</p>
<table style="font-size: 15px" data-toggle="table" data-locale="es-ES" data-filter-control="true" data-search="true"
    data-page-list="[10, 20, 30]" data-page-size="10" data-buttons-class="xs btn-light" data-pagination="true" class="table-borderless">
    <thead class="thead-light">
        <tr>
            <th data-field="nombre" data-align="center" data-filter-control="input">Nombre</th>
            <th data-field="email" data-align="center" data-filter-control="input">Email</th>
            <th data-field="type" data-align="center" data-filter-control="input">Tipo</th>
            <th data-field="date" data-align="center" data-filter-control="input">Fecha<br>cobro</th>
            <th data-field="date2" data-align="center" data-filter-control="input">Fecha<br>finalización</th>
            <th data-field="pdf" data-align="center" data-filter-control="input">PDF Factura</th>
            <th data-field="created" data-align="center" data-filter-control="input">Fecha<br>creación</th>
            <th data-field="updated" data-align="center" data-filter-control="input">Última<br>actualización</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($histories as $hist)
        
            <tr>
                @if(isset($hist->user))
                <td>{{$hist->user->fullname}}</td>
                <td>{{$hist->user->email}}</td>
                @else
                <td>Este usuario ya no existe</td>
                <td>-</td>
                @endif
                <td>{{ucfirst($hist->type)}}</td>
                <td>{{\Carbon\Carbon::parse($hist->created_at)->format('d/m/Y')}}</td>
                <td>{{\Carbon\Carbon::parse($hist->ended_at)->format('d/m/Y')}}</td>
                <td><a href="{{url('configuracion-premium/get-invoice/'.$hist->pdf)}}"  target="_blank" class="text-dark" style="font-size:24px;"><i class="fa-solid fa-file-pdf"></i></a></td>
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