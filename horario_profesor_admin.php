<?php

include_once 'database.php';

session_start();

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

    <title>Menu Administrador</title>
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

    $_SESSION['nombreusu'] = $nom;
    ?>

    <nav class="navbar navbar-light " style="background-color: #6A9CFC ;">
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
                    <a class="nav-link" href="registro-docente.php">Registrar Docente</a>
                </li>

            </ul>

        </div>
        <h5>Bienvenido: <?php echo $nom . " " . $ape ?></h5>
        <a class="nav-link" href="logout.php">cerrar sesion</a>

    </nav>
    <section>



        <div align="center" style="margin-top:30px;">
            <?php
            include "conexion.php";

            $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

            ?>

            <form action="" method="post">
                <select name="horarioProfesor" id="horarioProfesor">
                    <option value="0">Seleccione profesor:</option>
                    <?php
                    $query = $mysqli->query("SELECT * FROM docente");
                    while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="' . $valores['id_docente'] . '">' . $valores['nombre'] . ' ' . $valores['apellido'] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Buscar">
            </form>

            <h1><strong>Horario profesor</strong></h1>

            <div style="margin-left:60px;margin-right:60px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Bloque</th>
                            <th scope="col">Lunes</th>
                            <th scope="col">Martes</th>
                            <th scope="col">Miercoles</th>
                            <th scope="col">Jueves</th>
                            <th scope="col">Viernes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">8:00 a 9:30</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">9:30 a 11:15</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">11:30 a 12:45</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">14:00 a 15:30</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">15:45 a 17:00</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>


    </section>

    <footer>

    </footer>
</body>

</html>