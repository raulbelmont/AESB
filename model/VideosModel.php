<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 12/11/2018
 * Time: 14:22
 */

require_once 'CRUD.php';
class VideosModel extends CRUD
{

    private $codigoVideo;
    private $tituloVideo;
    private $descricaoVideo;
    private $dataPublicacao;
    private $ultimaAtualizacao;
    private $autor;
    private $video;
    private $poster;
    private $tipoVideo;

    protected $table = 'video';

    public function insert()
    {
        $sql = "INSERT INTO $this->table 
        (tituloVideo,descricaoVideo,autor,dataPublicacao,video,poster,tipoVideo)
        VALUES (:tituloVideo,:descricaoVideo,:autor,:dataPublicacao,:video,:poster,:tipoVideo)";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':tituloVideo', $this->tituloVideo);
        $stmt->bindParam(':descricaoVideo', $this->descricaoVideo);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':dataPublicacao', $this->dataPublicacao);
        $stmt->bindParam(':video', $this->video);
        $stmt->bindParam(':poster', $this->poster);
        $stmt->bindParam(':tipoVideo', $this->tipoVideo);
        return $stmt->execute();
    }

    public function deletar($codigoVideo){
        $sql = "DELETE FROM $this->table WHERE codigoVideo =:codigoVideo";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoVideo',$codigoVideo,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function selectPorCodigo($codigoVideo){
        $sql = "SELECT * FROM $this->table WHERE codigoVideo= :codigoVideo";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':codigoVideo',$codigoVideo,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function selectAllByData($limite)
    {
        $sql = "SELECT * FROM $this->table WHERE tipoVideo = 0 ORDER BY dataPublicacao desc LIMIT :limit ";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':limit',$limite,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function selectAllAesb()
    {
        $sql = "SELECT * FROM $this->table WHERE tipoVideo = 0 ORDER BY dataPublicacao";
        $stmt = Conecta::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectPaginacao($pagina){
        try{
            $limite = 10;
            $inicio = ($limite*$pagina)-$limite;
            $ultimaPagina = ceil(count($this->selectAll())/$limite);

            $sql = "SELECT * FROM $this->table WHERE tipoVideo = 0 ORDER BY dataPublicacao DESC LIMIT :inicio,:limite";
            $stmt = Conecta::prepare($sql);
            $stmt->bindParam(':inicio',$inicio,PDO::PARAM_INT);
            $stmt->bindParam(':limite',$limite,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }
    public function selectPaginacaoAesb($pagina){
        try{
            $limite = 2;
            $inicio = ($limite*$pagina)-$limite;
            $ultimaPagina = ceil(count($this->selectAll())/$limite);

            $sql = "SELECT * FROM $this->table WHERE tipoVideo = 0 ORDER BY dataPublicacao DESC LIMIT :inicio,:limite";
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

    public function updateVideo($codigoVideo)
    {
        $sql = "UPDATE $this->table SET tituloVideo= :tituloVideo, descricaoVideo= :descricaoVideo, 
        autor = :autor, ultimaAtualizacao = :ultimaAtualizacao, video= :video, poster = :poster
        WHERE codigoVideo= :codigoVideo";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':tituloVideo',$this->tituloVideo, PDO::PARAM_STR);
        $stmt->bindParam(':descricaoVideo',$this->descricaoVideo,PDO::PARAM_STR);
        $stmt->bindParam(':autor',$this->autor,PDO::PARAM_STR);
        $stmt->bindParam(':ultimaAtualizacao',$this->ultimaAtualizacao);
        $stmt->bindParam(':video',$this->video);
        $stmt->bindParam(':poster',$this->poster);
        $stmt->bindParam(':codigoVideo',$codigoVideo, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /*Métodos pra videos de torcedores*/
    public function publicarVideoTorcedor($codigoVideo)
    {
        $sql = "UPDATE $this->table SET tipoVideo = :tipoVideo
        WHERE codigoVideo= :codigoVideo";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':tipoVideo',$this->tipoVideo, PDO::PARAM_INT);
        $stmt->bindParam(':codigoVideo',$codigoVideo, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function selectTorcedoresNaoPublicados()
    {
        $sql = "SELECT * FROM $this->table WHERE tipoVideo = 1 ORDER BY dataPublicacao";
        $stmt = Conecta::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectTorcedoresPublicados()
    {
        $sql = "SELECT * FROM $this->table WHERE tipoVideo = 2 ORDER BY dataPublicacao";
        $stmt = Conecta::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectPaginacaoTorcedorN($pagina){
        try{
            $limite = 10;
            $inicio = ($limite*$pagina)-$limite;
            $ultimaPagina = ceil(count($this->selectAll())/$limite);

            $sql = "SELECT * FROM $this->table WHERE tipoVideo = 1 ORDER BY dataPublicacao DESC LIMIT :inicio,:limite";
            $stmt = Conecta::prepare($sql);
            $stmt->bindParam(':inicio',$inicio,PDO::PARAM_INT);
            $stmt->bindParam(':limite',$limite,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function selectPaginacaoTorcedorP($pagina){
        try{
            $limite = 10;
            $inicio = ($limite*$pagina)-$limite;
            $ultimaPagina = ceil(count($this->selectAll())/$limite);

            $sql = "SELECT * FROM $this->table WHERE tipoVideo = 2 ORDER BY dataPublicacao DESC LIMIT :inicio,:limite";
            $stmt = Conecta::prepare($sql);
            $stmt->bindParam(':inicio',$inicio,PDO::PARAM_INT);
            $stmt->bindParam(':limite',$limite,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function selectPaginacaoPublicadosAjax($pagina){
        try{
            $limite = 2;
            $inicio = ($limite*$pagina)-$limite;
            $ultimaPagina = ceil(count($this->selectAll())/$limite);

            $sql = "SELECT * FROM $this->table WHERE tipoVideo = 2 ORDER BY dataPublicacao DESC LIMIT :inicio,:limite";
            $stmt = Conecta::prepare($sql);
            $stmt->bindParam(':inicio',$inicio,PDO::PARAM_INT);
            $stmt->bindParam(':limite',$limite,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function selectAllByDataP($limite)
    {
        $sql = "SELECT * FROM $this->table WHERE tipoVideo = 2 ORDER BY dataPublicacao desc LIMIT :limit ";
        $stmt = Conecta::prepare($sql);
        $stmt->bindParam(':limit',$limite,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    /**
     * @return mixed
     */
    public function getCodigoVideo()
    {
        return $this->codigoVideo;
    }

    /**
     * @param mixed $codigoVideo
     */
    public function setCodigoVideo($codigoVideo)
    {
        $this->codigoVideo = $codigoVideo;
    }

    /**
     * @return mixed
     */
    public function getTituloVideo()
    {
        return $this->tituloVideo;
    }

    /**
     * @param mixed $tituloVideo
     */
    public function setTituloVideo($tituloVideo)
    {
        $this->tituloVideo = $tituloVideo;
    }

    /**
     * @return mixed
     */
    public function getDescricaoVideo()
    {
        return $this->descricaoVideo;
    }

    /**
     * @param mixed $descricaoVideo
     */
    public function setDescricaoVideo($descricaoVideo)
    {
        $this->descricaoVideo = $descricaoVideo;
    }

    /**
     * @return mixed
     */
    public function getDataPublicacao()
    {
        return $this->dataPublicacao;
    }

    /**
     * @param mixed $dataPublicacao
     */
    public function setDataPublicacao($dataPublicacao)
    {
        $this->dataPublicacao = $dataPublicacao;
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
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return mixed
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * @param mixed $poster
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;
    }

    /**
     * @return mixed
     */
    public function getTipoVideo()
    {
        return $this->tipoVideo;
    }

    /**
     * @param mixed $tipoVideo
     */
    public function setTipoVideo($tipoVideo)
    {
        $this->tipoVideo = $tipoVideo;
    }









}