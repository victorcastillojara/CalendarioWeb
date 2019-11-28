<?php

include_once 'conexion.php';

session_start();

if(isset($_GET['cerrar_sesion'])){
    session_unset();
    session_destroy();
}

if(isset($_SESSION['tipo_usuario'])){
    switch($_SESSION['tipo_usuario']){
        case 'admin':
            header('location: menu-admin.html');
        break;

        case 'docente':
            header('location: menu-usuario.html');
        break;
    }
}

if(isset($_POST['usuario']) && isset($_POST['contra'])){
    $usuario=$_POST['usuario'];
    $pass=$_POST['contra'];

    $query=$conn->connect()->prepare('SELECT * FROM usuario WHERE correo=:usuario AND password=:pass');
    $query->execute(['usuario'=>$usuario, 'password'=>$pass]);

    $row=$query->fetch(PDO::FETCH_NUM);

    if($row==true){

    }else{
        echo"Usuario y/o contraseña incorrecto(s)";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilo-login.css">
    <script src="https://kit.fontawesome.com/01c2cd0a1f.js" crossorigin="anonymous"></script>
    <title>Inicio de sesion</title>
</head>

<body>
    <div class="box-formulario">

        <h1>Inicio de sesion</h1>
        <!--Crear archivo php VerificarUsuario-->
        <form action="#" method="post">

            <div class="texto">
                    <i class="fas fa-user"></i>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario">
            </div>

            <div class="texto">
                <i class="fas fa-lock"></i>
                <input type="password" name="contra" id="contra" placeholder="Contraseña">
            </div>

            <input type="submit" class="btn" value="Iniciar sesion">

        </form>
    </div>

</body>

</html>