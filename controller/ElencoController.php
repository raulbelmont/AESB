<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 02/10/2018
 * Time: 17:17
 */
require_once '../model/ElencoModel.php';
$elencado = new ElencoModel();

if (!session_id()) session_start();

/*Definindo zona de tempo*/
date_default_timezone_set('America/Sao_Paulo');

/*Inserindo jogador no bd*/
if (!empty($_POST['acao']) and $_POST['acao'] == 1 ){

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

    $nome = $_POST['nomeCompleto'];
    $apelido = $_POST['apelido'];
    $funcao = $_POST['funcao'];
    $dataNascimento = $_POST['data_nascimento'];

    /*Tratando nacionalidade*/
    if (!empty($_POST['nacionalidade']) and $_POST['nacionalidade'] == 'Brasileiro'){
        $nacionalidade = $_POST['nacionalidade'];
        $naturalidadeEstado = $_POST['naturalidadeEstado'];
        $naturalidadeCidade = $_POST['naturalidadeCidade'];
        $naturalidade = $naturalidadeCidade.' - '.$naturalidadeEstado;
    }else{
        if (!empty($_POST['nacionalidade']) and $_POST['nacionalidade'] == 'outra'){
            $nacionalidade = $_POST['nacionalidadeDigitada'];
            $naturalidade = $_POST['naturalidadeDigitada'];
        }
    }

    /*Tratando foto do jogador*/
    $file = $_FILES['fotoPerfil'];
    $filename = tratar_arquivo_upload(utf8_decode($file['name']));
    $uploaddir = '../view/img/elenco/';
    $uploadfile = $uploaddir . basename($filename);
    if (move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $uploadfile)) {
        $elencado->setFotoDePerfil($filename);
    }

    $elencado->setNome($nome);
    $elencado->setApelido($apelido);
    $elencado->setFuncao($funcao);
    $elencado->setDataNascimento($dataNascimento);
    $elencado->setNacionalidade($nacionalidade);
    $elencado->setNaturalidade($naturalidade);
    $elencado->setTipo(1);

    if ($elencado->insert()){
        $_SESSION['salvou'] = true;
        header('location:../view/adm/elenco-gestao.php');
    }else{
        $_SESSION['salvou'] = false;
        header('location:../view/adm/elenco-gestao.php');
    }

}

/*Inserindo outra categoria de elencado no bd*/
if (!empty($_POST['acao']) and $_POST['acao'] == 11){

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

    $nome = $_POST['nomeCompletoOutro'];
    $apelido = $_POST['apelidoOutro'];
    $tipo = $_POST['categoria'];
    $funcao = $_POST['funcaoOutro'];

    /*Tratando foto do elencado*/
    $file = $_FILES['fotoPerfilOutro'];
    $filename = tratar_arquivo_upload(utf8_decode($file['name']));
    $uploaddir = '../view/img/elenco/';
    $uploadfile = $uploaddir . basename($filename);
    if (move_uploaded_file($_FILES['fotoPerfilOutro']['tmp_name'], $uploadfile)) {
        $elencado->setFotoDePerfil($filename);
    }

    $elencado->setNome($nome);
    $elencado->setApelido($apelido);
    $elencado->setTipo($tipo);
    $elencado->setFuncao($funcao);

    if ($elencado->insert()){
        $_SESSION['salvou'] = true;
        header('location:../view/adm/elenco-gestao.php');
    }else{
        $_SESSION['salvou'] = false;
        header('location:../view/adm/elenco-gestao.php');
    }
}


/*Excluindo elencado*/
if (!empty($_GET['acao']) and $_GET['acao'] == 2){
    $codigoElencado = $_SESSION['excluir'];

    if ($elencado->deletar($codigoElencado)){
        $_SESSION['excluiu'] = true;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/elenco-gestao.php');
    }else{
        $_SESSION['excluiu'] = false;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/elenco-gestao.php');
    }
}

