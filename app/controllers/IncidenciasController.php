<?php
require_once "app/models/Incidencia.php";
require_once 'app/utilidades/Utilidades.php';
require_once 'app/RequestValidator/Request.php';
class IncidenciasController 
{
    public function index(){
        #incicializando los parametros
        $incidencias = new Incidencia;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 5;
        $search = "";
         
        #Si existe una paginación entra en el método paginación para traer la cantidad de registros
        if(isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'],$amountOfThePaging);
        #si existe una busqueda se asigna a la varible search
        if(isset($_GET['search'])) $search =  $_GET['search'] ;
        #trae el total de registros que existen en la tabla dependiendo de la consulta con la varible search; esto servira para el total de paginaciones
        $section = $incidencias->paginationincidencia($search);
        #trae los registros 
        $incidencias = $incidencias->indexincidencia($search,$startOfPaging,$amountOfThePaging); 
  
        require_once('./views/layouts/header.php');
        require_once('./views/incidencias/index.php');
        require_once('./views/layouts/footer.php');
    }

    public function create(){
        require_once "views/layouts/header.php";
        require_once "views/incidencias/create.php";
    }
    public function store($datos){
        $validate = new Request(); 
        $errores = $validate->validateincidencia($datos);

        if(empty($errores)){
            $incidencia = new Incidencia();
            $incidencia->storeincidencia($datos);
            session_destroy();
        }else{
           $_SESSION['errores'] = $errores;
           session_destroy();
           
        }
   
    }
    public function edit(){
        
        $id =$_GET['id'];

        $incidencia = new Incidencia();
        $incidencia = $incidencia->editincidencia($id);
        
    
        require_once('./views/layouts/header.php');
        require_once('./views/incidencias/edit.php');
        require_once('./views/layouts/footer.php');
    }
    public function update(){

    }
    public function destroy(){

    }
    public function search(){
        $id =$_GET['search'];

        $incidencia = new Incidencia();
        $incidencia = $incidencia->search($id);

        require_once('./views/layouts/header.php');
        require_once('./views/incidencias/create.php');
        require_once('./views/layouts/footer.php');
    }
}
