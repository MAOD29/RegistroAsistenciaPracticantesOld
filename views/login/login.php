<?php
    require_once 'app/controllers/UsuariosController.php';
    $user = new UsuariosController();

    if(isset($_POST['login'])){
        $datos = array(
            'user' => $_POST['user'],
            'password' => $_POST['password'],
        );
        $user->loginAcceso($datos);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css">
    <title>INICIO</title>
</head>
<body>
    <div class="container">
        <a class="btn btn-success" href="index.php?page=createasistencia">IR A RELOJ</a>
    </div>
    <div class="container">
    <form action="index.php?page=login" method="POST" >
        <div class="form-group">
            <label for="exampleInputEmail1"></label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn 
        btn-primary" name="login">Submit</button>
    </form>
    </div>
    <script src="./asset/js/bootstrap.min.js"></script>
</body>
</html>