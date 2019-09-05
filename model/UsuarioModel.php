<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 11/10/2018
 * Time: 14:42
 */
require_once "CRUD.php";
class UsuarioModel extends CRUD
{
    private $codigoUsuario;
    private $email;
    private $senha;
    private $nome;
    private $nivel;

    protected $table = "usuario";

    public function inserirUsuario(){
        $sql = "INSERT INTO $this->table (nome,email,senha,nivel) VALUES (:nome,:email,:senha,:nivel)";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
        $stmt->bindParam(':senha',$this->senha,PDO::PARAM_STR);
        $stmt->bindParam(':nivel',$this->nivel,PDO::PARAM_INT);
        return $stmt->execute();

    }

    public function selectUsuario($codigoUsuario){
        $sql="SELECT * FROM $this->table WHERE codigoUsuario = :codigoUsuario";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoUsuario', $codigoUsuario,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function logar(){

        try{
            $sql = "SELECT * FROM $this->table
        WHERE email = :email AND senha = :senha";
            $stmt = Conecta::prepare($sql);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->execute();
            if ($stmt->rowCount() == 0){
                header('location:../view/adm/login.php?login=error');
            }else{
                session_start();
                $result = $stmt->fetch();
                $_SESSION['logado'] = true;
                $_SESSION['usuario'] = $result->codigoUsuario;
                header('location:../view/adm/home.php');
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }



    }

    public function logarEditar($email,$senha){
        $sql = "SELECT * FROM $this->table
        WHERE email = :email AND senha = :senha";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        return $stmt->fetch();
    }


    public function usuarioLogado($codigoUsuario){
        $sql = "SELECT * FROM $this->table
        WHERE codigoUsuario = :codigoUsuario";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoUsuario',$codigoUsuario,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        $_SESSION['nome']=$result->nome;
        $_SESSION['senha']=$result->senha;
        $_SESSION['email']=$result->email;
        $_SESSION['nivel']=$result->nivel;
        $_SESSION['codigoUsuario']=$result->codigoUsuario;

    }

    public function logoff(){
        session_unset($_SESSION);
        session_destroy();
        header("location:login.php");
    }

    public function deletarUsuario($codigoUsuario){
        $sql = "DELETE FROM $this->table WHERE codigoUsuario = :codigoUsuario";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoUsuario',$codigoUsuario,PDO::PARAM_INT);
        $stmt->execute();
        session_unset($_SESSION);
        session_destroy();
        $_SESSION['excluiu'] = true;
        header("location:login.php?excluiu=true");
    }

    public function deletar($codigoUsuario){
        $sql = "DELETE FROM $this->table WHERE codigoUsuario = :codigoUsuario";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoUsuario',$codigoUsuario, PDO::PARAM_INT);
        $_SESSION['excluiu'] = true;
        return $stmt->execute();
    }

    public function updateUsuario($codigoUsuario){
        $sql = "UPDATE $this->table SET email = :email, senha = :senha, nome = :nome WHERE codigoUsuario = :codigoUsuario";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
        $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
        $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(':codigoUsuario',$codigoUsuario,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateUsuarioMaster($codigoUsuario){
        $sql = "UPDATE $this->table SET email = :email, senha = :senha, nome = :nome, nivel = :nivel WHERE codigoUsuario = :codigoUsuario";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
        $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
        $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(':nivel',$this->nivel,PDO::PARAM_INT);
        $stmt->bindParam(':codigoUsuario',$codigoUsuario,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function insert()
    {

    }

    public function update()
    {

    }

    /**
     * @return mixed
     */
    public function getCodigoUsuario()
    {
        return $this->codigoUsuario;
    }

    /**
     * @param mixed $id
     */
    public function setCodigoUsuario($codigoUsuario)
    {
        $this->codigoUsuario = $codigoUsuario;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * @param mixed $nivel
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }




}