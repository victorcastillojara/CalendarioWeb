<?php

session_start();

if(!isset($_SESSION['rol'])){
    header('location:login.php');
}else{
    if($_SESSION['rol']!=2){
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
                    <a class="nav-link active" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mi Horario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calendario-usuario.php">Agendar Evaluacion</a>
                </li>
            </ul>

        </div>
        <a class="nav-link" href="logout.php">cerrar sesion</a>

    </nav>

    <section>
        <div align="center" style="margin-top:30px;">

            <h1>Informacion</h1>

            <textarea name="" id="" cols="100" rows="10"></textarea>
        </div>


    </section>

    <footer>

    </footer>
</body>

</html>
<?php

?>
