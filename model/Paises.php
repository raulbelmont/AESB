<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 26/11/2018
 * Time: 09:41
 */
require_once 'CRUD.php';
class Paises extends CRUD
{

    private $SL_ID;
    private $SL_NOME;
    private $SL_NOME_PT;
    private $SL_SIGLA;
    private $SL_BACEN;

    protected $table = 'pais';

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
    public function getSLID()
    {
        return $this->SL_ID;
    }

    /**
     * @param mixed $SL_ID
     */
    public function setSLID($SL_ID)
    {
        $this->SL_ID = $SL_ID;
    }

    /**
     * @return mixed
     */
    public function getSLNOME()
    {
        return $this->SL_NOME;
    }

    /**
     * @param mixed $SL_NOME
     */
    public function setSLNOME($SL_NOME)
    {
        $this->SL_NOME = $SL_NOME;
    }

    /**
     * @return mixed
     */
    public function getSLNOMEPT()
    {
        return $this->SL_NOME_PT;
    }

    /**
     * @param mixed $SL_NOME_PT
     */
    public function setSLNOMEPT($SL_NOME_PT)
    {
        $this->SL_NOME_PT = $SL_NOME_PT;
    }

    /**
     * @return mixed
     */
    public function getSLSIGLA()
    {
        return $this->SL_SIGLA;
    }

    /**
     * @param mixed $SL_SIGLA
     */
    public function setSLSIGLA($SL_SIGLA)
    {
        $this->SL_SIGLA = $SL_SIGLA;
    }

    /**
     * @return mixed
     */
    public function getSLBACEN()
    {
        return $this->SL_BACEN;
    }

    /**
     * @param mixed $SL_BACEN
     */
    public function setSLBACEN($SL_BACEN)
    {
        $this->SL_BACEN = $SL_BACEN;
    }



}