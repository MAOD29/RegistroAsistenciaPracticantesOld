<?php
    require_once 'app/controllers/EscuelasController.php';
    $schoolCreate = new EscuelasController();
    session_start();

    if(isset($_POST['registrar'])){ 
        $datos = array(
            'name' => $_POST['name'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'encargado' => $_POST['encargado'],
        );
        $schoolCreate->store($datos);
    }   

?>
<div class="container">
    <h1>Crear escuela</h1>
    
    <form method="POST" action="index.php?page=createescuela" autocomplete="off" >
        <?php include_once "form.php" ?>
        <button class="btn btn-primary" name="registrar">Registrar</button>
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class='alert alert-primary' role='alert'><? echo $_SESSION['mensaje'] ?></div>
        <?php endif;  ?>
    </form>
</div>