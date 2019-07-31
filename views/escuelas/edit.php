
<div class="container">
    <h1>Editar Escuela</h1>
    <form method="POST" action="<?php echo constant('URL'); ?>escuelas/update&id=<?php echo $this->school['id'];?>" >
        <?php include_once "form.php" ?>
        <button type="submit" class="btn btn-primary" name="editar">Actualización</button>
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class='alert alert-primary' role='alert'><? $_SESSION['mensaje'] ?></div>
        <?php endif;  ?>
    </form>
</div>
