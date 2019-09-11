<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 03/10/2018
 * Time: 09:57
 */
require_once 'BDconfig.php';
class Conecta
{

    private static $instance;

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if(!isset( self::$instance)){

            try{
                self::$instance = new PDO('mysql:host=' .DBHOST. ';dbname=' .DBNAME.';charset=utf8', DBUSER,DBPASS);
                self::$instance->exec('SET CHARACTER SET utf8');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            }catch (PDOException $e){

                echo $e->getMessage();

            }
        }
        return self::$instance;
    }

    public static function prepare($sql){
        return self::getInstance()->prepare($sql);
    }



}