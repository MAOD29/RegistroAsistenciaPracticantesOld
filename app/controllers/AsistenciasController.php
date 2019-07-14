<?php
require_once "app/models/Asistencia.php";
require_once 'app/utilidades/Utilidades.php';
require_once 'app/RequestValidator/Request.php';

class AsistenciasController {

    public function index(){
        #incicializando los parametros
        $asistencias = new Asistencia;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 5;
        $search = ""; $dateInicio = ""; $dateEnd= "";
        #Si existe una paginación entra en el método paginación para traer la cantidad de registros
        if(isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'],$amountOfThePaging);
        #si existe una busqueda se asigna a la varible search
        if(isset($_GET['search']) && isset($_GET['dateInicio'])  && isset($_GET['dateEnd'])) { 
            $search =  $_GET['search']; 
            $dateInicio=str_replace('-', '',$_GET['dateInicio']);
            $dateEnd=str_replace('-', '',$_GET['dateEnd']);
           
        }
        #trae el total de registros que existen en la tabla dependiendo de la consulta con la varible search; esto servira para el total de paginaciones
        $section = $asistencias->paginationasistencia($search);
        #trae los registros 
        $asistencias = $asistencias->indexasistencia($search,$dateInicio, $dateEnd,$startOfPaging,$amountOfThePaging); 
      
        require_once './views/layouts/header.php' ;
        require_once './views/asistencias/index.php';
        require_once './views/layouts/footer.php' ;
    }

    public function create(){
        require_once './views/asistencias/create.php';
        require_once './views/layouts/footer.php';

    }

    public function store($datos){
        
         $validate = new Request(); 
         $errores = $validate->validateasistencia($datos);
         if(!empty($errores)){
            header('Location: index.php?page=createasistencia');  
         }

         $asistencia = new Asistencia();
         $student = $asistencia->storeorupdate($datos);

         if($student){
           
            $_SESSION['mensaje'] = "correcto";
            session_destroy();
        
        }else{
            $_SESSION['mensaje'] = "error en actualizacion";
            session_destroy();
        }
             
         
         
        
    }
    public function edit(){
       
        $id = $_GET['id'];
        $fecha = $_GET['fecha'];
        $asistencia = new Asistencia();
        $asistencia = $asistencia->editasistencia($id,$fecha);
      
        require_once('./views/layouts/header.php');
        require_once('./views/asistencias/edit.php');
        require_once('./views/layouts/footer.php');
    }

    public function update($datos){
       
        $asistencia = new Asistencia;
        $asistencia = $asistencia->updatea($datos);
        if($asistencia){
            header('Location: index.php?page=asistencia');
            $_SESSION['mensaje'] = "correcto";
            session_destroy();
            exit();
        
        }else{
            $_SESSION['mensaje'] = "error en actualizacion";
            session_destroy();
        }
       
    }
    
}