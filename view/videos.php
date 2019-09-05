<?php
/*Buscando notícia*/
require_once '../model/VideosModel.php';
$video = new VideosModel();

?>

<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/moduloPublico/videos.css"/>
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <title>AESB - Vídeos</title>

</head>

<body>
<!---->
<!--<div id="fb-root"></div>-->
<!--<script>(function(d, s, id) {-->
<!--        var js, fjs = d.getElementsByTagName(s)[0];-->
<!--        if (d.getElementById(id)) return;-->
<!--        js = d.createElement(s); js.id = id;-->
<!--        js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.2';-->
<!--        fjs.parentNode.insertBefore(js, fjs);-->
<!--    }(document, 'script', 'facebook-jssdk'));</script>-->
<header>
    <?php
    include 'inc/incMenuPrincipal.php';
    ?>

</header>

<main>
    <div class="container-fluid">
        <div class="row">
            <h1 class="font-weight-bold my-5 col-12 text-center">Vídeos <i class="fas fa-video"></i></h1>
        </div>

        <!--CARROSEL DE VÍDEOS DA AESB-->
        <div class="row bg-dark">

            <div class="col-12">
                <div class="row">
                    <h2 class="font-weight-bold text-white text-center col-12">Mais Recentes</h2>


                    <div class="col-12">
                        <div class="row m-0 slider-slick text-center">
                            <?php foreach ($video->selectAllByData(4) as $key => $value):
                                if ($value->poster == null){
                                    $poster = 'fundo-neutro.png';
                                }else{
                                    $poster = $value->poster;
                                }
                            ?>
                                <div>
                                    <video id="<?=$value->codigoVideo?>" class="videoo col-12 col-sm-9 col-md-7 col-lg-5 p-2 mt-2 mb-0" poster="videos/poster/<?=$poster?>" controls>
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
                            <i class="fas fa-angle-left fa-3x"></i>
                        </a>

                    </div>

                    <!--CARROSEL-->
                    <div id="carrosel-video" class="col-8 col-sm-10 p-2">

                        <div class="row carrosel-video">

                            <?php foreach ($video->selectAllByData(4) as $key => $value):
                                if ($value->poster == null){
                                    $poster = 'fundo-neutro.png';
                                }else{
                                    $poster = $value->poster;
                                }
                            ?>
                                <video id="<?=$value->codigoVideo?>" class="video mx-5 my-1 p-2" poster="videos/poster/<?=$poster?>">
                                    <source class="video-source" src="videos/<?=$value->video?>"/>
                                </video>
                            <?php endforeach; ?>

                        </div>


                    </div>

                    <!--NEXT-->
                    <div class="col-2 col-sm-1 text-center align-self-center">
                        <a class="next-video text-white" href="">
                            <i class="fas fa-angle-right fa-3x"></i>
                        </a>
                    </div>
                </div>
            </div>


        </div><!--Fim da row que contém o carrosel-->

        <!--cONVITE AO TORCEDOR PARA ENVIAR VÍDEO-->
        <div class="row bg-light justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 my-3 text-center py-4">
                <h3 class="font-weight-bold text-left" style="color: #006AA6;">Mande o seu vídeo!</h3>
                <h5 class="font-weight-bold text-left mb-5">Grave um vídeo com uma mensagem ou uma experiência relacionada ao <span style="color: #DB1F1A;">Bugre</span> e compartilhe conosco!</h5>

                <a class="btn-enviar-video font-weight-bold my-2 px-5 py-2">Enviar vídeo <i class="fas fa-video"></i></a>
            </div>
        </div>

        <!--FORMULÁRIO PARA ENVIO DE VÍDEO-->
        <div id="env-video" class="row bg-light justify-content-center d-none">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4 my-5 m-auto text-center">

                <div class="closest">
                    <a class="font-weight-bold text-danger cancelar-envio"> <i class="fas fa-times"></i> Cancelar envio</a>

                    <form id="enviar-video" enctype="multipart/form-data" method="post" class="m-auto">
                        <input type="hidden" name="acao" value="11">
                        <div class="form-row">

                            <div class="col-12">
                                <div class="form-group text-left">
                                    <label for="descricaoVideo" class="font-weight-bold">Digite seu nome:</label>
                                    <input type="text" class="form-control" name="autor" id="autor" placeholder="Nome" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group text-left">
                                    <label for="titulo" class="font-weight-bold">Escolha um título para o seu vídeo:</label>
                                    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group text-left">
                                    <p class="text-left"><small class="text-muted">Tamanho limite de 50MB</small></p>

                                    <input type="file" class="form-control-file logo-video-torcedor" name="video" id="logoApoiadores" accept="video/*" required>
                                    <button type="button" class="input-label input-label-torcedor"><span class="label-span">Selecionar video</span> <i class="fas fa-upload"></i></button>
                                    <span class="custom-text-torcedor">Nenhum arquivo selecionado </span>
                                    <a class="reset-input reset-input-torcedor d-none"><i class="fas fa fa-times-circle"></i></a>
                                </div>

                                <div id="aviso-tamanho" class="text-danger font-weight-bold d-none">O arquivo selecionado excede o tamanho permitido! Por favor selecione um arquivo válido.</div>
                            </div>

                            <div class="col-12">
                                <div class="form-group text-left">
                                    <input type="checkbox" name="termoVideo" value="1" class="form-control custom-control-input" id="termoVideo" required>
                                    <label class="custom-control-label ml-4 mt-2" for="termoVideo"><small>Concordo em compartilhar o vídeo com o clube e entendo que o vídeo será analisado pelo clube antes da sua publicação.</small></label>
                                </div>
                            </div>

                            <div class="col-12 text-center text-md-right mb-2">
                                <button type="submit" class="btn botao-enviar px-5 mb-3 font-weight-bold">Enviar <i class="far fa-envelope"></i></button>
                            </div>


                        </div>
                    </form>

                </div>

                <div class="status d-none font-weight-bold mt-5 mb-2">
                    <p class="text-info">Enviando vídeo</p>
                    <p class="spin"></p>
                </div>

                <div class="status-enviado d-none font-weight-bold mt-5 mb-2">
                    <p class="text-success">Vídeo enviado com sucesso!</p>
                    <p class="text-success">Obrigado por compartilhar o vídeo conosco!</p>
                </div>

            </div>
        </div>

        <!--CARROSEL DE VÍDEOS DOS TORCEDORES-->
        <div class="row bg-dark">

            <div class="col-12">
                <div class="row">
                    <?php
                    $stmt = $video->selectAllByDataP(4);
                    $pkCount = (is_array($stmt)? count($stmt):0);
                    if (!$pkCount == 0){
                    ?>

                    <h2 class="font-weight-bold text-white text-center col-12">Enviados por torcedores</h2>


                    <div class="col-12">
                        <div class="row m-0 slider-slick-torcedor text-center">
                            <?php foreach ($video->selectAllByDataP(4) as $key => $value): ?>
                                <div>
                                    <video id="<?=$value->codigoVideo?>" class="videoo col-12 col-sm-9 col-md-7 col-lg-5 p-2 mt-2 mb-0" controls>
                                        <source class="video-source" src="videos/torcedores/<?=$value->video?>"/>
                                    </video>
                                    <div class="col-12 col-sm-9 col-md-7 col-lg-5  m-auto">
                                        <h3 class="titulo-video text-left font-weight-bold text-uppercase"><?=$value->tituloVideo?></h3>
                                        <h5 class="descricao-video text-left font-weight-bold">Enviado por <?=$value->autor?> dia <?php $data = new DateTime($value->dataPublicacao); echo $data->format('d/m/Y');?></h5>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>





                    <!--PREV-->
                    <div class="col-2 col-sm-1 text-center align-self-center">

                        <a class="prev-video-torcedor text-white" href="">
                            <i class="fas fa-angle-left fa-3x"></i>
                        </a>

                    </div>

                    <!--CARROSEL-->
                    <div id="carrosel-video" class="col-8 col-sm-10 p-2">

                        <div class="row carrosel-video-torcedor">


                            <?php
                            $stmt = $video->selectAllByDataP(4);
                            $pkCount = (is_array($stmt)? count($stmt):0);
                            if ($pkCount > 1){
                            foreach ($video->selectAllByDataP(4) as $key => $value): ?>
                                <video id="<?=$value->codigoVideo?>" class="video mx-5 my-1 p-2">
                                    <source class="video-source" src="videos/torcedores/<?=$value->video?>"/>
                                </video>
                            <?php endforeach; }?>

                        </div>


                    </div>

                    <!--NEXT-->
                    <div class="col-2 col-sm-1 text-center align-self-center">
                        <a class="next-video-torcedor text-white" href="">
                            <i class="fas fa-angle-right fa-3x"></i>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>


        </div><!--Fim da row que contém o carrosel-->

        <!--Mais Vídeos-->
        <div class="row bg-light">
            <h2 class="text-center col-12 font-weight-bold py-3 border-bottom"><i class="fas fa-plus"></i> Mais vídeos</h2>

            <!--AESB-->
            <div class="col-12 col-md-6 mais-videos-aesb">
                <div class="row justify-content-center text-center">

                    <h4 class="text-center col-12 font-weight-bold py-2"><i class="fas fa-plus"></i> Aesb</h4>
                    <div class="container-video-aesb row justify-content-center m-0">
                       <?php
                        foreach ($video->selectAllByData(2) as $key => $value):
                            if ($value->poster == null){
                                $poster = 'fundo-neutro.png';
                            }else{
                                $poster = $value->poster;
                            }
                        ?>
                            <a class="col-12 col-sm-5 m-2" data-toggle="modal" data-target="#visualizarVideo<?=$value->codigoVideo?>" >
                                <div class="row">
                                    <video id="<?=$value->codigoVideo?>" class="video w-100 col-12" poster="videos/poster/<?=$poster?>">
                                        <source class="video-source" src="videos/<?=$value->video?>"/>
                                    </video>
                                    <p class="text-truncate font-weight-bold col-12"><?=$value->tituloVideo?></p>
                                    <p class="small text-muted col-12"><?=$value->descricaoVideo?></p>
                                </div>
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="visualizarVideo<?=$value->codigoVideo?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center"><?=$value->tituloVideo?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <video class="w-100 video" poster="../videos/poster/<?=$poster?>" controls>
                                                <source src="videos/<?=$value->video?>">
                                                <embed src="videos/<?=$value->video?>" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always">
                                                Formato não suportado pelo navegador.
                                            </video>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>


                    <?php
                        $totalA= $video->selectAllAesb();
                    $totalAesb = (is_array($totalA)? count($totalA):0);
                    $itensPorPagina = 2;
                    $numPaginas = ceil($totalAesb/$itensPorPagina);

                    if ($totalAesb > 2){ ?>
                        <!--Botão-->
                        <div class="col-10 carregando my-3"></div>
                        <a id="mais-videos-aesb" class="btn-mais-videos col-8 col-sm-6 col-md-5 col-lg-3 m-2 py-2 px-3 font-weight-bold"><i class="fas fa-plus"></i> Mais</a>
                        <p id="pagina-atual-aesb" class="invisible">2</p>
                        <p id="total-de-paginas-aesb" class="invisible"><?=$numPaginas?></p>
                    <?php } ?>


                </div>
            </div>

            <hr class="w-100 clearfix my-3 d-block d-sm-block d-md-none bg-dark">

            <!--TORCEDORES-->
            <div class="col-12 col-md-6">
                <div class="row justify-content-center text-center">

                    <h4 class="text-center col-12 font-weight-bold py-2"><i class="fas fa-plus"></i> Torcedores</h4>
                    <div class="container-video-torcedor row justify-content-center m-0">
                        <?php
                        $stmt = $video->selectAllByDataP(2);
                        $pkCount = (is_array($stmt)? count($stmt):0);
                        if ($pkCount == 0){ $display = 'd-none'; ?>

                        <h5 class='my-5 font-weight-bold text-danger col-12'>Ainda não há videos de torcedores <i class='far fa-sad-tear'></i></h5>

                        <?php
                        }else{ $display = 'd-block';
                            foreach ($video->selectAllByDataP(2) as $key => $value): ?>
                            <a class="col-12 col-sm-5 m-2" data-toggle="modal" data-target="#visualizarVideoP<?=$value->codigoVideo?>">
                                <div class="row">
                                    <video id="<?=$value->codigoVideo?>" class="video w-100 col-12">
                                        <source class="video-source" src="videos/torcedores/<?=$value->video?>"/>
                                    </video>
                                    <p class="text-truncate font-weight-bold col-12"><?=$value->tituloVideo?></p>
                                    <p class="small text-muted col-12">Enviado por <?=$value->autor?> dia <?php $data = new DateTime($value->dataPublicacao); echo $data->format('d/m/Y');?></p>
                                </div>
                            </a>

                                <!-- Modal -->
                                <div class="modal fade" id="visualizarVideoP<?=$value->codigoVideo?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center"><?=$value->tituloVideo?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <video class="w-100 video" controls>
                                                    <source src="videos/torcedores/<?=$value->video?>">
                                                    <embed src="videos/torcedores/<?=$value->video?>" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always">
                                                    Formato não suportado pelo navegador.
                                                </video>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach;} ?>
                    </div>

                    <!--Botão-->
                    <?php
                    $totalA= $video->selectTorcedoresPublicados();
                    $totalTorcedores = (is_array($totalA)? count($totalA):0);
                    $itensPorPagina = 2;
                    $numPaginasTorcedores = ceil($totalTorcedores/$itensPorPagina);

                    if ($totalTorcedores> 2){ ?>
                        <!--Botão-->
                        <div class="col-10 carregando-torcedores my-3"></div>
                        <a id="mais-videos-torcedor" class="btn-mais-videos <?=$display?> col-8 col-sm-6 col-md-5 col-lg-3 m-2 py-2 px-3 font-weight-bold"><i class="fas fa-plus"></i> Mais</a>
                        <p id="pagina-atual-torcedor" class="invisible">2</p>
                        <p id="total-de-paginas-torcedor" class="invisible"><?=$numPaginasTorcedores?></p>
                    <?php } ?>

                </div>
            </div>


        </div>


    </div>
</main>



<footer>
    <?php
    include 'inc/incRodapePrincipal.php';
    ?>
</footer>

</body>

<script src="js/jquery-3.3.1.js"></script>
<script src="js/jquery-migrate-1.2.1.js"></script>
<script src="js/popper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="js/ajax/xhttp.js"></script>
<script src="js/moduloPublico/videos.js"></script>

<script>

</script>

</html>
