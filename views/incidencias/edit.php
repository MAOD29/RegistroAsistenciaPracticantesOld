<?php
    require_once 'app/controllers/IncidenciasController.php';
    $incidenciaUpdate = new IncidenciasController();
    session_start();

    if(isset($_POST['editar'])){
        $datos = array(
            'id' => $_GET['id'],
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'],
            'date' => $_POST['date'],
        );
        $incidenciaUpdate->update($datos);
    }
?>

<div class="container">
    <h1>Editar Incidencia</h1>
    <br>
    <form method="POST" action="index.php?page=editincidencia&id=<?php echo $incidencia['id_incidencia'];?>" autocomplete="off" >
        <?php include_once "form.php" ?>
        <button type="submit" class="btn btn-primary  btn-block" name="editar">Actualizar</button>
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class='alert alert-primary' role='alert'><? $_SESSION['mensaje'] ?></div>
        <?php endif;  ?>
    </form>
</div>
