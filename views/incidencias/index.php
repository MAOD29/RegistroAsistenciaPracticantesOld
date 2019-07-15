<?php
    require_once 'app/controllers/IncidenciasController.php';
    $incidencia = new IncidenciasController();
    session_start();
    if(isset($_POST['eliminar'])){
        $id =  $_GET['id'];
        $incidencia->destroy($id);
    }
?>
<div class="container">
    <h1>Incidencia</h1>
    <div class="row" >
        <div class="col-8">
            <a href="index.php?page=createincidencia" class="btn btn-success pull-rigth ">Crear incidencia</a>
        </div>
        <div class="ml-auto col-4 ">
            <form method="GET" action="index.php" autocomplete="off"> 
                <label for="search" >
                    <input class="form-control" type="text" name="search" placeholder="Ingrese ID">
                </label>
                <button class="btn btn-primary" type="submit" name="page" value="incidencia">Buscar </button>
            </form>
        </div>
    </div>
    <br><br>
    <table class="table">
        <thead>
            <tr>
         
                <th>ID Practicante</th>
                <th>Nombre</th>
                <th>Incidencia</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr> 
        </thead>
        <tbody>
            <?php if (!empty($incidencias)): ?>
                <?php foreach ($incidencias as $s): ?>
                    <tr>
                        <td> <?php echo $s['id'] ?> </td>
                        <td><?php echo $s['name'] ?></td>
                        <td><?php echo $s['titulo'] ?></td>
                        <td><?php echo $s['date'] ?></td>
                        <td>
                            <a href="index.php?page=editincidencia&id=<?php echo $s['id_incidencia'] ?>" class='btn btn-outline-primary btn-sm'>Editar</a>
                            <form style="display: inline;" method="POST" action="index.php?page=incidencia&id=<?php echo $s['id_incidencia']?>" >
                                <button type="submit" id="delete" class=" btn btn-outline-danger btn-sm" name="eliminar">Eliminar</button>
                             </form>
                            
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
                <a class="page-link" href="index.php?page=incidencia&search=<?php echo $search ?>&p=<?php echo $i ?>">
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"       aria-hidden="true">
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
        <form style="display: inline;" method="POST" 
            action="index.php?page=incidencia&id=<?php echo $s['id_incidencia']?>" >
            <button type="submit" id="delete" class=" btn btn-danger" name="eliminar"> 
                <?php echo $s['id_incidencia']  ?>Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>