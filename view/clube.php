<?php
require_once '../model/HistoriaModel.php';
$historiaModel = new HistoriaModel();

$oClube = 'active';
$historia ="";
$fundacao = "";
$presidentes = "";
$hinoSimbolos = "";
$galeriaDeTrofeus ="";
$idolos = "";
$estatutoSocial = "";

if ((isset($_GET['historia'])) && ($_GET['historia'] == true)){

    $historia = 'show active';
    $oClube ='';
}
if ((isset($_GET['fundacao'])) && ($_GET['fundacao'] == true)){
    $fundacao = 'show active';
    $oClube ='';
}
if ((isset($_GET['presidentes'])) && ($_GET['presidentes'] == true)){
    $presidentes = 'show active';
    $oClube ='';
}
if ((isset($_GET['hinoSimbolos'])) && ($_GET['hinoSimbolos'] == true)){
    $hinoSimbolos = 'show active';
    $oClube ='';
}
if ((isset($_GET['galeriaDeTrofeus'])) && ($_GET['galeriaDeTrofeus'] == true)){
    $galeriaDeTrofeus = 'show active';
    $oClube ='';
}
if ((isset($_GET['idolos'])) && ($_GET['idolos'] == true)){
    $idolos = 'show active';
    $oClube ='';
}
if ((isset($_GET['estatutoSocial'])) && ($_GET['estatutoSocial'] == true)){
    $estatutoSocial = 'show active';
    $oClube ='';
}

?>
<!doctype html>
<html>

<head>

    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/moduloPublico/clube.css"/>
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <title>AESB - O Clube</title>


</head>
<body>

<header>

    <?php
    include "inc/incMenuPrincipal.php";
    ?>

