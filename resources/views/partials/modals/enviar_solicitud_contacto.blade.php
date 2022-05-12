<div class="modal fade" id="enviar-solicitud-{{$prof->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-center" id="myCenterModalLabel">Enviar solicitud de contacto a <b>{{$prof->fullname}}</b></h4>
                <button type="button" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-4">
            <form method="POST" action="{{route('contact_request.save')}}">
            @csrf

                <div class="row mb-3">
                    <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre *') }}</label>

                    <div class="col-md-12">
                        <input type="text" value="{{Auth::user()->name}}" id="nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required/>

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
                        <input type="email" id="email" value="{{Auth::user()->email}}" class="form-control @error('email') is-invalid @enderror" name="email" required/>

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
                        <input type="text" id="telefono" class="form-control @error('telefono') is-invalid @enderror" name="telefono" maxlength="9" minlength="9" required/>

                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="acompañamiento" class="col-md-4 col-form-label text-md-end">{{ __('Acompañamiento *') }}</label>

                    <div class="col-md-12">
                        <select id="acompañamiento" class="form-control @error('acompañamiento') is-invalid @enderror" name="acompañamiento">
                            <option selected hidden disabled></option>
                            <option value="Pruebas de acceso a Conservatorio Profesional">Pruebas de acceso a Conservatorio Profesional</option>
                            <option value="Pruebas de acceso a Conservatorio Superior">Pruebas de acceso a Conservatorio Superior</option>
                            <option value="Oposiciones">Oposiciones</option>
                            <option value="Conciertos">Conciertos</option>
                            <option value="Otros">Otros</option>
                        </select>

                        @error('acompañamiento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="fecha" class="col-md-4 col-form-label text-md-end">{{ __('Fecha del evento (Opcional)') }}</label>

                    <div class="col-md-12">
                        <input type="date" id="fecha" class="form-control @error('fecha') is-invalid @enderror" name="fecha" />

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
                        <select class="form-control ensayo @error('ensayo') is-invalid @enderror" name="ensayo" id="ensayo" required>
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
                        <input type="number" id="num_ensayo" class="form-control @error('num_ensayo') is-invalid @enderror" name="num_ensayo" min="1" />

                        @error('num_ensayo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="mensaje" class="col-md-4 col-form-label text-md-end">{{ __('Mensaje (opcional)') }}</label>

                    <div class="col-md-12">
                        <textarea id="mensaje" class="form-control @error('mensaje') is-invalid @enderror" name="mensaje"></textarea>

                        @error('mensaje')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <input type="text" class="form-control" name="profesor_id" value="{{\Crypt::encryptString($prof->id)}}" required hidden/>

                <input type="submit" class='btn btn-dark waves-effect waves-dark w-100' value="Enviar solicitud">
            </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $( document ).ready(function() {
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
    });
</script>

