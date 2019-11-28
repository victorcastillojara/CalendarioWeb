<?php
include "conexion.php";

$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="scejc";
 
  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<select>
        <option value="0">Seleccione:</option>
        <?php
          $query = $mysqli -> query ("SELECT * FROM usuario");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores['id'].'">'.$valores['correo'].'</option>';
          }
        ?>
      </select>
    
</body>
</html>