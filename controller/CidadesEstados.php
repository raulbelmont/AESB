<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 22/11/2018
 * Time: 13:44
 */

require_once '../model/Estados.php';
require_once '../model/Cidades.php';
$cidades = new Cidades();
$estados = new Estados();

if (!(empty($_POST['estado']))){

    $sigla = $_POST['estado'];

    $estado = $estados->selectEstado($sigla);
    $estado_id = $estado->id;


    foreach ($cidades->selectCidades($estado_id) as $key => $value){
        echo "<option value='$value->nome'>$value->nome</option>";
    }
}