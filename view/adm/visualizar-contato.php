<?php
require_once '../../model/UsuarioModel.php';
require_once '../../model/ContatoModel.php';
$usuario = new UsuarioModel();
$contato = new ContatoModel();

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

if (!empty($_GET['contato'])){
    $codigoContato = $_GET['contato'];
    $contatoAtual = $contato->selectContato($codigoContato);

    if ($contatoAtual->visualizado == 'false'){
        $contato->updateContato($codigoContato);
    }

}else{
    header('Location:home.php');
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
    <title>Módulo de Gestão - Contato</title>

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

            <h1 class="font-weight-bold text-center col-12 my-4">Visualizar Contato <i class="fas fa-eye"></i></h1>

            <div class="col-12 col-md-9">

                <table class="table dados table-sm table-responsive-sm">
                    <tr>
                        <td class="font-weight-bold">Data de contatação:</td>
                        <td class="text-right"><?php $data = new DateTime($contatoAtual->dataContatacao); echo $data->format('d/m/Y')?></td>
                    </tr>

                    <tr>
                        <td class="font-weight-bold">Nome:</td>
                        <td class="text-right"><?=$contatoAtual->nome?></td>
                    </tr>

                    <tr>
                        <td class="font-weight-bold">Telefone:</td>
                        <td class="text-right"><?=$contatoAtual->telefone?></td>
                    </tr>

                    <tr>
                        <?php
                            if ($contatoAtual->email == null){
                                $email = 'E-mail não informado';
                            }else{
                                $email = $contatoAtual->email;
                            }
                        ?>

                        <td class="font-weight-bold">E-mail:</td>
                        <td class="text-right"><?=$email?></td>
                    </tr>

                    <tr>
                        <?php
                        if ($contatoAtual->isVoluntario == 1){
                            $isVoluntario = 'Sim';
                        }else{
                            $isVoluntario = 'Não';
                        }
                        ?>

                        <td class="font-weight-bold">Deseja ser voluntário:</td>
                        <td class="text-right"><?=$isVoluntario?></td>
                    </tr>

                    <tr>
                        <?php
                        if ($contatoAtual->isDesejaAssociarse == 1){
                            $isDesejaAssociarse = 'Sim';
                        }else{
                            $isDesejaAssociarse = 'Não';
                        }
                        ?>

                        <td class="font-weight-bold">Deseja ser sócio:</td>
                        <td class="text-right"><?=$isDesejaAssociarse?></td>
                    </tr>

                    <tr>
                        <?php
                        if ($contatoAtual->mensagem == null){
                            $mensagem = 'Não foi deixada mensagem';
                        }else{
                            $mensagem = $contatoAtual->mensagem;
                        }
                        ?>

                        <td class="font-weight-bold">Mensagem:</td>
                        <td class="pl-5 text-justify"><?=$mensagem?></td>
                    </tr>

                    <tr class="">
                        <?php
                        if ($contatoAtual->curriculo == null){
                            $curriculo = 'Não foi anexado nenhum documento';
                        }else{
                            $curriculo = "<a href='../curriculos/$contatoAtual->curriculo' target='_blank'>$contatoAtual->curriculo</a>";
                        }
                        ?>

                        <td class="font-weight-bold pt-3">Curriculo:</td>
                        <td class="pl-5 text-right pt-3"><?=$curriculo?></td>
                    </tr>

                </table>

            </div>

        </div>

        <div class="row justify-content-center border-top mt-4 pt-2">
            <div class="col-8 col-sm-6 col-md-4 col-lg-2">
                <a href="contatos-gestao.php" class="botao-excluir font-weight-bold btn btn-block px-2 py-2 text-white"><i class="fas fa-long-arrow-alt-left"></i> Voltar</a>
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
<script src="../js/moduloGestao/contatos-gestao.js"></script>


</html>
