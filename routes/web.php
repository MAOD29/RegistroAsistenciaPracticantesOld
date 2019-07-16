<?php


$page = $_GET['page'];

if (!empty($page)) {

  $router = array(
    #login
    'login' => array('model' => 'Usuario', 'view' => 'login', 'controller' => 'UsuariosController'),
    #index de la pagina
    'index' => array('model' => 'Index', 'view' => 'index', 'controller' => 'IndexController'),
    /////////////////////////////////////////////////////////////
    #index usuarios
    'usuario' => array('model' => 'Usuario', 'view' => 'index', 'controller' => 'UsuariosController'),
    # vista Crear un usuario
    'createusuario' => array('model' => 'Usuario', 'view' => 'create', 'controller' => 'UsuariosController'),
    #modificar usaurio
    'editusuario' => array('model' => 'Usuario', 'view' => 'edit', 'controller' => 'UsuariosController'),
    /////////////////////////////////////////////////////////////////////
    #index practicantes
    'practicante' => array('model' => 'Practicante', 'view' => 'index', 'controller' => 'PracticantesController'),
     #create practicantes
     'createstudent' => array('model' => 'Practicante', 'view' => 'create', 'controller' => 'PracticantesController'),
    #edit practicante
    'editstudent' => array('model' => 'Practicante', 'view' => 'edit', 'controller' => 'PracticantesController'),
     #delete practicante
     'deletestudent' => array('model' => 'Practicante', 'view' => 'edit', 'controller' => 'PracticantesController'),
    ////////////////////////////////////////////////////////////////////
    #index escuelas
    'escuela' => array('model' => 'Escuela', 'view' => 'index', 'controller' => 'EscuelasController'),
    # vista Crear una escuela
    'createescuela' => array('model' => 'Escuela', 'view' => 'create', 'controller' => 'EscuelasController'),
    #modificar escuela
    'editescuela' => array('model' => 'Escuela', 'view' => 'edit', 'controller' => 'EscuelasController'),
    ////////////////////////////////////////////////////////////////////
    #index assitencias
    'asistencia' => array('model' => 'Asistencia', 'view' => 'index', 'controller' => 'AsistenciasController'),
    # vista Crear una asistencia
    'createasistencia' => array('model' => 'Asistencia', 'view' => 'create', 'controller' => 'AsistenciasController'),
    #modificar asistencia
    'editasistencia' => array('model' => 'Asistencia', 'view' => 'edit', 'controller' => 'AsistenciasController'),
    ////////////////////////////////////////////////////////////////////
    #index incidencias
    'incidencia' => array('model' => 'Incidencia', 'view' => 'index', 'controller' => 'IncidenciasController'),
    # vista Crear una escuela
    'createincidencia' => array('model' => 'Incidencia', 'view' => 'create', 'controller' => 'IncidenciasController'),
    #modificar escuela
    'editincidencia' => array('model' => 'Incindencia', 'view' => 'edit', 'controller' => 'IncidenciasController'),
    #modificar escuela
    'showincidencia' => array('model' => 'Incindencia', 'view' => 'show', 'controller' => 'IncidenciasController'),
    #search 
    'searchincidencia' => array('model' => 'Incindencia', 'view' => 'search', 'controller' => 'IncidenciasController'),
    
    
  );

  foreach($router as $key => $components) {
    if ($page == $key) {
      $model = $components['model'];
      $view = $components['view'];
      $controller = $components['controller'];
      break;
    }
  }

  if (isset($model)) {
    require_once 'app/controllers/'.$controller.'.php';
    $objeto = new $controller();
    $objeto->$view();
  }
  
} else {
  header('Location: index.php?page=login');
}