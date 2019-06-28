<?php
require_once "app/models/Escuela.php";
require_once 'app/Validator.php';

class EscuelasController {

    public function index(){
        #refactor this
        $users = new Escuela;
        $inicio =0;
        $cant = 5;
        $search = "";
        

        if(isset($_GET['p'])) $inicio = $this->pagination($_GET['p'],$cant);
        $sql = "SELECT * FROM escuelas LIMIT $inicio,$cant";
        
        if(isset($_POST['search']) or isset($_GET['search'])){

            $search = isset($_POST['search']) ? $_POST['search'] : $_GET['search'] ;
            $sql = "SELECT * FROM escuelas WHERE name LIKE  '$search%' LIMIT $inicio,$cant";
        }
        
        $section = $users->paginationescuela($search);
        $users = $users->indexescuela($sql); 
  
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
         #refactor this
         $obj = new Validator();
         $errores = [];
         
        if ($obj->validar_requerido($datos['name']) == false) {
         $errores[] = 'El campo Nombre es obligatorio.';
         }
         if ($obj->validar_requerido($datos['direccion']) == false) {
             $errores[] = 'El campo Direccion es obligatorio.';
         }
         
         if ($obj->validar_requerido($datos['encargado']) == false) {
             $errores[] = 'El campo Encargado es obligatorio.';
         }
       
         if ($obj->validar_entero($datos['phone']) == false) {
         $errores[] = 'El campo de Telefono debe ser un número.';
         }
       
         if ($obj->validar_email($datos['email']) == false) {
         $errores[] = 'El campo de Email tiene un formato no válido.';
         }
 
         if(empty($errores)){
             $escuela = new Escuela();
             $escuela->storeescuela($datos);
             session_destroy();
         }else{
            $_SESSION['errores'] = $errores;
            session_destroy();
            
         }
    }
    public function edit(){
       
        $id = $_GET['id'];
        $school = new Escuela();
        $school = $school->editescuela($id);
      
        require_once('./views/layouts/header.php');
        require_once('./views/escuelas/edit.php');
        require_once('./views/layouts/footer.php');
    }

    public function update($datos){
        $obj = new Validator();
        $errores = [];
        
       if ($obj->validar_requerido($datos['name']) == false) {
        $errores[] = 'El campo Nombre es obligatorio.';
        }
        if ($obj->validar_requerido($datos['direccion']) == false) {
            $errores[] = 'El campo Departamento es obligatorio.';
        }
        
        if ($obj->validar_entero($datos['phone']) == false) {
        $errores[] = 'El campo de Telefono debe ser un número.';
        }
      
        if ($obj->validar_email($datos['email']) == false) {
        $errores[] = 'El campo de Email tiene un formato no válido.';
        }
        if ($obj->validar_requerido($datos['encargado']) == false) {
            $errores[] = 'El campo Encargado es obligatorio.';
        }
        if(!empty($errores)){

            $_SESSION['errores'] = $errores;
            session_destroy();
        }else{
            $school = new Escuela;
            $school = $school->updateescuela($datos);
            if(!$school){
                $_SESSION['mensaje'] = "error en actualizacion";
                session_destroy();   
            }
            header('Location: index.php?page=escuela');
            $_SESSION['mensaje'] = "actualizacion correcta";
            session_destroy();
           
        }
    }
    public function destroy($id){
        $school = new Escuela();
        if($school->destroyescuela($id)){
            $_SESSION['mensaje'] = "Escuela eliminada correctamente";
            header('Location: index.php?page=escuela');
            session_destroy();
        }else {
            $_SESSION['mensaje'] = "Error al eliminar";
             session_destroy();
        }
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