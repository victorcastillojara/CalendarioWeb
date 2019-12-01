<?php

include_once 'database.php';

session_start();

if (!isset($_SESSION['rol'])) {
    header('location:login.php');
} else {
    if ($_SESSION['rol'] != 2) {
        header('location:login.php');
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

    <link rel="stylesheet" href="css/estilo-nav.css">
    <link rel="stylesheet" href="css/estilo-img.css">
    <link rel="stylesheet" href="css/estilo-form.css">

    <title>Mi Horario</title>
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

    <nav class="navbar navbar-light " style="background-color: #6A9CFC ;">
        <div class="navegacion">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="menu-usuario.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="horario-propio.php">Mi Horario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calendario-usuario.php">Agendar Evaluacion</a>
                </li>
            </ul>
        </div>
        <h5>Bienvenido: <?php echo $nom . " " . $ape ?></h5>
        <a class="nav-link" href="logout.php">cerrar sesion</a>

    </nav>

    <section>
    </section>
    <div align="center">
        <h1>Mi Horario</h1>
    </div>
    <div class="centrartabla">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Bloque</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Curso</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Lenguaje</td>
                    <td>2°Basico M</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Matemáticas</td>
                    <td>8vo medio F</td>
                </tr>
            </tbody>
        </table>
    </div>
    <footer>

    </footer>
</body>

</html>