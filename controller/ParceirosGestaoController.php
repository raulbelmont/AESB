<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 18/10/2018
 * Time: 16:07
 */
require_once '../model/ParceirosGestaoModel.php';
$parceiro = new ParceirosGestaoModel();

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

/*PEGANDO DADOS DO FORM*/
$tipo = $_POST['tipo'];

if ($tipo == 1){
    $parceiro->setTipo($tipo);

    $nomeParceiro = $_POST['nomePatrocinador'];
    $parceiro->setNome($nomeParceiro);

    $file = $_FILES['logoPatrocinador'];
    $filename = tratar_arquivo_upload(utf8_decode($file['name']));
    $uploaddir = '../view/img/patrocinadores/';
    $uploadfile = $uploaddir . basename($filename);
     if (move_uploaded_file($_FILES['logoPatrocinador']['tmp_name'], $uploadfile)) {
        $parceiro->setLogoParceiro($filename);
    }
}
if ($tipo == 2){
    $parceiro->setTipo($tipo);

    $nomeParceiro = $_POST['nomeApoiador'];
    $parceiro->setNome($nomeParceiro);

    $file = $_FILES['logoApoiadores'];
    $filename = tratar_arquivo_upload(utf8_decode($file['name']));
    $uploaddir = '../view/img/apoiadores/';
    $uploadfile = $uploaddir . basename($filename);
     if (move_uploaded_file($_FILES['logoApoiadores']['tmp_name'], $uploadfile)) {
         $parceiro->setLogoParceiro($filename);
    }
}
if ($tipo == 3){
   $parceiro->setTipo($tipo);
    $nomeParceiro = $_POST['nomeFornecedor'];
    $parceiro->setNome($nomeParceiro);

    $file = $_FILES['logoFornecedores'];
    $filename = tratar_arquivo_upload(utf8_decode($file['name']));
    $uploaddir = '../view/img/fornecedores/';
    $uploadfile = $uploaddir . basename($filename);
    echo $_FILES['logoFornecedores']['name'];
     if (move_uploaded_file($_FILES['logoFornecedores']['tmp_name'], $uploadfile)) {
         $parceiro->setLogoParceiro($filename);
    }
}
/*INSERINDO PARCEIRO NO BD*/
if ($parceiro->insert()){
    header('location:../view/adm/parceiros-gestao.php');
}else{
    echo 'Fracasso';
}

