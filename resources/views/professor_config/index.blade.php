@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center d-block">Disponibilidad geográfica</h2>

            @if(Auth::user()->config_professor)
                <div class="w-100 text-center">
                    <p>Actual disponibilidad geográfica: {{Auth::user()->config_professor->availability}}</p>
                    @switch(Auth::user()->config_professor->availability)
                        @case('comunidad')
                            <p>Comunidad autónoma: {{Auth::user()->config_professor->community}}</p>
                        @break

                        @case('provincia')
                            <p>Comunidad autónoma: {{Auth::user()->config_professor->community}}</p>
                            <p>Provincia: {{Auth::user()->config_professor->province}}</p>
                        @break

                        @case('poblacion')
                            <p>Comunidad autónoma: {{Auth::user()->config_professor->community}}</p>
                            <p>Provincia: {{Auth::user()->config_professor->province}}</p>
                            <p>Población: {{Auth::user()->config_professor->city}}</p>
                        @break
                    @endswitch
                </div>
                <a href="" class="w-100 btn btn-dark" style="color:#fff;">Modificar</a>
            @else
            <div class="card">
                
                <div class="card-body">
                    <form method="POST" action="{{ route('configuration_professor.save') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row mb-3">
                                        <label for="geografica" class="col-md-4 col-form-label text-md-end">{{ __('Disponibilidad geográfica') }}</label>
            
                                        <div class="col-md-6">
                                            <select id="disponibilidad" class="form-control @error('disponibilidad') is-invalid @enderror" name="disponibilidad" required>
                                                <option selected hidden disabled>Selecciona un tipo de disponibilidad...</option>
                                                <option value="nacional">Nacional</option>
                                                <option value="comunidad">Comunidad Autónoma</option>
                                                <option value="provincia">Provincial</option>
                                                <option value="poblacion">Población</option>
                                            </select>
            
                                            @error('disponibilidad')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3 comunidad_div d-none">
                                        <label for="comunidad" class="col-md-4 col-form-label text-md-end">{{ __('Comunidad Autónoma') }}</label>
                                        

                                        <div class="col-md-6">
                                            <select id="comunidad" class="form-control @error('comunidad') is-invalid @enderror" name="comunidad">
                                                <option selected hidden disabled>Selecciona una comunidad...</option>
                                                @foreach($comunidades as $comunidad)
                                                    <option value="{{$comunidad->comunidad_autonoma}}">{{$comunidad->comunidad_autonoma}}</option>
                                                @endforeach
                                            </select>
            
                                            @error('comunidad')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3 provincia_div d-none">
                                        <label for="provincia" class="col-md-4 col-form-label text-md-end">{{ __('Provincia') }}</label>

                                        <div class="col-md-6">
                                            <select id="provincia" class="form-control @error('provincia') is-invalid @enderror" name="provincia">
                                                <option selected hidden disabled>Selecciona una provincia...</option>
                                              </select>
            
                                            @error('provincia')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3 poblacion_div d-none">
                                        <label for="poblacion" class="col-md-4 col-form-label text-md-end">{{ __('Población') }}</label>

                                        <div class="col-md-6">
                                            <select id="poblacion" class="form-control @error('poblacion') is-invalid @enderror" name="poblacion">
                                                <option selected hidden disabled>Selecciona una poblacion...</option>
                                              </select>
            
                                            @error('provincia')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    
                                    <div class="row mb-3 mt-4">
                                        <p class="text-center w-100">{{ __('Especialidad') }}</p>
                                                <div class="col-md-12 d-flex justify-content-center mb-3">
                                                    <input type="checkbox" value="1" class="form-control todos" name="todos" />
                                                    <label for="check-1" class="ml-2 col-form-label ">{{ __('Todos') }}</label>
                                                </div>

                                                <div class="row col-md-12 d-flex justify-content-center">

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Acordeón" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Acordeón') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Arpa" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Arpa') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Cante Flamenco" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Cante Flamenco') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Canto" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Canto') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Clarinete" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Clarinete') }}</label>
                                                    </div>
                                                    
                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Contrabajo" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Contrabajo') }}</label>
                                                    </div>
                                                    
                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Coro" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Coro') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Fagot" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Fagot') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Flauta" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Flauta') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Guitarra" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Guitarra') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Música_Antigua_Clavecinista" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Música Antigua (Clavecinista)') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Música_Antigua_Órganista" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Música Antigua (Órganista)') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Instrumentos_de_Púa" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Instrumentos de Púa') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Oboe" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Oboe') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Orquesta" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Orquesta') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Percusión" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Percusión') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Saxofón" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Saxofón') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Trombón" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Trombón') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Trompa" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Trompa') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Tuba" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Tuba') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Viola" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Viola') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Violín" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Violín') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Violonchelo" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Violonchelo') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Danza_Clásica" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Danza Clásica') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Danza_Contemporánea" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Danza Contemporánea') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Danza_Española" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Danza Española') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Flamenco" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Flamenco') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Arte_Dramático" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Arte Dramático') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Música_de_Cámara" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Música de Cámara') }}</label>
                                                    </div>
                                                    
                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Ópera_y_Oratorio" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Ópera y Oratorio') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Musicales" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Musicales') }}</label>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                                        <input type="checkbox" value="Eventos_varios" class="form-control especialidad" name="especialidad[]" />
                                                        <label for="check-1" class="ml-2 col-form-label ">{{ __('Eventos varios (Bodas, Ceremonias, etc.)') }}</label>
                                                    </div>
                                                </div>
            
                                            @error('especialidad')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                </div>
                                
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn">
                                                {{ __('Modificar') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
$( document ).ready(function() {
    $('#comunidad').select2();
    $('#provincia').select2();
    $('#poblacion').select2();
    $( ".todos" ).change(function() {
        if($(this).is(':checked')){
            $('.especialidad').prop('checked', true);
        }else{
            $('.especialidad').prop('checked', false);
        }
    });
    $( "#disponibilidad" ).change(function() {
        switch($(this).val()) {
            case('nacional'):
                $('.comunidad_div').addClass('d-none');
                $('.provincia_div').addClass('d-none');
                $('.poblacion_div').addClass('d-none');
                $('#comunidad').prop('required', false);
                $('#provincia').prop('required', false);
                $('#poblacion').prop('required', false);
            break;
            case('comunidad'):
                $('.comunidad_div').removeClass('d-none');
                $('.provincia_div').addClass('d-none');
                $('.poblacion_div').addClass('d-none');
                $('#comunidad').prop('required', true);
                $('#provincia').prop('required', false);
                $('#poblacion').prop('required', false);
            break;
            case('provincia'):
            var provincia = $('#provincia');
                $( "#comunidad" ).change(function() {
                    let comunidad = $(this).val();
                    $.ajax({
                        url: `configuracion-profesor/get-province/${comunidad}`,
                        method: 'GET'
                    }).done(function (res) {
                        const provincias = JSON.parse(res);
                        provincia.empty().append('<option selected="selected" disabled hidden>Selecciona una provincia...</option>');
                        provincias.forEach( function(valor, indice) {
                            provincia.append(`<option value="${valor.provincia}"> ${valor.provincia} </option>`).trigger('change');
                        });
                    });
                });

                $('.comunidad_div').removeClass('d-none');
                $('.provincia_div').removeClass('d-none');
                $('.poblacion_div').addClass('d-none');
                $('#comunidad').prop('required', true);
                $('#provincia').prop('required', true);
                $('#poblacion').prop('required', false);
            break;

            case('poblacion'):
                var provincia = $('#provincia');
                $( "#comunidad" ).change(function() {
                    let comunidad = $(this).val();
                    $.ajax({
                        url: `configuracion-profesor/get-province/${comunidad}`,
                        method: 'GET'
                    }).done(function (res) {
                        const provincias = JSON.parse(res);
                        provincia.empty().append('<option selected="selected" disabled hidden>Selecciona una provincia...</option>');
                        provincias.forEach( function(valor, indice) {
                            provincia.append(`<option value="${valor.provincia}"> ${valor.provincia} </option>`).trigger('change');
                        });
                    });
                }); 
                
                const poblacion = $('#poblacion');
                $( "#provincia" ).change(function() {
                    if(provincia.val()){
                        $.ajax({
                            url: `configuracion-profesor/get-city/${provincia.val()}`,
                            method: 'GET'
                        }).done(function (res) {
                            const poblaciones = JSON.parse(res);
                            poblacion.empty().append('<option selected="selected" disabled hidden>Selecciona una población...</option>');
                            poblaciones.forEach( function(valor, indice) {
                                poblacion.append(`<option value="${valor.poblacion}"> ${valor.poblacion} </option>`).trigger('change');
                            });
                        });
                    }
                });

                $('.comunidad_div').removeClass('d-none');
                $('.provincia_div').removeClass('d-none');
                $('.poblacion_div').removeClass('d-none');
                $('#comunidad').prop('required', true);
                $('#provincia').prop('required', true);
                $('#poblacion').prop('required', true);
            break;
        }
    });
});
</script>
@endsection