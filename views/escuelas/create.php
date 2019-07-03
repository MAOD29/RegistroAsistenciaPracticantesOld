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
    <h1>Crear escuela</h1>

    <form method="POST" action="index.php?page=createescuela" autocomplete="off" >
        <div class="row fuente">
            <div class="col-4">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="name" placeholder="Ingrese nombre del maestro">
                <span class="error"><?php echo$error('name') ?></span>
            </div>
            
            <div class="col-4">
                <label for="direccion" >direccion</label>
                <input class="form-control" type="text" name="direccion"  placeholder="Ingrese apellido direccion">
                <span class="error"><?php echo$error('direccion') ?></span>
            </div>
            <div class="col-4">
                <label for="paterno" >Email</label>
                <input class="form-control" type="text" name="email"  placeholder="Ingrese apellido materno">
                <span class="error"><?php echo$error('email') ?></span>
            </div>
        </div>
        <br>
        <div class="row fuente">
            <div class="col-4">
                <label for="nombre">Telefono</label>
                <input class="form-control" type="text" name="phone" placeholder="Ingrese numero">
                <span class="error"><?php echo$error('phone') ?></span>
            </div>
            <div class="col-4">
                <label for="encargado" >Encargado</label>
                <input class="form-control" type="text" name="encargado"  placeholder="Ingrese el nombre del responsable">
                <span class="error"><?php echo$error('encargado') ?></span>
            </div>
        </div>
        <br>
        <button class="btn btn-primary" name="registrar">Registrar</button>
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class='alert alert-primary' role='alert'><? $_SESSION['mensaje'] ?></div>
        <?php endif;  ?>
    </form>
</div>