<?php
require_once 'app/RequestValidator/Validator.php';
class Request extends Validator
{
    public function validateuser($datos){
        $errores = [];

        $errores = $this->require($datos);
        $email = $this->validate_email($datos['email']);
        $phone = $this->validate_telefono($datos['phone']);
        $password = $this->validatePassword($datos['password']);
     
        if($email) $errores['email'] = $email;
        if($phone) $errores['phone'] = $phone;
        if($password) $errores['password'] = $password;

       return $errores;

    } 
    public function validateschool($datos){
        $errores = [];

        $errores = $this->require($datos);
        $email = $this->validate_email($datos['email']);
        $phone = $this->validate_telefono($datos['phone']);
      
     
        if($email) $errores['email'] = $email;
        if($phone) $errores['phone'] = $phone;
      

       return $errores;

    } 
    
    public function validatestudent($datos){
        $errores = [];

        $errores = $this->require($datos);
        $email = $this->validate_email($datos['email']);
        $phone = $this->validate_telefono($datos['phone']);
      
     
        if($email) $errores['email'] = $email;
        if($phone) $errores['phone'] = $phone;
      

       return $errores;

    } 
    public function validateasistencia($datos){
        $errores = [];
        $errores = $this->require($datos);
       return $errores;

    } 
    public function validateincidencia($datos){
        $errores = [];
        $errores = $this->require($datos);
       return $errores;

    } 
    

   
}
    

    




    

