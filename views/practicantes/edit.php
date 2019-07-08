<?php
   require_once 'app/controllers/PracticantesController.php';
   $studentUpdate = new PracticantesController();
   require_once 'app/utilidades/Utilidades.php';
   $file = new Utilidades();
   session_start();
  $tmpimg = $student['img_perfil'];

    if(isset($_POST['editar'])){
        $img = $file->uploadFile('storage/img','img_perfil');
        if(empty($img)) $img = $tmpimg;
        $datos = array(
           'id' => $_GET['id'],
            'name' => $_POST['name'],
            'paterno' => $_POST['paterno'],
            'materno' => $_POST['materno'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'img_perfil' => $img,
            'birth' => $_POST['birth'],
            'id_adviser' => $_POST['id_adviser'],
            'id_school' => $_POST['id_school'],
          );
        
        $studentUpdate->update($datos);
    }
    
?>
<div class="container">
  <h1>Editar Practicante</h1>
  <form method="POST" action="index.php?page=editstudent&id=<?php echo $student['id'];?>" autocomplete="off" enctype="multipart/form-data" >

    <?php include_once "form.php" ?>
    
    <button type="submit" class="btn btn-primary  btn-block" name="editar">Actualizar</button>

    <?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success" role="alert">
      <?php echo $_SESSION['mensaje']?>
    </div>
  <?php endif; ?>
</form>
</div>
