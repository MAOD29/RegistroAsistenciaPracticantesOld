<?php
  require_once 'app/controllers/UsuariosController.php';
  $user = new UsuariosController();
  session_start();
  if(isset($_POST['eliminar'])){
		$id =  $_GET['id'];
		$user->destroy($id);
  }

?>

<div class="container">
<h1>Asesor</h1>
<div class="row" >
		  <div class="col-8">
              <a href="index.php?page=createusuario" class="btn btn-success pull-rigth ">Crear asesor</a>
             	
		  </div>

		  <div class="ml-auto col-4 ">
		  	<form method="POST" action="index.php?page=usuario" autocomplete="off"> 
		      <label for="search" >
				<input class="form-control" type="text" name="search" placeholder="Indicio de busqueda">
			  </label>
        <input class="btn btn-primary" type="submit" value="Buscar">
        </form>
    </div>
</div>
	<br><br>
    <table class="table">
		<thead>
			<tr>			
				<th>Usuario</th>
				 <th>Nombre</th>
				 <th>Departamento</th>
				 <th>email</th>
				 <th>Telefono</th>
				 <th>Acciones</th>
			</tr> 
		</thead>
		<tbody>
        <?php if (!empty($users)): ?>
			<?php foreach ($users as $u): ?>
                <tr>
                  <td> <?php echo $u['user'] ?> </td>
                  <td><?php echo $u['name'] ?></td>
                  <td><?php echo $u['department'] ?></td>
                  <td><?php echo $u['email'] ?></td>
                  <td><?php echo $u['phone'] ?></td>
                
				  <td>
					   <a href="index.php?page=editusuario&id=<?php echo $u['id'] ?>" class='btn btn-outline-primary btn-sm'>Editar</a>

					<form style="display: inline;" method="POST" action="index.php?page=usuario&id=<?php echo $u['id'] ?>" >
							<button type="submit" class="btn btn-outline-danger btn-sm"  name="eliminar">Eliminar</button>
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
			<a class="page-link" href="index.php?page=usuario&search=<?php echo $search ?>&p=<?php echo $i ?>">
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
