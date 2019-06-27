<?php

class Validator 
{



    /**
     * Método que valida si un texto no esta vacío
     * @param {string} - Texto a validar
     * @return {boolean}
     */
    public function validar_requerido(string $texto): bool {
        return !(trim($texto) == '');
    }

    /**
     * Método que valida si es un número entero 
     * @param {string} - Número a validar
     * @return {bool}
     */
    public function validar_entero(string $numero): bool {
        return (filter_var($numero, FILTER_VALIDATE_INT) === FALSE) ? False : True;
    }

    /**
     * Método que valida si el texto tiene un formato válido de E-Mail
     * @param {string} - Email
     * @return {bool}
     */
    public function validar_email(string $texto): bool {
        return (filter_var($texto, FILTER_VALIDATE_EMAIL) === FALSE) ? False : True;
    }
}
