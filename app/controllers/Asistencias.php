<?php
require_once "app/models/Asistencia.php";
require_once 'app/utilidades/Utilidades.php';
require_once 'app/RequestValidator/Request.php';

class Asistencias extends Controller
{

    function __construct()
    {
        parent::__construct();
        session_start();
       
    }

    public function index()
    {
        if (!isset($_SESSION['usuarioLogueado'])) {
            $url = constant('URL') . "login/render";
            header("Location: $url");
        }
        #incicializando los parametros
        $asistencias = new Asistencia;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 5;
        $search = "";
        $dateInicio = "";
        $dateEnd = "";
        #Si existe una paginación entra en el método paginación para traer la cantidad de registros
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #si existe una busqueda se asigna a la varible search
        if (isset($_GET['search']) && isset($_GET['dateInicio'])  && isset($_GET['dateEnd'])) {
            $search =  $_GET['search'];
            $dateInicio = str_replace('-', '', $_GET['dateInicio']);
            $dateEnd = str_replace('-', '', $_GET['dateEnd']);
        }
        #trae el total de registros que existen en la tabla dependiendo de la consulta con la varible search; esto servira para el total de paginaciones
        $section = $asistencias->paginationasistencia($search);
        #trae los registros 
        $asistencias = $asistencias->indexasistencia($search, $dateInicio, $dateEnd, $startOfPaging, $amountOfThePaging);

        $this->view->search = $search;
        $this->view->section = $section;
        $this->view->asistencias = $asistencias;

        $this->view->render('asistencias/index');
        unset($_SESSION['mensaje']);
    }

    public function create()
    {
        $this->view->renderOther('asistencias/create');
        
        unset($_SESSION['mensaje']);
    }

    public function store()
    {

        if (isset($_POST['id_practicante'])) {
            $fecha = new  DateTime('now');
            $datos = [
                'fecha' => $fecha->format('Y-m-d'),
                'hora_entrada' => $fecha->format('H:i'),
                'id_practicante' => $_POST['id_practicante']
            ];
          
            $validate = new Request();
            $errores = $validate->validateasistencia($datos);
            if (!empty($errores)) {
                $url = constant('URL') . "login/render";
                header("Location: $url");
            }
            $asistencia = new Asistencia();
            $student = $asistencia->storeorupdate($datos);
            if ($student) {
                $_SESSION['student'] = $student;
                $this->view->renderOther('asistencias/create');
                session_destroy();
            }
        }
       
    }
    public function edit()
    {
        if (!isset($_SESSION['usuarioLogueado'])) {
            $url = constant('URL') . "login/render";
            header("Location: $url");
        }
        $id = $_GET['id'];
        $asistencia = new Asistencia();
        $asistencia = $asistencia->editasistencia($id);
        $this->view->asistencia = $asistencia;
        $this->view->render('asistencias/edit');
    }

    public function update()
    {
        if (!isset($_SESSION['usuarioLogueado'])) {
            $url = constant('URL') . "login/render";
            header("Location: $url");
        }
        $url = constant('URL') . "asistencias/index";
        if (isset($_POST['editar'])) {
            $datos = array(
                'id' => $_GET['id'],
                'hora_entrada' => $_POST['hora_entrada'],
                'hora_salida' => $_POST['hora_salida'],

            );
            $salida =  new DateTime($datos['hora_salida']);
            $entrada = new DateTime($datos['hora_entrada']);
            $horast = $salida->diff($entrada);

            $datosUpdate['id'] = $datos['id'];
            $datosUpdate['hora_entrada'] = $datos['hora_entrada'];
            $datosUpdate['hora_salida'] = $datos['hora_salida'];
            $datosUpdate['horast'] = $horast->format('%H');

            $asistencia = new Asistencia;
            $asistencia = $asistencia->updatea($datosUpdate);
            header("Location: $url");
        } else {

            header("Location: $url");
        }
    }
}
