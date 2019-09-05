<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 22/11/2018
 * Time: 13:16
 */
require_once 'CRUD.php';
class Cidades extends CRUD
{
    private $id;
    private $nome;
    private $estados_id;

    protected $table = 'cidades';

    public function selectCidades($estados_id)
    {
        $sql = "SELECT * FROM $this->table WHERE estados_id =:estados_id";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':estados_id',$estados_id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getEstadosId()
    {
        return $this->estados_id;
    }

    /**
     * @param mixed $estados_id
     */
    public function setEstadosId($estados_id)
    {
        $this->estados_id = $estados_id;
    }




}