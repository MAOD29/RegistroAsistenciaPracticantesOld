<?php
require_once 'app/models/Usuario.php';
require_once 'app/utilidades/Utilidades.php';
require_once 'app/RequestValidator/Request.php';

class UsuariosController
{
    public function login(){

        require_once('./views/login/login.php');
    }    

    public function loginAcceso($datos){
       session_start();
        $user = new Usuario();
        $respuesta = $user->login($datos['user'], $datos['password']);
        if ($respuesta) {
            #$_SESSION['id_usuario'] = $respuesta['id'];
            $_SESSION['id_rol'] = $respuesta['id_rol'];
        
            if ($_SESSION['id_rol'] == 1) {
                header('Location: index.php?page=index');
                die();
            } else {
              echo "Location: index.php?page=login";
                die();
                }
        }else{
            echo "Usuario y/o contraseña incorrectos";
        }
    }

    public function index(){
        #inicializando los valores
        $users = new Usuario;
        $utilities = new Utilidades();
        $startOfPaging =0;
        $amountOfThePaging = 5;
        $search = "";
        #asignando el inicio de de los articulos a paginar
        if(isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'],$amountOfThePaging);
        #asignando la busqueda si existe
        if(isset($_GET['search'])) $search =  $_GET['search'] ;
        
        $section = $users->paginationuser($search);
        $users = $users->indexuser($search,$startOfPaging,$amountOfThePaging); 
        
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
        $validate = new Request(); 
        $errores = $validate->validateuser($datos);

        if(empty($errores)){
            $user = new Usuario();
            $user->storeuser($datos);
            
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
        $validate = new Request(); 
        $errores = $validate->validateuser($datos);
       
        if(empty($errores)){
            $user = new Usuario;
            $user = $user->updateuser($datos);
            
            if(!$user){
                $_SESSION['mensaje'] = "error en actualizacion";
                session_destroy();   
            }
           # header('Location: index.php?page=usuario');
            $_SESSION['mensaje'] = "actualizacion correcta";

            session_destroy();
           
            
        }else{
            $_SESSION['errores'] = $errores;
            session_destroy();
        }
    }

    public function destroy($id){
        $user = new Usuario();
        if($user->destroyuser($id)){
            $_SESSION['mensaje'] = "Asesor eliminado correctamente";
            #header('Location: index.php?page=usuario');
            session_destroy();
        }else {
            $_SESSION['mensaje'] = "Error al eliminar";
             session_destroy();
        }
    }
   
   
}

?>