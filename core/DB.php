<?php

class DB {
    private static $hostname;
    private static $gestor;
    private static $database;
    private static $db_user;
    private static $db_password;
    private static $db_charset;
    private  $conexion;

    public function __construct(){
        self::$hostname = constant('HOST');
        self::$gestor = constant('GESTOR');
        self::$database = constant('DB');
        self::$db_user  = constant('USER');
        self::$db_password = constant('PASSWORD');
        self::$db_charset = constant('CHARSET');
    }


    public function conexion (){
        try {
            $dsn = self::$gestor.":host=".self::$hostname.";dbname=".self::$database;
            $pdo = new PDO($dsn,self::$db_user,self::$db_password);
            $pdo->exec("SET CHARACTER SET ".self::$db_charset);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				return $pdo;
        } catch (PDOException $e) {
            exit("Error:".$e->getMessage());
        }
    }

    public function desconectar(){
        $this->conexion = null;
    }


}


?>