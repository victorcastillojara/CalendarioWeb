<?php
include "conexion.php";
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

//if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == true)
//{

$usuario=$_POST["usuario"];
$pass=$_POST["contra"];

//$_SESSION['usuario']=$usuario;
if(isset($_POST['usuario']) && isset($_POST['contra'])){
    $query=mysqli_query($conn,"select * from usuario where correo='".$usuario."' and password='".$pass."'");
    $nr=mysqli_num_rows($query);

    $row=$query->fetch(PDO::FETCH_NUM);

    if($nr==1){
        $tipo_usuario=$row[3];
        $_SESSION['tipo_usuario']=$tipo_usuario;
        echo "asd",$tipo_usuario;
        switch($_SESSION['tipo_usuario']){
            case 'admin':
                header('location: menu-admin.html');
            break;
            case 'docente':
                header('location: menu-usuario.html');
            break;
        }
    }else if($nr==0){
        echo"No ingreso";
    }
}

//}else
//{
//echo "<br/>" . "ect ect solo usuarios registrados." . "<br/>";
//echo "<br/>" . "<a href='login.html'>login!</a>";

//exit;
//}



?>