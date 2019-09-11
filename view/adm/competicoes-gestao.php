<?php
require_once '../../model/UsuarioModel.php';
require_once '../../model/CompeticoesModel.php';
$usuario = new UsuarioModel();
$competicoes = new CompeticoesModel();

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
/*excluir competicao*/
if (!empty($_GET['excluir'])){
    $_SESSION['excluir'] = $_GET['excluir'];
    header('location:../../controller/CompeticoesController.php?acao=2');
}
?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloGestao/competicoes-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Competições </title>

</head>

<body>

<header>
    <?php
    include '../inc/moduloGestao/incMenuGestao.php';
    ?>

</header>

<main>
    <div class="container-fluid">

        <!--Competições-->
        <div class="row justify-content-center">
            <h1 class="font-weight-bold text-center my-5 col-12">Competições <i class="fas fa-medal"></i></h1>
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

        <!--Tabela de competições-->
        <div class="row justify-content-center">
            <!--Competições-->
            <div class="col-11 col-md-10 mb-5 pb-3 border">
                <a class="btn p-2 m-2 botao-inserir text-white font-weight-bold" data-toggle="modal" data-target="#modal-inserir">Inserir novo <i class="fas fa-plus-circle"></i></a>

                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Data de Cadastro</th>
                        <th>Nome</th>
                        <th>Fase atual</th>
                        <th>Stuação do Clube</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($competicoes->selectByData() as $key => $value):
                        $data = new DateTime($value->dataPublicacao);

                        ?>
                        <tr>
                            <td><?php echo $data->format('d/m/Y H:i');?></td>
                            <td><?=$value->nome?></td>
                            <td><?=$value->faseAtual?></td>
                            <td><?=$value->situacaoClube?></td>
                            <td class="text-center">
                                <a data-toggle="modal" data-target="#modal-visualizar<?=$value->codigoCompeticao?>" class="btn px-2 py-0 botao-inserir text-white font-weight-bold">Visualizar <i class="fas fa-eye"></i></a>
                                <a data-toggle="modal" data-target="#modal-editar<?=$value->codigoCompeticao?>" class="btn px-2 py-0 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                                <a data-toggle="modal" data-target="#modal-excluir<?=$value->codigoCompeticao?>" class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--Modal de visualizar competição-->
        <div class="row">
            <div class="col-12">

                <?php foreach ($competicoes->selectByData() as $key => $value):?>
                    <!-- Modal -->
                    <div class="modal fade" id="modal-visualizar<?=$value->codigoCompeticao?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="font-weight-bold"><?=$value->nome?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <!--Fase atual-->
                                        <div class="col-12 col-sm-6">

                                            <div class="card mb-3">
                                                <div class="card-header text-center p-0"><h5 class="my-2 card-title font-weight-bold text-uppercase">Fase Atual</h5></div>
                                                <div class="card-body py-2">

                                                    <p class="card-text text-uppercase text-center"><?=$value->faseAtual?></p>
                                                </div>
                                            </div>

                                        </div>

                                        <!--Situação do Clube-->
                                        <div class="col-12 col-sm-6">

                                            <div class="card mb-3">
                                                <div class="card-header text-center p-0"><h5 class="my-2 card-title font-weight-bold text-uppercase">Situação do Clube</h5></div>
                                                <div class="card-body py-2">

                                                    <p class="card-text text-uppercase text-center"><?=$value->situacaoClube?></p>

                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <!--Regras-->
                                    <label for="regras-competicao" class="font-weight-bold text-uppercase mx-2">Regras</label>
                                    <div class="regras-competicao row m-2 p-4 justify-content-center d-block">
                                        <?=$value->regras?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>

        <!--Modal de excluir competição-->
        <div class="row">
            <div class="col-12">

                <?php foreach ($competicoes->selectAll() as $key => $value):?>
                    <!-- Modal -->
                    <div class="modal fade" id="modal-excluir<?=$value->codigoCompeticao?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="text-danger font-weight-bold" id="exampleModalLabel">Você tem certeza que deseja excluir essa competição?</h5>
                                    <h6>Ao excluir uma competição todos os jogos associados a ela também serão excluídos!</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fa fa-times-circle"></i></button>
                                    <a  href="?excluir=<?=$value->codigoCompeticao?>" type="button" class="btn botao-inserir font-weight-bold text-white">Excluir <i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>

        <!--Modal de inserir competição-->
        <div class="row">
            <div class="col-12">

                    <!-- Modal -->
                    <div class="modal fade" id="modal-inserir" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="font-weight-bold">Inserir competição <i class="fas fa-plus-circle"></i> <i class="fas fa-medal"></i></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="form-inserir" enctype="multipart/form-data" method="post" action="../../controller/CompeticoesController.php">

                                        <div class="form-row justify-content-center">

                                            <!--Ação-->
                                            <input type="hidden" name="acao" value="1">

                                            <!--Nome-->
                                            <div class="form-group col-12 col-md-8">
                                                <label for="nome" class="font-weight-bold">Competição</label>
                                                <input type="text" class="form-control" name="nome" id="nome" required>
                                            </div>

                                            <!--Fase Atual-->
                                            <div class="form-group col-12 col-md-8">
                                                <label for="faseAtual" class="font-weight-bold">Fase Atual</label>
                                                <input type="text" class="form-control" name="faseAtual" id="faseAtual" required>
                                            </div>

                                            <!--Situação do clube-->
                                            <div class="form-group col-12 col-md-8">
                                                <label for="situacaoClube" class="font-weight-bold">Situação atual do clube na competição</label>
                                                <input type="text" class="form-control" name="situacaoClube" id="situacaoClube" required>
                                            </div>

                                            <!--Regras-->
                                            <div class="form-group col-12">
                                                <label for="regras" class="font-weight-bold col-form-label-lg col-12 text-center">Regras</label>
                                                <textarea id="regras" name="regras" class="form-control m-auto regras"></textarea>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button id="limpar-form" type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fa fa-times-circle"></i></button>
                                            <button id="salvar" type="submit" class="btn botao-inserir font-weight-bold text-white">Salvar <i class="far fa-save"></i></button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>


            </div>
        </div>

        <!--Modal de editar competição-->
        <div class="row">
            <div class="col-12">

                <?php foreach ($competicoes->selectAll() as $key => $value): ?>
                <!-- Modal -->
                <div class="modal fade" id="modal-editar<?=$value->codigoCompeticao?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="font-weight-bold">Editar competição <i class="fas fa-edit"></i> <i class="fas fa-medal"></i></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form id="form-editar<?=$value->codigoCompeticao?>" enctype="multipart/form-data" method="post" action="../../controller/CompeticoesController.php">

                                    <div class="form-row justify-content-center">

                                        <!--Ação-->
                                        <input type="hidden" name="acao" value="3">

                                        <!--Código Competição-->
                                        <input type="hidden" name="codigoCompeticao" value="<?=$value->codigoCompeticao?>">

                                        <!--Nome-->
                                        <div class="form-group col-12 col-md-8">
                                            <label for="nome" class="font-weight-bold">Competição</label>
                                            <input type="text" class="form-control" name="nome" id="nome" value="<?=$value->nome?>" required>
                                        </div>

                                        <!--Fase Atual-->
                                        <div class="form-group col-12 col-md-8">
                                            <label for="faseAtual" class="font-weight-bold">Fase Atual</label>
                                            <input type="text" class="form-control" name="faseAtual" id="faseAtual" value="<?=$value->faseAtual?>" required>
                                        </div>

                                        <!--Situação do clube-->
                                        <div class="form-group col-12 col-md-8">
                                            <label for="situacaoClube" class="font-weight-bold">Situação atual do clube na competição</label>
                                            <input type="text" class="form-control" name="situacaoClube" id="situacaoClube" value="<?=$value->situacaoClube?> " required>
                                        </div>

                                        <!--Regras-->
                                        <div class="form-group col-12">
                                            <label for="regras" class="font-weight-bold col-form-label-lg col-12 text-center">Regras</label>
                                            <textarea id="regras" name="regras" class="form-control m-auto regras"><?=$value->regras?></textarea>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fa fa-times-circle"></i></button>
                                        <button id="salvar<?=$value->codigoCompeticao?>" type="submit" class="btn botao-inserir font-weight-bold text-white">Salvar <i class="far fa-save"></i></button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

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
<script src="../js/moduloGestao/competicoes-gestao.js"></script>


</html>