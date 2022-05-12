@extends('layouts.app')
@section('css')
<link href="{{ url('assets') }}/css/search_professor.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          @if(count($professors)>0)
            <h2 class="text-center d-block mb-2">Pianistas disponibles en <b>{{$location}}</b>:</h2>
            <p class="text-center text-dark w-100">Especialidad: <b>{{$especialidad}}</b></p>
            @foreach ($professors as  $prof)
            <div class="card mb-2" @if($prof->getRoleNames()[0] == 'profesor-premium') style="background:#6f87b0" @endif>
              <div class="card-body" style="display:flex; justify-content:space-between; border:none;">
                <div style="display:flex; justify-content: center; align-items: center;">
                  @if($prof->image)
                    <img src="{{url('mi-perfil/get-image/'.$prof->image)}}" alt="Acompañarte avatar"  class="rounded-circle" width="85"/>
                  @else
                    <img src="{{url('assets')}}/images/user.png" alt="user-image" class="rounded-circle" width="85" />
                  @endif
                </div>
                <div style="width:100%; display:flex; flex-direction:column; justify-content: center; align-items: center;">
                  <h3>{{$prof->fullname}}

                    @if($prof->getRoleNames()[0] == 'profesor-premium')
                      <span style="margin-top:-4px; color:#e8b210;">PREMIUM </span>
                    @endif

                  </h3>

                  <span>Especialidades: esp</span>
                  
                  @if(!is_null($prof->config_professor->other_degrees))
                    <span>Otras titulaciones:</span>
                      @foreach (json_decode($prof->config_professor->other_degrees, true) as $other_degrees)
                        <span>{{$other_degrees}}</span>
                      @endforeach
                  @endif

                  @if(!is_null($prof->config_professor->languages))
                    <span>Idiomas:</span>
                    <div>
                      @foreach (json_decode($prof->config_professor->languages, true) as $languages)
                        @for($i = 0; $i < sizeof($languages); $i++)
                          <span>{{$languages[$i]}}</span>
                        @endfor
                      @endforeach
                    </div>
                  @endif

                  @if(!is_null($prof->config_professor->exp))
                    <span>Otras titulaciones: {{$prof->config_professor->exp}}</span>
                  @endif
                  <span>Valoraciones: {{$prof->ratings->sum()}}</span>

                  @if(Auth::check())
                    <button class="w-100 btn btn-dark" data-toggle="modal" data-target="#enviar-solicitud-{{$prof->id}}">Enviar solicitud de contacto</button>
                    @include('partials.modals.enviar_solicitud_contacto')
                  @else
                  <button class="w-100 btn btn-dark" disabled>Enviar solicitud de contacto</button>

                    @if($prof->getRoleNames()[0] == 'profesor')
                      <p class="text-center w-100 text-dark">Para enviar una solicitud de contacto <a style="color:#000; text-decoration: underline;" href="{{route('register.index', ['rol' => 'cliente'])}}" target="_blank">regístrate</a> o <a style="color:#000; text-decoration: underline;" href="{{route('login')}}" target="_blank">inicia sesión</a></p>
                    @else
                      <p class="text-center w-100 text-dark">Para enviar una solicitud de contacto <a style="color:#fff;" href="{{route('register.index', ['rol' => 'cliente'])}}" target="_blank">regístrate</a> o <a style="color:#fff;" href="{{route('login')}}" target="_blank">inicia sesión</a></p>
                    @endif
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          @else
          <p class="text-center w-100">Aún no hay pianistas en tu zona :(</p>
          @endif
        </div>
    </div>
</div>
@endsection
