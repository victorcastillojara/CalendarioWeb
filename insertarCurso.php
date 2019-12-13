<?php
include_once 'database.php';

if (isset($_POST['btn-Registrar'])) {
    $db=new Database();

    $dia=$_POST['dia'];
    $bloque=$_POST['bloque'];
    $curso=$_POST['curso'];
    $docente=$_POST['docente'];
    $ramo=$_POST['ramo'];

    $sql=$db->connect()->prepare("INSERT INTO horario(id_dia,id_bloque,id_curso,id_docente,id_ramo) 
    VALUES('$dia','$bloque','$curso','$docente','$ramo')");

    $sql1=$db->connect()->prepare("INSERT INTO docente_curso(id_docente,id_curso) 
                                VALUES('$docente','$curso')");

    $sql->execute();  
    $sql1->execute(); 

    if (!$sql) {
       die("fallo el registro");
    }
    $_SESSION['mensaje']='Registro exitoso';
    $_SESSION['color']='success';

    header("Location:RegistrarHorario.php");
}
