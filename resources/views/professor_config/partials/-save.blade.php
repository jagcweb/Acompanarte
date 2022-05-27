<div class="card">

    <div class="card-body">
        <form class="form" method="POST" action="{{ route('configuration_professor.save') }}">
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
                                    <option selected hidden disabled>Selecciona un tipo de disponibilidad...</option>
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
                                    name="formacion"required>
                                    <option selected hidden disabled>Selecciona una formación...</option>
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

                        @include('partials.specialty')

                        @include('partials.accompaniment')

                        <div class="row mb-3 mt-4 font-22">
                            <p class="text-center w-100">{{ __("Lugar de ensayo") }}</p>
                                <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                    <input
                                        type="checkbox"
                                        value="1"
                                        class="form-control lugar"
                                        name="lugar"
                                    />
                                    <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                                        __("¿Dispone de lugar de ensayo?")
                                    }}</label>
                                </div>
                        
                            @error('lugar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
                                <input
                                    type="checkbox"
                                    value="1"
                                    class="form-control lugar_piano"
                                    name="lugar_piano"
                                />
                                <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                                    __("¿Dispone de lugar de ensayo con piano de cola?")
                                }}</label>
                            </div>
                    
                            @error('lugar_piano')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>        

                        <div class="row mb-3 mt-4 ">
                            <label for="precio" class="col-md-4 col-form-label text-md-end">{{ __('Precio €/h')
                                }}</label>

                            <div class="col-md-12">
                                <input id="precio" type="number" class="form-control precio" name="precio" step="0.1" min="1" />

                                @error('precio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <p class=" mb-3 mt-4 w-100 text-center font-22">Biografía</p>
                        <div class="row mb-3">
                            <label for="biography" class="col-md-4 col-form-label text-md-end">{{ __('Otros títulos')
                                }}</label>

                            <div class="col-md-12">
                                <textarea id="biography" class="form-control @error('biography') is-invalid @enderror"
                                    name="biography" placeholder="Otros títulos, certificados, experiencia..." maxlength="255"></textarea>

                                @error('biography')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="idiomas" class="col-md-12 col-form-label text-md-end">{{ __('Idiomas') }}</label>

                            <div class="col-md-6">
                                <input type="text" id="idiomas"
                                    class="form-control @error('idiomas') is-invalid @enderror" name="idiomas[]" />

                                @error('idiomas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <select class="form-control" id="nivel" name="nivel[]">
                                    <option selected hidden disabled>Selecciona un nivel...</option>
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
                        
                        <div class="idiomas_append"></div>

                        <button type="button" class='btn btn-dark waves-effect waves-dark w-100 idiomas_add'>Añadir más</button>

                    </div>

                    <div class="row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn">
                                {{ __('Guardar') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </form>
</div>
</div>