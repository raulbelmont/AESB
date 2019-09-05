/*Configurando exibição das mensagens*/
setTimeout(function(){
    $('.mensagem-de-sucesso').hide('slow');
    $('.mensagem-de-sucesso').removeClass('d-block');
}, 4000);
setTimeout(function(){
    $('.mensagem-de-erro').hide('slow');
    $('.mensagem-de-erro').removeClass('d-block');
}, 4000);


/*Imagem carrosel tipo 1*/
$(document).ready(function () {

    var logo = $('.logo-imagem1');
    var botao = $('.input-label-imagem1');
    var textoInput = $('.custom-text-imagem1');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-imagem1').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-imagem1').on("click",function () {
        var $el = $('.logo-imagem1');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-imagem1').text("Nenhum arquivo selecionado");
        $('.reset-input-imagem1').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.submit-imagem1').bind("click",function()
    {
        var imgVal = $('.logo-imagem1').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar uma foto!");
            return false;
        }


    });
});

/*Imagem carrosel tipo 6*/
$(document).ready(function () {

    var logo = $('.logo-imagem2');
    var botao = $('.input-label-imagem2');
    var textoInput = $('.custom-text-imagem2');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-imagem2').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-imagem2').on("click",function () {
        var $el = $('.logo-imagem2');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-imagem2').text("Nenhum arquivo selecionado");
        $('.reset-input-imagem2').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.submit-imagem2').bind("click",function()
    {
        var imgVal = $('.logo-imagem2').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar uma foto!");
            return false;
        }


    });
});

/*Imagens das modais de editar*/
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
