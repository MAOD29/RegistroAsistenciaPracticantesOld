<?php
  require_once 'app/controllers/EscuelasController.php';
  $school = new EscuelasController();
  session_start();
  if(isset($_POST['registrar'])){

    $datos = array(
        'name' => $_POST['name'],
        'direccion' => $_POST['direccion'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'encargado' => $_POST['encargado'],
    );
    $school->store($datos);
  }


?>
<div class="container">
<h1>Crear escuela</h1>

<form method="POST" action="index.php?page=createescuela" autocomplete="off" >
    <div class="row fuente">
        <div class="col-4">
            <label for="nombre">Nombre</label>
            <input class="form-control" type="text" name="name" placeholder="Ingrese nombre del maestro">
    
        </div>
        
        <div class="col-4">
            <label for="direccion" >direccion</label>
            <input class="form-control" type="text" name="direccion"  placeholder="Ingrese apellido direccion">
           
        </div>
        <div class="col-4">
            <label for="paterno" >Email</label>
            <input class="form-control" type="text" name="email"  placeholder="Ingrese apellido materno">
           
        </div>
    </div>
    <br>
    <div class="row fuente">
        <div class="col-4">
            <label for="nombre">Telefono</label>
            <input class="form-control" type="text" name="phone" placeholder="Ingrese numero">
    
        </div>
        
        <div class="col-4">
            <label for="encargado" >Encargado</label>
            <input class="form-control" type="text" name="encargado"  placeholder="Ingrese el nombre del responsable de la escuela">
           
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
       
<button class="btn 
   btn-primary" name="registrar">Registrar</button>
</form>
</div>