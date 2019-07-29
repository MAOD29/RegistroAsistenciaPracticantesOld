<?php

class App 
{
    function __construct(){
        
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url,'/');
        $url = explode('/',$url);

        if(empty($url[0])){
            $archivoController = 'app/controllers/Login.php';
            require_once $archivoController;
            $controller = new Login();
            $controller->render();
            return false;
        }
        $archivoController = 'app/controllers/'.$url[0].'.php';
        if(file_exists($archivoController)){
            require_once $archivoController;
            $controller = new $url[0];
            if(isset($url[1])){
                $controller->{$url[1]}();

            }else{
                echo "error al cargar recurso";
            }
        }else{
            echo "error al cargar recurso";
        }
        
    }
}
