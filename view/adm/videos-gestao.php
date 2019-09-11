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
require_once '../../model/VideosModel.php';
$video = new VideosModel();

/*deslogando*/
if (!empty($_GET['sair']) == true){
    $usuario->logoff();
}


/*Excluindo video*/
if (!empty($_GET['acao']) and $_GET['acao'] == 2){
    $_SESSION['excluir'] = $_GET['excluir'];
    header('location:../../controller/VideosController.php?acao=2');
}

/*Excluindo video do torcedor em análise*/
if (!empty($_GET['acao']) and $_GET['acao'] == 21){
    $_SESSION['excluir'] = $_GET['excluir'];
    header('location:../../controller/VideosController.php?acao=21');
}

/*Excluindo video do torcedor publicado*/
if (!empty($_GET['acao']) and $_GET['acao'] == 22){
    $_SESSION['excluir'] = $_GET['excluir'];
    header('location:../../controller/VideosController.php?acao=22');
}

/*Publicando vídeo*/
if (!empty($_GET['acao']) and $_GET['acao'] == 4){
    $_SESSION['publicar'] = $_GET['publicar'];
    header('location:../../controller/VideosController.php?acao=4');
}
/*Removendo vídeo*/
if (!empty($_GET['acao']) and $_GET['acao'] == 5){
    $_SESSION['remover'] = $_GET['remover'];
    header('location:../../controller/VideosController.php?acao=5');
}

