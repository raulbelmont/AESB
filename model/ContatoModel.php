<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 05/10/2018
 * Time: 13:45
 */

require_once 'CRUD.php';

class ContatoModel extends CRUD
{

    private $codigoContato;
    private $nome;
    private $telefone;
    private $email;
    private $isVoluntario;
    private $isDesejaAssociarse;
    private $mensagem;
    private $curriculo;
    private $dataContatacao;

    protected $table = "contato";


    public function insert()
    {
        $sql = "INSERT INTO $this->table 
        (nome,telefone,email,isVoluntario,isDesejaAssociarse,mensagem,curriculo,dataContatacao)
        VALUES (:nome,:telefone,:email,:isVoluntario,:isDesejaAssociarse,:mensagem,:curriculo,:dataContatacao)";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':isVoluntario', $this->isVoluntario);
        $stmt->bindParam(':isDesejaAssociarse', $this->isDesejaAssociarse);
        $stmt->bindParam(':mensagem', $this->mensagem);
        $stmt->bindParam(':curriculo', $this->curriculo);
        $stmt->bindParam(':dataContatacao', $this->dataContatacao);
        return $stmt->execute();
    }

    public function updateContato($codigoContato){
        $sql = "UPDATE $this->table SET visualizado = 'true' WHERE codigoContato = :codigoContato";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoContato',$codigoContato,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function selectContato($codigoContato){
        $sql = "SELECT * FROM $this->table WHERE codigoContato = :codigoContato";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoContato',$codigoContato,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function selectContatos($parametro){
        $sql = "SELECT * FROM $this->table WHERE visualizado = :parametro ORDER BY dataContatacao DESC";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':parametro',$parametro, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deletar($codigoContato){
        $sql = "DELETE FROM $this->table WHERE codigoContato =:codigoContato";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoContato',$codigoContato,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * @return mixed
     */
    public function getCodigoContato()
    {
        return $this->codigoContato;
    }

    /**
     * @param mixed $codigoContato
     */
    public function setCodigoContato($codigoContato)
    {
        $this->codigoContato = $codigoContato;
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
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
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
    public function getisVoluntario()
    {
        return $this->isVoluntario;
    }

    /**
     * @param mixed $isVoluntario
     */
    public function setIsVoluntario($isVoluntario)
    {
        $this->isVoluntario = $isVoluntario;
    }

    /**
     * @return mixed
     */
    public function getisDesejaAssociarse()
    {
        return $this->isDesejaAssociarse;
    }

    /**
     * @param mixed $isDesejaAssociarse
     */
    public function setIsDesejaAssociarse($isDesejaAssociarse)
    {
        $this->isDesejaAssociarse = $isDesejaAssociarse;
    }

    /**
     * @return mixed
     */
    public function getMensagem()
    {
        return $this->mensagem;
    }

    /**
     * @param mixed $mensagem
     */
    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    /**
     * @return mixed
     */
    public function getCurriculo()
    {
        return $this->curriculo;
    }

    /**
     * @param mixed $curriculo
     */
    public function setCurriculo($curriculo)
    {
        $this->curriculo = $curriculo;
    }

    /**
     * @return mixed
     */
    public function getDataContatacao()
    {
        return $this->dataContatacao;
    }

    /**
     * @param mixed $dataContatacao
     */
    public function setDataContatacao($dataContatacao)
    {
        $this->dataContatacao = $dataContatacao;
    }



}