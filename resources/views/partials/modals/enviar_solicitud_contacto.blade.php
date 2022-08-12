<div class="modal fade" id="enviar-solicitud-{{$prof->id}}" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-center" id="myCenterModalLabel">Enviar solicitud de contacto a <b>{{$prof->name}}</b></h4>
                <button type="button" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-4">
            <form method="POST" action="{{route('contact_request.save')}}" enctype='multipart/form-data'>
            @csrf

                <div class="row mb-3">
                    <label for="ciudad" class="col-md-4 col-form-label text-md-end">{{ __('Ciudad') }}</label>

                    <div class="col-md-12">
                        <input type="text" value="{{$location}}" id="ciudad"  class="@error('ciudad') is-invalid @enderror" name="ciudad" required readonly/>

                        @error('ciudad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="especialidad" class="col-md-4 col-form-label text-md-end">{{ __('Especialidad') }}</label>

                    <div class="col-md-12">
                        <input type="text" value="{{$especialidad}}" id="especialidad"  class="@error('especialidad') is-invalid @enderror" name="especialidad" required readonly/>

                        @error('especialidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="acompañamiento" class="col-md-4 col-form-label text-md-end">{{ __('Evento a acompañar') }}</label>

                    <div class="col-md-12">
                        <input type="text" value="{{$acompañamiento}}" id="acompañamiento"  class="@error('acompañamiento') is-invalid @enderror" name="acompañamiento" required readonly/>

                        @error('acompañamiento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="ciudad" class="col-md-4 col-form-label text-md-end">{{ __('Ciudad') }}</label>

                    <div class="col-md-12">
                        <input type="text" value="{{$location}}" id="ciudad"  class="@error('ciudad') is-invalid @enderror" name="ciudad" required readonly/>

                        @error('ciudad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre *') }}</label>

                    <div class="col-md-12">
                        <input type="text" value="{{Auth::user()->name}}" id="nombre"  class="@error('nombre') is-invalid @enderror" name="nombre" required/>

                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email *') }}</label>

                    <div class="col-md-12">
                        <input type="email" id="email" value="{{Auth::user()->email}}"  class="@error('email') is-invalid @enderror" name="email" required/>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="telefono" class="col-md-4 col-form-label text-md-end">{{ __('Teléfono de contacto *') }}</label>

                    <div class="col-md-12">
                        <input type="text" id="telefono"  class="@error('telefono') is-invalid @enderror" name="telefono" maxlength="9" minlength="9" required/>

                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="fecha" class="col-md-4 col-form-label text-md-end">{{ __('Fecha del evento (Opcional)') }}</label>

                    <div class="col-md-12">
                        <input type="date" id="fecha"  class="@error('fecha') is-invalid @enderror" name="fecha" />

                        @error('fecha')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="ensayo" class="col-md-4 col-form-label text-md-end">{{ __('¿Requiere ensayos? *') }}</label>

                    <div class="col-md-12">
                        <select  class="ensayo @error('ensayo') is-invalid @enderror" name="ensayo" id="ensayo" required>
                            <option hidden selected disabled></option>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>

                        @error('ensayo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 num_ensayo_row d-none">
                    <label for="num_ensayo" class="col-md-4 col-form-label text-md-end">{{ __('Número de ensayos *') }}</label>

                    <div class="col-md-12">
                        <input type="number" id="num_ensayo"  class="@error('num_ensayo') is-invalid @enderror" name="num_ensayo" min="1" />

                        @error('num_ensayo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Partitura PDF') }}</label>
                    <div class="col-md-12">
                        <label for="image"class="type-file">
                            <i class="fa-solid fa-cloud-arrow-up mr-2"></i>{{ __('Escoger PDF') }}
                        </label>
                        <input type="file" id="image" style="display: none;" class="@error('pdf') is-invalid @enderror" name="pdf" accept=".pdf"/>
                        <br>
                        <span class="selected-img"></span>

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- <p class="mt-2 w-100 text-center" style="font-size:18px;">Repertorio</p>
                <div class="row mb-3">
                    <label for="composer" class="col-md-4 col-form-label text-md-end">{{ __('Compositor *') }}</label>

                    <div class="col-md-12">
                        <select  class="composer" name="composer" data="0" required>
                            <option hidden selected disabled>Selecciona un compositor...</option>
                            @foreach ($composers as $composer)
                                <option value="{{$composer->composer}}">{{$composer->composer}}</option>
                            @endforeach
                        </select>

                        @error('composer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="piece" class="col-md-4 col-form-label text-md-end">{{ __('Obra *') }}</label>

                    <div class="col-md-12">
                        <select class="piece" name="piece" data="0" required>
                            <option hidden selected disabled>Selecciona una obra...</option>
                            <option disabled>Selecciona un compositor para cargar las obras...</option>
                        </select>

                        @error('piece')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <span class='add_repertoire d-block btn btn-dark waves-effect waves-dark w-75' style="border-radius:9999px; margin:0px auto;">+ obras</span>

                <div class="append_repertoire mt-3"></div> --}}

                <input type="text"  name="pianista_id" value="{{\Crypt::encryptString($prof->id)}}" required hidden/>

                <input type="submit" class='btn btn-dark waves-effect waves-dark w-100 mt-5' value="Enviar solicitud">
            </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
    input,
    select,
    textarea {
        border: none;
        border: 1px solid #ccc;
        border-radius: 99999px!important;
        width: 100%;
        color: #000;
        outline-color: #FCA03E!important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $( document ).ready(function() {
        i = 1;
        getPieces();
        addRepertoire();

        function getPieces() {
            $('.composer').select2({ width: '100%', dropdownParent: $('.modal .modal-content') });
            $('.piece').select2({ width: '100%', dropdownParent: $('.modal .modal-content') });
            $(`.composer`).change(function() {
                const url = `buscar-pianista/autocomplete-pieces/${$(this).val()}`;
                const pieceSelect = $(`.piece[data="${$(this).attr('data')}"]`);
                pieceSelect.empty().append('<option selected="selected" disabled hidden>Cargando obras...</option>');
                $.ajax({
                    url: url,
                    method: 'GET'
                }).done(function(res) {
                    const pieces = JSON.parse(res);
                    pieceSelect.empty().append('<option selected="selected" disabled hidden>Selecciona una obra...</option>');
                    pieces.forEach(function(valor, indice) {
                        pieceSelect.append(`<option value="${valor.title}"> ${valor.title} </option>`).trigger('change');
                    });
                });
            });
        }

        function addRepertoire(){
            $( ".add_repertoire" ).click(function() {
                $(".append_repertoire").append(`<div class="appended" data="${i}" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;border-radius: 20px;position: relative;padding: 15px;"><span data="${i}" class="delete_repertoire text-danger ml-2" style="cursor: pointer; position:absolute; top: 5%; right: 2%;"><i class="fa-solid fa-circle-xmark"></i></span><div class="row mb-3"> <label for="composer" class="col-md-4 col-form-label text-md-end">{{ __('Compositor *') }}</label> <div class="col-md-12"> <select class="composer" name="composer" data="${i}" required> <option hidden selected disabled>Selecciona un compositor...</option> </select> </div> </div> <div class="row mb-3"> <label for="piece" class="col-md-4 col-form-label text-md-end">{{ __('Obra *') }}</label> <div class="col-md-12"> <select class="piece" name="piece" data="${i}" required> <option hidden selected disabled>Selecciona una obra...</option> <option disabled>Selecciona un compositor para cargar las obras...</option> </select> </div> </div></div>`);

                const composersUrl = `buscar-pianista/autocomplete-composers`;
                const composerSelect = $(`.composer[data="${i}"]`);
                composerSelect.empty().append('<option selected="selected" disabled hidden>Cargando compositores...</option>');
                $.ajax({
                    url: composersUrl,
                    method: 'GET'
                }).done(function(res) {
                    const composers = JSON.parse(res);
                    composerSelect.empty().append('<option selected="selected" disabled hidden>Selecciona un compositor...</option>');
                    composers.forEach(function(valor, indice) {
                        composerSelect.append(`<option value="${valor.composer}"> ${valor.composer} </option>`).trigger('change');
                    });

                    getPieces();
                });

                i++;
                deleteRepertoire();
            });
        }

        function deleteRepertoire(){
            $( ".delete_repertoire" ).click(function() {
                const appendeddiv = $(`.appended[data="${$(this).attr('data')}"]`).remove();
            });
        }

        $( "#ensayo" ).change(function() {
            const value = parseInt($(this).val());
            if(value === 1){
                $('.num_ensayo_row').removeClass('d-none');
                $('#num_ensayo').prop('required', true);
            }else{
                $('.num_ensayo_row').addClass('d-none');
                $('#num_ensayo').prop('required', false);
            }
        });

        $("#image").on("change", function(e) {
            const img = $(this).val().split("\\");
            $('.selected-img').text(`Partitura seleccionada: ${img[2]}`);
        });
    });
</script>

