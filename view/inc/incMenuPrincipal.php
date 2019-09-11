<?php
        require_once '../model/ClubeModel.php';
        $clubeObj = new ClubeModel();
        $clube = $clubeObj->selectClube(1);
    ?>
<!--Criação do cabeçalho principal que vai em todas as páginas-->

<link rel="stylesheet" href="css/moduloPublico/menuprincipal.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

     <!--Criando o container e a linha que conterão o logo e o menu-->
    <div id="menu" class="container-fluid m-0 p-0 fixed-top text-uppercase" >
        <div class="row w-100 m-0 p-0">

                    <!--Inserindo o logo, posicionando ele e definindo pontos de quebra-->
                    <div class="col-12 col-sm-2 logo-menu-principal menu-principal m-0 p-0 text-center text-xl-center text-lg-left text-md-center">

                        <a class="p-0 m-0" href="index.php">

                            <figure class="m-0 p-0">
                                <img class="m-0 my-1 p-0 logo-menu-p" src="img/<?=$clube->logo?>" alt="Logo da Aesb"/>
                            </figure>


                        </a>

                    </div>

                <!--Menu de Navegação principal-->
                <nav class="col-12 col-sm-10 navbar navbar-light menu-principal">
                    <div class="descricao-logo-menu">

                        <a href="index.php">
                            <h1 class="font-weight-bold titulo-menu-sm text-uppercase"><?=$clube->nomeAbreviado?></h1>
                            <h1 class="font-weight-bold titulo-menu-lg mr-5 text-uppercase"><?=$clube->nome?></h1>
                        </a>

                    </div>
                        <!--Botão de toggle para dispositivos móveis-->
                        <a class="navbar-toggler menu-toggler ml-auto font-weight-bold" data-toggle="collapse" data-target="#menu-principal">
                           <p id="toggle-text" class="d-none d-sm-none d-md-inline">MENU</p><p id="toggle-text-x" class="d-none d-sm-none d-md-none">VOLTAR</p> <i id="icone-toggler-menu" class="fas fa-bars"></i> <i id="icone-toggler-menu-x" class="fas fa-times d-none"></i>
                        </a>

                        <!--Lista de Links do menu-->
                        <div  id="menu-principal" class="collapse navbar-collapse">
                            <ul class="navbar-nav mr-auto font-weight-bold">

                                <!--HOME-->
                                <li class="nav-item ml-2">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>

                                <!--FUTEBOL-->
                                <li class="nav-item dropdown ml-2">
                                    <a class="nav-link" href="futebol.php" data-toggle="dropdown" id="navdrop">Futebol <i class="fa fa-caret-down"></i></a>

                                    <div class="dropdown-menu m-0 p-0 menu-principal">
                                        <a class="dropdown-item font-weight-bold border-0" href="elenco.php">Elenco</a>
                                        <a class="dropdown-item font-weight-bold border-0" href="competicoes-e-jogos.php">Competições e Jogos</a>
                                    </div>

                                </li>

                                <!--CLUBE/HISTÓRIA-->
                                <li class="nav-item ml-2">
                                    <a class="nav-link" href="clube.php">O Clube</a>
                                </li>

                                <!--Notícias-->
                                <li class="nav-item ml-2">
                                    <a class="nav-link" href="noticias.php">Notícias</a>
                                </li>

                                <!--Notícias-->
                                <li class="nav-item ml-2">
                                    <a class="nav-link" href="videos.php">Vídeos</a>
                                </li>

                                <!--FALE CONOSCO-->
                                <li class="nav-item ml-2">
                                    <a class="nav-link" href="contato.php">Fale Conosco</a>
                                </li>


                            </ul><!--FIM DA LISTA DE LINKS-->
                        </div><!--FIM DA DIV COM OS LINKS DO MENU-->
                </nav><!--FIM DO MENU DE NAVEGAÇÃO-->

        </div><!--FIM DA ROW-->



    </div><!--FIM DO CONTAINER PRINCIPAL-->
	<script src="js/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/moduloPublico/menuprincipal.js"></script>


