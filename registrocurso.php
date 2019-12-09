<?php
include_once 'conexion.php';
include_once 'database.php';

session_start();

if (isset($_POST['btn-enviar'])) {

    $curso=$_POST['curso'];
    $nivel=$_POST['nivel'];
    $cant_alumnos=$_POST['cant_alumnos'];
    

    $sql="UPDATE curso SET nivel='$nivel',cant_alumnos='$cant_alumnos' WHERE id_curso= $curso";

    $conn->query($sql);

    header("Location:registro-curso.php");

}
?>