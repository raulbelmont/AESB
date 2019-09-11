<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 22/11/2018
 * Time: 13:16
 */
require_once 'CRUD.php';
class Estados extends CRUD
{
    private $id;
    private $nome;
    private $sigla;

    protected $table = 'estados';

    public function selectEstado($sigla){
            $sql = "SELECT * FROM $this->table WHERE sigla = :sigla";
            $stmt = Conecta::prepare($sql);
            $stmt->bindParam(':sigla',$sigla);
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
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * @param mixed $sigla
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }




}