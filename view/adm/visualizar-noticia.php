<?php
require_once '../../model/UsuarioModel.php';
$usuario = new UsuarioModel();

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

/*Buscando notícia*/
if (!empty($_GET['noticia'])){
    require_once '../../model/NoticiasModel.php';
    $noticia = new NoticiasModel();

    $codigoNoticia = $_GET['noticia'];

    $noticiaAtual = $noticia->selectPorCodigo($codigoNoticia);

}
?>

<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/fontawesome/css/fontawesome.min.css"/>
	<link rel="stylesheet" href="../css/moduloGestao/noticias-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Notícia</title>

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
            <div class="col-12 col-md-9 m-auto">

                <div class="cabecalho-noticia border-bottom">
                    <h1 class="text-center my-2 font-weight-bold"><?= $noticiaAtual->tituloNoticia ?></h1>

                    <h5 class="text-muted my-5"><?= $noticiaAtual->descricaoNoticia ?></h5>

                    <p class=" my-0 font-weight-bold">Publicado por <?= $noticiaAtual->autor ?></p>
                    <p class="text-muted small">
                        <?php
                            $data = new DateTime($noticiaAtual->dataPublicacao);
                            echo $data->format('d/m/Y H:i');

                            if (!$noticiaAtual->ultimaAtualizacao == NULL){
                                $dataA = new DateTime($noticiaAtual->ultimaAtualizacao);

                                echo ' - Atualizado em '.$dataA->format('d/m/Y H:i');
                            }
                        ?>
                    </p>
                </div>



        <div class="row justify-content-center">

            <?php
                if (!$noticiaAtual->fundoNoticia == null){
            ?>

                <img src="../img/noticias/<?=$noticiaAtual->fundoNoticia?>" alt="Fundo" class="col-12 col-sm-10 col-lg-8 img-fluid p-1 my-2" style="object-fit: scale-down;">

            <?php } ?>
        </div>

            <article class="border-bottom"><?=$noticiaAtual->corpoNoticia?></article>





            </div>
        </div>

        <div class="row justify-content-center">

            <a href="noticias-gestao.php" class="col-8 col-md-3 btn botao-excluir text-white font-weight-bold m-1">Voltar <i class="fas fa-trash-alt"></i></a>
            <a href="editar-noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" class="col-8 col-md-3 btn botao-editar text-white font-weight-bold m-1">Editar <i class="fas fa-edit"></i></a>

            <?php if ($noticiaAtual->isPublicada == 0)
            {
                echo "<a id='btn-publicar' class='col-8 col-md-3 btn botao-inserir text-white font-weight-bold submit-patrocinador m-1'>Publicar <i class='fas fa-check'></i></a>";
                echo "<p id='codigoNoticia' class='d-none m-0'>$noticiaAtual->codigoNoticia</p>";
            }
            ?>
        </div>

        <div class="row mt-3 justify-content-center">
            <div class="col-6">
                <p class="text-center d-none" id="carregando"><i class="fas fa-sync-alt fa-spin fa-3x fa-fw"> </i></p>
                <h5 id="mensagem-sucesso" class="mensagem-de-sucesso d-none py-2 text-center text-success font-weight-bold">Notícia publicada com sucesso! <i class="fas fa-check"></i></h5>
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
<script src="../js/moduloGestao/noticias-gestao.js"></script>
<script src="../js/moduloGestao/visualizar-noticia.js"></script>


</html>
