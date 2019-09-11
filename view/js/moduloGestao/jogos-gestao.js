/*Configurando exibição das mensagens*/
setTimeout(function(){
    $('.mensagem-de-sucesso').hide('slow');
    $('.mensagem-de-sucesso').removeClass('d-block');
}, 4000);
setTimeout(function(){
    $('.mensagem-de-erro').hide('slow');
    $('.mensagem-de-erro').removeClass('d-block');
}, 4000);

/*Logo mandante*/
$(document).ready(function () {

    var logo = $('.logo-mandante');
    var botao = $('.input-label-mandante');
    var textoInput = $('.custom-text-mandante');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-mandante').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-mandante').on("click",function () {
        var $el = $('.logo-mandante');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-mandante').text("Nenhum arquivo selecionado");
        $('.reset-input-mandante').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.btn-submit-novo-jogo').bind("click",function()
    {
        var imgVal = $('.logo-mandante').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar uma logo para o mandante!");
            return false;
        }


    });
});

/*Logo visitante*/
$(document).ready(function () {

    var logo = $('.logo-visitante');
    var botao = $('.input-label-visitante');
    var textoInput = $('.custom-text-visitante');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-visitante').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-visitante').on("click",function () {
        var $el = $('.logo-visitante');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-visitante').text("Nenhum arquivo selecionado");
        $('.reset-input-visitante').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.btn-submit-novo-jogo').bind("click",function()
    {
        var imgVal = $('.logo-visitante').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar uma logo para o visitante!");
            return false;
        }


    });
});


/*Logo mandante proximo jogo*/
$(document).ready(function () {

    var logo = $('.logo-mandante-next');
    var botao = $('.input-label-mandante-next');
    var textoInput = $('.custom-text-mandante-next');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-mandante-next').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-mandante-next').on("click",function () {
        var $el = $('.logo-mandante-next');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-mandante-next').text("Nenhum arquivo selecionado");
        $('.reset-input-mandante-next').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.btn-submit-novo-jogo-next').bind("click",function()
    {
        var imgVal = $('.logo-mandante-next').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar uma logo para o mandante!");
            return false;
        }


    });
});

/*Logo visitante proximo jogo*/
$(document).ready(function () {

    var logo = $('.logo-visitante-next');
    var botao = $('.input-label-visitante-next');
    var textoInput = $('.custom-text-visitante-next');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-visitante-next').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-visitante-next').on("click",function () {
        var $el = $('.logo-visitante-next');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-visitante-next').text("Nenhum arquivo selecionado");
        $('.reset-input-visitante-next').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.btn-submit-novo-jogo-next').bind("click",function()
    {
        var imgVal = $('.logo-visitante-next').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar uma logo para o visitante!");
            return false;
        }


    });
});

/*Logos das modais de editar*/
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

$('.inputfff').on('click',function () {
    var logo = $(this).find('.logo-editar');
    var botao = $(this).find('.input-label-editar');
    var textoInput = $(this).find('.custom-text-editar');
    var resetInput = $(this).find('.reset-input-editarr')
    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-editarr').removeClass('d-none');
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

/*Logos das modais de editar*/
$('.inputff-proximo').on('click',function () {
    var logo = $(this).find('.logo-editar-proximo');
    var botao = $(this).find('.input-label-editar-proximo');
    var textoInput = $(this).find('.custom-text-editar-proximo');
    var resetInput = $(this).find('.reset-input-editar-proximo')
    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-editar-proximo').removeClass('d-none');
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

$('.inputfff-proximo').on('click',function () {
    var logo = $(this).find('.logo-editar-proximo');
    var botao = $(this).find('.input-label-editar-proximo');
    var textoInput = $(this).find('.custom-text-editar-proximo');
    var resetInput = $(this).find('.reset-input-editarr-proximo')
    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-editarr-proximo').removeClass('d-none');
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

/*Mascaras dos inputs para horários do jogo*/
$(document).ready(function(){

    $('#horario').mask('00:00 Hs');
    $('#horario-next').mask('00:00 Hs');

    $('.horario').on('click',function () {
        $(this).find('#horarioEditar').mask('00:00 Hs');
    });
});