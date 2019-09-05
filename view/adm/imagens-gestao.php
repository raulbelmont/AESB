<?php
require_once '../../model/UsuarioModel.php';
require_once '../../model/ImagensModel.php';
$usuario = new UsuarioModel();
$imagem = new ImagensModel();

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

/*Excluindo imagem*/
if (!empty($_GET['acao']) and $_GET['acao'] == 2){
    $_SESSION['excluir'] = $_GET['excluir'];
    header('location:../../controller/ImagensController.php?acao=2');
}

?>
<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloGestao/imagens-gestao.css"/>
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Imagens</title>

</head>

<body>

<header>
    <?php
    include '../inc/moduloGestao/incMenuGestao.php';
    ?>

</header>

<main>

    <div class="container-fluid">

        <!--titulo-->
        <div class="row">
            <h1 class="font-weight-bold text-center my-5 col-12">Imagens <i class="fas fa-images"></i></h1>
        </div>

        <!--Messages-->
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

        <!--carrosel inicial-->
        <div class="row justify-content-center py-3 border-top">

            <h4 class="col-12 text-center font-weight-bold">Carrosel Inicial</h4>
            <p class="text-muted text-center col-12 mb-5">As imagens dessa seção aparecerão no carrosel de abertura da página inicial do site.</p>

            <div class="col-12 text-center mb-4">
                <a data-toggle="modal" data-target="#inserirCarroselInicial"  class="btn botao-inserir font-weight-bold text-white">Inserir nova <i class="fas fa-images"></i> </a>
            </div>

            <?php foreach ($imagem->selectAllByLocal(1) as $key => $value):

                /*titulo*/
                if ($value->titulo == null){
                    $titulo = 'Não Informado';
                }else{
                    $titulo = $value->titulo;
                }

                /*legenda*/
                if ($value->legenda == null){
                    $legenda = 'Não Informado';
                }else{
                    $legenda = $value->legenda;
                }


            ?>
            <div class="col-12 col-sm-6 col-md-3">
                <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="">
                    <figure>
                        <img src="../img/<?=$value->imagem?>" class="w-100 imagem">
                        <figcaption class="text-center border-bottom pb-3">
                            <h5 class="font-weight-bold titulo-imagem m-0">Título: <span class="font-weight-normal"><?=$titulo?></span></h5>
                            <p class="font-weight-bold legenda-imagem m-0">Legenda: <span class="font-weight-normal"><?=$legenda?></span></p>
                        </figcaption>
                    </figure>

                    <div class="row justify-content-center">
                        <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-inserir text-white font-weight-bold">Ver <i class="fas fa-eye"></i></a>
                        <a data-toggle="modal" data-target="#editarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                        <a href="?acao=2&excluir=<?=$value->codigoImagem?>"  class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                    </div>

                </a>
            </div>
            <?php endforeach; ?>

        </div>

        <!--espaço-->
        <div class="row">
            <div class="col-12 bg-dark py-2 my-2">
                <p class="invisible">Espaço</p>
            </div>
        </div>

        <!--Chamada para o próximo jogo-->
        <div class="row justify-content-center">

            <h4 class="col-12 text-center font-weight-bold">Chamada para o próximo jogo</h4>
            <p class="text-muted text-center col-12 mb-5">A imagem dessa seção aparecerá no espaço reservado a chamada do próximo jogo.</p>

            <?php foreach ($imagem->selectAllByLocal(2) as $key => $value):

                /*titulo*/
                if ($value->titulo == null){
                    $titulo = 'Não Informado';
                }else{
                    $titulo = $value->titulo;
                }

                /*legenda*/
                if ($value->legenda == null){
                    $legenda = 'Não Informado';
                }else{
                    $legenda = $value->legenda;
                }


                ?>
                <div class="col-12 col-sm-6 col-md-4">
                    <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="">
                        <figure>
                            <img src="https://aesaoborja.com.br/view/img/<?=$value->imagem?>" class="w-100 imagem">
                            <figcaption class="text-center border-bottom pb-3">
                                <h5 class="font-weight-bold titulo-imagem m-0">Título: <span class="font-weight-normal"><?=$titulo?></span></h5>
                                <p class="font-weight-bold legenda-imagem m-0">Legenda: <span class="font-weight-normal"><?=$legenda?></span></p>
                            </figcaption>
                        </figure>

                        <div class="row justify-content-center">
                            <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-inserir text-white font-weight-bold">Ver <i class="fas fa-eye"></i></a>
                            <a data-toggle="modal" data-target="#editarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                            <a href="?acao=2&excluir=<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                        </div>

                    </a>
                </div>
            <?php endforeach; ?>

        </div>

        <!--espaço-->
        <div class="row">
            <div class="col-12 bg-dark py-2 my-2">
                <p class="invisible">Espaço</p>
            </div>
        </div>


        <!--Anuncio principal e secundário-->
        <div class="row justify-content-center py-3">

            <!--Anuncio principal-->
            <div class="col-12 col-md-6 border-right anuncio-principal">
                <div class="row justify-content-center">
                    <h4 class="col-12 text-center font-weight-bold">Anúncio principal</h4>
                    <p class="text-muted text-center col-12 mb-5">Esse anúncio aparecerá independentemente do tamanho da tela.</p>

                    <?php foreach ($imagem->selectAllByLocal(3) as $key => $value):

                        /*titulo*/
                        if ($value->titulo == null){
                            $titulo = 'Não Informado';
                        }else{
                            $titulo = $value->titulo;
                        }

                        /*legenda*/
                        if ($value->legenda == null){
                            $legenda = 'Não Informado';
                        }else{
                            $legenda = $value->legenda;
                        }


                        ?>
                        <div class="col-12 col-sm-6 col-md-6">
                            <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="">
                                <figure>
                                    <img src="../img/<?=$value->imagem?>" class="w-100 imagem">
                                    <figcaption class="text-center border-bottom pb-3">
                                        <h5 class="font-weight-bold titulo-imagem m-0">Título: <span class="font-weight-normal"><?=$titulo?></span></h5>
                                        <p class="font-weight-bold legenda-imagem m-0">Legenda: <span class="font-weight-normal"><?=$legenda?></span></p>
                                    </figcaption>
                                </figure>

                                <div class="row justify-content-center">
                                    <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-inserir text-white font-weight-bold">Ver <i class="fas fa-eye"></i></a>
                                    <a data-toggle="modal" data-target="#editarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                                    <a href="?acao=2&excluir=<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                                </div>

                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!--espaço-->
            <div class="col-12 d-block d-md-none bg-dark py-2 my-2">
                <p class="invisible">Espaço</p>
            </div>

            <!--Anúncio secundário-->
            <div class="col-12 col-md-6">
                <div class="row justify-content-center">
                    <h4 class="col-12 text-center font-weight-bold">Anúncio secundário</h4>
                    <p class="text-muted text-center col-12 mb-5">Esse anúncio aparecerá apenas em telas maiores ao lado do anúncio principal.</p>

                    <?php foreach ($imagem->selectAllByLocal(4) as $key => $value):

                        /*titulo*/
                        if ($value->titulo == null){
                            $titulo = 'Não Informado';
                        }else{
                            $titulo = $value->titulo;
                        }

                        /*legenda*/
                        if ($value->legenda == null){
                            $legenda = 'Não Informado';
                        }else{
                            $legenda = $value->legenda;
                        }


                        ?>
                        <div class="col-12 col-sm-6 col-md-6">
                            <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="">
                                <figure>
                                    <img src="../img/<?=$value->imagem?>" class="w-100 imagem">
                                    <figcaption class="text-center border-bottom pb-3">
                                        <h5 class="font-weight-bold titulo-imagem m-0">Título: <span class="font-weight-normal"><?=$titulo?></span></h5>
                                        <p class="font-weight-bold legenda-imagem m-0">Legenda: <span class="font-weight-normal"><?=$legenda?></span></p>
                                    </figcaption>
                                </figure>

                                <div class="row justify-content-center">
                                    <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-inserir text-white font-weight-bold">Ver <i class="fas fa-eye"></i></a>
                                    <a data-toggle="modal" data-target="#editarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                                    <a href="?acao=2&excluir=<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                                </div>

                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>

        <!--espaço-->
        <div class="row">
            <div class="col-12 bg-dark py-2 my-2">
                <p class="invisible">Espaço</p>
            </div>
        </div>

        <!--Logo do clube-->
        <div class="row justify-content-center">

            <h4 class="col-12 text-center font-weight-bold">Logo do clube</h4>
            <p class="text-muted text-center col-12 mb-5">A logo do clube aparecerá em locais onde seja necessária uma exibição da mesma em maior escala por isso é altamente recomendado que se uso uma imagem com uma dimensão grande.</p>

            <?php foreach ($imagem->selectAllByLocal(5) as $key => $value):

                /*titulo*/
                if ($value->titulo == null){
                    $titulo = 'Não Informado';
                }else{
                    $titulo = $value->titulo;
                }

                /*legenda*/
                if ($value->legenda == null){
                    $legenda = 'Não Informado';
                }else{
                    $legenda = $value->legenda;
                }


                ?>
                <div class="col-12 col-sm-6 col-md-4">
                    <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="">
                        <figure>
                            <img src="../img/<?=$value->imagem?>" class="w-100 imagem">
                            <figcaption class="text-center border-bottom pb-3">
                                <h5 class="font-weight-bold titulo-imagem m-0">Título: <span class="font-weight-normal"><?=$titulo?></span></h5>
                                <p class="font-weight-bold legenda-imagem m-0">Legenda: <span class="font-weight-normal"><?=$legenda?></span></p>
                            </figcaption>
                        </figure>

                        <div class="row justify-content-center">
                            <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-inserir text-white font-weight-bold">Ver <i class="fas fa-eye"></i></a>
                            <a data-toggle="modal" data-target="#editarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                            <a href="?acao=2&excluir=<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                        </div>

                    </a>
                </div>
            <?php endforeach; ?>

        </div>

        <!--espaço-->
        <div class="row">
            <div class="col-12 bg-dark py-2 my-2">
                <p class="invisible">Espaço</p>
            </div>
        </div>

        <!--carrosel final-->
        <div class="row justify-content-center py-3 border-top">

            <h4 class="col-12 text-center font-weight-bold">Carrosel de Imagens na página inicial</h4>
            <p class="text-muted text-center col-12 mb-5">As imagens dessa seção aparecerão no carrosel no final da página inicial do site.</p>

            <?php
            $stmt = $imagem->selectAllByLocal(6);
            $pkCount = (is_array($stmt)? count($stmt):0);
            if ($pkCount == 0){ ?>

                <div class="col-12 text-center">
                    <a data-toggle="modal" data-target="#inserirCarroselFinal"  class="btn botao-inserir font-weight-bold text-white">Inserir nova <i class="fas fa-images"></i> </a>
                </div>

                <h5 class="font-weight-bold col-12 text-danger text-center">Ainda não há imagens cadastradas.</h5>


            <?php }else{
                ?>
                <div class="col-12 text-center mb-4">
                    <a data-toggle="modal" data-target="#inserirCarroselFinal"  class="btn botao-inserir font-weight-bold text-white">Inserir nova <i class="fas fa-images"></i> </a>
                </div>

                <?php foreach ($imagem->selectAllByLocal(6) as $key => $value):

                    /*titulo*/
                    if ($value->titulo == null){
                        $titulo = 'Não Informado';
                    }else{
                        $titulo = $value->titulo;
                    }

                    /*legenda*/
                    if ($value->legenda == null){
                        $legenda = 'Não Informado';
                    }else{
                        $legenda = $value->legenda;
                    }


                    ?>



                    <div class="col-12 col-sm-6 col-md-3 m-3">
                        <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="">
                            <figure>
                                <img src="../img/<?=$value->imagem?>" class="w-100 imagem">
                                <figcaption class="text-center border-bottom pb-3">
                                    <h5 class="font-weight-bold titulo-imagem m-0">Título: <span class="font-weight-normal"><?=$titulo?></span></h5>
                                    <p class="font-weight-bold legenda-imagem m-0">Legenda: <span class="font-weight-normal"><?=$legenda?></span></p>
                                </figcaption>
                            </figure>

                            <div class="row justify-content-center">
                                <a data-toggle="modal" data-target="#visualizarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-inserir text-white font-weight-bold">Ver <i class="fas fa-eye"></i></a>
                                <a data-toggle="modal" data-target="#editarImagem<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-editar text-white font-weight-bold">Editar <i class="fas fa-edit"></i></a>
                                <a href="?acao=2&excluir=<?=$value->codigoImagem?>" class="col-10 col-sm-6 col-xl-3 btn px-2 py-0 m-1 botao-excluir text-white font-weight-bold">Excluir <i class="fas fa-trash-alt"></i></a>
                            </div>

                        </a>
                    </div>
                <?php endforeach;
            } ?>

        </div>

        <!--Modal de visualizar imagem-->
        <div class="row">

            <?php foreach ($imagem->selectAll() as $key => $value):

                if ($value->localizacao == 1){
                    $cabecalho = 'Carrosel Inicial';

                    /*titulo*/
                    if ($value->titulo == null){
                        $titulo = 'Não Informado';
                    }else{
                        $titulo = $value->titulo;
                    }

                    /*legenda*/
                    if ($value->legenda == null){
                        $legenda = 'Não Informado';
                    }else{
                        $legenda = $value->legenda;
                    }


                }
                if ($value->localizacao == 2){
                    $cabecalho = 'Chamada para o próximo jogo';
                    $titulo = '';
                    $legenda = '';
                }
                if ($value->localizacao == 3){
                    $cabecalho = 'Anúncio principal';
                    $titulo = '';
                    $legenda = '';
                }
                if ($value->localizacao == 4){
                    $cabecalho = 'Anúncio secundário';
                    $titulo = '';
                    $legenda = '';
                }
                if ($value->localizacao == 5){
                    $cabecalho = 'Logo do clube';
                    $titulo = '';
                    $legenda = '';
                }
                if ($value->localizacao == 6){
                    $cabecalho = 'Carrosel de Imagens na página inicial';

                    /*titulo*/
                    if ($value->titulo == null){
                        $titulo = 'Não Informado';
                    }else{
                        $titulo = $value->titulo;
                    }

                    /*legenda*/
                    if ($value->legenda == null){
                        $legenda = 'Não Informado';
                    }else{
                        $legenda = $value->legenda;
                    }
                }

                /*Última atualização*/
                if ($value->ultimaAtualizacao == null){
                    $ultimaAtualizacao = '';
                    $display = 'd-none';
                }else{
                    $data = new DateTime($value->ultimaAtualizacao);
                    $ultimaAtualizacao = $data->format('d/m/Y - H:m');
                    $display = 'd-block';
                }

            ?>
            <!-- Modal -->
            <div class="modal fade" id="visualizarImagem<?=$value->codigoImagem?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?=$cabecalho?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <figure class="col-7">
                                    <img src="../img/<?=$value->imagem?>" class="w-100">

                                    <figcaption class="text-center">

                                        <h5 class="">Título: <span class="font-weight-bold"><?=$titulo?></span></h5>
                                        <p class="">Legenda: <span class="font-weight-bold"><?=$legenda?></span></p>
                                        <p class="<?=$display?>">Atualizado em: <span class="font-weight-bold"><?=$ultimaAtualizacao?></span></p>

                                    </figcaption>
                                </figure>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>

        <!--Modais de inserção-->
        <div class="row">

            <!--Modal de inserir do carrosel inicial-->
            <div class="modal fade" id="inserirCarroselInicial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Inserir imagem <i class="fas fa-images"></i></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="inserirCarroselInicialForm" class="" enctype="multipart/form-data" action="../../controller/ImagensController.php" method="POST">
                                <div class="form-row justify-content-center">

                                    <input type="hidden" name="acao" value="1">
                                    <input type="hidden" name="localizacao" value="1">

                                    <!--Título-->
                                    <div class="form-group col-11 font-weight-bold">
                                        <label for="titulo">Título <span class="text-muted">(opcional)</span></label>
                                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo">
                                    </div>

                                    <!--Legenda-->
                                    <div class="form-group col-11 font-weight-bold">
                                        <label for="legenda">Legenda <span class="text-muted">(opcional)</span></label>
                                        <input type="text" class="form-control" name="legenda" id="legenda" placeholder="Legenda">
                                    </div>

                                    <!--Imagem-->
                                    <div class="form-group col-11">
                                        <p class="font-weight-bold">Imagem * <small class="small text-danger">3000x600 é o tamanho de imagem fortemente recomendado.</small></p>
                                        <input type="file" class="form-control-file logo-imagem1 d-none" name="imagem" id="imagem1" accept="image/*" required>
                                        <button type="button" class="input-label input-label-imagem1"><span class="label-span">Selecionar imagem</span> <i class="fas fa-upload"></i></button>
                                        <span class="custom-text-imagem1">Nenhum arquivo selecionado </span>
                                        <a class="reset-input reset-input-imagem1 d-none"><i class="fas fa fa-times-circle"></i></a>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                                    <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-imagem1">Salvar <i class="far fa-save"></i></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!--Modal de inserir do carrosel final-->
            <!-- Modal -->
            <div class="modal fade" id="inserirCarroselFinal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Inserir imagem <i class="fas fa-images"></i></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="inserirCarroselFinalForm" class="" enctype="multipart/form-data" action="../../controller/ImagensController.php" method="POST">
                                <div class="form-row justify-content-center">

                                    <input type="hidden" name="acao" value="1">
                                    <input type="hidden" name="localizacao" value="6">

                                    <!--Título-->
                                    <div class="form-group col-11 font-weight-bold">
                                        <label for="titulo">Título <span class="text-muted">(opcional)</span></label>
                                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo">
                                    </div>

                                    <!--Legenda-->
                                    <div class="form-group col-11 font-weight-bold">
                                        <label for="legenda">Legenda <span class="text-muted">(opcional)</span></label>
                                        <input type="text" class="form-control" name="legenda" id="legenda" placeholder="Legenda">
                                    </div>

                                    <!--Imagem-->
                                    <div class="form-group col-11">
                                        <p class="font-weight-bold">Imagem * <small class="small text-danger">3000x600 é o tamanho de imagem fortemente recomendado.</small></p>
                                        <input type="file" class="form-control-file logo-imagem2 d-none" name="imagem" id="imagem2" accept="image/*" required>
                                        <button type="button" class="input-label input-label-imagem2"><span class="label-span">Selecionar imagem</span> <i class="fas fa-upload"></i></button>
                                        <span class="custom-text-imagem2">Nenhum arquivo selecionado </span>
                                        <a class="reset-input reset-input-imagem2 d-none"><i class="fas fa fa-times-circle"></i></a>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                                    <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-imagem2">Salvar <i class="far fa-save"></i></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--Modais de edição-->
        <div class="row">


            <!--Modal de editar-->
            <?php foreach ($imagem->selectAll() as $key => $value):

                if ($value->localizacao == 1){
                    $cabecalho = 'Carrosel Inicial';
                    $tamanho = '3000px <i class="fas fa-times"></i> 600px é o tamanho de imagem fortemente recomendado.';

                }
                if ($value->localizacao == 2){
                    $cabecalho = 'Chamada para o próximo jogo';
                    $tamanho = '790px <i class="fas fa-times"></i> 1100px é o tamanho de imagem fortemente recomendado.';
                }
                if ($value->localizacao == 3){
                    $cabecalho = 'Anúncio principal';
                    $tamanho = '800px <i class="fas fa-times"></i> 100px é o tamanho de imagem fortemente recomendado.';
                }
                if ($value->localizacao == 4){
                    $cabecalho = 'Anúncio secundário';
                    $tamanho = '800px <i class="fas fa-times"></i> 100px é o tamanho de imagem fortemente recomendado.';
                }
                if ($value->localizacao == 5){
                    $cabecalho = 'Logo do clube';
                    $tamanho = '120px <i class="fas fa-times"></i> 140px é o tamanho de imagem fortemente recomendado.';
                }
                if ($value->localizacao == 6){
                    $cabecalho = 'Carrosel de Imagens na página inicial';
                    $tamanho = '3000px <i class="fas fa-times"></i> 600px é o tamanho de imagem fortemente recomendado.';
                }
            ?>

            <div class="modal fade" id="editarImagem<?=$value->codigoImagem?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar imagem <i class="fas fa-images"></i> - <?=$cabecalho?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="editarImagemForm<?=$value->codigoImagem?>" class="" enctype="multipart/form-data" action="../../controller/ImagensController.php" method="POST">
                                <div class="form-row justify-content-center">

                                    <input type="hidden" name="acao" value="3">
                                    <input type="hidden" name="localizacao" value="<?=$value->localizacao?>">
                                    <input type="hidden" name="codigoImagem" value="<?=$value->codigoImagem?>">


                                    <!--Título-->
                                    <div class="form-group col-11 font-weight-bold">
                                        <label for="titulo">Título <span class="text-muted">(opcional)</span></label>
                                        <input type="text" class="form-control" name="titulo" id="titulo" value="<?=$value->titulo?>" placeholder="Titulo">
                                    </div>

                                    <!--Legenda-->
                                    <div class="form-group col-11 font-weight-bold border-bottom pb-3">
                                        <label for="legenda">Legenda <span class="text-muted">(opcional)</span></label>
                                        <input type="text" class="form-control" name="legenda" id="legenda" value="<?=$value->legenda?>" placeholder="Legenda">
                                    </div>

                                    <div class="form-group col-12 col-sm-10 col-md-8 col-lg-6 my-2 py-2">
                                        <p class="text-center font-weight-bold">Imagem atual</p>
                                        <img src="../img/<?=$value->imagem?>" class="img-thumbnail">
                                    </div>

                                    <!--Imagem-->
                                    <div class="form-group col-11 border-top inputff">
                                        <p class="font-weight-bold">Selecionar nova imagem</p>
                                        <p><small class="small text-danger"><?=$tamanho?></small></p>
                                        <input type="file" class="form-control-file logo-editar d-none" name="imagem" id="imagemEditar" accept="image/*">
                                        <button type="button" class="input-label input-label-editar"><span class="label-span">Selecionar imagem</span> <i class="fas fa-upload"></i></button>
                                        <span class="custom-text-editar">Nenhum arquivo selecionado </span>
                                        <a class="reset-input reset-input-editar d-none"><i class="fas fa fa-times-circle"></i></a>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn botao-excluir text-white font-weight-bold" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
                                    <button type="submit" class="btn botao-inserir text-white font-weight-bold submit-editar-imagem<?=$value->codigoImagem?>">Salvar <i class="far fa-save"></i></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach;?>

        </div>


    </div>



</main>

<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/jquery-migrate-1.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
<script src="../js/moduloGestao/imagens-gestao.js"></script>


</html>