</header>
<main>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="col-12 col-xl-10 m-auto text-center">
                    <h2 class="text-center font-weight-bold mt-5 align-self-center titulo-elenco">O Clube</h2>

                    <!--Navegação do Slider-->
                    <nav class="row border-bottom">
                        <div class="nav nav-tabs font-weight-bold navegacao-elenco justify-content-center justify-content-lg-around mt-2" id="nav-tab" role="tablist">
                            <a class="<?=$oClube?> nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-auto <?=$historia?>" id="nav-historia-tab" data-toggle="tab" href="#nav-historia" role="tab" aria-controls="nav-historia" aria-selected="true">Historia</a>
                            <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-auto <?=$fundacao?>" id="nav-fundacao-tab" data-toggle="tab" href="#nav-fundacao" role="tab" aria-controls="nav-fundacao" aria-selected="false">Fundação</a>
                            <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-auto <?=$presidentes?>" id="nav-presidentes-tab" data-toggle="tab" href="#nav-presidentes" role="tab" aria-controls="nav-presidentes" aria-selected="false">Presidentes</a>
                            <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-auto <?=$hinoSimbolos?>" id="nav-hino-e-simbolos-tab" data-toggle="tab" href="#nav-hino-e-simbolos" role="tab" aria-controls="nav-hino-e-simbolos" aria-selected="false">Hino e Símbolos</a>
                            <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-auto <?=$galeriaDeTrofeus?>" id="nav-galeria-de-trofeus-tab" data-toggle="tab" href="#nav-galeria-de-trofeus" role="tab" aria-controls="nav-galeria-de-trofeus" aria-selected="false">Galeria de Troféus</a>
                            <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-auto <?=$idolos?>" id="nav-idolos-tab" data-toggle="tab" href="#nav-idolos" role="tab" aria-controls="nav-idolos" aria-selected="false">Ídolos</a>
                            <a class="nav-item nav-link ml-1 ml-sm-0 col-12 col-sm-4 col-md-auto <?=$estatutoSocial?>" id="nav-estatuto-social-tab" data-toggle="tab" href="#nav-estatuto-social" role="tab" aria-controls="nav-estatuto-social" aria-selected="false">Estatuto Social</a>
                        </div>
                    </nav>

                    <div class="tab-content p-4 mb-4 m-auto" id="nav-tabContent">


                        <div class="<?=$oClube?> tab-pane <?=$historia?>" id="nav-historia" role="tabpanel" aria-labelledby="nav-historia-tab">
                            <!--HISTÓRIA-->
                            <section class="historia">

                                <!--Dados históricos-->
                                    <?php $historiaSection = $historiaModel->selecionarHistoria(1); ?>
                                    <h4 class="text-center font-weight-bold mt-1 align-self-center titulo-elenco"><u><?=$historiaSection->titulo?></u></h4>

                                    <hr class="w-100 clearfix">



                            </section>

                            <div class="row justify-content-center">
                                <div class="col-12 col-sm-11 col-md-10 text-justify">
                                    <?=$historiaSection->corpo?>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane <?=$fundacao?>" id="nav-fundacao" role="tabpanel" aria-labelledby="nav-fundacao-tab">

                            <!--Fundação-->
                            <section class="">

                                <!--Dados históricos-->
                                <?php $fundacaoSection = $historiaModel->selecionarHistoria(2); ?>
                                <h4 class="text-center font-weight-bold mt-1 align-self-center titulo-elenco"><u><?=$fundacaoSection->titulo?></u></h4>

                                <hr class="w-100 clearfix">



                            </section>

                            <div class="row justify-content-center">
                                <div class="col-12 col-sm-11 col-md-10 text-justify">
                                    <?=$fundacaoSection->corpo?>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane <?=$presidentes?>" id="nav-presidentes" role="tabpanel" aria-labelledby="nav-presidentes-tab">

                            <!--Presidentes-->
                            <section class="">

                                <!--Dados históricos-->
                                <?php $presidentesSection = $historiaModel->selecionarHistoria(3); ?>
                                <h4 class="text-center font-weight-bold mt-1 align-self-center titulo-elenco"><u><?=$presidentesSection->titulo?></u></h4>

                                <hr class="w-100 clearfix">



                            </section>

                            <div class="row justify-content-center">
                                <div class="col-12 col-sm-11 col-md-10 text-justify">
                                    <?=$presidentesSection->corpo?>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane <?=$hinoSimbolos?>" id="nav-hino-e-simbolos" role="tabpanel" aria-labelledby="nav-hino-e-simbolos-tab">

                            <!--Hino e símbolos-->
                            <section class="">

                                <!--Dados históricos-->
                                <?php $hinoSimbolosSection = $historiaModel->selecionarHistoria(4); ?>
                                <h4 class="text-center font-weight-bold mt-1 align-self-center titulo-elenco"><u><?=$hinoSimbolosSection->titulo?></u></h4>

                                <hr class="w-100 clearfix">



                            </section>

                            <div class="row justify-content-center">
                                <div class="col-12 col-sm-11 col-md-10 text-justify">
                                    <?=$hinoSimbolosSection->corpo?>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane <?=$galeriaDeTrofeus?>" id="nav-galeria-de-trofeus" role="tabpanel" aria-labelledby="nav-galeria-de-trofeus-tab">

                            <!--Galeria de Troféus-->
                            <section class="">

                                <!--Dados históricos-->
                                <?php $galeriaDeTrofeusSection = $historiaModel->selecionarHistoria(5); ?>
                                <h4 class="text-center font-weight-bold mt-1 align-self-center titulo-elenco"><u><?=$galeriaDeTrofeusSection->titulo?></u></h4>

                                <hr class="w-100 clearfix">



                            </section>

                            <div class="row justify-content-center">
                                <div class="col-12 col-sm-11 col-md-10 text-justify">
                                    <?=$galeriaDeTrofeusSection->corpo?>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane <?=$idolos?>" id="nav-idolos" role="tabpanel" aria-labelledby="nav-idolos-tab">

                            <!--Ídolos-->
                            <section class="">

                                <!--Dados históricos-->
                                <?php $idolosSection = $historiaModel->selecionarHistoria(6); ?>
                                <h4 class="text-center font-weight-bold mt-1 align-self-center titulo-elenco"><u><?=$idolosSection->titulo?></u></h4>

                                <hr class="w-100 clearfix">



                            </section>

                            <div class="row justify-content-center">
                                <div class="col-12 col-sm-11 col-md-10 text-justify">
                                    <?=$idolosSection->corpo?>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane <?=$estatutoSocial?>" id="nav-estatuto-social" role="tabpanel" aria-labelledby="nav-estatuto-social">

                            <!--Estatuto Social-->
                            <section class="">

                                <!--Dados históricos-->
                                <?php $estatutoSocialSection = $historiaModel->selecionarHistoria(7); ?>
                                <h4 class="text-center font-weight-bold mt-1 align-self-center titulo-elenco"><u><?=$estatutoSocialSection->titulo?></u></h4>

                                <hr class="w-100 clearfix">



                            </section>

                            <div class="row justify-content-center">
                                <div class="col-12 col-sm-11 col-md-10 text-justify">
                                    <?=$estatutoSocialSection->corpo?>
                                </div>
                            </div>

                        </div>




                    </div>



                </div>

            </div>

        </div>

    </div>

    </div>


</main>

<footer>

    <?php
    include "inc/incRodapePrincipal.php";
    ?>

</footer>


<script src="js/jquery-3.3.1.js"></script>
<script src="js/jquery-migrate-1.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="js/moduloPublico/clube.js"></script>
</body>

</html>