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
<div class="container">
    <h1>Editar asistencia</h1>
    <form method="POST" action="<?php echo constant('URL'); ?>asistencias/update&id=<?php echo $this->asistencia['id'];?>" autocomplete="off" >
        
        <div class="row fuente">
             <div class="col-4">
                <label for="nombre" >Nombre</label>
                <input  class="form-control" type="text" readonly  
                         value ="<?php echo $this->asistencia['name'];?>" >
            </div>
            <div class="col-4">
                <label for="nombre" >Fecha</label>
                <input class="form-control" type="date"  readonly
                         value ="<?php echo date('Y-m-d',strtotime($this->asistencia['fecha']));?>" >
            </div>
        </div>
            <br>
        <div class="row fuente">
            <div class="col-4">
                <label for="hora_entrada">Hora de entrada</label>
                <input class="form-control" type="time" name="hora_entrada" 
                        value ="<?php echo $this->asistencia['hora_entrada'];?>"  > 
                <span class="error"><?php echo$error('hora_entrada') ?></span>
            </div>
            <div class="col-4">
                <label for="hora_salida" >Hora de salida</label>
                <input class="form-control" type="time" name="hora_salida"
                        value ="<?php echo $this->asistencia['hora_salida'];?>"
                        placeholder="Ingrese direccion">
                <span class="error"><?php echo$error('hora_salida') ?></span>
            </div>
        </div>
        <br>

        <button type="submit" class="btn btn-primary" name="editar">Actualización</button>
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class='alert alert-primary' role='alert'><? $_SESSION['mensaje'] ?></div>
        <?php endif;  ?>
</div>
