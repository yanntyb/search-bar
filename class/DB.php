<?php

namespace App\Classes;

use PDO;
use PDOException;

class DB
{

    private static ?PDO $dbInstance = null;

    public function __construct() {
        try{
            self::$dbInstance = new PDO("sqlite:". $_SERVER["DOCUMENT_ROOT"] ."/database.sqlite");
            self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //to avoid getting 2 times the same result
            self::$dbInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $exception){
            echo $exception->getMessage();
        }

    }

    public static function getInstance(): ?PDO {
        if(is_null(self::$dbInstance)){
            new self();
        }
        return self::$dbInstance;
    }


    /**
     * On empeche les gens de cloner l'objet
     * pour sassurer quon a bien quune seul instance de la connexion a la db
     */
    public function __clone() {}
}