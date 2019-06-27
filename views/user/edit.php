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
    $userUpdate->update($datos);
  }


  ?>
<div class="container">
<h1>Editar usuario</h1>


<form method="POST" action="index.php?page=editusuario&id=<?php echo $user['id'];?>" autocomplete="off" >
    <div class="row fuente">
        <div class="col-4">
            <label for="nombre">Nombre</label>
            <input class="form-control" type="text" name="name" value ="<?php echo $user['name'];?> " placeholder="Ingrese nombre del maestro"> 
    
        </div>
        
        <div class="col-4">
            <label for="materno" >Departamento</label>
            <input class="form-control" type="text" name="department"  value="<?php echo $user['department'];?>" placeholder="Ingrese apellido materno">
           
        </div>
        <div class="col-4">
            <label for="paterno" >Email</label>
            <input class="form-control" type="text" name="email" value="<?php echo $user['email'];?>"  placeholder="Ingrese apellido materno">
           
        </div>
    </div>
    <br>
    <div class="row fuente">
        <div class="col-4">
            <label for="nombre">Telefono</label>
            <input class="form-control" type="text" name="phone" value="<?php echo $user['phone'];?>" placeholder="Ingrese numero">
    
        </div>
        
        <div class="col-4">
            <label for="materno" >Usuario</label>
            <input class="form-control" type="text" name="user" value="<?php echo $user['user'] ?>"  placeholder="Ingrese usuario para ingresar al sistema">
           
        </div>
        <div class="col-4">
            <label for="paterno" >Contraseña</label>
            <input class="form-control" type="password" name="password" value="<?php echo $user['password'] ?> " placeholder="Ingrese contraseña para el sisitma">
           
        </div>
    </div>
        <br>
    <?php
        if (isset($_SESSION['mensaje'])) {
            echo "<div class='alert alert-primary' role='alert'>".$_SESSION['mensaje']."</div>";
        }
    ?>
     <?php if (isset($_SESSION['errores'])): ?> 
            <?php foreach ($_SESSION['errores'] as $mensaje): ?> 
                <div class="alert alert-danger" role="alert">
                    <?php echo $mensaje?>
                </div>
            <?php endforeach;?>
    <?php endif;?>

<button type="submit" class="btn 
   btn-primary" name="editar">Actualizar</button>
 
</form>
</div>
