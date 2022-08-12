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


if (!window.location.href.includes('buscar-pianista')) {
    /*const posts = $('#posts');
    const imageUrl = `${window.location.href}assetsassets/images/Pentagrama-blanco.png" style="height:450px;"/>`
    const height = window.innerWidth >= 500 ? '380px' : '500px';
    $.ajax({
        url: 'https://blog.encuentrapianista.com/wp-json/wp/v2/posts?categories=11',
        method: 'GET'
    }).done(function(res) {
        res.forEach(function(valor, indice) {
            $('.bubblingG').addClass('d-none');
            posts.append(`<div class="card posts" data="${indice}" style=" max-height:${height}!important; position:relative; height:${height}!important; position:relative; width:200px; background: #222c2b; position: relative; color:#fff; border:none; border-radius:20px;"><div class="card-body"><img class="img" style="margin: 0 auto;" src="https://via.placeholder.com/175" /><hr class="mt-4" style="border-color:#fff;"><p class="w-100 title mt-3 text-center" style="font-size: 16px;">${valor.title.rendered}</p></div></div>`);
        });
        let i = 0;
        $(".card").click(function() {
            const data = $(this).attr('data');
            let text = '';
            let enlace = '';

            if (i % 2 == 0) {
                if (data == 0) {

                    if (window.innerWidth >= 500) {
                        $('.card[data="1"').css('display', 'none');
                        $('.card[data="2"').css('display', 'none');
                        $(this).css('width', '100%');
                    }
                    text = '<p>Si buscas un pianista que te acompañe en tus pruebas de acceso, oposiciones o cualquier evento que estés organizando… ¡Estás en el lugar correcto!</p> <p>Introduce en nuestro buscador tu especialidad instrumental (clarinete, violín, percu…), lírica (cantantes, ópera, coro…) o especialidad de artes escénicas (danza, musicales…), dinos cuál es el tipo de evento que va a ser acompañado y a continuación añade el lugar donde quieres que el pianista preste los servicios.</p><p>Envía solicitudes de contacto a el/la o los/las pianistas que prefieras y en breve se pondrán en contacto contigo. ¡Así de simple!</p>';

                    enlace = 'https://blog.encuentrapianista.com/como-funciona-encuentrapianista-com/';

                }
                if (data == 2) {

                    if (window.innerWidth >= 500) {
                        $('.card[data="1"').css('display', 'none');
                        $('.card[data="0"').css('display', 'none');
                        $(this).css('width', '100%');
                    }
                    text = '<p>Si eres pianista acompañante y deseas publicitar tus servicios en esta maravillosa web… </p><p>¡Estás de suerte! Podrás crear tu perfil registrándote a continuación.</p>'

                    enlace = `${window.location.href}registrar/pianista-premium`;
                }
                if (data == 1) {

                    if (window.innerWidth >= 500) {
                        $('.card[data="0"').css('display', 'none');
                        $('.card[data="2"').css('display', 'none');
                        $(this).css('width', '100%');
                    }
                    text = '<p>A la hora de buscar pianista, recuerda que todos los pianistas acompañantes que aparezcan con el <b><u>símbolo del sostenido</u></b> en su perfil han sido verificados por nosotros, el equipo de encuentrapianista.com</p><p>Esto nos indicará que toda la información que aparece en el perfil de estos pianistas es verídica.</p>';

                    enlace = 'https://blog.encuentrapianista.com/que-ventajas-tiene-contratar-a-un-pianista-verificado/';
                }
                $(this).css('box-shadow', 'rgba(149, 157, 165, 0.2) 0px 8px 24px');
                $(this).css('cursor', 'pointer');
                $(this).append(`<div class="hover_div" style="background:#444; padding:25px; position:absolute; top:0; left:0; display:flex; flex-direction:column; width: 100%; max-height:${height}!important; height:${height}!important; overflow:hidden; justify-content: space-between;"><div class="w-100">${text}</div><a href="${enlace}" target="_blank" class="w-100 text-center d-block" style="font-size:16px; height:40px; line-height:40px; text-decoration: none;background:transparent; border:1px solid #eee; border-radius:999px; color:#fff;">Leer artículo<i class="fa-solid fa-arrow-right-long ml-2" style="font-size:16px;"></i></a></div>`);

            } else {
                $(this).css('width', '200px');
                if (data == 0) {
                    $('.card[data="1"').css('display', 'block');
                    $('.card[data="2"').css('display', 'block');
                }
                if (data == 2) {
                    $('.card[data="1"').css('display', 'block');
                    $('.card[data="0"').css('display', 'block');
                }
                if (data == 1) {
                    $('.card[data="0"').css('display', 'block');
                    $('.card[data="2"').css('display', 'block');
                }

                $(this).css('box-shadow', 'none');
                $(this).css('cursor', 'inherit');
                $(this).find('.hover_div').remove();
            }
            i++;
        });
    });*/

    if (window.innerWidth <= 768) {
        $('#posts').removeClass('d-flex');
        $('#posts').addClass('d-none');

        $('#mobile-posts').removeClass('d-none');
        $('#mobile-posts').addClass('d-flex');

        $('.img-mobile').css('height', '400px');

        if (window.innerWidth <= 480) {
            $('.img-mobile').css('height', '350px');
        }

        if (window.innerWidth <= 375) {
            $('.img-mobile').css('height', '300px');
        }
    }

    console.log(window.location.href);

    $(".tecla1").hover(
        function() {
            $(this).find('img').attr('src', `${window.location.href}assets/images/TECLAACTIVA_comofunciona.png`);
        },
        function() {
            $(this).find('img').attr('src', `${window.location.href}assets/images/TECLASINACTIVAR_comofunciona.png`);
        }
    );

    $(".tecla2").hover(
        function() {
            $(this).find('img').attr('src', `${window.location.href}assets/images/TECLAACTIVA_soypianista.png`);
        },
        function() {
            $(this).find('img').attr('src', `${window.location.href}assets/images/TECLASINACTIVAR_soypianista.png`);
        }
    );

    $(".tecla3").hover(
        function() {
            $(this).find('img').attr('src', `${window.location.href}assets/images/TECLAACTIVA_verificado.png`);
        },
        function() {
            $(this).find('img').attr('src', `${window.location.href}assets/images/TECLASINACTIVAR_verificado.png`);
        }
    );

    $(".card").click(function() {
        const data = $(this).attr('data');
        let text = '';
        let enlace = '';

        if (i % 2 == 0) {
            if (data == 0) {

                if (window.innerWidth >= 500) {
                    $('.card[data="1"').css('display', 'none');
                    $('.card[data="2"').css('display', 'none');
                    $(this).css('width', '100%');
                }
                text = '<p>Si buscas un pianista que te acompañe en tus pruebas de acceso, oposiciones o cualquier evento que estés organizando… ¡Estás en el lugar correcto!</p> <p>Introduce en nuestro buscador tu especialidad instrumental (clarinete, violín, percu…), lírica (cantantes, ópera, coro…) o especialidad de artes escénicas (danza, musicales…), dinos cuál es el tipo de evento que va a ser acompañado y a continuación añade el lugar donde quieres que el pianista preste los servicios.</p><p>Envía solicitudes de contacto a el/la o los/las pianistas que prefieras y en breve se pondrán en contacto contigo. ¡Así de simple!</p>';

                enlace = 'https://blog.encuentrapianista.com/como-funciona-encuentrapianista-com/';

            }
            if (data == 2) {

                if (window.innerWidth >= 500) {
                    $('.card[data="1"').css('display', 'none');
                    $('.card[data="0"').css('display', 'none');
                    $(this).css('width', '100%');
                }
                text = '<p>Si eres pianista acompañante y deseas publicitar tus servicios en esta maravillosa web… </p><p>¡Estás de suerte! Podrás crear tu perfil registrándote a continuación.</p>'

                enlace = `${window.location.href}registrar/pianista-premium`;
            }
            if (data == 1) {

                if (window.innerWidth >= 500) {
                    $('.card[data="0"').css('display', 'none');
                    $('.card[data="2"').css('display', 'none');
                    $(this).css('width', '100%');
                }
                text = '<p>A la hora de buscar pianista, recuerda que todos los pianistas acompañantes que aparezcan con el <b><u>símbolo del sostenido</u></b> en su perfil han sido verificados por nosotros, el equipo de encuentrapianista.com</p><p>Esto nos indicará que toda la información que aparece en el perfil de estos pianistas es verídica.</p>';

                enlace = 'https://blog.encuentrapianista.com/que-ventajas-tiene-contratar-a-un-pianista-verificado/';
            }
            $(this).css('box-shadow', 'rgba(149, 157, 165, 0.2) 0px 8px 24px');
            $(this).css('cursor', 'pointer');
            $(this).append(`<div class="hover_div" style="background:#444; padding:25px; position:absolute; top:0; left:0; display:flex; flex-direction:column; width: 100%; max-height:${height}!important; height:${height}!important; overflow:hidden; justify-content: space-between;"><div class="w-100">${text}</div><a href="${enlace}" target="_blank" class="w-100 text-center d-block" style="font-size:16px; height:40px; line-height:40px; text-decoration: none;background:transparent; border:1px solid #eee; border-radius:999px; color:#fff;">Leer artículo<i class="fa-solid fa-arrow-right-long ml-2" style="font-size:16px;"></i></a></div>`);

        } else {
            $(this).css('width', '200px');
            if (data == 0) {
                $('.card[data="1"').css('display', 'block');
                $('.card[data="2"').css('display', 'block');
            }
            if (data == 2) {
                $('.card[data="1"').css('display', 'block');
                $('.card[data="0"').css('display', 'block');
            }
            if (data == 1) {
                $('.card[data="0"').css('display', 'block');
                $('.card[data="2"').css('display', 'block');
            }

            $(this).css('box-shadow', 'none');
            $(this).css('cursor', 'inherit');
            $(this).find('.hover_div').remove();
        }
        i++;
    });
}