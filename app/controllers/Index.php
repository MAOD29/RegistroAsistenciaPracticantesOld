<?php


class Index extends Controller {

    function __construct() {
        parent::__construct();
        session_start();
        if (!isset($_SESSION['usuarioLogueado'])) {
            $url = constant('URL') . "login/render";
            header("Location: $url");
        }
       
    }
    public function index(){
        $this->view->render('dashboard');
    }


}



?>