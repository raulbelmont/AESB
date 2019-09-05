<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 11/10/2018
 * Time: 14:54
 */

    require_once '../model/UsuarioModel.php';
    $usuario = new UsuarioModel();
if (!session_id()) session_start();

    /*Logar*/
    if (!empty($_POST['acao']) and $_POST['acao'] == 'logar'){
        $email = $_POST['email'];
        $senha  = $_POST['senha'];
        $senhaCriptografada = sha1($senha);
        $usuario->setEmail($email);
        $usuario->setSenha($senhaCriptografada);
        $usuario->logar();
    }

    /*Editando próprio perfil*/
    if (!empty($_POST['acao']) and $_POST['acao'] == 3){



        $codigoUsuario =  $_POST['codigoUsuario'];
        $nome =  $_POST['nome'];
        $email =  $_POST['email'];
        $manterSenha =  $_POST['manterSenha'];

        if ($manterSenha == 1){

            $usuarioAtual = $usuario->selectUsuario($_SESSION['usuario']);
            $senhaCriptografada = $usuarioAtual->senha;
        }else{
            if ($manterSenha == 2){
                $senha = $_POST['novaSenha'];
                $senhaCriptografada = sha1($senha);
            }
        }



        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senhaCriptografada);

        if ($usuario->updateUsuario($codigoUsuario)){
          $usuarioLogado = $usuario->logarEditar($email,$senhaCriptografada);

            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $usuarioLogado->codigoUsuario;

            $_SESSION['editou'] = true;
            header('location:../view/adm/meu-perfil.php');

        }else{
            $_SESSION['editou'] = false;
            header('location:../view/adm/meu-perfil.php');
       }



    }

    if (!empty($_POST['acao']) and $_POST['acao'] == 33){
        $codigoUsuario =  $_POST['codigoUsuario'];
        $nome =  $_POST['nome'];
        $email =  $_POST['email'];
        $nivel = $_POST['nivel'];
        $manterSenha =  $_POST['manterSenha'];

        if ($manterSenha == 1){

            $usuarioAtual = $usuario->selectUsuario($codigoUsuario);
            $senhaCriptografada = $usuarioAtual->senha;
        }else{
            if ($manterSenha == 2){
                $senha = $_POST['novaSenha'];
                $senhaCriptografada = sha1($senha);
            }
        }



        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senhaCriptografada);
        $usuario->setNivel($nivel);

        if ($codigoUsuario == $_SESSION['codigoUsuario']){
            if ($usuario->updateUsuarioMaster($codigoUsuario)){
                $usuarioLogado = $usuario->logarEditar($email,$senhaCriptografada);

                $_SESSION['logado'] = true;
                $_SESSION['usuario'] = $usuarioLogado->codigoUsuario;

                $_SESSION['editou'] = true;
                header('location:../view/adm/usuarios-gestao.php');

            }else{
                $_SESSION['editou'] = false;
                header('location:../view/adm/usuarios-gestao.php');
            }

        }else{

            if ($usuario->updateUsuarioMaster($codigoUsuario)){
                $_SESSION['editou'] = true;
                header('location:../view/adm/usuarios-gestao.php');
            }else{
                $_SESSION['editou'] = false;
                header('location:../view/adm/usuarios-gestao.php');

            }

        }


    }

    /*Excluindo usuário*/
    if (!empty($_GET['acao']) and $_GET['acao'] == 2){
        $codigoUsuario = $_SESSION['excluirUsuario'];

        if ($codigoUsuario == $_SESSION['codigoUsuario']){

            if ($usuario->deletarUsuario($codigoUsuario)){
                $_SESSION['excluiu'] = true;
                $_SESSION['excluir'] = null;
                header('location:../view/adm/usuarios-gestao.php');
            }else{
                $_SESSION['excluiu'] = false;
                $_SESSION['excluir'] = null;
                header('location:../view/adm/usuarios-gestao.php');
            }


        }else{

            if ($usuario->deletar($codigoUsuario)){
                $_SESSION['excluiu'] = true;
                $_SESSION['excluir'] = null;
                header('location:../view/adm/usuarios-gestao.php');
            }else{
                $_SESSION['excluiu'] = false;
                $_SESSION['excluir'] = null;
                header('location:../view/adm/usuarios-gestao.php');
            }

        }
    }

    /*Inserindo novo usuário*/
    if (!empty($_POST['acao']) and $_POST['acao'] == 1){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['novaSenha'];
        $senhaCriptografada = sha1($senha);
        $nivel = $_POST['nivel'];

        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senhaCriptografada);
        $usuario->setNivel($nivel);

        if ($usuario->inserirUsuario()){
            $_SESSION['salvou'] = true;
            header('location:../view/adm/usuarios-gestao.php');
        }else{
            $_SESSION['salvou'] = false;
            header('location:../view/adm/usuarios-gestao.php');
        }
    }


    /*metodo ajax de verificação de senha */
    if (!empty($_POST['senhaAtual'])){
    $senhaAtual = sha1($_POST['senhaAtual']);

    if ($senhaAtual == $_SESSION['senha']){
        echo 'true';
    }else{
        echo 'false';
    }
}