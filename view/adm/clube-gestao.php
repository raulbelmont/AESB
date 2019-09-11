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
    <link rel="stylesheet" href="../css/moduloGestao/clube-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Clube</title>

</head>

<body>

<header>
    <?php
    include '../inc/moduloGestao/incMenuGestao.php';
    ?>

</header>

<main>

    <div class="container-fluid">
        <div class="row mx-2 justify-content-center dados">
            <h1 class="font-weight-bold text-center my-5 col-12">Clube</h1>

            <!--Mensagem de Edição-->
            <?php if (isset($_SESSION['editou']) and $_SESSION['editou'] == true){ ?>
                <div class="mensagem-de-sucesso col-12 p-2 my-2 text-center justify-content-center d-block">
                    <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                    <h5 class="text-success font-weight-bold">Alterações salvas com sucesso!</h5>
                </div>
            <?php } $_SESSION['editou'] = null; ?>

            <?php if (isset($_SESSION['editou']) and $_SESSION['editou'] == false){ ?>
                <div class="mensagem-de-erro col-12 p-0 my-2 text-center justify-content-center d-block">
                    <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                    <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao salvar as alterações</h5>
                </div>
            <?php } $_SESSION['editou'] = null;?>

            <div class="col-12 col-md-6 border border-right-0 border-bottom-0">
                <h4 class="text-center font-weight-bold">Dados do clube</h4>
            </div>
            <div class="col-6 d-none d-md-block border border-bottom-0">
                <h4 class="text-center font-weight-bold">Redes sociais</h4>
            </div>

            <!--Dados do clube-->
            <div class="col-12 col-md-2 bg-dark border d-flex py-2 justify-content-center border-right-0">
                <!--logo-->
                <figure class="my-auto">
                    <img class="w-100" src="../img/<?=$clube->logo?>">
                    <figcaption class="text-center text-white font-weight-bold">Logo</figcaption>
                </figure>
            </div>

            <div class="col-12 col-md-4 border border-right-0 p-0 dados-do-clube">
                <div class="my-auto">

                    <!--nome-->
                    <p class="my-0 bg-light p-1 w-100"><i class="fas fa-user"></i> <span class="font-weight-bold">Nome:</span> <?=$clube->nome?> (<?=$clube->nomeAbreviado?>)</p>

                    <!--Endereço-->
                    <p class="my-0 p-1 bg-light"><i class="fa fa-home"></i> <span class="font-weight-bold">Endereço:</span> <?=$clube->endereco?></p>

                    <!--email-->
                    <p class="my-0 bg-light p-1"><i class="fa fa-envelope"></i> <span class="font-weight-bold">E-mail:</span> <?=$clube->email?></p>

                    <!--cnpj-->
                    <p class="my-0 p-1 bg-light"><i class="fa fa-building"></i> <span class="font-weight-bold">CNPJ:</span> <?=$clube->cnpj?></p>

                    <!--Telefone-->
                    <p class="my-0 bg-light p-1"><i class="fa fa-phone"></i> <span class="font-weight-bold">Telefone:</span> <?=$clube->telefone?></p>
                </div>

            </div>

            <h4 class="text-center d-md-none mt-5 font-weight-bold border-top col-12 pt-4">Redes sociais</h4>

            <!--Redes sociais-->
            <div class="col-12 col-md-6 border p-0 redes-sociais">
                <?php

                /*Facebook*/
                if ($clube->facebookLink != 'Não Informado'){
                    $facebook = "<a href='$clube->facebookLink'>$clube->facebookLink</a>";
                }else{
                    $facebook = $clube->facebookLink;
                }

                /*Instagram*/
                if ($clube->instagramLink != 'Não Informado'){
                    $instagram = "<a href='$clube->instagramLink'>$clube->instagramLink</a>";
                }else{
                    $instagram = $clube->instagramLink;
                }

                /*Twitter*/
                if ($clube->twitterLink != 'Não Informado'){
                    $twitter = "<a href='$clube->twitterLink'>$clube->twitterLink</a>";
                }else{
                    $twitter = $clube->twitterLink;
                }

                /*Youtube*/
                if ($clube->youtubeLink != 'Não Informado'){
                    $youtube = "<a href='$clube->youtubeLink'>$clube->youtubeLink</a>";
                }else{
                    $youtube = $clube->youtubeLink;
                }

                /*Google Plus*/
                if ($clube->googlePlusLink != 'Não Informado'){
                    $googlePlus = "<a href='$clube->googlePlusLink'>$clube->googlePlusLink</a>";
                }else{
                    $googlePlus = $clube->googlePlusLink;
                }
                ?>

                <!--Facebook-->
                <p class="my-0 p-1 w-100"><i class="fab fa-facebook"></i> <span class="font-weight-bold">Facebook:</span> <?=$facebook?></p>

                <!--Instagram-->
                <p class="my-0 p-1"><i class="fab fa-instagram"></i> <span class="font-weight-bold">Instagram: </span><?=$instagram?></p>

                <!--Twitter-->
                <p class="my-0 p-1"><i class="fab fa-twitter-square"></i> <span class="font-weight-bold">Twitter: </span><?=$twitter?></p>

                <!--Youtube-->
                <p class="my-0 p-1"><i class="fab fa-youtube"></i> <span class="font-weight-bold">YouTube: </span><?=$youtube?></p>

                <!--Google Plus-->
                <p class="my-0 p-1"><i class="fab fa-google-plus-square"></i> <span class="font-weight-bold">Google Plus: </span><?=$googlePlus?></p>

            </div>

            <div class="col-12 border my-4 my-sm-0 border-top-0">
                <div class="row">

                    <?php
                    if ($clube->ultimaAtualizacao == null){
                        $data = '-';
                    }else{
                        $recebeData = new DateTime($clube->ultimaAtualizacao);
                        $data = $recebeData->format('d/m/Y');
                    }

                    ?>
                    <div class="col-12 col-sm-6 py-2">
                        <p class="text-center text-sm-left">Última atualização feita em: <span class="font-weight-bold"><?=$data?></span></p>
                    </div>

                    <div class="col-12 col-sm-6 py-2 text-center text-sm-right">
                        <a data-toggle="modal" data-target="#editar-dados" class="btn px-2 py-2 botao-editar text-white font-weight-bold">Editar dados <i class="fas fa-edit"></i></a>
                    </div>

                </div>
            </div>

            <!-- Editar dados -->
            <div class="modal fade" id="editar-dados" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center">Editar dados do clube</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form class="" id="formulario-clube" enctype="multipart/form-data" action="../../controller/ClubeController.php" method="post">

                                <div class="form-row">

                                    <!--Ação-->
                                    <input type="hidden" value="1" name="acao"/>

                                    <!--Codigo clube-->
                                    <input type="hidden" value="1" name="codigoClube"/>

                                    <!--Nome-->
                                    <div class="form-group col-12 col-md-6">
                                        <label for="nome">Nome <i class="fas fa-user"></i> *</label>
                                        <input type="text" class="form-control" name="nome" id="nome" value="<?=$clube->nome?>" required>
                                    </div>

                                    <!--Nome abreviado-->
                                    <div class="form-group col-12 col-md-4">
                                        <label for="nome-abreviado">Nome abreviado *</label>
                                        <input type="text" class="form-control" name="nomeAbreviado" id="nome-abreviado" value="<?=$clube->nomeAbreviado?>" required>
                                    </div>

                                    <!--Endereço-->
                                    <div class="form-group col-12 pt-3 border-top m-0">
                                        <h4 class="font-weight-bold text-center">Endereço <i class="fa fa-home"></i> </h4>
                                    </div>

                                    <!--Rua-->
                                    <div class="form-group col-12 col-sm-6 col-md-8">
                                        <label for="rua">Rua *</label>
                                        <input type="text" id="rua" name="rua" class="form-control" value="<?=$clube->rua?>" required>
                                    </div>

                                    <!--Número-->
                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                        <label for="numero">Nº</label>
                                        <input type="text" id="numero" name="numero" class="form-control" value="<?=$clube->numero?>">
                                    </div>

                                    <!--Cidade-->
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="cidade">Cidade *</label>
                                        <input type="text" id="cidade" name="cidade" class="form-control" value="<?=$clube->cidade?>" required>
                                    </div>

                                    <!--UF-->
                                    <div class="form-group col-12 col-sm-3">
                                        <label for="uf">UF *</label>
                                        <input type="text" id="uf" name="uf" class="form-control" value="<?=$clube->uf?>" required>
                                    </div>

                                    <!--CEP-->
                                    <div class="form-group col-12 col-sm-3">
                                        <label for="cep">CEP *</label>
                                        <input type="text" id="cep" name="cep" class="form-control" value="<?=$clube->cep?>" required>
                                    </div>

                                    <!--CNPJ-->
                                    <div class="form-group col-12">
                                        <label for="cnpj">CNPJ *</label>
                                        <input type="text" id="cnpj" name="cnpj" class="form-control" value="<?=$clube->cnpj?>" required>
                                    </div>

                                    <!--E-mail-->
                                    <div class="form-group col-12">
                                        <label for="email">E-mail *</label>
                                        <input type="text" id="email" name="email" class="form-control" value="<?=$clube->email?>" required>
                                    </div>

                                    <!--Telefone-->
                                    <div class="form-group col-12">
                                        <label for="telefone">Telefone *</label>
                                        <input type="text" id="telefone" name="telefone" class="form-control" value="<?=$clube->telefone?>" required>
                                    </div>

                                    <!--Redes sociais-->
                                    <div class="form-group col-12 pt-3 border-top m-0">
                                        <h4 class="font-weight-bold text-center">Redes sociais <i class="fas fa-users"></i></h4>
                                    </div>

                                    <!--Facebook-->
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="facebookLink">Link do Facebook <i class="fab fa-facebook"></i> </label>
                                        <input type="text" id="facebookLink" name="facebookLink" class="form-control" value="<?=$clube->facebookLink?>">
                                    </div>

                                    <!--Instagram-->
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="instagramLink">Link do Instagram <i class="fab fa-instagram"></i></label>
                                        <input type="text" id="instagramLink" name="instagramLink" class="form-control" value="<?=$clube->instagramLink?>">
                                    </div>

                                    <!--Twitter-->
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="twitterLink">Link do Twitter <i class="fab fa-twitter-square"></i></label>
                                        <input type="text" id="twitterLink" name="twitterLink" class="form-control" value="<?=$clube->twitterLink?>">
                                    </div>

                                    <!--Youtube-->
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="youtubeLink">Link do YouTube <i class="fab fa-youtube"></i></label>
                                        <input type="text" id="youtubeLink" name="youtubeLink" class="form-control" value="<?=$clube->youtubeLink?>">
                                    </div>

                                    <!--Google Plus-->
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="googlePlusLink">Link do Google Plus <i class="fab fa-google-plus-square"></i> </label>
                                        <input type="text" id="googlePlusLink" name="googlePlusLink" class="form-control" value="<?=$clube->googlePlusLink?>">
                                    </div>




                                    <div class="form-group col-12">
                                        <p class="font-weight-bold">Logo</p>

                                        <p><a href="../img/<?=$clube->logo?>" target="_blank">Ver logo atual</a></p>

                                        <input type="file" class="form-control-file logo-clube d-none" name="logo-clube" id="logoClube" accept="image/*">
                                        <button type="button" class="input-label input-label-clube"><span class="label-span">Selecionar logo</span> <i class="fas fa-upload"></i></button>
                                        <span class="custom-text-clube">Nenhum arquivo selecionado </span>
                                        <a class="reset-input reset-input-clube d-none"><i class="fas fa fa-times-circle"></i></a>
                                    </div>


                                </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                            <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-clube">Salvar <i class="far fa-save"></i></button>
                        </div>
                        </form>
                    </div>
                </div>
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
	<script src="../js/jquery.mask.js"></script>
	<script src="../js/jquery.validate.js"></script>
	<script src="../js/additional-methods.js"></script>
	<script src="../js/moduloGestao/clube-gestao.js"></script>


</html>