<?php
 require_once 'CRUD.php';



class ElencoModel extends CRUD{

    private $codigoElencado;
    private $fotoDePerfil;
    private $nome;
    private $funcao;
    private $tipo;
    private $apelido;
    private $fotos;
    private $dataNascimento;
    private $naturalidade;
    private $nacionalidade;

    protected $table = 'elenco';

    /*public function __construct($codigoElencado,$fotoDePerfil,$nome,$funcao,$isJogador,$apelido,$fotos,$dataNascimento,$naturalidade,$nacionalidade)
    {

        $this->setCodigoElencado($codigoElencado);
        $this->setFotoDePerfil($fotoDePerfil);
        $this->setNome($nome);
        $this->setFuncao($funcao);
        $this->setIsJogador($isJogador);
        $this->setApelido($apelido);
        $this->setFotos($fotos);
        $this->setDataNascimento($dataNascimento);
        $this->setNaturalidade($naturalidade);
        $this->setNacionalidade($nacionalidade);
    }*/



    public function selectElencado($codigoElencado){
        $sql= " SELECT * FROM $this->table WHERE codigoElencado= :codigoElencado";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoElencado',$codigoElencado,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    /*INSERIR*/
    public function insert()
    {
        $sql = "INSERT INTO $this->table 
        (fotoDePerfil,nome,funcao,tipo,apelido,fotos,dataNascimento,naturalidade,nacionalidade)
        VALUES (:fotoDePerfil,:nome,:funcao,:tipo,:apelido,:fotos,:dataNascimento,:naturalidade,:nacionalidade)";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':fotoDePerfil', $this->fotoDePerfil);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':funcao', $this->funcao);
        $stmt->bindParam(':tipo', $this->tipo,PDO::PARAM_INT);
        $stmt->bindParam(':apelido', $this->apelido);
        $stmt->bindParam(':fotos', $this->fotos);
        $stmt->bindParam(':dataNascimento', $this->dataNascimento);
        $stmt->bindParam(':naturalidade', $this->naturalidade);
        $stmt->bindParam(':nacionalidade', $this->nacionalidade);
        return $stmt->execute();

    }

    public function update()
    {
        // TODO: Implement update() method.
    }


    /*ATUALIZAR*/
    public function updateElencado($codigoElencado)
    {
        $sql = "UPDATE $this->table SET fotoDePerfil = :fotoDePerfil ,nome = :nome, funcao = :funcao, tipo = :tipo, apelido = :apelido, dataNascimento = :dataNascimento, naturalidade = :naturalidade, nacionalidade = :nacionalidade
        WHERE codigoElencado = :codigoElencado";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoElencado', $codigoElencado,PDO::PARAM_INT);
        $stmt->bindParam(':fotoDePerfil', $this->fotoDePerfil,PDO::PARAM_STR);
        $stmt->bindParam(':nome', $this->nome,PDO::PARAM_STR);
        $stmt->bindParam(':funcao', $this->funcao,PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $this->tipo,PDO::PARAM_INT);
        $stmt->bindParam(':apelido', $this->apelido,PDO::PARAM_STR);
        $stmt->bindParam(':dataNascimento', $this->dataNascimento);
        $stmt->bindParam(':naturalidade', $this->naturalidade,PDO::PARAM_STR);
        $stmt->bindParam(':nacionalidade', $this->nacionalidade,PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deletar($codigoElencado){

        $sql = "DELETE FROM $this->table WHERE codigoElencado =:codigoElencado";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoElencado',$codigoElencado,PDO::PARAM_INT);
        return $stmt->execute();

    }

    public function selectJogadores($tipo,$funcao){
        $sql = "SELECT * FROM $this->table WHERE tipo =:tipo AND funcao = :funcao";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':funcao',$funcao,PDO::PARAM_STR);
        $stmt->bindParam(':tipo',$tipo,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectGeral($tipo){
        $sql = "SELECT * FROM $this->table WHERE tipo =:tipo";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':tipo',$tipo,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectPaginacao($pagina){
       try{


           $limite = 6;
           $inicio = ($limite*$pagina)-$limite;
           $ultimaPagina = ceil(count($this->selectAll())/$limite);

           $sql = "SELECT * FROM $this->table ORDER BY tipo ASC LIMIT :inicio,:limite";
           $stmt = Conecta::prepare($sql);
           $stmt->bindParam(':inicio',$inicio,PDO::PARAM_INT);
           $stmt->bindParam(':limite',$limite,PDO::PARAM_INT);
           $stmt->execute();
           return $stmt->fetchAll();

       }catch(PDOException $e){
           return 'Error: '.$e->getMessage();
       }

    }

    /**
     * @return mixed
     */
    public function getCodigoElencado()
    {
        return $this->codigoElencado;
    }

    /**
     * @param mixed $codigoElencado
     */
    public function setCodigoElencado($codigoElencado)
    {
        $this->codigoElencado = $codigoElencado;
    }

    /**
     * @return mixed
     */
    public function getFotoDePerfil()
    {
        return $this->fotoDePerfil;
    }

    /**
     * @param mixed $fotoDePerfil
     */
    public function setFotoDePerfil($fotoDePerfil)
    {
        $this->fotoDePerfil = $fotoDePerfil;
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
    public function getFuncao()
    {
        return $this->funcao;
    }

    /**
     * @param mixed $funcao
     */
    public function setFuncao($funcao)
    {
        $this->funcao = $funcao;
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
    public function getApelido()
    {
        return $this->apelido;
    }

    /**
     * @param mixed $apelido
     */
    public function setApelido($apelido)
    {
        $this->apelido = $apelido;
    }

    /**
     * @return mixed
     */
    public function getFotos()
    {
        return $this->fotos;
    }

    /**
     * @param mixed $fotos
     */
    public function setFotos($fotos)
    {
        $this->fotos = $fotos;
    }

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * @param mixed $dataNascimento
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    /**
     * @return mixed
     */
    public function getNaturalidade()
    {
        return $this->naturalidade;
    }

    /**
     * @param mixed $naturalidade
     */
    public function setNaturalidade($naturalidade)
    {
        $this->naturalidade = $naturalidade;
    }

    /**
     * @return mixed
     */
    public function getNacionalidade()
    {
        return $this->nacionalidade;
    }

    /**
     * @param mixed $nacionalidade
     */
    public function setNacionalidade($nacionalidade)
    {
        $this->nacionalidade = $nacionalidade;
    }





}