<?php
    require_once '../model/ParceirosGestaoModel.php';
    require_once '../model/ElencoModel.php';
    $parceiro = new ParceirosGestaoModel();
    $clubeObj = new ClubeModel();
    $clube = $clubeObj->selectClube(1);
?>
<link rel="stylesheet" href="css/moduloPublico/rodapeprincipal.css"/>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    


<!-- Footer -->
<footer class="border-top mt-0 bg-light">


    <div class="container-fluid">

        <!--Social-->
        <div class="row rodape-social d-flex">

            <div class="col-12 media-sociais text-center align-self-center">
            <ul class="list-unstyled list-inline botoes-medias-sociais">

                <h3 class="font-weight-bold text-uppercase titulo-social">Siga a <span class="text-uppercase">AE São Borja</span></h3>


                <!--FACEBOOK-->
                <?php if ($clube->facebookLink != 'Não Informado'){ ?>
                <li class="list-inline-item mt-1">
                    <a class="botao-facebook mx-1 d-flex" href="<?=$clube->facebookLink?>">
                        <i class="fab fa-facebook align-self-center m-auto"></i>
                    </a>
                </li>
                <?php }?>

                <!--INSTAGRAM-->
                <?php if ($clube->instagramLink != 'Não Informado'){ ?>
                <li class="list-inline-item mt-1">
                    <a class="botao-instagram mx-1 d-flex" href="<?=$clube->instagramLink?>">
                        <i class="fab fa-instagram align-self-center m-auto"></i>
                    </a>
                </li>
                <?php }?>

                <!--TWITTER-->
                <?php if ($clube->twitterLink != 'Não Informado'){ ?>
               <li class="list-inline-item mt-1">
                    <a class="botao-twitter mx-1 d-flex" href="<?=$clube->twitterLink?>">
                        <i class="fab fa-twitter align-self-center m-auto"> </i>
                    </a>
                </li>
                <?php }?>

                <!--YOUTUBE-->
                <?php if ($clube->youtubeLink != 'Não Informado'){ ?>
                <li class="list-inline-item mt-1">
                    <a class="botao-youtube mx-1 d-flex" href="<?=$clube->youtubeLink?>">
                        <i class="fab fa-youtube align-self-center m-auto"> </i>
                    </a>
                </li>
                <?php }?>

                <!--GOOGLEPLUS-->
                <?php if ($clube->googlePlusLink != 'Não Informado'){ ?>
                <li class="list-inline-item mt-1">
                    <a class="botao-gplus mx-1 d-flex" href="<?=$clube->googlePlusLink?>">
                        <i class="fab fa-google-plus align-self-center m-auto"> </i>
                    </a>
                </li>
                <?php }?>
            </ul>

                <a href="contato.php">
                    <button type="button" class="botao-contato-rodape btn font-weight-bold mb-2 mt-1">
                        Fale Conosco <i class="fas fa-phone"></i>
                    </button>
                </a>

                <a href="https://docs.google.com/forms/d/e/1FAIpQLSfg90Er056IpCvCsT7zLRp5KLPuqOTR_utOfJn_Nc0DUIor_Q/viewform" target="_blank">
                    <button type="button" class="botao-socio-rodape btn font-weight-bold mb-1">
                        Seja Sócio <i class="fas fa-users"></i>
                    </button>
                </a>

            </div>

        </div>

        <!--Patrocinadores-->
        <div class="row row-patrocinadores d-flex ">

            <!--Carrosel de patrocinadores-->

            <!--Controlador PREV-->
            <div class="col-1 text-sm-center align-self-center">

                <a class="prev" href="">
                    <i class="fas fa-angle-left fa-2x controlador-carrosel"></i>
                </a>

            </div>

            <!--Itens do Carrosel-->
            <div class="col-7 col-sm-10 mx-auto align-self-center">

                <h5 class="text-left text-sm-center mb-5 text-uppercase font-weight-bold">Patrocinadores</h5>
                <ul class="list-unstyled list-inline carrosel-de-patrocinadores">

                    <?php foreach ($parceiro->selectParceiros(1) as $key => $value): ?>
                    <!--Patrocinador-->
                    <li class="list-inline-item m-1 mx-sm-3 patrocinador">

                        <figure>

                            <img class="m-auto logo-patrocinador" src="img/patrocinadores/<?=$value->logoParceiro?>" alt="Logo do Patrocinador"/>

                            <figcaption class="font-weight-bold text-center nome-patrocinador d-none d-sm-block"><?=$value->nomeParceiro?></figcaption>

                        </figure>

                    </li>
                    <?php endforeach; ?>

                </ul>


            </div>

            <!--Controlador NEXT-->
            <div class="col-1 text-center mr-2 mr-sm-0 align-self-center">

                <a class="prev" href="">
                    <i class="fas fa-angle-right fa-2x controlador-carrosel"></i>
                </a>

            </div>


        </div>

        <!--APOIOADORES E FORNECEDORES-->
        <div class="row text-center text-md-left">

            <!-- Grid column -->
            <div class="row col-md-12 col-lg-12 col-xl-12 m-0 w-100 apoiadores">

                <!--Apoiadores-->
                <div class="text-center col-12">
                    <h6 class="text-uppercase mb-4 p-2 w-100 font-weight-bold titulo-apoiadores"><span>Apoiadores <i class="fas fa-handshake"></i></span></h6>

                    <div class="row lista-de-apoadores mb-1 m-0 p-0 justify-content-center">
                        <?php foreach ($parceiro->selectParceiros(2) as $key=>$value):?>
                        <div class="mx-2">
                            <figure>
                                <img class="m-auto" src="img/apoiadores/<?=$value->logoParceiro?>" alt="Apoiador"/>
                                <figcaption class="d-none d-md-block text-center font-weight-bold nome-apoiador"><?=$value->nomeParceiro?></figcaption>
                            </figure>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

