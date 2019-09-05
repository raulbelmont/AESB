/*Animações do card*/

    $(".card-noticia").hover(
        function(){
            //Ao posicionar o cursor sobre a div

            $(this).find(".texto-noticia").addClass('d-none');

        },
        function(){
            //Ao remover o cursor da div

            $(this).find(".texto-noticia").removeClass('d-none');

        }
    );

$('#btn-mais-noticias').on('click',function () {

    btnMaisNoticias = $('#btn-mais-noticias');
    totalDePaginas = $('#total-de-paginas').html();
    paginaAtual = $('#pagina-atual').html();
    pagina = $('#pagina-atual');

    if (paginaAtual<=totalDePaginas){
        if (paginaAtual==totalDePaginas){
            btnMaisNoticias.addClass('d-none');
        }

        var maisNoticias = $('#mais-noticias');
        var value = `<i class="fas fa-sync-alt fa-spin fa-3x fa-fw"> </i>`;
        var exibirPor = $("#exibirPor");
        var classificarPor = $("#classificarPor")
        var dados = '?exibirPor=' + exibirPor.val() + '&classificarPor=' + classificarPor.val() + '&pagina='+paginaAtual;

        xmlHttpGet('../controller/NoticiasController', function () {

            beforeSend(function () {
                //maisNoticias.html(value);
            });

            success(function () {
                var noticias = xhttp.responseText;
                $('#mais-noticias').append(noticias);
            });

            error(function () {

            });



        },dados);
        paginaAtual++;
        pagina.html(paginaAtual);



    }
    if (paginaAtual>totalDePaginas){

    }


});
/*Ajax*/
$('#exibirPor,#classificarPor').on('change',function () {

    $('#btn-mais-noticias').removeClass('d-none');
    $('#pagina-atual').html(2);
    var maisNoticias = $('#mais-noticias');
    var value = `<i class="fas fa-sync-alt fa-spin fa-3x fa-fw"> </i>`;
    var exibirPor = $("#exibirPor");
    var classificarPor = $("#classificarPor")
    var dados = '?exibirPor=' + exibirPor.val() + '&classificarPor=' + classificarPor.val();
    xmlHttpGet('../controller/NoticiasController', function () {

        beforeSend(function () {
            maisNoticias.html(value);
        });

        success(function () {
            var noticias = xhttp.responseText;
            maisNoticias.html(noticias);
        });

        error(function () {

        });

    },dados);



    // var xhttp = new XMLHttpRequest();
    // var maisNoticias = $('#mais-noticias');
    // var exibirPor = $("#exibirPor");
    // var classificarPor = $("#classificarPor")
    // var value = `<i class="fas fa-sync-alt fa-spin fa-3x fa-fw"> </i>`;
    // maisNoticias.html(value);
    //
    // xhttp.open('POST', '../controller/NoticiasController.php', true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //
    // var dados = 'exibirPor=' + exibirPor.val() + '&classificarPor=' + classificarPor.val();
    // xhttp.send(dados);
    //
    // xhttp.onreadystatechange = function () {
    //
    //     if (xhttp.readyState == 4 && xhttp.status == 200) {
    //
    //        var noticias = this.responseText;
    //        maisNoticias.html(noticias);
    //     }
    // }
});






/*outro*/
    var select = $("#exibirPor");

    select.on('change', function () {


        if (select.val() == 'numAcessos'){

            $('.outra-classe').addClass('invisible');

        }else {
            $('.outra-classe').removeClass('invisible');
        }

    });





