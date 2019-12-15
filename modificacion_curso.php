<?php

ModificarCurso($_POST['curso'],$_POST['nivel'],$_POST['cant_alumnos'],$_POST['no']);

function ModificarCurso($curso,$nivel,$cant_alumnos,$no){
    include "conexion.php";
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    $query = $mysqli->query("UPDATE curso SET curso='".$curso."', nivel='".$nivel."', cant_alumnos='".$cant_alumnos."' WHERE id_curso='".$no."'");
}

?>

<script>
alert("Datos modificados correctamente!");
window.location.href='lista_curso.php';
</script>