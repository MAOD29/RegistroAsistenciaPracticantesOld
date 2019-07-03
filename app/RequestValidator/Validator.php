<?php

class Validator 
{

    public function require($datos) {
       $errores = [];

        foreach ($datos as $key => $dato) {
           
            if((trim($dato) == '')){
                $errores[$key] = "El campo es requerido";
            }
        }
        return $errores;
    }

    public function validar_entero( $number) {
        return (filter_var($number, FILTER_VALIDATE_INT)  === FALSE) ? 'ingrese el dato con el formato correcto' : false;
    }
    public function validate_telefono( $phone) {
        return (filter_var($phone, FILTER_VALIDATE_INT) === FALSE || strlen ($phone) != 10)  ? 'ingrese el dato con el formato correcto' : false;
    }
    public function validate_email($email){
        
        return (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) ? 'el campo debe debe ser tipo email': false;
    }
    public function validatePassword($password){
        
        return (strlen ($password) <= 7) ? 'El campo contraseña debe ser mayor a 8 digitos' : false; 

    }
}
