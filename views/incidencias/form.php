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
        <input type="text" readonly class="form-control" name="id_practicante" value="<?php if(isset($this->incidencia['id'])) echo $this->incidencia['id'];?>">
        <span class="error"><?php echo$error('id') ?></span>
    </div>
    <div class="col-4">
        <label for="nombre">Nombre</label>
        <input type="text" readonly class="form-control" 
        value="<?php if(isset($this->incidencia['name'])) echo $this->incidencia['name'];?>">
        <span class="error"><?php echo$error('name') ?></span>
    </div>

    <div class="col-4">
        <label for="paterno" >Apellidos</label>
        <input type="text" readonly class="form-control" 
        value="<?php if(isset($this->incidencia['paterno'])) echo $this->incidencia['paterno'];?>">
        <span class="error"><?php echo$error('paterno') ?></span>
    </div>        
</div>
<br>
<div class="row fuente">
    <div class="col-4">
        <label for="titulo">Titulo</label>
        <input type="text"  class="form-control" name="titulo"
         value="<?php if(isset($this->incidencia['titulo'])) echo $this->incidencia['titulo'];?>">
        <span class="error"><?php echo$error('titulo') ?></span>
    </div>
    <div class="col-4">
        <label for="descripcion">Descripcion</label>
        <input type="text"  class="form-control" name="descripcion"
        value="<?php if(isset($this->incidencia['descripcion'])) echo $this->incidencia['descripcion'];?>">
        <span class="error"><?php echo$error('descripcion') ?></span>
    </div>

    <div class="col-4">
        <label for="date" >Fecha</label>
        <input type="date"  class="form-control" name="date"
        value="<?php if(isset($this->incidencia['date'])) echo $this->incidencia['date'];?>">
        <span class="error"><?php echo$error('date') ?></span>
    </div>        
</div>
<br>