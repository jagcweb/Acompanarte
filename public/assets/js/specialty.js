$( ".todos" ).change(function() {
    if($(this).is(':checked')){
        $('.especialidad').prop('checked', true);
    }else{
        $('.especialidad').prop('checked', false);
    }
});