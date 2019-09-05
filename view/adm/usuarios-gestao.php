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
/*excluir usuário*/
if (!empty($_GET['excluir'])){
    $_SESSION['excluirUsuario'] = $_GET['excluir'];
    header('location:../../controller/UsuarioController.php?acao=2');
}

?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/moduloGestao/usuarios-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Usuários </title>

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
        <div class="row border-bottom mb-2">
            <h1 class="font-weight-bold text-center my-5 col-12">Usuários <i class="fas fa-users"></i></h1>
        </div>

        <!--Mensagens-->
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <!--Mensagens a respeito do salvamento de noticias-->
                <?php if (isset($_SESSION['salvou']) and $_SESSION['salvou'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Sucesso ao salvar!</h5>
                    </div>
                <?php } $_SESSION['salvou'] = null; ?>

                <?php if (isset($_SESSION['salvou']) and $_SESSION['salvou'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao salvar!</h5>
                    </div>
                <?php } $_SESSION['salvou'] = null;?>

                <!--Mensagens de Exclusão-->
                <?php if (isset($_SESSION['excluiu']) and $_SESSION['excluiu'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Exclusão realizada com sucesso!</h5>
                    </div>
                <?php } $_SESSION['excluiu'] = null;?>

                <?php if (isset($_SESSION['excluiu']) and $_SESSION['excluiu'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao excluir!</h5>
                    </div>
                <?php } $_SESSION['excluiu'] = null;?>

                <!--Mensagem de Edição-->
                <?php if (isset($_SESSION['editou']) and $_SESSION['editou'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Alterações salvas com sucesso!</h5>
                    </div>
                <?php } $_SESSION['editou'] = null; ?>

                <?php if (isset($_SESSION['editou']) and $_SESSION['editou'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao salvar as alterações</h5>
                    </div>
                <?php } $_SESSION['editou'] = null;?>
            </div>
        </div>

        <!--Sessão para usuários que não tem permissão de edição-->
        <?php if ($_SESSION['nivel'] != 1){ ?>

                <div class="row justify-content-center">
                    <h4 class="col-12 text-center font-weight-bold text-danger"><span class="nome-usuario"><?=$_SESSION['nome']?>, </span>você não tem permissão para manipular dados de outros usuários <i class="fas fa-exclamation-triangle"></i> <i class="far fa-frown"></i></h4>

                    <a href="meu-perfil.php" class="font-weight-bold text-white botao-inserir col-3 text-center p-3 text-uppercase my-4">Editar meu perfil <i class="fas fa-user-edit"></i></a>

                </div>

        <!--Sessão para usuários master-->
        <?php }else{ ?>

            <!--Tabela de usuarios-->
            <div class="row justify-content-center">
                <h4 class="col-12 text-center font-weight-bold">Olá, <span class="nome-usuario"> <?=$_SESSION['nome']?>, </span>aqui você pode gerenciar os outros usuários.</h4>

                <!--USUARIOS-->
                <div class="col-11 col-md-8 mb-5 pb-3 border">
                    <a class="btn p-2 m-2 botao-inserir text-white font-weight-bold" data-toggle="modal" data-target="#modal-inserir">Inserir novo <i class="fas fa-user-plus"></i></a>

                    <table class="table table-bordered table-sm table-responsive-sm">
                        <thead class="thead-dark">
                        <tr class="p-0 m-0">
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Nível</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($usuario->selectAll() as $key => $value):
                            if ($value->nivel == 1){
                                $nivel = 'Administrador';
                            }else{
                                $nivel = 'Usuário comum';
                            }
                        ?>
                            <tr>
                                <td><?=$value->nome?></td>
                                <td><?=$value->email?></td>
                                <td><?=$nivel?></td>
                                <td class="text-center">
                                    <a href="editar-usuario.php?usuario=<?=$value->codigoUsuario?>" class="btn px-2 py-0 botao-editar text-white font-weight-bold">Editar <i class="fas fa-user-cog"></i></a>
                                    <a data-toggle="modal" data-target="#modal-excluir<?=$value->codigoUsuario?>" class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-user-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>



            <!--Modal de excluir usuário-->
            <div class="row">
                <div class="col-12">

                    <?php foreach ($usuario->selectAll() as $key => $value):?>
                    <!-- Modal -->
                    <div class="modal fade" id="modal-excluir<?=$value->codigoUsuario?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="text-danger font-weight-bold" id="exampleModalLabel">Você tem certeza que deseja excluir esse usuário?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fa fa-times-circle"></i></button>
                                    <a  href="?excluir=<?=$value->codigoUsuario?>" type="button" class="btn botao-inserir font-weight-bold text-white">Excluir <i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>


                </div>
            </div>

            <!--Modal de inserir usuário-->
            <div class="row">
                <div class="col-12">
                    <!-- Modal -->
                    <div class="modal fade" id="modal-inserir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="font-weight-bold">Inserir novo <i class="fas fa-user-plus"></i></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="inserir-usuario" enctype="multipart/form-data" action="../../controller/UsuarioController.php" method="post">

                                        <div class="form-row">
                                            <input type="hidden" name="acao" value="1">

                                            <!--Nome-->
                                            <div class="form-group col-12">
                                                <label for="nome" class="font-weight-bold"><i class="far fa-user"></i> Nome </label>
                                                <input id="nome" name="nome" class="form-control mb-2" type="text" placeholder="Nome" required>
                                            </div>

                                            <!--Email-->
                                            <div class="form-group col-12">
                                                <label for="email" class="font-weight-bold"><i class="fas fa-envelope"></i> E-mail </label>
                                                <input id="email" name="email" class="form-control mb-2" type="text" placeholder="exemplo@email.com" required>
                                            </div>

                                            <!--Nível-->
                                            <div class="form-group col-12">
                                                <label for="nivel" class="select-insert font-weight-bold">Escolha o tipo de usuário</label>
                                                <select name="nivel" id="select-insert" class="d-block form-control" autocomplete="off" required>
                                                    <option value="0" selected>Selecione...</option>
                                                    <option value="1">Administrador</option>
                                                    <option value="0">Usuário Comum</option>
                                                </select>
                                            </div>

                                            <!--Escolha uma senha-->
                                            <div id="novaSenhaDiv" class="form-group col-12">
                                                <label for="novaSenha" class="font-weight-bold"><i class="fas fa-key"></i> Escolha uma senha </label>
                                                <input id="novaSenha" name="novaSenha" class="form-control mb-2" type="password" placeholder="" required>
                                            </div>

                                            <!--Digite novamente-->
                                            <div id="novaSenhaConfirmaDiv" class="form-group col-12">
                                                <label for="novaSenhaConfirma" class="font-weight-bold"><i class="fas fa-key"></i> Digite novamente</label>
                                                <input id="novaSenhaConfirma" name="novaSenhaConfirmad" class="form-control mb-2" type="password" placeholder="" required>
                                            </div>

                                            <!--Mensagens sobre a senha-->
                                            <div class="form-group col-12">
                                                <p id="msg-senhas-diferentes" class="text-danger m-0 d-none">As senhas são diferentes <i class="fas fa-exclamation-circle"></i></p>
                                                <p id="msg-senhas-iguais" class="text-success m-0 d-none">Senhas iguais <i class="fas fa-check"></i></p>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button id="limpar-form" type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fa fa-times-circle"></i></button>
                                            <button id="salvar" type="submit" class="btn botao-inserir font-weight-bold text-white d-none">Salvar <i class="far fa-save"></i></button>
                                            <a id="salvar-disabled" type="submit" class="btn botao-inserir disabled font-weight-bold text-white">Salvar <i class="far fa-save"></i></a>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php } ?>

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
<script src="../js/moduloGestao/usuarios-gestao.js"></script>


</html>