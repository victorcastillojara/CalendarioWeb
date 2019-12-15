<?php 

require 'database.php';

  $usu = $_SESSION['usu'];
  $db = new Database();
  $query1 = $db->connect()->prepare('SELECT * FROM usuario WHERE id_usuario=:usu');
  $query1->execute(['usu' => $usu]);

  $row1 = $query1->fetch(PDO::FETCH_NUM);
  $rol1 = $row1[0];

?>