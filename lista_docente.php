<?php

include_once 'database.php';



if (!isset($_SESSION['rol'])) {
    header('location:index.php');
} else {
    if ($_SESSION['rol'] != 1) {
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
    <link rel="stylesheet" href="css/estilo-nav.css">
    <link rel="stylesheet" href="css/estilo-img.css">
    <link rel="stylesheet" href="css/prueba.css"> 
    <link rel="stylesheet" href="css/estilo-form.css">

    <title>Registro Docente</title>
</head>

<body>
    <header>
        <img class="top" src="img/login.jpg">
    </header>

    <?php
    $usu = $_SESSION['usu'];
    $db = new Database();
    $query1 = $db->connect()->prepare('SELECT * FROM usuario WHERE id_usuario=:usu');
    $query1->execute(['usu' => $usu]);

    $row1 = $query1->fetch(PDO::FETCH_NUM);
    $rol1 = $row1[0];

    $query2 = $db->connect()->prepare('SELECT * FROM docente WHERE id_usuario=:rol1');
    $query2->execute(['rol1' => $rol1]);

    $row2 = $query2->fetch(PDO::FETCH_NUM);
    $nom = $row2[2];
    $ape = $row2[3];

    ?>
    <nav class="navbar navbar-light " style="background-color: #7BA8FF">
        <div class="navegacion">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="menu-admin.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Horarios
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="horario_profesor_admin.php">Horario Docente</a>
                        <a class="dropdown-item" href="horario-curso.php">Horario Cursos</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calendario-admin.php">Agendar Evaluacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lista_docente.php">Docentes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Registrar
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="registro-docente.php">Registrar Docente</a>
                        <a class="dropdown-item" href="registro-curso.php">Registrar Curso</a>
                        <a class="dropdown-item" href="RegistrarHorario.php">Registrar Horario</a>
                    </div>
                </li>
            </ul>
        </div>
        <h5 style="margin-left:45%; margin-top:7px;">Bienvenido: <?php echo $nom . " " . $ape ?></h5>
        <a class="nav-link" href="logout.php">Cerrar sesion</a>

    </nav>


    </nav>

    <secton>
    <div align="center" style="margin-top: 30px;">
    <table border="2">
    <thead>
    <th>id</th>
    <th>rut</th>
    <th>nombre</th>
    <th>apellido</th>
    <th>telefono</th>
    <th>direccion</th>
    <th>correo</th>
    <th>idusu</th>
    <th><a href="registro-docente.php"><button>Registrar datos nuevos</button></a></th>
    </thead>
    

    <?php
    include "conexion.php";
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    $query = $mysqli->query("SELECT * FROM docente");
    while ($valores = mysqli_fetch_assoc($query)) {
        echo '<tr>';
        echo '<td>'; echo $valores['id_docente']; echo '</td>';
        echo '<td>'; echo $valores['rut']; echo '</td>';
        echo '<td>'; echo $valores['nombre']; echo '</td>';
        echo '<td>'; echo $valores['apellido']; echo '</td>';
        echo '<td>'; echo $valores['telefono']; echo '</td>';
        echo '<td>'; echo $valores['direccion']; echo '</td>';
        echo '<td>'; echo $valores['correo']; echo '</td>';
        echo '<td>'; echo $valores['id_usuario']; echo '</td>';
        echo "<td><a href='modificar_docente.php?no=".$valores['id_docente']."'><button type='button'>Modificar</button></a></td>";
        echo "<td><a href='eliminar_docente.php?no=".$valores['id_docente']."'><button type='button'>Eliminar</button></a></td>";
        echo '</tr>';
        
    }
    ?>

    </table>
    </div>
    
    </section>

    <footer>

    </footer>
</body>

</html>