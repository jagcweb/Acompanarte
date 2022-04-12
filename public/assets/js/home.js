$(".searcher-input").on("keyup", function(e) {
    const searcher = $(this).val();
    const suggestions = $('#suggestions');
    $.ajax({
        url: `buscar-profesor/autocomplete-location/${searcher}`,
        method: 'GET'
    }).done(function (res) {
        let values = JSON.parse(res);
        suggestions.empty();
        console.log(values);
        values.forEach( function(valor, indice) {
            suggestions.append(`<p> ${valor.poblacion} </p>`);
        });
    });
})