$(".searcher-input").on("keyup", function(e) {
    const searcher = $(this).val();
    const suggestions = $('#suggestions');
    $.ajax({
        url: `buscar-pianista/autocomplete-location/${searcher}`,
        method: 'GET'
    }).done(function (res) {
        let values = JSON.parse(res);
        suggestions.empty();
        values.forEach( function(valor, indice) {
            suggestions.append(`<p class="suggestion-p"> ${valor.poblacion} </p>`);
        });
        $(".suggestion-p").on("click", function(e) {
            const value = $(this).text();
            $(".searcher-input").val(value);
            suggestions.empty();
        })
    });
})