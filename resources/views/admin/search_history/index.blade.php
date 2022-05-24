@extends('layouts.admin')

@section('content')
@if(count($search_history)>0)
<p class="w-100 text-center">Historial de búsqueda de pianista</p>
<table style="font-size: 15px" data-toggle="table" data-locale="es-ES" data-filter-control="true" data-search="true"
    data-page-list="[10, 20, 30]" data-page-size="10" data-buttons-class="xs btn-light" data-pagination="true" class="table-borderless">
    <thead class="thead-light">
        <tr>
            <th data-field="user" data-align="center" data-filter-control="input">Usuario</th>
            <th data-field="city" data-align="center" data-filter-control="input">Ciudad</th>
            <th data-field="specialty" data-align="center" data-filter-control="input">Especialidad</th>
            <th data-field="accompaniment" data-align="center" data-filter-control="input">Evento a acompañar</th>
            <th data-field="created" data-align="center" data-filter-control="input">Fecha<br>creación</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($search_history as $hist)
        
            <tr>
                @if(isset($hist->user))
                    <td>{{$hist->user->email}}</td>
                @else
                    <td>Usuario no registrado.</td>
                @endif
                <td>{{$hist->location}}</td>
                <td>{{$hist->specialty}}</td>
                <td>{{$hist->accompaniment}}</td>
                <td>{{\Carbon\Carbon::parse($hist->created_at)->format('d/m/Y H:i')}}</td>
            <tr>

        @endforeach
    </tbody>
</table>
@else
<p class="w-100 text-center">Aún no hay ningún registro.</p>
@endif
@endsection