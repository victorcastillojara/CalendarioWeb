<?php

include_once 'database.php';


if (!isset($_SESSION['rol'])) {
  header('location:login.php');
} else {
  if ($_SESSION['rol'] != 1) {
    header('location:login.php');
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="php" href="VerificarUsuario.php">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">



  <link rel='stylesheet' type='text/css' href='fullcalendar.css' />
  <script type='text/javascript' src='jquery.js'></script>
  <script type='text/javascript' src='fullcalendar.js'></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/moment.min.js"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/fullcalendar.min.css">
  <script src="js/fullcalendar.min.js"></script>
  <script src="js/es.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="css/estilo_dias.css">
  <link rel="stylesheet" href="css/estilo-nav.css">
  <link rel="stylesheet" href="css/estilo-img.css">


  <title>Calendario web</title>
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

  <section>

    <div class="container">
      <div class="row">
        <div class="col"></div>
        <div class="col-7">
          <br><br>
          <div id="CalendarioWeb"></div>
        </div>
        <div class="col"></div>
      </div>
    </div>
  </section>

  <footer>

  </footer>


  <script>
    $(document).ready(function() {
      $('#CalendarioWeb').fullCalendar({
        header: {
          left: 'today, prev,next',
          center: 'title',
          right: 'month,basicWeek, basicDay,agendaWeek,agendaDay, Miboton'
        },

        dayClick: function(date, jsEvent, view) {

          //desactivacion de botones sin evento
          $('#btnAgregar').prop("disabled", false);
          $('#btnModificar').prop("disabled", true);
          $('#btnEliminar').prop("disabled", true);

          Limpiar();
          $('#txtFecha').val(date.format());

          $("#ModalEventos").modal();
        },

        events: 'http://localhost/CalendarioWeb/eventos.php',


        eventClick: function(calEvent, jsEvent, view) {

          //desactivacion de botones con evento
          $('#btnAgregar').prop("disabled", true);
          $('#btnModificar').prop("disabled", false);
          $('#btnEliminar').prop("disabled", false);

          $('#tituloEvento').html(calEvent.usuario);

          $('#txtDescripcion').val(calEvent.descripcion);

          $('#txtID').val(calEvent.id);

          $('#txtTitulo').val(calEvent.title);

          $('#bloque').val(calEvent.bloque);

          $('#curso').val(calEvent.curso);

          $('#txtColor').val(calEvent.color);

          FechaHora = calEvent.start._i.split(" ");

          $('#txtFecha').val(FechaHora[0]);

          $('#txtHora').val(FechaHora[1]);


          $("#ModalEventos").modal();
        },
        editable: true,
        eventDrop: function(calEvent) {

          $('#txtID').val(calEvent.id);
          $('#bloque').val(calEvent.bloque);
          $('#txtTitulo').val(calEvent.title);
          $('#txtColor').val(calEvent.color);
          $('#txtDescripcion').val(calEvent.descripcion);

          var FechaHora = calEvent.start.format().split("T");
          $('#txtFecha').val(FechaHora[0]);
          $('#txtHora').val(FechaHora[1]);

          RecolectarDatosGUI();
          EnviarInformacion('modificar', NuevoEvento, true);
        }

      });

    })
  </script>


  <!-- Modal(Agregar,modificar,eliminar )-->
  <form action="#" method="post">
  <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloEvento"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          



          <div class="form-row">

            <div class="form-group col-md-5">
              <?php
              include "conexion.php";

              $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

              ?>
              <label for="curso">Seleccione curso</label>
              <select id="curso" name="curso" class="form-control">
                <option value="0" disabled>Seleccione curso</option>
                <?php
                $query = $mysqli->query("SELECT * FROM curso");
                while ($valores = mysqli_fetch_array($query)) {
                  echo '<option value="' . $valores['curso'] . ' ' . $valores['nivel'] . '">' . $valores['curso'] . ' ' . $valores['nivel'] . '</option>';
                }
                ?>
              </select>
            </div>

            <div class="form-group col-md-8">
              <label>Titulo evaluación</label>
              <input type="text" id="txtTitulo" name="txtTitulo" class="form-control" placeholder="Titulo evalaucion">
            </div>
            
            
            <div class="form-group col-md-4">
              <!--<label>bloque</label>
              <input type="text" id="bloque" value="" name="bloque" class="form-control">-->
              <?php
              include "conexion.php";

              $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

              ?>
              <label for="bloque">Seleccione bloque</label>
              <select id="bloque" name="boque" class="form-control">
                <option value="0" disabled>Seleccione bloque</option>
                <?php
                $query = $mysqli->query("SELECT * FROM bloque");
                while ($valores = mysqli_fetch_array($query)) {
                  echo '<option value="' . $valores['bloque'] . '">' . $valores['bloque'] . '</option>';
                }
                ?>
                <label for="bloque">Seleccione bloque</label>
                
                <select id="bloque" name="bloque" class="form-control">
                <option value="0" disabled >Seleccione bloque</option>
                    <?php
                      $query = $mysqli -> query ("SELECT * FROM bloque");
                      while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="'.$valores['bloque'].'">'.$valores['bloque'].'</option>';
                      }
                      $bloque=$_POST['bloque'];
                    ?>
                </select>
                      <input type="submit">
                      
            </div>
            

          </div>

          <div class="form-group">
            <label>Descripcion evaluacion</label>
            <textarea name="txtDescripcion" id="txtDescripcion" rows="3" class="form-control"></textarea>
          </div>
          <div form-group>
            <label>Color</label>
            <input type="color" id="txtColor" value="#ff0000" name="txtColor" class="form-control">
          </div>

          <input type="hidden" id="txtID" name="txtID">
          <input type="hidden" id="txtFecha" name="txtFecha">
          <input type="hidden" name="usuario" id="usuario" value="<?php echo $nom." ".$ape ?>">
          <input type="hidden" name="id_usuario" id="id_usuario" value=" <?php echo $rol1 ?>"> 
          <input type="hidden" id="txtHora" value="<?php echo $bloque; ?>" name="txtHora" class="form-control">

        </div>
        <div class="modal-footer">
          <input type="submit" id="btnAgregar" class="btn btn-success">
          <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
          <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  </form>
  <script>
    var NuevoEvento;
    $('#btnAgregar').click(function() {
      RecolectarDatosGUI();
      EnviarInformacion('agregar', NuevoEvento);
    });

    $('#btnEliminar').click(function() {
      RecolectarDatosGUI();
      EnviarInformacion('eliminar', NuevoEvento);
    });

    $('#btnModificar').click(function() {
      RecolectarDatosGUI();
      EnviarInformacion('modificar', NuevoEvento);
    });


    function RecolectarDatosGUI() {
      NuevoEvento = {
        id: $('#txtID').val(),
        id_usuario: $('#id_usuario').val(),
        usuario: $('#usuario').val(),
        curso: $('#curso').val(),
        bloque: $('#bloque').val(),
        title: $('#txtTitulo').val(),
        start: $('#txtFecha').val() + " " + $('#bloque').val(),
        color: $('#txtColor').val(),
        descripcion: $('#txtDescripcion').val(),
        textColor: "#FFFFFF",
        end: $('#txtFecha').val() + " " + $('#bloque').val()
      };

    }

    function EnviarInformacion(accion, objEvento, modal) {

      $.ajax({

        type: 'POST',
        url: 'eventos.php?accion=' + accion,
        data: objEvento,
        success: function(msg) {
          if (msg) {
            $('#CalendarioWeb').fullCalendar('refetchEvents');

            if (!modal) {

              $("#ModalEventos").modal('toggle');
            }



          }

        },
        error: function() {
          alert("hay un error");
        }

      });
    }

    function Limpiar() {
      $('#txtID').val('');
      $('#txtTitulo').val('');
      $('#bloque').val('');
      $('#curso').val('');
      $('#txtColor').val('');
      $('#txtDescripcion').val('');

    }
  </script>
</body>
<?php
echo $bloque;
?>
</html>

