<?php
require_once '../model/CompeticoesModel.php';
require_once '../model/JogosModel.php';
$jogo = new JogosModel();
$competicoes = new CompeticoesModel();
if (!session_id()) session_start();

/*Inserindo*/
if (!empty($_POST['acao']) and $_POST['acao'] == 1){

    date_default_timezone_set('America/Sao_Paulo');

    $nome = $_POST['nome'];
    $faseAtual = $_POST['faseAtual'];
    $regras = $_POST['regras'];
    $situacaoClube = $_POST['situacaoClube'];
    $dataPublicacao = date('Y-m-d H:i:s');

    $competicoes->setNome($nome);
    $competicoes->setFaseAtual($faseAtual);
    $competicoes->setRegras($regras);
    $competicoes->setSituacaoClube($situacaoClube);
    $competicoes->setDataPublicacao($dataPublicacao);

    if ($competicoes->inserir()){
        $_SESSION['salvou'] = true;
        header('location:../view/adm/competicoes-gestao.php');
    }else{
        $_SESSION['salvou'] = false;
        header('location:../view/adm/competicoes-gestao.php');
    }

}

/*Excluir*/
if (!empty($_GET['acao']) and $_GET['acao'] == 2){

    $codigoCompeticao = $_SESSION['excluir'];

    if (($jogo->deletarByCompeticao($codigoCompeticao)) and ($competicoes->deletar($codigoCompeticao))){
        $_SESSION['excluiu'] = true;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/competicoes-gestao.php');
    }else{
        $_SESSION['excluiu'] = false;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/competicoes-gestao.php');
    }

}

/*UPDATE*/
if (!empty($_POST['acao']) and $_POST['acao'] == 3){

    $codigoCompeticao = $_POST['codigoCompeticao'];
    $nome = $_POST['nome'];
    $faseAtual = $_POST['faseAtual'];
    $regras = $_POST['regras'];
    $situacaoClube = $_POST['situacaoClube'];
    $dataPublicacao = date('Y-m-d H:i:s');

    $competicoes->setNome($nome);
    $competicoes->setFaseAtual($faseAtual);
    $competicoes->setRegras($regras);
    $competicoes->setSituacaoClube($situacaoClube);
    $competicoes->setDataPublicacao($dataPublicacao);

    if ($competicoes->updateCompeticao($codigoCompeticao)){
        $_SESSION['editou'] = true;
        header('location:../view/adm/competicoes-gestao.php');
    }else{
        $_SESSION['editou'] = false;
        header('location:../view/adm/competicoes-gestao.php');
    }

}
