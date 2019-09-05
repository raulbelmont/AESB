/*Configurando exibição das mensagens*/
setTimeout(function(){
    $('.mensagem-de-sucesso').hide('slow');
    $('.mensagem-de-sucesso').removeClass('d-block');
}, 4000);
setTimeout(function(){
    $('.mensagem-de-erro').hide('slow');
    $('.mensagem-de-erro').removeClass('d-block');
}, 4000);

window.onload = function(){
    var allEditors = $('.regras');
    for (var i = 0; i < allEditors.length; ++i) {
        CKEDITOR.replace( allEditors[i] );
    }
    CKFinder.setupCKEditor(editor,'../img/ckfinder');

}