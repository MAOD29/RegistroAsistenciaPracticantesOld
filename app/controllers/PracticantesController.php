<?php
require_once("app/models/Practicante.php");


class PracticantesController {

    public function index(){
        #refactor this
        $users = new Practicante;
        $inicio =0;
        $cant = 5;
        $search = "";
        

        if(isset($_GET['p'])) $inicio = $this->pagination($_GET['p'],$cant);
        $sql = "SELECT * FROM practicantes LIMIT $inicio,$cant";
        
        if(isset($_POST['search']) or isset($_GET['search'])){

            $search = isset($_POST['search']) ? $_POST['search'] : $_GET['search'] ;
            $sql = "SELECT * FROM practicantes WHERE name LIKE  '$search%' LIMIT $inicio,$cant";
        }
        
        $section = $users->paginationpracticante($search);
        $users = $users->indexpracticante($sql); 
  
        require_once('./views/layouts/header.php');
        require_once('./views/practicantes/index.php');
        require_once('./views/layouts/footer.php');
    }
    public function pagination($page,$cant){
        #refactor this
        if($page == 1 or $page == 0){
            $inicio = 0;
        }else{
            $inicio = $page*$cant-$cant;
        }   
        return $inicio;
    }
}