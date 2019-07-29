<div class="container">
  <h1>Editar usuario</h1>
  <form method="POST" action="<?php echo constant('URL'); ?>usuarios/update&id=<?php echo $this->user['id']; ?>">

    <?php include_once "form.php" ?>

    <button type="submit" class="btn btn-primary" name="editar">Actualizar</button>

    <?php if (isset($_SESSION['mensaje'])) : ?>
      <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['mensaje'] ?>
      </div>
    <?php endif; ?>
  </form>
</div>