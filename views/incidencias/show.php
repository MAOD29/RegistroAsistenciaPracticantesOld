<h1>Datos de incidencia</h1>
<br>
<div class="row fuente">
    <div class="col-4">
        <label for="codigo">Código</label>
        <input type="text" readonly class="form-control" value="<?php  echo $this->incidencia['id'];?>">
       
    </div>
    <div class="col-4">
        <label for="nombre">Nombre</label>
        <input type="text" readonly class="form-control" 
        value="<?php echo $this->incidencia['name'];?>">
        
    </div>

    <div class="col-4">
        <label for="paterno">Apellido paterno</label>
        <input type="text" readonly class="form-control" 
        value="<?php echo $this->incidencia['paterno'];?>">
        
    </div>
           
</div>
<br>
<div class="row fuente">
    
    <div class="col-4">
        <label for="materno">Apellido materno</label>
        <input type="text" readonly class="form-control" 
        value="<?php echo $this->incidencia['materno'];?>">
        
    </div>    
    <div class="col-4">
        <label for="titulo">Titulo</label>
        <input type="text" readonly class="form-control" value="<?php echo $this->incidencia['titulo'];?>">
        
    </div>
    <div class="col-4">
        <label for="date" >Fecha</label>
        <input type="date"class="form-control" readonly value="<?php echo $this->incidencia['date'];?>">
       
    </div>   
    
    </div>
</div>
<br>
<div class="row fuente">

<div class="col-6">
    <label for="descripcion">Descripcion</label>
    <textarea class="form-control" rows="8" readonly cols="40"><?php  echo $this->incidencia['descripcion'];?></textarea>
    
       
</div>