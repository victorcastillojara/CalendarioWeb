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


$consulta=ConsultarDocente($_GET['no']);

function ConsultarDocente($id_docente_mod){
    include 'conexion.php';
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    $query = $mysqli->query("SELECT * FROM docente WHERE id_docente='".$id_docente_mod."'");
    $valores = mysqli_fetch_assoc($query);
    return [
        $valores['rut'],
        $valores['nombre'],
        $valores['apellido'],
        $valores['telefono'],
        $valores['direccion'],
        $valores['correo'],
    ];
    
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
                <li class="nav-item">
                    <a class="nav-link" href="horario_profesor_admin.php">Horario Docente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calendario-admin.php">Agendar Evaluacion</a>
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
        <a class="nav-link" href="logout.php">Cerrar sesion</a>

    </nav>


    </nav>

    <section>



        <div align="center">
            <h1>Registro de Docentes</h1>
            <!--Crear archivo php VerificarUsuario-->
            <form action="modificacion.php" method="post">
            <input type="hidden" name="no" value="<?php echo $_GET['no'] ?>">
                <div class="center_div">

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="nombre">RUT</label>
                            <input type="text" name="rut" class="form-control" id="rut" placeholder="RUT" value="<?php echo $consulta[0] ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="nombre">Nombre Docente</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" value="<?php echo $consulta[1] ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="apellido">Apellido(s) Docente</label>
                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" value="<?php echo $consulta[2] ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="telefono">Telefono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $consulta[3] ?>">
                        </div>
                    </div>

                    <div class="form-row">
                    <div class="form-group col-md-3">
                            <label for="direccion">Direccion</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $consulta[4] ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="contrasena">Contraseña</label>
                            <input type="text" class="form-control" name="password" id="password" placeholder="Contraseña">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="Email">Email</label>
                            <input type="text" class="form-control" name="correo" id="correo" placeholder="E-mail" value="<?php echo $consulta[5] ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="id_curso">ID De Curso</label>
                            <input type="text" class="form-control" name="id_curso" id="id_carlos" placeholder="ID_CURSO">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Modificar datos</button>

            </form>

        </div>



    </section>

    <footer>

    </footer>
</body>

</html>