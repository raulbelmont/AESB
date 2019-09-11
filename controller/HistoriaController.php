<?php

/*
        tipo 1 = historia
        tipo 2 = Fundação
        tipo 3 = Presidentes
        tipo 4 = Hino e Símbolos
        tipo 5 = Galeria de Troféus
        tipo 6 = Ídolos
        tipo 7 = Estatuto Social

     */

require_once '../model/HistoriaModel.php';
$historia = new HistoriaModel();
if (!session_id()) session_start();

if (!empty($_POST['acao']) and $_POST['acao'] == 3){

    date_default_timezone_set('America/Sao_Paulo');

    $codigoHistoria = $_POST['codigoHistoria'];
    $titulo = $_POST['titulo'];
    $corpo = $_POST['corpo'];
    $tipo = $_POST['tipo'];
    $ultimaAtualizacao = date('Y-m-d H:i:s');

    $historia->setTitulo($titulo);
    $historia->setCorpo($corpo);
    $historia->setTipo($tipo);
    $historia->setUltimaAtualizacao($ultimaAtualizacao);

    if ($historia->updateHistoria($codigoHistoria)){
        $_SESSION['editou'] = true;
        header('location:../view/adm/historia-gestao.php');
    }else{
        $_SESSION['editou'] = false;
        header('location:../view/adm/historia-gestao.php');
    }


}

