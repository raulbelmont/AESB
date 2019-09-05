<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 12/11/2018
 * Time: 14:22
 */

require_once '../model/VideosModel.php';
$video = new VideosModel();
if (!session_id()) session_start();

/*Salvando Video*/
if (!empty($_POST['acao']) and ($_POST['acao'] == 1)){
    /*Definindo zona de tempo*/
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


    $autor = $_SESSION['nome'];
    $dataPublicacao = date('Y-m-d H:i:s');
    $tituloVideo= $_POST['tituloVideo'];
    $descricaoVideo= $_POST['descricaoVideo'];

    /*Video*/
    $file = $_FILES['video'];
    $filename = tratar_arquivo_upload(utf8_decode($file['name']));
    $uploaddir = '../view/videos/';
    $uploadfile = $uploaddir . basename($filename);
    if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadfile)) {
        $video->setVideo($filename);
    }

    /*poster*/
    $file = $_FILES['poster'];
    $filename = tratar_arquivo_upload(utf8_decode($file['name']));
    $uploaddir = '../view/videos/poster/';
    $uploadfile = $uploaddir . basename($filename);
    if (move_uploaded_file($_FILES['poster']['tmp_name'],$uploadfile)){
        $video->setPoster($filename);
    }

    $video->setAutor($autor);
    $video->setDataPublicacao($dataPublicacao);
    $video->setTituloVideo($tituloVideo);
    $video->setDescricaoVideo($descricaoVideo);
	$video->setTipoVideo(0);


    if ($video->insert()){
        $_SESSION['salvou'] = true;
        header('location:../view/adm/videos-gestao.php');
    }else{
        $_SESSION['salvou'] = false;
        header('location:../view/adm/videos-gestao.php');
    }
}

/*Salvando vídeo enviado por torcedor*/
if (!empty($_POST['acao']) and ($_POST['acao'] == 11)) {
    /*Definindo zona de tempo*/
    date_default_timezone_set('America/Sao_Paulo');

    /*Função para formatar a imagem da noticia*/
    function tratar_arquivo_upload($string)
    {
        // pegando a extensao do arquivo
        $partes = explode(".", $string);
        $extensao = $partes[count($partes) - 1];
        // somente o nome do arquivo
        $nome = preg_replace('/\.[^.]*$/', '', $string);
        // removendo simbolos, acentos etc
        $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ?';
        $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr-';
        $nome = strtr($nome, utf8_decode($a), $b);
        $nome = str_replace(".", "-", $nome);
        $nome = preg_replace("/[^0-9a-zA-Z\.]+/", '-', $nome);
        return utf8_decode(strtolower($nome . "." . $extensao));
    }


    $autor = $_POST['autor'];
    $dataPublicacao = date('Y-m-d H:i:s');
    $tituloVideo = $_POST['titulo'];

    /*Video*/
    $file = $_FILES['video'];
    $filename = tratar_arquivo_upload(utf8_decode($file['name']));
    $uploaddir = '../view/videos/torcedores/';
    $uploadfile = $uploaddir . basename($filename);
    if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadfile)) {
        $video->setVideo($filename);
    }

    $video->setAutor($autor);
    $video->setDataPublicacao($dataPublicacao);
    $video->setTituloVideo($tituloVideo);
    $video->setTipoVideo(1);


    $video->insert();
}



/*Excluindo video*/
if (!empty($_GET['acao']) and $_GET['acao'] == 2){
    $codigoVideo = $_SESSION['excluir'];

    if ($video->deletar($codigoVideo)){
        $_SESSION['excluiu'] = true;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/videos-gestao.php');
    }else{
        $_SESSION['excluiu'] = false;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/videos-gestao.php');
    }

}

/*Excluindo video do torcedor em análise*/
if (!empty($_GET['acao']) and $_GET['acao'] == 21){
    $codigoVideo = $_SESSION['excluir'];

    if ($video->deletar($codigoVideo)){
        $_SESSION['excluiuTorcedor'] = true;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/videos-gestao.php');
    }else{
        $_SESSION['excluiuTorcedor'] = false;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/videos-gestao.php');
    }

}

