<?php

include_once 'database.php';

$db = new Database();

if($_POST['titulo']!=null && $_POST['descripcion']!=null){
    
    $titulo=$_POST['titulo'];
    $descripcion=$_POST['descripcion'];

    $queryInsert = $db->connect()->prepare('UPDATE informaciones SET titulo=:titulo, descripcion=:descripcion WHERE id_informacion=1');
    $queryInsert->execute(['titulo'=>$titulo, 'descripcion'=>$descripcion]);

    echo "<script>alert('Información actualizada!');</script>";
    require('menu-admin.php');

    }else {
        echo "<script>alert('No debe dejar campos vacíos');</script>";
        require('menu-admin.php');
    }

?>