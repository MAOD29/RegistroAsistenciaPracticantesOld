<?php
    require_once 'app/controllers/PracticantesController.php';
    $studentCreate = new PracticantesController();
    session_start();

    if(isset($_POST['registrar'])){
        $datos = array(
          'name' => $_POST['name'],
          'paterno' => $_POST['paterno'],
          'materno' => $_POST['materno'],
          'email' => $_POST['email'],
          'phone' => $_POST['phone'],
          'address' => $_POST['address'],
          'img_perfil' => $_POST['img_perfil'],
          'birth' => $_POST['birth'],
          'id_adviser' => $_POST['id_adviser'],
          'id_school' => $_POST['id_school'],
        );
        $studentCreate->store($datos);
    }
    
?>
<div class="container">
  <h1>Crear practicante</h1>
  <form method="POST" action="index.php?page=createstudent" autocomplete="off" >
    
  <?php include_once "form.php" ?>

    <button class="btn btn-primary" name="registrar">Registrar</button>

    <?php if (isset($_SESSION['mensaje'])): ?>
      <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['mensaje']?>
      </div>
    <?php endif; ?>

  </form>
</div>