<?php
    require_once 'app/controllers/EscuelasController.php';
    $schoolUpdate = new EscuelasController();
    session_start();

    if(isset($_POST['editar'])){
        $datos = array(
            'id' => $_GET['id'],
            'name' => $_POST['name'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'encargado' => $_POST['encargado'],
        );
        $schoolUpdate->update($datos);
    }
?>
<div class="container">
    <h1>Editar usuario</h1>
    <form method="POST" action="index.php?page=editescuela&id=<?php echo $school['id'];?>" autocomplete="off" >
        <?php include_once "form.php" ?>
        <button type="submit" class="btn btn-primary" name="editar">Actualización</button>
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class='alert alert-primary' role='alert'><? $_SESSION['mensaje'] ?></div>
        <?php endif;  ?>
    </form>
</div>
