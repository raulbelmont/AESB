setTimeout(function(){
    $('.mensagem-de-sucesso').hide('slow');
    $('.mensagem-de-sucesso').removeClass('d-block');
}, 4000);
setTimeout(function(){
    $('.mensagem-de-erro').hide('slow');
    $('.mensagem-de-erro').removeClass('d-block');
}, 4000);

/*Selecionando qual tipo de inserção será feita no bd*/
$('#select-insert').on('change',function () {
    var insert = $(this).val();
    if (insert == 'jogador'){
        $('#formJogador').removeClass('d-none');
        $('#formOutro').addClass('d-none');
    }
    if (insert == 'outro'){
        $('#formJogador').addClass('d-none');
        $('#formOutro').removeClass('d-none');
    }

});

/*Buscando cidades e estados via ajax*/
$('#select-nacionalidade').on('change',function () {
   var nacionalidade = $(this).val();

   if (nacionalidade == 'outra'){
       $('.nacionalidadeDigitada').removeClass('d-none');
       $('.naturalidadeDigitada').removeClass('d-none');
   }else {
       $('.nacionalidadeDigitada').addClass('d-none');
       $('.naturalidadeDigitada').addClass('d-none');
   }
   if (nacionalidade == 'Brasileiro'){
       $('.estado').removeClass('d-none');
   }else {
       $('.estado').addClass('d-none');
       $('#select-cidades').addClass('d-none');
   }

});
$('#select-estado').on('change',function () {

    var estado = $(this).val();

    $.ajax({
       url: '../../controller/CidadesEstados.php',
        type: 'POST',
        data:{estado:estado},
        beforeSend: function () {
            $('#label-cidades').removeClass('invisible');
        },
        success: function (data) {
            $('#label-cidades').addClass('invisible');
            $('#select-cidades').removeClass('d-none');
            $('#select-cidades').html(data);
        },
        error: function (data) {
            $('#select-cidades').html('Erro ao buscar cidades');
        }
    });

});

/*Foto de perfil jogador*/
$(document).ready(function () {

    var logo = $('.logo-perfil');
    var botao = $('.input-label-perfil');
    var textoInput = $('.custom-text-perfil');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-perfil').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-perfil').on("click",function () {
        var $el = $('.logo-perfil');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-perfil').text("Nenhum arquivo selecionado");
        $('.reset-input-perfil').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.submit-elencado').bind("click",function()
    {
        var imgVal = $('.logo-perfil').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar uma foto!");
            return false;
        }


    });
});

/*Foto de perfil outro*/
$(document).ready(function () {

    var logo = $('.logo-perfil-outro');
    var botao = $('.input-label-perfil-outro');
    var textoInput = $('.custom-text-perfil-outro');

    botao.on("click",function () {
        logo.click();
    });

    logo.on("change",function () {

        if(logo.val()){
            var str = logo.html();
            textoInput.text('1 arquivo selecionado');
            $('.reset-input-perfil-outro').removeClass('d-none');
            // $('.reset-input').addClass('d-block');
        }else {
            textoInput.innerHTML = "Nenhum arquivo selecionado";
        }

    });

});
$(document).ready(function () {

    $('.reset-input-perfil-outro').on("click",function () {
        var $el = $('.logo-perfil-outro');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('.custom-text-perfil-outro').text("Nenhum arquivo selecionado");
        $('.reset-input-perfil-outro').addClass('d-none');



    });

});
$(document).ready(function() {
    $('.submit-elencado-outro').bind("click",function()
    {
        var imgVal = $('.logo-perfil-outro').val();
        if(imgVal=='')
        {
            alert("Você deve selecionar uma foto!");
            return false;
        }


    });
});