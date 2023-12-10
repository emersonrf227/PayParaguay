<?php
namespace App\sts\Models\helper;

if(!defined("URL")){
    header("Location: /");
    exit();
}

header('Content-Type: text/html; charset=utf-8');

use PDO;


class StsConn {

    //Inicio da classe

	public static $Host = HOST;
    public static $User = USER;
    public static $Pass = PASS;
    public static $Dbname = DBNAME;
    private static $Connect = null;


    private static function conectar() {
        try {
            if (self::$Connect == null) {
              
                self::$Connect = new PDO('mysql:host='.self::$Host.';dbname='.self::$Dbname ,self::$User,self::$Pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

                self::$Connect->exec("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

              //  self::$Connect = new PDO('mysql: host=' . self::$Host.':3306' . ';dbname=' . self::$Dbname, self::$User, self::$Pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                /*
                self::$Connect->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                self::$Connect->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );*/
               
            }
        } catch (Exception $exec) {
            echo "Menssagem: " . $exec->getMessage();
            die;
        }

        return self::$Connect;
    }

    public function getConn() {
        return self::conectar();
        
    }

}

