<?php
require_once '../../model/UsuarioModel.php';
require_once '../../model/ParceirosGestaoModel.php';
$usuario = new UsuarioModel();
$parceiro = new ParceirosGestaoModel();

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

/*Excluindo parceiro*/
if (!empty($_GET['acao']) and $_GET['acao'] == 2){
    $_SESSION['excluir'] = $_GET['excluir'];
    header('location:../../controller/ParceirosController.php?acao=2');
}
 


?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloGestao/parceiros-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Parceiros</title>

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
            <h1 class="font-weight-bold text-center my-5 col-12 border-bottom">Parceiros  <i class="fa fa-handshake"></i></h1>

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

            <!--PATROCINADORES-->
            <div class="col-11 col-md-8 mb-5 pb-3 border">

                <h4 class="text-center font-weight-bold">Patrocinadores </h4>
                <a class="btn p-2 m-2 botao-inserir text-white font-weight-bold" data-toggle="modal" data-target="#novo-patrocinador">Inserir novo <i class="fas fa-plus-circle"></i></a>

                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Nome do patrocinados</th>
                        <th>Logo do patrocinador</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($parceiro->selectParceiros(1) as $key => $value): ?>
                    <tr>
                        <td><?=$value->nomeParceiro?></td>
                        <td><a href="../img/patrocinadores/<?=$value->logoParceiro?>" target="_blank"><?=$value->logoParceiro?></a></td>
                        <td class="text-center">
                            <a data-toggle="modal" data-target="#editarParceiro<?=$value->codigoParceiro?>" class="btn px-2 py-0 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                            <a href="?acao=2&excluir=<?=$value->codigoParceiro?>"   class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>

            <!--APOIADORES-->
            <div class="col-11 col-md-8 mb-5 pb-3 border">

                <h4 class="text-center font-weight-bold">Apoiadores</h4>
               
                <a class="btn p-2 m-2 botao-inserir text-white font-weight-bold" data-toggle="modal" data-target="#novo-apoiador">Inserir novo <i class="fas fa-plus-circle"></i></a>

                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Nome do apoiador</th>
                        <th>Logo do apoiador</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($parceiro->selectParceiros(2) as $key => $value): ?>
                        <tr>
                            <td><?=$value->nomeParceiro?></td>
                            <td><a href="../img/patrocinadores/<?=$value->logoParceiro?>" target="_blank"><?=$value->logoParceiro?></a></td>
                            <td class="text-center">
                                <a data-toggle="modal" data-target="#editarParceiro<?=$value->codigoParceiro?>" class="btn px-2 py-0 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                                <a href="?acao=2&excluir=<?=$value->codigoParceiro?>"   class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>

            <!-- FORNECEDORES OFICIAIS
            <div class="col-11 col-md-8 mb-5 pb-3 border">

                <h4 class="text-center font-weight-bold">Fornecedores Oficiais</h4>
                <p class="text-muted">Obs.: Somente os 9 últimos adicionados aparecerão no site por uma questão de layout.</p>
                <a class="btn p-2 m-2 botao-inserir text-white font-weight-bold" data-toggle="modal" data-target="#novo-fornecedor">Inserir novo <i class="fas fa-plus-circle"></i></a>

                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Nome do fornecedor</th>
                        <th>Logo do fornecedor</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Nome</td>
                        <td>Logo</td>
                        <td class="text-center">
                            <a class="btn px-2 py-0 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                            <a class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div> -->

            <!--MODAL DE INSERIR NOVO PATROCINADOR-->
            <div class="col-12">

                <!-- Modal -->
                <div class="modal fade" id="novo-patrocinador" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center">Inserir novo patrocinador</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form class="" id="formulario-patrocinador" enctype="multipart/form-data" action="../../controller/ParceirosController.php" method="post">

                                    <div class="form-row">
                                        <input type="hidden" value="1" name="tipo"/>
                                        <div class="col-12">
                                            <div class="form-group">

                                                <label for="nomePatrocinador">Nome do patrocinador <i class="fas fa-user"></i> *</label>
                                                <input type="text" class="form-control" name="nomePatrocinador" id="nomePatrocinador" placeholder="Nome">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <p class="font-weight-bold">Logo do patrocinador *</p>
                                                <input type="file" class="form-control-file logo-patrocinador" name="logoPatrocinador" id="logoPatrocinador" accept="image/*" required>
                                                <button type="button" class="input-label input-label-patrocinador"><span class="label-span">Selecionar logo</span> <i class="fas fa-upload"></i></button>
                                                <span class="custom-text-patrocinador">Nenhum arquivo selecionado </span>
                                                <a class="reset-input reset-input-patrocinador d-none"><i class="fas fa fa-times-circle"></i></a>
                                            </div>
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                                <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-patrocinador">Salvar <i class="far fa-save"></i></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!--MODAL DE INSERIR NOVO APOIADOR-->
            <div class="col-12">

                <!-- Modal -->
                <div class="modal fade" id="novo-apoiador" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center">Inserir novo apoiador</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form class="" id="formulario-apoiador" enctype="multipart/form-data" action="../../controller/ParceirosController.php" method="post">

                                    <div class="form-row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="hidden" value="2" name="tipo"/>
                                                <label for="nomeApoiador">Nome do apoiador <i class="fas fa-user"></i> *</label>
                                                <input type="text" class="form-control" name="nomeApoiador" id="nomeApoiador" placeholder="Nome">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <p class="font-weight-bold">Logo do apoiador *</p>
                                                <input type="file" class="form-control-file logo-apoiador" name="logoApoiadores" id="logoApoiadores" accept="image/*" required>
                                                <button type="button" class="input-label input-label-apoador"><span class="label-span">Selecionar logo</span> <i class="fas fa-upload"></i></button>
                                                <span class="custom-text-apoiador">Nenhum arquivo selecionado </span>
                                                <a class="reset-input reset-input-apoiador d-none"><i class="fas fa fa-times-circle"></i></a>
                                            </div>
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                                <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-apoiador">Salvar <i class="far fa-save"></i></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!--MODAL DE INSERIR NOVO FORNECEDOR-->
            <!-- <div class="col-12"> 

                
                <div class="modal fade" id="novo-fornecedor" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center">Inserir novo fornecedor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form class="" id="formulario-fornecedor" enctype="multipart/form-data" action="../../controller/ParceirosGestaoController.php" method="post">

                                    <div class="form-row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="hidden" value="3" name="tipo"/>
                                                <label for="nomeFornecedor">Nome do fornecedor <i class="fas fa-user"></i> *</label>
                                                <input type="text" class="form-control" name="nomeFornecedor" id="nomeFornecedor" placeholder="Nome">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <p class="font-weight-bold">Logo do fornecedor *</p>
                                                <input type="file" class="form-control-file logo-fornecedor" name="logoFornecedores" id="logoFornecedor" accept="image/*" required>
                                                <button type="button" class="input-label input-label-fornecedor"><span class="label-span">Selecionar logo</span> <i class="fas fa-upload"></i></button>
                                                <span class="custom-text-fornecedor">Nenhum arquivo selecionado </span>
                                                <a class="reset-input reset-input-fornecedor d-none"><i class="fas fa fa-times-circle"></i></a>
                                            </div>
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                                <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-fornecedor">Salvar <i class="far fa-save"></i></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div> -->

        </div>

        <!--Modal de editar parceiro-->
        <div class="row">
            <div class="col-12">
                <!-- Modal -->
                <?php foreach ($parceiro->selectAll() as $key => $value):

                    if ($value->tipo == 1){
                        $cabecalho = 'Patrocinador';
                        $imagem = 'patrocinadores/'.$value->logoParceiro;
                    }
                    if ($value->tipo == 2){
                        $cabecalho = 'Apoiador';
                        $imagem = 'apoiadores/'.$value->logoParceiro;
                    }

                ?>
                <div class="modal fade" id="editarParceiro<?=$value->codigoParceiro?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center">Editar - <?=$cabecalho?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form class="" id="formulario-parceiro<?=$value->codigoParceiro?>" enctype="multipart/form-data" action="../../controller/ParceirosController.php" method="POST">

                                    <div class="form-row justify-content-center">

                                        <input type="hidden" name="acao" value="3">
                                        <input type="hidden" name="tipoParceiro" value="<?=$value->tipo?>">
                                        <input type="hidden" name="codigoParceiro" value="<?=$value->codigoParceiro?>">



                                        <div class="form-group col-12 border-bottom pb-3">
                                            <label for="nomeApoiador">Nome do apoiador <i class="fas fa-user"></i> *</label>
                                            <input type="text" class="form-control" name="nome" id="nomeApoiador" value="<?=$value->nomeParceiro?>" placeholder="Nome">
                                        </div>

                                        <div class="form-group col-12 col-sm-10 col-md-8 col-lg-6 my-2 py-2">
                                            <p class="text-center font-weight-bold">Imagem atual</p>
                                            <img src="../img/<?=$imagem?>" class="img-thumbnail">
                                        </div>


                                        <div class="form-group col-12 border-top inputff">
                                            <p class="font-weight-bold">Logo</p>
                                            <input type="file" class="form-control-file logo-editar d-none" name="logo" id="logoApoiadores" accept="image/*" >
                                            <button type="button" class="input-label input-label-editar"><span class="label-span">Selecionar logo</span> <i class="fas fa-upload"></i></button>
                                            <span class="custom-text-editar">Nenhum arquivo selecionado </span>
                                            <a class="reset-input reset-input-editar d-none"><i class="fas fa fa-times-circle"></i></a>
                                        </div>

                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                                <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-editar<?=$value->codigoParceiro?>">Salvar <i class="far fa-save"></i></button>
                            </div>
                            </form>
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
<script src="../js/jquery.mask.js"></script>
<script src="../js/jquery.validate.js"></script>
<script src="../js/additional-methods.js"></script>
<script src="../js/moduloGestao/parceiros-gestao.js"></script>


</html>