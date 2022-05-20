@extends('layouts.admin')

@section('content')
    ¡Bienvenido al panel de administración!

    <p>Total de usuarios:</p>
    <p>Clientes: {{$clientes}}</p>
    <p>Pianistas: {{$pianistas}}</p>
    <p>Pianistas Premium: {{$premiums}}</p>
    <p>Pianistas Premium Verificados: {{$premiums_verified}}</p>

    <br>
    <br>
    <p>Total solicitudes de contacto: {{$contact_requests}}</p>
@endsection