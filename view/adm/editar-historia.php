<?php
require_once '../../model/UsuarioModel.php';
require_once '../../model/HistoriaModel.php';
$usuario = new UsuarioModel();
$historia = new HistoriaModel();

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

/*pegando história a ser editada*/
if (!empty($_GET['historia'])){
    $codigoHistoria = $_GET['historia'];
    $historiaAtual = $historia->selecionarHistoriaCD($codigoHistoria);
}

/*
                       tipo 1 = historia
                       tipo 2 = Fundação
                       tipo 3 = Presidentes
                       tipo 4 = Hino e Símbolos
                       tipo 5 = Galeria de Troféus
                       tipo 6 = Ídolos
                       tipo 7 = Estatuto Social
                       */


/*Definindo tipo*/
if ($historiaAtual->tipo == 1){
    $tipo = 'História';
}
if ($historiaAtual->tipo == 2){
    $tipo = 'Fundação';
}
if ($historiaAtual->tipo == 3){
    $tipo = 'Presidentes';
}
if ($historiaAtual->tipo == 4){
    $tipo = 'Hino e Símbolos';
}
if ($historiaAtual->tipo == 5){
    $tipo = 'Galeria de Troféus';
}
if ($historiaAtual->tipo == 6){
    $tipo = 'Ídolos';
}
if ($historiaAtual->tipo == 7){
    $tipo = 'Estatuto Social';
}

/*Definindo última atualização*/
if ($historiaAtual->ultimaAtualizacao == null){
    $ultimaAtualizacao = '-';
}else{
    $data = new DateTime($historiaAtual->ultimaAtualizacao);
    $ultimaAtualizacao = $data->format('d/m/Y H:i');
}


?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloGestao/editar-historia.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Editar história</title>

</head>

<body>

<header>
    <?php
    include '../inc/moduloGestao/incMenuGestao.php';
    ?>

</header>

<main>

    <div class="container-fluid">

        <!--Título-->
        <div class="row ">
            <h1 class="font-weight-bold text-center col-12 my-5 pb-5 border-bottom">Editar história <i class="fas fa-book-open"></i></h1>
            <h2 class="font-weight-bold text-center text-danger col-12">"<?=$tipo?>"</h2>
            <h3 class="text-center col-12">Última atualização feita em: <?=$ultimaAtualizacao?></h3>
        </div>

        <!--Formulário de edição-->
        <div class="row justify-content-center mt-3 border m-2">

            <form class="col-11 col-sm-10 col-md-8" id="form-editar" enctype="multipart/form-data" method="post" action="../../controller/HistoriaController.php">

                <div class="form-row">

                    <!--Ação-->
                    <input type="hidden" name="acao" value="3">

                    <!--Codigo-->
                    <input type="hidden" name="codigoHistoria" value="<?=$historiaAtual->codigoHistoria?>">

                    <!--Última atualização-->
                    <input type="hidden" name="tipo" value="<?=$historiaAtual->tipo?>">

                    <!--titulo-->
                    <div class="form-group col-12">
                        <label for="titulo" class="form-control-lg font-weight-bold">Título *</label>
                        <input id="titulo" type="text" class="form-control" name="titulo" value="<?=$historiaAtual->titulo?>" required>
                    </div>

                    <!--corpo-->
                    <div class="form-group col-12">
                        <label for="corpo" class="font-weight-bold col-form-label-lg col-12 text-center">Corpo da História</label>
                        <textarea id="corpo" name="corpo" class="form-control m-auto"><?=$historiaAtual->corpo?></textarea>
                    </div>

                    <div class="form-group ml-auto">
                        <a href="historia-gestao.php" class="btn botao-excluir text-white font-weight-bold">Cancelar <i class="fas fa-ban"></i></a>
                        <button type="submit" class="btn botao-inserir text-white font-weight-bold">Salvar <i class="far fa-save"></i></button>

                    </div>

                </div>

            </form>

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
<script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
<script src="../js/ckfinder/ckfinder.js"></script>
<script src="../js/moduloGestao/editar-historia.js"></script>
<script>
    window.onload = function(){
        editor = CKEDITOR.replace( 'corpo' );
        CKFinder.setupCKEditor(editor,'../img/ckfinder');

    }

</script>

</html>