/*Excluindo elencado jogador*/
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

    /*Pegando dados via post*/
    $codigoElencado = $_POST['codigoElencado'];
    $nome = $_POST['nomeCompleto'];
    $apelido = $_POST['apelido'];
    $funcao = $_POST['funcao'];
    $dataNascimento = $_POST['data_nascimento'];

    /*Tratando nacionalidade*/
    if (!empty($_POST['nacionalidade']) and $_POST['nacionalidade'] == 'Brasileiro'){
        $nacionalidade = $_POST['nacionalidade'];
        $naturalidadeEstado = $_POST['naturalidadeEstado'];
        $naturalidadeCidade = $_POST['naturalidadeCidade'];
        $naturalidade = $naturalidadeCidade.' - '.$naturalidadeEstado;
    }else{
        if (!empty($_POST['nacionalidade']) and $_POST['nacionalidade'] == 'outra'){
            $nacionalidade = $_POST['nacionalidadeDigitada'];
            $naturalidade = $_POST['naturalidadeDigitada'];
        }
    }

    if (!$_FILES['fotoPerfil']['size'] == 0){

        $elencadoSelecionado = $elencado->selectElencado($codigoElencado);
        $file =  '../view/img/elenco/'.$elencadoSelecionado->fotoDePerfil;

        if (file_exists($file)){
            unlink($file);
            $file = $_FILES['fotoPerfil'];
            $filename = tratar_arquivo_upload(utf8_decode($file['name']));
            $uploaddir = '../view/img/elenco/';
            $uploadfile = $uploaddir . basename($filename);
            move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $uploadfile);
            $elencado->setFotoDePerfil($filename);
        }
    }else{
        $elencadoSelecionado= $elencado->selectElencado($codigoElencado);
        $elencado->setFotoDePerfil($elencadoSelecionado->fotoDePerfil);
    }

    $elencado->setNome($nome);
    $elencado->setApelido($apelido);
    $elencado->setFuncao($funcao);
    $elencado->setDataNascimento($dataNascimento);
    $elencado->setNacionalidade($nacionalidade);
    $elencado->setNaturalidade($naturalidade);
    $elencado->setTipo(1);

    if ($elencado->updateElencado($codigoElencado)){
        $_SESSION['editou'] = true;
        header('location:../view/adm/elenco-gestao.php');
    }else{
        $_SESSION['editou'] = false;
        header('location:../view/adm/elenco-gestao.php');
    }

}

if (!empty($_POST['acao']) and $_POST['acao'] == 33){
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
    $codigoElencado = $_POST['codigoElencado'];
    $nome = $_POST['nomeCompletoOutro'];
    $apelido = $_POST['apelidoOutro'];
    $tipo = $_POST['categoria'];
    $funcao = $_POST['funcaoOutro'];

    if (!$_FILES['fotoPerfilOutro']['size'] == 0){

        $elencadoSelecionado = $elencado->selectElencado($codigoElencado);
        $file =  '../view/img/elenco/'.$elencadoSelecionado->fotoDePerfil;

        if (file_exists($file)){
            unlink($file);
            $file = $_FILES['fotoPerfilOutro'];
            $filename = tratar_arquivo_upload(utf8_decode($file['name']));
            $uploaddir = '../view/img/elenco/';
            $uploadfile = $uploaddir . basename($filename);
            move_uploaded_file($_FILES['fotoPerfilOutro']['tmp_name'], $uploadfile);
            $elencado->setFotoDePerfil($filename);
        }
    }else{
        $elencadoSelecionado= $elencado->selectElencado($codigoElencado);
        $elencado->setFotoDePerfil($elencadoSelecionado->fotoDePerfil);
    }

    $elencado->setNome($nome);
    $elencado->setApelido($apelido);
    $elencado->setTipo($tipo);
    $elencado->setFuncao($funcao);

    if ($elencado->updateElencado($codigoElencado)){
        $_SESSION['editou'] = true;
        header('location:../view/adm/elenco-gestao.php');
    }else{
        $_SESSION['editou'] = false;
        header('location:../view/adm/elenco-gestao.php');
    }
}