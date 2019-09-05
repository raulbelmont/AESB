<?php
require_once '../model/JogosModel.php';
require_once '../model/CompeticoesModel.php';
$jogo = new JogosModel();
$competicao = new CompeticoesModel();
if (!session_id()) session_start();

date_default_timezone_set('America/Sao_Paulo');

/*Função para formatar a imagem da noticia*/
function tratar_arquivo_upload($string){
    // pegando a extensao do arquivo
    $partes 	= explode(".", $string);
    $extensao 	= $partes[count($partes)-1];
    // somente o nome do arquivo
    $nome	= preg_replace('/\.[^.]*$/', '', $string);
    // removendo simbolos, acentos etc
    $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ?';
    $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr-';
    $nome = strtr($nome, utf8_decode($a), $b);
    $nome = str_replace(".","-",$nome);
    $nome = preg_replace( "/[^0-9a-zA-Z\.]+/",'-',$nome);
    return utf8_decode(strtolower($nome.".".$extensao));
}

/*Inserindo jogo*/
if (!empty($_POST['acao']) and $_POST['acao'] == 1){

    $mandanteAbreviacao = $_POST['mandanteAbreviacao'];
    $visitanteAbreviacao = $_POST['visitanteAbreviacao'];
    $placarMandante = $_POST['placarMandante'];
    $placarVisitante = $_POST['placarVisitante'];
    $dataJogo = $_POST['data_jogo'];
    $horario = $_POST['horario'];
    $localJogo = $_POST['localJogo'];
    $codigoCompeticao = $_POST['codigoCompeticao'];

    /*logo mandante*/
    $fileMandante = $_FILES['logoMandante'];
    $filenameMandante = tratar_arquivo_upload(utf8_decode($fileMandante['name']));
    $uploaddir = '../view/img/competicoes-e-jogos/';
    $uploadfileMandante = $uploaddir . basename($filenameMandante);
    if (move_uploaded_file($_FILES['logoMandante']['tmp_name'], $uploadfileMandante)) {
        $jogo->setLogoMandante($filenameMandante);
    }

    /*logo visitante*/
    $fileVisitante = $_FILES['logoVisitante'];
    $filenameVisitante = tratar_arquivo_upload(utf8_decode($fileVisitante['name']));
    $uploaddir = '../view/img/competicoes-e-jogos/';
    $uploadfileVisitante = $uploaddir . basename($filenameVisitante);
    if (move_uploaded_file($_FILES['logoVisitante']['tmp_name'], $uploadfileVisitante)) {
        $jogo->setLogoVisitante($filenameVisitante);
    }

    $jogo->setMandanteAbreviacao($mandanteAbreviacao);
    $jogo->setVisitanteAbreviacao($visitanteAbreviacao);
    $jogo->setPlacarMandante($placarMandante);
    $jogo->setPlacarVisitante($placarVisitante);
    $jogo->setDataJogo($dataJogo);
    $jogo->setHorario($horario);
    $jogo->setLocalJogo($localJogo);
    $jogo->setCodigoCompeticao($codigoCompeticao);



    if ($jogo->inserirJogo()){
        $_SESSION['salvou'] = true;
        header('location:../view/adm/jogos-gestao.php');
    }else{
        $_SESSION['salvou'] = false;
        header('location:../view/adm/jogos-gestao.php');
    }


}

/*Editando jogo*/
if (!empty($_POST['acao']) and $_POST['acao'] == 3){

    $codigoJogo = $_POST['codigoJogo'];
    $jogo->setMandanteAbreviacao($_POST['mandanteAbreviacao']);
    $jogo->setVisitanteAbreviacao($_POST['visitanteAbreviacao']);
    $jogo->setPlacarMandante($_POST['placarMandante']);
    $jogo->setPlacarVisitante($_POST['placarVisitante']);
    $jogo->setDataJogo($_POST['data_jogo']);
    $jogo->setHorario($_POST['horario']);
    $jogo->setLocalJogo($_POST['localJogo']);
    $jogo->setCodigoCompeticao($_POST['codigoCompeticao']);

    if (!$_FILES['logoMandante']['size'] == 0){


            $file = $_FILES['logoMandante'];
            $filename = tratar_arquivo_upload(utf8_decode($file['name']));
            $uploaddir = '../view/img/competicoes-e-jogos/';
            $uploadfile = $uploaddir . basename($filename);
            move_uploaded_file($_FILES['logoMandante']['tmp_name'], $uploadfile);
            $jogo->setLogoMandante($filename);
    }else{
        $jogoSelecionado = $jogo->selectJogo($codigoJogo);
        $jogo->setLogoMandante($jogoSelecionado->logoMandante);
    }

    if (!$_FILES['logoVisitante']['size'] == 0){


        $file = $_FILES['logoVisitante'];
        $filename = tratar_arquivo_upload(utf8_decode($file['name']));
        $uploaddir = '../view/img/competicoes-e-jogos/';
        $uploadfile = $uploaddir . basename($filename);
        move_uploaded_file($_FILES['logoVisitante']['tmp_name'], $uploadfile);
        $jogo->setLogoVisitante($filename);
    }else{
        $jogoSelecionado = $jogo->selectJogo($codigoJogo);
        $jogo->setLogoVisitante($jogoSelecionado->logoVisitante);
    }

    if ($jogo->updateJogo($codigoJogo)){
        $_SESSION['editou'] = true;
        header('location:../view/adm/jogos-gestao.php');
    }else{
        $_SESSION['editou'] = false;
        header('location:../view/adm/jogos-gestao.php');
    }

}

/*Cadastrando placar*/
if (!empty($_POST['acao']) and $_POST['acao'] == 22){
    $codigoJogo = $_POST['codigoJogo'];
    $placarMandante = $_POST['placarMandante'];
    $placarVisitante = $_POST['placarVisitante'];

    if ($jogo->updatePlacar($codigoJogo,$placarMandante,$placarVisitante)){
        $_SESSION['editou'] = true;
        header('location:../view/adm/jogos-gestao.php');
    }else{
        $_SESSION['editou'] = false;
        header('location:../view/adm/jogos-gestao.php');
    }
}

/*Excluindo jogo*/
if (!empty($_GET['acao']) and  $_GET['acao'] == 2){

    $codigoJogo = $_SESSION['excluir'];

    if ($jogo->deletar($codigoJogo)){
        $_SESSION['excluiu'] = true;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/jogos-gestao.php');
    }else{
        $_SESSION['excluiu'] = false;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/jogos-gestao.php');
    }

}


