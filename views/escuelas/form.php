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
        <input class="form-control" type="text" name="name" 
                value ="<?php if(isset($school['name'])) echo $school['name'];?>"  placeholder="Ingrese nombre de la escuela"> 
        <span class="error"><?php echo$error('name') ?></span>
    </div>
    <div class="col-4">
        <label for="direccion" >Dirección</label>
        <input class="form-control" type="text" name="direccion"
                value ="<?php if(isset($school['direccion'])) echo $school['direccion'];?>"
                placeholder="Ingrese direccion">
        <span class="error"><?php echo$error('direccion') ?></span>
    </div>
    <div class="col-4">
        <label for="email" >Email</label>
        <input class="form-control" type="text" name="email" 
                value ="<?php if(isset($school['email'])) echo $school['email'];?>"  placeholder="Ingrese email">
        <span class="error"><?php echo$error('email') ?></span>
    </div>
</div>
<br>
<div class="row fuente">
    <div class="col-4">
        <label for="phone">Telefono</label>
        <input class="form-control" type="text" name="phone" 
                value ="<?php if(isset($school['phone'])) echo $school['phone'];?>" 
                placeholder="Ingrese numero">
        <span class="error"><?php echo$error('phone') ?></span>
    </div>
    <div class="col-4">
        <label for="encargado" >Encargado</label>
        <input class="form-control" type="text" name="encargado" 
                value ="<?php if(isset($school['encargado'])) echo $school['encargado'];?>"
                placeholder="Ingrese el encargado de la escuela">
        <span class="error"><?php echo$error('encargado') ?></span>
    </div>
</div>
<br>