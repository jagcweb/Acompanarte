<div class="modal fade" id="ajustar-precio-{{$price->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-center" id="myCenterModalLabel">Ajustar precio de <b>{{$price->type}}</b></h4>
                <button type="button" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-4">
            <form method="POST" action="{{route('price.update')}}">
            @csrf

                <div class="row mb-3">
                    <label for="tipo" class="col-md-4 col-form-label text-md-end">{{ __('Tipo') }}</label>

                    <div class="col-md-12">
                        <input type="text" value="{{$price->type}}" id="tipo" class="form-control @error('precio') is-invalid @enderror" name="tipo" disabled/>

                        @error('tipo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="precio" class="col-md-4 col-form-label text-md-end">{{ __('Precio') }}</label>

                    <div class="col-md-12">
                        <input type="number" value="{{$price->price}}" id="precio" class="form-control @error('precio') is-invalid @enderror" name="precio" required step="0.01"/>

                        @error('precio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="descuento" class="col-md-4 col-form-label text-md-end">{{ __('Descuento (%)') }}</label>

                    <div class="col-md-12">
                        <input type="number" value="{{$price->discount}}" id="descuento" class="form-control @error('descuento') is-invalid @enderror" name="descuento" step="1"/>

                        @error('descuento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <input type="text" class="form-control" name="price_id" value="{{$price->id}}" required hidden/>

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


