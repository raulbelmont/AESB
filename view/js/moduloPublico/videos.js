/*Carrosel de vídeo*/
$('.slider-slick').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    focusOnSelect: true,
    centerMode: true,
    asNavFor: '.carrosel-video'
});
$('.carrosel-video').slick({
    slidesToShow: 3,
    centerMode: true,
    focusOnSelect: true,
    asNavFor: '.slider-slick',
    prevArrow: $('.prev-video'),
    nextArrow: $('.next-video'),
    centerPadding: '40px',
    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
            }
        }
    ]
});

$('.slider-slick-torcedor').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    focusOnSelect: true,
    centerMode: true,
    asNavFor: '.carrosel-video-torcedor'
});
$('.carrosel-video-torcedor').slick({
    slidesToShow: 3,
    centerMode: true,
    focusOnSelect: true,
    asNavFor: '.slider-slick-torcedor',
    prevArrow: $('.prev-video-torcedor'),
    nextArrow: $('.next-video-torcedor'),
    centerPadding: '40px',
    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
            }
        }
    ]
});


/*Configurando INPUT VIDEO*/
$(document).ready(function () {

    var logo = $('.logo-video-torcedor');
    var botao = $('.input-label-torcedor');
    var textoInput = $('.custom-text-torcedor');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-torcedor').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-torcedor').on("click",function () {
        var $el = $('.logo-video-torcedor');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-torcedor').text("Nenhum arquivo selecionado");
        $('.reset-input-torcedor').addClass('d-none');



    });

});

$('#logoApoiadores').on('change',function () {
    if(this.files[0].size > 52428800){

        $('#aviso-tamanho').removeClass('d-none');

        setTimeout(function(){
            $('#aviso-tamanho').hide('slow');
            $('#aviso-tamanho').removeClass('d-block');
        }, 5000);

        var $el = $('.logo-video-torcedor');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-torcedor').text("Nenhum arquivo selecionado");
        $('.reset-input-torcedor').addClass('d-none');
    };
});

$(document).ready(function() {
    $('.botao-enviar').bind("click",function()
    {
        var imgVal = $('.logo-video-torcedor').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar um vídeo!");
            return false;
        }


    });
});

/*Efeitos de fade*/
$('.btn-enviar-video').on('click',function () {
    var rowEnv = $('#env-video');
    rowEnv.removeClass('d-none');
    $(this).addClass('d-none');

});
$('.cancelar-envio').on('click',function () {
    var rowEnv = $('#env-video');
    var btnEnviar = $('.btn-enviar-video');
    rowEnv.addClass('d-none');
    btnEnviar.removeClass('d-none');
});

/*Enviando vídeo dos torcedores*/
var formulario = $('#enviar-video');
var status = $('.status');

formulario.on('submit',function (event) {
    event.preventDefault();
    var form = $('#enviar-video').get(0);
    var dados = new FormData(form);
    xmlHttpPost('../controller/VideosController', function () {

        beforeSend(function () {
            var value = `<i class="fas fa-sync-alt fa-spin fa-3x fa-fw"> </i>`;

            $('.status').removeClass('d-none');
            $('.spin').html(value);
            $('.closest').addClass('d-none');

        });

        success(function () {
            $('.closest').removeClass('d-none');
            $('.status').addClass('d-none');
            $('.status-enviado').removeClass('d-none');
        });

    },dados);

    // {var xhttp = new XMLHttpRequest();
    //
    // xhttp.open('POST',formulario.getAttribute('action'));
    //
    // var data = new FormData(formulario);
    //
    // xhttp.send(data);
    //
    // xhttp.addEventListener('readystatechange',function () {
    //
    //     if (xhttp.readyState === 4 && xhttp.status == 200){
    //         var json = JSON.parse(xhttp.responseText);
    //         alert(json);
    //
    //         if (!json.error && json.status === 'ok'){
    //             status.html('Arquivo enviado com sucesso!');
    //         }else {
    //             status.html('Não foi possível enviar o arquivo');
    //         }
    //     }
    //
    // });
    //
    // xhttp.upload.addEventListener('progress',function(e) {
    //     if (e.lengthComputable){
    //         var percentage = Math.round((e.loaded * 100)/e.total);
    //
    //         status.html(String(percentage)+'%');
    //     }
    // },false);
    //
    // xhttp.upload.addEventListener('load',function (e) {
    //     status.html(String(100)+'%');
    // },false);}


});

/*Busca de mais vídeos da aesb via ajax*/
$('#mais-videos-aesb').on('click',function () {

    btnMaisVideos = $('#mais-videos-aesb');
    totalDePaginas = $('#total-de-paginas-aesb').html();
    paginaAtual = $('#pagina-atual-aesb').html();
    pagina = $('#pagina-atual-aesb');

    if (paginaAtual<=totalDePaginas){
        if (paginaAtual==totalDePaginas){
            btnMaisVideos.addClass('d-none');
        }

        var carregando = $('.carregando');
        var value = `<i class="fas fa-sync-alt fa-spin fa-3x fa-fw"> </i>`;
        var dados = '?pagina='+paginaAtual + '&acao=6';

        xmlHttpGet('../controller/VideosController', function () {

            beforeSend(function () {
                carregando.html(value);
            });

            success(function () {
                var videos = xhttp.responseText;
                $('.container-video-aesb').append(videos);
                carregando.html('');
            });

            error(function () {

            });



        },dados);
        paginaAtual++;
        pagina.html(paginaAtual);



    }
    if (paginaAtual>totalDePaginas){

    }


});

/*Busca de mais vídeos da aesb via ajax*/
$('#mais-videos-torcedor').on('click',function () {

    btnMaisVideos = $('#mais-videos-torcedor');
    totalDePaginas = $('#total-de-paginas-torcedor').html();
    paginaAtual = $('#pagina-atual-torcedor').html();
    pagina = $('#pagina-atual-torcedor');

    if (paginaAtual<=totalDePaginas){
        if (paginaAtual==totalDePaginas){
            btnMaisVideos.removeClass('d-block');
            btnMaisVideos.addClass('d-none');
        }

        var carregando = $('.carregando-torcedores');
        var value = `<i class="fas fa-sync-alt fa-spin fa-3x fa-fw"> </i>`;
        var dados = '?pagina='+paginaAtual + '&acao=61';

        xmlHttpGet('../controller/VideosController', function () {

            beforeSend(function () {
                carregando.html(value);
            });

            success(function () {
                var videos = xhttp.responseText;
                $('.container-video-torcedor').append(videos);
                carregando.html('');
            });

            error(function () {

            });



        },dados);
        paginaAtual++;
        pagina.html(paginaAtual);



    }
    if (paginaAtual>totalDePaginas){

    }


});
