<?php
date_default_timezone_set('America/Sao_Paulo');

require_once '../../model/UsuarioModel.php';
require_once '../../model/ElencoModel.php';
require_once '../../model/Cidades.php';
require_once '../../model/Estados.php';
require_once '../../model/Paises.php';
$usuario = new UsuarioModel();
$elenco = new ElencoModel();
$estados = new Estados();
$cidades = new Cidades();
$paises = new Paises();

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
/*Excluindo elencado*/
if (!empty($_GET['acao']) and $_GET['acao'] == 2){
    $_SESSION['excluir'] = $_GET['excluir'];
    header('location:../../controller/ElencoController.php?acao=2');
}


?>

<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloGestao/elenco-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Elenco</title>

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
            <h1 class="font-weight-bold text-center my-5 col-12 border-bottom">Elenco</h1>





            <div class="col-8">

                <a data-toggle="modal" data-target="#inserirNovo"  class="btn p-2 m-2 botao-inserir text-white font-weight-bold">Inserir novo <i class="fas fa-plus-circle"></i></a>

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


                <table class="table table-bordered table-hover table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Nome</th>
                        <th>Apelido</th>
                        <th>Função</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($elenco->selectPaginacao((!empty($_GET['pagina']))?($_GET['pagina']):(1) ) as $key=>$value):

                        if ($value->tipo == 1){
                            $IdModalEditar = 'editarJogador'.$value->codigoElencado;
                        }else{
                            $IdModalEditar = 'editarOutro'.$value->codigoElencado;
                        }

                        ?>
                        <tr>
                            <td><?=$value->nome?></td>
                            <td><?=$value->apelido?></td>
                            <td><?=$value->funcao?></td>
                            <td class="text-center">
                                <a data-toggle="modal" data-target="#visualizarElencado<?=$value->codigoElencado?>" class="btn px-2 py-0 botao-inserir text-white font-weight-bold">Visualizar <i class="fas fa-eye"></i></a>
                                <a href="editar-elencado.php?codigoElencado=<?=$value->codigoElencado?>" class="btn px-2 py-0 mb-1 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                                <a href="?acao=2&excluir=<?=$value->codigoElencado?>" class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

            <!-- Modal Com Informações do jogador-->
            <?php foreach ($elenco->selectPaginacao((!empty($_GET['pagina']))?($_GET['pagina']):(1) ) as $key => $value): ?>
            <div id="visualizarElencado<?php echo $value->codigoElencado; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Modal Com Informações do Jogador" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">

                        <div class="modal-header border-bottom">

                            <h3 class=""><span class="font-weight-bold"><?=$value->apelido?></span> - <small class="text-uppercase"><?=$value->funcao?></small> </h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" style="color: #000;">
                                <i class="fas fa-window-close"></i>
                            </button>

                        </div>

                        <div class="modal-body">

                            <div class="container-fluid">

                                <div class="row my-2">

                                    <!--Carrosel com fotos do jogador-->
                                    <div class="col-12 fotos-jogador m-0 p-0 d-block d-sm-flex justify-content-center">
                                        <!--Fotos-->
                                        <div class="fotos-jogador-carrosel col-12 col-sm-8">

                                            <!--Foto-->
                                            <div class="foto-jogador mx-2">

                                                <img src="../img/elenco/<?=$value->fotoDePerfil?>" alt="Foto"/>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row justify-content-center border-top">

                                    <ul class="list-unstyled col-12 col-sm-5 col-xl-auto p-0 m-3">
                                        <li class="pb-1 font-weight-bold">Nome Completo</li>
                                        <li class="pt-1"><?php echo $value->nome; ?></li>
                                    </ul>

                                    <ul class="list-unstyled col-12 col-sm-5 col-xl-auto p-0 m-3">
                                        <li class="pb-1 font-weight-bold">Categoria</li>
                                        <li class="pt-1"><?php

                                            if ($value->tipo == 1){
                                                echo 'Jogador';
                                            }
                                            if ($value->tipo == 2){
                                                echo 'Comissão técnica';
                                            }
                                            if ($value->tipo == 3){
                                                echo 'Diretoria';
                                            }
                                            if ($value->tipo == 4){
                                                echo "apoio";
                                            }

                                        ?></li>
                                    </ul>

                                    <?php if ($value->tipo == 1){ ?>
                                    <ul class="list-unstyled col-12 col-sm-5 col-xl-auto p-0 m-3">
                                        <li class="pb-1 font-weight-bold">Data de Nascimento</li>
                                        <li class="pt-1"><?php

                                            $data = new DateTime($value->dataNascimento);
                                            $dataAtual =  Date('Y/m/d');
                                            $dataIdade = new DateTime($dataAtual);
                                            $idade = $data->diff( $dataIdade );

                                            echo $data->format('d/m/Y');
                                            echo " ({$idade->y} anos)";


                                            ?></li>
                                    </ul>

                                    <ul class="list-unstyled col-12 col-sm-5 col-xl-auto p-0 m-3">
                                        <li class="pb-1 font-weight-bold">Naturalidade</li>
                                        <li class="pt-1"><?php echo $value->naturalidade; ?></li>
                                    </ul>

                                    <ul class="list-unstyled col-12 col-sm-5 col-xl-auto p-0 m-3">
                                        <li class="pb-1 font-weight-bold">Nacionalidade</li>
                                        <li class="pt-1"><?php echo $value->nacionalidade; ?></li>
                                    </ul>

                                    <?php } ?>


                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>



        </div>
        <!--Paginação-->
        <div class="row">
            <div class="col-auto m-auto">
                <nav class="">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="?pagina=1" aria-label="Anterior">
                                <span class="">Início</span>
                            </a>
                        </li>

                        <?php
                        $total = count($elenco->selectAll());
                        if (!empty($_GET['pagina'])){
                            $pagina = $_GET['pagina'];
                        }else{
                            $pagina = 1;
                        }
                        $qtd = ceil($total/6);

                        if ($pagina >= $qtd){
                            $display = 'd-none';
                        }else{
                            $display = 'd-block';
                        }

                        for ($cont = 1;$cont<=$qtd;$cont++){
                            ?>
                            <li class="page-item"><a class="page-link" href="?pagina=<?=$cont?>"><?=$cont?></a></li>
                        <?php }?>
                        <li class="page-item">
                            <a class="page-link <?=$display?>" href="?pagina=<?=$pagina+1?>" aria-label="Próximo">
                                <span class="">Próximo</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!--Modal de inserir novo-->
        <div id="inserirNovo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Modal Com Informações do Jogador" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">

                    <div class="modal-header border-bottom">

                        <h3 class=""><span class="font-weight-bold">Inserir novo</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" style="color: #000;">
                            <i class="fas fa-window-close"></i>
                        </button>

                    </div>

                    <div class="modal-body">

                        <label for="selectInsert" class="select-insert font-weight-bold">Inserir novo:</label>
                        <select name="selectInsert" id="select-insert" class="d-block form-control" autocomplete="off">
                            <option value="selecione">Selecione...</option>
                            <option value="jogador">Jogador</option>
                            <option value="outro">Outro</option>
                        </select>

                        <!--FORM DE INSERÇÃO DE JOGADOR-->
                        <form id="formJogador" class="d-none mt-5 border-top pt-4" enctype="multipart/form-data" action="../../controller/ElencoController.php" method="POST">


                            <div class="form-row">

                                <input type="hidden" name="acao" value="1">

                                <!--Nome Completo-->
                                <div class="form-group col-12 col-md-6">
                                    <label for="nomeCompleto">Nome Completo *</label>
                                    <input class="form-control" type="text" name="nomeCompleto" placeholder="Nome Completo" required>
                                </div>


                                <!--Apelido-->
                                <div class="form-group col-12 col-md-6">
                                    <label for="apelido">Apelido *</label>
                                    <input class="form-control" type="text" name="apelido" placeholder="Apelido" required>
                                </div>

                                <!--Função-->
                                <div class="form-group col-12 col-md-6">
                                    <label for="funcao">Função *</label>
                                    <select name="funcao" id="select-funcao" class="d-block form-control" autocomplete="off" required>
                                        <option value="goleiro">Goleiro</option>
                                        <option value="lateral">Lateral</option>
                                        <option value="zagueiro">Zagueiro</option>
                                        <option value="volante">Volante</option>
                                        <option value="meio-campo">Meio-Campo</option>
                                        <option value="atacante">Atacante</option>
                                    </select>
                                </div>

                                <!--Data de Nascimento-->
                                <div class="form-group col-12 col-md-6 date">
                                    <label for="dataNascimento">Data de Nascimento *</label>
                                    <input type="text" class="form-control" name="dataNascimento" id="dataNascimento" placeholder="__/__/____" required>
                                    <input id="data_nascimento" type="hidden" name="data_nascimento" value="">
                                </div>

                                <!--Naturalidade-->
                                <!--País-->
                                <div class="form-group col-4 col-md-2">
                                    <label for="naturalidadePais">Nacionalidade *</label>
                                    <select name="nacionalidade" id="select-nacionalidade" class="d-block form-control" autocomplete="off" required>
                                        <option value="">Selecione</option>
                                        <option value="Brasileiro">Brasileiro</option>
                                        <option value="outra">Outro</option>
                                    </select>
                                </div>
                                <!--Digitar nacionalidade-->
                                <div class="form-group col-8 col-md-5 nacionalidadeDigitada d-none">
                                    <label for="nacionalidadeDigitada">Qual?</label>
                                    <select type="text" name="nacionalidadeDigitada" class="form-control" autocomplete="off" id="select-pais">
                                        <?php foreach ($paises->selectAll() as $key => $value): ?>
                                            <option value="<?=$value->SL_NOME_PT?>"><?=$value->SL_NOME_PT?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!--Digitar naturalidade-->
                                <div class="form-group col-8 col-md-5 naturalidadeDigitada d-none">
                                    <label for="naturalidadeDigitada">Cidade de nascimento</label>
                                    <input type="text" name="naturalidadeDigitada" class="form-control">
                                </div>


                                <!--Estado-->
                                <div class="form-group col-4 col-md-5 estado d-none">
                                    <label for="naturalidadeEstado">Naturalidade *</label>
                                    <select name="naturalidadeEstado" id="select-estado" class="d-block form-control" autocomplete="off">
                                        <?php foreach ($estados->selectAll() as $key => $value): ?>
                                            <option class="option" id="<?=$value->id?>" value="<?=$value->sigla?>"><?=$value->nome?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <!--Cidade-->
                                <div class="form-group col-8 col-md-5 cidades">
                                    <label id="label-cidades" for="naturalidadeCidade" class="invisible">Carregando...</label>
                                    <select name="naturalidadeCidade" id="select-cidades" class="d-none form-control" autocomplete="off">

                                    </select>
                                </div>

                                <!--Foto de Perfil-->
                                <div class="form-group col-12">
                                    <p class="font-weight-bold">Foto de perfil * <small class="text-muted">180x250 é o tamanho sugerido para a imagem</small></p>
                                    <input type="file" class="form-control-file logo-perfil d-none" name="fotoPerfil" id="fotoPerfil" accept="image/*" required>
                                    <button type="button" class="input-label input-label-perfil"><span class="label-span">Selecionar foto</span> <i class="fas fa-upload"></i></button>
                                    <span class="custom-text-perfil">Nenhum arquivo selecionado </span>
                                    <a class="reset-input reset-input-perfil d-none"><i class="fas fa fa-times-circle"></i></a>
                                </div>

                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                                <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-elencado">Salvar <i class="far fa-save"></i></button>
                            </div>

                        </form>

                        <!--FORM DE INSERÇÃO DE OUTRO-->
                        <form id="formOutro" class="d-none mt-5 border-top pt-4" enctype="multipart/form-data" action="../../controller/ElencoController.php" method="POST">


                            <div class="form-row">
                                <input type="hidden" name="acao" value="11">
                                <!--Nome Completo-->
                                <div class="form-group col-12 col-md-6">
                                    <label for="nomeCompletoOutro">Nome Completo *</label>
                                    <input class="form-control" type="text" name="nomeCompletoOutro" placeholder="Nome Completo" required>
                                </div>

                                <!--Apelido-->
                                <div class="form-group col-12 col-md-6">
                                    <label for="apelidoOutro">Apelido *</label>
                                    <input class="form-control" type="text" name="apelidoOutro" placeholder="Apelido" required>
                                </div>

                                <!--Categoria-->
                                <div class="form-group col-12 col-md-6">
                                    <label for="categoria">Categoria *</label>
                                    <select name="categoria" id="select-categoria" class="d-block form-control" autocomplete="off" required>
                                        <option value="2">Comissão Técnica</option>
                                        <option value="3">Diretoria</option>
                                        <option value="4">Apoio</option>
                                    </select>
                                </div>

                                <!--Função-->
                                <div class="form-group col-12 col-md-6 date">
                                    <label for="funcaoOutro">Função *</label>
                                    <input type="text" class="form-control" id="funcaoOutro" name="funcaoOutro" required>
                                </div>

                                <!--Foto de Perfil-->
                                <div class="form-group col-12">
                                    <p class="font-weight-bold">Foto de perfil * <small class="text-muted">180x250 é o tamanho sugerido para a imagem</small></p>
                                    <input type="file" class="form-control-file logo-perfil-outro d-none" name="fotoPerfilOutro" id="fotoPerfilOutro" accept="image/*" required>
                                    <button type="button" class="input-label input-label-perfil-outro"><span class="label-span">Selecionar foto</span> <i class="fas fa-upload"></i></button>
                                    <span class="custom-text-perfil-outro">Nenhum arquivo selecionado </span>
                                    <a class="reset-input reset-input-perfil-outro d-none"><i class="fas fa fa-times-circle"></i></a>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                                <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-elencado-outro">Salvar <i class="far fa-save"></i></button>
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
<script src="../js/DatePicker/js/bootstrap-datepicker.min.js"></script>
<script src="../js/DatePicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<script src="../js/moduloGestao/elenco-gestao.js"></script>
<script>
    $('#dataNascimento').datepicker({
        format: 'dd/mm/yyyy',
        language : 'pt-BR'
    });
    $("#dataNascimento").on('change',function () {
        var date = $("#dataNascimento").datepicker("getDate");
        var valueDate = date.toISOString();
        $('#data_nascimento').val(valueDate);
    })


</script>



</html>