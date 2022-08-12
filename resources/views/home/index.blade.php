@extends('layouts.app')

@section('title') Inicio @endsection
@section('content')
<link href="{{url('assets')}}/css/home.css" rel="stylesheet" />
<style>
    main {
        background: #f6f6f6 !important;
        border-bottom: 1px solid #FCA03E;
    }
</style>
<div class="s004">
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

<!-- <div class="bubblingG">
    <span id="bubblingG_1">
    </span>
    <span id="bubblingG_2">
    </span>
    <span id="bubblingG_3">
    </span>
</div>
-->

<div id="posts" class="d-flex align-items-center flex-direction-row">
    <div class="tecla1" data="0">
        <img src="{{url('assets')}}/images/TECLASINACTIVAR_comofunciona.png" style="height:450px; cursor: pointer;" />
    </div>
    
    <div class="tecla2" data="1">
        <img src="{{url('assets')}}/images/TECLASINACTIVAR_soypianista.png" style="height:450px; cursor: pointer;" />
    </div>

    <div class="tecla3" data="2">
        <img src="{{url('assets')}}/images/TECLASINACTIVAR_verificado.png" style="height:450px; cursor: pointer;" />
    </div>
</div>

<div id="mobile-posts" class="d-none align-items-center" style="flex-direction: column">
    <div class="mt-3">
        <img class="img-mobile" src="{{url('assets')}}/images/comofunciona.png" style=" cursor: pointer;" />
    </div>
    
    <div class="mt-3">
        <img class="img-mobile" src="{{url('assets')}}/images/EP5.jpg" style="cursor: pointer;" />
    </div>

    <div class="mt-3">
        <img class="img-mobile" src="{{url('assets')}}/images/EP4.jpg" style="cursor: pointer;" />
    </div>
</div>


<div class="textos mt-5">

    @if(Auth::user() && !Auth::user()->config_professor && Auth::user()->getRoleNames()[0] != 'cliente')
    <p class="w-100 text-center">Rellena la <a href="{{route('configuration_professor.index')}}">configuración</a> de tu
        cuenta para aparecer a clientes!</p>
    @endif

    <div class="mb-2 texto">
        <img class="img" src="{{url('assets')}}/images/EPicon1.png" style="max-width:150px; height:150px;" />
        <div
            style="display:flex; flex-direction:column; justify-content:center; align-items: center; max-width:700px; text-align:center;">
            <h3>Encuentra siempre un pianista acompañante</h3>
            <p>Se acabaron tus problemas para encontrar un pianista acompañante. Gracias a encuentrapianista.com, podrás
                encontrar siempre a tu pianista en poco tiempo.</p>
            <p>¡Olvídate de agobios de última hora! Entra en nuestro buscador y elige el perfil de pianista que mejor te
                interese.</p>
        </div>
    </div>

    <div class="mt-5 mb-2 texto">
        <img class="img" src="{{url('assets')}}/images/EPicon3.png" style="max-width:150px; height:150px;" />
        <div
            style="display:flex; flex-direction:column; justify-content:center; align-items: center; max-width:700px; text-align:center;">
            <h3>Seguridad garantizada</h3>
            <p>En Encuentra Pianista nos esforzamos siempre para ofrecer una página web segura que proteja a todos
                aquellos que la usan. Siempre vamos a garantizar tu privacidad así como la protección de tus datos. Tus
                datos de contacto únicamente se compartirán con aquellas personas que contactes para contratar u ofrecer
                tu servicio.</p>
        </div>
    </div>

</div>

<div style="width:100%; height: auto; margin:0px auto;">
    <img src="{{url('assets')}}/images/EPconcierto.png" style=" margin:0px auto; object-fit: contain; width:800px;"/>
</div>


<script src="{{url('assets')}}/js/extention/choices.js"></script>
<script src="{{url('assets')}}/js/home.js"></script>
<script src="{{url('assets')}}/js/specialty.js"></script>
<script>
    var textPresetVal = new Choices('#choices-text-preset-values',
{
    removeItemButton: true,
});
</script>
@endsection

@section('scripts')
@endsection