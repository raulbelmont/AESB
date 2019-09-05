<?php
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

if(empty($_GET['codigoElencado'])){
   header('Location:home.php');
}else{

    $codigoElencado = $_GET['codigoElencado'];
    $elencado = $elenco->selectElencado($codigoElencado);


}

?>

<!doctype html>
<html lang="pt-BR">

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloGestao/editar-elencado.css"/>
    <link rel="stylesheet" href="../js/DatePicker/css/bootstrap-datepicker.min.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Editar elencado</title>

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

            <h1 class="col-12 text-center font-weight-bold">Editar elencado</h1>
            <?php
            if($elencado->tipo == 1){?>
            <!--Editando jogador-->
            <div class="col-10">
                <!--FORM DE INSERÇÃO DE JOGADOR-->
                <form id="formJogador" class="mt-5 border-top pt-4" enctype="multipart/form-data" action="../../controller/ElencoController.php" method="POST">


                    <div class="form-row">
                        <input type="hidden" name="codigoElencado" value="<?=$_GET['codigoElencado']?>">
                        <input type="hidden" name="acao" value="3">

                        <!--Nome Completo-->
                        <div class="form-group col-12 col-md-6">
                            <label for="nomeCompleto">Nome Completo *</label>
                            <input class="form-control" type="text" name="nomeCompleto" placeholder="Nome Completo" value="<?=$elencado->nome?>" required>
                        </div>


                        <!--Apelido-->
                        <div class="form-group col-12 col-md-6">
                            <label for="apelido">Apelido *</label>
                            <input class="form-control" type="text" name="apelido" placeholder="Apelido" required value="<?=$elencado->apelido?>" >
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
                                <option value="<?=$elencado->funcao?>" hidden selected><?=$elencado->funcao?></option>
                            </select>
                        </div>

                        <!--Data de Nascimento-->
                        <div class="form-group col-12 col-md-6 date">
                            <label for="dataNascimento">Data de Nascimento *</label>
                            <input type="text" class="form-control" name="dataNascimento" id="dataNascimento" value="<?php $data = new DateTime($elencado->dataNascimento); echo $data->format('d/m/Y');?>" placeholder="__/__/____" required>
                            <input id="data_nascimento" type="hidden" name="data_nascimento" value="<?=$elencado->dataNascimento?>">
                        </div>

                        <?php
                            if ($elencado->nacionalidade == 'Brasileiro'){
                                $selectedBrasileiro = 'selected';
                                $selectedOutro = '';

                                $natu= $elencado->naturalidade;
                                $naturalidade = explode(' - ',$natu);

								
                                $estado = $estados->selectEstado($naturalidade[1]);
								$optionEstado = "<option value='$estado->sigla' selected>$estado->nome</option>";

                                $cidadeNatural = $naturalidade[0];
                                $cidadesEstado = $cidades->selectCidades($estado->id);

                                $nacionalidadeOutra = '';
                                $optionNacionalidadeDigitada ='';
                                $naturalidadeDigitada= '';

                            }else{
                                $selectedBrasileiro = '';
                                $selectedOutro = 'selected';

                                $nacionalidadeDigitada = $elencado->nacionalidade;
                                $optionNacionalidadeDigitada = "<option value='$nacionalidadeDigitada' selected>$nacionalidadeDigitada</option>";
                                $naturalidadeDigitada= $elencado->naturalidade;

                                $optionEstado = '';
                                $cidadeNatural = '';
                            }


                        ?>

                        <!--Naturalidade-->
                        <!--País-->
                        <div class="form-group col-4 col-md-2">
                            <label for="naturalidadePais">Nacionalidade *</label>
                            <select name="nacionalidade" id="select-nacionalidade" class="d-block form-control" autocomplete="off" required>
                                <option value="Brasileiro" <?=$selectedBrasileiro?>>Brasileiro</option>
                                <option value="outra" <?=$selectedOutro?>>Outro</option>
                            </select>
                        </div>

                        <!--Digitar nacionalidade-->
                        <div class="form-group col-8 col-md-5 nacionalidadeDigitada d-none">
                            <label for="nacionalidadeDigitada">Qual?</label>
                            <select type="text" name="nacionalidadeDigitada" class="form-control" autocomplete="off" id="select-pais">
                                <?php foreach ($paises->selectAll() as $key => $value): ?>
                                    <option value="<?=$value->SL_NOME_PT?>"><?=$value->SL_NOME_PT?></option>
                                <?php endforeach;
                                    echo $optionNacionalidadeDigitada;
                                ?>
                            </select>
                        </div>
                        <!--Digitar naturalidade-->
                        <div class="form-group col-8 col-md-5 naturalidadeDigitada d-none">
                            <label for="naturalidadeDigitada">Cidade de nascimento</label>
                            <input id="naturalidadeDigitada" type="text" name="naturalidadeDigitada" class="form-control" value="<?=$naturalidadeDigitada?>">
                        </div>


                        <!--Estado-->
                        <div class="form-group col-4 col-md-5 estado d-none">
                            <label for="naturalidadeEstado">Naturalidade *</label>
                            <select name="naturalidadeEstado" id="select-estado" class="d-block form-control" autocomplete="off">
                                <?php foreach ($estados->selectAll() as $key => $value): ?>
                                    <option class="option" id="<?=$value->id?>" value="<?=$value->sigla?>"><?=$value->nome?></option>
                                <?php endforeach;
                                    echo $optionEstado;
                                ?>
                            </select>
                        </div>

                        <!--Cidade-->
                        <div class="form-group col-8 col-md-5 cidades">
                            <label id="label-cidades" for="naturalidadeCidade" class="invisible">Carregando...</label>
                            <select name="naturalidadeCidade" id="select-cidades" class="d-none form-control" autocomplete="off">
                                <?php if ($elencado->nacionalidade == 'Brasileiro'){
                                    foreach ($cidadesEstado as $key => $value): ?>

                                        <option value='<?=$value->nome?>'><?=$value->nome?></option>

                                <?php endforeach; } ?>
                                <option value="<?=$cidadeNatural?>" selected><?=$cidadeNatural?></option>
                            </select>
                        </div>

                        <!--Foto de Perfil-->
                        <div class="form-group col-12">
                            <p class="font-weight-bold">Foto de perfil * <small class="text-muted">180x250 é o tamanho sugerido para a imagem</small></p>
                            <?php if (!$elencado->fotoDePerfil == null){?>
                                <p><a href="../img/elenco/<?=$elencado->fotoDePerfil?>" target="_blank">Ver foto atual</a></p>
                            <?php } ?>
                            <input type="file" class="form-control-file logo-perfil d-none" name="fotoPerfil" id="fotoPerfil" accept="image/*">
                            <button type="button" class="input-label input-label-perfil"><span class="label-span">Selecionar foto</span> <i class="fas fa-upload"></i></button>
                            <span class="custom-text-perfil">Nenhum arquivo selecionado </span>
                            <a class="reset-input reset-input-perfil d-none"><i class="fas fa fa-times-circle"></i></a>
                        </div>

                        <div class="form-group col-auto ml-auto">
                            <a href="elenco-gestao.php" class="btn botao-excluir text-white font-weight-bold">Cancelar <i class="fas fa-ban"></i></a>
                            <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-elencado">Salvar <i class="far fa-save"></i></button>
                        </div>
                    </div>

                </form>



            </div>
            <?php } else{

                $selectedComissao = '';
                $selectedDiretoria = '';
                $selectedApoio = '';
                if ($elencado->tipo == 2){
                    $selectedComissao = 'selected';
                }
                if ($elencado->tipo == 3){
                    $selectedDiretoria = 'selected';
                }
                if ($elencado->tipo == 4){
                    $selectedApoio = 'selected';
                }

                ?>

            <!--Editando outra categoria-->
            <div class="col-10">


                <!--FORM DE INSERÇÃO DE OUTRO-->
                <form id="formOutro" class="mt-5 border-top pt-4" enctype="multipart/form-data" action="../../controller/ElencoController.php" method="POST">


                    <div class="form-row">
                        <input type="hidden" name="codigoElencado" value="<?=$_GET['codigoElencado']?>">
                        <input type="hidden" name="acao" value="33">
                        <!--Nome Completo-->
                        <div class="form-group col-12 col-md-6">
                            <label for="nomeCompletoOutro">Nome Completo *</label>
                            <input class="form-control" type="text" name="nomeCompletoOutro" placeholder="Nome Completo" value="<?=$elencado->nome?>" required>
                        </div>

                        <!--Apelido-->
                        <div class="form-group col-12 col-md-6">
                            <label for="apelidoOutro">Apelido *</label>
                            <input class="form-control" type="text" name="apelidoOutro" placeholder="Apelido" value="<?=$elencado->apelido?>" required>
                        </div>

                        <!--Categoria-->
                        <div class="form-group col-12 col-md-6">
                            <label for="categoria">Categoria *</label>
                            <select name="categoria" id="select-categoria" class="d-block form-control" autocomplete="off" required>
                                <option value="2" <?=$selectedComissao?>>Comissão Técnica</option>
                                <option value="3" <?=$selectedDiretoria?>>Diretoria</option>
                                <option value="4" <?=$selectedApoio?>>Apoio</option>
                            </select>
                        </div>

                        <!--Função-->
                        <div class="form-group col-12 col-md-6 date">
                            <label for="funcaoOutro">Função *</label>
                            <input type="text" class="form-control" id="funcaoOutro" name="funcaoOutro" value="<?=$elencado->funcao?>" required>
                        </div>

                        <!--Foto de Perfil-->
                        <div class="form-group col-12">
                            <p class="font-weight-bold">Foto de perfil * <small class="text-muted">180x250 é o tamanho sugerido para a imagem</small></p>

                            <?php if (!$elencado->fotoDePerfil == null){?>
                            <p><a href="../img/elenco/<?=$elencado->fotoDePerfil?>" target="_blank">Ver foto atual</a></p>
                            <?php } ?>
                            <input type="file" class="form-control-file logo-perfil-outro d-none" name="fotoPerfilOutro" id="fotoPerfilOutro" accept="image/*">
                            <button type="button" class="input-label input-label-perfil-outro"><span class="label-span">Selecionar foto</span> <i class="fas fa-upload"></i></button>
                            <span class="custom-text-perfil-outro">Nenhum arquivo selecionado </span>
                            <a class="reset-input reset-input-perfil-outro d-none"><i class="fas fa fa-times-circle"></i></a>
                        </div>

                        <div class="form-group col-auto ml-auto">
                            <a href="elenco-gestao.php" class="btn botao-excluir text-white font-weight-bold" onclick="window.close()">Cancelar <i class="fas fa-ban"></i></a>
                            <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-elencado-outro">Salvar <i class="far fa-save"></i></button>
                        </div>

                    </div>



                </form>

            </div>

            <?php } ?>

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
<script src="../js/moduloGestao/editar-elencado.js"></script>
<script src="../js/DatePicker/js/bootstrap-datepicker.min.js"></script>
<script src="../js/DatePicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
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
