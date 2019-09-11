<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 24/12/2018
 * Time: 09:03
 */
require_once 'CRUD.php';
class CompeticoesModel extends CRUD
{
    private $codigoCompeticoes;
    private $nome;
    private $faseAtual;
    private $regras;
    private $situacaoClube;
    private $dataPublicacao;


    protected $table = 'competicoes';

    public function inserir(){
        $sql = "INSERT INTO $this->table 
        (nome,faseAtual,regras,situacaoClube,dataPublicacao)
        VALUES (:nome,:faseAtual,:regras,:situacaoClube,:dataPublicacao)";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(':faseAtual',$this->faseAtual,PDO::PARAM_STR);
        $stmt->bindParam(':regras',$this->regras,PDO::PARAM_STR);
        $stmt->bindParam(':situacaoClube',$this->situacaoClube,PDO::PARAM_STR);
        $stmt->bindParam(':dataPublicacao',$this->dataPublicacao,PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deletar($codigoCompeticao){
        $sql = "DELETE FROM $this->table WHERE codigoCompeticao = :codigoCompeticao";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoCompeticao',$codigoCompeticao,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateCompeticao($codigoCompeticao){
        $sql = "UPDATE $this->table SET nome= :nome, faseAtual= :faseAtual, 
        regras = :regras, situacaoClube = :situacaoClube, dataPublicacao = :dataPublicacao
        WHERE codigoCompeticao = :codigoCompeticao";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(':faseAtual',$this->faseAtual,PDO::PARAM_STR);
        $stmt->bindParam(':regras',$this->regras,PDO::PARAM_STR);
        $stmt->bindParam(':situacaoClube',$this->situacaoClube,PDO::PARAM_STR);
        $stmt->bindParam(':dataPublicacao',$this->dataPublicacao,PDO::PARAM_STR);
        $stmt->bindParam(':codigoCompeticao',$codigoCompeticao,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function selectByData(){
        $sql = "SELECT * FROM $this->table ORDER BY dataPublicacao DESC";
        $stmt = Conecta::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectCompeticao($codigoCompeticao){
        $sql = "SELECT * FROM $this->table WHERE codigoCompeticao = :codigoCompeticao";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoCompeticao',$codigoCompeticao,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }


    public function insert()
    {
        // TODO: Implement insert() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * @return mixed
     */
    public function getCodigoCompeticoes()
    {
        return $this->codigoCompeticoes;
    }

    /**
     * @param mixed $codigoCompeticoes
     */
    public function setCodigoCompeticoes($codigoCompeticoes)
    {
        $this->codigoCompeticoes = $codigoCompeticoes;
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
    public function getFaseAtual()
    {
        return $this->faseAtual;
    }

    /**
     * @param mixed $faseAtual
     */
    public function setFaseAtual($faseAtual)
    {
        $this->faseAtual = $faseAtual;
    }

    /**
     * @return mixed
     */
    public function getRegras()
    {
        return $this->regras;
    }

    /**
     * @param mixed $regras
     */
    public function setRegras($regras)
    {
        $this->regras = $regras;
    }

    /**
     * @return mixed
     */
    public function getSituacaoClube()
    {
        return $this->situacaoClube;
    }

    /**
     * @param mixed $situacaoClube
     */
    public function setSituacaoClube($situacaoClube)
    {
        $this->situacaoClube = $situacaoClube;
    }

    /**
     * @return mixed
     */
    public function getDataPublicacao()
    {
        return $this->dataPublicacao;
    }

    /**
     * @param mixed $dataPublicacao
     */
    public function setDataPublicacao($dataPublicacao)
    {
        $this->dataPublicacao = $dataPublicacao;
    }




}