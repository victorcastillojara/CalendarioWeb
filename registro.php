<?php

include_once 'database.php';


if(isset($_POST['correo']) && isset($_POST['password'])){
    $rut=$_POST['rut'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $telefono=$_POST['telefono'];
    $direccion=$_POST['direccion'];
    $correo=$_POST['correo'];
    $password=$_POST['password'];
    $id_usuario=$_POST['id_usuario'];
    echo 'Exito';
}else{
    echo 'Error';
}



?>