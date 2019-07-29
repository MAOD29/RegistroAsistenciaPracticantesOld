

<div class="container">
  <h1>Asesor</h1>
  <div class="row">
    <div class="col-8">
      <a href="<?php echo constant('URL'); ?>usuarios/create" class="btn btn-success pull-rigth ">Crear asesor</a>
    </div>
    <div class="ml-auto col-4 ">
      <form method="GET" action="<?php echo constant('URL'); ?>usuarios/index">
        <label for="search">
          <input class="form-control" type="text" name="search" placeholder="Indicio de busqueda">
        </label>
        <button class="btn btn-primary">Buscar</button>
      </form>
    </div>
  </div>
  <br><br>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Departamento</th>
        <th>Usuario</th>
        <th>email</th>
        <th>Telefono</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($this->users)) : ?>
        <?php foreach ($this->users as $u) : ?>
          <tr>

            <td><?php echo $u['name'] ?></td>
            <td><?php echo $u['department'] ?></td>
            <td> <?php echo $u['user'] ?> </td>
            <td><?php echo $u['email'] ?></td>
            <td><?php echo $u['phone'] ?></td>
            <td>
              <a href="<?php echo constant('URL'); ?>usuarios/edit?&id=<?php echo $u['id'] ?>" class='btn btn-outline-primary btn-sm'>Editar</a>

              <button type="button" class=" btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal<?php echo $u['id'] ?>">
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
      <?php for ($i = 1; $i <= $this->section; $i++) :  ?>
        <li class="page-item">
          <a class="page-link" href="<?php echo constant('URL'); ?>usuarios&search=<?php echo $this->search ?>&p=<?php echo $i ?>">
            <?php echo $i ?>
          </a>
        </li>
      <?php endfor;  ?>
    </ul>
  </nav>
  <!-- Session message -->
  <?php if (isset($_SESSION['mensaje'])) : ?>
    <div class="alert alert-success" role="alert">
      <?php echo $_SESSION['mensaje'] ?>
    </div>
  <?php endif; ?>
</div>
<!-- Modal -->
<?php foreach ($this->users as $u) : ?>
  <div class="modal fade" id="modal<?php echo $u['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

          <form style="display: inline;" method="POST" action="<?php echo constant('URL'); ?>usuarios/destroy?&id=<?php echo $u['id'] ?>">
            <button type="submit" id="delete" class=" btn btn-danger" name="eliminar">Eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>