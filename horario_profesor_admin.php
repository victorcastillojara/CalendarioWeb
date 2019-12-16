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


    <link rel="stylesheet" href="css/estilo-nav.css">
    <link rel="stylesheet" href="css/prueba.css">
    <link rel="stylesheet" href="css/estilo-img.css">

    <title>Menú Administrador</title>
</head>

<body>
    <header>
        <img class="top" src="img/login2.jpg">
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

<nav class="navbar navbar-light " style="background-color: #7BA8FF">
        <div class="navegacion">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="menu-admin.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="horario_profesor_admin.php">Horario Docente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calendario-admin.php">Agendar Evaluación</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lista_docente.php">Docentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lista_curso.php">Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="RegistrarHorario.php">Registrar Horario</a>
                </li>
            </ul>
        </div>
        <h5 style="margin-left:40%; margin-top:7px;">Bienvenido: <?php echo $nom . " " . $ape ?></h5>
        <a class="nav-link" href="logout.php">Cerrar sesión</a>

    </nav>
    
    <section>



        <div align="center" style="margin-top:30px;">
            <?php
            include "conexion.php";

            $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

            ?>

            <form action="#" method="post">
                <select name="horarioProfesor" id="horarioProfesor">
                    <option value="0">Seleccione profesor:</option>
                    <?php
                    $query = $mysqli->query("SELECT * FROM docente");
                    while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="' . $valores['id_docente'] . '">' . $valores['nombre'] . ' ' . $valores['apellido'] . '</option>';
                    }
                    $docente = $_POST['horarioProfesor'];
                    ?>
                </select>
                <input type="submit" value="Buscar" class="btn btn-primary">
            </form>

            <h1><strong>Horario profesor</strong></h1>

            <div style="margin-left:60px;margin-right:60px;">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Bloque</th>
                            <th scope="col">Lunes</th>
                            <th scope="col">Martes</th>
                            <th scope="col">Miércoles</th>
                            <th scope="col">Jueves</th>
                            <th scope="col">Viernes</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $db = new Database();
                        $queryLunes = $db->connect()->prepare('SELECT dia.dia,docente.apellido,docente.nombre,curso.curso,bloque.bloque,ramo.ramo
                        FROM horario inner join docente on docente.id_docente=horario.id_docente 
                        inner join curso on curso.id_curso=horario.id_curso
                        inner join bloque on bloque.id_bloque=horario.id_bloque
                        inner join ramo on ramo.id_ramo=horario.id_ramo
                        inner join dia on dia.id_dia=horario.id_dia
                        where horario.id_docente=:docente and dia="Lunes" order by horario.id_bloque');
                        $queryLunes->execute(['docente' => $docente]);
                        $rowLunes = $queryLunes->fetchAll(PDO::FETCH_ASSOC);

                        $queryMartes = $db->connect()->prepare('SELECT dia.dia,docente.apellido,docente.nombre,curso.curso,bloque.bloque,ramo.ramo
                        FROM horario inner join docente on docente.id_docente=horario.id_docente 
                        inner join curso on curso.id_curso=horario.id_curso
                        inner join bloque on bloque.id_bloque=horario.id_bloque
                        inner join ramo on ramo.id_ramo=horario.id_ramo
                        inner join dia on dia.id_dia=horario.id_dia
                        where horario.id_docente=:docente and horario.id_dia=2 order by horario.id_bloque');
                        $queryMartes->execute(['docente' => $docente]);
                        $rowMartes = $queryMartes->fetchAll(PDO::FETCH_ASSOC);

                        $queryMiercoles = $db->connect()->prepare('SELECT dia.dia,docente.apellido,docente.nombre,curso.curso,bloque.bloque,ramo.ramo
                        FROM horario inner join docente on docente.id_docente=horario.id_docente 
                        inner join curso on curso.id_curso=horario.id_curso
                        inner join bloque on bloque.id_bloque=horario.id_bloque
                        inner join ramo on ramo.id_ramo=horario.id_ramo
                        inner join dia on dia.id_dia=horario.id_dia
                        where horario.id_docente=:docente and horario.id_dia=3 order by horario.id_bloque');
                        $queryMiercoles->execute(['docente' => $docente]);
                        $rowMiercoles = $queryMiercoles->fetchAll(PDO::FETCH_ASSOC);

                        $queryJueves = $db->connect()->prepare('SELECT dia.dia,docente.apellido,docente.nombre,curso.curso,bloque.bloque,ramo.ramo
                        FROM horario inner join docente on docente.id_docente=horario.id_docente 
                        inner join curso on curso.id_curso=horario.id_curso
                        inner join bloque on bloque.id_bloque=horario.id_bloque
                        inner join ramo on ramo.id_ramo=horario.id_ramo
                        inner join dia on dia.id_dia=horario.id_dia
                        where horario.id_docente=:docente and horario.id_dia=4 order by horario.id_bloque');
                        $queryJueves->execute(['docente' => $docente]);
                        $rowJueves = $queryJueves->fetchAll(PDO::FETCH_ASSOC);

                        $queryViernes = $db->connect()->prepare('SELECT dia.dia,docente.apellido,docente.nombre,curso.curso,bloque.bloque,ramo.ramo
                        FROM horario inner join docente on docente.id_docente=horario.id_docente 
                        inner join curso on curso.id_curso=horario.id_curso
                        inner join bloque on bloque.id_bloque=horario.id_bloque
                        inner join ramo on ramo.id_ramo=horario.id_ramo
                        inner join dia on dia.id_dia=horario.id_dia
                        where horario.id_docente=:docente and horario.id_dia=5 order by horario.id_bloque');
                        $queryViernes->execute(['docente' => $docente]);
                        $rowViernes = $queryViernes->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <tr>
                            <th scope="row">8:00 a 9:15</th>
                            <td><?php if (isset($rowLunes[0]) != null && $rowLunes[0]['bloque'] == "8:00 a 9:30"){ echo $rowLunes[0]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowMartes[0]) != null && $rowMartes[0]['bloque'] == "8:00 a 9:30"){ echo $rowMartes[0]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowMiercoles[0]) != null && $rowMiercoles[0]['bloque'] == "8:00 a 9:30"){ echo $rowMiercoles[0]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowJueves[0]) != null && $rowJueves[0]['bloque'] == "8:00 a 9:30"){ echo $rowJueves[0]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowViernes[0]) != null && $rowViernes[0]['bloque'] == "8:00 a 9:30"){ echo $rowViernes[0]['curso']; }else{ echo "No hay registros!"; } ?></td>
                        </tr>
                        <tr>
                            <th scope="row">9:30 a 11:15</th>
                            <td><?php if (isset($rowLunes[1]) != null && $rowLunes[1]['bloque'] == "9:45 a 11:15"){ echo $rowLunes[1]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowMartes[1]) != null && $rowMartes[1]['bloque'] == "9:45 a 11:15"){ echo $rowMartes[1]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowMiercoles[1]) != null && $rowMiercoles[1]['bloque'] == "9:45 a 11:15"){ echo $rowMiercoles[1]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowJueves[1]) != null && $rowJueves[1]['bloque'] == "9:45 a 11:15"){ echo $rowJueves[1]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowViernes[1]) != null && $rowViernes[1]['bloque'] == "9:45 a 11:15"){ echo $rowViernes[1]['curso']; }else{ echo "No hay registros!"; } ?></td>
                        </tr>
                        <tr>
                            <th scope="row">11:30 a 12:45</th>
                            <td><?php if (isset($rowLunes[2]) != null && $rowLunes[2]['bloque'] == "11:30 a 12:45"){ echo $rowLunes[2]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowMartes[2]) != null && $rowMartes[2]['bloque'] == "11:30 a 12:45"){ echo $rowMartes[2]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowMiercoles[2]) != null && $rowMiercoles[2]['bloque'] == "11:30 a 12:45"){ echo $rowMiercoles[2]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowJueves[2]) != null && $rowJueves[2]['bloque'] == "11:30 a 12:45"){ echo $rowJueves[2]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowViernes[2]) != null && $rowViernes[2]['bloque'] == "11:30 a 12:45"){ echo $rowViernes[2]['curso']; }else{ echo "No hay registros!"; } ?></td>
                        </tr>
                        <tr>
                            <th scope="row">14:00 a 15:30</th>
                            <td><?php if (isset($rowLunes[3]) != null && $rowLunes[3]['bloque'] == "14:00 a 15:30"){ echo $rowLunes[3]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowMartes[3]) != null && $rowMartes[3]['bloque'] == "14:00 a 15:30"){ echo $rowMartes[3]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowMiercoles[3]) != null && $rowMiercoles[3]['bloque'] == "14:00 a 15:30"){ echo $rowMiercoles[3]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowJueves[3]) != null && $rowJueves[3]['bloque'] == "14:00 a 15:30"){ echo $rowJueves[3]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowViernes[3]) != null && $rowViernes[3]['bloque'] == "14:00 a 15:30"){ echo $rowViernes[3]['curso']; }else{ echo "No hay registros!"; } ?></td>
                        </tr>
                        <tr>
                            <th scope="row">15:45 a 17:00</th>
                            <td><?php if (isset($rowLunes[4]) != null && $rowLunes[4]['bloque'] == "15:45 a 17:00"){ echo $rowLunes[4]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowMartes[4]) != null && $rowMartes[4]['bloque'] == "15:45 a 17:00"){ echo $rowMartes[4]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowMiercoles[4]) != null && $rowMiercoles[4]['bloque'] == "15:45 a 17:00"){ echo $rowMiercoles[4]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowJueves[4]) != null && $rowJueves[4]['bloque'] == "15:45 a 17:00"){ echo $rowJueves[4]['curso']; }else{ echo "No hay registros!"; } ?></td>
                            <td><?php if (isset($rowViernes[4]) != null && $rowViernes[4]['bloque'] == "15:45 a 17:00"){ echo $rowViernes[4]['curso']; }else{ echo "No hay registros!"; } ?></td>
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