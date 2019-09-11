$(function () {

    var clic = 0;


    $('.menu-toggler').click(function () {
        var aberto = 0;


        if (clic == 0){
            $('#icone-toggler-menu').addClass('d-none');
            $('#icone-toggler-menu-x').removeClass('d-none');
            $('.menu').addClass('cor-menu');
            $('.navbar-toggler').removeClass('menu-toggler');
            $('.navbar-toggler').addClass('menu-toggler-open');
            $('.botao-de-conta').addClass('botao-de-conta-aberto');
            $('.botao-de-conta').removeClass('botao-de-conta');
            //$('#container').removeClass('fixed-top');
            aberto = 1;
            clic = 1;
        }

        if (clic == 1 && aberto ==0){

            $('#icone-toggler-menu-x').addClass('d-none');
            $('#icone-toggler-menu').removeClass('d-none');
            $('.menu').removeClass('cor-menu');
            $('.navbar-toggler').addClass('menu-toggler');
            $('.navbar-toggler').removeClass('menu-toggler-open');
            $('.botao-de-conta-aberto').addClass('botao-de-conta');
            $('.botao-de-conta-aberto').removeClass('botao-de-conta-aberto');
            //$('#container').addClass('fixed-top');
            clic = 0;
        }


    });



});

$(function() {

    $(document).on('scroll', function () {

        if ($(window).scrollTop() > 228) {

            $('.titulo-do-menu-span').removeClass('invisible');
            $('.menu').addClass('bg-dark');

        }else {
            $('.titulo-do-menu-span').addClass('invisible');
            $('.menu').removeClass('bg-dark');
        }


    });
});