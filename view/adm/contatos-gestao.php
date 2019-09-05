<?php
require_once '../../model/UsuarioModel.php';
require_once '../../model/ContatoModel.php';
$usuario = new UsuarioModel();
$contato = new ContatoModel();

/*Validando usuario*/
if (!session_id()) session_start();

  /*deslogando*/
if (!empty($_GET['sair']) == true){
    $usuario->logoff();
}

if ($_SESSION['logado'] == true){
    $usuario->usuarioLogado($_SESSION['usuario']);
}else{
    header('location:home.php');
}

if (!empty($_GET['acao']) == 2){
    $_SESSION['excluir'] = $_GET['excluir'];
    header('location:../../controller/ContatoController.php?acao=2');
}
?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloGestao/contatos-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Contatos</title>

</head>

<body>

<header>
    <?php
    include '../inc/moduloGestao/incMenuGestao.php';
    ?>

</header>

<main>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <h1 class="font-weight-bold text-center my-5 col-12">Contatos <i class="fas fa-phone"></i></h1>

            <!--Novos contatos-->
            <div class="col-11 col-md-8 mb-5 pb-3 border novos-contatos">

                <!--Mensagens de Exclusão-->
                <?php if (isset($_SESSION['excluiu']) and $_SESSION['excluiu'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Contato excluido com sucesso!</h5>
                    </div>
                <?php } $_SESSION['excluiu'] = null; ?>

                <?php if (isset($_SESSION['excluiu']) and $_SESSION['excluiu'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao excluir o contato!</h5>
                    </div>
                <?php } $_SESSION['excluiu'] = null;?>


                <h4 class="text-center font-weight-bold">Novos contatos</h4>

                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Data de contato</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($contato->selectContatos('false') as $key => $value): ?>
                        <tr>
                            <td><?php $data = new DateTime($value->dataContatacao);
                                echo $data->format('d/m/Y H:i'); ?></td>
                            <td><?=$value->nome?></td>
                            <td><?=$value->telefone?></td>
                            <td class="text-center">
                                <a href="visualizar-contato.php?contato=<?=$value->codigoContato?>" class="btn px-2 py-0 botao-inserir text-white font-weight-bold">Visualizar <i class="fas fa-eye"></i></a>
                                <a href="?acao=2&excluir=<?=$value->codigoContato?>" class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>

            <!--Já visualizados-->
            <div class="col-11 col-md-8 mb-5 pb-3 border contatos-visualizados">

                <h4 class="text-center font-weight-bold">Já visualizados</h4>

                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Data de contato</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $cont = count($contato->selectContatos('true') );
                    if ($cont>0){
                    foreach ($contato->selectContatos('true') as $key => $value): ?>
                        <tr>
                            <td><?php $data = new DateTime($value->dataContatacao);
                                echo $data->format('d/m/Y H:i'); ?></td>
                            <td><?=$value->nome?></td>
                            <td><?=$value->telefone?></td>
                            <td class="text-center">
                                <a href="visualizar-contato.php?contato=<?=$value->codigoContato?>" class="btn px-2 py-0 botao-inserir text-white font-weight-bold">Visualizar <i class="fas fa-eye"></i></a>
                                <a href="?acao=2&excluir=<?=$value->codigoContato?>" class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;}else{ ?>
                        <tr>
                           <td colspan="4"> <h5 class="text-danger font-weight-bold my-4 text-center">Nenhum registro foi encontrado!</h5></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
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
<script src="../js/moduloGestao/contatos-gestao.css"></script>


</html>