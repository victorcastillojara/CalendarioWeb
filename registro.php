<?php

include_once 'database.php';

$rut=$_POST['rut'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$telefono=$_POST['telefono'];
$direccion=$_POST['direccion'];
$correo=$_POST['correo'];
$password=$_POST['password'];
$id_usuario=$_POST['id_usuario'];

if(isset($rut) && isset($nombre) && isset($apellido) && isset($telefono) && isset($direccion) && isset($correo) && isset($password) && isset($id_usuario)){
    
    $db=new Database();
    $query1=$db->connect()->prepare("INSERT INTO docente (rut,nombre,apellido,telefono,direccion,correo,id_usuario)
     VALUES('$rut','$nombre','$apellido','$telefono','$direccion','$correo','$id_usuario')");
    $query1->execute();

    $query2=$db->connect()->prepare("INSERT INTO usuario (id_usuario,correo,password,id_rol)
     VALUES('$id_usuario','$correo','$password',2)");
    $query2->execute();

    if($query1==true && $query2==true){
        echo"Registro exitoso";
    }else{
        echo"Error";
    }

}



?>