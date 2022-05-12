@extends('layouts.admin')

@section('content')
@if(count($users)>0)
<p class="w-100 text-center">Todos los usuarios</p>
<table style="font-size: 15px" data-toggle="table" data-locale="es-ES" data-filter-control="true" data-search="true"
    data-page-list="[10, 20, 30]" data-page-size="10" data-buttons-class="xs btn-light" data-pagination="true" class="table-borderless">
    <thead class="thead-light">
        <tr>
            <th data-field="name" data-align="center" data-filter-control="input">Nombre</th>
            <th data-field="surname" data-align="center" data-filter-control="input">Apellido</th>
            <th data-field="rol" data-align="center" data-filter-control="input">Rol</th>
            <th data-field="phone" data-align="center" data-filter-control="input">Teléfono</th>
            <th data-field="created" data-align="center" data-filter-control="input">Fecha<br>creación</th>
            <th data-field="updated" data-align="center" data-filter-control="input">Última<br>actualización</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($users as $user)
        
            <tr>
                <td>{{ucfirst($user->name)}}</td>
                <td>{{ucfirst($user->surname)}}</td>
                <td>{{$user->getRoleNames()[0]}}</td>
                <td>{{$user->phone}}</td>
                <td>{{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
                <td>{{\Carbon\Carbon::parse($user->updated_at)->format('d/m/Y')}}</td>
            <tr>

        @endforeach
    </tbody>
</table>
@else
<p class="w-100 text-center">Aún no hay ningún registro.</p>
@endif
@endsection