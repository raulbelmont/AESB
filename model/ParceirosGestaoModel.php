<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 18/10/2018
 * Time: 17:06
 */

require_once 'CRUD.php';
class ParceirosGestaoModel extends CRUD
{

    private $codigoParceiro;
    private $logoParceiro;
    private $tipo;
    private $nome;

    protected $table = 'parceiros';

    /*insert*/
    public function insert()
    {
        $sql = "INSERT INTO $this->table 
        (logoParceiro,tipo,nomeParceiro)
        VALUES (:logoParceiro,:tipo,:nomeParceiro)";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':logoParceiro', $this->logoParceiro);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':nomeParceiro', $this->nome);
        return $stmt->execute();
    }

    /*select*/
    public function selectParceiro($codigoParceiro){
        $sql = "SELECT * FROM $this->table WHERE codigoParceiro = :codigoParceiro";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoParceiro',$codigoParceiro,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /*update*/
    public function updateParceiro($codigoParceiro){

        $sql = "UPDATE $this->table SET logoParceiro= :logoParceiro, tipo= :tipo, nomeParceiro = :nomeParceiro WHERE codigoParceiro = :codigoParceiro";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':logoParceiro',$this->logoParceiro, PDO::PARAM_STR);
        $stmt->bindParam(':tipo',$this->tipo,PDO::PARAM_INT);
        $stmt->bindParam(':nomeParceiro',$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(':codigoParceiro',$codigoParceiro, PDO::PARAM_INT);
        return $stmt->execute();

    }

    public function deletar($codigoParceiro){
        $sql = "DELETE  FROM $this->table WHERE codigoParceiro =:codigoParceiro";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoParceiro',$codigoParceiro,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function selectParceiros($tipo){
        $sql = "SELECT * FROM $this->table WHERE tipo = :tipo";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':tipo',$tipo,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    /**
     * @return mixed
     */
    public function getCodigoParceiro()
    {
        return $this->codigoParceiro;
    }

    /**
     * @param mixed $codigoParceiro
     */
    public function setCodigoParceiro($codigoParceiro)
    {
        $this->codigoParceiro = $codigoParceiro;
    }

    /**
     * @return mixed
     */
    public function getLogoParceiro()
    {
        return $this->logoParceiro;
    }

    /**
     * @param mixed $logoParceiro
     */
    public function setLogoParceiro($logoParceiro)
    {
        $this->logoParceiro = $logoParceiro;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
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


}