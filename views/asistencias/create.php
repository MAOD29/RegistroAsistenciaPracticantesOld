<?php
require_once 'app/controllers/AsistenciasController.php';
$asistencia = new AsistenciasController();
session_start();
if (isset($_POST['id_practicante'])) {
    $fecha = new  DateTime('now');
    $datos = [
        'fecha' => $fecha->format('Y-m-d'),
        'hora_entrada' => $fecha->format('H:i'),
        'id_practicante' => $_POST['id_practicante']
    ];
    $asistencia->store($datos);
}


if (isset($_SESSION['student'])) {
    $student = $_SESSION['student'];
    $nombre = $_SESSION['student']['name'] . " " . $_SESSION['student']['paterno'] . " " . $_SESSION['student']['materno'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if (isset($_SESSION['student']) || isset($_SESSION['exist'])) : ?>
        <meta charset="UTF-8" http-equiv="refresh" content="5;index.php?page=createasistencia">
    <?php endif; ?>
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="./asset/css/style.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>

    <title>INICIO</title>
</head>

<body>
    <li class="active list-unstyled components">
        <a href="/"><i class="fas fa-home fa-5x"></i></a>
    </li>
    <main class="container">
        <?php if (isset($student)) : ?>
            <div class="card mb-2 container info ">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="storage/img/<?php echo $student['img_perfil'] ?>" class="card-img imagen">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="reloj-label card-text alert alert-success"><?php echo $nombre ?> </p>
                            <p class="reloj-label card-text alert alert-success"><?php echo $student['department'] ?>
                                <?php if (isset($_SESSION['mensaje'])) : ?>
                                    <p class="reloj-label card-text alert alert-success">
                                        <?php echo $_SESSION['mensaje'] ?>
                                    </p>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="mx-auto" style="width: 400px;">
                <div class="form-group">
                    <span class="fecha" id="date"></span>
                    <span id="liveclock"></span>
                </div>
                <div class="form-group ">
                    <form method="POST" action="index.php?page=createasistencia">
                        <input class="form-control" type="text" name="id_practicante">
                        <br>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['exist'])) : ?>
            <p class="reloj-label card-text alert alert-success">
                <?php echo $_SESSION['exist']; ?>
            </p>
        <?php endif; ?>
    <script language="JavaScript" type="text/javascript">
        n = new Date();
        //Año
        y = n.getFullYear();
        //Mes
        m = n.getMonth() + 1;
        //Día
        d = n.getDate();
        //Lo ordenas a gusto.
        document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
    </script>
    <script language="JavaScript" type="text/javascript">
        function show5() {
            if (!document.layers && !document.all && !document.getElementById)
                return
            var Digital = new Date()
            var hours = Digital.getHours()
            var minutes = Digital.getMinutes()
            var seconds = Digital.getSeconds()
            var dn = "PM"
            if (hours < 12)
                dn = "AM"
            if (hours > 12)
                hours = hours - 12
            if (hours == 0)
                hours = 12
            if (minutes <= 9)
                minutes = "0" + minutes
            if (seconds <= 9)
                seconds = "0" + seconds
            //change font size here to your desire
            myclock = "<font size='5' face='Arial' ><b><font size='1'>:</font>" + hours + ":" + minutes + ":" +
                seconds + " " + dn + "</b></font>"
            if (document.layers) {
                document.layers.liveclock.document.write(myclock)
                document.layers.liveclock.document.close()
            } else if (document.all)
                liveclock.innerHTML = myclock
            else if (document.getElementById)
                document.getElementById("liveclock").innerHTML = myclock
            setTimeout("show5()", 1000)
        }
        window.onload = show5
        //-->
    </script>