setTimeout(function(){
    $('.mensagem-de-sucesso').hide('slow');
    $('.mensagem-de-sucesso').removeClass('d-block');
}, 4000);
setTimeout(function(){
    $('.mensagem-de-erro').hide('slow');
    $('.mensagem-de-erro').removeClass('d-block');
}, 4000);

$('#slide').slick({
    infinite: true,
    rows:1,
    slidesToShow: 2,
    slidesToScroll: 2,
    autoplay: true,
    autoplaySpeed: 3000,
    prevArrow: $('.prev'),
    nextArrow: $('.next'),
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,

            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});

