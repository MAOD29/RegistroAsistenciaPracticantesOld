
<div class="container">
  <h1>Asistencias</h1>
  <form method="GET" action="<?php echo constant('URL'); ?>asistencias/index" autocomplete="off"> 
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
          <button class="btn btn-primary">Buscar</button>
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
      <?php if (!empty($this->asistencias)): ?>
     
        <?php foreach ($this->asistencias as $asistencia): ?>
       
          <tr>
            <td><?php echo $asistencia['id'] ?></td>
            <td><?php echo $asistencia['name'] ?></td>
            <td><?php echo $asistencia['fecha'] ?></td>
            <td><?php echo $asistencia['hora_entrada'] ?></td>
            <td><?php echo $asistencia['hora_salida'] ?></td>
            <td><?php echo $asistencia['horast'] ?></td>
            <td>
              <a 
                href="<?php echo constant('URL'); ?>asistencias/edit&id=<?php echo $asistencia['id_asistencia']?>" class='btn btn-outline-primary btn-sm'>Editar
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
        <?php for($i=1; $i<=$this->section; $i++):  ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo constant('URL'); ?>asistencias/index&search=<?php echo $this->search ?>&p=<?php echo $i ?>">
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
