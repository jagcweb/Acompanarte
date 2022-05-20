<div class="w-100 text-center">
    <p>Actual disponibilidad geográfica: {{Auth::user()->config_professor->availability}}</p>
    @switch(Auth::user()->config_professor->availability)
    @case('Comunidad Autónoma')
    <p>Comunidad autónoma: {{Auth::user()->config_professor->community}}</p>
    @break

    @case('Provincial')
    <p>Comunidad autónoma: {{Auth::user()->config_professor->community}}</p>
    <p>Provincia: {{Auth::user()->config_professor->province}}</p>
    @break

    @case('Población')
    <p>Comunidad autónoma: {{Auth::user()->config_professor->community}}</p>
    <p>Provincia: {{Auth::user()->config_professor->province}}</p>
    <p>Población: {{Auth::user()->config_professor->city}}</p>
    @break
    @endswitch
</div>
<div class="card">

    <div class="card-body">
        <form method="POST" class="form" action="{{ route('configuration_professor.update') }}" autocomplete="off">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row mb-3">
                            <label for="geografica" class="col-md-4 col-form-label text-md-end">{{ __('Disponibilidad
                                geográfica') }}*</label>

                            <div class="col-md-12">
                                <select id="disponibilidad"
                                    class="form-control @error('disponibilidad') is-invalid @enderror"
                                    name="disponibilidad" required>
                                    <option selected hidden value="{{Auth::user()->config_professor->availability}}">{{Auth::user()->config_professor->availability}}</option>
                                    <option value="Nacional">Nacional</option>
                                    <option value="Comunidad Autónoma">Comunidad Autónoma</option>
                                    <option value="Provincial">Provincial</option>
                                    <option value="Población">Población</option>
                                </select>

                                @error('disponibilidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 comunidad_div d-none">
                            <label for="comunidad" class="col-md-4 col-form-label text-md-end">{{ __('Comunidad
                                Autónoma') }}*</label>


                            <div class="col-md-12">
                                <select id="comunidad" class="form-control @error('comunidad') is-invalid @enderror"
                                    name="comunidad">
                                    <option selected hidden disabled>Selecciona una comunidad...</option>
                                    @foreach($comunidades as $comunidad)
                                    <option value="{{$comunidad->comunidad_autonoma}}">
                                        {{$comunidad->comunidad_autonoma}}</option>
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
                            <label for="provincia" class="col-md-4 col-form-label text-md-end">{{ __('Provincia')
                                }}*</label>

                            <div class="col-md-12">
                                <select id="provincia" class="form-control @error('provincia') is-invalid @enderror"
                                    name="provincia">
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
                            <label for="poblacion" class="col-md-4 col-form-label text-md-end">{{ __('Población')
                                }}*</label>

                            <div class="col-md-12">
                                <select id="poblacion" class="form-control @error('poblacion') is-invalid @enderror"
                                    name="poblacion">
                                    <option selected hidden disabled>Selecciona una poblacion...</option>
                                </select>

                                @error('provincia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3 mt-4 ">
                            <label for="formacion" class="col-md-4 col-form-label text-md-end">{{ __('Formación')
                                }}*</label>

                            <div class="col-md-12">
                                <select id="formacion" class="form-control @error('formacion') is-invalid @enderror"
                                    name="formacion">
                                    <option  selected hidden value="{{Auth::user()->config_professor->education}}">{{Auth::user()->config_professor->education}}</option>
                                    <option value="Título Profesional">Título Profesional</option>
                                    <option value="Grado Superior">Grado Superior</option>
                                    <option value="Máster Universitario">Máster Universitario</option>
                                </select>

                                @error('formacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        @include('partials.specialty2')

                        @include('partials.accompaniment2')

                        <div class="row mb-3 mt-4 ">
                            <label for="precio" class="col-md-4 col-form-label text-md-end">{{ __('Precio €/h')
                                }}</label>

                            <div class="col-md-12">
                                <input id="precio" type="number" class="form-control precio" name="precio" step="0.1" min="1" @if(Auth::user()->config_professor->price) value="{{Auth::user()->config_professor->price}}" @endif />

                                @error('precio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <p class=" mb-3 mt-4 w-100 text-center font-22">Otra formación y experiencia</p>

                        @foreach (json_decode(Auth::user()->config_professor->other_degrees ,true) as $i=>$other_degree)
                            <div class="row mb-3 otros_titulos_row" data="{{$i}}">
                                <label for="otros" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Otros títulos')}}
                                    @if($i >= 1)
                                        <span data="{{$i}}" class="otros_titulos_delete text-danger ml-2" style="cursor: pointer;"><i class="fa-solid fa-circle-xmark"></i></span>
                                    @endif
                                </label>

                                <div class="col-md-12">
                                    <input type="text" id="otros" class="form-control @error('otros') is-invalid @enderror"
                                        name="otros[]" value="{{$other_degree}}"/>

                                    @error('otros')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach

                        <span class="otros_titulos_total d-none">{{count(json_decode(Auth::user()->config_professor->other_degrees ,true))}}</span>

                        <div class="otros_titulos_append"></div>

                        <button type="button" class='btn btn-dark waves-effect waves-dark w-100 otros_titulos_add'>Añadir más</button>

                        @foreach (Auth::user()->professor_languages as $j=>$language)
                            <div class="row mb-3 idiomas_row" data="{{$j}}">
                                <label for="idiomas" class="col-md-12 col-form-label text-md-end">
                                    {{ __('Idiomas y nivel') }}
                                    @if($j >= 1)
                                        <span data="{{$i}}" class="idiomas_delete text-danger ml-2" style="cursor: pointer;"><i class="fa-solid fa-circle-xmark"></i></span>
                                    @endif
                                </label>

                                <div class="col-md-6">
                                    <input type="text" id="idiomas"
                                        class="form-control @error('idiomas') is-invalid @enderror" name="idiomas[]" value="{{$language->language}}"/>

                                    @error('idiomas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <select class="form-control" id="nivel" name="nivel[]">
                                        <option selected hidden value="{{$language->level}}">{{$language->level}}</option>
                                        <option value="Básico">Básico</option>
                                        <option value="Intermedio">Intermedio</option>
                                        <option value="Avanzado">Avanzado</option>
                                        <option value="Nativo">Nativo</option>
                                    </select>

                                    @error('nivel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                    @endforeach

                        <div class="idiomas_append"></div>

                        <span class="idiomas_total d-none">{{count(Auth::user()->professor_languages)}}</span>

                        <button type="button" class='btn btn-dark waves-effect waves-dark w-100 idiomas_add'>Añadir más</button>

                        <div class="row mb-3">
                            <label for="exp" class="col-md-4 col-form-label text-md-end">{{ __('Experiencia
                                profesional') }}</label>

                            <div class="col-md-12">
                                <input type="text" id="exp" class="form-control @error('exp') is-invalid @enderror"
                                    name="exp" value="{{Auth::user()->config_professor->experience}}" />

                                @error('exp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn">
                                {{ __('Modificar') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </form>