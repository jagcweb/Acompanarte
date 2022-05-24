@extends('layouts.app') 

@section('css')
<link href="{{url('assets')}}/css/profile.css" rel="stylesheet" /> 
@endsection 

@section('content')
<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    @if($user->image)
                    <img src="{{url('mi-perfil/get-image/'.$user->image)}}" alt="Acompañarte avatar"  class="rounded-circle" width="40"/>
                    @else
                    <img src="{{url('assets')}}/images/user.png" alt="Acompañarte avatar" class="rounded-circle" width="40" />
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        {{$user->name}}             
                        @if($user->verified == 1)
                            <span title="Verificado" style="margin-top:-2px; font-size:18px; color:#1b82d6;"><i class="fa-solid fa-circle-check"></i></span>
                        @endif
                    </h5>
                    
                    @if($user->getRoleNames()[0] == 'pianista')
                        <h6>{{str_replace('-', ' ', ucfirst($user->getRoleNames()[0]))}}</h6>
                    @else
                        <h6 style="color:#e8b210!important;">{{str_replace('-', ' ', ucfirst($user->getRoleNames()[0]))}}</h6>
                    @endif
                    
                    <p class="proile-rating">
                        <span>
                            @if(count($user->ratings)>0)
                            Total valoraciones: {{count($user->ratings)}}
                            <br />
                            Valoracion: {{$user->ratings->avg('rate')}}/10
                            <br>
                            <small style="color:#1971d1; cursor: pointer;" data-toggle="modal" data-target="#ver-valoraciones">Ver todas las valoraciones</small>
                            @include('partials.modals.ver_valoraciones')
                            @else
                            Sin valoraciones
                            @endif
                        </span>
                    </p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Información</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Más</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- <div class="col-md-2">
                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" />
            </div> -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    <p>Especialidades</p>

                    @if(count($user->professor_specialties)>0)
                        @if(count($user->professor_specialties)>5)  
                            <a style="cursor: inherit;">Ver todas ({{count($user->professor_specialties)}})
                                <i style="font-size: 17px; cursor:pointer;" class="info-specialty fa-solid fa-circle-info ml-2" data-toggle="modal" data-target="#ver-especialidades"></i>
                            </a>
                            @include('partials.modals.ver_especialidades')
                        @else
                            @foreach ($user->professor_specialties as $especialidad)
                                <a href="#" style="cursor: inherit;">{{$especialidad->specialty}}</a><br/>
                            @endforeach
                        @endif
                    @else
                    <a href="">Sin configurar</a><br/>
                    @endif
                    <p>Eventos a Acompañar</p>
                    @if(count($user->professor_accompaniments)>0)
                        @if(count($user->professor_accompaniments)>3)  
                        <a style="cursor: inherit;">Ver todas ({{count($user->professor_accompaniments)}})
                            <i style="font-size: 17px; cursor:pointer;" class="info-specialty fa-solid fa-circle-info ml-2" data-toggle="modal" data-target="#ver-acompañamientos"></i>
                        </a>
                        @include('partials.modals.ver_acompañamientos')
                        @else
                            @foreach ($user->professor_accompaniments as $acompañamiento)
                                <a href="#" style="cursor: inherit;">{{$acompañamiento->accompaniment}}</a><br/>
                            @endforeach
                        @endif
                    @else
                    <a href="">Sin configurar</a><br/>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                                <label>Usuario</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$user->username}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Localización</label>
                            </div>
                            <div class="col-md-6">
                                @if(is_object($user->config_professor))
                                    <p>
                                        @switch($user->config_professor->availability)
                                            @case('Nacional')
                                                Nacional
                                            @break
                                            @case('Comunidad Autónoma')
                                                {{$user->config_professor->community}}
                                            @break

                                            @case('Provincial')
                                                {{$user->config_professor->province}} ({{$user->config_professor->community}})
                                            @break

                                            @case('Población')
                                            {   {$user->config_professor->city}}, {{$user->config_professor->province}} ({{$user->config_professor->community}})
                                            @break
                                        @endswitch
                                    </p>
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
                                <p>{{$user->config_professor->education}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Experiencia</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$user->config_professor->experience}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Otros títulos</label>
                            </div>
                            <div class="col-md-6">
                                @php $otros_titulos = json_decode($user->config_professor->other_degrees, true); @endphp
                                <p>
                                    @foreach ($otros_titulos as $otro)
                                        {{$otro}}
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Precio (€/h)</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$user->config_professor->price}}€/h</p>
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
                        <div class="row">
                            <div class="col-md-12">
                                <label>Your Bio</label><br/>
                                <p>YouYour detail descripweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeetionYour detail descripweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeetion    r detail descripweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeetion</p>
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