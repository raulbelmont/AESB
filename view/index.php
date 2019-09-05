<?php
require_once '../model/ElencoModel.php';
require_once '../model/NoticiasModel.php';
require_once '../model/VideosModel.php';
require_once '../model/ImagensModel.php';
require_once '../model/JogosModel.php';
require_once '../model/CompeticoesModel.php';
$elenco = new ElencoModel();
$noticia = new NoticiasModel();
$video = new VideosModel();
$imagem = new ImagensModel();
$jogo = new JogosModel();
$competicao = new CompeticoesModel();
date_default_timezone_set('America/Sao_Paulo');
?>
<!doctype html>
<html>

<head>
	
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
   
	
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/moduloPublico/index.css"/>
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <title>AESB - Página Inicial</title>


</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>




        <!--Cabeçalho-->
        <header>
            <!--Incluindo menu e logo no topo-->
            <?php
                include 'inc/incMenuPrincipal.php';
            ?>
        </header><!--Fim do Cabeçalho-->


	<main><!--Início do conteúdo principal da página-->

            <!--Container de todoo conteúdo-->
            <div class="container-fluid my-0 p-0">

                <!--CARROSEL-->
                <div class="row justify-content-center m-0">
                    <div class="col-md-12 p-0">

                        <!--Início do carrosel-->
                        <div id="carrosel" class="carousel slide carrosel-primario" data-ride="carousel">

                            <!--Lista com indicadores-->
                            <ol class="carousel-indicators">

                                <?php $cont = 1; foreach ($imagem->selectAllByLocal(1) as $key => $value): ?>
                                <li data-target="#carrosel" data-slide-to="<?=$cont?>" class="active"></li>
                                <?php $cont++; endforeach; ?>
                            </ol><!--Fim da lista com indicadores-->

                            <!--Conteúdo principal do carrosel-->
                            <div class="carousel-inner">

                                <?php $cont = 1; foreach ($imagem->selectAllByLocal(1) as $key => $value): if ($cont == 1){$active = 'active';}else{$active='';} ?>
                                <!--Itens do Carrosel-->
                                <div class="carousel-item <?=$active?>">

                                    <!--Imagem-->
                                    <img class="img-carrosel-principal img-fluid d-block" src="img/<?=$value->imagem?>"/>

                                    <!--Descrição da imagem-->
                                    <div class="carousel-caption d-none d-md-block descricao-carrousel-principal">
                                        <h2 class="titulo-descricao-carrosel text-left font-weight-bold"><?=$value->titulo?></h2>
                                        <p class="descricao-carrousel text-left font-weight-bold"><?=$value->legenda?></p>
                                    </div>

                                </div>
                                <?php $cont++; endforeach; ?>


                            </div><!--Fim do conteúdo principal do carrosel-->

                            <!--Controles do carrosel-->
                            <!--NEXT-->
                            <a class="carousel-control-next" href="#carrosel" role="button" data-slide="next">

                               <i class="fas fa-angle-right fa-3x icone-carrosel-principal"></i>
                                <span class="sr-only" aria-hidden="true">Proximo</span>

                            </a>
                            <!--PREV-->
                            <a class="carousel-control-prev" href="#carrosel" role="button" data-slide="prev">

                                <i class="fas fa-angle-left fa-3x icone-carrosel-principal"></i>
                                <span class="sr-only" aria-hidden="true">Anterior</span>

                            </a>

                        </div><!--Fim do Carrosel-->

                    </div>
                </div><!--Fim da row que contém o carrosel-->

				   <!--Anúncios-->
                <div class="row anuncios m-0">

                    <?php $anuncio1 = $imagem->selectAllByLocal(3) ?>
                    <?php $anuncio2 = $imagem->selectAllByLocal(4) ?>
                    <!--Anúncio 1-->
                    <div class="col-12 col-md-6 border-right p-0">

                        <a>
                            <img id="anuncio" class="img-fluid d-block" src="img/<?=$anuncio1[0]->imagem?>" alt="Descrição do Anúncio"/>
                        </a>

                    </div>

                    <!--Anúncio 2-->
                    <div class="col-12 col-md-6 p-0">

                        <a>
                            <img id="anuncio" class="img-fluid d-none d-md-block" src="img/<?=$anuncio2[0]->imagem?>" alt="Descrição do Anúncio"/>
                        </a>

                    </div>

                </div>

				
                <!--Resultados-->
                <div class="row m-0 resultados">

                    <!--Próxima Partida-->
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5">

                        <div class="row">
                            <div class="col-12">

                                <h5 class="text-center font-weight-bold titulo-painel-resultados">Próxima Partida</h5>


                                <?php if (!$jogo->selectProximoJogo()){ ?>
                                <div class="row border-right justify-content-center">

                                    <div class="d-flex placar-logo">
                                        <h2 class="text-white">A definir</h2>                                    </div>



                                    <div class="pl-3 ml-1">

                                    </div>

                                </div>
                                <?php }else{

                                    $proximoJogo = $jogo->selectProximoJogo();
                                    $competicaoProximoJogo = $competicao->selectCompeticao($proximoJogo->codigoCompeticao);

                                    $data = new DateTime($proximoJogo->dataJogo);
                                    $dataJogo = $data->format('d/m/Y');

                                    $hora = new DateTime($proximoJogo->horario);
                                    $horarioJogoteste = $hora->format('H:i');

                                    ?>
                                    <div class="row border-right justify-content-center">

                                        <div class="d-flex placar-logo">
                                            <!--AESB-->
                                            <h5 class="d-none d-md-inline align-self-center mr-2 font-weight-bold text-uppercase"><?=$proximoJogo->mandanteAbreviacao?></h5>

                                            <img class="logo-placar" src="img/competicoes-e-jogos/<?=$proximoJogo->logoMandante?>" alt="Logo do Avenida"/>

                                            <!--PLACAR-->
                                            <div class="placar-ultimo-jogo align-self-center mx-1">

                                                <p class="d-inline invisible align-self-center">0</p>
                                                <i class="fas fa-times mx-3 align-self-center"></i>
                                                <p class="d-inline invisible align-self-center">0</p>

                                            </div>

                                            <!--TIME RIVAL-->
                                            <img src="img/competicoes-e-jogos/<?=$proximoJogo->logoVisitante?>" alt="Logo da Aesb"/>

                                            <h5 class="d-none d-md-inline text-uppercase align-self-center ml-2 font-weight-bold"><?=$proximoJogo->visitanteAbreviacao?></h5>
                                        </div>



                                        <div class="pl-3 ml-1">
                                            <p class="mb-0"><?=$competicaoProximoJogo->nome?></p>
                                            <p class="mb-0"><i class="fas fa-calendar-alt"></i> <?=$dataJogo?> às <?=$horarioJogoteste?></p>
                                            <p class="mb-0"><i class="fas fa-map-marker-alt"></i> <?=$proximoJogo->localJogo?></p>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                    <hr class="w-100 clearfix d-md-none my-3 bg-light">

                    <!--Partida Anterior-->
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5">
                        <div class="row">
                            <div class="col-12">

                                <h5 class="text-center font-weight-bold titulo-painel-resultados">Partida Anterior</h5>

                                <div class="row justify-content-center">

                                    <div class="d-flex placar-logo">
                                        <?php $ultimoJogo = $jogo->selectUltimoJogo();
                                        $competicaoUltimoJogo = $competicao->selectCompeticao($ultimoJogo->codigoCompeticao);

                                        $data = new DateTime($ultimoJogo->dataJogo);
                                        $dataJogo = $data->format('d/m/Y');

                                        $hora = new DateTime($ultimoJogo->horario);
                                        $horarioJogo = $hora->format('H:i');
                                        ?>
                                        <!--AESB-->
                                        <h5 class="d-none d-md-inline align-self-center mr-2 font-weight-bold text-uppercase"><?=$ultimoJogo->mandanteAbreviacao?></h5>

                                        <img class="logo-placar" src="img/competicoes-e-jogos/<?=$ultimoJogo->logoMandante?>" alt="Logo da aesb"/>

                                        <!--PLACAR-->
                                        <div class="placar-ultimo-jogo align-self-center mx-1">

                                            <p class="d-inline align-self-center"><?=$ultimoJogo->placarMandante?> </p>
                                            <i class="fas fa-times mx-3 align-self-center"></i>
                                            <p class="d-inline align-self-center"><?=$ultimoJogo->placarVisitante?> </p>

                                        </div>
                                        <!--TIME RIVAL-->
                                        <img src="img/competicoes-e-jogos/<?=$ultimoJogo->logoVisitante?>" alt="Logo da AESB"/>

                                        <h5 class="d-none d-md-inline align-self-center ml-2 font-weight-bold text-uppercase"><?=$ultimoJogo->visitanteAbreviacao?></h5>
                                    </div>



                                    <div class="pl-3 ml-1">
                                        <p class="mb-0"><?=$competicaoUltimoJogo->nome?></p>
                                        <p class="mb-0"><i class="fas fa-calendar-alt"></i> <?=$dataJogo?> às <?=$horarioJogo?></p>
                                        <p class="mb-0"><i class="fas fa-map-marker-alt"></i> <?=$ultimoJogo->localJogo?></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="w-100 clearfix d-md-none my-3 bg-light">

                    <!--Botões sejá sócio e últimos resultados-->
                    <div class="col-12 col-md-2 col-lg-2 d-flex p-0">

                        <div class="botoes-painel-resultados align-self-center m-auto">

                            <a href="competicoes-e-jogos.php">
                                <button type="button" class="botao-resultados btn btn-block font-weight-bold mb-2 mt-1">
                                    Resultados <i class="far fa-futbol"></i>
                                </button>
                            </a>

                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfg90Er056IpCvCsT7zLRp5KLPuqOTR_utOfJn_Nc0DUIor_Q/viewform" target="_blank">
                                <button type="button" class="botao-socio btn btn-block font-weight-bold mb-1">
                                    Seja Sócio <i class="fas fa-users"></i>
                                </button>
                            </a>
                        </div>

                    </div>
                    <hr class="w-100 clearfix d-md-none my-3 bg-light">

                </div>

                <!--Resultados-->
                <div class="row m-0">



                    <?php $chamada = $imagem->selectAllByLocal(2); ?>
                    <div class="col-md-5 p-4 chamada-p-jogo border-right">
                        <figure class="">
                            <img class="img-fluid" src="img/<?=$chamada[0]->imagem?>"/>
                        </figure>
                    </div>

                    <div class="col-md-7 p-4 chamada-p-jogo">
                        <!--Jogos-->
                        <div class="text-white">

                            <h3 class="font-weight-bold text-center pb-2">Últimas partidas <i class="far fa-futbol"></i></h3>

                            <hr class="w-100 clearfix my-1 bg-light">

                        <div class="row">

                            <div class="jogos-competicao border-right my-5 p-0 col-12 text-center">

                                        <?php foreach ($jogo->selectByData() as $key => $value):
                                            $competicaoProximoJogo = $competicao->selectCompeticao($value->codigoCompeticao);

                                            $data = new DateTime($value->dataJogo);
                                            $dataJogo = $data->format('d/m/Y');

                                            $hora = new DateTime($value->horario);
                                            $horarioJogo = $hora->format('H:i');
                                        ?>
                                        <!--Jogo-->
                                        <div class="col-12 jogo py-4">

                                            <div class="row justify-content-center">

                                                <div class="col-12 col-sm-6">
                                                    <div class="d-flex placar-logo justify-content-center">
                                                        <!--AESB-->
                                                        <h5 class="d-none d-md-inline align-self-center mr-2 font-weight-bold text-uppercase"><?=$value->mandanteAbreviacao?></h5>

                                                        <img class="logo-placar" src="img/competicoes-e-jogos/<?=$value->logoMandante?>" alt="Logo da Aesb"/>

                                                        <!--PLACAR-->
                                                        <div class="placar-ultimo-jogo align-self-center mx-1">

                                                            <p class="d-inline align-self-center"><?=$value->placarMandante?></p>
                                                            <i class="fas fa-times mx-3 align-self-center"></i>
                                                            <p class="d-inline align-self-center"><?=$value->placarVisitante?></p>

                                                        </div>

                                                        <!--TIME RIVAL-->
                                                        <img src="img/competicoes-e-jogos/<?=$value->logoVisitante?>" alt="Logo da Aesb"/>

                                                        <h5 class="d-none d-md-inline text-uppercase align-self-center ml-2 font-weight-bold"><?=$value->visitanteAbreviacao?></h5>
                                                    </div>
                                                </div>



                                                <div class="col-12 col-sm-6 mt-2 mt-sm-0 text-center text-sm-left">
                                                    <div class="ml-sm-5">
                                                        <p class="mb-0 font-weight-bold"><?=$competicaoProximoJogo->nome?></p>
                                                        <p class="mb-0"><i class="fas fa-calendar-alt"></i>  <?=$dataJogo?> às <?=$horarioJogo?></p>
                                                        <p class="mb-0"><i class="fas fa-map-marker-alt"></i> <?=$value->localJogo?></p>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <?php endforeach; ?>

                                    </div>

                        </div>


                        </div>
                    </div>


                </div>


                <div class="row m-0">
                    
                    <img class="col-12 p-0 m-0" alt="" src="img/artesocio2_0.jpg">

                    <div class="col-12 m-0 p-0 py-4 btn-socio text-center">
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfg90Er056IpCvCsT7zLRp5KLPuqOTR_utOfJn_Nc0DUIor_Q/viewform" class="botao-socio-2 text-uppercase my-5 py-3 px-5 font-weight-bold">Seja sócio <i class="fas fa-users"></i></a>
                    </div>
                </div>


                <!--Notícias-->
                <div class="row m-0 noticias">
                    <div class="col-12 noticias">

                        <div class="row justify-content-center">
                            <h2 class="col-12 text-center p-3 mb-0 font-weight-bold titulo-painel-noticias"><a href="noticias.php" >Notícias <i class="fas fa-newspaper"></i></a></h2>

                            <?php $cont = 1; foreach ($noticia->selectNoticiasRecentes(9) as $key => $noticiaAtual):
                                if ($noticiaAtual->fundoNoticia == null){
                                    $fundo = 'fundo-neutro.png';
                                }else{
                                    $fundo = $noticiaAtual->fundoNoticia;
                                }
                                if ($cont<=3){
                                ?>

                                <a href="noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" class="col-11 col-sm-5 col-lg-3 card-noticia p-0 m-2 position-relative" style="background-image: url('img/noticias/<?=$fundo?>');">
                                <p class="horario-noticia m-2 mb-5"><span class="p-1"><i class="far fa-clock icone"></i>

                                        <?php
                                            $data = new DateTime($noticiaAtual->dataPublicacao);
                                            echo $data->format('d/m/Y H:i');
                                        ?>

                                    </span></p>

                                <div class="fixed-bottom position-absolute texto-noticia">

                                    <p class="titulo-noticia d-none d-md-block font-weight-bold text-truncate text-white px-2 ml-2 mr-2">
                                        <?php
                                        $tituloNoticia = $noticiaAtual->tituloNoticia;
                                        $titulo = wordwrap ( $tituloNoticia, 40 , "...<p class='d-none'>" );
                                        echo $titulo;
                                        ?>

                                    </p>

                                    <p class="font-weight-bold text-white ml-2 mr-1 mb-2 descricao-noticia">
                                        <?php
                                        $descricaoNoticia = $noticiaAtual->descricaoNoticia ;
                                        $descricao = wordwrap ( $descricaoNoticia , 72 , "...<p class='d-none'>" );
                                        echo $descricao;
                                        ?>
                                    </p>
                                    </p>

                                </div>
                            </a>

                                <?php }

                                if ($cont>3){
                                    ?>
                                    <a href="noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" class="d-none d-md-block col-11 col-sm-5 col-lg-3 card-noticia p-0 m-2 position-relative" style="background-image: url('img/noticias/<?=$fundo?>');">
                                        <p class="horario-noticia m-2 mb-5"><span class="p-1"><i class="far fa-clock icone"></i>
                                                <?php
                                                $data = new DateTime($noticiaAtual->dataPublicacao);
                                                echo $data->format('d/m/Y H:i');
                                                ?>
                                            </span></p>

                                        <div class="fixed-bottom position-absolute texto-noticia">

                                            <p class="titulo-noticia d-none d-md-block font-weight-bold text-truncate text-white px-2 ml-2 mr-2">
                                                <?php
                                                $tituloNoticia = $noticiaAtual->tituloNoticia ;
                                                $titulo = wordwrap ( $tituloNoticia, 40 , "...<p class='d-none'>" );
                                                echo $titulo;
                                                ?>

                                            </p>

                                            <p class="font-weight-bold text-white ml-2 mr-1 mb-2 descricao-noticia">
                                                <?php
                                                $descricaoNoticia = $noticiaAtual->descricaoNoticia ;
                                                $descricao = wordwrap ( $descricaoNoticia , 72 , "...<p class='d-none'>" );
                                                echo $descricao;
                                                ?>
                                            </p>
                                            </p>

                                        </div>
                                    </a>
                            <?php
                                }
                            ?>
                            <?php $cont++; endforeach; ?>

                            <div class="row col-12 justify-content-center">
                                <a href="noticias.php" class="col-6 col-sm-5 col-md-4 col-lg-3 text-center p-3 text-uppercase rodape-noticia p-2 font-weight-bold m-3" >Mais notícias <i class="fas fa-plus-circle"></i></a>
                            </div>



                        </div>
                    </div>
                </div>


             
                <!--CARROSEL DE VÍDEOS-->
                <div class="row justify-content-center m-0 bg-dark">

                    <h2 class="font-weight-bold text-white text-center col-12"><a href="videos.php" class="text-white">Vídeos <i class="fas fa-video"></i></a></h2>


                        <div class="col-12">
                            <div class="row m-0 slider-slick text-center">
                                <?php foreach ($video->selectAllByData(4) as $key => $value): ?>
                                    <div>
                                        <video class="videoo col-12 col-sm-9 col-md-7 col-lg-5 p-2 mt-2 mb-0" poster="videos/poster/<?=$value->poster?>" controls>
                                            <source class="video-source" src="videos/<?=$value->video?>"/>
                                        </video>
                                        <div class="col-12 col-sm-9 col-md-7 col-lg-5  m-auto">
                                            <h3 class="titulo-video text-left font-weight-bold text-uppercase"><?=$value->tituloVideo?></h3>
                                            <h5 class="descricao-video text-left font-weight-bold"><?=$value->descricaoVideo?></h5>
                                        </div>

                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>





                    <!--PREV-->
                    <div class="col-2 col-sm-1 text-center align-self-center">

                        <a class="prev-video text-white" href="">
                            <i class="fas fa-arrow-alt-circle-left fa-3x"></i>
                        </a>

                    </div>

                    <!--CARROSEL-->
                    <div id="carrosel-video" class="col-8 col-sm-10 p-2">

                        <div class="row carrosel-video">

                            <?php foreach ($video->selectAllByData(4) as $key => $value): ?>
                                <video class="video mx-5 my-1 p-2" poster="videos/poster/<?=$value->poster?>" controls>
                                    <source class="video-source" src="videos/<?=$value->video?>"/>
                                </video>
                            <?php endforeach; ?>

                        </div>


                    </div>

                    <!--NEXT-->
                    <div class="col-2 col-sm-1 text-center align-self-center">
                        <a class="next-video text-white" href="">
                            <i class="fas fa-arrow-alt-circle-right fa-3x"></i>
                        </a>
                    </div>
					
					<div class="row justify-content-center">
                        <a href="videos.php" class="botao-excluir text-white py-2 px-3 my-2 font-weight-bold">Mais Vídeos <i class="fas fa-plus-circle"></i></a>
                    </div>

                </div><!--Fim da row que contém o carrosel-->

                <!--Elenco-->
                <div class="row elenco m-0 border border-bottom-0 pt-0 pt-lg-5">


                    <div class="col-12 col-xl-10 m-auto text-center pt-0 pt-lg-5">
                        <h2 class="d-block d-md-none text-center font-weight-bold align-self-center titulo-elenco"><a href="elenco.php">Elenco <i class="fas fa-users"></i></a></h2>

                        <!--Navegação do Slider-->
                        <nav class="row pt-0 pt-lg-5">
                            <div class="nav nav-tabs navegacao-elenco justify-content-center justify-content-lg-around" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-goleiro-tab" data-toggle="tab" href="#nav-goleiro" role="tab" aria-controls="nav-goleiro" aria-selected="true">Goleiro</a>
                                <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-lateral-tab" data-toggle="tab" href="#nav-lateral" role="tab" aria-controls="nav-lateral" aria-selected="false">Lateral</a>
                                <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-zagueiro-tab" data-toggle="tab" href="#nav-zagueiro" role="tab" aria-controls="nav-zagueiro" aria-selected="false">Zagueiro</a>
                                <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-volante-tab" data-toggle="tab" href="#nav-volante" role="tab" aria-controls="nav-volante" aria-selected="false">Volante</a>
                                <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-meio-campo-tab" data-toggle="tab" href="#nav-meio-campo" role="tab" aria-controls="nav-meio-campo" aria-selected="false">Meio Campo</a>
                                <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-atacante-tab" data-toggle="tab" href="#nav-atacante" role="tab" aria-controls="nav-atacante" aria-selected="false">Atacante</a>
                                <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-comissao-tecnica-tab" data-toggle="tab" href="#nav-comissao-tecnica" role="tab" aria-controls="nav-comissao-tecnica" aria-selected="false">Comissão Técnica</a>
                                <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-diretoria-tab" data-toggle="tab" href="#nav-diretoria" role="tab" aria-controls="nav-diretoria" aria-selected="false">Diretoria</a>
                                <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-2 col-lg-auto" id="nav-apoio-tab" data-toggle="tab" href="#nav-apoio" role="tab" aria-controls="nav-apoio" aria-selected="false">Apoio</a>
                            </div>
                        </nav>

                        <div class="tab-content p-4 mb-4" id="nav-tabContent">

                            <!--Goleiros-->
                            <div class="tab-pane active" id="nav-goleiro" role="tabpanel" aria-labelledby="nav-goleiro-tab">

                                <div class="row d-flex justify-content-center">

                                    <!--Controlador PREV-->
                                    <div class="col-12 col-sm-1 text-sm-center align-self-center">

                                        <a class="prev-goleiro" href="">
                                            <i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <div class="col-12 col-sm-3 align-self-center">

                                        <div id="carrosel-goleiro" class="carousel slide" data-ride="carousel">



                                            <!--Conteúdo principal do carrosel-->
                                            <div class="carousel-inner">

                                                <!--Itens do Carrosel-->
                                                <div class="carousel-item active carrosel-goleiro">

                                                    <?php foreach ($elenco->selectJogadores(1,'goleiro') as $key => $value): ?>
                                                    <!--Imagem-->
                                                    <a class="img-perfil-jogador-link position-relative">

                                                        <figure>
															<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>
															
															<figcaption class='descricao-elencado'>
																<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
															</figcaption>
														
														</figure>


                                                    </a>

                                                    <?php endforeach; ?>



                                                </div>

                                            </div><!--Fim do conteúdo principal do carrosel-->


                                        </div>
                                    </div>

                                    <!--Controlador NEXT-->
                                    <div class="col-12 col-sm-1 text-center align-self-center">

                                        <a class="next-goleiro" href="">
                                            <i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <!--Controles do carrosel-->


                                </div>


                            </div>

                            <!--Lateral-->
                            <div class="tab-pane" id="nav-lateral" role="tabpanel" aria-labelledby="nav-lateral-tab">

                                <div class="row d-flex justify-content-center">

                                    <!--Controlador PREV-->
                                    <div class="col-12 col-sm-1 text-sm-center align-self-center">

                                        <a class="prev-lateral" href="">
                                            <i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <div class="col-12 col-sm-3 align-self-center">

                                        <div id="carrosel-lateral" class="carousel slide" data-ride="carousel">



                                            <!--Conteúdo principal do carrosel-->
                                            <div class="carousel-inner">

                                                <!--Itens do Carrosel-->
                                                <div class="carousel-item active carrosel-lateral">

                                                    <?php foreach ($elenco->selectJogadores(1,'lateral') as $key => $value): ?>
                                                        <!--Imagem-->
                                                        <a class="img-perfil-jogador-link position-relative">

															<figure>
																<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>
																
																<figcaption class='descricao-elencado'>
																	<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																	<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
																</figcaption>
															
															</figure>

                                                        </a>

                                                    <?php endforeach; ?>

                                                </div>

                                            </div><!--Fim do conteúdo principal do carrosel-->


                                        </div>
                                    </div>
                                    <!--Controlador NEXT-->
                                    <!--Controlador NEXT-->
                                    <div class="col-12 col-sm-1 text-center align-self-center">

                                        <a class="next-lateral" href="">
                                            <i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <!--Controles do carrosel-->


                                </div>


                            </div>

                            <!--Zagueiro-->
                            <div class="tab-pane" id="nav-zagueiro" role="tabpanel" aria-labelledby="nav-zagueiro-tab">

                                <div class="row d-flex justify-content-center">

                                    <!--Controlador PREV-->
                                    <div class="col-12 col-sm-1 text-sm-center align-self-center">

                                        <a class="prev-zagueiro" href="">
                                            <i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <div class="col-12 col-sm-3 align-self-center">

                                        <div id="carrosel-zagueiro" class="carousel slide" data-ride="carousel">



                                            <!--Conteúdo principal do carrosel-->
                                            <div class="carousel-inner">

                                                <!--Itens do Carrosel-->
                                                <div class="carousel-item active carrosel-zagueiro">

                                                    <?php foreach ($elenco->selectJogadores(1,'zagueiro') as $key => $value): ?>
                                                        <!--Imagem-->
                                                        <a class="img-perfil-jogador-link position-relative">

															<figure>
																<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>
																
																<figcaption class='descricao-elencado'>
																	<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																	<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
																</figcaption>
															
															</figure>

                                                        </a>

                                                    <?php endforeach; ?>

                                                </div>

                                            </div><!--Fim do conteúdo principal do carrosel-->


                                        </div>
                                    </div>
                                    <!--Controlador NEXT-->
                                    <!--Controlador NEXT-->
                                    <div class="col-12 col-sm-1 text-center align-self-center">

                                        <a class="next-zagueiro" href="">
                                            <i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <!--Controles do carrosel-->


                                </div>

                            </div>

                            <!--Volante-->
                            <div class="tab-pane" id="nav-volante" role="tabpanel" aria-labelledby="nav-volante-tab">

                                <div class="row d-flex justify-content-center">

                                    <!--Controlador PREV-->
                                    <div class="col-12 col-sm-1 text-sm-center align-self-center">

                                        <a class="prev-volante" href="">
                                            <i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <div class="col-12 col-sm-3 align-self-center">

                                        <div id="carrosel-volante" class="carousel slide" data-ride="carousel">



                                            <!--Conteúdo principal do carrosel-->
                                            <div class="carousel-inner">

                                                <!--Itens do Carrosel-->
                                                <div class="carousel-item active carrosel-volante">

                                                    <?php foreach ($elenco->selectJogadores(1,'volante') as $key => $value): ?>
                                                        <!--Imagem-->
                                                        <a class="img-perfil-jogador-link position-relative">

                                                        <figure>
															<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>
															
															<figcaption class='descricao-elencado'>
																<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
															</figcaption>
														
														</figure>

                                                        </a>

                                                    <?php endforeach; ?>

                                                </div>

                                            </div><!--Fim do conteúdo principal do carrosel-->


                                        </div>
                                    </div>
                                    <!--Controlador NEXT-->
                                    <!--Controlador NEXT-->
                                    <div class="col-12 col-sm-1 text-center align-self-center">

                                        <a class="next-volante" href="">
                                            <i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <!--Controles do carrosel-->


                                </div>

                            </div>

                            <!--Meio Campo-->
                            <div class="tab-pane" id="nav-meio-campo" role="tabpanel" aria-labelledby="nav-meio-campo-tab">

                                <div class="row d-flex justify-content-center">

                                    <!--Controlador PREV-->
                                    <div class="col-12 col-sm-1 text-sm-center align-self-center">

                                        <a class="prev-meio-campo" href="">
                                            <i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <div class="col-12 col-sm-3 align-self-center">

                                        <div id="carrosel-meio-campo" class="carousel slide" data-ride="carousel">



                                            <!--Conteúdo principal do carrosel-->
                                            <div class="carousel-inner">

                                                <!--Itens do Carrosel-->
                                                <div class="carousel-item active carrosel-meio-campo">

                                                    <?php foreach ($elenco->selectJogadores(1,'meio-campo') as $key => $value): ?>
                                                        <!--Imagem-->
                                                        <a class="img-perfil-jogador-link position-relative">

														<figure>
															<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>
															
															<figcaption class='descricao-elencado'>
																<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
															</figcaption>
														
														</figure>

                                                        </a>

                                                    <?php endforeach; ?>

                                                </div>

                                            </div><!--Fim do conteúdo principal do carrosel-->


                                        </div>
                                    </div>
                                    <!--Controlador NEXT-->
                                    <!--Controlador NEXT-->
                                    <div class="col-12 col-sm-1 text-center align-self-center">

                                        <a class="next-meio-campo" href="">
                                            <i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <!--Controles do carrosel-->


                                </div>

                            </div>

                            <!--Atacante-->
                            <div class="tab-pane" id="nav-atacante" role="tabpanel" aria-labelledby="nav-atacante-tab">

                                <div class="row d-flex justify-content-center">

                                    <!--Controlador PREV-->
                                    <div class="col-12 col-sm-1 text-sm-center align-self-center">

                                        <a class="prev-atacante" href="">
                                            <i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <div class="col-12 col-sm-3 align-self-center">

                                        <div id="carrosel-atacante" class="carousel slide" data-ride="carousel">



                                            <!--Conteúdo principal do carrosel-->
                                            <div class="carousel-inner">

                                                <!--Itens do Carrosel-->
                                                <div class="carousel-item active carrosel-atacante">

                                                    <?php foreach ($elenco->selectJogadores(1,'atacante') as $key => $value): ?>
                                                        <!--Imagem-->
                                                        <a class="img-perfil-jogador-link position-relative">

													    <figure>
															<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>
															
															<figcaption class='descricao-elencado'>
																<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
															</figcaption>
														
														</figure>

                                                        </a>

                                                    <?php endforeach; ?>

                                                </div>

                                            </div><!--Fim do conteúdo principal do carrosel-->


                                        </div>
                                    </div>
                                    <!--Controlador NEXT-->
                                    <!--Controlador NEXT-->
                                    <div class="col-12 col-sm-1 text-center align-self-center">

                                        <a class="next-atacante" href="">
                                            <i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <!--Controles do carrosel-->


                                </div>

                            </div>

                            <!--Comissão Técnica-->
                            <div class="tab-pane" id="nav-comissao-tecnica" role="tabpanel" aria-labelledby="nav-comissao-tecnica-tab">

                                <div class="row d-flex justify-content-center">

                                    <!--Controlador PREV-->
                                    <div class="col-12 col-sm-1 text-sm-center align-self-center">

                                        <a class="prev-comissao-tecnica" href="">
                                            <i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <div class="col-12 col-sm-3 align-self-center">

                                        <div id="carrosel-comissao-tecnica" class="carousel slide" data-ride="carousel">



                                            <!--Conteúdo principal do carrosel-->
                                            <div class="carousel-inner">

                                                <!--Itens do Carrosel-->
                                                <div class="carousel-item active carrosel-comissao-tecnica">

                                                    <?php foreach ($elenco->selectGeral(2) as $key => $value): ?>
                                                        <!--Imagem-->
                                                        <a class="img-perfil-jogador-link position-relative">

														<figure>
															<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>
															
															<figcaption class='descricao-elencado'>
																<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
															</figcaption>
														
														</figure>

                                                        </a>

                                                    <?php endforeach; ?>

                                                </div>

                                            </div><!--Fim do conteúdo principal do carrosel-->


                                        </div>
                                    </div>
                                    <!--Controlador NEXT-->
                                    <!--Controlador NEXT-->
                                    <div class="col-12 col-sm-1 text-center align-self-center">

                                        <a class="next-comissao-tecnica" href="">
                                            <i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <!--Controles do carrosel-->


                                </div>

                            </div>

                            <!--Diretoria-->
                            <div class="tab-pane" id="nav-diretoria" role="tabpanel" aria-labelledby="nav-diretoria-tab">

                                <div class="row d-flex justify-content-center">

                                    <!--Controlador PREV-->
                                    <div class="col-12 col-sm-1 text-sm-center align-self-center">

                                        <a class="prev-diretoria" href="">
                                            <i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <div class="col-12 col-sm-3 align-self-center">

                                        <div id="carrosel-diretoria" class="carousel slide" data-ride="carousel">



                                            <!--Conteúdo principal do carrosel-->
                                            <div class="carousel-inner">

                                                <!--Itens do Carrosel-->
                                                <div class="carousel-item active carrosel-diretoria">

                                                    <?php foreach ($elenco->selectGeral(3) as $key => $value): ?>
                                                        <!--Imagem-->
                                                        <a class="img-perfil-jogador-link position-relative">

														<figure>
															<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>
															
															<figcaption class='descricao-elencado'>
																<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
															</figcaption>
														
														</figure>

                                                        </a>

                                                    <?php endforeach; ?>

                                                </div>

                                            </div><!--Fim do conteúdo principal do carrosel-->


                                        </div>
                                    </div>
                                    <!--Controlador NEXT-->
                                    <!--Controlador NEXT-->
                                    <div class="col-12 col-sm-1 text-center align-self-center">

                                        <a class="next-diretoria" href="">
                                            <i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <!--Controles do carrosel-->


                                </div>

                            </div>

                            <!--Apoio-->
                            <div class="tab-pane" id="nav-apoio" role="tabpanel" aria-labelledby="nav-apoio-tab">

                                <div class="row d-flex justify-content-center">

                                    <!--Controlador PREV-->
                                    <div class="col-12 col-sm-1 text-sm-center align-self-center">

                                        <a class="prev-apoio" href="">
                                            <i class="fas fa-angle-left fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <div class="col-12 col-sm-3 align-self-center">

                                        <div id="carrosel-apoio" class="carousel slide" data-ride="carousel">



                                            <!--Conteúdo principal do carrosel-->
                                            <div class="carousel-inner">

                                                <!--Itens do Carrosel-->
                                                <div class="carousel-item active carrosel-apoio">

                                                    <?php foreach ($elenco->selectGeral(4) as $key => $value): ?>
                                                        <!--Imagem-->
                                                        <a class="img-perfil-jogador-link position-relative">

														<figure>
															<img class="img-perfil-jogador m-0" src="img/elenco/<?php echo $value->fotoDePerfil;?>"/>
															
															<figcaption class='descricao-elencado'>
																<h5 class="font-weight-bold m-0 p-0"><?php echo $value->apelido;?></h5>
																<p class="font-weight-bold m-0 p-0"><?php echo $value->funcao;?></p>
															</figcaption>
														
														</figure>

                                                        </a>

                                                    <?php endforeach; ?>

                                                </div>

                                            </div><!--Fim do conteúdo principal do carrosel-->


                                        </div>
                                    </div>
                                    <!--Controlador NEXT-->
                                    <!--Controlador NEXT-->
                                    <div class="col-12 col-sm-1 text-center align-self-center">

                                        <a class="next-apoio" href="">
                                            <i class="fas fa-angle-right fa-3x controlador-carrosel"></i>
                                        </a>

                                    </div>

                                    <!--Controles do carrosel-->


                                </div>

                            </div>

                        </div>

                    </div>

                </div><!--Fim do elenco-->

                <!--CARROSEL SECUNDÁRIO-->
                <?php $stmt = $imagem->selectAllByLocal(6);
                $pkCount = (is_array($stmt)? count($stmt):0);
                if ($pkCount == 0){}else{ ?>
                <div class="row justify-content-center m-0">
                    <div class="col-md-12 p-0">

                        <!--Início do carrosel-->
                        <div id="carrosel-secundario" class="carousel slide carrosel-primario" data-ride="carousel">

                            <!--Lista com indicadores-->
                            <ol class="carousel-indicators">

                                <?php $cont = 1; foreach ($imagem->selectAllByLocal(6) as $key => $value): ?>
                                    <li data-target="#carrosel-secundario" data-slide-to="<?=$cont?>" class="active"></li>
                                    <?php $cont++; endforeach; ?>
                            </ol><!--Fim da lista com indicadores-->

                            <!--Conteúdo principal do carrosel-->
                            <div class="carousel-inner">

                                <?php $cont = 1; foreach ($imagem->selectAllByLocal(6) as $key => $value): if ($cont == 1){$active = 'active';}else{$active='';} ?>
                                    <!--Itens do Carrosel-->
                                    <div class="carousel-item <?=$active?>">

                                        <!--Imagem-->
                                        <img class="img-carrosel-secundario img-fluid d-block" src="img/<?=$value->imagem?>"/>

                                        <!--Descrição da imagem-->
                                        <div class="carousel-caption d-none d-md-block descricao-carrousel-principal">
                                            <h2 class="titulo-descricao-carrosel text-left font-weight-bold"><?=$value->titulo?></h2>
                                            <p class="descricao-carrousel text-left font-weight-bold"><?=$value->legenda?></p>
                                        </div>

                                    </div>
                                    <?php $cont++; endforeach; ?>


                            </div><!--Fim do conteúdo principal do carrosel-->

                            <!--Controles do carrosel-->
                            <!--NEXT-->
                            <a class="carousel-control-next" href="#carrosel-secundario" role="button" data-slide="next">

                                <i class="fas fa-arrow-alt-circle-right icone-carrosel-principal fa-3x"></i>
                                <span class="sr-only" aria-hidden="true">Proximo</span>

                            </a>
                            <!--PREV-->
                            <a class="carousel-control-prev" href="#carrosel-secundario" role="button" data-slide="prev">

                                <i class="fas fa-arrow-alt-circle-left icone-carrosel-principal fa-3x"></i>
                                <span class="sr-only" aria-hidden="true">Anterior</span>

                            </a>

                        </div><!--Fim do Carrosel-->

                    </div>
                </div><!--Fim da row que contém o carrosel-->
                <?php } ?>

            </div><!--Fim do container de todoo o conteúdo-->

        </main><!--Fim do conteúdo principal-->
	
		
        <footer>

            <?php

                include 'inc/incRodapePrincipal.php';

            ?>

        </footer>

    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery-migrate-1.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="js/moduloPublico/index.js"></script>
</body>

</html>