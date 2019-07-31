<?php
class View{
    function __construct(){
       
    }
    function render($nombre){
        require_once 'views/layouts/header.php';
        require_once 'views/' . $nombre . '.php';
        require_once 'views/layouts/footer.php';
    }
    function renderOther($nombre){
        require 'views/' . $nombre . '.php';
       
    }
    
}
?>