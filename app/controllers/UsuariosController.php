<?php
require_once 'app/models/Usuario.php';
require_once 'app/Validator.php';

class UsuariosController
{
    public function login(){

        require_once('./views/login/login.php');
    
    }    

    public function loginAcceso($datos){
       session_start();
        $user = new Usuario();
        $respuesta = $user->login($datos['user'], $datos['password']);
        var_dump($respuesta);
		if ($respuesta) {
            $_SESSION['id_usuario'] = $respuesta['id'];
            $_SESSION['id_rol'] = $respuesta['id_rol'];
        
			if ($_SESSION['id_rol'] == 1) {
				header('Location: index.php?page=index');
                die();
			} else {
              echo "Location: index.php?page=login";
                die();
                
			}
		}else{
            echo "no tiene permiso";
        }
    }

    public function index(){
        #refactor this
        $users = new Usuario;
        $inicio =0;
        $cant = 5;
        $search = "";
       

        if(isset($_GET['p'])) $inicio = $this->pagination($_GET['p'],$cant);
        $sql = "SELECT * FROM usuarios LIMIT $inicio,$cant";
        
        if(isset($_POST['search']) or isset($_GET['search'])){

            $search = isset($_POST['search']) ? $_POST['search'] : $_GET['search'] ;
            $sql = "SELECT * FROM usuarios WHERE name LIKE  '$search%' LIMIT $inicio,$cant";
        }
        
        $section = $users->paginationuser($search);
        $users = $users->indexuser($sql); 
        
        require_once('./views/layouts/header.php');
        require_once('./views/user/index.php');
        require_once('./views/layouts/footer.php');
       
    }
    public function show(){
       
        
    }
    public function create(){
        require_once('./views/layouts/header.php');
        require_once('./views/user/create.php');
        require_once('./views/layouts/footer.php');
    }
    
    public function store($datos){
        #refactor this
        $obj = new Validator();
        $errores = [];
        
       if ($obj->validar_requerido($datos['name']) == false) {
        $errores[] = 'El campo Nombre es obligatorio.';
        }
        if ($obj->validar_requerido($datos['department']) == false) {
            $errores[] = 'El campo Departamento es obligatorio.';
        }
        if ($obj->validar_requerido($datos['user']) == false) {
            $errores[] = 'El campo Usuario es obligatorio.';
        }
        if ($obj->validar_requerido($datos['password']) == false) {
            $errores[] = 'El campo Departamento es obligatorio.';
        }
      
        if ($obj->validar_entero($datos['phone']) == false) {
        $errores[] = 'El campo de Telefono debe ser un número.';
        }
      
        if ($obj->validar_email($datos['email']) == false) {
        $errores[] = 'El campo de Email tiene un formato no válido.';
        }

        if(empty($errores)){
            $usuario = new Usuario();
            $usuario->storeuser($datos);
            session_destroy();
        }else{
           $_SESSION['errores'] = $errores;
           session_destroy();
           
        }
    }


    public function edit(){
       
        $id = $_GET['id'];
        $user = new Usuario();
        $user = $user->edituser($id);
      
        require_once('./views/layouts/header.php');
        require_once('./views/user/edit.php');
        require_once('./views/layouts/footer.php');
    }

    public function update($datos){
        $obj = new Validator();
        $errores = [];
        
       if ($obj->validar_requerido($datos['name']) == false) {
        $errores[] = 'El campo Nombre es obligatorio.';
        }
        if ($obj->validar_requerido($datos['department']) == false) {
            $errores[] = 'El campo Departamento es obligatorio.';
        }
        if ($obj->validar_requerido($datos['user']) == false) {
            $errores[] = 'El campo Usuario es obligatorio.';
        }
        if ($obj->validar_requerido($datos['password']) == false) {
            $errores[] = 'El campo Departamento es obligatorio.';
        }
      
        if ($obj->validar_entero($datos['phone']) == false) {
        $errores[] = 'El campo de Telefono debe ser un número.';
        }
      
        if ($obj->validar_email($datos['email']) == false) {
        $errores[] = 'El campo de Email tiene un formato no válido.';
        }
        
        if(!empty($errores)){

            $_SESSION['errores'] = $errores;
            session_destroy();
            
        }else{
            $user = new Usuario;
            $user = $user->updateuser($datos);
            
            if(!$user){
                $_SESSION['mensaje'] = "error en actualizacion";
                session_destroy();   
            }
            header('Location: index.php?page=usuario');
            $_SESSION['mensaje'] = "actualizacion correcta";
            session_destroy();
           
        }
    }

    public function destroy($id){
        $user = new Usuario();
        if($user->destroyuser($id)){
            $_SESSION['mensaje'] = "Asesor eliminado correctamente";
            header('Location: index.php?page=usuario');
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

?>