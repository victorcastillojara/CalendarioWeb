<?php
include_once 'conexion.php';
include_once 'database.php';



if($_POST['curso']!=null && $_POST['nivel']!=null && $_POST['cant_alumnos']!=null){
    $curso=$_POST['curso'];
    $nivel=$_POST['nivel'];
    $cant_alumnos=$_POST['cant_alumnos'];


        $db=new Database();

        $query1=$db->connect()->prepare("INSERT INTO curso (curso,nivel,cant_alumnos)
        VALUES('$curso','$nivel','$cant_alumnos')");
        $query1->execute();

        $query=$db->connect()->prepare('SELECT * FROM curso WHERE curso=:curso');
        $query->execute(['curso'=>$curso]);

        $row=$query->fetch(PDO::FETCH_NUM);

        $id_usuario=$row[0];

        if($query==true && $query1==true){
            echo"Registro exitoso";
        }else{
            echo"El curso ingresado no es valido";
        }
}else{
    echo"Error: no debe dejar campos vacíos";
}
?>