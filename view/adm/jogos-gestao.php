<?php
require_once '../../model/CompeticoesModel.php';
require_once '../../model/JogosModel.php';
require_once '../../model/UsuarioModel.php';
$competicao = new CompeticoesModel();
$jogo = new JogosModel();
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

/*excluir competicao*/
if (!empty($_GET['excluir'])){
    $_SESSION['excluir'] = $_GET['excluir'];
    header('location:../../controller/JogosController.php?acao=2');
}

?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   <link rel="stylesheet" href="../css/moduloGestao/jogos-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Jogos </title>

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
            <h1 class="font-weight-bold text-center my-5 col-12">Jogos <i class="fa fa-futbol"></i></h1>
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

        <!--Próximo e último jogo -->
        <div class="row justify-content-center mb-5 bg-light ultimo-jogo">

            <?php

            if ($jogo->selectProximoJogo()){
            ?>
            <!--Próximo jogo-->
            <div class="col-12 col-md-6 competicao mb-2 pb-2">
                <?php $proximoJogo = $jogo->selectProximoJogo();
                      $competicaoProximoJogo = $competicao->selectCompeticao($proximoJogo->codigoCompeticao);

                        $data = new DateTime($proximoJogo->dataJogo);
                        $dataJogo = $data->format('d/m/Y');

                        $hora = new DateTime($proximoJogo->horario);
                        $horarioJogo = $hora->format('H:i');
                ?>
                <div class="row justify-content-center">

                    <h4 class="col-12 text-center font-weight-bold mb-4">Próximo jogo</h4>

                    <!--Logo mandante-->
                    <div class="align-self-center d-flex text-center">
                        <h5 class="my-auto mr-2 text-uppercase font-weight-bold"><?=$proximoJogo->mandanteAbreviacao?></h5>
                        <figure>
                            <img class="my-auto img-fluid logo-clube" src="../img/competicoes-e-jogos/<?=$proximoJogo->logoMandante?>">
                        </figure>
                    </div>

                    <!--placar-->
                    <div class="my-auto mx-2">
                        <i class="fas fa-times fa-3x"></i>
                    </div>

                    <!--Logo visitante-->
                    <div class="align-self-center text-center d-flex">
                        <figure>
                            <img class="img-fluid logo-clube" src="../img/competicoes-e-jogos/<?=$proximoJogo->logoVisitante?>">
                        </figure>
                        <h5 class="my-auto ml-2 text-uppercase font-weight-bold"><?=$proximoJogo->visitanteAbreviacao?></h5>
                    </div>

                    <!--Informações da partida-->
                    <div class="align-self-center text-center text-md-left ml-2 p-2">
                        <p class="mb-0 font-weight-bold "><?=$competicaoProximoJogo->nome?></p>
                        <p class="mb-0"><i class="fas fa-calendar-alt"></i> <?=$dataJogo?> às <?=$horarioJogo?></p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt"></i> <?=$proximoJogo->localJogo?></p>
                    </div>


                </div>

                <div class="row justify-content-center mt-4">
                    <a data-toggle="modal" data-target="#modal-editar-placar<?=$proximoJogo->codigoJogo?>" class="text-white font-weight-bold p-2 botao-inserir m-1">Cadastrar placar <i class="fas fa-pen-square"></i></a>
                    <a data-toggle="modal" data-target="#modal-editar-proximoJogo<?=$proximoJogo->codigoJogo?>" class="text-white font-weight-bold py-2 px-4 botao-editar m-1">Editar <i class="fas fa-edit"></i></a>
                    <a data-toggle="modal" data-target="#modal-excluir<?=$proximoJogo->codigoJogo?>" class="text-white font-weight-bold py-2 px-4 botao-excluir m-1">Excluir <i class="fas fa-trash-alt"></i></a>
                </div>

            </div>
            <?php }else{ ?>

                <div class="col-12 col-md-6 text-center p-2">
                    <div class="row justify-content-center">
                        <h4 class="col-12 text-center font-weight-bold">Próximo jogo</h4>
                        <p class="small text-danger col-12 font-weight-bold">Não há um próximo jogo cadastrado no sistema <i class="fas fa-exclamation-circle"></i></p>

                        <button data-toggle="modal" data-target="#modal-inserir-proximo-jogo" class="botao-inserir text-white font-weight-bold py-4 px-1">Cadastrar próximo jogo  <i class="fas fa-plus-circle"></i></button>

                    </div>
                </div>


            <?php }?>

            <?php if ($jogo->selectUltimoJogo()){ ?>
            <!--Último jogo-->
            <div class="col-12 col-md-6">
                    <?php $ultimoJogo = $jogo->selectUltimoJogo();
                    $competicaoUltimoJogo = $competicao->selectCompeticao($ultimoJogo->codigoCompeticao);

                    $data = new DateTime($ultimoJogo->dataJogo);
                    $dataJogo = $data->format('d/m/Y');

                    $hora = new DateTime($ultimoJogo->horario);
                    $horarioJogo = $hora->format('H:i');
                    ?>
                    <div class="row justify-content-center">

                        <h4 class="col-12 text-center font-weight-bold mb-4">Último jogo</h4>

                        <!--Logo mandante-->
                        <div class="align-self-center d-flex text-center">
                            <h5 class="my-auto mr-2 text-uppercase font-weight-bold"><?=$ultimoJogo->mandanteAbreviacao?></h5>
                            <figure>
                                <img class="my-auto img-fluid logo-clube" src="../img/competicoes-e-jogos/<?=$ultimoJogo->logoMandante?>">
                            </figure>
                        </div>

                        <!--placar-->
                        <div class="my-auto mx-1">
                            <h4 class="font-weight-bold"><?=$ultimoJogo->placarMandante?> <i class="fas fa-times"></i> <?=$ultimoJogo->placarVisitante?> </h4>
                        </div>

                        <!--Logo visitante-->
                        <div class="align-self-center text-center d-flex">
                            <figure>
                                <img class="img-fluid logo-clube" src="../img/competicoes-e-jogos/<?=$ultimoJogo->logoVisitante?>">
                            </figure>
                            <h5 class="my-auto ml-2 text-uppercase font-weight-bold"><?=$ultimoJogo->visitanteAbreviacao?></h5>
                        </div>

                        <!--Informações da partida-->
                        <div class="align-self-center text-center text-md-left ml-2 p-2">
                            <p class="mb-0 font-weight-bold "><?=$competicaoUltimoJogo->nome?></p>
                            <p class="mb-0"><i class="fas fa-calendar-alt"></i> <?=$dataJogo?> às <?=$horarioJogo?></p>
                            <p class="mb-0"><i class="fas fa-map-marker-alt"></i> <?=$ultimoJogo->localJogo?></p>
                        </div>


                    </div>

                    <div class="row justify-content-center">
                        <p class="col-12 text-danger small text-justify mt-5">O sistema identifica o último jogo automaticamente. Para editá-lo ou excluí-lo utilize a tabela de jogos disputados <i class="fas fa-exclamation-circle"></i> </p>
                    </div>

                </div>


                <?php }else{ ?>
                    <div class="col-12 col-md-6 text-center p-2">
                        <div class="row justify-content-center">
                            <h4 class="col-12 text-center font-weight-bold">Último jogo</h4>
                            <p class="small text-danger col-12 font-weight-bold">Não há jogos cadastrados no sistema <i class="fas fa-exclamation-circle"></i></p>

                            <button data-toggle="modal" data-target="#inserir-jogo" class="botao-inserir text-white font-weight-bold py-4 px-1">Cadastrar jogo  <i class="fas fa-plus-circle"></i></button>

                        </div>
                    </div>
                <?php }?>


        </div>

        <!--Tabela com todos os jogos-->
        <div class="row justify-content-center">
            <!--Jogos-->
            <div class="col-11 col-md-10 mb-5 pb-3 border">
                <h4 class="font-weight-bold text-center">Jogos disputados</h4>
                <a data-toggle="modal" data-target="#inserir-jogo" class="btn p-2 m-2 botao-inserir text-white font-weight-bold" data-toggle="modal" data-target="#modal-inserir">Inserir novo <i class="fas fa-plus-circle"></i></a>

                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Data</th>
                        <th>Participantes</th>
                        <th>Placar</th>
                        <th>Competição em disputa</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($jogo->selectByData() as $key => $value):
                        $data = new DateTime($value->dataJogo);
                        $competicaoEmDisputa = $competicao->selectCompeticao($value->codigoCompeticao);
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $data->format('d/m/Y');?></td>
                            <td class="text-center text-uppercase"><?=$value->mandanteAbreviacao?> <i class="fas fa-times"></i>  <?=$value->visitanteAbreviacao?></td>
                            <td class="text-center"><?=$value->placarMandante?> <i class="fas fa-times"></i> <?=$value->placarVisitante?></td>
                            <td class="text-center"><?=$competicaoEmDisputa->nome?></td>
                            <td class="text-center">
                                <a data-toggle="modal" data-target="#modal-visualizar<?=$value->codigoJogo?>" class="btn px-2 py-0 botao-inserir text-white font-weight-bold">Visualizar <i class="fas fa-eye"></i></a>
                                <a data-toggle="modal" data-target="#editar-jogo<?=$value->codigoJogo?>" class="btn px-2 py-0 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                                <a data-toggle="modal" data-target="#modal-excluir<?=$value->codigoJogo?>" class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--MODAIS-->

        <!--Modal de inserir jogo-->
        <div class="row">
            <div class="col-12">
                <!-- Modal -->
                <div class="modal fade" id="inserir-jogo" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Inserir jogo <i class="fas fa-plus-circle"></i></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="novo-jogo" method="post" enctype="multipart/form-data" action="../../controller/JogosController.php">

                                    <div class="form-row">
                                        <input type="hidden" name="acao" value="1">

                                        <!--Mandante abreviação-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="mandanteAbreviacao">Abreviação do nome do mandante *</label>
                                            <input type="text" class="form-control" id="mandanteAbreviacao" name="mandanteAbreviacao" required>
                                        </div>

                                        <!--Visitante abreviação-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="visitanteAbreviacao">Abreviação do nome do visitante *</label>
                                            <input type="text" class="form-control" id="visitanteAbreviacao" name="visitanteAbreviacao" required>
                                        </div>

                                        <!--Logo do mandante-->
                                        <div class="form-group col-12 col-md-6">
                                            <p class="font-weight-bold">Logo do mandante *</p>
                                            <input type="file" class="d-none form-control-file logo-mandante" name="logoMandante" id="logoMandante" accept="image/*" required>
                                            <button type="button" class="input-label input-label-mandante"><span class="label-span">Selecionar logo</span> <i class="fas fa-upload"></i></button>
                                            <span class="custom-text-mandante">Nenhum arquivo selecionado </span>
                                            <a class="reset-input reset-input-mandante d-none"><i class="fas fa fa-times-circle"></i></a>
                                        </div>

                                        <!--Logo do visitante-->
                                        <div class="form-group col-12 col-md-6">
                                            <p class="font-weight-bold">Logo do visitante *</p>
                                            <input type="file" class="d-none form-control-file logo-visitante" name="logoVisitante" id="logoVisitante" accept="image/*" required>
                                            <button type="button" class="input-label input-label-visitante"><span class="label-span">Selecionar logo</span> <i class="fas fa-upload"></i></button>
                                            <span class="custom-text-visitante">Nenhum arquivo selecionado </span>
                                            <a class="reset-input reset-input-visitante d-none"><i class="fas fa fa-times-circle"></i></a>
                                        </div>

                                        <!--Placar mandante-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="placarMandante">Placar do mandante *</label>
                                            <input type="number" class="form-control" id="placarMandante" name="placarMandante" required>
                                        </div>

                                        <!--Placar visitante-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="placarVisitante">Placar do visitante *</label>
                                            <input type="number" class="form-control" id="placarVisitante" name="placarVisitante" required>
                                        </div>

                                        <!--Data-->
                                        <div class="form-group col-12 col-sm-6 date">
                                            <label for="dataJogo">Data do jogo *</label>
                                            <input type="text" class="form-control" name="dataJogo" id="dataJogo" placeholder="__/__/____" required>
                                            <input id="data_jogo" type="hidden" name="data_jogo" value="">
                                        </div>

                                        <!--Horário-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="horario">Horário do jogo *</label>
                                            <input type="text" class="form-control" id="horario" name="horario" placeholder="00:00 Hs" required>
                                        </div>

                                        <!--Local-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="localJogo">Local do jogo *</label>
                                            <input type="text" class="form-control" id="localJogo" name="localJogo" required>
                                        </div>

                                        <!--Competição em disputa-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="competicao">Competição em disputa *</label>
                                            <select name="codigoCompeticao" id="competicao" class="d-block form-control" autocomplete="off" required>
                                                <?php $cont = 0; foreach ($competicao->selectAll() as $key => $value): if ($cont == 0){ $selected = 'selected';}else{ $selected =''; } ?>
                                                    <option value="<?=$value->codigoCompeticao?>" <?=$selected?>><?=$value->nome?></option>
                                                    <?php $cont++; endforeach; ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="modal-footer mt-2">
                                        <button type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fas fa-times-circle"></i></button>
                                        <button type="submit" class="btn botao-inserir font-weight-bold text-white btn-submit-novo-jogo">Salvar <i class="fas fa-save"></i></button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal de inserir PRÓXIMO JOGO-->
        <div class="row">
            <div class="col-12">
                <!-- Modal -->
                <div class="modal fade" id="modal-inserir-proximo-jogo" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Inserir jogo <i class="fas fa-plus-circle"></i></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="novo-jogo" method="post" enctype="multipart/form-data" action="../../controller/JogosController.php">

                                    <div class="form-row">
                                        <input type="hidden" name="acao" value="1">

                                        <!--Mandante abreviação-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="mandanteAbreviacao">Abreviação do nome do mandante *</label>
                                            <input type="text" class="form-control" id="mandanteAbreviacao" name="mandanteAbreviacao" required>
                                        </div>

                                        <!--Visitante abreviação-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="visitanteAbreviacao">Abreviação do nome do visitante *</label>
                                            <input type="text" class="form-control" id="visitanteAbreviacao" name="visitanteAbreviacao" required>
                                        </div>

                                        <!--Logo do mandante-->
                                        <div class="form-group col-12 col-md-6">
                                            <p class="font-weight-bold">Logo do mandante *</p>
                                            <input type="file" class="d-none form-control-file logo-mandante-next" name="logoMandante" id="logoMandanteNext" accept="image/*" required>
                                            <button type="button" class="input-label input-label-mandante-next"><span class="label-span">Selecionar logo</span> <i class="fas fa-upload"></i></button>
                                            <span class="custom-text-mandante-next">Nenhum arquivo selecionado </span>
                                            <a class="reset-input reset-input-mandante-next d-none"><i class="fas fa fa-times-circle"></i></a>
                                        </div>

                                        <!--Logo do visitante-->
                                        <div class="form-group col-12 col-md-6">
                                            <p class="font-weight-bold">Logo do visitante *</p>
                                            <input type="file" class="d-none form-control-file logo-visitante-next" name="logoVisitante" id="logoVisitanteNext" accept="image/*" required>
                                            <button type="button" class="input-label input-label-visitante-next"><span class="label-span">Selecionar logo</span> <i class="fas fa-upload"></i></button>
                                            <span class="custom-text-visitante-next">Nenhum arquivo selecionado </span>
                                            <a class="reset-input reset-input-visitante-next d-none"><i class="fas fa fa-times-circle"></i></a>
                                        </div>

                                        <!--Data-->
                                        <div class="form-group col-12 col-sm-6 date">
                                            <label for="dataJogoNext">Data do jogo *</label>
                                            <input type="text" class="form-control" name="dataJogo" id="dataJogoNext" placeholder="__/__/____" required>
                                            <input id="data_jogo_next" type="hidden" name="data_jogo" value="">
                                        </div>

                                        <!--Horário-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="horario-next">Horário do jogo *</label>
                                            <input type="text" class="form-control" id="horario-next" name="horario" placeholder="00:00 Hs" required>
                                        </div>

                                        <!--Local-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="localJogo">Local do jogo *</label>
                                            <input type="text" class="form-control" id="localJogo" name="localJogo" required>
                                        </div>

                                        <!--Competição em disputa-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="competicao">Competição em disputa *</label>
                                            <select name="codigoCompeticao" id="competicao" class="d-block form-control" autocomplete="off" required>
                                                <?php $cont = 0; foreach ($competicao->selectAll() as $key => $value): if ($cont == 0){ $selected = 'selected';}else{ $selected =''; } ?>
                                                    <option value="<?=$value->codigoCompeticao?>" <?=$selected?>><?=$value->nome?></option>
                                                    <?php $cont++; endforeach; ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="modal-footer mt-2">
                                        <button type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fas fa-times-circle"></i></button>
                                        <button type="submit" class="btn botao-inserir font-weight-bold text-white btn-submit-novo-jogo-next">Salvar <i class="fas fa-save"></i></button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal de editar jogo-->
        <div class="row">
            <div class="col-12">
                <?php foreach ($jogo->selectAll() as $key => $value): ?>

                <!-- Modal -->
                <div class="modal fade" id="editar-jogo<?=$value->codigoJogo?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar jogo <i class="fas fa-edit"></i></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editar-jogo<?=$value->codigoJogo?>" method="post" enctype="multipart/form-data" action="../../controller/JogosController.php">

                                    <div class="form-row">
                                        <input type="hidden" name="acao" value="3">
                                        <input type="hidden" name="codigoJogo" value="<?=$value->codigoJogo?>">

                                        <!--Mandante abreviação-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="mandanteAbreviacao">Abreviação do nome do mandante *</label>
                                            <input type="text" class="form-control" id="mandanteAbreviacao" name="mandanteAbreviacao" value="<?=$value->mandanteAbreviacao?>" required>
                                        </div>

                                        <!--Visitante abreviação-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="visitanteAbreviacao">Abreviação do nome do visitante *</label>
                                            <input type="text" class="form-control" id="visitanteAbreviacao" name="visitanteAbreviacao" value="<?=$value->visitanteAbreviacao?>" required>
                                        </div>

                                        <!--Visualização da logo do mandante-->
                                        <div class="form-group col-12 col-sm-6 bg-light text-center p-1">
                                            <p class="font-weight-bold">Logo atual do mandante</p>
                                            <img class="img-thumbnail logo-visualizacao" src="../img/competicoes-e-jogos/<?=$value->logoMandante?>"/>
                                        </div>

                                        <!--Visualização da logo do visitante-->
                                        <div class="form-group col-12 col-sm-6 bg-light text-center p-1">
                                            <p class="font-weight-bold">Logo atual do visitante</p>
                                            <img class="img-thumbnail logo-visualizacao" src="../img/competicoes-e-jogos/<?=$value->logoVisitante?>"/>
                                        </div>

                                        <!--Logo do mandante-->
                                        <div class="form-group col-12 col-md-6 inputff">
                                            <p class="font-weight-bold">Logo do mandante *</p>
                                            <input type="file" class="d-none form-control-file logo-editar" name="logoMandante" id="logoMandante" accept="image/*">
                                            <button type="button" class="input-label input-label-editar"><span class="label-span">Selecionar nova logo</span> <i class="fas fa-upload"></i></button>
                                            <span class="custom-text-editar">Nenhum arquivo selecionado </span>
                                            <a class="reset-input reset-input-editar d-none"><i class="fas fa fa-times-circle"></i></a>
                                        </div>

                                        <!--Logo do visitante-->
                                        <div class="form-group col-12 col-md-6 inputfff">
                                            <p class="font-weight-bold">Logo do visitante *</p>
                                            <input type="file" class="d-none form-control-file logo-editar" name="logoVisitante" id="logoVisitante" accept="image/*">
                                            <button type="button" class="input-label input-label-editar"><span class="label-span">Selecionar nova logo</span> <i class="fas fa-upload"></i></button>
                                            <span class="custom-text-editar">Nenhum arquivo selecionado </span>
                                            <a class="reset-input reset-input-editarr d-none"><i class="fas fa fa-times-circle"></i></a>
                                        </div>

                                        <!--Placar mandante-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="placarMandante">Placar do mandante *</label>
                                            <input type="number" class="form-control" id="placarMandante" name="placarMandante" value="<?=$value->placarMandante?>" required>
                                        </div>

                                        <!--Placar visitante-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="placarVisitante">Placar do visitante *</label>
                                            <input type="number" class="form-control" id="placarVisitante" name="placarVisitante" value="<?=$value->placarVisitante?>" required>
                                        </div>

                                        <!--Data-->
                                        <div class="form-group col-12 col-sm-6 dates">
                                            <?php $data = new DateTime($value->dataJogo);
                                                  $dataJogo = $data->format('d/m/Y');
                                            ?>
                                            <label for="dataJogoEditar">Data do jogo *</label>
                                            <input type="text" class="form-control" name="dataJogo" value="<?=$dataJogo?>" id="dataJogoEditar" placeholder="__/__/____" required>
                                            <input id="data_jogo_editar" type="hidden" name="data_jogo" value="<?=$value->dataJogo?>">
                                        </div>

                                        <!--Horário-->
                                        <div class="form-group col-12 col-sm-6 horario">
                                            <label for="horarioEditar">Horário do jogo *</label>
                                            <input type="text" class="form-control" id="horarioEditar" name="horario" value="<?=$value->horario?>" placeholder="00:00 Hs" required>
                                        </div>

                                        <!--Local-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="localJogo">Local do jogo *</label>
                                            <input type="text" class="form-control" id="localJogo" name="localJogo" value="<?=$value->localJogo?>" required>
                                        </div>

                                        <!--Competição em disputa-->
                                        <div class="form-group col-12 col-sm-6">
                                            <label for="competicao">Competição em disputa *</label>
                                            <select name="codigoCompeticao" id="competicao" class="d-block form-control" autocomplete="off" required>
                                                <?php $cont = 0; foreach ($competicao->selectAll() as $key => $value): if ($cont == 0){ $selected = 'selected';}else{ $selected =''; } ?>
                                                    <option value="<?=$value->codigoCompeticao?>" <?=$selected?>><?=$value->nome?></option>
                                                    <?php $cont++; endforeach; ?>

                                                    <option value="<?=$value->codigoCompeticao?>" selected><?php $nome =  $competicao->selectCompeticao($value->codigoCompeticao); echo $nome->nome;?></option>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="modal-footer mt-2">
                                        <button type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fas fa-times-circle"></i></button>
                                        <button type="submit" class="btn botao-inserir font-weight-bold text-white btn-submit-editar-jogo<?=$value->codigoJogo?>">Salvar <i class="fas fa-save"></i></button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>

        <!--Modal de editar próximo jogo-->
        <div class="row">
            <div class="col-12">
                <?php $value = $jogo->selectProximoJogo();?>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-editar-proximoJogo<?=$value->codigoJogo?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar próximo jogo jogo <i class="fas fa-edit"></i></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editar-proximo-jogo" method="post" enctype="multipart/form-data" action="../../controller/JogosController.php">

                                        <div class="form-row">
                                            <input type="hidden" name="acao" value="3">
                                            <input type="hidden" name="codigoJogo" value="<?=$value->codigoJogo?>">

                                            <!--Mandante abreviação-->
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="mandanteAbreviacao">Abreviação do nome do mandante *</label>
                                                <input type="text" class="form-control" id="mandanteAbreviacao" name="mandanteAbreviacao" value="<?=$value->mandanteAbreviacao?>" required>
                                            </div>

                                            <!--Visitante abreviação-->
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="visitanteAbreviacao">Abreviação do nome do visitante *</label>
                                                <input type="text" class="form-control" id="visitanteAbreviacao" name="visitanteAbreviacao" value="<?=$value->visitanteAbreviacao?>" required>
                                            </div>

                                            <!--Visualização da logo do mandante-->
                                            <div class="form-group col-12 col-sm-6 bg-light text-center p-1">
                                                <p class="font-weight-bold">Logo atual do mandante</p>
                                                <img class="img-thumbnail logo-visualizacao" src="../img/competicoes-e-jogos/<?=$value->logoMandante?>"/>
                                            </div>

                                            <!--Visualização da logo do visitante-->
                                            <div class="form-group col-12 col-sm-6 bg-light text-center p-1">
                                                <p class="font-weight-bold">Logo atual do visitante</p>
                                                <img class="img-thumbnail logo-visualizacao" src="../img/competicoes-e-jogos/<?=$value->logoVisitante?>"/>
                                            </div>

                                            <!--Logo do mandante-->
                                            <div class="form-group col-12 col-md-6 inputff-proximo">
                                                <p class="font-weight-bold">Logo do mandante *</p>
                                                <input type="file" class="d-none form-control-file logo-editar-proximo" name="logoMandante" id="logoMandanteProximo" accept="image/*">
                                                <button type="button" class="input-label input-label-editar-proximo"><span class="label-span">Selecionar nova logo</span> <i class="fas fa-upload"></i></button>
                                                <span class="custom-text-editar-proximo">Nenhum arquivo selecionado </span>
                                                <a class="reset-input reset-input-editar-proximo d-none"><i class="fas fa fa-times-circle"></i></a>
                                            </div>

                                            <!--Logo do visitante-->
                                            <div class="form-group col-12 col-md-6 inputfff-proximo">
                                                <p class="font-weight-bold">Logo do visitante *</p>
                                                <input type="file" class="d-none form-control-file logo-editar-proximo" name="logoVisitante" id="logoVisitanteProximo" accept="image/*">
                                                <button type="button" class="input-label input-label-editar-proximo"><span class="label-span">Selecionar nova logo</span> <i class="fas fa-upload"></i></button>
                                                <span class="custom-text-editar-proximo">Nenhum arquivo selecionado </span>
                                                <a class="reset-input reset-input-editarr-proximo d-none"><i class="fas fa fa-times-circle"></i></a>
                                            </div>

                                            <!--Data-->
                                            <div class="form-group col-12 col-sm-6 datee">
                                                <?php $data = new DateTime($value->dataJogo);
                                                $dataJogo = $data->format('d/m/Y');
                                                ?>
                                                <label for="dataJogoEditarProximo">Data do jogo *</label>
                                                <input type="text" class="form-control" name="dataJogo" value="<?=$dataJogo?>" id="dataJogoEditarProximo" placeholder="__/__/____" required>
                                                <input id="data_jogo_editar_proximo" type="hidden" name="data_jogo" value="<?=$value->dataJogo?>" >
                                            </div>

                                            <!--Horário-->
                                            <div class="form-group col-12 col-sm-6 horario">
                                                <label for="horarioEditar">Horário do jogo *</label>
                                                <input type="text" class="form-control" id="horarioEditar" name="horario" value="<?=$value->horario?>" placeholder="00:00 Hs" required>
                                            </div>

                                            <!--Local-->
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="localJogo">Local do jogo *</label>
                                                <input type="text" class="form-control" id="localJogo" name="localJogo" value="<?=$value->localJogo?>" required>
                                            </div>

                                            <!--Competição em disputa-->
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="competicao">Competição em disputa *</label>
                                                <select name="codigoCompeticao" id="competicao" class="d-block form-control" autocomplete="off" required>
                                                    <?php $cont = 0; foreach ($competicao->selectAll() as $key => $value): if ($cont == 0){ $selected = 'selected';}else{ $selected =''; } ?>
                                                        <option value="<?=$value->codigoCompeticao?>" <?=$selected?>><?=$value->nome?></option>
                                                        <?php $cont++; endforeach; ?>

                                                    <option value="<?=$value->codigoCompeticao?>" selected><?php $nome =  $competicao->selectCompeticao($value->codigoCompeticao); echo $nome->nome;?></option>

                                                </select>
                                            </div>

                                        </div>

                                        <div class="modal-footer mt-2">
                                            <button type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fas fa-times-circle"></i></button>
                                            <button type="submit" class="btn botao-inserir font-weight-bold text-white btn-submit-editar-proximo">Salvar <i class="fas fa-save"></i></button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <!--Modal de excluir jogo-->
        <div class="row">
            <div class="col-12">

                <?php foreach ($jogo->selectAll() as $key => $value):?>
                    <!-- Modal -->
                    <div class="modal fade" id="modal-excluir<?=$value->codigoJogo?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="text-danger font-weight-bold" id="exampleModalLabel">Você tem certeza que deseja excluir esse jogo?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fa fa-times-circle"></i></button>
                                    <a  href="?excluir=<?=$value->codigoJogo?>" type="button" class="btn botao-inserir font-weight-bold text-white">Excluir <i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>

        <!--Modal de visualizar competição-->
        <div class="row">
            <div class="col-12">

                <?php foreach ($jogo->selectAll() as $key => $value):
                    $competicaoProximoJogo = $competicao->selectCompeticao($value->codigoCompeticao);

                    $data = new DateTime($value->dataJogo);
                    $dataJogo = $data->format('d/m/Y');

                    $hora = new DateTime($value->horario);
                    $horarioJogo = $hora->format('H:i');
                    ?>
                    <!-- Modal -->
                    <div class="modal fade" id="modal-visualizar<?=$value->codigoJogo?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="font-weight-bold">Visualizar jogo <i class="fas fa-eye"></i></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-md-6 mb-2 pb-2">
                                            <div class="row justify-content-center">

                                                <h4 class="col-12 text-center font-weight-bold mb-4">Próximo jogo</h4>

                                                <!--Logo mandante-->
                                                <div class="align-self-center d-flex text-center">
                                                    <h5 class="my-auto mr-2 text-uppercase font-weight-bold"><?=$value->mandanteAbreviacao?></h5>
                                                    <figure>
                                                        <img class="my-auto img-fluid logo-clube" src="../img/competicoes-e-jogos/<?=$value->logoMandante?>">
                                                    </figure>
                                                </div>

                                                <!--placar-->
                                                <div class="my-auto mx-2">
                                                    <h4 class="font-weight-bold"><?=$value->placarMandante?> <i class="fas fa-times"></i> <?=$value->placarVisitante?> </h4>
                                                </div>

                                                <!--Logo visitante-->
                                                <div class="align-self-center text-center d-flex">
                                                    <figure>
                                                        <img class="img-fluid logo-clube" src="../img/competicoes-e-jogos/<?=$value->logoVisitante?>">
                                                    </figure>
                                                    <h5 class="my-auto ml-2 text-uppercase font-weight-bold"><?=$value->visitanteAbreviacao?></h5>
                                                </div>

                                                <!--Informações da partida-->
                                                <div class="align-self-center text-center text-md-left ml-2 p-2">
                                                    <p class="mb-0 font-weight-bold "><?=$competicaoProximoJogo->nome?></p>
                                                    <p class="mb-0"><i class="fas fa-calendar-alt"></i> <?=$dataJogo?> às <?=$horarioJogo?></p>
                                                    <p class="mb-0"><i class="fas fa-map-marker-alt"></i> <?=$value->localJogo?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>

        <!--Modal de editar placar-->
        <div class="row">
            <div class="col-12">

                <?php if ($jogo->selectProximoJogo()){ $value = $jogo->selectProximoJogo(); ?>
                    <!-- Modal -->
                    <div class="modal fade" id="modal-editar-placar<?=$value->codigoJogo?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="font-weight-bold">Cadastrar placar <i class="fas fa-pen-square"></i></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editar-placar-form" method="post" enctype="multipart/form-data" action="../../controller/JogosController.php">
                                        <div class="form-row">
                                            <!--Ação-->
                                            <input type="hidden" name="acao" value="22">

                                            <!--Codigo do jogo-->
                                            <input type="hidden" name="codigoJogo" value="<?=$value->codigoJogo?>">

                                            <!--Placar mandante-->
                                            <div class="form-group col-12 col-md-6">
                                                <label for="placarMandante">Placar do <span class="text-uppercase">"<?=$value->mandanteAbreviacao?>"</span> </label>
                                                <input type="number" class="form-control" name="placarMandante" id="placarMandante" required>
                                            </div>

                                            <!--Placar visitante-->
                                            <div class="form-group col-12 col-md-6">
                                                <label for="placarVisitante">Placar do <span class="text-uppercase">"<?=$value->visitanteAbreviacao?>"</span></label>
                                                <input type="number" class="form-control" name="placarVisitante" id="placarVisitante" required>
                                            </div>

                                        </div>

                                        <div class="modal-footer mt-2">
                                            <button type="button" class="btn botao-excluir font-weight-bold text-white" data-dismiss="modal">Cancelar <i class="fas fa-times-circle"></i></button>
                                            <button type="submit" class="btn botao-inserir font-weight-bold text-white">Salvar <i class="fas fa-save"></i></button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>


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
	<script src="../js/DatePicker/js/bootstrap-datepicker.min.js"></script>
<script src="../js/DatePicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<script src="../js/jquery.mask.js"></script>
<script src="../js/jquery.validate.js"></script>
<script src="../js/additional-methods.js"></script>
<script src="../js/moduloGestao/jogos-gestao.js"></script>
	<script src="../js/moduloGestao/jogos-gestao.js"></script>
<script>
    $('#dataJogo').mask('00/00/0000');
    $('#dataJogo').datepicker({
        format: 'dd/mm/yyyy',
        language : 'pt-BR',

    });
    $("#dataJogo").on('change',function () {
        var date = $("#dataJogo").datepicker("getDate");
        var valueDate = date.toISOString();
        $('#data_jogo').val(valueDate);
    });

    /**/
    $('#dataJogoNext').mask('00/00/0000');
    $('#dataJogoNext').datepicker({
        format: 'dd/mm/yyyy',
        language : 'pt-BR',

    });
    $("#dataJogoNext").on('change',function () {
        var date = $("#dataJogoNext").datepicker("getDate");
        var valueDate = date.toISOString();
        $('#data_jogo_next').val(valueDate);
    })

    /*datas pras modais de edição*/
    $('.dates').on('click',function () {
        var datest = $(this);
       $(this).find('#dataJogoEditar').mask('00/00/0000');
       $(this).find('#dataJogoEditar').datepicker({
            format: 'dd/mm/yyyy',
            language : 'pt-BR',

        });
        $(this).find("#dataJogoEditar").on('change',function () {
            var date = $(this).datepicker("getDate");
            var valueDate = date.toISOString();
            $(datest).find('#data_jogo_editar').val(valueDate);
            
        });

    });

     /*datas pras modais de edição*/
       $('#dataJogoEditarProximo').mask('00/00/0000');
       $('#dataJogoEditarProximo').datepicker({
            format: 'dd/mm/yyyy',
            language : 'pt-BR',

        });
        $("#dataJogoEditarProximo").on('change',function () {
            var date = $("#dataJogoEditarProximo").datepicker("getDate");
            var valueDate = date.toISOString();
            $('#data_jogo_editar_proximo').val(valueDate);
            
        });

   



</script>



</html>