<?php
  require_once 'app/controllers/UsuariosController.php';
  $s = new PracticantesController();
  session_start();
  if(isset($_POST['eliminar'])){
    $id =  $_GET['id'];
    $s->destroy($id);
  }

?>

<div class="container">
  <h1>Practicante</h1>
  <div class="row" >
    <div class="col-8">
      <a href="index.php?page=createstudent" class="btn btn-success pull-rigth ">Crear practicantes</a>
    </div>

    <div class="ml-auto col-4 ">
    <form method="GET" action="index.php" autocomplete="off"> 
        <label for="search" >
        <input class="form-control" type="text" name="search" placeholder="Indicio de busqueda">
        </label>
        <input class="btn btn-primary" type="submit" name="page" value="practicante">
      </form>
    </div>
  </div>
<br><br>
  <table class="table">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>email</th>
        <th>Teléfono</th>
        <th>Escuela</th>
        <th>Acciones</th>
      </tr> 
    </thead>
    <tbody>
      <?php if (!empty($students)): ?>
        <?php foreach ($students as $student): ?>
          <tr>
            <td> <?php echo $student['name'] ?> </td>
            <td><?php echo $student['paterno'] ?></td>
            <td><?php echo $student['phone'] ?></td>
            <td><?php echo $student['email'] ?></td>
            <td><?php echo $student['id_school'] ?></td>
            <td>
              <a 
                href="index.php?page=editstudent&id=<?php echo $student['id'] ?>" class='btn btn-outline-primary btn-sm'>Editar
              </a>
              <button type="button" class=" btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal<?php echo $student['id'] ?>">
                Eliminar
              </button>
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
<!-- Modal -->
<?php foreach ($students as $student): ?>
<div class="modal fade" id="modal<?php echo $student['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form style="display: inline;" method="POST" action="index.php?page=practicante&id=<?php echo $student['id'] ?>" >
        <button type="submit" id="delete" class=" btn btn-danger"  name="eliminar">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>