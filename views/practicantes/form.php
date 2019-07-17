<?php

$error = function ($field) {
    if (isset($_SESSION['errores'])) {
        foreach ($_SESSION['errores'] as $key => $dato) {
            $errores[$key] = $dato;
        }
        if (isset($errores[$field])) return $errores[$field];
    }
};

?>
<br>
<div class="row fuente">

    <?php if (isset($student['img_perfil'])) : ?>
        <div class="col-4">
            <img class="photo-perfil-edit" src="storage/img/<?php echo $student['img_perfil'] ?>" alt="foto de perfil">

        </div>
        <div class="col-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Cambiar imagen de perfil
            </button>
            <span class="error"><?php echo $error('img_perfil') ?></span>
        </div>


    <?php else : ?>

    <div class="col-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Elegir foto de perfil
            </button>
            <span class="error"><?php echo $error('img_perfil') ?></span>
        </div>
    <?php endif; ?>

</div>
<br>
<div class="row fuente">
    <div class="col-4">
        <label for="nombre">Nombre</label>
        <input class="form-control" type="text" name="name" value="<?php if (isset($student['name'])) echo $student['name']; ?>" placeholder="Ingrese nombre">
        <span class="error"><?php echo $error('name') ?></span>
    </div>
    <div class="col-4">
        <label for="paterno">Apellido paterno</label>
        <input class="form-control" type="text" name="paterno" value="<?php if (isset($student['paterno'])) echo $student['paterno']; ?>" placeholder="Ingrese el apellido paterno ">
        <span class="error"><?php echo $error('paterno') ?></span>
    </div>
    <div class="col-4">
        <label for="materno">Apellido materno</label>
        <input class="form-control" type="text" name="materno" value="<?php if (isset($student['materno'])) echo $student['materno']; ?>" placeholder="Ingrese el apellido materno">
        <span class="error"><?php echo $error('materno') ?></span>
    </div>
</div>
<br>
<div class="row fuente">
    <div class="col-4">
        <label for="email">Email</label>
        <input class="form-control" type="text" name="email" value="<?php if (isset($student['email'])) echo $student['email']; ?>" placeholder="Ingrese el email">
        <span class="error"><?php echo $error('email') ?></span>
    </div>
    <div class="col-4">
        <label for="phone">Telefono</label>
        <input class="form-control" type="text" name="phone" value="<?php if (isset($student['phone'])) echo $student['phone']; ?>" placeholder="Ingrese numero telefonico">
        <span class="error"><?php echo $error('phone') ?></span>
    </div>
    <div class="col-4">
        <label for="address">Direccion</label>
        <input class="form-control" type="text" name="address" value="<?php if (isset($student['address'])) echo $student['address']; ?>" placeholder="Ingrese la direccion del practicante">
        <span class="error"><?php echo $error('address') ?></span>
    </div>
</div>
<br>
<div class="row fuente">

    <div class="col-4">
        <label for="birth">Nacimiento</label>
        <input class="form-control" type="date" name="birth" value="<?php if (isset($student['birth'])) echo $student['birth']; ?>" placeholder="Elija su fecha de nacimiento">
        <span class="error"><?php echo $error('birth') ?></span>
    </div>
    <div class="form-group col-md-4">
        <label for="inputState">Asesor</label>
        <select id="inputState" name="id_adviser" class="form-control">
            <option value="">Elegir Asesor...</option>
            <?php foreach ($advisers as $adviser) : ?>
                <option <?php
                        if (isset($student['id_adviser']) && $adviser['id'] == $student['id_adviser'])
                            echo "selected"
                            ?> value=" <?php echo $adviser['id'] ?>"> <?php echo $adviser['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <span class="error"><?php echo $error('id_adviser') ?></span>
    </div>
    <div class="form-group col-md-4">
        <label for="inputState">Escuela</label>
        <select id="inputState" name="id_school" class="form-control">
            <option value="">Elegir Escuela...</option>
            <?php foreach ($schools as $school) : ?>
                <option <?php
                        if (isset($student['id_school']) && $school['id'] == $student['id_school'])
                            echo "selected"
                            ?> value=" <?php echo $school['id'] ?>"> <?php echo $school['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <span class="error"><?php echo $error('id_school') ?></span>
    </div>
</div>
<br>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Foto de perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="file" name="img_perfil" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </div>
    </div>
</div>