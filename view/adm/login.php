<!doctype html>
<html>

<head>

    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloGestao/login.css"/>
	<link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>Módulo de Gestão - Entrar</title>


</head>
<body>

<div class="container-fluid justify-content-center align-self-center">

    <div class="mt-4 row align-self-center justify-content-center">


        <form class="formulario-login" action="../../controller/UsuarioController.php" method="post">

            <input type="hidden" name="acao" value="logar">

            <div class="cabecalho">
                <a href="../index.php" class="text-center"><h1 class="font-weight-bold cabecalho">AESB</h1></a>
            </div>

            <h2 class="text-danger font-weight-bold my-5 text-center">Acesso restrito <i class="fas fa-exclamation-triangle"></i></h2>

            <label class="col-form-label font-weight-bold" for="login">E-mail  <i class="fas fa-envelope"></i></label>
            <input class="mb-2 input-group" type="text" name="email" required/>

            <label class="col-form-label font-weight-bold" for="senha">Senha <i class="fas fa-key"></i></label>
            <input class="mb-2 input-group" type="password" name="senha" required/>

            <button class="btn btn-block my-3 font-weight-bold botao-login" type="submit" name="enviar">Entrar</button>

            <?php if (!empty($_GET['login']) == 'error'){ ?>
            <div class="mensagem-de-erro p-2 text-center justify-content-center">
                <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                <h5 class="text-danger font-weight-bold">Ops! E-mail ou senha incorretos. Tente Novamente.</h5>
            </div>
            <?php } ?>

            <?php if (!empty($_GET['excluiu']) and $_GET['excluiu'] == true){ ?>
                <div class="mensagem-de-sucesso p-2 text-center justify-content-center">
                    <i class="fas fa-exclamation-circle fa-2x text-success"></i>
                    <h5 class="text-success font-weight-bold">Conta excluída com sucesso!</h5>
                </div>
            <?php } ?>

            <a href="../index.php"><span><i class="fas fa-long-arrow-alt-left"></i> Voltar</span></a>
        </form>

    </div>

</div>

<script src="../js/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
<script src="../js/moduloGestao/login.js"></script>
</body>

</html>