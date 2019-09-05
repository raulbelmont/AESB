<?php
require_once '../../model/UsuarioModel.php';
require_once '../../model/ClubeModel.php';
$usuario = new UsuarioModel();
$clubeObj = new ClubeModel();
$clube = $clubeObj->selectClube(1);
/*Validando usuario*/

if ($_SESSION['logado'] == true){
    $usuario->usuarioLogado($_SESSION['usuario']);
}else{
    header('location:login.php');
}

?>

<link rel="stylesheet" href="../css/moduloGestao/incRodapeGestao.css"/>

  <div class="container-fluid rodape mt-2">
        <div class="row bg-dark">

            <div class="my-2 pl-2 pl-sm-0">
                <img class="float-left ml-5 mr-2 d-none d-sm-block logo-rodape" src="../img/<?=$clube->logo?>" alt="Logo da AESB"/></a>
                <p class="d-flex text-uppercase m-0 p-0 text-white mt-2">Associação Esportiva São Borja</p>
                <p class="text-white">© 2018 Todos os direitos reservados</p>
            </div>
        </div>
    </div>
<div class="smoothscroll-top">
        <span class="scroll-top-inner">
            <i class="fas fa-2x fa-angle-double-up"></i>
        </span>
</div>

<script src="../js/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="../js/moduloGestao/incRodapeGestao.js"></script>