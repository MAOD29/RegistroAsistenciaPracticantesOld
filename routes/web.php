<?php


$page = $_GET['page'];

if (!empty($page)) {
  #http://curso-php.test/cms/index.php?page=buscar

  $router = array(
    /////////////////////////////////////////////////////////////
    #login
    'login' => array('model' => 'Usuario', 'view' => 'login', 'controller' => 'UsuariosController'),
    #index usuarios
    'usuario' => array('model' => 'Usuario', 'view' => 'index', 'controller' => 'UsuariosController'),
    # vista Crear un usuario
    'createusuario' => array('model' => 'Usuario', 'view' => 'create', 'controller' => 'UsuariosController'),
    #modificar usaurio
    'editusuario' => array('model' => 'Usuario', 'view' => 'edit', 'controller' => 'UsuariosController'),

    ////////////////////////////////////////////////////////////////////
    #index de la pagina
    'index' => array('model' => 'Index', 'view' => 'index', 'controller' => 'IndexController'),
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