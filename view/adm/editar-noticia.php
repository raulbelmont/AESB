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

/*Pegando notícia que vai ser editada*/
require_once '../../model/NoticiasModel.php';
if (!empty($_GET['noticia'])){
    $not = new NoticiasModel();
    $noticia = $not->selectPorCodigo($_GET['noticia']);
}

?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/slick.css"/>
    <link rel="stylesheet" href="../css/moduloGestao/nova-noticia.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Editar Notícia</title>

</head>

<body>

<header>
    <?php
    include '../inc/moduloGestao/incMenuGestao.php';
    ?>

</header>

<main>
    <div class="container-fluid">
        <div class="modal fade" id="fundoNoticia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="../img/noticias/<?=$noticia->fundoNoticia?>" class="img-fluid"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-12">
                <h1 class="font-weight-bold text-center my-5">Editar notícia <i class="fas fa-edit"></i></h1>
            </div>

            <div class="col-12">



                <form class="mx-4" method="post" enctype="multipart/form-data" action="../../controller/NoticiasController.php">

                    <!--Ação que será executada peo controller-->
                    <input type="hidden" value="3" name="acao"/>
                    <input type="hidden" value="<?=$_GET['noticia'];?>" name="codigoNoticia"/>

                    <!--Título da notícia-->
                    <div class="form-row my-2">
                        <label for="tituloNoticia" class="font-weight-bold col-form-label-lg col-12 col-sm-2">Título da Notícia</label>
                        <input type="text" class="form-control col-12 col-sm-9" name="tituloNoticia" id="tituloNoticia" placeholder="Título" value="<?=$noticia->tituloNoticia?>" required>
                    </div>
                    <!--Descrição da Notícia-->
                    <div class="form-row my-2">
                        <label for="descricaoNoticia" class="font-weight-bold col-form-label-lg col-12 col-sm-2"> Descrição da Notícia </label>
                        <textarea id="descricaoNoticia" name="descricao" class="form-control col-12 col-sm-9" rows="2"  required><?=$noticia->descricaoNoticia?></textarea>
                        <p class="d-none d-sm-block col-2"></p>
                        <small class="text-muted col-sm-9">É altamente recomendado que a descrição da notícia seja não muito longa.</small>
                    </div>

                    <!--Imagem de destaque-->
                    <div class="form-row my-2">
                        <p class="font-weight-bold col-form-label-lg col-12 col-sm-2">Imagem de destaque</p>
                        <small class="text-muted  col-12">Caso não seja escolhida uma imagem o card será preenchido por um fundo neutro.</small>
                        <?php if (!$noticia->fundoNoticia == null) {?>
                            <a class="col-12 my-2" href="#" data-toggle="modal" data-target="#fundoNoticia">
                                Ver imagem atual
                            </a>
                        <?php }?>
                        <div class="col-12 col-sm-9">
                            <input type="file" value="vazio" class="form-control-file fundo-noticia" name="fundoNoticia" id="fundoNoticia" accept="image/*">
                            <button type="button" class="input-label"><span class="label-span">Selecionar nova imagem</span> <i class="fas fa-upload"></i></button>
                            <span class="custom-text ml-2">Nenhum arquivo selecionado </span>
                            <a class="reset-input d-none"><i class="fas fa fa-times-circle"></i></a>

                        </div>
                    </div>

                    <!--Corpo da Publicação-->

                    <label for="corpoNoticia" class="font-weight-bold col-form-label-lg col-12 text-center">Corpo da Notícia</label>
                    <textarea id="corpoNoticia" name="corpo" class="form-control m-auto"><?=$noticia->corpoNoticia?></textarea>


                    <div class="form-row my-2 mx-5 px-5">

                        <a href="noticias-gestao.php" class="ml-5 col-5 btn botao-excluir text-white font-weight-bold mr-auto">Cancelar <i class="fas fa-trash-alt"></i></a>

                        <button type="submit" class="mr-5 col-5 btn botao-inserir text-white font-weight-bold submit-patrocinador ml-auto">Salvar <i class="far fa-save"></i></button>


                    </div>

                </form>
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
<script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
<script src="../js/ckfinder/ckfinder.js"></script>
<script src="../js/moduloGestao/nova-noticia.js"></script>
<script>
    window.onload = function(){
        editor = CKEDITOR.replace( 'corpoNoticia' );
        CKFinder.setupCKEditor(editor,'../img/ckfinder');

    }

</script>
</html>