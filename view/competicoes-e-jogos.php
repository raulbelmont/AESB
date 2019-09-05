<?php
	require_once '../model/CompeticoesModel.php';
    require_once '../model/JogosModel.php';
    $competicoes = new CompeticoesModel();
    $competicao = new CompeticoesModel();
    $jogo = new JogosModel();
?>
<!doctype html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/moduloPublico/competicoes-e-jogos.css"/>
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <title>AESB - Competições e Jogos</title>


</head>
<body>

<header>

    <?php
    include "inc/incMenuPrincipal.php";
    ?>

</header>

<main>

    <!--Competições e Jogos-->
    <div class="container-fluid">

        <div class="row py-5">

            <div class="col-12 mb-5 border-bottom proximo-jogo text-white">

                <h4 class="text-center text-white font-weight-bold">Próximo jogo</h4>
                <div class="row py-2">
                    <div class="col-12">
                        <?php if (!$jogo->selectProximoJogo()){ ?>
                            <div class="row border-right justify-content-center">

                                <div class="d-flex placar-logo">
                                    <h2 class="text-white">A definir</h2>
                                    <!--                                        <!--AESB-->
                                    <!--                                        <h5 class="d-none d-md-inline align-self-center mr-2 font-weight-bold text-uppercase">AVE</h5>-->
                                    <!---->
                                    <!--                                        <img class="logo-placar" src="img/competicoes-e-jogos/avenida.png" alt="Logo do Avenida"/>-->
                                    <!---->
                                    <!--                                        <!--PLACAR-->
                                    <!--                                        <div class="placar-ultimo-jogo align-self-center mx-1">-->
                                    <!---->
                                    <!--                                            <p class="d-inline invisible align-self-center">0</p>-->
                                    <!--                                            <i class="fas fa-times mx-3 align-self-center"></i>-->
                                    <!--                                            <p class="d-inline invisible align-self-center">0</p>-->
                                    <!---->
                                    <!--                                        </div>-->
                                    <!---->
                                    <!--                                        <!--TIME RIVAL-->
                                    <!--                                        <img src="img/competicoes-e-jogos/logo.png" alt="Logo da Aesb"/>-->
                                    <!---->
                                    <!--                                        <h5 class="d-none d-md-inline text-uppercase align-self-center ml-2 font-weight-bold">SBJ</h5>-->
                                </div>



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

            <!--Competições-->
            <div class="col-12 col-lg-6 border-right">

                <h3 class="font-weight-bold text-center pb-2">Competições <i class="fas fa-medal"></i></h3>

                <hr class="w-100 clearfix my-3">


                <label for="select-competicoes" class="font-weight-bold text-uppercase d-block">Selecione a competição</label>

                <!-- Select de competições -->
                <select id="select-competicoes" class="d-block form-control" autocomplete="off">
                    <?php foreach ($competicoes->selectByData() as $key => $value): ?>
                    <option value="competicao<?=$value->codigoCompeticao?>"><?=$value->nome?></option>
                    <?php endforeach; ?>
                </select>

                <div class="tab-content" id="nav-tabContent">

                    <?php $cont = 0; foreach ($competicoes->selectByData() as $key => $value):
                        if ($cont>0){
                            $classe = 'fade';
                        }else{
                            $classe = 'fade show active';
                        }
                        ?>
                    <div class="painel-de-competicoes tab-pane <?=$classe?>" id="competicao<?=$value->codigoCompeticao?>">

                        <h4 class="text-center my-3 text-uppercase"><?=$value->nome?></h4>

                        <!--Fase atual e Situação do Clube-->
                        <div class="row my-2">

                            <!--Fase atual-->
                            <div class="col-12 col-sm-6">

                                <div class="card mb-3">
                                    <div class="card-header text-center p-0"><h5 class="my-2 card-title font-weight-bold text-uppercase">Fase Atual</h5></div>
                                    <div class="card-body py-2">

                                        <p class="card-text text-uppercase text-center"><?=$value->faseAtual?></p>
                                    </div>
                                </div>

                            </div>

                            <!--Situação do Clube-->
                            <div class="col-12 col-sm-6">

                                <div class="card mb-3">
                                    <div class="card-header text-center p-0"><h5 class="my-2 card-title font-weight-bold text-uppercase">Situação do Clube</h5></div>
                                    <div class="card-body py-2">

                                        <p class="card-text text-uppercase text-center"><?=$value->situacaoClube?></p>

                                    </div>
                                </div>


                            </div>

                        </div>

                        <!--Regras-->
                        <label for="regras-competicao" class="font-weight-bold text-uppercase mx-2">Regras</label>
                        <div class="regras-competicao row m-2 p-4 justify-content-center d-block">
                            <?=$value->regras?>
                        </div>

                    </div>
                    <?php $cont++; endforeach; ?>

                </div>
            </div>

            <hr class="w-100 clearfix d-lg-none my-3">

            <!--Jogos-->
            <div class="col-12 col-lg-6">


                <h3 class="font-weight-bold text-center pb-2">Jogos <i class="far fa-futbol"></i></h3>

                <hr class="w-100 clearfix my-3">
                
                <!-- Select de Jogos -->
                <label for="select-de-jogos" class="font-weight-bold text-uppercase">Veja os jogos por competição</label>
                <select id="select-de-jogos" class="d-block form-control" autocomplete="off">
                    <option value="all" selected>Todos</option>
                    <?php foreach ($competicao->selectAll() as $key => $value): ?>
                    <option value="<?=$value->codigoCompeticao?>">Copa Wianey Carlet</option>
                    <?php endforeach; ?>
                </select>

                <div class="tab-content" id="nav-tabContent">

                    <div class="painel-de-jogos tab-pane fade show active" id="all">
                        <h4 class="text-center my-3">Todos os jogos</h4>

                        <div class="jogos-competicao border-right border-left my-5 p-2">

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

                                        <div class="col-12 col-sm-7">
                                            <div class="d-flex placar-logo justify-content-center">
                                                <!--AESB-->
                                                <h5 class="d-none d-md-inline align-self-center mr-2 font-weight-bold text-uppercase"><?=$value->mandanteAbreviacao?></h5>

                                                <img class="logo-placar" src="img/competicoes-e-jogos/<?=$value->logoMandante?>" alt="Logo da Aesb"/>

                                                <!--PLACAR-->
                                                <div class="placar-ultimo-jogo align-self-center mx-1">

                                                    <p class="d-inline align-self-center"><?=$value->placarMandante?></p>
                                                    <i class="fas fa-times mx-3 align-self-center"></i>
                                                    <p class="d-inline align-self-center"><?=$value->placarVisitante?> </p>

                                                </div>

                                                <!--TIME RIVAL-->
                                                <img src="img/competicoes-e-jogos/<?=$value->logoVisitante?> " alt="Logo da Aesb"/>

                                                <h5 class="d-none d-md-inline text-uppercase align-self-center ml-2 font-weight-bold"><?=$value->visitanteAbreviacao?></h5>
                                            </div>
                                        </div>



                                        <div class="col-12 col-sm-5 mt-2 mt-sm-0 text-center text-sm-left">
                                            <div class="ml-sm-5">
                                                <p class="mb-0 font-weight-bold"><?=$competicaoProximoJogo->nome?></p>
                                                <p class="mb-0"><i class="fas fa-calendar-alt"></i> <?=$dataJogo?> às <?=$horarioJogo?></p>
                                                <p class="mb-0"><i class="fas fa-map-marker-alt"></i> <?=$value->localJogo?></p>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>

                    </div>

                    <?php foreach ($competicao->selectAll() as $key => $value): ?>
                    <div class="painel-de-jogos tab-pane fade" id="<?=$value->codigoCompeticao?>">
                        <h4 class="text-center my-3">Jogos da <?=$value->nome?></h4>

                        <div class="jogos-competicao border-right border-left my-5 p-2">

                            <?php foreach ($jogo->selectByCompeticao($value->codigoCompeticao) as $key => $value):
                                $competicaoProximoJogo = $competicao->selectCompeticao($value->codigoCompeticao);

                                $data = new DateTime($value->dataJogo);
                                $dataJogo = $data->format('d/m/Y');

                                $hora = new DateTime($value->horario);
                                $horarioJogo = $hora->format('H:i');
                            ?>
                            <!--Jogo-->
                            <div class="col-12 jogo py-4">

                                <div class="row justify-content-center">

                                    <div class="col-12 col-sm-7">
                                        <div class="d-flex placar-logo justify-content-center">
                                            <!--AESB-->
                                            <h5 class="d-none d-md-inline align-self-center mr-2 font-weight-bold text-uppercase"><?=$value->mandanteAbreviacao?></h5>

                                            <img class="logo-placar" src="img/competicoes-e-jogos/<?=$value->logoMandante?>" alt="Logo da Aesb"/>

                                            <!--PLACAR-->
                                            <div class="placar-ultimo-jogo align-self-center mx-1">

                                                <p class="d-inline align-self-center"><?=$value->placarMandante?></p>
                                                <i class="fas fa-times mx-3 align-self-center"></i>
                                                <p class="d-inline align-self-center"><?=$value->placarVisitante?> </p>

                                            </div>

                                            <!--TIME RIVAL-->
                                            <img src="img/competicoes-e-jogos/<?=$value->logoVisitante?> " alt="Logo da Aesb"/>

                                            <h5 class="d-none d-md-inline text-uppercase align-self-center ml-2 font-weight-bold"><?=$value->visitanteAbreviacao?></h5>
                                        </div>
                                    </div>



                                    <div class="col-12 col-sm-5 mt-2 mt-sm-0 text-center text-sm-left">
                                        <div class="ml-sm-5">
                                            <p class="mb-0 font-weight-bold"><?=$competicaoProximoJogo->nome?></p>
                                            <p class="mb-0"><i class="fas fa-calendar-alt"></i> <?=$dataJogo?> às <?=$horarioJogo?></p>
                                            <p class="mb-0"><i class="fas fa-map-marker-alt"></i> <?=$value->localJogo?></p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>

                    </div>
                    <?php endforeach; ?>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="js/moduloPublico/competicoes-e-jogos.js"></script>
</body>

</html>