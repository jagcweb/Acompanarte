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
            <p class="text-center text-dark w-100">Evento a acompañar: <b>{{$acompañamiento}}</b></p>
            @foreach ($professors as  $prof)
            <div class="card mb-4" @if($prof->getRoleNames()[0] == 'pianista-premium') style="background:#6f87b0" @endif>
              <div class="card-body" style="display:flex; justify-content:space-between; border:none;">
                <div style="display:flex; justify-content: center; align-items: center;">
                  @if($prof->image)
                    <img src="{{url('mi-perfil/get-image/'.$prof->image)}}" alt="Acompañarte avatar"  class="rounded-circle" width="85"/>
                  @else
                    <img src="{{url('assets')}}/images/user.png" alt="user-image" class="rounded-circle" width="85" />
                  @endif
                </div>
                <div style="width:100%; display:flex; flex-direction:column; justify-content: center; align-items: center;">
                  <h3>{{$prof->name}} 

                    @if($prof->verified == 1)
                    <span title="Verificado" style="margin-top:-2px; font-size:18px; color:#1b82d6;"><i class="fa-solid fa-circle-check"></i></span>
                    @endif

                    @if($prof->getRoleNames()[0] == 'pianista-premium')
                      <span style="margin-top:-4px; color:#e8b210;">PREMIUM </span>
                    @endif

                  </h3>

                  @if(!is_null($prof->config_professor->price))
                  <span>Precio (€/h): <b>{{$prof->config_professor->price}}€</b></span>
                @endif
                  
                  @if(!is_null($prof->config_professor->biography))
                    <span>Biografía:</span>
                        <span>{{$prof->config_professor->price}}</span>
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

                  @if(!is_null($prof->config_professor->essay_place))
                    <p>Dispone de lugar de ensayo</p>
                  @endif

                  @if(!is_null($prof->config_professor->essay_place_with_piano))
                  <p>Dispone de lugar de ensayo con piano</p>
                @endif

                  <span>Valoraciones: {{$prof->ratings->count()}}</span>

                  <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%;">
                    @if(Auth::check())
                      @if(Auth::user()->getRoleNames()[0] == 'cliente')
                        <button class="btn btn-dark" data-toggle="modal" data-target="#enviar-solicitud-{{$prof->id}}">Enviar solicitud de contacto</button>
                        @include('partials.modals.enviar_solicitud_contacto')
                      @endif
                    @else
                    <p class="text-center text-dark">Para enviar una solicitud de contacto <a style="color:#000; text-decoration: underline;" href="{{route('register.index', ['rol' => 'cliente'])}}" target="_blank">regístrate</a> o <a style="color:#000; text-decoration: underline;" href="{{route('login')}}" target="_blank">inicia sesión</a></p>
                    @endif
                    <a href="{{route('user.profile', ['username' => $prof->username])}}" target="_blank" style="color:#fff;" class="btn btn-dark ml-4">Ver perfil</a>
                  </div>
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
