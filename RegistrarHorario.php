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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>


    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/estilo-img.css">
    <link rel="stylesheet" href="css/estilo-nav.css">
    <link rel="stylesheet" href="css/prueba.css">

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
                    <a class="nav-link" href="RegistrarHorario.php">Registrar horario</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Registrar
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="registro-docente.php">Registrar Docente</a>
                        <a class="dropdown-item" href="registro-curso.php">Registrar Curso</a>
                    </div>
                </li>
            </ul>
        </div>
        <h5 style="margin-left:50%; margin-top:7px;">Bienvenido: <?php echo $nom . " " . $ape ?></h5>
        <a class="nav-link" href="logout.php">Cerrar sesion</a>

    </nav>


    <section>
        <div align="center" style="margin-left: 40px;margin-right: 40px ">
            <h1>Registro de horario</h1>
            
            <form action="insertarCurso.php" method="post">
                <div class="center_div">
                    <div class="form-row">


                        <!--Seleccion del dia-->
                        <div class="form-group col-md-3">
                            <?php
                            include "conexion.php";

                            $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

                            ?>
                            <label for="dia">Seleccione Dia</label>
                            <select id="dia" name="dia" class="form-control">
                                <option value="0">Seleccione Dia:</option>
                                <?php
                                $query = $mysqli->query("SELECT * FROM dia");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['id_dia'] . '">' . $valores['dia'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--Seleccion del bloque-->
                        <div class="form-group col-md-3">
                            <?php
                            include "conexion.php";

                            $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

                            ?>
                            <label for="bloque">Seleccione bloque</label>
                            <select id="bloque" name="bloque" class="form-control">
                                <option value="0">Seleccione bloque:</option>
                                <?php
                                $query = $mysqli->query("SELECT * FROM bloque");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['id_bloque'] . '">' . $valores['bloque'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--Seleccion del Curso-->
                        <div class="form-group col-md-3">
                            <?php
                            include "conexion.php";

                            $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

                            ?>
                            <label for="curso">Seleccione Curso</label>
                            <select id="curso" name="curso" class="form-control">
                                <option value="0">Seleccione Curso:</option>
                                <?php
                                $query = $mysqli->query("SELECT * FROM curso");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['id_curso'] . '">' . $valores['curso'] . ' ' . $valores['nivel'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--Seleccion del docente-->
                        <div class="form-group col-md-3">
                            <?php
                            include "conexion.php";

                            $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

                            ?>
                            <label for="docente">Seleccione docente</label>
                            <select id="docente" name="docente" class="form-control">
                                <option value="0">Seleccione docente:</option>
                                <?php
                                $query = $mysqli->query("SELECT * FROM docente");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['id_docente'] . '">' . $valores['nombre'] . ' ' . $valores['apellido'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--Seleccion del ramo-->

                    </div>
                </div>
                <div class="form-group col-md-2" align="center">
                    <?php
                    include "conexion.php";

                    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

                    ?>
                    <label for="ramo">Seleccione ramo</label>
                    <select id="ramo" name="ramo" class="form-control">
                        <option value="0">Seleccione ramo:</option>
                        <?php
                        $query = $mysqli->query("SELECT * FROM ramo");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="' . $valores['id_ramo'] . '">' . $valores['ramo'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="btn-Registrar">Registrar</button>
            </form>
        </div>
    </section>
    <footer>
    </footer>
</body>

</html>