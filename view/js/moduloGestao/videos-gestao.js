setTimeout(function(){
    $('.mensagem-de-sucesso').hide('slow');
    $('.mensagem-de-sucesso').removeClass('d-block');
}, 6000);
setTimeout(function(){
    $('.mensagem-de-erro').hide('slow');
    $('.mensagem-de-erro').removeClass('d-block');
}, 6000);

/*Configurando modal de videos que estão sendo editados*/
$('.inputff').on('click',function () {

    var logo = $(this).find('.logo-editar');
    var botao = $(this).find('.input-label-editar');
    var textoInput = $(this).find('.custom-text-editar');
    var resetInput = $(this).find('.reset-input-editar')
    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-editar').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

    resetInput.on("click",function () {
        var $el = logo;
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        textoInput.text("Nenhum arquivo selecionado");
        resetInput.addClass('d-none');



    });
});

/*Configurando modal de vídeos que estão sendo editados poster*/
$('.editar-poster').on('click',function () {

    var logo = $(this).find('.logo-poster-editar');
    var botao = $(this).find('.input-label-poster-editar');
    var textoInput = $(this).find('.custom-text-poster-editar');
    var resetInput = $(this).find('.reset-input-poster-editar')
    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-poster-editar').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

    resetInput.on("click",function () {
        var $el = logo;
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        textoInput.text("Nenhum arquivo selecionado");
        resetInput.addClass('d-none');



    });
});

/*Configurando INPUT VIDEO*/
$(document).ready(function () {

    var logo = $('.logo-video');
    var botao = $('.input-label-video');
    var textoInput = $('.custom-text-video');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-video').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-video').on("click",function () {
        var $el = $('.logo-video');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-video').text("Nenhum arquivo selecionado");
        $('.reset-input-video').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.submit-video').bind("click",function()
    {
        var imgVal = $('.logo-video').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar um vídeo!");
            return false;
        }


    });
});

/*INPUT POSTER*/
$(document).ready(function () {

    var logo = $('.logo-poster');
    var botao = $('.input-label-poster');
    var textoInput = $('.custom-text-poster');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-poster').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-poster').on("click",function () {
        var $el = $('.logo-poster');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-poster').text("Nenhum arquivo selecionado");
        $('.reset-input-poster').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.submit-video').bind("click",function()
    {
        var imgVal = $('.logo-poster').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar um vídeo!");
            return false;
        }


    });
});
