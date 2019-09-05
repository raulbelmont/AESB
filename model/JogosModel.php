<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 24/12/2018
 * Time: 15:07
 */
require_once 'CRUD.php';
class JogosModel extends CRUD
{
    private $codigoJogo;
    private $mandanteAbreviacao;
    private $visitanteAbreviacao;
    private $logoMandante;
    private $logoVisitante;
    private $placarMandante;
    private $placarVisitante;
    private $dataJogo;
    private $horario;
    private $localJogo;
    private $tipo;

    /*FK da tabela de competições*/
    private $codigoCompeticao;

    protected $table = 'jogos';


    public function inserirJogo(){
        $sql = "INSERT INTO $this->table (mandanteAbreviacao, visitanteAbreviacao, logoMandante, logoVisitante, placarMandante,
        placarVisitante, dataJogo, horario, localJogo,codigoCompeticao) VALUES (:mandanteAbreviacao, :visitanteAbreviacao, :logoMandante, :logoVisitante, :placarMandante,
        :placarVisitante, :dataJogo, :horario, :localJogo, :codigoCompeticao)";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':mandanteAbreviacao', $this->mandanteAbreviacao, PDO::PARAM_STR);
        $stmt->bindParam(':visitanteAbreviacao', $this->visitanteAbreviacao, PDO::PARAM_STR);
        $stmt->bindParam(':logoMandante', $this->logoMandante, PDO::PARAM_STR);
        $stmt->bindParam(':logoVisitante', $this->logoVisitante, PDO::PARAM_STR);
        $stmt->bindParam(':placarMandante', $this->placarMandante);
        $stmt->bindParam(':placarVisitante', $this->placarVisitante);
        $stmt->bindParam(':dataJogo', $this->dataJogo);
        $stmt->bindParam(':horario', $this->horario);
        $stmt->bindParam(':localJogo', $this->localJogo, PDO::PARAM_STR);
        $stmt->bindParam(':codigoCompeticao', $this->codigoCompeticao);
        return $stmt->execute();
    }

    public function deletar($codigoJogo){
        $sql = "DELETE FROM $this->table WHERE codigoJogo = :codigoJogo";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoJogo',$codigoJogo,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deletarByCompeticao($codigoCompeticao){
        $sql = "DELETE FROM $this->table WHERE codigoCompeticao = :codigoCompeticao";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoCompeticao',$codigoCompeticao,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateJogo($codigoJogo){
        $sql = "UPDATE $this->table SET mandanteAbreviacao = :mandanteAbreviacao, visitanteAbreviacao = :visitanteAbreviacao, 
        logoMandante = :logoMandante, logoVisitante = :logoVisitante, placarMandante = :placarMandante, placarVisitante = :placarVisitante,
        dataJogo = :dataJogo, horario = :horario, localJogo = :localJogo, codigoCompeticao = :codigoCompeticao WHERE codigoJogo = :codigoJogo";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':mandanteAbreviacao',$this->mandanteAbreviacao,PDO::PARAM_STR);
        $stmt->bindParam(':visitanteAbreviacao',$this->visitanteAbreviacao,PDO::PARAM_STR);
        $stmt->bindParam(':logoMandante',$this->logoMandante,PDO::PARAM_STR);
        $stmt->bindParam(':logoVisitante',$this->logoVisitante,PDO::PARAM_STR);
        $stmt->bindParam(':placarMandante',$this->placarMandante,PDO::PARAM_INT);
        $stmt->bindParam(':placarVisitante',$this->placarVisitante,PDO::PARAM_INT);
        $stmt->bindParam(':dataJogo',$this->dataJogo);
        $stmt->bindParam(':horario',$this->horario);
        $stmt->bindParam(':localJogo',$this->localJogo,PDO::PARAM_STR);
        $stmt->bindParam(':codigoCompeticao',$this->codigoCompeticao,PDO::PARAM_INT);
        $stmt->bindParam(':codigoJogo',$codigoJogo,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updatePlacar($codigoJogo,$placarMandante,$placarVisitante){
        $sql = "UPDATE $this->table SET placarMandante = :placarMandante , placarVisitante = :placarVisitante WHERE codigoJogo = :codigoJogo";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':placarMandante',$placarMandante, PDO::PARAM_INT);
        $stmt->bindParam(':placarVisitante', $placarVisitante, PDO::PARAM_INT);
        $stmt->bindParam(':codigoJogo', $codigoJogo, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /*Selecionar jogos por data*/
    public function selectByData(){
        $sql = "SELECT * FROM $this->table WHERE placarMandante IS NOT NULL ORDER BY dataJogo DESC";
        $stmt = Conecta::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /*Selecionar jogos pela competição*/
    public function selectByCompeticao($codigoCompeticao){
        $sql = "SELECT * FROM $this->table WHERE codigoCompeticao = :codigoCompeticao ORDER BY dataJogo DESC";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoCompeticao',$codigoCompeticao,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /*Selecionar jogos por data*/
    public function selectJogo($codigoJogo){
        $sql = "SELECT * FROM $this->table WHERE codigoJogo = :codigoJogo";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoJogo',$codigoJogo,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /*Selecionar proximo jogo*/
    public function selectProximoJogo(){
        $sql = "SELECT * FROM $this->table WHERE dataJogo = (SELECT MAX(dataJogo) FROM $this->table WHERE placarMandante IS NULL) and placarMandante IS NULL ";
        $stmt = Conecta::prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    /*Selecionar ultimo jogo*/
    public function selectUltimoJogo(){
        $sql = "SELECT * FROM $this->table WHERE dataJogo = (SELECT MAX(dataJogo) FROM $this->table WHERE placarMandante IS NOT NULL ); ";
        $stmt = Conecta::prepare($sql);
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
    public function getCodigoJogo()
    {
        return $this->codigoJogo;
    }

    /**
     * @param mixed $codigoJogo
     */
    public function setCodigoJogo($codigoJogo)
    {
        $this->codigoJogo = $codigoJogo;
    }

    /**
     * @return mixed
     */
    public function getMandanteAbreviacao()
    {
        return $this->mandanteAbreviacao;
    }

    /**
     * @param mixed $mandanteAbreviacao
     */
    public function setMandanteAbreviacao($mandanteAbreviacao)
    {
        $this->mandanteAbreviacao = $mandanteAbreviacao;
    }

    /**
     * @return mixed
     */
    public function getVisitanteAbreviacao()
    {
        return $this->visitanteAbreviacao;
    }

    /**
     * @param mixed $visitanteAbreviacao
     */
    public function setVisitanteAbreviacao($visitanteAbreviacao)
    {
        $this->visitanteAbreviacao = $visitanteAbreviacao;
    }

    /**
     * @return mixed
     */
    public function getLogoMandante()
    {
        return $this->logoMandante;
    }

    /**
     * @param mixed $logoMandante
     */
    public function setLogoMandante($logoMandante)
    {
        $this->logoMandante = $logoMandante;
    }

    /**
     * @return mixed
     */
    public function getLogoVisitante()
    {
        return $this->logoVisitante;
    }

    /**
     * @param mixed $logoVisitante
     */
    public function setLogoVisitante($logoVisitante)
    {
        $this->logoVisitante = $logoVisitante;
    }

    /**
     * @return mixed
     */
    public function getPlacarMandante()
    {
        return $this->placarMandante;
    }

    /**
     * @param mixed $placarMandante
     */
    public function setPlacarMandante($placarMandante)
    {
        $this->placarMandante = $placarMandante;
    }

    /**
     * @return mixed
     */
    public function getPlacarVisitante()
    {
        return $this->placarVisitante;
    }

    /**
     * @param mixed $placarVisitante
     */
    public function setPlacarVisitante($placarVisitante)
    {
        $this->placarVisitante = $placarVisitante;
    }

    /**
     * @return mixed
     */
    public function getDataJogo()
    {
        return $this->dataJogo;
    }

    /**
     * @param mixed $dataJogo
     */
    public function setDataJogo($dataJogo)
    {
        $this->dataJogo = $dataJogo;
    }

    /**
     * @return mixed
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * @param mixed $horario
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;
    }

    /**
     * @return mixed
     */
    public function getLocalJogo()
    {
        return $this->localJogo;
    }

    /**
     * @param mixed $localJogo
     */
    public function setLocalJogo($localJogo)
    {
        $this->localJogo = $localJogo;
    }

    /**
     * @return mixed
     */
    public function getCodigoCompeticao()
    {
        return $this->codigoCompeticao;
    }

    /**
     * @param mixed $codigoCompeticao
     */
    public function setCodigoCompeticao($codigoCompeticao)
    {
        $this->codigoCompeticao = $codigoCompeticao;
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






}