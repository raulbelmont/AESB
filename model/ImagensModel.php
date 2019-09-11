<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 05/12/2018
 * Time: 12:50
 */

require_once 'CRUD.php';
class ImagensModel extends CRUD
{

    private $codigoImagem;
    private $titulo;
    private $legenda;
    private $imagem;
    private $localizacao;
    private $ultimaAtualizacao;

    /*
        Localizações possíveis:

        1 = slider da pagina inicial
        2 = Chamada para o proximo jogo
        3 = anuncio 1
        4 = anuncio 2
        5 = logo em fale conosco e home do adm

    */



    protected $table = 'imagem';

    public function inserirImagem(){
        $sql = "INSERT INTO $this->table (titulo, legenda, imagem, localizacao, ultimaAtualizacao) 
        VALUES (:titulo, :legenda, :imagem, :localizacao,:ultimaAtualizacao) ";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':titulo',$this->titulo,PDO::PARAM_STR);
        $stmt->bindParam(':legenda',$this->legenda,PDO::PARAM_STR);
        $stmt->bindParam(':imagem',$this->imagem,PDO::PARAM_STR);
        $stmt->bindParam(':localizacao',$this->localizacao,PDO::PARAM_INT);
        $stmt->bindParam(':ultimaAtualizacao',$this->ultimaAtualizacao);
        return $stmt->execute();
    }

    public function updateImagem($codigoImagem){
        $sql = "UPDATE $this->table SET titulo = :titulo, legenda = :legenda, imagem = :imagem, localizacao = :localizacao, ultimaAtualizacao = :ultimaAtualizacao
        WHERE codigoImagem = :codigoImagem";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':titulo',$this->titulo,PDO::PARAM_STR);
        $stmt->bindParam(':legenda',$this->legenda,PDO::PARAM_STR);
        $stmt->bindParam(':imagem',$this->imagem,PDO::PARAM_STR);
        $stmt->bindParam(':localizacao',$this->localizacao,PDO::PARAM_INT);
        $stmt->bindParam(':ultimaAtualizacao',$this->ultimaAtualizacao);
        $stmt->bindParam(':codigoImagem',$codigoImagem,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function selectAllByLocal($localizacao){
        $sql = "SELECT * FROM $this->table WHERE localizacao = :localizacao";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':localizacao',$localizacao, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectImagem($codigoImagem){
        $sql = "SELECT * FROM $this->table WHERE codigoImagem = :codigoImagem";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoImagem',$codigoImagem, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deleteImagem($codigoImagem){
        $sql = "DELETE FROM $this->table WHERE codigoImagem = :codigoImagem";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoImagem',$codigoImagem,PDO::PARAM_INT);
        return $stmt->execute();
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
    public function getCodigoImagem()
    {
        return $this->codigoImagem;
    }

    /**
     * @param mixed $codigoImagem
     */
    public function setCodigoImagem($codigoImagem)
    {
        $this->codigoImagem = $codigoImagem;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getLegenda()
    {
        return $this->legenda;
    }

    /**
     * @param mixed $legenda
     */
    public function setLegenda($legenda)
    {
        $this->legenda = $legenda;
    }

    /**
     * @return mixed
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param mixed $imagem
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }



    /**
     * @return mixed
     */
    public function getLocalizacao()
    {
        return $this->localizacao;
    }

    /**
     * @param mixed $tipo
     */
    public function setLocalizacao($localizacao)
    {
        $this->localizacao = $localizacao;
    }

    /**
     * @return mixed
     */
    public function getUltimaAtualizacao()
    {
        return $this->ultimaAtualizacao;
    }

    /**
     * @param mixed $ultimaAtualizacao
     */
    public function setUltimaAtualizacao($ultimaAtualizacao)
    {
        $this->ultimaAtualizacao = $ultimaAtualizacao;
    }





}