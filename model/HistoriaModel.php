<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 19/12/2018
 * Time: 10:19
 */

require_once 'CRUD.php';
class HistoriaModel extends CRUD
{

    private $codigoHistoria;
    private $titulo;
    private $corpo;
    private $ultimaAtualizacao;
    private $tipo;
    /*
        tipo 1 = historia
        tipo 2 = Fundação
        tipo 3 = Presidentes
        tipo 4 = Hino e Símbolos
        tipo 5 = Galeria de Troféus
        tipo 6 = Ídolos
        tipo 7 = Estatuto Social

     */

    protected $table = 'historia';

    public function selecionarHistoria($tipo){
        $sql = "SELECT * FROM $this->table WHERE tipo = :tipo";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':tipo',$tipo,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function selecionarHistoriaCD($codigoHistoria){
        $sql = "SELECT * FROM $this->table WHERE codigoHistoria = :codigoHistoria";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoHistoria',$codigoHistoria,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateHistoria($codigoHistoria){
        $sql = "UPDATE $this->table SET titulo = :titulo, corpo = :corpo, ultimaAtualizacao = :ultimaAtualizacao, tipo = :tipo
        WHERE codigoHistoria = :codigoHistoria";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':titulo',$this->titulo,PDO::PARAM_STR);
        $stmt->bindParam(':corpo',$this->corpo,PDO::PARAM_STR);
        $stmt->bindParam(':ultimaAtualizacao',$this->ultimaAtualizacao);
        $stmt->bindParam(':tipo',$this->tipo,PDO::PARAM_INT);
        $stmt->bindParam(':codigoHistoria',$codigoHistoria,PDO::PARAM_INT);
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
    public function getCodigoHistoria()
    {
        return $this->codigoHistoria;
    }

    /**
     * @param mixed $codigoHistoria
     */
    public function setCodigoHistoria($codigoHistoria)
    {
        $this->codigoHistoria = $codigoHistoria;
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
    public function getCorpo()
    {
        return $this->corpo;
    }

    /**
     * @param mixed $corpo
     */
    public function setCorpo($corpo)
    {
        $this->corpo = $corpo;
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