/*Excluindo video do torcedor publicado*/
if (!empty($_GET['acao']) and $_GET['acao'] == 22){
    $codigoVideo = $_SESSION['excluir'];

    if ($video->deletar($codigoVideo)){
        $_SESSION['excluiuTorcedorP'] = true;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/videos-gestao.php');
    }else{
        $_SESSION['excluiuTorcedorP'] = false;
        $_SESSION['excluir'] = null;
        header('location:../view/adm/videos-gestao.php');
    }

}



/*Editando video*/
if (!empty($_POST['acao']) and ($_POST['acao'] == 3)){

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


    $autor = $_SESSION['nome'];
    $codigoVideo = $_POST['codigoVideo'];
    $ultimaAtualizacao = date('Y-m-d H:i:s');
    $tituloVideo = $_POST['tituloVideo'];
    $descricaoVideo = $_POST['descricaoVideo'];

    /*video*/
    if (!$_FILES['video']['size'] == 0){

        $videoSelecionada = $video->selectPorCodigo($codigoVideo);
        $file =  '../view/videos/'.$videoSelecionada->video;

        if (file_exists($file)){
            unlink($file);
            $file = $_FILES['video'];
            $filename = tratar_arquivo_upload(utf8_decode($file['name']));
            $uploaddir = '../view/videos/';
            $uploadfile = $uploaddir . basename($filename);
            move_uploaded_file($_FILES['video']['tmp_name'], $uploadfile);
            $video->setVideo($filename);
        }
    }else{

        $videoSelecionada = $video->selectPorCodigo($codigoVideo);
        $video->setVideo($videoSelecionada->video);
    }

    /*poster*/
    if (!$_FILES['poster']['size'] == 0){

        $posterSelecionada = $video->selectPorCodigo($codigoVideo);
        $file =  '../view/videos/poster/'.$posterSelecionada->poster;

        if (file_exists($file)){
            unlink($file);
            $file = $_FILES['poster'];
            $filename = tratar_arquivo_upload(utf8_decode($file['name']));
            $uploaddir = '../view/videos/poster/';
            $uploadfile = $uploaddir . basename($filename);
            move_uploaded_file($_FILES['poster']['tmp_name'], $uploadfile);
            $video->setPoster($filename);
        }
    }else{

        $posterSelecionada = $video->selectPorCodigo($codigoVideo);
        $video->setPoster($videoSelecionada->poster);
    }




    $video->setAutor($autor);
    $video->setTituloVideo($tituloVideo);
    $video->setDescricaoVideo($descricaoVideo);
    $video->setUltimaAtualizacao($ultimaAtualizacao);

    if ($video->updateVideo($codigoVideo)){
        $_SESSION['editou'] = true;
        header('location:../view/adm/videos-gestao.php');
    }else{
        $_SESSION['editou'] = false;
        header('location:../view/adm/videos-gestao.php');
    }
}

/*Publicando video enviado pelo torcedor*/
if (!empty($_GET['acao']) and $_GET['acao'] == 4){

    $codigoVideo = $_SESSION['publicar'];
    $video->setTipoVideo(2);
    if ($video->publicarVideoTorcedor($codigoVideo)){
        $_SESSION['salvouTorcedor'] = true;
        $_SESSION['publicar'] = null;
        header('location:../view/adm/videos-gestao.php');
    }else{
        $_SESSION['salvouTorcedor'] = false;
        $_SESSION['publicar'] = null;
        header('location:../view/adm/videos-gestao.php');
    }
}

/*Despublicando video enviado pelo torcedor*/
if (!empty($_GET['acao']) and $_GET['acao'] == 5){

    $codigoVideo = $_SESSION['remover'];
    $video->setTipoVideo(1);
    if ($video->publicarVideoTorcedor($codigoVideo)){
        $_SESSION['removeuTorcedorP'] = true;
        $_SESSION['remover'] = null;
        header('location:../view/adm/videos-gestao.php');
    }else{
        $_SESSION['removeuTorcedorP'] = false;
        $_SESSION['remover'] = null;
        header('location:../view/adm/videos-gestao.php');
    }
}

