<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 03/10/2018
 * Time: 10:11
 */

require_once 'Conecta.php';

abstract class CRUD extends Conecta
{

    protected $table;

    abstract public function insert();
    abstract public function update();

    public function select($id){
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function selectAll(){
        $sql = "SELECT * FROM $this->table";
        $stmt = Conecta::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete($id){
        $sql = "DELETE * FROM $this->table WHERE id =:id";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        return $stmt->execute();
    }

}