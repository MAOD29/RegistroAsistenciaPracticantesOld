<h1>Datos del practicante <?php echo $student['id'] ?></h1>
<br>
<div class="row fuente">

    <?php if (isset($student['img_perfil'])) : ?>
        <div class="col-4">
            <img class="photo-perfil-edit" src="storage/img/<?php echo $student['img_perfil'] ?>" alt="foto de perfil">
        </div>
    <?php endif; ?>

</div>
<br>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <td><?php echo $student['name']; ?></td>
            <th>Apellido paterno</th>
            <td><?php echo $student['paterno']; ?></td>
            <th>Apellido materno</th>
            <td><?php echo $student['materno']; ?></td>
        </tr>
    </thead>
    <br>
    <tbody>
        <tr>
            <th>Email</th>
            <td><?php echo $student['email']; ?></td>
            <th>Telefono</th>
            <td><?php echo $student['phone']; ?></td>
            <th>Dirección</th>
            <td><?php echo $student['address']; ?></td>
        </tr>
        <tr>
            <th>Nacimineto</th>
            <td><?php echo $student['birth']; ?></td>
            <th>Asesor</th>
            <td>

                <select disabled class="form-control">
                    <?php foreach ($advisers as $adviser) : ?>
                        <option <?php
                            if (isset($student['id_adviser']) && $adviser['id'] == $student['id_adviser'])
                                echo "selected"
                                ?> value=" <?php echo $adviser['id'] ?>"> <?php echo $adviser['name'] 
                        ?></option>
                    <?php endforeach; ?>
                </select>

            </td>
            <th>Escuela</th>
            <td>
                <select disabled class="form-control">
                    <?php foreach ($schools as $school) : ?>
                        <option <?php
                                if (isset($student['id_school']) && $school['id'] == $student['id_school'])
                                    echo "selected"
                                    ?> value=" <?php echo $school['id'] ?>"> <?php echo $school['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Horas Totales</th>
            <td><?php echo $student['horas_totales']; ?></td>
            <th>Horas Actuales</th>
            <td>Luego lo arreglo</td>
            <th>Incidencias</th>
            <td>1</td>
        </tr>

    </tbody>
</table>