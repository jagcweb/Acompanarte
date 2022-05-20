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
            <th data-field="email" data-align="center" data-filter-control="input">Email</th>
            <th data-field="rol" data-align="center" data-filter-control="input">Rol</th>
            <th data-field="phone" data-align="center" data-filter-control="input">Teléfono</th>
            <th data-field="verifie" data-align="center" data-filter-control="input">Verificado</th>
            <th data-field="created" data-align="center" data-filter-control="input">Fecha<br>creación</th>
            <th data-field="updated" data-align="center" data-filter-control="input">Última<br>actualización</th>
            <th data-field="acc" data-align="center" data-filter-control="input">Acciones</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($users as $user)
        
            <tr>
                <td>{{ucfirst($user->name)}}</td>
                <td>{{ucfirst($user->surname)}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->getRoleNames()[0]}}</td>
                <td>{{$user->phone}}</td>

                @if(!is_null($user->verified))
                    <td>Verificado</td>
                @else
                    <td>-</td>
                @endif

                <td>{{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
                <td>{{\Carbon\Carbon::parse($user->updated_at)->format('d/m/Y')}}</td>
                <td>
                    <li class="nav-item dropdown ml-2" style="list-style: none;">
                        <a style="color:#000; border:1px solid #ccc;" href="{{route('register.index', ['rol' => 'cliente'])}}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i style="font-size: 18px;" class="fa-solid fa-gear mr-2"></i>Acciones
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            @if(is_null($user->verified))
                                <a href="{{route('user.verify', ['id' => $user->id])}}" class="dropdown-item"><i style="font-size: 18px;" class="fa-solid fa-circle-check mr-2"></i>Verificar</a>
                            @else
                                <a href="{{route('user.unverify', ['id' => $user->id])}}" class="dropdown-item"><i style="font-size: 18px;" class="fa-solid fa-circle-xmark mr-2"></i>Desverificar</a>
                            @endif

                            @if($user->getRoleNames()[0] == 'pianista')
                                <a href="{{route('user.change_premium', ['id' => $user->id])}}" class="dropdown-item"><i style="font-size: 18px;" class="fa-solid fa-user-plus mr-2"></i>Ascender a Pianista Premium</a>
                            @endif

                            @if($user->getRoleNames()[0] == 'pianista-premium')
                                <a href="{{route('user.change_pianista', ['id' => $user->id])}}" class="dropdown-item"><i style="font-size: 18px;" class="fa-solid fa-user-minus mr-2"></i>Degradar a Pianista</a>
                            @endif

                            @if(is_null($user->banned))
                                <a href="{{route('user.ban', ['id' => $user->id])}}" class="dropdown-item"><i style="font-size: 18px;" class="fa-solid fa-user-slash mr-2"></i>Bloquear Usuario</a>
                            @else
                                <a href="{{route('user.unban', ['id' => $user->id])}}" class="dropdown-item"><i style="font-size: 18px;" class="fa-solid fa-user mr-2"></i>Desbloquear Usuario</a>
                            @endif
                            <!-- <a href="#" class="dropdown-item"><i style="font-size: 18px;" class="fa-solid fa-user-xmark mr-2"></i>Borrar Usuario</a> -->
                        </div>
                    </li>
                </td>
            <tr>

        @endforeach
    </tbody>
</table>
@else
<p class="w-100 text-center">Aún no hay ningún registro.</p>
@endif
@endsection