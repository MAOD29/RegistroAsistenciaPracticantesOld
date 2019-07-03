<?php
require_once "app/models/Escuela.php";
require_once 'app/utilidades/Utilidades.php';
require_once 'app/RequestValidator/Request.php';

class EscuelasController {

    public function index(){
        #incicializando los parametros
        $schools = new Escuela;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 5;
        $search = "";
         
        #Si existe una paginación entra en el método paginación para traer la cantidad de registros
        if(isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'],$amountOfThePaging);
        #si existe una busqueda se asigna a la varible search
        if(isset($_GET['search'])) $search =  $_GET['search'] ;
        #trae el total de registros que existen en la tabla dependiendo de la consulta con la varible search; esto servira para el total de paginaciones
        $section = $schools->paginationschool($search);
        #trae los registros 
        $schools = $schools->indexschool($search,$startOfPaging,$amountOfThePaging); 
  
        require_once('./views/layouts/header.php');
        require_once('./views/escuelas/index.php');
        require_once('./views/layouts/footer.php');
    }

    public function create(){

        require_once './views/layouts/header.php';
        require_once './views/escuelas/create.php';
        require_once './views/layouts/footer.php';

    }

    public function store($datos){
        
         $validate = new Request(); 
         $errores = $validate->validateschool($datos);
 
         if(empty($errores)){
             $school = new Escuela();
             $school->storeschool($datos);
             session_destroy();
         }else{
            $_SESSION['errores'] = $errores;
            session_destroy();
            
         }
    }
    public function edit(){
       
        $id = $_GET['id'];
        $school = new Escuela();
        $school = $school->editschool($id);
      
        require_once('./views/layouts/header.php');
        require_once('./views/escuelas/edit.php');
        require_once('./views/layouts/footer.php');
    }

    public function update($datos){
        $validate = new Request(); 
        $errores = $validate->validateschool($datos);
       
        if(empty($errores)){
            $school = new Escuela;
            $school = $school->updateschool($datos);
            if(!$school){
                $_SESSION['mensaje'] = "error en actualizacion";
                session_destroy();   
            }
            header('Location: index.php?page=escuela');
            $_SESSION['mensaje'] = "actualizacion correcta";
            session_destroy();
        }else{
            $_SESSION['errores'] = $errores;
             session_destroy();
        }
    }
    public function destroy($id){
        $school = new Escuela();
        if($school->destroyschool($id)){
            $_SESSION['mensaje'] = "Escuela eliminada correctamente";
            header('Location: index.php?page=escuela');
            session_destroy();
        }else {
            $_SESSION['mensaje'] = "Error al eliminar";
             session_destroy();
        }
    }
}