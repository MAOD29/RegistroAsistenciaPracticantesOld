
<div class="container">
  <h1>Editar Practicante</h1>
  <form method="POST" action="<?php echo constant('URL'); ?>practicantes/update&id=<?php echo $this->student['id'];?>" autocomplete="off" enctype="multipart/form-data" >

    <?php include_once "form.php" ?>
    
    <button type="submit" class="btn btn-primary  btn-block" name="editar">Actualizar</button>
  <input type="hidden" readonly name="old_img" value="<?php echo $this->student['img_perfil'];?>">
    <?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success" role="alert">
      <?php echo $_SESSION['mensaje']?>
    </div>
  <?php endif; ?>
</form>
</div>
