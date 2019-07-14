<?php
    require_once 'app/controllers/IncidenciasController.php';
    $schoolCreate = new IncidenciasController();
    session_start();

    if(isset($_POST['registrar'])){ 
        $datos = array(
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'],
            'date' => $_POST['date'],
            'id_practicante' => $_POST['id_practicante'],
        );
        $schoolCreate->store($datos);
    }   
   

?>
<div class="container">
    <h1>Crear Incidecnia</h1>
    
    <div class="row" >
            <div class="ml-auto col-4 ">
            <form method="GET" action="index.php" autocomplete="off"> 
                <label for="search" >
                <input class="form-control" type="text" name="search" placeholder="clave del colaborador">
                </label>
                <button class="btn btn-primary" name="page" type="submit" value="searchincidencia">Buscar</button>
            </form>
            </div>
    </div>
    <br>

    <?php if (isset($incidencia)): ?>

        <form method="POST" action="index.php?page=createincidencia" autocomplete="off" >

            <?php include_once "form.php" ?>
            <button class="btn btn-primary" name="registrar">Registrar</button>

            <?php if (isset($_SESSION['mensaje'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['mensaje']?>
                </div>
            <?php endif; ?>
        </form>
    <?php endif; ?>
</div>