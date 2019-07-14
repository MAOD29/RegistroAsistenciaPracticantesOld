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
        <label for="codigo">Código</label>
        <input type="text" readonly class="form-control-plaintext" name="id_practicante" value="<?php if(isset($incidencia['id'])) echo $incidencia['id'];?>">
        <span class="error"><?php echo$error('id') ?></span>
    </div>
    <div class="col-4">
        <label for="nombre">Nombre</label>
        <input type="text" readonly class="form-control-plaintext" 
        value="<?php if(isset($incidencia['name'])) echo $incidencia['name'];?>">
        <span class="error"><?php echo$error('name') ?></span>
    </div>

    <div class="col-4">
        <label for="paterno" >Apellidos</label>
        <input type="text" readonly class="form-control-plaintext" 
        value="<?php if(isset($incidencia['paterno'])) echo $incidencia['paterno'];?>">
        <span class="error"><?php echo$error('paterno') ?></span>
    </div>        
</div>
<br>
<div class="row fuente">
    <div class="col-4">
        <label for="titulo">Titulo</label>
        <input type="text"  class="form-control" name="titulo"
         value="<?php if(isset($incidencia['titulo'])) echo $incidencia['titulo'];?>">
        <span class="error"><?php echo$error('titulo') ?></span>
    </div>
    <div class="col-4">
        <label for="descripcion">Descripcion</label>
        <input type="text"  class="form-control" name="descripcion"
        value="<?php if(isset($incidencia['descripcion'])) echo $incidencia['descripcion'];?>">
        <span class="error"><?php echo$error('descripcion') ?></span>
    </div>

    <div class="col-4">
        <label for="date" >Fecha</label>
        <input type="date"  class="form-control" name="date"
        value="<?php if(isset($incidencia['date'])) echo $incidencia['date'];?>">
        <span class="error"><?php echo$error('date') ?></span>
    </div>        
</div>
<br>