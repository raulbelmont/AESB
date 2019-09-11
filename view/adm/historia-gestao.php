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

?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloGestao/historia-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - História</title>

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
            <h1 class="font-weight-bold text-center my-5 pb-5 col-12 border-bottom">História <i class="fas fa-book-open"></i></h1>
        </div>

        <!--Mensagens-->
        <div class="row justify-content-center">
            <div class="col-10 col-md-8">
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
                <?php } $_SESSION['excluiu'] = null; ?>

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

        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-8">
                <table class="table table-bordered table-hover table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Tipo</th>
                        <th>Título</th>
                        <th>Última atualização</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($historia->selectAll() as $key => $value):

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
                        if ($value->tipo == 1){
                            $tipo = 'História';
                        }
                        if ($value->tipo == 2){
                            $tipo = 'Fundação';
                        }
                        if ($value->tipo == 3){
                            $tipo = 'Presidentes';
                        }
                        if ($value->tipo == 4){
                            $tipo = 'Hino e Símbolos';
                        }
                        if ($value->tipo == 5){
                            $tipo = 'Galeria de Troféus';
                        }
                        if ($value->tipo == 6){
                            $tipo = 'Ídolos';
                        }
                        if ($value->tipo == 7){
                            $tipo = 'Estatuto Social';
                        }

                        /*Definindo última atualização*/
                        if ($value->ultimaAtualizacao == null){
                            $ultimaAtualizacao = '-';
                        }else{
                            $data = new DateTime($value->ultimaAtualizacao);
                            $ultimaAtualizacao = $data->format('d/m/Y H:i');
                        }




                        ?>
                        <tr>
                            <td class="font-weight-bold"><?=$tipo?></td>
                            <td><?=$value->titulo?></td>
                            <td class="text-center"><?=$ultimaAtualizacao?></td>
                            <td class="text-center">
                                <a href="visualizar-historia.php?historia=<?=$value->codigoHistoria?>" class="btn px-2 py-0 botao-inserir text-white font-weight-bold">Visualizar <i class="fas fa-eye"></i></a>
                                <a href="editar-historia.php?historia=<?=$value->codigoHistoria?>" class="btn px-2 py-0 mb-1 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
<script src="../js/moduloGestao/historia-gestao.js"></script>


</html>