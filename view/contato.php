<?php
    require_once '../model/ClubeModel.php';
    require_once '../model/ImagensModel.php';
    $clubeObj = new ClubeModel();
    $clube = $clubeObj->selectClube(1);
    $imagem = new ImagensModel();
?>
<!doctype html>
<html>

<head>

    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/moduloPublico/contato.css"/>
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <title>AESB - Fale Conosco</title>


</head>
<body>

<header>

    <?php
    include "inc/incMenuPrincipal.php";
    ?>

</header>


<main>

    <div class="container-fluid">

        <?php

        if (isset($_GET['email'])){
            $email = $_GET['email'];

            if ($email){
                $displaySucess = 'd-block';
            }else{
                $displaySucess = 'd-none';
            }

            if (!$email){
                $displayError = 'd-block';
            }else{
                $displayError = 'd-none';
            }
        }else{
            $displaySucess = 'd-none';
            $displayError = 'd-none';
        }

        ?>
        <div class="invisible">sad</div>
        <div class="row col-8 col-sm-7 col-md-6 col-lg-5 col-xl-4 justify-content-center text-center text-white font-weight-bold mx-auto my-2 p-2 py-3 mensagem-de-sucesso  bg-success <?= $displaySucess;?>">
            <span>Sua mensagem foi enviada com sucesso! <i class="fas fa-check-circle fa-2x"></i></span>
        </div>

        <div class="row col-8 col-sm-7 col-md-6 col-lg-5 col-xl-4 justify-content-center text-center text-white font-weight-bold mx-auto my-2 p-2 py-3 mensagem-de-erro  bg-danger <?= $displayError;?>">
            <span>Erro ao enviar mensagem, tente novamente! <i class="fas fa-exclamation-triangle fa-2x"></i></span>
        </div>

        <h3 class="font-weight-bold text-center m-4 p-4 border-bottom">Fale Conosco</h3>

        <div class="row">

            <!--DADOS PARA CONTATO-->
            <div class="col-12 col-md-6 border-right dados-para-contato">

                <h5 class="font-weight-bold text-center pb-4">Dados para contato</i></h5>

                <figure class="text-center">

                    <?php $logo = $imagem->selectAllByLocal(5) ?>
                    <img class="img-fluid logo-contato" src="img/<?=$logo[0]->imagem?>" alt="Logo da Aesb"/>
                    <figcaption class="font-weight-bold"><?=$clube->nome?></figcaption>
                </figure>

                <div class="text-md-center border-bottom pb-3 mb-3">
                    <p class="m-0"><i class="fa fa-home mr-3"></i> <?=$clube->endereco?></p>
                    <p class="m-0"><i class="fa fa-envelope mr-3"></i> <?=$clube->email?></p>
                    <p class="m-0"><i class="fa fa-building mr-3"></i>CNPJ: <?=$clube->cnpj?></p>
                    <p class="m-0"><i class="fa fa-phone mr-3"></i> <?=$clube->telefone?></p>
                </div>


                <!--MAPA-->
                <p class="font-weight-bold ml-2">Estádio Vicente Goulart <i class="fas fa-map-marker-alt"></i></p>

                <div class="map-responsive m-2 mb-4 text-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14003.300523832935!2d-56.016986!3d-28.6649542!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd5578a208c6dcf49!2sEst%C3%A1dio+Vicente+Goulart+-+Maria+do+Carmo%2C+S%C3%A3o+Borja+-+RS%2C+97670-000!5e0!3m2!1spt-BR!2sbr!4v1538663698428" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

            </div>



            <!--DEIXE SUA MENSAGEM-->
            <div class="col-12 col-md-6 mt-4 mt-md-0">

                <h5 class="font-weight-bold text-center pb-2 mb-5">Entre em contato ou deixe sua mensagem</h5>



                    <form class="col-12" id="formularioContato" enctype="multipart/form-data" action="../controller/ContatoController.php" method="post">

                        <div class="form-row">

                            <!--acao-->
                            <input type="hidden" name="acao" value="1">

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="nomeContato">Nome <i class="fas fa-user"></i> *</label>
                                    <input type="text" class="form-control" name="nomeContato" id="nomeContato" placeholder="Nome">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="telefoneContato">Telefone <i class="fas fa-phone"></i> *</label>
                                    <input type="tel" name="telefoneContato" class="form-control" id="telefoneContato" placeholder="(99) 99999-9999" required minlength="10">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="emailContato">E-mail <i class="fas fa-envelope"></i></label>
                                    <input type="email" class="form-control" name="emailContato" id="emailContato" placeholder="exemplo@email.com">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12">
                                <p class="font-weight-bold m-0">Torcedor Voluntário</p>
                                <p class="m-0">Seja voluntário e ajude o seu clube do coração a crescer!</p>
                                <div class="form-group">
                                     <input type="checkbox" name="isVoluntario" value="1" class="form-control custom-control-input" id="voluntarioContato">
                                     <label class="custom-control-label ml-4 mt-2" for="voluntarioContato">Desejo ser voluntário</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-bold" for="mensagemContato">Mensagem <i class="fas fa-comment-alt"></i></label>
                                    <textarea class="form-control" name="mensagem" id="mensagemContato" rows="7"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="checkbox" name="isDesejaAssociarse" value="1" class="form-control custom-control-input" id="socioContato">
                                    <label class="custom-control-label ml-4 mt-2" for="socioContato">Desejo ser Sócio</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center text-md-right borda mb-2">
                             <button type="submit" class="btn botao-enviar px-5 mb-3 font-weight-bold">Enviar <i class="far fa-envelope"></i></button>
                        </div>

                        <div class="form-group">
                            <p class="font-weight-bold">Trabalhe Conosco</p>
                            <input type="file" class="form-control-file" name="curriculo" id="curriculo" accept=".doc,.docx,.pdf">
                            <button type="button" class="input-label"><span class="label-span">Anexar Currículo</span> <i class="fas fa-upload"></i></button>
                            <span class="custom-text">Nenhum arquivo selecionado </span>
                            <a class="reset-input d-none"><i class="fas fa fa-times-circle"></i></a>
                        </div>
                    </form>



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
<script src="js/jquery.mask.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/additional-methods.js"></script>
<script src="js/moduloPublico/contato.js"></script>
</body>

</html>