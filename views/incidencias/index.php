
<div class="container">
    <h1>Incidencia</h1>
    <div class="row" >
        <div class="col-8">
            <a href="<?php echo constant('URL'); ?>incidencias/create" class="btn btn-success pull-rigth ">Crear incidencia</a>
        </div>
        <div class="ml-auto col-4 ">
            <form method="GET" action="<?php echo constant('URL'); ?>incidencias/index" > 
                <label for="search" >
                    <input class="form-control" type="text" name="search" placeholder="Ingrese ID">
                </label>
                <button class="btn btn-primary" type="submit"  >Buscar </button>
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
            <?php if (!empty($this->incidencias)): ?>
                <?php foreach ($this->incidencias as $s): ?>
                    <tr>
                        <td> <?php echo $s['id'] ?> </td>
                        <td><?php echo $s['name'] ?></td>
                        <td><?php echo $s['titulo'] ?></td>
                        <td><?php echo $s['date'] ?></td>
                        <td>
                            <a href="<?php echo constant('URL'); ?>incidencias/show?id=<?php echo $s['id_incidencia'] ?>" class='btn btn-outline-info btn-sm'>Ver</a>
                            <a href="<?php echo constant('URL'); ?>incidencias/edit?id=<?php echo $s['id_incidencia'] ?>" class='btn btn-outline-primary btn-sm'>Editar</a>
                            <button type="button" class=" btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal<?php echo $s['id_incidencia'] ?>">
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
            <?php for($i=1; $i<=$this->section; $i++):  ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo constant('URL'); ?>incidencias/index?search=<?php echo $this->search ?>&p=<?php echo $i ?>">
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

<?php if ($this->incidencias): ?>
<?php foreach ($this->incidencias as $s): ?>
<div class="modal fade" id="modal<?php echo $s['id_incidencia']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"       aria-hidden="true">
<div class="modal fade" id="modal<?php echo $s['id_incidencia']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"       aria-hidden="true">
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
            action="<?php echo constant('URL'); ?>incidencias/destroy&id=<?php echo $s['id_incidencia']?>" >
            <button type="submit" id="delete" class=" btn btn-danger" name="eliminar"> 
            Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>
<?php endif; ?>