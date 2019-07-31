<?php
require_once "app/models/Practicante.php";
require_once 'app/utilidades/Utilidades.php';
require_once 'app/RequestValidator/Request.php';

class Practicantes extends Controller
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
        $students = new Practicante;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 5;
        $search = "";

        #Si existe una paginación entra en el método paginación para traer la cantidad de registros
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #si existe una busqueda se asigna a la varible search
        if (isset($_GET['search'])) $search =  $_GET['search'];
        #trae el total de registros que existen en la tabla dependiendo de la consulta con la varible search; esto servira para el total de paginaciones
        $section = $students->paginationstudent($search);
        #trae los registros 
        $students = $students->indexstudent($search, $startOfPaging, $amountOfThePaging);
        $this->view->search = $search;
        $this->view->section = $section;
        $this->view->students = $students;
        $this->view->render('practicantes/index');
        unset($_SESSION['mensaje']);

    }

    public function create()
    {
        $options = new Practicante();
        $schools = $options->getAll('escuelas');
        $advisers = $options->getAll('usuarios');
        $this->view->schools = $schools;
        $this->view->advisers = $advisers;
        $this->view->render('practicantes/create');
        unset($_SESSION['mensaje']);

    }

    public function show()
    {
        $id = $_GET['id'];

        $student = new Practicante();
        $schools = $student->getAll('escuelas');
        $advisers = $student->getAll('usuarios');
        $student = $student->showstudent($id);

        $this->view->schools = $schools;
        $this->view->advisers = $advisers;
        $this->view->student = $student;
        $this->view->render('practicantes/show');
        unset($_SESSION['mensaje']);

    }
    public function store()
    {
        $file = new Utilidades();
        if (isset($_POST['registrar'])) {
            $img = $file->uploadFile('storage/img', 'img_perfil');
            $datos = array(
                'name' => $_POST['name'],
                'paterno' => $_POST['paterno'],
                'materno' => $_POST['materno'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'img_perfil' => $img,
                'birth' => $_POST['birth'],
                'id_adviser' => $_POST['id_adviser'],
                'id_school' => $_POST['id_school'],
                'horas_totales' => $_POST['horas_totales'],
            );
            $validate = new Request();
            $errores = $validate->validatestudent($datos);

            if (empty($errores)) {
                $student = new Practicante();
                $student->storestudent($datos);
                $url = constant('URL') . "practicantes/index";
                header("Location: $url");
            } else {

                $student = new Practicante();
                $schools = $student->getAll('escuelas');
                $advisers = $student->getAll('usuarios');

                $this->view->schools = $schools;
                $this->view->advisers = $advisers;

                $_SESSION['errores'] = $errores;
                $this->view->render('practicantes/create');
                unset($_SESSION['errores']);
            }
        } else {
            $url = constant('URL') . "practicantes/create";
            header("Location: $url");
        }
    }


    public function edit()
    {

        $id = $_GET['id'];
        $student = new Practicante();
        $schools = $student->getAll('escuelas');
        $advisers = $student->getAll('usuarios');
        $student = $student->editstudent($id);

        $this->view->schools = $schools;
        $this->view->advisers = $advisers;
        $this->view->student = $student;
        $this->view->render('practicantes/edit');
        unset($_SESSION['mensaje']);

    }

    public function update()
    {
        $file = new Utilidades();
        $tmpimg = $_POST['old_img'];

        if (isset($_POST['editar'])) {
            $img = $file->uploadFile('storage/img', 'img_perfil');
            if (empty($img)) $img = $tmpimg;
            $datos = array(
                'id' => $_GET['id'],
                'name' => $_POST['name'],
                'paterno' => $_POST['paterno'],
                'materno' => $_POST['materno'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'img_perfil' => $img,
                'birth' => $_POST['birth'],
                'id_adviser' => $_POST['id_adviser'],
                'id_school' => $_POST['id_school'],
                'horas_totales' => $_POST['horas_totales'],
            );
            $validate = new Request();
            $errores = $validate->validatestudent($datos);

            if (empty($errores)) {
                $student = new Practicante;
                $student = $student->updatestudent($datos);
                $url = constant('URL') . "practicantes/index";
                header("Location: $url");
            } else {
                $id = $_GET['id'];
                $student = new Practicante();
                $this->view->student = $student->editstudent($id);
                $schools = $student->getAll('escuelas');
                $advisers = $student->getAll('usuarios');

                $this->view->schools = $schools;
                $this->view->advisers = $advisers;
                
                $_SESSION['errores'] = $errores;
                $this->view->render('practicantes/edit');
               unset( $_SESSION['errores']);
            }
        } else {
            $url = constant('URL') . "practicantes/index";
            header("Location: $url");
        }
    }

    public function destroy()
    {
        $id = $_GET['id'];
        $url = constant('URL') . "practicantes/index";
        $student = new Practicante();
        if ($student->destroystudent($id)) {
            header("Location: $url");
            $_SESSION['mensaje'] = "Practicante eliminado correctamente";
        } else {
            header("Location: $url");
            $_SESSION['mensaje'] = "Error al eliminar";
        }
    }
}
