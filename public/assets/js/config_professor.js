$('.comunidad').select2({ width: '100%' });
$('.provincia').select2({ width: '100%' });
$('.poblacion').select2({ width: '100%' });
$('.disponibilidad').change(function() {
    const data = $(this).attr("data");
    switch ($(this).val()) {
        case ('Nacional'):
            $('.comunidad_div[data=' + data + ']').addClass('d-none');
            $('.provincia_div[data=' + data + ']').addClass('d-none');
            $('.poblacion_div[data=' + data + ']').addClass('d-none');
            $('.comunidad[data=' + data + ']').prop('required', false);
            $('.provincia[data=' + data + ']').prop('required', false);
            $('.poblacion[data=' + data + ']').prop('required', false);
            $('.location_add').addClass('d-none');
            $('.location_append').empty();
            break;
        case ('Comunidad Autónoma'):
            var comunidad = $('.comunidad[data=' + data + ']');
            $.ajax({
                url: `configuracion-pianista/get-community`,
                method: 'GET'
            }).done(function(res) {
                const comunidades = JSON.parse(res);
                comunidad.empty().append('<option selected="selected" disabled hidden>Selecciona una comunidad...</option>');
                comunidades.forEach(function(valor, indice) {
                    comunidad.append(`<option value="${valor.comunidad_autonoma}"> ${valor.comunidad_autonoma} </option>`).trigger('change');
                });
            });
            $('.comunidad_div[data=' + data + ']').removeClass('d-none');
            $('.provincia_div[data=' + data + ']').addClass('d-none');
            $('.poblacion_div[data=' + data + ']').addClass('d-none');
            $('.comunidad[data=' + data + ']').prop('required', true);
            $('.provincia[data=' + data + ']').prop('required', false);
            $('.poblacion[data=' + data + ']').prop('required', false);
            $('.location_add').removeClass('d-none');
            break;
        case ('Provincial'):
            var comunidad = $('.comunidad[data=' + data + ']');
            console.log(comunidad);
            $.ajax({
                url: `configuracion-pianista/get-community`,
                method: 'GET'
            }).done(function(res) {
                const comunidades = JSON.parse(res);
                comunidad.empty().append('<option selected="selected" disabled hidden>Selecciona una comunidad...</option>');
                comunidades.forEach(function(valor, indice) {
                    comunidad.append(`<option value="${valor.comunidad_autonoma}"> ${valor.comunidad_autonoma} </option>`).trigger('change');
                });
            });
            var provincia = $('.provincia[data=' + data + ']');
            $('.comunidad[data=' + data + ']').change(function() {
                let comunidad_value = $(this).val();
                $.ajax({
                    url: `configuracion-pianista/get-province/${comunidad_value}`,
                    method: 'GET'
                }).done(function(res) {
                    const provincias = JSON.parse(res);
                    provincia.empty().append('<option selected="selected" disabled hidden>Selecciona una provincia...</option>');
                    provincias.forEach(function(valor, indice) {
                        provincia.append(`<option value="${valor.provincia}"> ${valor.provincia} </option>`).trigger('change');
                    });
                });
            });

            $('.comunidad_div[data=' + data + ']').removeClass('d-none');
            $('.provincia_div[data=' + data + ']').removeClass('d-none');
            $('.poblacion_div[data=' + data + ']').addClass('d-none');
            $('.comunidad[data=' + data + ']').prop('required', true);
            $('.provincia[data=' + data + ']').prop('required', true);
            $('.poblacion[data=' + data + ']').prop('required', false);
            $('.location_add').removeClass('d-none');
            break;

        case ('Población'):
            var comunidad = $('.comunidad[data=' + data + ']');
            $.ajax({
                url: `configuracion-pianista/get-community`,
                method: 'GET'
            }).done(function(res) {
                const comunidades = JSON.parse(res);
                comunidad.empty().append('<option selected="selected" disabled hidden>Selecciona una comunidad...</option>');
                comunidades.forEach(function(valor, indice) {
                    comunidad.append(`<option value="${valor.comunidad_autonoma}"> ${valor.comunidad_autonoma} </option>`).trigger('change');
                });
            });
            var provincia = $('.provincia[data=' + data + ']');
            $('.comunidad[data=' + data + ']').change(function() {
                let comunidad_value = $(this).val();
                $.ajax({
                    url: `configuracion-pianista/get-province/${comunidad_value}`,
                    method: 'GET'
                }).done(function(res) {
                    const provincias = JSON.parse(res);
                    provincia.empty().append('<option selected="selected" disabled hidden>Selecciona una provincia...</option>');
                    provincias.forEach(function(valor, indice) {
                        provincia.append(`<option value="${valor.provincia}"> ${valor.provincia} </option>`).trigger('change');
                    });
                });
            });

            const poblacion = $('.poblacion[data=' + data + ']');
            $('.provincia[data=' + data + ']').change(function() {
                if (provincia.val()) {
                    $.ajax({
                        url: `configuracion-pianista/get-city/${provincia.val()}`,
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

            $('.comunidad_div[data=' + data + ']').removeClass('d-none');
            $('.provincia_div[data=' + data + ']').removeClass('d-none');
            $('.poblacion_div[data=' + data + ']').removeClass('d-none');
            $('.comunidad[data=' + data + ']').prop('required', true);
            $('.provincia[data=' + data + ']').prop('required', true);
            $('.poblacion[data=' + data + ']').prop('required', true);
            $('.location_add').removeClass('d-none');
            break;
    }
});

i = 1;
$('.location_add').on("click", function() {
    $('.location_append').append(`<div class="location_row" data="${i}"><div style="border-bottom:1px solid #202020;"></div><div class="row mb-3"> <label for="geografica" class="col-md-4 col-form-label text-md-end">Disponibilidad geográfica*<span data="${i}" class="location_delete text-danger ml-2" style="cursor: pointer;"><i class="fa-solid fa-circle-xmark"></i></span></label> <div class="col-md-12"> <select id=""  class="disponibilidad" name="disponibilidad[]" required data="${i}"> <option selected hidden disabled>Selecciona un tipo de disponibilidad...</option> <option value="Comunidad Autónoma">Comunidad Autónoma</option> <option value="Provincial">Provincial</option> <option value="Población">Población</option> </select> </div> </div> <div class="row mb-3 comunidad_div d-none"data="${i}"> <label for="comunidad" class="col-md-4 col-form-label text-md-end">Comunidad Autónoma*</label> <div class="col-md-12"> <select id="" class="comunidad form-control " name="comunidad_${i}" data="${i}"> <option selected hidden disabled>Selecciona una comunidad...</option> </select> </div> </div> <div class="row mb-3 provincia_div d-none"data="${i}"> <label for="provincia" class="col-md-4 col-form-label text-md-end">Provincia*</label> <div class="col-md-12"> <select id="" class="provincia form-control" name="provincia_${i}" data="${i}"> <option selected hidden disabled>Selecciona una provincia...</option> </select> </div> </div> <div class="row mb-3 poblacion_div d-none"data="${i}"> <label for="poblacion" class="col-md-4 col-form-label text-md-end">Población*</label> <div class="col-md-12"> <select id="" class="poblacion form-control" name="poblacion_${i}" data="${i}"> <option selected hidden disabled>Selecciona una poblacion...</option> </select> </div> </div></div>`);
    i++;

    $('.location_delete').on("click", function() {
        const data = $(this).attr('data');
        $(this).closest('.form').find(`.location_row[data='${data}']`).remove();

        i--;
    });

    $('.disponibilidad').change(function() {
        const data = $(this).attr("data");
        switch ($(this).val()) {
            case ('Nacional'):
                $('.comunidad_div[data=' + data + ']').addClass('d-none');
                $('.provincia_div[data=' + data + ']').addClass('d-none');
                $('.poblacion_div[data=' + data + ']').addClass('d-none');
                $('.comunidad[data=' + data + ']').prop('required', false);
                $('.provincia[data=' + data + ']').prop('required', false);
                $('.poblacion[data=' + data + ']').prop('required', false);
                break;
            case ('Comunidad Autónoma'):
                var comunidad = $('.comunidad[data=' + data + ']');
                $.ajax({
                    url: `configuracion-pianista/get-community`,
                    method: 'GET'
                }).done(function(res) {
                    const comunidades = JSON.parse(res);
                    comunidad.empty().append('<option selected="selected" disabled hidden>Selecciona una comunidad...</option>');
                    comunidades.forEach(function(valor, indice) {
                        comunidad.append(`<option value="${valor.comunidad_autonoma}"> ${valor.comunidad_autonoma} </option>`).trigger('change');
                    });
                });
                $('.comunidad_div[data=' + data + ']').removeClass('d-none');
                $('.provincia_div[data=' + data + ']').addClass('d-none');
                $('.poblacion_div[data=' + data + ']').addClass('d-none');
                $('.comunidad[data=' + data + ']').prop('required', true);
                $('.provincia[data=' + data + ']').prop('required', false);
                $('.poblacion[data=' + data + ']').prop('required', false);
                break;
            case ('Provincial'):
                var comunidad = $('.comunidad[data=' + data + ']');
                $.ajax({
                    url: `configuracion-pianista/get-community`,
                    method: 'GET'
                }).done(function(res) {
                    const comunidades = JSON.parse(res);
                    comunidad.empty().append('<option selected="selected" disabled hidden>Selecciona una comunidad...</option>');
                    comunidades.forEach(function(valor, indice) {
                        comunidad.append(`<option value="${valor.comunidad_autonoma}"> ${valor.comunidad_autonoma} </option>`).trigger('change');
                    });
                });
                var provincia = $('.provincia[data=' + data + ']');
                $('.comunidad[data=' + data + ']').change(function() {
                    let comunidad_value = $(this).val();
                    $.ajax({
                        url: `configuracion-pianista/get-province/${comunidad_value}`,
                        method: 'GET'
                    }).done(function(res) {
                        const provincias = JSON.parse(res);
                        provincia.empty().append('<option selected="selected" disabled hidden>Selecciona una provincia...</option>');
                        provincias.forEach(function(valor, indice) {
                            provincia.append(`<option value="${valor.provincia}"> ${valor.provincia} </option>`).trigger('change');
                        });
                    });
                });

                $('.comunidad_div[data=' + data + ']').removeClass('d-none');
                $('.provincia_div[data=' + data + ']').removeClass('d-none');
                $('.poblacion_div[data=' + data + ']').addClass('d-none');
                $('.comunidad[data=' + data + ']').prop('required', true);
                $('.provincia[data=' + data + ']').prop('required', true);
                $('.poblacion[data=' + data + ']').prop('required', false);
                break;

            case ('Población'):
                var comunidad = $('.comunidad[data=' + data + ']');
                $.ajax({
                    url: `configuracion-pianista/get-community`,
                    method: 'GET'
                }).done(function(res) {
                    const comunidades = JSON.parse(res);
                    comunidad.empty().append('<option selected="selected" disabled hidden>Selecciona una comunidad...</option>');
                    comunidades.forEach(function(valor, indice) {
                        comunidad.append(`<option value="${valor.comunidad_autonoma}"> ${valor.comunidad_autonoma} </option>`).trigger('change');
                    });
                });
                var provincia = $('.provincia[data=' + data + ']');
                $('.comunidad[data=' + data + ']').change(function() {
                    let comunidad_value = $(this).val();
                    $.ajax({
                        url: `configuracion-pianista/get-province/${comunidad_value}`,
                        method: 'GET'
                    }).done(function(res) {
                        const provincias = JSON.parse(res);
                        provincia.empty().append('<option selected="selected" disabled hidden>Selecciona una provincia...</option>');
                        provincias.forEach(function(valor, indice) {
                            provincia.append(`<option value="${valor.provincia}"> ${valor.provincia} </option>`).trigger('change');
                        });
                    });
                });

                var poblacion = $('.poblacion[data=' + data + ']');
                $('.provincia[data=' + data + ']').change(function() {
                    if (provincia.val()) {
                        $.ajax({
                            url: `configuracion-pianista/get-city/${provincia.val()}`,
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

                $('.comunidad_div[data=' + data + ']').removeClass('d-none');
                $('.provincia_div[data=' + data + ']').removeClass('d-none');
                $('.poblacion_div[data=' + data + ']').removeClass('d-none');
                $('.comunidad[data=' + data + ']').prop('required', true);
                $('.provincia[data=' + data + ']').prop('required', true);
                $('.poblacion[data=' + data + ']').prop('required', true);
                break;
        }
    });
});

$('.location_delete').on("click", function() {
    const data = $(this).attr('data');
    $(this).closest('.form').find(`.location_row[data='${data}']`).remove();

    i--;
});

j = 1;
$('.idiomas_add').on("click", function() {
    $('.idiomas_append').append(`<div class="row mb-3 idiomas_row" data="${j}"> <label for="idiomas" class="col-md-12 col-form-label text-md-end">Idiomas<span data="${j}" class="idiomas_delete text-danger ml-2" style="cursor: pointer;"><i class="fa-solid fa-circle-xmark"></i></span></label> <div class="col-md-6"> <input type="text" id="idiomas"  name="idiomas[]" /> </div> <div class="col-md-6"> <select  id="nivel" name="nivel[]"> <option selected hidden disabled>Selecciona un nivel...</option> <option value="Básico">Básico</option> <option value="Intermedio">Intermedio</option> <option value="Avanzado">Avanzado</option> <option value="Nativo">Nativo</option> </select> </div></div>`);
    j++;

    $('.idiomas_delete').on("click", function() {
        const data = $(this).attr('data');
        $(this).closest('.form').find(`.idiomas_row[data='${data}']`).remove();

        j--;
    });
});

$('.idiomas_delete').on("click", function() {
    const data = $(this).attr('data');
    $(this).closest('.form').find(`.idiomas_row[data='${data}']`).remove();

    j--;
});