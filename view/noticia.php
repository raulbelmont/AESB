<?php
/*Buscando notícia*/
if (!empty($_GET['noticia'])){
    require_once '../model/NoticiasModel.php';
    $noticia = new NoticiasModel();

    $codigoNoticia = $_GET['noticia'];
    $noticiaAtual = $noticia->selectPorCodigo($codigoNoticia);
    $numAcessosNow = $noticiaAtual->numAcessos;
    $numAcessosNow++;
    $noticia->contadorAcesso($codigoNoticia,$numAcessosNow);
}else{
    header('location:index.php');
}
?>

<!doctype html>
<html>

<head>

    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<!--Meta tags do facebook-->
	<meta property="og:url"                content="https://aesaoborja.com.br/view/noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="<?= $noticiaAtual->tituloNoticia ?>" />
    <meta property="og:description"        content="<?= $noticiaAtual->descricaoNoticia ?>" />
    <?php
    if (!$noticiaAtual->fundoNoticia == null){
        $var = $noticiaAtual->fundoNoticia;
        $ext = explode('.', $var);

        if ($ext[1] == 'jpg') {
            $ext[1] = 'jpeg';
        }
        ?>
        <meta property="og:image" content="https://aesaoborja.com.br/view/img/noticias/<?=$var?>" />
        <meta property="og:image:type" content="image/<?=$ext[1]?>" />
    <?php }else{?>
        <meta property="og:image" content="https://aesaoborja.com.br/view/img/noticias/fundo-neutro.png" />
        <meta property="og:image:type" content="image/png" />

    <?php } ?>
    <!-- Fim das meta tags do facebook-->

    <!--Meta tags do Twitter-->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:image" content="https://aesaoborja.com.br/view/img/noticias/<?=$noticiaAtual->fundoNoticia?>">
    <meta name="twitter:creator" content="@ae_saoborja">
    <meta name="twitter:description" content="<?=$noticiaAtual->descricaoNoticia ?>">
    <meta name="twitter:title" content="<?= $noticiaAtual->tituloNoticia ?>">
    <!--Fim das meta tags do twitter-->
          
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/moduloGestao/noticias-gestao.css"/>
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <title>AESB - Notícia</title>

</head>

<body>
  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
<header>
    <?php
    include 'inc/incMenuPrincipal.php';
    ?>

</header>


<main>

    <div class="container-fluid">
        <div class="row mb-0">
             <div class="col-12 col-md-9 m-auto">

                <div class="cabecalho-noticia border-bottom">
                    <h1 class="text-center my-2 font-weight-bold"><?= $noticiaAtual->tituloNoticia ?></h1>

                    <h5 class="text-muted my-5"><?= $noticiaAtual->descricaoNoticia ?></h5>

                   <div class="row">
                        <div class="col-12 col-sm-6">
                        <p class=" my-0 font-weight-bold">Publicado por <?= $noticiaAtual->autor ?></p>
                        <p class="text-muted small">
                            <?php
                                $data = new DateTime($noticiaAtual->dataPublicacao);
                                echo $data->format('d/m/Y H:i');

                                if (!$noticiaAtual->ultimaAtualizacao == NULL){
                                    $dataA = new DateTime($noticiaAtual->ultimaAtualizacao);

                                    echo ' - Atualizado em '.$dataA->format('d/m/Y H:i');
                                }
                            ?>
                        </p>    
						</div>

                    


                    
                    <div class="col-12 col-md-3 d-block d-sm-flex my-1 my-sm-auto">
                        <div class="fb-like mb-1 mb-sm-0 mr-1" data-href="https://aesaoborja.com.br/view/noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="true"></div>
                        <a href="https://twitter.com/" class="twitter-share-button" data-lang="pt" data-show-count="false" data-size="large">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>

                    <div class="col-12 col-sm-2 my-1 my-sm-auto">
                        

                        
                    </div>
   
                   </div>
                    

                </div>
            </div>


        <div class="m-auto mt-0">

            <?php
                if (!$noticiaAtual->fundoNoticia == null){
            ?>
			<div class="text-center">
                <img src="img/noticias/<?=$noticiaAtual->fundoNoticia?>" alt="Fundo" class="img-noticia col-11 col-sm-10 col-lg-6 w-100 img-fluid p-1 my-1" style="object-fit: scale-down;">

			</div>

            <?php } ?>
            
			<article class="border-bottom p-4 m-0 col-11 col-md-9 m-auto"><?=$noticiaAtual->corpoNoticia?></article>
        </div>



    

                

            </div>
        </div>
		<div class="row m-0 justify-content-center">
            
            <div class="col-8 text-center">
                <div class="fb-comments" data-href="https://aesaoborja.com.br/view/noticia.php?noticia=<?=$noticiaAtual->codigoNoticia?>" data-colorscheme="light" data-numposts="10" data-width="100%"></div>                
            </div>

        </div>
    </div>

</main>
<footer>
    <?php
    include 'inc/incRodapePrincipal.php';
    ?>
</footer>

</body>

<script src="js/jquery-3.3.1.js"></script>
<script src="js/jquery-migrate-1.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script src="js/moduloGestao/noticias-gestao.js"></script>


</html>
