<?php

include_once 'database.php';

session_start();

if(!isset($_SESSION['rol'])){
    header('location:index.php');
}else{
    if($_SESSION['rol']!=1){
        header('location:index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/menu.css">

    <title>Document</title>
</head>

<body>
    <header>
        <div class="imgCabecera">
            <img src="img/avengers.jpg" style="width:100%;height:200px;">
        </div>

    </header>


    <nav class="navbar navbar-light " style="background-color: #e3f2fd;">
        <div class="navegacion">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="menu-admin.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Horario Profesores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Horario Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calendario-admin.php">Agendar Evaluacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registro-docente.php">Registrar Docente</a>
                </li>

            </ul>

        </div>
        <a class="nav-link" href="logout.php">cerrar sesion</a>

    </nav>

    <section>
    <?php
    $usu=$_SESSION['usu'];
    $db=new Database();
    $query1=$db->connect()->prepare('SELECT * FROM usuario WHERE id_usuario=:usu');
    $query1->execute(['usu'=>$usu]);

    $row1=$query1->fetch(PDO::FETCH_NUM);
    $rol1=$row1[0];

    $query2=$db->connect()->prepare('SELECT * FROM docente WHERE id_usuario=:rol1');
    $query2->execute(['rol1'=>$rol1]);

    $row2=$query2->fetch(PDO::FETCH_NUM);
    $nom=$row2[2];
    $ape=$row2[3];
    
    ?>

        <h1>Bienvenido: <?php echo $nom." ".$ape ?></h1>
        <div align="center" style="margin-top:30px;">

        <div class="box-formulario">

        <h1>Registro de docentes</h1>
        <!--Crear archivo php VerificarUsuario-->
        <form action="registro.php" method="post">

            <div class="texto">
                    <i class="fas fa-user"></i>
                <input type="text" name="rut" id="rut">
            </div>
            <div class="texto">
                    <i class="fas fa-user"></i>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            </div>
            <div class="texto">
                    <i class="fas fa-user"></i>
                <input type="text" name="apellido" id="apellido" placeholder="Apellido(s)">
            </div>
            <div class="texto">
                    <i class="fas fa-user"></i>
                <input type="text" name="telefono" id="telefono" placeholder="Telefono">
            </div>
            <div class="texto">
                    <i class="fas fa-user"></i>
                <input type="text" name="direccion" id="direccion" placeholder="Direccion">
            </div>
            <div class="texto">
                    <i class="fas fa-user"></i>
                <input type="text" name="correo" id="correo" placeholder="Correo">
            </div>
            <div class="texto">
                    <i class="fas fa-user"></i>
                <input type="text" name="password" id="password" placeholder="Contraseña">
            </div>
            <div class="texto">
                    <i class="fas fa-user"></i>
                <input type="text" name="id_usuario" id="id_usuario" placeholder="ID de usuario">
            </div>

            <input type="submit" class="btn" value="Registrar">

        </form>
    </div>
        </div>


    </section>

    <footer>

    </footer>
</body>

</html>