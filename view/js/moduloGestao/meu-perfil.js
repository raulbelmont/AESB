var senhaAcao = false;
$('#manterSenha').on('change',function () {
    var value = $(this).val();
    if (value == 1){
        $('#salvar-disabled').addClass('d-none');
        $('#salvar').removeClass('d-none');

        $('#senhaAtualDiv').addClass('d-none');
        $('#novaSenhaDiv').addClass('d-none');
        $('#novaSenhaConfirmaDiv').addClass('d-none');

        $('#senhaAtual').val('');
        $('#novaSenha').val('');
        $('#novaSenhaConfirma').val('');
        senhaAcao = false;
    }
});
$('#mudarSenha').on('change',function () {
    var value = $(this).val();
    if (value == 2){

        $('#salvar-disabled').removeClass('d-none');
        $('#salvar').addClass('d-none');

        $('#senhaAtualDiv').removeClass('d-none');
        $('#novaSenhaDiv').removeClass('d-none');
        $('#novaSenhaConfirmaDiv').removeClass('d-none');
        senhaAcao = true;
    }
});

$('#senhaAtual').on('keyup',function () {
    var valor = $(this).val();

    if (valor.length>=1){
        $('#novaSenhad').addClass('d-none');
        $('#novaSenha').removeClass('d-none');


        $('#novaSenhaConfirmad').addClass('d-none');
        $('#novaSenhaConfirma').removeClass('d-none');
    }else {
        $('#novaSenhad').removeClass('d-none');
        $('#novaSenha').addClass('d-none');


        $('#novaSenhaConfirmad').removeClass('d-none');
        $('#novaSenhaConfirma').addClass('d-none');

    }

});

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

/*Verificando senha antiga*/
$('#salvar').on('click',function () {

    if (senhaAcao == false){
        $('#editar-dados-form').submit();
    }else {

        $('#limpar-form-disable').removeClass('d-none');
        $('#limpar-form').addClass('d-none');
        $('#msg-senha-atual').addClass('d-none');
        $('#senhaAtual').removeClass('borda-msg');

        var senha = $('#senhaAtual').val();

        $.ajax({
            url: '../../controller/UsuarioController.php',
            type: 'POST',
            data:{senhaAtual:senha},
            beforeSend: function () {
                $('#spiner').removeClass('d-none');
            },
            success: function (data) {
                if (data == 'true'){
                    $('#editar-dados-form').submit();
                }else {
                    if (data == 'false'){
                        $('#spiner').addClass('d-none');
                        $('#msg-senha-atual').removeClass('d-none');
                        $('#senhaAtual').addClass('borda-msg');

                    }
                }
            },
            error: function (data) {

            }
        });

    }




});

$('#limpar-form').on('click',function () {
   alert('sad');

    $('#editar-dados-form')[0].reset();
    $('#spiner').addClass('d-none');
    $('#msg-senhas-diferentes').addClass('d-none');
    $('#msg-senhas-iguais').addClass('d-none');

});

/*Configurando exibição das mensagens*/
setTimeout(function(){
    $('.mensagem-de-sucesso').hide('slow');
    $('.mensagem-de-sucesso').removeClass('d-block');
}, 4000);
setTimeout(function(){
    $('.mensagem-de-erro').hide('slow');
    $('.mensagem-de-erro').removeClass('d-block');
}, 4000);