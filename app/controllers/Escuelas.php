<?php
require_once "app/models/Escuela.php";
require_once 'app/utilidades/Utilidades.php';
require_once 'app/RequestValidator/Request.php';

class Escuelas extends Controller
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
        #incicializando los parametros
        $schools = new Escuela;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 5;
        $search = "";

        #Si existe una paginación entra en el método paginación para traer la cantidad de registros
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #si existe una busqueda se asigna a la varible search
        if (isset($_GET['search'])) $search =  $_GET['search'];
        #trae el total de registros que existen en la tabla dependiendo de la consulta con la varible search; esto servira para el total de paginaciones
        $this->view->search = $search;
        $this->view->section = $schools->paginationschool($search);
        $this->view->schools = $schools->indexschool($search, $startOfPaging, $amountOfThePaging);

        $this->view->render('escuelas/index');
        unset($_SESSION['mensaje']);
    }

    public function create()
    {
        $this->view->render('escuelas/create');
        unset($_SESSION['mensaje']);
    }

    public function store()
    {
        if (isset($_POST['registrar'])) {
            $datos = array(
                'name' => $_POST['name'],
                'direccion' => $_POST['direccion'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'encargado' => $_POST['encargado'],
            );
            $validate = new Request();
            $errores = $validate->validateschool($datos);

            if (!empty($errores)) {
                $_SESSION['errores'] = $errores;
                $this->view->render('escuelas/create');
                unset($_SESSION['errores']);
            } else {
                $user = new Escuela();
                $user->storeschool($datos);
                $url = constant('URL') . "escuelas/index";
                header("Location: $url");
            }
        } else {
            $url = constant('URL') . "escuelas/create";
            header("Location: $url");
        }
    }
    public function edit()
    {

        $id = $_GET['id'];
        $school = new Escuela();
        $this->view->school = $school->editschool($id);

        $this->view->render('escuelas/edit');
        unset($_SESSION['mensaje']);
    }

    public function update()
    {
        if (isset($_POST['editar'])) {

            $datos = array(
                'id' => $_GET['id'],
                'name' => $_POST['name'],
                'direccion' => $_POST['direccion'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'encargado' => $_POST['encargado'],
            );
            $validate = new Request();
            $errores = $validate->validateschool($datos);


            if (!empty($errores)) {
                $id = $_GET['id'];
                $user = new Escuela();
                $this->view->user = $user->editschool($id);
                $_SESSION['errores'] = $errores;
                $this->view->render('escuelas/edit');
               unset( $_SESSION['errores']);
            }else{
                $user = new Escuela;
                $user = $user->updateschool($datos);
                $url = constant('URL') . "escuelas/index";
                header("Location: $url");
               
            }
        } else {
            $url = constant('URL') . "escuelas/index";
            header("Location: $url");
         }
    }
    public function destroy()
    {
        $id = $_GET['id'];
        $school = new Escuela();
        if ($school->destroyschool($id)) {
            $url = constant('URL') . "escuelas/index";
            header("Location: $url");
            $_SESSION['mensaje'] = "Escuela eliminada correctamente";
        } else {
            $url = constant('URL') . "escuelas/index";
            header("Location: $url");
            $_SESSION['mensaje'] = " Error en eliminación";
        }
    }
}
