<?php



ModificarDocente($_POST['rut'],$_POST['nombre'],$_POST['apellido'],$_POST['telefono'],$_POST['direccion'],$_POST['correo'],$_POST['no']);
ModificarCurso($_POST['cant_alumnos'],$_POST['n1']);

function ModificarDocente($rut,$nombre,$apellido,$telefono,$direccion,$correo,$no){
    include "conexion.php";
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    $query = $mysqli->query("UPDATE docente SET nombre='".$nombre."', apellido='".$apellido."', telefono='".$telefono."', direccion='".$direccion."', correo='".$correo."' WHERE id_docente='".$no."'");
}

function ModificarCurso($cant_alumnos,$n1){
    include "conexion.php";
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    $query = $mysqli->query("UPDATE curso SET cant_alumnos='".$cant_alumnos."' WHERE id_curso='".$no."'");
}

?>

<script>
alert("Datos modificados correctamente!");
window.location.href='lista_docente.php';
</script>