<?php
    require_once '../../model/UsuarioModel.php';
    require_once '../../model/ClubeModel.php';
    $usuario = new UsuarioModel();
    $clubeObj = new ClubeModel();
    $clube = $clubeObj->selectClube(1);


/*Validando usuario*/
    if (!session_id()) session_start();

    if ($_SESSION['logado'] == true){
        $usuario->usuarioLogado($_SESSION['usuario']);
    }else{
        header('location:home.php');
    }
	
	  /*deslogando*/
if (!empty($_GET['sair']) == true){
    $usuario->logoff();
}

?>
<!doctype html>
<html>

    <head>

        <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/moduloGestao/home.css"/>
        <link rel="icon" href="../img/logo.png" type="image/x-icon" />
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
        <title>AESB - Módulo de Gestão</title>

    </head>

    <body>

        <header>
            <?php
                include '../inc/moduloGestao/incMenuGestao.php';
            ?>

        </header>

           <main>

            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">

                        <!--row-->
                        <div class="row text-center px-4 justify-content-center">

                            <a class="col-12 col-sm-5 col-lg-3 painel-azul d-flex text-white" href="clube-gestao.php">
                                <h3 class="align-self-center m-auto">Clube <img class="club-imagem" src="../img/<?=$clube->logo?>"/></h3>
                            </a>


                            <a class="col-12 col-sm-5 col-lg-3 painel-padrao d-flex text-white" href="imagens-gestao.php">
                                <h3 class="align-self-center m-auto">Imagens <i class="fa fa-images"></i></h3>
                            </a>

                            <a class="col-12 col-sm-5 col-lg-3 painel-padrao d-flex text-white" href="videos-gestao.php">
                                <h3 class="align-self-center m-auto">Vídeos <i class="fas fa-video"></i></h3>
                            </a>

                            <a class="col-12 col-sm-5 col-lg-3 painel-azul d-flex text-white" href="parceiros-gestao.php">
                                <h3 class="align-self-center m-auto">Parceiros <i class="fa fa-handshake"></i></h3>
                            </a>



                            <a class="col-12 col-sm-5 col-lg-3 painel-padrao d-flex text-white" href="elenco-gestao.php">
                                <h3 class="align-self-center m-auto">Elenco  <i class="fa fa-user-friends"></i></h3>
                            </a>


                            <a class="col-12 col-sm-5 col-lg-3 painel-azul d-flex text-white" href="competicoes-gestao.php">
                                <h3 class="align-self-center m-auto">Competições <i class="fas fa-medal"></i></h3>
                            </a>

                            <a class="col-12 col-sm-5 col-lg-3 painel-padrao d-flex text-white" href="jogos-gestao.php">
                                <h3 class="align-self-center m-auto">Jogos <i class="fa fa-futbol"></i></h3>
                            </a>




                            <a class="col-12 col-sm-5 col-lg-3 painel-azul d-flex text-white" href="historia-gestao.php">
                                <h3 class="align-self-center m-auto">História <i class="fas fa-book-open"></i></h3>
                            </a>


                            <a class="col-12 col-sm-5 col-lg-3 painel-padrao d-flex text-white" href="contatos-gestao.php">
                                <h3 class="align-self-center m-auto">Contatos <i class="fa fa-phone"></i></h3>
                            </a>

                            <a class="col-12 col-sm-5 col-lg-3 painel-azul d-flex text-white" href="noticias-gestao.php">
                                <h3 class="align-self-center m-auto">Notícias <i class="fa fa-newspaper"></i></h3>
                            </a>




                            <a class="col-12 col-sm-5 col-lg-3 painel-azul d-flex text-white" href="usuarios-gestao.php">
                                <h3 class="align-self-center m-auto">Usuários <i class="fas fa-users"></i></h3>
                            </a>

                    </div>

                </div>
            </div>

        </main>

        <footer>
            <?php
                include '../inc/moduloGestao/incRodapeGestao.php';
            ?>
        </footer>

    </body>

    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/jquery-migrate-1.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
    <script src="../js/moduloGestao/home.js"></script>


</html>