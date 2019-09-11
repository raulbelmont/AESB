/*Foto de perfil jogador*/
$(document).ready(function () {

    var logo = $('.logo-clube');
    var botao = $('.input-label-clube');
    var textoInput = $('.custom-text-clube');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-clube').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-clube').on("click",function () {
        var $el = $('.logo-clube');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-clube').text("Nenhum arquivo selecionado");
        $('.reset-input-clube').addClass('d-none');



    });

});


/*Validando formulario*/
$(document).ready(function(){
    $('#telefone').mask('(00) 0000-00000');
    $('#cnpj').mask('00.000.000/0000-00');
    $('#cep').mask('00000-000');
});