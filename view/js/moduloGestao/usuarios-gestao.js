/*Configurando exibição das mensagens*/
setTimeout(function(){
    $('.mensagem-de-sucesso').hide('slow');
    $('.mensagem-de-sucesso').removeClass('d-block');
}, 4000);
setTimeout(function(){
    $('.mensagem-de-erro').hide('slow');
    $('.mensagem-de-erro').removeClass('d-block');
}, 4000);

/*Conferindo se senhas são iguais*/
$('#novaSenhaConfirma').on('keyup',function () {

    var $val1 = $(this).val();
    var $val2 = $('#novaSenha').val();

    if ($val1 == $val2){
        $('#msg-senhas-iguais').removeClass('d-none');
        $('#msg-senhas-diferentes').addClass('d-none');

        $('#salvar-disabled').addClass('d-none');
        $('#salvar').removeClass('d-none');


    }else {
        $('#msg-senhas-iguais').addClass('d-none');
        $('#msg-senhas-diferentes').removeClass('d-none');

        $('#salvar-disabled').removeClass('d-none');
        $('#salvar').addClass('d-none');

    }

});


$('#limpar-form').on('click',function () {

    $('#inserir-usuario')[0].reset();
    $('#msg-senhas-diferentes').addClass('d-none');
    $('#msg-senhas-iguais').addClass('d-none');

});