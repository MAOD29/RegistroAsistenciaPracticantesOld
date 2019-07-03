<?php
    require_once 'app/controllers/UsuariosController.php';
    $user = new UsuariosController();
    session_start();

    if(isset($_POST['registrar'])){
        $datos = array(
            'name' => $_POST['name'],
            'department' => $_POST['department'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'user' => $_POST['user'],
            'password' => $_POST['password'],
        );
        if( !empty($_POST['password']) && strlen($_POST['password']) >= 7 )  $datos['password'] = md5($_POST['password']);
        $user->store($datos);
    }
    #refactor this 
    $error = function($field){
        if (isset($_SESSION['errores'])){
            foreach ($_SESSION['errores'] as $key =>$dato) {
                $errores[$key]= $dato;
            }
            if(isset($errores[$field])) return $errores[$field];
        }
    };
?>
<div class="container">
  <h1>Crear usuario</h1>
  <form method="POST" action="index.php?page=createusuario" autocomplete="off" >
    <div class="row fuente">
      <div class="col-4">
        <label for="nombre">Nombre</label>
        <input class="form-control" type="text" name="name" placeholder="Ingrese nombre del maestro">
        <span class="error"><?php echo$error('name') ?></span>
      </div>
      <div class="col-4">
        <label for="department" >Departamento</label>
        <input class="form-control" type="text" name="department"  placeholder="Ingrese apellido materno">
        <span class="error"><?php echo$error('department') ?></span>
      </div>
      <div class="col-4">
        <label for="email" >Email</label>
        <input class="form-control" type="text" name="email"  placeholder="Ingrese apellido materno">
        <span class="error"><?php echo$error('email') ?></span>
      </div>
    </div>
    <br>
    <div class="row fuente">
      <div class="col-4">
        <label for="phone">Telefono</label>
        <input class="form-control" type="text" name="phone" placeholder="Ingrese numero">
        <span class="error"><?php echo$error('phone') ?></span>
      </div>
      <div class="col-4">
        <label for="user" >Usuario</label>
        <input class="form-control" type="text" name="user"  placeholder="Ingrese usuario para ingresar al sistema">
        <span class="error"><?php echo$error('user') ?></span>
      </div>
      <div class="col-4">
        <label for="password" >Contraseña</label>
        <input class="form-control" type="password" name="password"  placeholder="Ingrese contraseña para el sisitma" >
        <span class="error"><?php echo$error('password') ?></span>
      </div>
    </div>
    <br>
    <button class="btn btn-primary" name="registrar">Registrar</button>
    <?php if (isset($_SESSION['mensaje'])): ?>
      <div class='alert alert-primary' role='alert'><? $_SESSION['mensaje'] ?></div>
    <?php endif;  ?>
  </form>
</div>