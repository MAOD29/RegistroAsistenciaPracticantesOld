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
                value ="<?php if(isset($user['name'])) echo $user['name'];?>" placeholder="Ingrese nombre del asesor"> 
        <span class="error"><?php echo$error('name') ?></span>
    </div>
    <div class="col-4">
        <label for="materno" >Departamento</label>
        <input  class="form-control" type="text" name="department"
                value="<?php if(isset($user['department'])) echo $user['department'];?>" 
                placeholder="Ingrese el departamento ">
        <span class="error"><?php echo$error('department') ?></span>
    </div>
    <div class="col-4">
        <label for="paterno" >Email</label>
        <input class="form-control" type="text" name="email"
                value="<?php if(isset($user['email'])) echo $user['email'];?>"  
                placeholder="Ingrese el email">
        <span class="error"><?php echo$error('email') ?></span>
    </div>
</div>
<br>
<div class="row fuente">
    <div class="col-4">
        <label for="nombre">Telefono</label>
        <input class="form-control" type="text" name="phone"
                value="<?php if(isset($user['phone'])) echo $user['phone'];?>"
                placeholder="Ingrese numero telefonico">
        <span class="error"><?php echo$error('phone') ?></span>
    </div>
    <div class="col-4">
        <label for="materno" >Usuario</label>
        <input class="form-control" type="text" name="user" 
                value="<?php if(isset($user['user'])) echo $user['user'];?>"
                placeholder="Ingrese usuario para ingresar al sistema">
        <span class="error"><?php echo$error('user') ?></span>
    </div>
    <div class="col-4">
        <label for="paterno" >Contraseña</label>
        <input class="form-control" type="password" name="password" 
                value="<?php if(isset($user['password'])) echo $user['password'];?>"
                placeholder="Ingrese contraseña para el sistema">
        <span class="error"><?php echo$error('password') ?></span>
    </div>
</div>
<br>
 
