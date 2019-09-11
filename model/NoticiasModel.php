<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 24/10/2018
 * Time: 11:12
 */

require_once 'CRUD.php';
class NoticiasModel extends CRUD
{

    private $codigoNoticia;
    private $tituloNoticia;
    private $descricaoNoticia;
    private $corpoNoticia;
    private $autor;
    private $dataPubicacao;
    private $ultimaAtualizacao;
    private $fundoNoticia;
    private $isPublicada;

    protected $table = 'noticia';

    public function insert()
    {
        $sql = "INSERT INTO $this->table 
        (tituloNoticia,descricaoNoticia,corpoNoticia,autor,dataPublicacao,fundoNoticia,isPublicada)
        VALUES (:tituloNoticia,:descricaoNoticia,:corpoNoticia,:autor,:dataPublicacao,:fundoNoticia,:isPublicada)";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':tituloNoticia', $this->tituloNoticia);
        $stmt->bindParam(':descricaoNoticia', $this->descricaoNoticia);
        $stmt->bindParam(':corpoNoticia', $this->corpoNoticia);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':dataPublicacao', $this->dataPubicacao);
        $stmt->bindParam(':fundoNoticia', $this->fundoNoticia);
        $stmt->bindParam(':isPublicada', $this->isPublicada,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function deletar($codigoNoticia){
        $sql = "DELETE FROM $this->table WHERE codigoNoticia =:codigoNoticia";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoNoticia',$codigoNoticia,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function selectAllIsPublicada($isPublicada){
        $sql = "SELECT * FROM $this->table WHERE isPublicada = :isPublicada";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':isPublicada',$isPublicada,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectPorCodigo($codigoNoticia){
        $sql = "SELECT * FROM $this->table WHERE codigoNoticia = :codigoNoticia";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoNoticia',$codigoNoticia,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function selectNoticiasRecentes($limit){
        $sql ="SELECT * FROM $this->table WHERE isPublicada = 1 ORDER BY dataPublicacao DESC LIMIT :limit";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectAllByJSON($orderBY,$order,$pagina){

        $limite = 9;
        $inicio = ($limite*$pagina)-$limite;

        $sql = "SELECT * FROM $this->table WHERE isPublicada = 1 ORDER BY $orderBY $order LIMIT :inicio,:limite";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':inicio',$inicio,PDO::PARAM_INT);
        $stmt->bindParam(':limite',$limite,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function selectAllByAcesso($limit){
        $sql = "SELECT * FROM $this->table WHERE isPublicada = 1 ORDER BY numAcessos DESC LIMIT :limit";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /*Em análise*/
    public function selectPaginacaoNaoPublic($pagina){
        try{
            $limite = 10;
            $inicio = ($limite*$pagina)-$limite;
            $ultimaPagina = ceil(count($this->selectAll())/$limite);

            $sql = "SELECT * FROM $this->table WHERE isPublicada = 0 ORDER BY dataPublicacao DESC LIMIT :inicio,:limite";
            $stmt = Conecta::prepare($sql);
            $stmt->bindParam(':inicio',$inicio,PDO::PARAM_INT);
            $stmt->bindParam(':limite',$limite,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }


    /*Publicadas*/
    public function selectPaginacao($pagina){
        try{
            $limite = 10;
            $inicio = ($limite*$pagina)-$limite;
            $ultimaPagina = ceil(count($this->selectAll())/$limite);

            $sql = "SELECT * FROM $this->table WHERE isPublicada = 1 ORDER BY dataPublicacao DESC LIMIT :inicio,:limite";
            $stmt = Conecta::prepare($sql);
            $stmt->bindParam(':inicio',$inicio,PDO::PARAM_INT);
            $stmt->bindParam(':limite',$limite,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function selectPaginacaoAjax($pagina){
        try{
            $limite = 9;
            $inicio = ($limite*$pagina)-$limite;
            $ultimaPagina = ceil(count($this->selectAll())/$limite);

            $sql = "SELECT * FROM $this->table WHERE isPublicada = 1 ORDER BY dataPublicacao DESC LIMIT :inicio,:limite";
            $stmt = Conecta::prepare($sql);
            $stmt->bindParam(':inicio',$inicio,PDO::PARAM_INT);
            $stmt->bindParam(':limite',$limite,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function updateNoticia($codigoNoticia)
    {
        $sql = "UPDATE $this->table SET tituloNoticia= :tituloNoticia, descricaoNoticia = :descricaoNoticia, 
        corpoNoticia = :corpoNoticia, autor = :autor, ultimaAtualizacao = :ultimaAtualizacao, fundoNoticia = :fundoNoticia, isPublicada = :isPublicada
        WHERE codigoNoticia = :codigoNoticia";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':tituloNoticia',$this->tituloNoticia, PDO::PARAM_STR);
        $stmt->bindParam(':descricaoNoticia',$this->descricaoNoticia,PDO::PARAM_STR);
        $stmt->bindParam(':corpoNoticia',$this->corpoNoticia,PDO::PARAM_STR);
        $stmt->bindParam(':autor',$this->autor,PDO::PARAM_STR);
        $stmt->bindParam(':ultimaAtualizacao',$this->ultimaAtualizacao);
        $stmt->bindParam(':fundoNoticia',$this->fundoNoticia);
        $stmt->bindParam(':isPublicada',$this->isPublicada,PDO::PARAM_INT);
        $stmt->bindParam(':codigoNoticia',$codigoNoticia, PDO::PARAM_INT);
        return $stmt->execute();


    }

    /*Publicando notícia*/
    public function publicaNoticia($codigoNoticia,$isPublicada){
        $sql = "UPDATE $this->table SET isPublicada = :isPublicada
        WHERE codigoNoticia = :codigoNoticia";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':isPublicada',$isPublicada,PDO::PARAM_INT);
        $stmt->bindParam(':codigoNoticia',$codigoNoticia,PDO::PARAM_INT);
        return $stmt->execute();
    }

    /*Contador de acessos*/
    public function contadorAcesso($codigoNoticia,$numAcessos){
        $sql = "UPDATE $this->table SET numAcessos = :numAcessos
        WHERE codigoNoticia = :codigoNoticia";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':numAcessos',$numAcessos,PDO::PARAM_INT);
        $stmt->bindParam(':codigoNoticia',$codigoNoticia, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * @return mixed
     */
    public function getCodigoNoticia()
    {
        return $this->codigoNoticia;
    }

    /**
     * @param mixed $codigoNoticia
     */
    public function setCodigoNoticia($codigoNoticia)
    {
        $this->codigoNoticia = $codigoNoticia;
    }

    /**
     * @return mixed
     */
    public function getTituloNoticia()
    {
        return $this->tituloNoticia;
    }

    /**
     * @param mixed $tituloNoticia
     */
    public function setTituloNoticia($tituloNoticia)
    {
        $this->tituloNoticia = $tituloNoticia;
    }

    /**
     * @return mixed
     */
    public function getDescricaoNoticia()
    {
        return $this->descricaoNoticia;
    }

    /**
     * @param mixed $descricaoNoticia
     */
    public function setDescricaoNoticia($descricaoNoticia)
    {
        $this->descricaoNoticia = $descricaoNoticia;
    }

    /**
     * @return mixed
     */
    public function getCorpoNoticia()
    {
        return $this->corpoNoticia;
    }

    /**
     * @param mixed $corpoNoticia
     */
    public function setCorpoNoticia($corpoNoticia)
    {
        $this->corpoNoticia = $corpoNoticia;
    }

    /**
     * @return mixed
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param mixed $autor
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    /**
     * @return mixed
     */
    public function getDataPubicacao()
    {
        return $this->dataPubicacao;
    }

    /**
     * @param mixed $dataPubicacao
     */
    public function setDataPubicacao($dataPubicacao)
    {
        $this->dataPubicacao = $dataPubicacao;
    }

    /**
     * @return mixed
     */
    public function getUltimaAtualizacao()
    {
        return $this->UltimaAtualizacao;
    }

    /**
     * @param mixed $dataAtualizacao
     */
    public function setUltimaAtualizacao($ultimaAtualizacao)
    {
        $this->ultimaAtualizacao = $ultimaAtualizacao;
    }

    /**
     * @return mixed
     */
    public function getFundoNoticia()
    {
        return $this->fundoNoticia;
    }

    /**
     * @param mixed $fundoNoticia
     */
    public function setFundoNoticia($fundoNoticia)
    {
        $this->fundoNoticia = $fundoNoticia;
    }

    /**
     * @return mixed
     */
    public function getisPublicada()
    {
        return $this->isPublicada;
    }

    /**
     * @param mixed $isPublicada
     */
    public function setIsPublicada($isPublicada)
    {
        $this->isPublicada = $isPublicada;
    }










}