<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 28/11/2018
 * Time: 15:19
 */
require_once 'CRUD.php';
class ClubeModel extends CRUD
{

    private $codigoClube;
    private $logo;
    private $nome;
    private $nomeAbreviado;
    private $endereco;
    private $rua;
    private $numero;
    private $cidade;
    private $uf;
    private $cep;
    private $email;
    private $cnpj;
    private $telefone;
    private $facebookLink;
    private $instagramLink;
    private $twitterLink;
    private $youtubeLink;
    private $googlePlusLink;
    private $ultimaAtualizacao;

    protected $table = 'clube';


    public function selectClube($codigoClube){
        $sql = "SELECT * FROM $this->table WHERE codigoClube = :codigoClube";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoClube',$codigoClube,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateClube ($codigoClube)
    {
        $sql = "UPDATE $this->table SET logo= :logo, nome = :nome, nomeAbreviado = :nomeAbreviado, endereco = :endereco,
        rua = :rua , numero = :numero, cidade = :cidade, uf = :uf, cep = :cep, email = :email, cnpj = :cnpj, telefone = :telefone,
        facebookLink = :facebookLink, instagramLink = :instagramLink, twitterLink = :twitterLink, youtubeLink = :youtubeLink,
        googlePlusLink = :googlePlusLink, ultimaAtualizacao = :ultimaAtualizacao
        WHERE codigoClube = :codigoClube";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':logo',$this->logo,PDO::PARAM_STR);
        $stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(':nomeAbreviado',$this->nomeAbreviado,PDO::PARAM_STR);
        $stmt->bindParam(':endereco',$this->endereco,PDO::PARAM_STR);
        $stmt->bindParam(':rua',$this->rua,PDO::PARAM_STR);
        $stmt->bindParam(':numero',$this->numero,PDO::PARAM_STR);
        $stmt->bindParam(':cidade',$this->cidade,PDO::PARAM_STR);
        $stmt->bindParam(':uf',$this->uf,PDO::PARAM_STR);
        $stmt->bindParam(':cep',$this->cep,PDO::PARAM_STR);
        $stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
        $stmt->bindParam(':cnpj',$this->cnpj,PDO::PARAM_STR);
        $stmt->bindParam(':telefone',$this->telefone,PDO::PARAM_STR);
        $stmt->bindParam(':facebookLink',$this->facebookLink,PDO::PARAM_STR);
        $stmt->bindParam(':instagramLink',$this->instagramLink,PDO::PARAM_STR);
        $stmt->bindParam(':twitterLink',$this->twitterLink,PDO::PARAM_STR);
        $stmt->bindParam(':youtubeLink',$this->youtubeLink,PDO::PARAM_STR);
        $stmt->bindParam(':googlePlusLink',$this->googlePlusLink,PDO::PARAM_STR);
        $stmt->bindParam(':ultimaAtualizacao',$this->ultimaAtualizacao,PDO::PARAM_STR);
        $stmt->bindParam(':codigoClube',$codigoClube,PDO::PARAM_INT);
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
    public function getCodigoClube()
    {
        return $this->codigoClube;
    }

    /**
     * @param mixed $codigoClube
     */
    public function setCodigoClube($codigoClube)
    {
        $this->codigoClube = $codigoClube;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
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
    public function getNomeAbreviado()
    {
        return $this->nomeAbreviado;
    }

    /**
     * @param mixed $nomeAbreviado
     */
    public function setNomeAbreviado($nomeAbreviado)
    {
        $this->nomeAbreviado = $nomeAbreviado;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @return mixed
     */
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * @param mixed $rua
     */
    public function setRua($rua)
    {
        $this->rua = $rua;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param mixed $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param mixed $uf
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * @return mixed
     */
    public function getFacebookLink()
    {
        return $this->facebookLink;
    }

    /**
     * @param mixed $facebookLink
     */
    public function setFacebookLink($facebookLink)
    {
        $this->facebookLink = $facebookLink;
    }

    /**
     * @return mixed
     */
    public function getInstagramLink()
    {
        return $this->instagramLink;
    }

    /**
     * @param mixed $instagramLink
     */
    public function setInstagramLink($instagramLink)
    {
        $this->instagramLink = $instagramLink;
    }

    /**
     * @return mixed
     */
    public function getTwitterLink()
    {
        return $this->twitterLink;
    }

    /**
     * @param mixed $twitterLink
     */
    public function setTwitterLink($twitterLink)
    {
        $this->twitterLink = $twitterLink;
    }

    /**
     * @return mixed
     */
    public function getYoutubeLink()
    {
        return $this->youtubeLink;
    }

    /**
     * @param mixed $youtubeLink
     */
    public function setYoutubeLink($youtubeLink)
    {
        $this->youtubeLink = $youtubeLink;
    }

    /**
     * @return mixed
     */
    public function getGooglePlusLink()
    {
        return $this->googlePlusLink;
    }

    /**
     * @param mixed $googlePlusLink
     */
    public function setGooglePlusLink($googlePlusLink)
    {
        $this->googlePlusLink = $googlePlusLink;
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