<?php


class Index extends Controller {

    function __construct() {
        parent::__construct();
        echo "no hay sesion iniciada";
        session_start();
        if( !isset($_SESSION['usuarioLogueado']) ){
            echo "no hay sesion iniciada";
            #header('Location: index.php?page=login');
        }
       
    }
    public function index(){
        $this->view->render('dashboard');
    }


}



?>