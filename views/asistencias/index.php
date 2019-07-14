<?php
  require_once 'app/controllers/AsistenciasController.php';
  $a = new AsistenciasController();
  session_start();
  if(isset($_POST['eliminar'])){
    $id =  $_GET['id'];
    $a->destroy($id);
  }

?>

<div class="container">
  <h1>Asistencias</h1>
  <form method="GET" action="index.php" autocomplete="off"> 
    <div class="row" >
      <div class="col-2">
        <label for="dateInicio"><input class="form-control" type="date" name="dateInicio" > </label>
      </div>
      <div class="col-4">
        <label for="dateEnd"><input class="form-control" type="date" name="dateEnd" > </label>
      </div>
      <div class="ml-auto col-4 ">
          <label for="search" >
          <input class="form-control" type="text" name="search" placeholder="Ingrese el id">
          </label>
          <input class="btn btn-primary" type="submit" name="page" value="asistencia">
      </div> 
    </div>
  </form>
<br><br>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Hora entrada</th>
        <th>Hora salida</th>
        <th>Horas al dia</th>
        <th>Acciones</th>
      </tr> 
    </thead>
    <tbody>
      <?php if (!empty($asistencias)): ?>
     
        <?php foreach ($asistencias as $asistencia): ?>
       
          <tr>
            <td><?php echo $asistencia['id'] ?></td>
            <td><?php echo $asistencia['name'] ?></td>
            <td><?php echo $asistencia['fecha'] ?></td>
            <td><?php echo $asistencia['hora_entrada'] ?></td>
            <td><?php echo $asistencia['hora_salida'] ?></td>
            <td><?php echo $asistencia['horast'] ?></td>
            <td>
              <a 
                href="index.php?page=editasistencia&id=<?php echo $asistencia['id']?>&fecha=<?php echo $asistencia['fecha'] ?>" class='btn btn-outline-primary btn-sm'>Editar
              </a>
            
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
   </tbody>
  </table>
  <!--Pagination -->
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php for($i=1; $i<=$section; $i++):  ?>
        <li class="page-item">
            <a class="page-link" href="index.php?page=practicante&search=<?php echo $search ?>&p=<?php echo $i ?>">
                <?php echo $i ?>
            </a>
        </li>
        <?php endfor;  ?>
    </ul>
  </nav>

  <!-- Session message -->
  <?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success" role="alert">
    <?php echo $_SESSION['mensaje']?>
    </div>
  <?php endif; ?>
</div>
