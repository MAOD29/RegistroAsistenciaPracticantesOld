<?php
require_once "app/models/Incidencia.php";
require_once 'app/utilidades/Utilidades.php';
require_once 'app/RequestValidator/Request.php';
class Incidencias  extends Controller
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
        $incidencias = new Incidencia;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 5;
        $search = "";

        #Si existe una paginación entra en el método paginación para traer la cantidad de registros
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #si existe una busqueda se asigna a la varible search
        if (isset($_GET['search'])) $search =  $_GET['search'];
        #trae el total de registros que existen en la tabla dependiendo de la consulta con la varible search; esto servira para el total de paginaciones
        $section = $incidencias->paginationincidencia($search);
        #trae los registros 
        $incidencias = $incidencias->indexincidencia($search, $startOfPaging, $amountOfThePaging);

        $this->view->search = $search;
        $this->view->section = $section;
        $this->view->incidencias = $incidencias;
        $this->view->render('incidencias/index');
        unset($_SESSION['mensaje']);
    }

    public function create()
    {
        $this->view->render('incidencias/create');
        unset($_SESSION['mensaje']);
    }
    public function show()
    {
        $id = $_GET['id'];

        $incidencia = new Incidencia();
        $incidencia = $incidencia->showincidencia($id);
        $this->view->incidencia = $incidencia;
        $this->view->render('incidencias/show');
        unset($_SESSION['mensaje']);
    }
    public function store()
    {
        if (isset($_POST['registrar'])) {
            $datos = array(
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'date' => $_POST['date'],
                'id_practicante' => $_POST['id_practicante'],
            );
            $validate = new Request();
            $errores = $validate->validateincidencia($datos);

            if (empty($errores)) {
                $incidencia = new Incidencia();
                $incidencia->storeincidencia($datos);
                $url = constant('URL') . "incidencias/index";
                header("Location: $url");

            } else {
                $url = constant('URL') . "incidencias/create";
                header("Location: $url");
                $_SESSION['errores'] = $errores;
               
            }
        } else {
            $url = constant('URL') . "incidencias/create";
            header("Location: $url");
         }
    }
    public function edit()
    {

        $id = $_GET['id'];

        $incidencia = new Incidencia();
        $incidencia = $incidencia->editincidencia($id);
        $this->view->incidencia = $incidencia;
        $this->view->render('incidencias/edit');
        unset($_SESSION['mensaje']);
    }

    public function update()
    {
        $url = constant('URL') . "incidencias/index";
        if(isset($_POST['editar'])){
            $datos = array(
                'id' => $_GET['id'],
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'date' => $_POST['date'],
            );
            $validate = new Request();
            $errores = $validate->validateincidencia($datos);
    
            if (empty($errores)) {
                $incidencia = new Incidencia;
                $incidencia = $incidencia->updateincidencia($datos);
                header("Location: $url");
             
            } else {
                $id = $_GET['id'];
                $incidencia = new Incidencia();
                $this->view->incidencia = $incidencia->editincidencia($id);
                $_SESSION['errores'] = $errores;
                $this->view->render('incidencias/edit');
               unset( $_SESSION['errores']);
            }
        }else{
            header("Location: $url");
        }
       
    }
    public function destroy()
    {
        $id = $_GET['id'];
        $url = constant('URL') . "incidencias/index";
        $incidencia = new Incidencia();
        if ($incidencia->destroyincidencia($id)) {
            header("Location: $url");
            $_SESSION['mensaje'] = "Incidencia eliminada correctamente";
        } else {
            header("Location: $url");
            $_SESSION['mensaje'] = "Error al eliminar";
          
        }
    }
    public function search()
    {
        $id = $_GET['search'];

        $incidencia = new Incidencia();
        $incidencia = $incidencia->search($id);

        $this->view->incidencia = $incidencia;
       $this->view->render('incidencias/create');
    }
}
