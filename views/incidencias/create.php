<div class="container">
    <h1>Crear Incidecnia</h1>

    <div class="row">
        <div class="ml-auto col-4 ">
            <form method="GET" action="<?php echo constant('URL'); ?>incidencias/search" autocomplete="off">
                <label for="search">
                    <input class="form-control" type="text" name="search" placeholder="clave del colaborador">
                </label>
                <button class="btn btn-primary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
    <br>

    <?php if (isset($this->incidencia)) : ?>

        <form method="POST" action="<?php echo constant('URL'); ?>incidencias/store" >

            <?php include_once "form.php" ?>
            <button class="btn btn-primary" name="registrar">Registrar</button>


        </form>
    <?php endif; ?>

    <?php if (isset($_SESSION['mensaje'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['mensaje'] ?>
        </div>
    <?php endif; ?>
</div>