<!--                <!--Fornecedores-->
<!--                <div class="text-center col-12 col-lg-6 m-0 p-0">-->
<!--                    <h6 class="text-uppercase mb-4 p-2 w-100 font-weight-bold titulo-apoiadores"><span>Fornecedores Oficiais</span></h6>-->
<!---->
<!--                    <div class="row mb-1">-->
<!--                        <div class="col-2 mr-4 col-sm-2 col-md-4 m-md-0">-->
<!---->
<!--                            <ul class="list-unstyled lista-de-apoadores pl-1">-->
<!---->
<!--                                <li class="m-auto">-->
<!--                                    <figure>-->
<!--                                        <img class="m-auto" src="img/fornecedor.jpg" alt="Apoiador"/>-->
<!--                                        <figcaption class="text-center font-weight-bold nome-apoiador">Fornecedor</figcaption>-->
<!--                                    </figure>-->
<!--                                </li>-->
<!---->
<!--                                <li class="m-auto li">-->
<!--                                    <figure>-->
<!--                                        <img class="m-auto" src="img/fornecedor.jpg" alt="Apoiador"/>-->
<!--                                        <figcaption class="text-center font-weight-bold nome-apoiador">Fornecedor</figcaption>-->
<!--                                    </figure>-->
<!--                                </li>-->
<!---->
<!--                                <li class="m-auto li">-->
<!--                                    <figure>-->
<!--                                        <img class="m-auto" src="img/fornecedor.jpg" alt="Apoiador"/>-->
<!--                                        <figcaption class="text-center font-weight-bold nome-apoiador">Fornecedor</figcaption>-->
<!--                                    </figure>-->
<!--                                </li>-->
<!---->
<!---->
<!--                            </ul>-->
<!---->
<!--                        </div>-->
<!--                        <div class="col-2 mr-4 col-sm-2 col-md-4 m-md-0">-->
<!---->
<!--                            <ul class="list-unstyled lista-de-apoadores pl-1">-->
<!---->
<!--                                <li class="m-auto">-->
<!--                                    <figure>-->
<!--                                        <img class="m-auto" src="img/fornecedor.jpg" alt="Apoiador"/>-->
<!--                                        <figcaption class="text-center font-weight-bold nome-apoiador">Fornecedor</figcaption>-->
<!--                                    </figure>-->
<!--                                </li>-->
<!---->
<!--                                <li class="m-auto li">-->
<!--                                    <figure>-->
<!--                                        <img class="m-auto" src="img/fornecedor.jpg" alt="Apoiador"/>-->
<!--                                        <figcaption class="text-center font-weight-bold nome-apoiador">Fornecedor</figcaption>-->
<!--                                    </figure>-->
<!--                                </li>-->
<!---->
<!--                                <li class="m-auto li">-->
<!--                                    <figure>-->
<!--                                        <img class="m-auto" src="img/fornecedor.jpg" alt="Apoiador"/>-->
<!--                                        <figcaption class="text-center font-weight-bold nome-apoiador">Fornecedor</figcaption>-->
<!--                                    </figure>-->
<!--                                </li>-->
<!---->
<!---->
<!--                            </ul>-->
<!---->
<!--                        </div>-->
<!--                        <div class="col-2 mr-4 col-sm-2 col-md-4 m-md-0">-->
<!---->
<!--                            <ul class="list-unstyled lista-de-apoadores pl-1">-->
<!---->
<!--                                <li class="m-auto">-->
<!--                                    <figure>-->
<!--                                        <img class="m-auto" src="img/fornecedor.jpg" alt="Apoiador"/>-->
<!--                                        <figcaption class="text-center font-weight-bold nome-apoiador">Fornecedor</figcaption>-->
<!--                                    </figure>-->
<!--                                </li>-->
<!---->
<!--                                <li class="m-auto li">-->
<!--                                    <figure>-->
<!--                                        <img class="m-auto" src="img/fornecedor.jpg" alt="Apoiador"/>-->
<!--                                        <figcaption class="text-center font-weight-bold nome-apoiador">Fornecedor</figcaption>-->
<!--                                    </figure>-->
<!--                                </li>-->
<!---->
<!--                                <li class="m-auto li">-->
<!--                                    <figure>-->
<!--                                        <img class="m-auto" src="img/fornecedor.jpg" alt="Apoiador"/>-->
<!--                                        <figcaption class="text-center font-weight-bold nome-apoiador">Fornecedor</figcaption>-->
<!--                                    </figure>-->
<!--                                </li>-->
<!---->
<!---->
<!--                            </ul>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                </div>-->

            </div>
            <!-- Grid column -->
            <hr class="w-100 clearfix d-md-none">
        </div>
        <!-- Footer links -->


        <!--RODAPÉ FINAL-->
        <!-- Grid row -->
        <div class="row rodape-final">

            <div class="col-12">
                <!--INFORMAÇÕES PRA CONTATO-->
                <p class="m-0 text-md-center"><i class="fa fa-home mr-3"></i> <?=$clube->endereco?></p>
                <p class="m-0 text-md-center"><i class="fa fa-envelope mr-3"></i> <?=$clube->email?></p>
                <p class="m-0 text-md-center"><i class="fa fa-building mr-3"></i>CNPJ: <?=$clube->cnpj?></p>
                <p class="m-0 text-md-center"><i class="fa fa-phone mr-3"></i> <?=$clube->telefone?></p>
                <hr>
            </div>

            <!-- Grid column -->
            <div class="col-12 col-sm-7 col-md-4 py-2 contato align-self-center">

                
                <div class="mt-5 text-center">

                    <a class="text-white" href="adm/login.php">
                        <img class="m-auto m-md-0 float-md-left ml-md-5 mr-2 logo-rodape-p d-block" src="img/<?=$clube->logo?>" alt="Logo da AESB"/>
                        <p class="text-uppercase m-0 p-0"><?=$clube->nome?></p>
                        <p>© 2018 Todos os direitos reservados</p>
                    </a>
                </div>

            </div>

            <div class="col-12 col-sm-5 col-md-4">
                <div class="lista-link-historia float-right text-sm-right">

                    <ul class="list-unstyled mr-5 d-inline-block align-self-start">
                        <a href="clube.php?historia=true"><li>História</li></a>
                        <a href="clube.php?fundacao=true"><li>Fundação</li></a>
                        <a href="clube.php?presidentes=true"><li>Presidentes</li></a>
                        <a href="clube.php?hinoSimbolos=true"> <li>Hino e Símbolos</li> </a>
                    </ul>

                    <ul class="list-unstyled mr-5 d-inline-block">

                        <a href="clube.php?galeriaDeTrofeus=true"> <li>Galeria de Troféus</li> </a>
                        <a href="clube.php?idolos=true"> <li>Ídolos</li> </a>
                        <a href="clube.php?estatutoSocial=true"> <li>Estatuto Social</li> </a>
                    </ul>

                    
                </div>
            </div>

            <div class="col-12 col-md-4 p-0 mt-4">
                <a href="https://www.facebook.com/inpactustec/" target="_blank">
                <img src="img/inpactus.png" class="img-fluid inpactus" alt="">
                </a>
            </div>


                


                

                
            </div>
            <!-- Grid column -->




        </div>
        <!-- Grid row -->

    </div>

    <!-- Footer Links -->
    <div class="smoothscroll-top">
        <span class="scroll-top-inner">
            <i class="fas fa-2x fa-angle-double-up"></i>
        </span>
    </div>

</footer>
<!-- Footer -->
<!-- Footer -->
<script src="js/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="js/moduloPublico/rodapeprincipal.js"></script>