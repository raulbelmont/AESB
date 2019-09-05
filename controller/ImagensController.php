<?php

require_once '../model/ImagensModel.php';
$imagem = new ImagensModel();

date_default_timezone_set('America/Sao_Paulo');
if (!session_id()) session_start();

    /*
        Localizações possíveis:

        1 = slider da pagina inicial
        2 = Chamada para o proximo jogo
        3 = anuncio 1
        4 = anuncio 2
        5 = logo em fale conosco e home do adm
        5 = slider final da página inicial

    */


/*Salvar imagem*/
if (!empty($_POST['acao']) and $_POST['acao'] == 1){

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


    /*Pegando dados via post*/
    $titulo = $_POST['titulo'];
    $legenda = $_POST['legenda'];
    $localizacao = $_POST['localizacao'];

    $file = $_FILES['imagem'];
    $filename = tratar_arquivo_upload(utf8_decode($file['name']));
    $uploaddir = '../view/img/';
    $uploadfile = $uploaddir . basename($filename);
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadfile)) {
        $imagem->setImagem($filename);
    }

    $imagem->setTitulo($titulo);
    $imagem->setLegenda($legenda);
    $imagem->setLocalizacao($localizacao);

    if ($imagem->inserirImagem()){
        $_SESSION['salvou'] = true;
        header('location:../view/adm/imagens-gestao.php');
    }else{
        $_SESSION['salvou'] = false;
        header('location:../view/adm/imagens-gestao.php');
    }



}

/*Deletar imagem*/
if (!empty($_GET['acao']) and $_GET['acao'] == 2){

    $codigoImagem = $_SESSION['excluir'];

    if ($imagem->deleteImagem($codigoImagem)){
        $_SESSION['excluiu'] = true;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/imagens-gestao.php');
    }else{
        $_SESSION['excluiu'] = false;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/imagens-gestao.php');
    }
}

/*Atualizar imagem*/
if (!empty($_POST['acao']) and $_POST['acao'] == 3){
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

    $localizacao = $_POST['localizacao'];
    $codigoImagem = $_POST['codigoImagem'];
    $titulo = $_POST['titulo'];
    $legenda = $_POST['legenda'];
    $ultimaAtualizacao = date('Y-m-d H:i:s');

    if (!$_FILES['imagem']['size'] == 0){

        $imagemAtual = $imagem->selectImagem($codigoImagem);
        $file =  '../view/img/'.$imagemAtual->imagem;

        if (file_exists($file)){
            unlink($file);
            $file = $_FILES['imagem'];
            $filename = tratar_arquivo_upload(utf8_decode($file['name']));
            $uploaddir = '../view/img/';
            $uploadfile = $uploaddir . basename($filename);
            move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadfile);
            $imagem->setImagem($filename);
        }
    }else{
        $imagemAtual = $imagem->selectImagem($codigoImagem);
        $imagem->setImagem($imagemAtual->imagem);
    }



    $imagem->setTitulo($titulo);
    $imagem->setLegenda($legenda);
    $imagem->setLocalizacao($localizacao);
    $imagem->setUltimaAtualizacao($ultimaAtualizacao);

    if ($imagem->updateImagem($codigoImagem)){
        $_SESSION['editou'] = true;
        header('location:../view/adm/imagens-gestao.php');
    }else{
        $_SESSION['editou'] = false;
        header('location:../view/adm/imagens-gestao.php');
    }
}

?>