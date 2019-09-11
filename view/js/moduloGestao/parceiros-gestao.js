/*Configurando exibição das mensagens*/
setTimeout(function(){
    $('.mensagem-de-sucesso').hide('slow');
    $('.mensagem-de-sucesso').removeClass('d-block');
}, 4000);
setTimeout(function(){
    $('.mensagem-de-erro').hide('slow');
    $('.mensagem-de-erro').removeClass('d-block');
}, 4000);


/*Funções para os inputs*/
/*Patrocinador*/
$(document).ready(function () {

    var logo = $('.logo-patrocinador');
    var botao = $('.input-label-patrocinador');
    var textoInput = $('.custom-text-patrocinador');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-patrocinador').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-patrocinador').on("click",function () {
        var $el = $('.logo-patrocinador');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-patrocinador').text("Nenhum arquivo selecionado");
        $('.reset-input-patrocinador').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.submit-patrocinador').bind("click",function()
    {
        var imgVal = $('.logo-patrocinador').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar uma logo!");
            return false;
        }


    });
});
/*Apoiador*/
$(document).ready(function () {

    var logo = $('.logo-apoiador');
    var botao = $('.input-label-apoador');
    var textoInput = $('.custom-text-apoiador');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-apoiador').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-apoiador').on("click",function () {
        var $el = $('.logo-apoiador');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-apoiador').text("Nenhum arquivo selecionado");
        $('.reset-input-apoiador').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.submit-apoiador').bind("click",function()
    {
        var imgVal = $('.logo-apoiador').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar uma logo!");
            return false;
        }


    });
});
/*Fornecedor*/
$(document).ready(function () {

    var logo = $('.logo-fornecedor');
    var botao = $('.input-label-fornecedor');
    var textoInput = $('.custom-text-fornecedor');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-fornecedor').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-fornecedor').on("click",function () {
        var $el = $('.logo-fornecedor');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-fornecedor').text("Nenhum arquivo selecionado");
        $('.reset-input-fornecedor').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.submit-fornecedor').bind("click",function()
    {
        var imgVal = $('.logo-fornecedor').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar uma logo!");
            return false;
        }


    });
});

/*Validação*/
$(function () {

    $('#formulario-patrocinador').validate({

        rules:{

            nomePatrocinador:{
                required:true
            }
        },

        messages:{

            nomePatrocinador:{
                required:"Por favor, informe o nome do patrocinador"
            }


        }

    });



});
$(function () {

    $('#formulario-apoiador').validate({

        rules:{

            nomeApoiador:{
                required:true
            }
        },

        messages:{

            nomeApoiador:{
                required:"Por favor, informe o nome do apoiador"
            }


        }

    });



});
$(function () {

    $('#formulario-fornecedor').validate({

        rules:{

            nomeFornecedor:{
                required:true
            }
        },

        messages:{

            nomeFornecedor:{
                required:"Por favor, informe o nome do fornecedor"
            }


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
