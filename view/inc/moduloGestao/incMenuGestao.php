  <?php 
require_once '../../model/UsuarioModel.php';
require_once '../../model/ImagensModel.php';
$usuario = new UsuarioModel();
$imagem = new ImagensModel();

/*Validando usuario*/

if ($_SESSION['logado'] == true){
    $usuario->usuarioLogado($_SESSION['usuario']);
}else{
    header('location:login.php');
}

?>
  <?php $img = $imagem->selectAllByLocal(5);?>
        <link rel="stylesheet" href="../css/moduloGestao/incMenuGestao.css"/>

 <div class="bg-dark menu-topo">
        <div id="container" class="container-fluid fixed-top">
            <div class="row menu">

                 <div class="p-3 font-weight-bold botoes-usuario">
                    <a href="meu-perfil.php"><span class="botao-de-conta p-3 perfil"><span class="d-none d-md-inline"><?=$_SESSION['nome']?></span> <i class="fas fa-user fa-1x"></i></span></a>
                    <a href="?sair=true"><span class="bg-danger p-3 text-white sair"><span class="d-none d-md-inline">Sair</span> <i class="fas fa-sign-out-alt"></i></span></a>
                </div>
                <h1 class="d-none d-lg-block font-weight-bold text-center text-white align-self-center mx-auto titulo-do-menu"><a href="home.php"><span class="titulo-do-menu-span invisible">Módulo de gestão de conteúdo <i class="fa fa-cogs"></i></span></a></h1>

                <a class="navbar-toggler menu-toggler ml-auto ml-lg-0 mr-4 p-3 font-weight-bold" data-toggle="collapse" data-target="#menu-principal">
                    <span><i id="icone-toggler-menu" class="fas fa-bars fa-2x"></i> <i id="icone-toggler-menu-x" class="fas fa-times d-none fa-2x"></i></span>
                </a>


                   <nav id="menu-principal" class="collapse navbar-collapse">
                        <ul class="navbar-nav text-center">
                            <li class="nav-item">
                                <a class="nav-link" href="home.php">Início</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="clube-gestao.php">Clube</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="imagens-gestao.php">Imagens</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="videos-gestao.php">Vídeos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="parceiros-gestao.php">Parceiros</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="elenco-gestao.php">Elenco</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="competicoes-gestao.php">Competições</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="jogos-gestao.php">Jogos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="historia-gestao.php">História</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contatos-gestao.php">Contatos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="noticias-gestao.php">Notícias</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="usuarios-gestao.php">Usuários</a>
                            </li>
                        </ul>
                </nav>
           </div>
        </div>
         <div class="container-fluid">

            <div class="row">

                <div class="col-12 text-center">

                    <a href="home.php"><img class="img-fluid my-4 imagem-cabecalho d-none d-md-inline" src="../img/<?=$img[0]->imagem?>"/><br/></a>

                    <h1 class="font-weight-bold text-center text-white mt-5 mt-md-1"><span>Módulo de gestão de conteúdo <i class="fa fa-cogs"></i><span></span></h1>

                </div>

            </div>

        </div>
    </div>

        <script src="../js/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="../js/moduloGestao/incMenuGestao.js"></script>