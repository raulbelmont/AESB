<?php

require_once '../model/ClubeModel.php';
$clube = new ClubeModel();
if (!session_id()) session_start();

/*Editando dados do clube*/
if (!empty($_POST['acao']) and $_POST['acao'] == 1){
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
    $codigoClube = $_POST['codigoClube'];
    $ultimaAtualizacao = date('Y-m-d H:i:s');
    $nome = $_POST['nome'];
    $nomeAbreviado = $_POST['nomeAbreviado'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $cep = $_POST['cep'];
    $endereco = "Rua $rua, $numero, $cidade - $uf, CEP: $cep";
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $facebookLink = $_POST['facebookLink'];
    $instagramLink = $_POST['instagramLink'];
    $twitterLink = $_POST['twitterLink'];
    $youtubekLink = $_POST['youtubeLink'];
    $googlePluskLink = $_POST['googlePlusLink'];

    $clube->setUltimaAtualizacao($ultimaAtualizacao);
    $clube->setNome($nome);
    $clube->setNomeAbreviado($nomeAbreviado);
    $clube->setRua($rua);
    $clube->setNumero($numero);
    $clube->setCidade($cidade);
    $clube->setUf($uf);
    $clube->setCep($cep);
    $clube->setEndereco($endereco);
    $clube->setCnpj($cnpj);
    $clube->setEmail($email);
    $clube->setTelefone($telefone);
    $clube->setFacebookLink($facebookLink);
    $clube->setInstagramLink($instagramLink);
    $clube->setTwitterLink($twitterLink);
    $clube->setYoutubeLink($youtubekLink);
    $clube->setGooglePlusLink($googlePluskLink);


    if (!$_FILES['logo-clube']['size'] == 0){

        $clubeAESB = $clube->selectClube($codigoClube);
        $file =  '../view/img/'.$clubeAESB->logo;

        if (file_exists($file)){
            unlink($file);
            $file = $_FILES['logo-clube'];
            $filename = tratar_arquivo_upload(utf8_decode($file['name']));
            $uploaddir = '../view/img/';
            $uploadfile = $uploaddir . basename($filename);
            move_uploaded_file($_FILES['logo-clube']['tmp_name'], $uploadfile);
            $clube->setLogo($filename);
        }
    }else{
        $clubeAESB = $clube->selectClube($codigoClube);
        $clube->setLogo($clubeAESB->logo);
    }

    $clube->setUltimaAtualizacao($ultimaAtualizacao);
    $clube->setNome($nome);
    $clube->setNomeAbreviado($nomeAbreviado);
    $clube->setRua($rua);
    $clube->setNumero($numero);
    $clube->setCidade($cidade);
    $clube->setUf($uf);
    $clube->setCep($cep);
    $clube->setEndereco($endereco);
    $clube->setCnpj($cnpj);
    $clube->setEmail($email);
    $clube->setTelefone($telefone);
    $clube->setFacebookLink($facebookLink);
    $clube->setInstagramLink($instagramLink);
    $clube->setTwitterLink($twitterLink);
    $clube->setYoutubeLink($youtubekLink);
    $clube->setGooglePlusLink($googlePluskLink);

    if ($clube->updateClube($codigoClube)){
        $_SESSION['editou'] = true;
        header('location:../view/adm/clube-gestao.php');
    }else{
        $_SESSION['editou'] = false;
        header('location:../view/adm/clube-gestao.php');
    }

}