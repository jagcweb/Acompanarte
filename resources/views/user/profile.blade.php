@extends('layouts.app')

@if(\Auth::user() && \Auth::user()->id == $user->id)
@section('title') Mi perfil @endsection
@else
@section('title') Perfil de {{$user->name}} @endsection
@endif
@section('css')
<link href="{{url('assets')}}/css/profile.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container emp-profile">
    <form method="post">
        <div class="row" style="position: relative;">
            @if(Auth::check() && Auth::user()->username == $user->username)
            <div class="visitas">
                <p>Visitas al perfil: {{$user->visits}}</p>
            </div>
            @endif
            <div class="col-md-4">
                <div class="profile-img">
                    @if($user->verified)
                    <span class="verified">#</span>
                    @endif
                    <div class="div-img">
                        <span class="verified">#</span>
                        @if($user->image)
                        <img src="{{url('mi-perfil/get-image/'.$user->image)}}" alt="Encuentra Pianista avatar"
                            class="rounded-circle" width="45" height="45" />
                        @else
                        <img src="{{url('assets')}}/images/user.png" alt="Encuentra Pianista avatar" class="rounded-circle"
                            width="45" height="45" />
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        {{$user->name}}
                        @if($user->verified == 1)
                        <span title="Verificado" style="margin-top:-2px; font-size:18px; color:#1b82d6;"><i
                                class="fa-solid fa-circle-check"></i></span>
                        @endif
                    </h5>

                    @if($user->getRoleNames()[0] == 'pianista')
                    <h6>{{str_replace('-', ' ', ucfirst($user->getRoleNames()[0]))}}</h6>
                    @else
                    <h6 style="color:#e8b210!important;">{{str_replace('-', ' ', ucfirst($user->getRoleNames()[0]))}}
                    </h6>
                    @endif

                    {{--<p class="proile-rating">
                        <span>
                            @if(count($user->ratings)>0)
                            Total valoraciones: {{count($user->ratings)}}
                            <br />
                            Valoracion: {{$user->ratings->avg('rate')}}/10
                            <br>
                            <small style="color:#1971d1; cursor: pointer;" data-toggle="modal"
                                data-target="#ver-valoraciones">Ver todas las valoraciones</small>
                            @include('partials.modals.ver_valoraciones')
                            @else
                            Sin valoraciones
                            @endif
                        </span>
                    </p>--}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Información</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Más</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- <div class="col-md-2">
                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" />
            </div> -->
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="profile-work">
                    <p>Especialidades</p>

                    @if(count($user->professor_specialties)>0)
                    @if(count($user->professor_specialties)>5)
                    <a style="cursor: inherit;">Ver todas ({{count($user->professor_specialties)}})
                        <i style="font-size: 17px; cursor:pointer;" class="info-specialty fa-solid fa-circle-info ml-2"
                            data-toggle="modal" data-target="#ver-especialidades"></i>
                    </a>
                    @include('partials.modals.ver_especialidades')
                    @else
                    @foreach ($user->professor_specialties as $especialidad)
                    <a href="#" style="cursor: inherit;">{{$especialidad->specialty}}</a><br />
                    @endforeach
                    @endif
                    @else
                    <a href="">Sin configurar</a><br />
                    @endif
                    <p>Eventos a Acompañar</p>
                    @if(count($user->professor_accompaniments)>0)
                    @if(count($user->professor_accompaniments)>3)
                    <a style="cursor: inherit;">Ver todas ({{count($user->professor_accompaniments)}})
                        <i style="font-size: 17px; cursor:pointer;" class="info-specialty fa-solid fa-circle-info ml-2"
                            data-toggle="modal" data-target="#ver-acompañamientos"></i>
                    </a>
                    @include('partials.modals.ver_acompañamientos')
                    @else
                    @foreach ($user->professor_accompaniments as $acompañamiento)
                    <a href="#" style="cursor: inherit;">{{$acompañamiento->accompaniment}}</a><br />
                    @endforeach
                    @endif
                    @else
                    <a href="">Sin configurar</a><br />
                    @endif
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @if(isset($user->config_professor->biography))
                        <div class="row mb-4 bio">
                            <div class="col-md-12">
                                <label>Biografía</label><br />
                                <p>{{$user->config_professor->biography}}</p>
                            </div>
                        </div>
                        @else
                        <div class="row mb-4 bio">
                            <div class="col-md-12">
                                <label>Biografía</label><br />
                                <p>Sin configurar</p>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nombre</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$user->name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Localización/es</label>
                            </div>
                            <div class="col-md-6">

                                @if(count($user->professor_locations)>0)
                                <p style="cursor: pointer" data-toggle="modal" data-target="#ver-localizaciones">Ver</p>
                                @include('partials.modals.ver_localizaciones')
                                @else
                                <p>Sin configurar</p>
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Formación</label>
                            </div>
                            <div class="col-md-6">
                                @if(isset($user->config_professor->education))
                                <p>{{$user->config_professor->education}}</p>
                                @else
                                <p>Sin configurar</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row bio">
                            <div class="col-md-6">
                                <label>Precio (€/h)</label>
                            </div>
                            <div class="col-md-6">
                                @if(isset($user->config_professor->price))
                                <p>{{$user->config_professor->price}}€/h</p>
                                @else
                                <p>Sin configurar</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Total solicitudes</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{count($user->contact_requests)}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Idiomas</label>
                            </div>
                            <div class="col-md-6">
                                @if(count($user->professor_languages)>0)
                                @foreach ($user->professor_languages as $lang)
                                <p>{{$lang->language}} - {{$lang->level}}</p>
                                @endforeach
                                @else
                                <p>Sin configurar</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Usuario desde</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
@endsection