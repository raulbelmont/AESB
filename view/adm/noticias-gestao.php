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

/*Instanciando controller de noticia*/
require_once '../../model/NoticiasModel.php';
$noticia = new NoticiasModel();

/*Publicar*/
if (!empty($_GET['publicar'])){
    $_SESSION['publicar'] = $_GET['publicar'];
    $_SESSION['isPublicada'] = $_GET['isPublicada'];
    header('location:../../controller/NoticiasController.php?acao=4');
}	
/*Excluir*/
if (!empty($_GET['acao']) == 2){
    $_SESSION['excluir'] = $_GET['excluir'];
    header('location:../../controller/NoticiasController.php?acao=2');
}

/*Paginação*/
$itensPorPagina = 10;
if (!empty($_GET['pagina'])){
    $pagina = $_GET['pagina'];
}else{
    $pagina = 1;
}

if (!empty($_GET['paginaN'])){
    $paginaN = $_GET['paginaN'];
}else{
    $paginaN = 1;
}
$numTotalItens = count($noticia->selectAllIsPublicada(1));
$numPaginas = ceil($numTotalItens/$itensPorPagina);
?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloGestao/noticias-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Notícias</title>

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

            <div class="col-12">
                <h1 class="font-weight-bold text-center my-5">Notícias <i class="fa fa-newspaper"></i></h1>
            </div>


            <!--mensagens-->
            <div class="col-12 col-md-12 mb-5 pb-3 m-auto">
                <!--Mensagens a respeito do salvamento de noticias-->
                <?php if (isset($_SESSION['salvou']) and $_SESSION['salvou'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Notícia publicada com sucesso!</h5>
                    </div>
                <?php } $_SESSION['salvou'] = null; ?>

                <?php if (isset($_SESSION['salvou']) and $_SESSION['salvou'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao salvar a notícia!</h5>
                    </div>
                <?php } $_SESSION['salvou'] = null;?>

                <!--Mensagens de Exclusão-->
                <?php if (isset($_SESSION['excluiu']) and $_SESSION['excluiu'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Notícia excluida com sucesso!</h5>
                    </div>
                <?php } $_SESSION['excluiu'] = null; ?>

                <?php if (isset($_SESSION['excluiu']) and $_SESSION['excluiu'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado ao excluir a notícia!</h5>
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

                <!--Mensagem de publicação-->
                <?php if (isset($_SESSION['publicou']) and $_SESSION['publicou'] == true){ ?>
                    <div class="mensagem-de-sucesso p-2 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                        <h5 class="text-success font-weight-bold">Sucesso!</h5>
                    </div>
                <?php } $_SESSION['publicou'] = null; ?>

                <?php if (isset($_SESSION['publicou']) and $_SESSION['publicou'] == false){ ?>
                    <div class="mensagem-de-erro p-0 my-2 text-center justify-content-center d-block">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                        <h5 class="text-danger font-weight-bold">Ops! Alguma coisa deu errado.</h5>
                    </div>
                <?php } $_SESSION['publicou'] = null;?>

            </div>

            <!--NOTICIAS EM ANALISE-->
            <div class="col-11 col-md-12 mb-5 pb-3 border m-auto">

                <h4 class="text-center font-weight-bold">Notícias em análise</h4>
                <a class="btn p-2 m-2 botao-inserir text-white font-weight-bold" href="nova-noticia.php">Nova notícia <i class="fas fa-plus-circle"></i></a>


                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Data de publicação</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Última atualização</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($noticia->selectPaginacaoNaoPublic((!empty($_GET['paginaN'])?($_GET['paginaN']):(1)))as $key => $value): ?>
                        <tr>

                            <td class="text-center"><?php $data = new DateTime($value->dataPublicacao); echo $data->format('d/m/Y H:i');?></td>
                            <td class=""><?=$value->tituloNoticia?></td>
                            <td><?=$value->autor?></td>
                            <td class="text-center"><?php
                                if ($value->ultimaAtualizacao == NULL){
                                    echo '-';
                                }else{
                                    $data = new DateTime($value->ultimaAtualizacao);
                                    echo $data->format('d/m/Y H:i');
                                }
                                ?></td>
                            <td class="text-center">
                                <a href="visualizar-noticia.php?noticia=<?=$value->codigoNoticia?>" target="_blank" class="btn px-2 py-0 botao-inserir text-white font-weight-bold">Visualizar <i class="fas fa-eye"></i></a>
                                <a href="editar-noticia.php?noticia=<?=$value->codigoNoticia?>" class="btn px-2 py-0 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                                <a href="?acao=2&excluir=<?=$value->codigoNoticia?>" class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                                <a href="?isPublicada=1&publicar=<?=$value->codigoNoticia?>" class=" my-2 btn px-2 py-0 botao-inserir text-white font-weight-bold">Publicar <i class="fas fa-pen-square"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>

                </table>

                <nav class="">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="?paginaN=1" aria-label="Anterior">
                                <span class="">Início</span>
                            </a>
                        </li>


                        <?php $total = count($noticia->selectAllIsPublicada(0));

                        $qtd = ceil($total/10);

                        for ($cont = 1;$cont<=$qtd;$cont++){
                            ?>
                            <li class="page-item"><a class="page-link" href="?paginaN=<?=$cont?>"><?=$cont?></a></li>
                        <?php }?>
                        <li class="page-item">
                            <a class="page-link" href="?paginaN=<?php echo $paginaN+1;?>" aria-label="Próximo">
                                <span class="">Próximo</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!--NOTICIAS PUBLICADAS-->
            <div class="col-11 col-md-12 mb-5 pb-3 border m-auto">

                <h4 class="text-center font-weight-bold">Últimas Notícias</h4>

                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-dark">
                    <tr class="p-0 m-0">
                        <th>Data de publicação</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Última atualização</th>
                        <th>Nº de Acessos</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($noticia->selectPaginacao((!empty($_GET['pagina'])?($_GET['pagina']):(1)))as $key => $value): ?>
                        <tr>

                            <td class="text-center"><?php $data = new DateTime($value->dataPublicacao); echo $data->format('d/m/Y H:i');?></td>
                            <td class=""><?=$value->tituloNoticia?></td>
                            <td><?=$value->autor?></td>
                            <td class="text-center"><?php
                                    if ($value->ultimaAtualizacao == NULL){
                                        echo '-';
                                }else{
                                        $data = new DateTime($value->ultimaAtualizacao);
                                        echo $data->format('d/m/Y H:i');
                                    }
                                ?></td>
                            <td><?=$value->numAcessos?></td>
                            <td class="text-center">
                                <a href="visualizar-noticia.php?noticia=<?=$value->codigoNoticia?>" target="_blank" class="btn px-2 py-0 botao-inserir text-white font-weight-bold">Visualizar <i class="fas fa-eye"></i></a>
                                <a href="editar-noticia.php?noticia=<?=$value->codigoNoticia?>" class="btn px-2 py-0 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                                <a href="?acao=2&excluir=<?=$value->codigoNoticia?>" class="btn px-2 py-0 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                                <a href="?isPublicada=0&publicar=<?=$value->codigoNoticia?>" class="btn my-2  px-2 py-0 botao-excluir text-white font-weight-bold">Remover <i class="fas fa-minus"></i></a>
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


                        <?php $total = count($noticia->selectAllIsPublicada(1));

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
<script src="../js/moduloGestao/noticias-gestao.js"></script>


</html>