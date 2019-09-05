$(document).ready(function () {

    var logo = $('.fundo-noticia');
    var botao = $('.input-label');
    var textoInput = $('.custom-text');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
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
        var $el = $('.fundo-noticia');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text').text("Nenhum arquivo selecionado");
        $('.reset-input').addClass('d-none');



    });

});
// $(document).ready(function() {
//     $('.submit-patrocinador').bind("click",function()
//     {
//         var imgVal = $('.fundo-noticia').val();
//         if(imgVal=='')
//         {
//             alert("Você deve selecionar uma logo!");
//             return false;
//         }
//
//
//     });
// });