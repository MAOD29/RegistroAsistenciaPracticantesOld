<?php
require_once "app/models/Practicante.php";
require_once 'app/utilidades/Utilidades.php';
require_once 'app/RequestValidator/Request.php';

class PracticantesController {

    public function index(){
        #incicializando los parametros
        $students = new Practicante;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 5;
        $search = "";
        
        #Si existe una paginación entra en el método paginación para traer la cantidad de registros
        if(isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'],$amountOfThePaging);
        #si existe una busqueda se asigna a la varible search
        if(isset($_GET['search'])) $search =  $_GET['search'] ;
        #trae el total de registros que existen en la tabla dependiendo de la consulta con la varible search; esto servira para el total de paginaciones
        $section = $students->paginationstudent($search);
        #trae los registros 
        $students = $students->indexstudent($search,$startOfPaging,$amountOfThePaging); 
    
  
        require_once('./views/layouts/header.php');
        require_once('./views/practicantes/index.php');
        require_once('./views/layouts/footer.php');
    }
   
    public function create(){
        $options = new Practicante();
        $schools = $options->getAll('escuelas');
        $advisers = $options->getAll('usuarios');

        require_once('./views/layouts/header.php');
        require_once('./views/practicantes/create.php');
        require_once('./views/layouts/footer.php');
    }
    
    public function show(){
        $id =$_GET['id'];
      
        $student = new Practicante();
        $schools = $student->getAll('escuelas');
        $advisers = $student->getAll('usuarios');
        $student = $student->showstudent($id);
        
        require_once('./views/layouts/header.php');
        require_once('./views/practicantes/show.php');
        require_once('./views/layouts/footer.php');
    }
    public function store($datos){
        #refactor this
        $validate = new Request(); 
        $errores = $validate->validatestudent($datos);

        if(empty($errores)){
            $practicante = new Practicante();
            $practicante->storestudent($datos);
            session_destroy();
        }else{
           $_SESSION['errores'] = $errores;
           session_destroy();
           
        }
    }


    public function edit(){
       
        $id = $_GET['id'];
        $student = new Practicante();
        $schools = $student->getAll('escuelas');
        $advisers = $student->getAll('usuarios');
        $student = $student->editstudent($id);
      
        require_once('./views/layouts/header.php');
        require_once('./views/practicantes/edit.php');
        require_once('./views/layouts/footer.php');
    }

    public function update($datos){
        $validate = new Request(); 
        $errores = $validate->validatestudent($datos);
       
        if(empty($errores)){
            $student = new Practicante;
            $student = $student->updatestudent($datos);
            
            if($student){
                $_SESSION['mensaje'] = "actualizacion correcta";
                session_destroy();
                # header('Location: index.php?page=usuario');
            }            
        }else{
            $_SESSION['errores'] = $errores;
            session_destroy();
        }
    }

    public function destroy($id){
        $student = new Practicante();
        if($student->destroystudent($id)){
            $_SESSION['mensaje'] = "Practicante eliminado correctamente";
            #header('Location: index.php?page=usuario');
            session_destroy();
        }else {
            $_SESSION['mensaje'] = "Error al eliminar";
             session_destroy();
        }
    }

    
    
    
}