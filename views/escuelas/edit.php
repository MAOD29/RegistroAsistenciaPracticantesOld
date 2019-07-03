<?php
    require_once 'app/controllers/EscuelasController.php';
    $schoolUpdate = new EscuelasController();
    session_start();

    if(isset($_POST['editar'])){
        $datos = array(
            'id' => $_GET['id'],
            'name' => $_POST['name'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'encargado' => $_POST['encargado'],
        );
        $schoolUpdate->update($datos);
    }

    $error = function($field){
        if (isset($_SESSION['errores'])){
            foreach ($_SESSION['errores'] as $key =>$dato) {
                $errores[$key]= $dato;
            }
            if(isset($errores[$field])) return $errores[$field];
        }
    };
?>
<div class="container">
    <h1>Editar usuario</h1>
    <form method="POST" action="index.php?page=editescuela&id=<?php echo $school['id'];?>" autocomplete="off" >
        <div class="row fuente">
            <div class="col-4">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="name" value ="<?php echo $school['name'];?> " placeholder="Ingrese nombre de la escuela"> 
                <span class="error"><?php echo$error('name') ?></span>
            </div>
            <div class="col-4">
                <label for="direccion" >Dirección</label>
                <input class="form-control" type="text" name="direccion"  value="<?php echo $school['direccion'];?>" placeholder="Ingrese direccion">
                <span class="error"><?php echo$error('direccion') ?></span>
            </div>
            <div class="col-4">
                <label for="email" >Email</label>
                <input class="form-control" type="text" name="email" value="<?php echo $school['email'];?>"  placeholder="Ingrese email">
                <span class="error"><?php echo$error('email') ?></span>
            </div>
        </div>
        <br>
        <div class="row fuente">
            <div class="col-4">
                <label for="phone">Telefono</label>
                <input class="form-control" type="text" name="phone" value="<?php echo $school['phone'];?>" placeholder="Ingrese numero">
                <span class="error"><?php echo$error('phone') ?></span>
            </div>
            <div class="col-4">
                <label for="encargado" >Encargado</label>
                <input class="form-control" type="text" name="encargado" value="<?php echo $school['encargado'] ?>"  placeholder="Ingrese el encargado de la escuela">
                <span class="error"><?php echo$error('encargado') ?></span>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="editar">Actualización</button>
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class='alert alert-primary' role='alert'><? $_SESSION['mensaje'] ?></div>
        <?php endif;  ?>
    </form>
</div>
