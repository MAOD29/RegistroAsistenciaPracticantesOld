<?php
require_once 'app/models/Usuario.php';
require_once  'app/controllers/index.php';
require_once 'app/utilidades/Utilidades.php';
require_once 'app/RequestValidator/Request.php';

class Login extends Controller
{
    function render(){
        $this->view->renderOther('login/login');
    }

    public function loginAcceso()
    {
        $datos = array(
            'user' => $_POST['user'],
            'password' => $_POST['password'],
        );           
        session_start();
        $user = new Usuario();
        $respuesta = $user->login($datos['user'], $datos['password']);

        if ($respuesta) {
            $_SESSION['usuarioLogueado'] = $respuesta;
            $url = constant('URL')."index/index";

            header("Location: $url");
           
        }else{
            $this->view->renderOther('login/login');
            echo "usuario y/o contraseña incorrrectos";
        }
        
        
    }
}
