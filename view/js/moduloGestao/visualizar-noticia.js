/*Publicando Notícia via ajax*/
$('#btn-publicar').on('click', function () {

    var codigo = $('#codigoNoticia').html();

    $.ajax({
        url: '../../controller/NoticiasController.php',
        type: 'POST',
        data:{codigoNoticiaPublicar:codigo},
        beforeSend: function () {
            $('#btn-publicar').addClass('d-none');
            $('#carregando').removeClass('d-none');
        },
        success: function (data) {
            $('#carregando').addClass('d-none');
            $('#mensagem-sucesso').removeClass('d-none');
            alert(data);
        },
        error: function (data) {
           alert('Erro! Tente novamente mais tarde!');
        }
    });

});