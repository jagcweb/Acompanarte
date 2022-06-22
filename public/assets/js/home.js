$(".searcher-input").on("keyup", function(e) {
    const searcher = $(this).val();
    const suggestions = $('#suggestions');
    $.ajax({
        url: `buscar-pianista/autocomplete-location/${searcher}`,
        method: 'GET'
    }).done(function(res) {
        let values = JSON.parse(res);
        suggestions.empty();
        values.forEach(function(valor, indice) {
            suggestions.append(`<p class="suggestion-p"> ${valor.poblacion} </p>`);
        });
        $(".suggestion-p").on("click", function(e) {
            const value = $(this).text();
            $(".searcher-input").val(value);
            suggestions.empty();
        })
    });
});

const posts = $('#posts');
const imageUrl = `${window.location.href}assets/images/Pentagrama-blanco.png`
$.ajax({
    url: 'https://blog.encuentrapianista.com/wp-json/wp/v2/posts?categories=11',
    method: 'GET'
}).done(function(res) {
    res.forEach(function(valor, indice) {
        $('.bubblingG').addClass('d-none');
        posts.append(`<div class="card posts" data="${indice}" style="max-height:380px!important; position:relative; height:380px!important; position:relative; width: 55%; background: #222c2b; position: relative; color:#fff; border:none; border-radius:20px;"><div class="card-body"><img class="img" style="margin: 0 auto;" src="https://via.placeholder.com/175" /><hr class="mt-4" style="border-color:#fff;"><p class="w-100 title mt-3 text-center" style="font-size: 16px;">${valor.title.rendered}</p></div></div>`);
    });
    $(".card").hover(
        function() {
            $(this).animate({
                paddingTop: "15px"
            }, 100);
            let text = '';
            let enlace = '';
            const data = $(this).attr('data');
            if (data == 0) {
                text = '<p>Si buscas un pianista que te acompañe en tus pruebas de acceso, oposiciones o cualquier evento que estés organizando… ¡Estás en el lugar correcto!</p> <p>Introduce en nuestro buscador tu especialidad instrumental (clarinete, violín, percu…), lírica (cantantes, ópera, coro…) o especialidad de artes escénicas (danza, musicales…), dinos cuál es el tipo de evento que va a ser acompañado y a continuación añade el lugar donde quieres que el pianista preste los servicios.</p><p>Envía solicitudes de contacto a el/la o los/las pianistas que prefieras y en breve se pondrán en contacto contigo. ¡Así de simple!</p>';

                enlace = 'https://blog.encuentrapianista.com/como-funciona-encuentrapianista-com/';

            }
            if (data == 2) {
                text = '<p>Si eres pianista acompañante y deseas publicitar tus servicios en esta maravillosa web… </p><p>¡Estás de suerte! Podrás crear tu perfil registrándote a continuación.</p>'

                enlace = `${window.location.href}registrar/pianista-premium`;
            }
            if (data == 1) {
                text = '<p>A la hora de buscar pianista, recuerda que todos los pianistas acompañantes que aparezcan con el <b><u>símbolo del sostenido</u></b> en su perfil han sido verificados por nosotros, el equipo de encuentrapianista.com</p><p>Esto nos indicará que toda la información que aparece en el perfil de estos pianistas es verídica.</p>';

                enlace = 'https://blog.encuentrapianista.com/que-ventajas-tiene-contratar-a-un-pianista-verificado/';
            }
            $(this).css('box-shadow', 'rgba(149, 157, 165, 0.2) 0px 8px 24px');
            $(this).css('cursor', 'pointer');
            $(this).append(`<div class="hover_div" style="background:#444; padding:25px; position:absolute; top:0; left:0; display:flex; flex-direction:column; width: 100%; max-height:380px!important; height:380px!important; overflow:hidden; justify-content: space-between;"><div class="w-100">${text}</div><a href="${enlace}" target="_blank" class="w-100 text-center d-block" style="font-size:16px; height:40px; line-height:40px; text-decoration: none;background:transparent; border:1px solid #eee; border-radius:999px; color:#fff;">Leer artículo<i class="fa-solid fa-arrow-right-long ml-2" style="font-size:16px;"></i></a></div>`);
        },
        function() {
            $(this).css('box-shadow', 'none');
            $(this).css('cursor', 'inherit');
            $(this).find('.hover_div').last().remove();
        }
    );
});