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
        <input  class="form-control" type="text" required name="name" 
                value ="<?php if(isset($this->user['name'])) echo $this->user['name'];?>" placeholder="Ingrese nombre del asesor"> 
        <span class="error"><?php echo$error('name') ?></span>
    </div>
    <div class="col-4">
        <label for="departamento" >Departamento</label>
        <input  class="form-control" type="text" name="department"
                value="<?php if(isset($this->user['department'])) echo $this->user['department'];?>" 
                placeholder="Ingrese el departamento ">
        <span class="error"><?php echo$error('department') ?></span>
    </div>
    <div class="col-4">
        <label for="email" >Email</label>
        <input class="form-control" type="text" name="email"
                value="<?php if(isset($this->user['email'])) echo $this->user['email'];?>"  
                placeholder="Ingrese el email">
        <span class="error"><?php echo$error('email') ?></span>
    </div>
</div>
<br>
<div class="row fuente">
    <div class="col-4">
        <label for="telefono">Telefono</label>
        <input class="form-control" type="text" name="phone"
                value="<?php if(isset($this->user['phone'])) echo $this->user['phone'];?>"
                placeholder="Ingrese numero telefonico">
        <span class="error"><?php echo$error('phone') ?></span>
    </div>
    <div class="col-4">
        <label for="usuario" >Usuario</label>
        <input class="form-control" type="text" name="user" 
                value="<?php if(isset($this->user['user'])) echo $this->user['user'];?>"
                placeholder="Ingrese usuario para ingresar al sistema">
        <span class="error"><?php echo$error('user') ?></span>
    </div>
    <div class="col-4">
        <label for="password" >Contraseña</label>
        <input class="form-control" type="password" name="password" 
                value="<?php if(isset($this->user['password'])) echo $this->user['password'];?>"
                placeholder="Ingrese contraseña para el sistema">
        <span class="error"><?php echo$error('password') ?></span>
    </div>
</div>
<br>
 
