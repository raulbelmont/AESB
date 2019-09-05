<?php
    require_once '../PHPMailer/PHPMailer-master/src/SMTP.php';
    require_once '../PHPMailer/PHPMailer-master/src/PHPMailer.php';
    /**
     * Created by PhpStorm.
     * User: Raul
     * Date: 05/10/2018
     * Time: 13:42
     */
    date_default_timezone_set('America/Sao_Paulo');
    if (!session_id()) session_start();

    require_once '../model/ContatoModel.php';
    $contato = new ContatoModel();

    /*Captando contatos*/
    if (!empty($_POST['acao']) and $_POST['acao'] == 1){
        /*PEGANDO DADOS DO FORMULÁRIO DE CONTATO*/


        $contato->setNome($_POST['nomeContato']);

        $contato->setTelefone($_POST['telefoneContato']);

        if (isset($_POST['emailContato'])){
            $contato->setEmail($_POST['emailContato']);
        }else{
            $contato->setEmail(null);
        }

        if(isset($_POST['isVoluntario'])){
            $contato->setIsVoluntario($_POST['isVoluntario']);
        }else{
            $contato->setIsVoluntario(0);
        }

        $contato->setMensagem($_POST['mensagem']);

        if(isset($_POST['isDesejaAssociarse'])){

            $contato->setIsDesejaAssociarse($_POST['isDesejaAssociarse']);
        }else{
            $contato->setIsDesejaAssociarse(0);
        }

        if(isset($_FILES['curriculo'])){
            $uploaddir = '../view/curriculos/';
            $uploadfile = $uploaddir . basename($_FILES['curriculo']['name']);
            if (move_uploaded_file($_FILES['curriculo']['tmp_name'], $uploadfile)) {
                $contato->setCurriculo($_FILES['curriculo']['name']);
            } else {
                $contato->setCurriculo(null);
            }
        }
        $date = date('Y-m-d H:i:s');
        $contato->setDataContatacao($date);


        /*GRAVANDO DADOS NO BANCO E ENVIANDO EMAILS*/
        if ($contato->insert()){

            /*REDIRECIONANDO DADOS PARA A AESB*/
            $mailer = new \PHPMailer\PHPMailer\PHPMailer();
            $mailer->CharSet = "utf8";
            $mailer->SMTPDebug = false;
            $mailer->isSMTP();
            $mailer->Host="aesaoborja.com.br";
            $mailer->SMTPAuth = true;
            $mailer->Username = "contato@aesaoborja.com.br";
            $mailer->Password = "VEI&EY5FN8dL";
            $mailer->SMTPSecure = 'ssl';
            $mailer->Port = 465;
            $mailer->FromName = $contato->getNome();
            $mailer->From = "contato@aesaoborja.com.br";
            //$mailer->addAddress("contatoaesb@gmail.com");
            $mailer->addAddress("contato@aesaoborja.com.br");
            $mailer->isHTML(true);

            if($contato->getCurriculo() != null){
                $textoCurriculo = "Desejo trabalhar com vocês e o meu currículo está em anexo!<br/>";
                $nome = $_FILES['curriculo']['name'];
                $dir = '../view/curriculos/';
                $arquivo = $dir.$nome;
                $mailer->addAttachment($arquivo);
            }else{
                $textoCurriculo = '';
            }



            $dataContatacao = date('d/m/Y H:m');
            $mailer->Subject = "E-mail de Contato - ". $contato->getNome()."  ". $dataContatacao;

            if ($contato->getisVoluntario() == 1){
                $voluntario = 'Desejo ser voluntário e ajudar a AESB';
            }else{
                $voluntario = '';
            }

            if($contato->getIsDesejaAssociarse() == 1){
                $desejaSerSocio = "Desejo ser Sócio";
            }else{
                $desejaSerSocio = '';
            }


            $mailer->Body =
                "E-mail enviado por: ".$contato->getNome()."<br/>".
                "Telefone para contato: ".$contato->getTelefone()."<br/>".
                "E-mail para contato: ".$contato->getEmail()."<br/>".
                "<strong>$voluntario<strong><br/>".
                "<strong>$desejaSerSocio<strong><br/>".
                "<strong>Mensagem:</strong><br/>".
                "<p style='margin: 5px;'>". $contato->getMensagem(). "</p>";
            "<p>$textoCurriculo<p>";



            if (($mailer->send()) && ($contato->getEmail() != null)){
                /*ENVIANDO E-MAIL DE CONFIRMAÇÃO AO CLIENTE*/
                $mailer = new \PHPMailer\PHPMailer\PHPMailer();
                $mailer->CharSet = "utf8";
                $mailer->SMTPDebug = false;
                $mailer->isSMTP();
                $mailer->Host="aesaoborja.com.br";
                $mailer->SMTPAuth = true;
                $mailer->Username = "contato@aesaoborja.com.br";
                $mailer->Password = "VEI&EY5FN8dL";
                $mailer->SMTPSecure = 'ssl';
                $mailer->Port = 465;
                $mailer->FromName = "Associação Esportiva São Borja.";
                $mailer->From = "contato@aesaoborja.com.br";
                //$mailer->addAddress("contatoaesb@gmail.com");
                $mailer->addAddress($contato->getEmail());
                $mailer->isHTML(true);
                $mailer->Subject = "Agradecimento - Recebemos sua mensagem ". $contato->getNome();

                if ($contato->getisVoluntario() == 1){
                    $mensagem = 'Obrigado por se voluntariar para ajudar no desenvolvimento da AESB, entraremos em contato com você!';
                }else{
                    $mensagem = '';
                }

                if($contato->getIsDesejaAssociarse() == 1){
                    $mensagemSocio = "Também recebemos sua solicitação para ser sócio, em breve entraremos em contato com você para acertar os detalhes mas por enquanto pedimos quue você preencha o seguinte formulário:";
                    $linkSocio = "https://docs.google.com/forms/d/e/1FAIpQLSfg90Er056IpCvCsT7zLRp5KLPuqOTR_utOfJn_Nc0DUIor_Q/viewform";
                }else{
                    $mensagemSocio = '';
                    $linkSocio='';
                }

                if($contato->getCurriculo() != null){
                    $textoCurriculo = "Prezado, nós recebemos o seu currículo e agradecemos o seu interesse pela empresa, caso exista uma oportunidade dentro do seu perfil entraremos em contato!<br/>";
                }else{
                    $textoCurriculo = '';
                }

                $mailer->Body =
                    "<strong>ASSOCIAÇÃO ESPORTIVA SÃO BORJA</strong>".
                    "<p>Olá ".$contato->getNome()."!</p>".
                    "<p>Recebemos a sua mensagem, muito obrigado por entrar em contato, a sua opnião e a sua mensagem contam muito para nós e ajudam muito no nosso desenvolvimento!</p>".
                    "<p>$mensagem</p>".
                    "<strong style='margin: 5px'>$mensagemSocio</strong>".
                    "<a href='$linkSocio'>Formulário para associar-se</a>".
                    "<p>$textoCurriculo</p>".
                    "<p>Estamos a sua disposição, qualquer dúvida você pode entrar em contato conosco:</p>".
                    "<p>Pelo telefone: (55)3431-0162</p>".
                    "<p>Ou pelo E-mail: contato@aesaoborja.com.br</p>".
                    "<p>Tenha um bom dia, atenciosamente <strong>Associação Esportiva São Borja.</strong></p>".
                    "<strong style='margin: 5px'><i>Está mensagem é gerada automaticamente, por favor não a responda.</i></strong>";

                if ($mailer->send()){
                    header("location:../view/contato.php?email=true");
                    die;
                }else{
                    header("location:../view/contato.php?email=true");
                    die;
                }


            }else{
                if ($contato->getEmail() == null){
                    header("location:../view/contato.php?email=true");
                    die;
                }else{
                    header("location:../view/contato.php?email=false");
                    die;
                }
            }





        }else{
            header("location:../view/contato.php?email=false");
            die;
        }
    }

    /*Excluir contato*/
    if (!empty($_GET['acao']) and $_GET['acao'] == 2){
        $codigoContato = $_SESSION['excluir'];

        if ($contato->deletar($codigoContato)){
            $_SESSION['excluiu'] = true;
            $_SESSION['excluir'] = null;
            header('location:../view/adm/contatos-gestao.php');
        }else{
            $_SESSION['excluiu'] = false;
            $_SESSION['excluir'] = null;
            header('location:../view/adm/contatos-gestao.php');
        }
    }

