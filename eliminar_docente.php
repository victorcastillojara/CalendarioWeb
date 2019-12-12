<?php



EliminarDocente($_GET['no']);

function EliminarDocente($no){
    include "conexion.php";
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    $query = $mysqli->query("DELETE FROM docente WHERE id_docente='".$no."'");
}

?>

<script>
alert("Datos eliminados correctamente!");
window.location.href='lista_docente.php';
</script>