/*Buscando mais vídeos da aesb via ajax*/
if (!empty($_GET['acao']) and $_GET['acao'] == 6){
    $pagina = $_GET['pagina'];

    foreach($video->selectPaginacaoAesb($pagina) as $key => $value){

        if ($value->poster == null){
            $poster = 'fundo-neutro.png';
        }else{
            $poster = $value->poster;
        }

        $modal = '';
        $modal .= "<a class='col-12 col-sm-5 m-2' data-toggle='modal' data-target='#visualizarVideo$value->codigoVideo' >";
        $modal .= " <div class='row'>";
        $modal .= "<video id='$value->codigoVideo' class='video w-100 col-12' poster='videos/poster/$poster'>";
        $modal .= "<source class='video-source' src='videos/$value->video'/>";
        $modal .= "</video>";
        $modal .= "<p class='text-truncate font-weight-bold col-12'>$value->tituloVideo</p>";
        $modal .= "<p class='small text-muted col-12'>$value->descricaoVideo</p>";
        $modal .= "</div>";
        $modal .= "</a> ";

        $modal .= "<div class='modal fade' id='visualizarVideo$value->codigoVideo' tabindex='-1' role='dialog' aria-hidden='true'>";
        $modal .= "<div class='modal-dialog' role='document'>";
        $modal .= "<div class='modal-content'>";
        $modal .= "<div class='modal-header'>";
        $modal .= "<h5 class='modal-title text-center'>$value->tituloVideo</h5>";
        $modal .= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
        $modal .= "<span aria-hidden='true'><i class='fas fa-times-circle'></i></span>";
        $modal .= "</button>";
        $modal .= "</div>";
        $modal .= "<div class='modal-body'>";
        $modal .= " <video class='w-100 video' poster='../videos/poster/$poster' controls>";
        $modal .= "<source src='videos/$value->video'>";
        $modal .= "<embed src='videos/$value->video' type='application/x-shockwave-flash' allowfullscreen='false' allowscriptaccess='always'>";
        $modal .= "Formato não suportado pelo navegador.";
        $modal .= "</video>";
        $modal .= "</div>";
        $modal .= "</div>";
        $modal .= "</div>";
        $modal .= "</div>";
        echo $modal;

   }
}

/*Buscando mais vídeos da aesb via ajax*/
if (!empty($_GET['acao']) and $_GET['acao'] == 61){
    $pagina = $_GET['pagina'];

    foreach($video->selectPaginacaoPublicadosAjax($pagina) as $key => $value){

        $data = new DateTime($value->dataPublicacao);
        $dataP = $data->format('d/m/Y');
        $modal = '';
        $modal .= "<a class='col-12 col-sm-5 m-2' data-toggle='modal' data-target='#visualizarVideoP$value->codigoVideo' >";
        $modal .= " <div class='row'>";
        $modal .= "<video id='$value->codigoVideo' class='video w-100 col-12'>";
        $modal .= "<source class='video-source' src='videos/torcedores/$value->video'/>";
        $modal .= "</video>";
        $modal .= "<p class='text-truncate font-weight-bold col-12'>$value->tituloVideo</p>";
        $modal .= "<p class='small text-muted col-12'>Enviado por $value->autor dia $dataP  </p>";
        $modal .= "</div>";
        $modal .= "</a> ";

        $modal .= "<div class='modal fade' id='visualizarVideoP$value->codigoVideo' tabindex='-1' role='dialog' aria-hidden='true'>";
        $modal .= "<div class='modal-dialog' role='document'>";
        $modal .= "<div class='modal-content'>";
        $modal .= "<div class='modal-header'>";
        $modal .= "<h5 class='modal-title text-center'>$value->tituloVideo</h5>";
        $modal .= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
        $modal .= "<span aria-hidden='true'><i class='fas fa-times-circle'></i></span>";
        $modal .= "</button>";
        $modal .= "</div>";
        $modal .= "<div class='modal-body'>";
        $modal .= " <video class='w-100 video'controls>";
        $modal .= "<source src='videos/torcedores/$value->video'>";
        $modal .= "<embed src='videos/torcedores/$value->video' type='application/x-shockwave-flash' allowfullscreen='false' allowscriptaccess='always'>";
        $modal .= "Formato não suportado pelo navegador.";
        $modal .= "</video>";
        $modal .= "</div>";
        $modal .= "</div>";
        $modal .= "</div>";
        $modal .= "</div>";
        echo $modal;

    }
}