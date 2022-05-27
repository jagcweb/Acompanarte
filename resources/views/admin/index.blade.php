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

    <br>
    <br>
    <p>Pianistas por comunidad autónoma:</p>
    @foreach ($comunidades as $com)
        @php $pianistas = \App\Models\ConfigurationProfessor::where('availability', 'Nacional')->orWhere('community', $com->comunidad_autonoma)->count(); @endphp
        <p>{{$com->comunidad_autonoma}}: {{$pianistas}}</p>
    @endforeach
@endsection