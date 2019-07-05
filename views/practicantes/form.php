<?php

    $error = function($field){
        if (isset($_SESSION['errores'])){
            foreach ($_SESSION['errores'] as $key =>$dato) {
                $errores[$key]= $dato;
            }
            if(isset($errores[$field])) return $errores[$field];
        }
    };

?>
<div class="row fuente">
    <div class="col-4">
        <label for="nombre">Nombre</label>
        <input  class="form-control" type="text" name="name" 
                value ="<?php if(isset($student['name'])) echo $student['name'];?>" placeholder="Ingrese nombre"> 
        <span class="error"><?php echo$error('name') ?></span>
    </div>
    <div class="col-4">
        <label for="paterno" >Apellido paterno</label>
        <input  class="form-control" type="text" name="paterno"
                value="<?php if(isset($student['paterno'])) echo $student['paterno'];?>" 
                placeholder="Ingrese el apellido paterno ">
        <span class="error"><?php echo$error('paterno') ?></span>
    </div>
    <div class="col-4">
        <label for="materno" >Apellido materno</label>
        <input class="form-control" type="text" name="materno" 
                value="<?php if(isset($student['materno'])) echo $student['materno'];?>"
                placeholder="Ingrese el apellido materno">
        <span class="error"><?php echo$error('materno') ?></span>
    </div>
</div>
<br>
<div class="row fuente">
    <div class="col-4">
        <label for="email" >Email</label>
        <input class="form-control" type="text" name="email"
                value="<?php if(isset($student['email'])) echo $student['email'];?>"  
                placeholder="Ingrese el email">
        <span class="error"><?php echo$error('email') ?></span>
    </div>
    <div class="col-4">
        <label for="phone">Telefono</label>
        <input class="form-control" type="text" name="phone"
                value="<?php if(isset($student['phone'])) echo $student['phone'];?>"
                placeholder="Ingrese numero telefonico">
        <span class="error"><?php echo$error('phone') ?></span>
    </div>
    <div class="col-4">
        <label for="address" >Direccion</label>
        <input class="form-control" type="text" name="address" 
                value="<?php if(isset($student['address'])) echo $student['address'];?>"
                placeholder="Ingrese la direccion del practicante">
        <span class="error"><?php echo$error('address') ?></span>
    </div>
</div>
<br>
<div class="row fuente">
    <div class="col-4">
        <label for="img_perfil" >Imagen de perfil</label>
        <input class="form-control" type="text" name="img_perfil"
                value="<?php if(isset($student['img_perfil'])) echo $student['img_perfil'];?>"  
                placeholder="Elija una imagen de perfil">
        <span class="error"><?php echo$error('img_perfil') ?></span>
    </div>
    <div class="col-4">
        <label for="birth">Nacimiento</label>
        <input class="form-control" type="date" name="birth"
                value="<?php if(isset($student['birth'])) echo $student['birth'];?>"
                placeholder="Elija su fecha de nacimiento">
        <span class="error"><?php echo$error('birth') ?></span>
    </div>
    <div class="col-4">
        <label for="id_adviser" >Asesor</label>
        <input class="form-control" type="text" name="id_adviser" 
                value="<?php if(isset($student['id_adviser'])) echo $student['id_adviser'];?>"
                placeholder="Elija el asesor del practicante">
        <span class="error"><?php echo$error('id_adviser') ?></span>
    </div>
</div>
<br>
<div class="row fuente">
    <div class="col-4">
        <label for="id_school" >Escuela</label>
        <input class="form-control" type="text" name="id_school"
                value="<?php if(isset($student['id_school'])) echo $student['id_school'];?>"  
                placeholder="Elija la escuela de pertenecia">
        <span class="error"><?php echo$error('id_school') ?></span>
    </div>
    
</div>
<br>