/*Paginação video da aesb*/
$itensPorPagina = 10;
if (!empty($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
}else{
    $pagina = 1;
}

/*Paginação de vídeos dos torcedores não publicados*/
$itensPorPaginaTorcedorN = 10;
if (!empty($_GET['paginaN'])) {
    $paginaTorcedorN = $_GET['paginaN'];
}else{
    $paginaTorcedorN = 1;
}

$itensPorPaginaTorcedorP = 10;
if (!empty($_GET['paginaP'])) {
    $paginaTorcedorP = $_GET['paginaP'];
}else{
    $paginaTorcedorP = 1;
}

?>

<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/moduloGestao/videos-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Vídeos</title>

</head>

<body>

<header>
    <?php
    include '../inc/moduloGestao/incMenuGestao.php';
    ?>

</header>


<main>

    <div class="container-fluid">
        <div class="row">
            <h1 class="font-weight-bold text-center my-5 col-12">Vídeos <i class="fas fa-video"></i></h1>

            <!--Videos da aesb-->
            <div class="col-11 col-md-10 mb-5 pb-3 border m-auto">

                <h4 class="text-center font-weight-bold">Últimos adicionados</h4>
                <a class="btn p-2 m-2 botao-inserir text-white font-weight-bold" data-toggle="modal" data-target="#novoVideo">Inserir novo<i class="fas fa-plus-circle"></i></a>


                <!--Mensagens a respeito do salvamento de noticias-->
                <?php if (isset($_SESSION['salvou']) and $_SESSION['salvou'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Vídeo publicada com sucesso!</h5>
                    </div>
                <?php } $_SESSION['salvou'] = null; ?>

                <?php if (isset($_SESSION['salvou']) and $_SESSION['salvou'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao salvar vídeo!</h5>
                    </div>
                <?php } $_SESSION['salvou'] = null;?>

                <!--Mensagens de Exclusão-->
                <?php if (isset($_SESSION['excluiu']) and $_SESSION['excluiu'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Vídeo excluido com sucesso!</h5>
                    </div>
                <?php } $_SESSION['excluiu'] = null; ?>

                <?php if (isset($_SESSION['excluiu']) and $_SESSION['excluiu'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao excluir o vídeo!</h5>
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
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao salvar as alterações!</h5>
                    </div>
                <?php } $_SESSION['editou'] = null;?>

                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Data de publicação</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Última atualização</th>
                        <th>Poster</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($video->selectPaginacao((!empty($_GET['pagina'])?($_GET['pagina']):(1)))as $key => $value): ?>
                        <tr>
                            <td class="text-center"><?php $data = new DateTime($value->dataPublicacao); echo $data->format('d/m/Y H:i');?></td>
                            <td class=""><?=$value->tituloVideo?></td>
                            <td><?=$value->autor?></td>
                            <td class="text-center"><?php
                                if ($value->ultimaAtualizacao == NULL){
                                    echo '-';
                                }else{
                                    $data = new DateTime($value->ultimaAtualizacao);
                                    echo $data->format('d/m/Y H:i');
                                }
                                ?></td>

                            <td class="text-center text-truncate"><?php
                                if ($value->poster == NULL){
                                    echo '-';
                                }else{
                                    echo "<a href='../videos/poster/$value->poster' target='_blank'>$value->poster</a>";
                                }
                                ?></td>
                            <td class="text-center">
                                <a data-toggle="modal" data-target="#visualizarVideo<?=$value->codigoVideo?>" target="_blank" class="btn px-2 py-0 botao-inserir text-white font-weight-bold">Visualizar <i class="fas fa-eye"></i></a>
                                <a data-toggle="modal" data-target="#editarVideo<?=$value->codigoVideo?>" class="btn px-2 py-0 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                                <a href="?acao=2&excluir=<?=$value->codigoVideo?>" id="<?=$value->codigoVideo?>" class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>

                </table>

                <nav class="">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="?pagina=1" aria-label="Anterior">
                                <span class="">Início</span>
                            </a>
                        </li>


                        <?php $total = count($video->selectAll());

                        $qtd = ceil($total/10);

                        for ($cont = 1;$cont<=$qtd;$cont++){
                            ?>
                            <li class="page-item"><a class="page-link" href="?pagina=<?=$cont?>"><?=$cont?></a></li>
                        <?php }?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina+1;?>" aria-label="Próximo">
                                <span class="">Próximo</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!--Vídeos dos torcedores não publicados-->
            <div class="col-11 col-md-10 mb-5 pb-3 border m-auto my-2 bg-light">

                <h4 class="text-center font-weight-bold my-4">Videos em análise enviados por torcedores</h4>

                <!--Mensagens a respeito do salvamento de noticias-->
                <?php if (isset($_SESSION['salvouTorcedor']) and $_SESSION['salvouTorcedor'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Vídeo publicado com sucesso!</h5>
                    </div>
                <?php } $_SESSION['salvouTorcedor'] = null; ?>

                <?php if (isset($_SESSION['salvouTorcedor']) and $_SESSION['salvouTorcedor'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao publicar vídeo!</h5>
                    </div>
                <?php } $_SESSION['salvouTorcedor'] = null;?>

                <!--Mensagens de Exclusão-->
                <?php if (isset($_SESSION['excluiuTorcedor']) and $_SESSION['excluiuTorcedor'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Vídeo excluido com sucesso!</h5>
                    </div>
                <?php } $_SESSION['excluiuTorcedor'] = null; ?>

                <?php if (isset($_SESSION['excluiuTorcedor']) and $_SESSION['excluiuTorcedor'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao excluir o vídeo!</h5>
                    </div>
                <?php } $_SESSION['excluiuTorcedor'] = null;?>

                <?php
                $stmt = $video->selectPaginacaoTorcedorN((!empty($_GET['paginaTorcedorN'])?($_GET['paginaTorcedorN']):(1)));
                $pkCount = (is_array($stmt)? count($stmt):0);
                if ($pkCount == 0){ ?>
                <p class="font-weight-bold text-danger text-center">Nenhum registro foi encontrado!</p>
                <?php }else{ ?>


                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Data de recebimento</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($video->selectPaginacaoTorcedorN((!empty($_GET['paginaN'])?($_GET['paginaN']):(1)))as $key => $value): ?>
                        <tr>
                            <td class="text-center"><?php $data = new DateTime($value->dataPublicacao); echo $data->format('d/m/Y H:i');?></td>
                            <td class=""><?=$value->tituloVideo?></td>
                            <td><?=$value->autor?></td>
                            <td class="text-center">
                                <a data-toggle="modal" data-target="#visualizarVideoN<?=$value->codigoVideo?>" target="_blank" class="btn px-2 py-0 botao-inserir text-white font-weight-bold">Visualizar <i class="fas fa-eye"></i></a>
                                <a href="?acao=4&publicar=<?=$value->codigoVideo?>" class="btn px-2 py-0 botao-editar text-white font-weight-bold">Publicar <i class="fas fa-check"></i></a>
                                <a href="?acao=21&excluir=<?=$value->codigoVideo?>" id="<?=$value->codigoVideo?>" class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>

                </table>

                <nav class="">

                    <?php
                    $total = count($video->selectTorcedoresNaoPublicados());
                    if ($total>10){?>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="?paginaN=1" aria-label="Anterior">
                                <span class="">Início</span>
                            </a>
                        </li>


                        <?php
                        $total = count($video->selectTorcedoresNaoPublicados());



                        $qtd = ceil($total/10);

                        for ($cont = 1;$cont<=$qtd;$cont++){
                            ?>
                            <li class="page-item"><a class="page-link" href="?paginaN=<?=$cont?>"><?=$cont?></a></li>
                        <?php }?>
                        <li class="page-item">
                            <a class="page-link" href="?paginaN=<?php echo $paginaTorcedorN+1;?>" aria-label="Próximo">
                                <span class="">Próximo</span>
                            </a>
                        </li>
                    </ul>
                    <?php }?>
                </nav>

                <?php }?>
            </div>

            <!--Vídeos dos torcedores publicados-->
            <div class="col-11 col-md-10 mb-5 pb-3 border m-auto my-2">

                <h4 class="text-center font-weight-bold my-4">Videos publicados enviados por torcedores</h4>

                <!--Mensagens a respeito do salvamento de noticias-->
                <?php if (isset($_SESSION['removeuTorcedorP']) and $_SESSION['removeuTorcedorP'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Vídeo removido com sucesso!</h5>
                    </div>
                <?php } $_SESSION['removeuTorcedorP'] = null; ?>

                <?php if (isset($_SESSION['removeuTorcedorP']) and $_SESSION['removeuTorcedorP'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao remover o vídeo!</h5>
                    </div>
                <?php } $_SESSION['removeuTorcedorP'] = null;?>

                <!--Mensagens de Exclusão-->
                <?php if (isset($_SESSION['excluiuTorcedorP']) and $_SESSION['excluiuTorcedorP'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Vídeo excluido com sucesso!</h5>
                    </div>
                <?php } $_SESSION['excluiuTorcedorP'] = null; ?>

                <?php if (isset($_SESSION['excluiuTorcedorP']) and $_SESSION['excluiuTorcedorP'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao excluir o vídeo!</h5>
                    </div>
                <?php } $_SESSION['excluiuTorcedorP'] = null;?>

                <?php
                $stmt = $video->selectPaginacaoTorcedorP((!empty($_GET['paginaTorcedorN'])?($_GET['paginaTorcedorN']):(1)));
                $pkCount = (is_array($stmt)? count($stmt):0);
                if ($pkCount == 0){ ?>
                    <p class="font-weight-bold text-danger text-center">Nenhum registro foi encontrado!</p>
                <?php }else{ ?>


                    <table class="table table-bordered table-sm table-responsive-sm">
                        <thead class="thead-dark">
                        <tr class="p-0 m-0">
                            <th>Data de recebimento</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach ($video->selectPaginacaoTorcedorP((!empty($_GET['paginaP'])?($_GET['paginaP']):(1)))as $key => $value): ?>
                            <tr>
                                <td class="text-center"><?php $data = new DateTime($value->dataPublicacao); echo $data->format('d/m/Y H:i');?></td>
                                <td class=""><?=$value->tituloVideo?></td>
                                <td><?=$value->autor?></td>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#visualizarVideoP<?=$value->codigoVideo?>" target="_blank" class="btn px-2 py-0 botao-inserir text-white font-weight-bold">Visualizar <i class="fas fa-eye"></i></a>
                                    <a href="?acao=5&remover=<?=$value->codigoVideo?>" class="btn px-2 py-0 botao-editar text-white font-weight-bold">Remover <i class="fas fa-minus"></i></a>
                                    <a href="?acao=22&excluir=<?=$value->codigoVideo?>" id="<?=$value->codigoVideo?>" class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>

                    </table>

                    <nav class="">

                        <?php
                        $total = count($video->selectTorcedoresPublicados());
                        if ($total>10){?>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="?paginaP=1" aria-label="Anterior">
                                        <span class="">Início</span>
                                    </a>
                                </li>


                                <?php
                                $total = count($video->selectTorcedoresPublicados());



                                $qtd = ceil($total/10);

                                for ($cont = 1;$cont<=$qtd;$cont++){
                                    ?>
                                    <li class="page-item"><a class="page-link" href="?paginaP=<?=$cont?>"><?=$cont?></a></li>
                                <?php }?>
                                <li class="page-item">
                                    <a class="page-link" href="?paginaP=<?php echo $paginaTorcedorP+1;?>" aria-label="Próximo">
                                        <span class="">Próximo</span>
                                    </a>
                                </li>
                            </ul>
                        <?php }?>
                    </nav>

                <?php }?>
            </div>







            <!--MODAL DE INSERIR NOVO VIDEO-->
            <div class="col-12">

                <!-- Modal -->
                <div class="modal fade" id="novoVideo" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center">Inserir novo vídeo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form class="" id="formulario-video" enctype="multipart/form-data" action="../../controller/VideosController.php" method="post">

                                    <div class="form-row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="hidden" value="1" name="acao"/>
                                                <label for="tituloVideo">Título do vídeo *</label>
                                                <input type="text" class="form-control" name="tituloVideo" id="tituloVideo" placeholder="Título" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="hidden" value="2" name="tipo"/>
                                                <label for="descricaoVideo">Descrição do vídeo *</label>
                                                <input type="text" class="form-control" name="descricaoVideo" id="descricaoVideo" placeholder="Descrição" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <p class="font-weight-bold">Video * <small class="text-muted">Tamanho limite de 50MB</small></p>

                                                <input type="file" class="form-control-file logo-video" name="video" id="logoApoiadores" accept="video/*" required>
                                                <button type="button" class="input-label input-label-video"><span class="label-span">Selecionar video</span> <i class="fas fa-upload"></i></button>
                                                <span class="custom-text-video">Nenhum arquivo selecionado </span>
                                                <a class="reset-input reset-input-video d-none"><i class="fas fa fa-times-circle"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <p class="font-weight-bold">Poster do vídeo</p>

                                                <input type="file" class="form-control-file logo-poster" name="poster" id="logoApoiadores" accept="image/*">
                                                <button type="button" class="input-label input-label-poster"><span class="label-span">Selecionar imagem</span> <i class="fas fa-upload"></i></button>
                                                <span class="custom-text-poster">Nenhum arquivo selecionado </span>
                                                <a class="reset-input reset-input-poster d-none"><i class="fas fa fa-times-circle"></i></a>
                                            </div>
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                                <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-video">Salvar <i class="far fa-save"></i></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!--MODAL DE EDITAR VIDEO-->
            <!-- Modal -->
            <?php foreach ($video->selectPaginacao((!empty($_GET['pagina'])?($_GET['pagina']):(1)))as $key => $value): ?>
                <div class="modal fade" id="editarVideo<?=$value->codigoVideo?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center">Editar vídeo "<?=$value->tituloVideo?>"</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="" id="formulario-video" enctype="multipart/form-data" action="../../controller/VideosController.php" method="post">

                                    <div class="form-row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="hidden" value="3" name="acao"/>
                                                <input type="hidden" value="<?=$value->codigoVideo?>" name="codigoVideo"/>
                                                <label for="tituloVideo">Título do vídeo *</label>
                                                <input type="text" class="form-control" name="tituloVideo" id="tituloVideo" value="<?=$value->tituloVideo?>" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="hidden" value="2" name="tipo"/>
                                                <label for="descricaoVideo">Descrição do vídeo</label>
                                                <input type="text" class="form-control" name="descricaoVideo" id="descricaoVideo" value="<?=$value->descricaoVideo?>"  required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group inputff">
                                                <p class="font-weight-bold">Video do apoiador <small class="text-muted">Tamanho limite de 50MB</small></p>
                                                <p><a href="../videos/<?=$value->video?>" target="_blank">Vídeo atual</a></p>

                                                <input type="file" class="form-control-file logo-editar" name="video" id="logoApoiadores" accept="video/*">
                                                <button type="button" class="input-label input-label-editar"><span class="label-span">Selecionar novo video</span> <i class="fas fa-upload"></i></button>
                                                <span class="custom-text-editar">Nenhum arquivo selecionado </span>
                                                <a class="reset-input reset-input-editar d-none"><i class="fas fa fa-times-circle"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="editar-poster">

                                                    <p class="font-weight-bold">Poster do vídeo</p>
                                                    <?php

                                                    if(!$value->poster == null){ ?>

                                                        <p><a href="../videos/poster/<?=$value->poster?>" target="_blank">Poster atual</a></p>
                                                    <?php };

                                                    ?>
                                                    <input type="file" class="form-control-file logo-poster-editar" name="poster" id="logoApoiadores" accept="image/*">
                                                    <button type="button" class="input-label input-label-poster-editar"><span class="label-span">Selecionar imagem</span> <i class="fas fa-upload"></i></button>
                                                    <span class="custom-text-poster-editar">Nenhum arquivo selecionado </span>
                                                    <a class="reset-input reset-input-poster-editar d-none"><i class="fas fa fa-times-circle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                                <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-video-editado">Salvar <i class="far fa-save"></i></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php endforeach; ?>

        <!--Modal de visualizar vídeos da aesb-->
        <?php foreach ($video->selectPaginacao((!empty($_GET['pagina'])?($_GET['pagina']):(1)))as $key => $value): ?>
        <div class="col-12">

            <!-- Modal -->
            <div class="modal fade" id="visualizarVideo<?=$value->codigoVideo?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center">Visualizar "<?=$value->tituloVideo?>"</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <video class="w-100 video" poster="../videos/poster/<?=$value->poster?>" controls>
                                <source src="../videos/<?=$value->video?>">
                                <embed src="../videos/<?=$value->video?>" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always">
                                Formato não suportado pelo navegador.
                            </video>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php endforeach; ?>

        <!--Modal de visualizar vídeos do torcedor não publicados-->
        <?php foreach ($video->selectPaginacaoTorcedorN((!empty($_GET['paginaN'])?($_GET['paginaN']):(1)))as $key => $value): ?>
            <div class="col-12">

                <!-- Modal -->
                <div class="modal fade" id="visualizarVideoN<?=$value->codigoVideo?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center">Visualizar "<?=$value->tituloVideo?>"</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <video class="w-100 video" controls>
                                    <source src="../videos/torcedores/<?=$value->video?>">
                                    <embed src="../videos/torcedores/<?=$value->video?>" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always">
                                    Formato não suportado pelo navegador.
                                </video>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>

        <!--Modal de visualizar vídeos do torcedor já publicados-->
        <?php foreach ($video->selectPaginacaoTorcedorP((!empty($_GET['paginaP'])?($_GET['paginaP']):(1)))as $key => $value): ?>
            <div class="col-12">

                <!-- Modal -->
                <div class="modal fade" id="visualizarVideoP<?=$value->codigoVideo?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center">Visualizar "<?=$value->tituloVideo?>"</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <video class="w-100 video" poster="../videos/poster/<?=$value->poster?>" controls>
                                    <source src="../videos/torcedores/<?=$value->video?>">
                                    <embed src="../videos/torcedores/<?=$value->video?>" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always">
                                    Formato não suportado pelo navegador.
                                </video>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>

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
<script src="../js/ajax/xhttp.js"></script>
<script src="../js/moduloGestao/videos-gestao.js"></script>
</html>
