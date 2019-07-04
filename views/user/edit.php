<?php
    require_once 'app/controllers/UsuariosController.php';
    $userUpdate = new UsuariosController();
    session_start();

    if(isset($_POST['editar'])){
        $datos = array(
            'id' => $_GET['id'],
            'name' => $_POST['name'],
            'department' => $_POST['department'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'user' => $_POST['user'],
            'password' => $_POST['password'],
        );
        if( !empty($_POST['password']) && strlen($_POST['password']) >= 7 )  $datos['password'] = md5($_POST['password']);
        $userUpdate->update($datos);
    }
    
    #var_dump($_SESSION['mensaje']);
?>
<div class="container">
  <h1>Editar usuario</h1>
  <form method="POST" action="index.php?page=editusuario&id=<?php echo $user['id'];?>" autocomplete="off" >

    <?php include_once "form.php" ?>
    



    <button type="submit" class="btn btn-primary" name="editar">Actualizar</button>

    <?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success" role="alert">
      <?php echo $_SESSION['mensaje']?>
    </div>
  <?php endif; ?>
</form>
</div>
