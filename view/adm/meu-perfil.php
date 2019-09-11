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
if (!empty($_GET['excluir']) and $_GET['excluir'] == 1){
    $usuario->deletarUsuario($_SESSION['codigoUsuario']);
}
?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/moduloGestao/meu-perfil.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Meu Perfil</title>

</head>

<body>

<header>
    <?php
    include '../inc/moduloGestao/incMenuGestao.php';
    ?>

</header>


<main>

    <div class="container-fluid">
       <!--título-->
        <div class="row">
            <h1 class="font-weight-bold text-center my-5 col-12 border-bottom pb-2">Meu Perfil <i class="fas fa-user"></i></h1>
        </div>

        <!--mensagens-->
        <div class="row justify-content-center">
            <!--Mensagem de Edição-->
            <?php if (isset($_SESSION['editou']) and $_SESSION['editou'] == true){ ?>
                <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block col-10">
                    <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                    <h5 class="text-success font-weight-bold">Alterações salvas com sucesso!</h5>
                </div>
            <?php } $_SESSION['editou'] = null; ?>

            <?php if (isset($_SESSION['editou']) and $_SESSION['editou'] == false){ ?>
                <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block col-10">
                    <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                    <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao salvar as alterações</h5>
                </div>
            <?php } $_SESSION['editou'] = null;?>
        </div>

     <!--Dados do Usuário-->
        <div class="row justify-content-center">
            <h3 class="font-weight-bold text-center my-2 col-12">Olá, <span class="nome-usuario"><?=$_SESSION['nome']?>!</span> Gerencie seu perfil aqui <i class="fas fa-user-cog"></i></h3>

            <div class="dados-usuario col-auto p-5">

                <!--Nome-->
                <label for="nome" class="font-weight-bold"><i class="far fa-user"></i> Nome </label>
                <input id="nome" class="form-control mb-2" type="text" placeholder="" value="<?=$_SESSION['nome']?>" readonly>

                <!--Email-->
                <label for="email" class="font-weight-bold"><i class="fas fa-envelope"></i> E-mail </label>
                <input id="email" class="form-control mb-2" type="text" placeholder="" value="<?=$_SESSION['email']?>" readonly>

                <!--Senha-->
                <label for="senha" class="font-weight-bold"><i class="fas fa-key"></i> Senha  </label>
                <input class="form-control" type="password" placeholder="" value="<?=$_SESSION['senha']?>" readonly>

                <div class="row mt-3">
                    <a href="?sair=true" class="btn px-2 py-0 m-1 botao-inserir text-white font-weight-bold">Sair <i class="fas fa-sign-out-alt"></i></a>
                    <a data-toggle="modal" data-target="#modal-editar" class="btn px-2 py-0 m-1 botao-editar text-white font-weight-bold">Editar <i class="fas fa-user-edit"></i></a>
                    <a data-toggle="modal" data-target="#modal-excluir" class="btn px-2 py-0 m-1 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-user-times"></i></a>
                </div>

            </div>

        </div>
	 
        <!--Modal de excluir-->
        <div class="row">
            <div class="co-12">
                <!-- Modal -->
                <div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 class="text-danger font-weight-bold" id="exampleModalLabel">Você tem certeza que deseja excluir sua conta?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fa fa-times-circle"></i></button>
                                <a  href="?excluir=1" type="button" class="btn botao-inserir font-weight-bold text-white">Excluir <i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal de editar-->
        <div class="row">
            <div class="co-12">
                <!-- Modal -->
                <div class="modal fade" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="font-weight-bold modal-title">Editar dados</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editar-dados-form" enctype="multipart/form-data" method="post" action="../../controller/UsuarioController.php" autocomplete="off">

                                    <div class="form-row">

                                        <input type="hidden" name="acao" value="3">
                                        <input type="hidden" name="codigoUsuario" value="<?=$_SESSION['codigoUsuario']?>">

                                        <!--Nome-->
                                        <div class="form-group col-12">
                                            <label for="nome" class="font-weight-bold"><i class="far fa-user"></i> Nome </label>
                                            <input id="nome" name="nome" class="form-control mb-2" type="text" placeholder="" value="<?=$_SESSION['nome']?>">
                                        </div>

                                        <!--Email-->
                                        <div class="form-group col-12">
                                            <label for="email" class="font-weight-bold"><i class="fas fa-envelope"></i> E-mail </label>
                                            <input id="email" name="email" class="form-control mb-2" type="text" placeholder="" value="<?=$_SESSION['email']?>">
                                        </div>

                                        <!--Desejo mudar senha-->
                                        <div class="form-group col-12 col-md-6">

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="manterSenha" id="manterSenha" value="1">
                                                <label class="form-check-label" for="manterSenha">Manter senha atual</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="manterSenha" id="mudarSenha" value="2">
                                                <label class="form-check-label" for="mudarSenha">Mudar senha</label>
                                            </div>
                                        </div>

                                        <!--Digite sua senha atual-->
                                        <div id="senhaAtualDiva" class="form-group col-12 d-none">
                                            <label for="senhaAtuala" class="font-weight-bold"><i class="fas fa-key"></i> Digite sua senha atual</label>
                                            <input id="senhaAtuala" name="senhaAtuala" class="form-control mb-2" type="password" placeholder="">
                                        </div>

                                        <!--Digite sua senha atual-->
                                        <div id="senhaAtualDiv" class="form-group col-12 d-none">
                                            <label for="senhaAtual" class="font-weight-bold"><i class="fas fa-key"></i> Digite sua senha atual</label>
                                            <p id="msg-senha-atual" class="text-danger font-weight-bold d-none">Senha atual incorreta! Digite novamente. <i class="fas fa-exclamation-circle"></i></p>
                                            <input id="senhaAtual" name="senhaAtual" class="form-control mb-2" type="password" placeholder="">
                                        </div>

                                        <!--Nova senha-->
                                        <div id="novaSenhaDiv" class="form-group col-12 d-none">
                                            <label for="novaSenha" class="font-weight-bold"><i class="fas fa-key"></i> Nova senha </label>
                                            <input id="novaSenha" name="novaSenha" class="form-control mb-2 d-none" type="password" placeholder="">
                                            <input id="novaSenhad" name="novaSenha" class="form-control mb-2" type="password" placeholder="" disabled>
                                        </div>

                                        <!--Digite novamente-->
                                        <div id="novaSenhaConfirmaDiv" class="form-group col-12 d-none">
                                            <label for="novaSenhaConfirma" class="font-weight-bold"><i class="fas fa-key"></i> Digite novamente</label>
                                            <input id="novaSenhaConfirma" name="novaSenhaConfirmad" class="form-control mb-2 d-none" type="password" placeholder="">
                                            <input id="novaSenhaConfirmad" name="novaSenhaConfirmad" class="form-control mb-2" type="password" placeholder="" disabled>
                                        </div>

                                        <div class="form-group col-12">
                                            <p id="msg-senhas-diferentes" class="text-danger m-0 d-none">As senhas são diferentes <i class="fas fa-exclamation-circle"></i></p>
                                            <p id="msg-senhas-iguais" class="text-success m-0 d-none">Senhas iguais <i class="fas fa-check"></i></p>
                                        </div>


                                        <div id="spiner" class="form-group col-12 text-center d-none">
                                            <p><i class="fas fa-sync-alt fa-spin fa-3x fa-fw"> </i></p>
                                        </div>



                                    </div>

                                    <div class="modal-footer">
                                        <button id="limpar-form" type="button" data-dismiss="modal" aria-label="Close" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fa fa-times-circle"></i></button>
                                        <a id="limpar-form-disable" type="button" class="btn botao-excluir font-weight-bold text-white d-none disabled">Cancelar <i class="fa fa-times-circle"></i></a>
                                        <button id="btn-submit" type="submit" class="d-none">submit</button>
                                        <button id="salvar" type="button" class="btn botao-inserir font-weight-bold text-white d-none">Salvar <i class="far fa-save"></i></button>
                                        <a id="salvar-disabled"  class="btn botao-inserir font-weight-bold text-white disabled">Salvar <i class="far fa-save"></i></a>
                                    </div>

                                </form>
                            </div>

                        </div>
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
<script src="../js/moduloGestao/meu-perfil.js"></script>


</html>