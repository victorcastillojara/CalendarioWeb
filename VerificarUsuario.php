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
            header('location: menu-admin.php');
        break;
        case 'docente':
            header('location: menu-usuario.php');
        break;
    }
}

//if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == true)
//{

if($nr==1){
    header("Location:menu-admin.php");
}else if($nr==0){
    echo"No ingreso";
}

?>