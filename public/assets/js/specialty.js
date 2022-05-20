$(".todos").change(function() {
    if ($(this).is(':checked')) {
        $('.especialidad').prop('checked', true);
    } else {
        $('.especialidad').prop('checked', false);
    }
});

$(".todos_acompañamiento").change(function() {
    if ($(this).is(':checked')) {
        $('.acompañamiento').prop('checked', true);
    } else {
        $('.acompañamiento').prop('checked', false);
    }
});