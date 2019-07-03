<?php

class Utilidades {

    public function pagination($page,$cant){
        if($page == 1 or $page == 0){
            $inicio = 0;
        }else{
            $inicio = $page*$cant-$cant;
        }   
        return $inicio;
    }

}