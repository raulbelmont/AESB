var selectDeCompeticoes=document.getElementById("select-competicoes");
selectDeCompeticoes.onchange=function (){

    $('.painel-de-competicoes').removeClass('show active');

    var idTab = selectDeCompeticoes.value;
    document.getElementById(idTab).classList.add('show');
    document.getElementById(idTab).classList.add('active');
}

var selectDeJogos=document.getElementById("select-de-jogos");
selectDeJogos.onchange=function (){

    $('.painel-de-jogos').removeClass('show active');

    var idTab = selectDeJogos.value;
    document.getElementById(idTab).classList.add('show');
    document.getElementById(idTab).classList.add('active');
}