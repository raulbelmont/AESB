<?php
require_once '../model/NoticiasModel.php';
$noticia = new NoticiasModel();

if (!session_id()) session_start();

$itensPorPagina = 9;
$numTotalItens = count($noticia->selectAll());
$numPaginas = ceil($numTotalItens/$itensPorPagina);

?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
	<link rel="stylesheet" href="css/moduloPublico/noticias.css"/>
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <title>AESB - Notícias</title>

</head>

<body>

    <header>
        <?php
            include 'inc/incMenuPrincipal.php';
        ?>
    </header>

 <main class="container-fluid py-4">

    <div class="row mb-5">
        <!--Recentes-->
        <div class="col-12 col-md-6 noticias">

            <div class="row justify-content-center">
                <h3 class="col-12 text-center p-3 mb-0 font-weight-bold text-black">Últimas Notícias</h3>

                <?php $cont = 1; foreach ($noticia->selectNoticiasRecentes(4) as $key => $noticiaAtual):
                    if ($noticiaAtual->fundoNoticia == null){
                        $fundo = 'fundo-neutro.png';
                    }else{
                        $fundo = $noticiaAtual->fundoNoticia;
                    }
                    if ($cont<=2){
                        ?>

                        <a href="noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" class="col-11 col-md-5 card-noticia p-0 m-2 position-relative" style="background-image: url('img/noticias/<?=$fundo?>');">
                            <p class="horario-noticia m-2 mb-5"><span class="p-1"><i class="far fa-clock icone"></i>

                                    <?php
                                    $data = new DateTime($noticiaAtual->dataPublicacao);
                                    echo $data->format('d/m/Y H:i');
                                    ?>

                                    </span></p>

                            <div class="fixed-bottom position-absolute texto-noticia">

                                <p class="titulo-noticia font-weight-bold text-truncate text-white px-2 ml-2 mr-2">
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

                    if ($cont>2){
                        ?>
                        <a href="noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" class="col-11 col-md-5 d-none d-md-block card-noticia p-0 m-2 position-relative" style="background-image: url('img/noticias/<?=$fundo?>');">
                            <p class="horario-noticia m-2 mb-5"><span class="p-1"><i class="far fa-clock icone"></i>
                                    <?php
                                    $data = new DateTime($noticiaAtual->dataPublicacao);
                                    echo $data->format('d/m/Y H:i');
                                    ?>
                                            </span></p>

                            <div class="fixed-bottom position-absolute texto-noticia">

                                <p class="titulo-noticia font-weight-bold text-truncate text-white px-2 ml-2 mr-2">
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





            </div>
        </div>
        <!--Mais Acessadas-->
        <div class="col-12 col-md-6">
            <div class="row justify-content-center">
                <h3 class="col-12 text-center p-3 mb-0 font-weight-bold text-black mais-acessadas my-5 my-md-0">Mais acessadas</h3>

                <?php $cont = 1; foreach ($noticia->selectAllByAcesso(4) as $key => $noticiaAtual):
                    if ($noticiaAtual->fundoNoticia == null){
                        $fundo = 'fundo-neutro.png';
                    }else{
                        $fundo = $noticiaAtual->fundoNoticia;
                    }
                    if ($cont<=2){
                        ?>

                        <a href="noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" class="col-11 col-md-5 card-noticia p-0 m-2 position-relative" style="background-image: url('img/noticias/<?=$fundo?>');">
                            <p class="horario-noticia m-2 mb-5"><span class="p-1"><i class="far fa-clock icone"></i>

                                    <?php
                                    $data = new DateTime($noticiaAtual->dataPublicacao);
                                    echo $data->format('d/m/Y H:i');
                                    ?>

                                    </span></p>

                            <div class="fixed-bottom position-absolute texto-noticia">

                                <p class="titulo-noticia font-weight-bold text-truncate text-white px-2 ml-2 mr-2">
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

                    if ($cont>2){
                        ?>
                        <a href="noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" class="col-11 col-md-5 d-none d-md-block card-noticia p-0 m-2 position-relative" style="background-image: url('img/noticias/<?=$fundo?>');">
                            <p class="horario-noticia m-2 mb-5"><span class="p-1"><i class="far fa-clock icone"></i>
                                    <?php
                                    $data = new DateTime($noticiaAtual->dataPublicacao);
                                    echo $data->format('d/m/Y H:i');
                                    ?>
                                            </span></p>

                            <div class="fixed-bottom position-absolute texto-noticia">

                                <p class="titulo-noticia font-weight-bold text-truncate text-white px-2 ml-2 mr-2">
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







            </div>

        </div>
    </div>

    <div class="row">
        <h3 class="text-center col-12 font-weight-bold text-white bg-dark py-3"><i class="fas fa-plus"></i> Mais notícias</h3>


        <div class="col-12 mb-4">

            <div class="row justify-content-center">

                <div class="col-12 my-5">
                    <div class="row justify-content-center">
                        <div class="col-10 col-sm-7 col-lg-4">
                            <label for="exibirPor" class="font-weight-bold">Exibir por</label>

                            <select class="form-control d-inline" id="exibirPor">
                                <option value="dataPublicacao">Data de publicação</option>
                                <option value="numAcessos">Relevância</option>
                            </select>

                        </div>

                        <div class="col-10 col-sm-4 col-lg-2 outra-classe">
                            <label for="classificarPor" class="font-weight-bold">Classificar por</label>
                            <select class="form-control d-inline" id="classificarPor">
                                <option value="DESC">Mais recente</option>
                                <option value="ASC">Mais antiga</option>
                            </select>
                        </div>

                    </div>

<!--                    <div class="row justify-content-center mt-5">-->
<!---->
<!--                        <div class="col-10 col-sm-8 col-md-6 col-lg-4 ml-3">-->
<!--                            <label class="font-weight-bold" for="busca">Buscar notícia</label>-->
<!--                            <div class="input-group mb-2">-->
<!--                                <div class="input-group-prepend">-->
<!--                                    <div class="input-group-text"><i class="fas fa-search"></i></div>-->
<!--                                </div>-->
<!--                                <input type="text" class="form-control" id="busca" placeholder="Pesquisar">-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
                </div>

                <div id="mais-noticias" class="row justify-content-center m-0">
                    <?php $cont = 1; foreach ($noticia->selectNoticiasRecentes(9) as $key => $noticiaAtual):
                        if ($noticiaAtual->fundoNoticia == null){
                            $fundo = 'fundo-neutro.png';
                        }else{
                            $fundo = $noticiaAtual->fundoNoticia;
                        }
                        if ($cont<=5){
                            ?>

                            <a href="noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" class="col-11 col-md-3 card-noticia p-0 m-2 position-relative" style="background-image: url('img/noticias/<?=$fundo?>');">
                                <p class="horario-noticia m-2 mb-5"><span class="p-1"><i class="far fa-clock icone"></i>

                                        <?php
                                        $data = new DateTime($noticiaAtual->dataPublicacao);
                                        echo $data->format('d/m/Y H:i');
                                        ?>

                                    </span></p>

                                <div class="fixed-bottom position-absolute texto-noticia">

                                    <p class="titulo-noticia font-weight-bold text-truncate text-white px-2 ml-2 mr-2">
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

                        if ($cont>5){
                            ?>
                            <a href="noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" class="col-11 col-md-3 card-noticia p-0 m-2 position-relative" style="background-image: url('img/noticias/<?=$fundo?>');">
                                <p class="horario-noticia m-2 mb-5"><span class="p-1"><i class="far fa-clock icone"></i>
                                        <?php
                                        $data = new DateTime($noticiaAtual->dataPublicacao);
                                        echo $data->format('d/m/Y H:i');
                                        ?>
                                            </span></p>

                                <div class="fixed-bottom position-absolute texto-noticia">

                                    <p class="titulo-noticia font-weight-bold text-truncate text-white px-2 ml-2 mr-2">
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
                </div>







            </div>
        </div>


        <a id="btn-mais-noticias" class="col-6 col-sm-4 col-md-3 m-auto text-center py-2 font-weight-bold text-white" > Mostrar mais <i class="fas fa-plus"></i></a>
        <p id="pagina-atual" class="invisible">2</p>
        <p id="total-de-paginas" class="invisible"><?=$numPaginas?></p>

    </div>

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
	<script src="js/ajax/xhttp.js"></script>
    <script src="js/moduloPublico/noticias.js"></script>
</body>

</html>

</body>