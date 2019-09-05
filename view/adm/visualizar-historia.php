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
if (!empty($_GET['historia'])){
    $codigoHistoria = $_GET['historia'];
    $historiaAtual = $historia->selecionarHistoriaCD($codigoHistoria);


}else{
    header('Location:historia-gestao.php');
}

?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/moduloGestao/historia-gestao.css"/>
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
        <!--Título-->
        <div class="row">
            <h1 class="font-weight-bold text-center my-5 pb-5 col-12 border-bottom">Visualizar história <i class="fas fa-book-open"></i></h1>
        </div>

        <!--História-->
        <div class="row justify-content-center">
            <h3 class="font-weight-bold text-center col-12 mb-4"><?=$historiaAtual->titulo?></h3>

            <?php if ($historiaAtual->ultimaAtualizacao == null){}else{
                $data = new DateTime($historiaAtual->ultimaAtualizacao);
                $ultimaAtualizacao = $data->format('d/m/Y H:i');
                ?>
            <h5 class="text-muted col-10 mb-4">Última atualização em: <?=$ultimaAtualizacao?> </h5>
            <?php } ?>

            <!--Corpo-->
            <div class="col-10 mt-3 pt-3">
                <?=$historiaAtual->corpo?>
            </div>
        </div>

        <!--Ações-->
        <div class="row mt-5">
            <div class="col-4 ml-auto">
                <a href="historia-gestao.php" class="btn px-5 py-2 botao-inserir text-white font-weight-bold">Voltar <i class="fas fa-long-arrow-alt-left"></i></a>
                <a href="editar-historia.php?historia=<?=$historiaAtual->codigoHistoria?>" class="btn px-5 py-2 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
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
<script src="../js/moduloGestao/historia-gestao.js"></script>


</html>