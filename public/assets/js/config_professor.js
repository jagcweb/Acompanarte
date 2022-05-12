$('#comunidad').select2({ width: '100%' });
$('#provincia').select2({ width: '100%' });
$('#poblacion').select2({ width: '100%' });
$("#disponibilidad").change(function() {
    switch ($(this).val()) {
        case ('Nacional'):
            $('.comunidad_div').addClass('d-none');
            $('.provincia_div').addClass('d-none');
            $('.poblacion_div').addClass('d-none');
            $('#comunidad').prop('required', false);
            $('#provincia').prop('required', false);
            $('#poblacion').prop('required', false);
            break;
        case ('Comunidad Autónoma'):
            $('.comunidad_div').removeClass('d-none');
            $('.provincia_div').addClass('d-none');
            $('.poblacion_div').addClass('d-none');
            $('#comunidad').prop('required', true);
            $('#provincia').prop('required', false);
            $('#poblacion').prop('required', false);
            break;
        case ('Provincial'):
            var provincia = $('#provincia');
            $("#comunidad").change(function() {
                let comunidad = $(this).val();
                $.ajax({
                    url: `configuracion-profesor/get-province/${comunidad}`,
                    method: 'GET'
                }).done(function(res) {
                    const provincias = JSON.parse(res);
                    provincia.empty().append('<option selected="selected" disabled hidden>Selecciona una provincia...</option>');
                    provincias.forEach(function(valor, indice) {
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

        case ('Población'):
            var provincia = $('#provincia');
            $("#comunidad").change(function() {
                let comunidad = $(this).val();
                $.ajax({
                    url: `configuracion-profesor/get-province/${comunidad}`,
                    method: 'GET'
                }).done(function(res) {
                    const provincias = JSON.parse(res);
                    provincia.empty().append('<option selected="selected" disabled hidden>Selecciona una provincia...</option>');
                    provincias.forEach(function(valor, indice) {
                        provincia.append(`<option value="${valor.provincia}"> ${valor.provincia} </option>`).trigger('change');
                    });
                });
            });

            const poblacion = $('#poblacion');
            $("#provincia").change(function() {
                if (provincia.val()) {
                    $.ajax({
                        url: `configuracion-profesor/get-city/${provincia.val()}`,
                        method: 'GET'
                    }).done(function(res) {
                        const poblaciones = JSON.parse(res);
                        poblacion.empty().append('<option selected="selected" disabled hidden>Selecciona una población...</option>');
                        poblaciones.forEach(function(valor, indice) {
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

$('.otros_titulos_total') ? i = parseInt($('.otros_titulos_total').text()) : i = 1;
$('.idiomas_total') ? j = parseInt($('.idiomas_total').text()) : j = 1;
$(".otros_titulos_add").on("click", function() {
    $(".otros_titulos_append").append(`<div class="row mb-3 otros_titulos_row" data="${i}"> <label for="otros" class="col-md-4 col-form-label text-md-end">Otros títulos<span data="${i}" class="otros_titulos_delete text-danger ml-2" style="cursor: pointer;"><i class="fa-solid fa-circle-xmark"></i></span></label> <div class="col-md-12"> <input type="text" id="otros" class="form-control" name="otros[]" /> </div></div>`)
    i++;

    $(".otros_titulos_delete").on("click", function() {
        const data = $(this).attr('data');
        $(this).closest('.form').find(`.otros_titulos_row[data='${data}']`).remove();

        i--;
    });
});

$(".idiomas_add").on("click", function() {
    $(".idiomas_append").append(`<div class="row mb-3 idiomas_row" data="${j}"> <label for="idiomas" class="col-md-12 col-form-label text-md-end">Idiomas<span data="${j}" class="idiomas_delete text-danger ml-2" style="cursor: pointer;"><i class="fa-solid fa-circle-xmark"></i></span></label> <div class="col-md-6"> <input type="text" id="idiomas" class="form-control" name="idiomas[]" /> </div> <div class="col-md-6"> <select class="form-control" id="nivel" name="nivel[]"> <option selected hidden disabled>Selecciona un nivel...</option> <option value="Básico">Básico</option> <option value="Intermedio">Intermedio</option> <option value="Avanzado">Avanzado</option> <option value="Nativo">Nativo</option> </select> </div></div>`);
    j++;

    $(".idiomas_delete").on("click", function() {
        const data = $(this).attr('data');
        $(this).closest('.form').find(`.idiomas_row[data='${data}']`).remove();

        j--;
    });
});

$(".otros_titulos_delete").on("click", function() {
    const data = $(this).attr('data');
    console.log('dat', data);
    const row = $(this).closest('.form').find(`.otros_titulos_row[data='${data}']`).remove();

    console.log('row', row);

    i--;
});

$(".idiomas_delete").on("click", function() {
    const data = $(this).attr('data');
    $(this).closest('.form').find(`.idiomas_row[data='${data}']`).remove();

    j--;
});