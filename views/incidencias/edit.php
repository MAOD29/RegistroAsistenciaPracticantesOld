
<div class="container">
    <h1>Editar Incidencia</h1>
    <br>
    <form method="POST" action="<?php echo constant('URL'); ?>incidencias/update?id=<?php echo $this->incidencia['id_incidencia'];?>" autocomplete="off" >
        <?php include_once "form.php" ?>
        <button type="submit" class="btn btn-primary  btn-block" name="editar">Actualizar</button>
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class='alert alert-primary' role='alert'><? $_SESSION['mensaje'] ?></div>
        <?php endif;  ?>
    </form>
</div>
