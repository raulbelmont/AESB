setTimeout(function(){
    $('.mensagem-de-sucesso').hide('slow');
    $('.mensagem-de-sucesso').removeClass('d-block');
}, 3000);
setTimeout(function(){
    $('.mensagem-de-erro').hide('slow');
    $('.mensagem-de-erro').removeClass('d-block');
}, 3000);

$(document).ready(function(){
    $('#telefoneContato').mask('(00) 00000-0000');
});




$(function () {

    $('#formularioContato').validate({

        rules:{

            nomeContato:{
                required:true
            },

            telefoneContato:{
                required: true,
                minlength: 10
            },

            emailContato:{
                required: true,
                minlength: 3
            },
            curriculo:{
                accept: "*/*"
            }

        },

        messages:{

            nomeContato:{
                required:"Por favor, informe o seu nome"
            },
            telefoneContato: {
                required:"Por favor, informe o seu telefone",
                minlength:"Por favor, informe um número de telefone válido"
            },
            emailContato: {
                required:"Por favor informe o seu e-mail",
                minlength:"Por favor informe um e-mail válido"
            },
            curriculo:{
                accept: "Selecione um arquivo válido"
            }


        }

    });



});

$(document).ready(function () {

    var curriculo = $('#curriculo');
    var botao = $('.input-label');
    var textoInput = $('.custom-text');

    botao.on("click",function () {
        curriculo.click();
    });

    curriculo.on("change",function () {

        if(curriculo.val()){
            var str = curriculo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input').on("click",function () {
        var $el = $('#curriculo');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text').text("Nenhum arquivo selecionado");
        $('.reset-input').addClass('d-none');



    });

});







