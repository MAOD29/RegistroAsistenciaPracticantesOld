<?php

require_once 'database/BD.php';

class ModeloBase extends DB {

    public function __construct() {

    }

    public function store($table, $datos) {     
        $conexion = parent::conexion();   
        try {
        $keys = array_keys($datos);
        $sql = "INSERT INTO $table (".implode(", ", $keys).") \n";
        $sql .= "VALUES ( :".implode(", :",$keys).")";

        $insert = $conexion->prepare($sql)->execute($datos);
        return $insert;
        
        } catch (PDOException $e) {
            $_SESSION['mensaje'] = $e->getMessage();
        } catch (Exception $e) {
            $_SESSION['mensaje'] = $e->getMessage();
        }
    }
    public function login($user, $password) {
        
        $conexion = parent::conexion();   
        try {
            $query = "SELECT * FROM usuarios WHERE user = '".$user. "' AND password = '".$password . "'";
            $pdo = $conexion->query($query)->fetch();
            if($pdo){
                return $pdo;
            }else{
                return false;
            }
        } catch (PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }

    public function edit($table, $id) {
        
        $conexion = parent::conexion();   
        try {
            $query = " SELECT * FROM  $table WHERE id = $id  ";
            return  $conexion->query($query)->fetch();
        
        } catch (PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }

    public function index($query) {
        $conexion = parent::conexion();
        try {
            return $consulta = $conexion->query($query)->fetchAll();
            
        } catch (PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }
    public function destroy($table,$id){
        $conexion = parent::conexion();   
        try {
            $query = " DELETE  FROM  $table WHERE id = $id  ";
            return  $conexion->query($query)->execute();
        
        } catch (PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }

    public function update($sql,$datos){
        $conexion = parent::conexion();   
        try {

            $pdo = $conexion->prepare($sql)->execute($datos);
            if($pdo){
                return $pdo;
            }else{
                false;
            }
            
        } catch (PDOException $e) {
            $_SESSION['mensaje'] = $e->getMessage();
        } catch (Exception $e) {
            $_SESSION['mensaje'] = $e->getMessage();
        }
    }
    public function pagination($sql){
        $conexion = parent::conexion();   
        try {

            $pdo = $conexion->prepare($sql); 
            $pdo->execute(); 
            $number_of_rows = $pdo->fetchColumn();
        
            if($number_of_rows){
                return $number_of_rows;
            }else{
                false;
            }
            
            } catch (PDOException $e) {
                $_SESSION['mensaje'] = $e->getMessage();
            } catch (Exception $e) {
                $_SESSION['mensaje'] = $e->getMessage();
        }

    }

}
