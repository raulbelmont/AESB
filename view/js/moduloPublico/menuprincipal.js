$(function(){

    $(document).on( 'scroll', function(){

        if ($(window).scrollTop() > 50) {

            $('.menu-principal').css('background-color','rgba(0,106,166,0.2)');

            if ($(window).scrollTop() > 50) {

                $('.menu-principal').css('background-color','rgba(0,106,166,0.3)');

                if ($(window).scrollTop() > 100) {

                    $('.menu-principal').css('background-color','rgba(0,106,166,0.4)');

                    if ($(window).scrollTop() > 150) {

                        $('.menu-principal').css('background-color','rgba(0,106,166,0.5)');

                        if ($(window).scrollTop() > 200) {

                            $('.menu-principal').css('background-color','rgba(0,106,166,0.6)');

                            if ($(window).scrollTop() > 250) {

                                $('.menu-principal').css('background-color','rgba(0,106,166,0.7)');

                                if ($(window).scrollTop() > 300) {

                                    $('.menu-principal').css('background-color','rgba(0,106,166,0.8)');

                                    if ($(window).scrollTop() > 350) {

                                        $('.menu-principal').css('background-color','rgba(0,106,166,0.9)');

                                        if ($(window).scrollTop() > 400) {

                                            $('.menu-principal').css('background-color','rgba(0,106,166,1)');

                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $('.menu-principal').css('background-color','rgba(0,0,0,0.4)');
        }
    });

});

$(function () {

    var clic = 0;


    $('.menu-toggler').click(function () {
        var aberto = 0;


        if (clic == 0){
        $('#icone-toggler-menu').addClass('d-none');
        $('#icone-toggler-menu-x').removeClass('d-none');
        $('#toggle-text').removeClass('d-md-inline');
        $('#toggle-text-x').removeClass('d-md-none').addClass('d-md-inline');
        aberto = 1;
        clic = 1;
        }

        if (clic == 1 && aberto ==0){

            $('#icone-toggler-menu-x').addClass('d-none');
            $('#icone-toggler-menu').removeClass('d-none');
            $('#toggle-text-x').removeClass('d-md-inline').addClass('d-md-none');
            $('#toggle-text').addClass('d-md-inline');
            clic = 0;
        }


    });



});