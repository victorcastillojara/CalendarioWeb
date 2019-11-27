<?php

session_start();
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == true)
{
include "conexion.php";

$usuario=$_POST["usuario"];
$pass=$_POST["contra"];

$_SESSION['usuario']=$usuario;

$query=mysqli_query($conn,"select * from usuario where correo='".$usuario."' and password='".$pass."'");
$nr=mysqli_num_rows($query);

if($nr==1){
    header("Location:index.php");
}else if($nr==0){
    echo"No ingreso";
}
}else
{
echo "<br/>" . "ect ect solo usuarios registrados." . "<br/>";
echo "<br/>" . "<a href='login.html'>login!</a>";

exit;
}



?>