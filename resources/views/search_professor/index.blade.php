@extends('layouts.app')
@section('css')
<link href="{{ url('assets') }}/css/search_professor.css" rel="stylesheet" />
@endsection
@section('content')
<link href="{{url('assets')}}/css/home.css" rel="stylesheet" />
<style>
  .s004{
    height: 27vh !important; min-height:0px;
  }

  .card-style{
    display:flex; justify-content: center;  flex-direction:row;
  }

  .desc-div{
      width:100%; display:flex; flex-direction:column; justify-content: center; align-items: center;
    }
  
  .verified{
    z-index:9999; position: absolute; top: 0; right: 0; width: 25px; height: 25px; background:#000; border-radius:999px; text-align:center; color:#fff;
  }

  @media (max-width: 905px) {
    .s004{
      height: 40vh !important; min-height:0px;
    }

    .s004 form{
      margin-top: 20px;
    }
  }

  @media (max-width: 600px) {
    .card-style{
      flex-direction: column;
    }

    .img-div{
      width:100%;
      display: flex;
      justify-content: center;
      flex-direction: column;
      align-items: center;
      padding-bottom: 20px;
    }

    .card{
      max-height: 400px;
      height: 400px;
    }

    .verified{
      left: 55%;
    }

    .card{
      height: auto;
    }
  }

  @media (max-width: 385px) {
    .card{
      max-height: 450px;
      height: 450px;
    }

    .verified{
      left: 58%;
    }
  }
</style>
<div class="s004" style="">
  <form method="GET" action="{{route('search_professor.index')}}">
      @csrf
      <fieldset>
      <div class="searcher-div" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
          @include('partials.specialty-select')
          @include('partials.accompaniment-select')
          <input class="searcher-input" type="text" name="location" placeholder="Localidad" />
          <button class="btn-search" type="submit">Buscar</button>
      </div>
      </fieldset>
      <div class="mt-3" id="suggestions">
              
      </div>
  </form>
</div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12">
          @if(!Auth::user() || is_null(Auth::user()->email_verified_at) && Auth::user()->getRoleNames()[0] == 'cliente')
            @if(!is_null(\Cookie::get('back_to_url')))
              {{\Cookie::queue(\Cookie::forget('back_to_url'))}}
            @endif
            {{\Cookie::queue('back_to_url', url()->full(), 15*24*60)}}
          @endif
          @if(count($professors)>0)
            <h2 class="text-center d-block mb-2">Pianistas disponibles en <b>{{$location}}</b></h2>
            <p class="text-center text-dark w-100">Especialidad: <b>{{$especialidad}}</b></p>
            <p class="text-center text-dark w-100">Evento a acompañar: <b>{{$acompañamiento}}</b></p>
            @foreach ($professors as  $prof)
            @if($prof->getRoleNames()[0] == 'pianista-premium')
              <div class="card mb-4" style="box-shadow: rgba(247, 202, 109, 0.5) 0px 8px 24px!important;">
            @else
              <div class="card mb-4">
            @endif
              <div class="card-body" style="display:flex; justify-content:space-around; border:none;  flex-direction:column; position:relative;">
                @if($prof->getRoleNames()[0] == 'pianista-premium')
                  <span style="position:absolute; top: 3%; right: 3%; background:rgba(247, 202, 109, 0.8); padding:5px; border-radius:999px;">PREMIUM</span>
                @endif
                <div class="card-style">
                  @if($prof->image)
                    <div class="img-div" style="position:relative;">
                      <img src="{{url('mi-perfil/get-image/'.$prof->image)}}" alt="Encuentra Pianista avatar"  class="rounded-circle" width="85"/>
                      @if($prof->verified)
                        <span class="verified">#</span>
                      @endif
                      @if(!is_null($prof->config_professor->price))
                        <span class="text-center">Precio</span>
                        <br>
                        <b class="text-center">{{$prof->config_professor->price}}€/h</b>
                      @endif
                    </div>
                  @else
                    <div class="img-div" style="position:relative;">
                      <img src="{{url('assets')}}/images/user.png" alt="user-image" class="rounded-circle" width="85" />
                      @if($prof->verified)
                        <span class="verified">#</span>
                      @endif
                      @if(!is_null($prof->config_professor->price))
                        <span class="text-center d-block">Precio</span>
                        <b class="text-center d-block">{{$prof->config_professor->price}}€/h</b>
                      @endif
                    </div>
                  @endif
                  <div class="desc-div">
                    <h3>{{$prof->name}} </h3>
                    
                    @if(!is_null($prof->config_professor->biography))
                      <span style="word-break: break-all; max-width: 70%;">{{$prof->config_professor->biography}}</span>
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
                      @if($prof->config_professor->essay_place != 1)
                        <p>Dispone de lugar de ensayo</p>
                      @endif
  
                      @if($prof->config_professor->essay_place == 1)
                        <p>Dispone de lugar de ensayo con piano</p>
                      @endif
                    @endif
  
                    {{-- <span>Valoraciones: {{$prof->ratings->count()}}</span> --}}
                    @if(Auth::check())
                      @if(Auth::user()->getRoleNames()[0] == 'cliente')
                        @if(is_null(Auth::user()->email_verified_at))
                          <p class="text-center text-dark">Para enviar una solicitud de contacto <a style="color:#000; text-decoration: underline;" href="{{route('verification.notice')}}">verifica tu email</a></p>
                        @else
                        <button class="btn btn-dark" data-toggle="modal" data-target="#enviar-solicitud-{{$prof->id}}">Enviar solicitud de contacto</button>
                        @include('partials.modals.enviar_solicitud_contacto')
                        @endif
                      @endif
                  @else
                  <p class="text-center text-dark">Para enviar una solicitud de contacto <a style="color:#000; text-decoration: underline;" href="{{route('register.index', ['rol' => 'cliente'])}}">regístrate</a> o <a style="color:#000; text-decoration: underline;" href="{{route('login')}}">inicia sesión</a></p>
                  @endif

                  <a href="{{route('user.profile', ['username' => $prof->username])}}" target="_blank" 
                  style="
                    width: 100%!important;
                    border: none!important;
                    border-radius: 99999px!important;
                    background: #222c2b!important;
                    text-align:center;
                    line-height:40px;
                    color: #fff!important; height:40px;"
                    >Ver perfil</a>
                
                  </div>
                </div>
                <div style="width: 100%;" style="margin-top:-60px!important;">
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
