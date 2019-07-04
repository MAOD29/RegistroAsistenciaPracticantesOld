<?php
    require_once 'app/controllers/UsuariosController.php';
    $userCreate = new UsuariosController();
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
        $userCreate->store($datos);
    }
    
?>
<div class="container">
  <h1>Crear usuario</h1>
  <form method="POST" action="index.php?page=createusuario" autocomplete="off" >
    
    <?php include_once "form.php" ?>

    <button class="btn btn-primary" name="registrar">Registrar</button>

    <?php if (isset($_SESSION['mensaje'])): ?>
      <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['mensaje']?>
      </div>
    <?php endif; ?>

  </form>
</div>