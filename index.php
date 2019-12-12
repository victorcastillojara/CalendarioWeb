<?php

include_once 'database.php';

session_start();

if(isset($_GET['cerrar_sesion'])){
    session_unset();
    session_destroy();
}

if(isset($_SESSION['rol'])){
    switch($_SESSION['rol']){
        case '1':
            header('location: menu-admin.php');
        break;

        case '2':
            header('location: menu-usuario.php');
        break;
    }
}

if(isset($_POST['correo']) && isset($_POST['password'])){
    $correo=$_POST['correo'];
    $password=$_POST['password'];

    $db=new Database();
    $query=$db->connect()->prepare('SELECT * FROM usuario WHERE correo=:correo AND password=:password');
    $query->execute(['correo'=>$correo, 'password'=>$password]);

    $row=$query->fetch(PDO::FETCH_NUM);

    if($row==true){
        $rol=$row[3];
        $_SESSION['rol']=$rol;
        $usu=$row[0];
        $_SESSION['usu']=$usu;
        switch($_SESSION['rol']){
            case '1':
                header('location: menu-admin.php');
            break;
    
            case '2':
                header('location: menu-usuario.php');
            break;
        }
    }else{
        echo '<script type="text/javascript">alert(\'Usuario y/o contraseña incorrecto(s)\');</script>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/estilo-img.css">
    <link rel="stylesheet" href="css/estilo-login.css">
    
    <script src="https://kit.fontawesome.com/01c2cd0a1f.js" crossorigin="anonymous"></script>

    <title>Inicio de sesion</title>
</head>


<body>
    <!--Si se ocupa imagen completa borrar header-->

    <div class="box-formulario">
        <img class="box" src="img/logo-delfin.png">  
        <h2>INICIO DE SESIÓN</h2>
        <!--Crear archivo php VerificarUsuario-->
        <form action="#" method="post">

            <div class="texto">
                    <i class="fas fa-user"></i>
                <input type="text" name="correo" id="correo" placeholder="Usuario">
            </div>

            <div class="texto">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Contraseña">
            </div>

            <input type="submit" class="btn" value="Iniciar sesion">

        </form>
    </div>

</body>

</html>