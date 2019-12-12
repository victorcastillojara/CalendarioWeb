<?php



ModificarDocente($_POST['rut'],$_POST['nombre'],$_POST['apellido'],$_POST['telefono'],$_POST['direccion'],$_POST['correo'],$_POST['no']);

function ModificarDocente($rut,$nombre,$apellido,$telefono,$direccion,$correo,$no){
    include "conexion.php";
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    $query = $mysqli->query("UPDATE docente SET nombre='".$nombre."', apellido='".$apellido."', telefono='".$telefono."', direccion='".$direccion."', correo='".$correo."' WHERE id_docente='".$no."'");
}

?>

<script>
alert("Datos modificados correctamente!");
window.location.href='lista_docente.php';
</script>