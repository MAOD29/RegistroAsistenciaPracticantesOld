<?php
require_once 'app/models/Usuario.php';
require_once 'app/utilidades/Utilidades.php';
require_once 'app/RequestValidator/Request.php';

class Usuarios extends Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        if (!isset($_SESSION['usuarioLogueado'])) {
            $url = constant('URL') . "login/render";
            header("Location: $url");
        }
    }
    public function index()
    {
        #inicializando los valores
        $users = new Usuario;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 5;
        $search = "";
        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #asignando la busqueda si existe
        if (isset($_GET['search'])) $search =  $_GET['search'];
        
        $this->view->search = $search;
        $this->view->section = $users->paginationuser($search);
        $this->view->users = $users->indexuser($search, $startOfPaging, $amountOfThePaging);

        $this->view->render('usuarios/index');
        unset($_SESSION['mensaje']);
    }

    public function show()
    { }
    public function create()
    {
        $this->view->render('usuarios/create');
        unset($_SESSION['mensaje']);
    }

    public function store()
    {
        if (isset($_POST['registrar'])) {
            $datos = array(
                'name' => $_POST['name'],
                'department' => $_POST['department'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'user' => $_POST['user'],
                'password' => $_POST['password'],
            );
            if (!empty($_POST['password']) && strlen($_POST['password']) >= 7)  $datos['password'] = md5($_POST['password']);
            $validate = new Request();
            $errores = $validate->validateuser($datos);

            if (!empty($errores)) {
                $_SESSION['errores'] = $errores;
                $this->view->render('usuarios/create');
                unset($_SESSION['errores']);
            } else {
                $user = new Usuario();
                $user->storeuser($datos);
                $url = constant('URL') . "usuarios/index";
                header("Location: $url");
            }
        } else {
            $url = constant('URL') . "usuarios/create";
            header("Location: $url");
        }
    }


    public function edit()
    {

        $id = $_GET['id'];
        $user = new Usuario();
        $this->view->user = $user->edituser($id);
        $this->view->render('usuarios/edit');
        unset($_SESSION['mensaje']);
        
    }

    public function update()
    {
        if (!isset($_POST['editar'])) {
            $url = constant('URL') . "usuarios/index";
            header("Location: $url");
        }
        $datos = array(
            'id' => $_GET['id'],
            'name' => $_POST['name'],
            'department' => $_POST['department'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'user' => $_POST['user'],
            'password' => $_POST['password'],
        );
        if (!empty($_POST['password']) && strlen($_POST['password']) >= 7)  $datos['password'] = md5($_POST['password']);
       
        $validate = new Request();
        $errores = $validate->validateuser($datos);

        if (!empty($errores)) {
            $id = $_GET['id'];
            $user = new Usuario();
            $this->view->user = $user->edituser($id);
            $_SESSION['errores'] = $errores;
            $this->view->render('usuarios/edit');
           unset( $_SESSION['errores']);
        }else{
            $user = new Usuario;
            $user = $user->updateuser($datos);
            $url = constant('URL') . "usuarios/index";
            header("Location: $url");
           
        }

       
    }

    public function destroy()
    {
        $id = $_GET['id'];
        $user = new Usuario();
        if ($user->destroyuser($id)) {
            $url = constant('URL') . "usuarios/index";
            header("Location: $url");
            $_SESSION['mensaje'] = "Asesor eliminado correctamente";
        } else {
            $url = constant('URL') . "usuarios/index";
            header("Location: $url");
            $_SESSION['mensaje'] = "Error al eliminar";
        }
    }
}
