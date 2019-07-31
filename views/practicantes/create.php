
<div class="container">
  <h1>Crear practicante</h1>
  <form method="POST" action="<?php echo constant('URL'); ?>practicantes/store" enctype="multipart/form-data" >
    
  <?php include_once "form.php" ?>

    <button class="btn btn-primary  btn-block" name="registrar">Registrar</button>

    <?php if (isset($_SESSION['mensaje'])): ?>
      <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['mensaje']?>
      </div>
    <?php endif; ?>

  </form>
</div>