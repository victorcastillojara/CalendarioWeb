<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
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

  <title>Calendario web</title>
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
        <a class="nav-link" href="#">cerrar sesion</a>

    </nav>

    <section>

        <h1>Bienvenido: <?php echo $_SESSION['usuario'] ?></h1>
  <div class="container">
    <div class="row">
      <div class="col"></div>
      <div class="col-7">
        <br><br><div id="CalendarioWeb"></div>
      </div>
      <div class="col"></div>
    </div>
  </div>
  


    </section>

    <footer>

    </footer>


  <script>
    $(document).ready(function () {
      $('#CalendarioWeb').fullCalendar({
        header: {
          left: 'today, prev,next',
          center: 'title',
          right: 'month,basicWeek, basicDay,agendaWeek,agendaDay, Miboton'
        },

        dayClick: function (date, jsEvent, view) {

          //desactivacion de botones sin evento
          $('#btnAgregar').prop("disabled",false);

          Limpiar();
          $('#txtFecha').val(date.format());

          $("#ModalEventos").modal();
        },

        events: 'http://localhost/calendario/eventos.php',


        eventClick: function (calEvent, jsEvent, view) {
          
          //desactivacion de botones con evento
          $('#btnAgregar').prop("disabled",true);

          //llamando datos para mostrar en el calendario
          $('#tituloEvento').html(calEvent.title);

          $('#txtDescripcion').val(calEvent.descripcion);

          $('#txtID').val(calEvent.id);

          $('#txtTitulo').val(calEvent.title);

          $('#txtColor').val(calEvent.color);

          FechaHora = calEvent.start._i.split(" ");

          $('#txtFecha').val(FechaHora[0]);

          $('#txtHora').val(FechaHora[1]);

          //Mostrar modal con datos
          $("#ModalEventos").modal();
        },
        editable: true,
        eventDrop: function (calEvent) {

          $('#txtID').val(calEvent.id);
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

          <input type="hidden" id="txtID" name="txtID">
          <input type="hidden" id="txtFecha" name="txtFecha">

          <div class="form-row">
            <div class="form-group col-md-8">
              <label>Titulo</label>
              <input type="text" id="txtTitulo" name="txtTitulo" class="form-control" placeholder="Titulo evento">
            </div>
            <div class="form-group col-md-4">
              <label>Hora del evento</label>
              <input type="time" id="txtHora" value="10:30" name="txtHora" class="form-control">

            </div>

          </div>

          <div class="form-group">
            <label>Descripcion</label>
            <textarea name="txtDescripcion" id="txtDescripcion" rows="3" class="form-control"></textarea>
          </div>
          <div form-group>
            <label>Color</label>
            <input type="color" id="txtColor" value="#ff0000" name="txtColor" class="form-control">
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
          <!--<button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
          <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>-->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  <script>

    var NuevoEvento;
    $('#btnAgregar').click(function () {
      RecolectarDatosGUI();
      EnviarInformacion('agregar', NuevoEvento);
    });

    $('#btnEliminar').click(function () {
      RecolectarDatosGUI();
      EnviarInformacion('eliminar', NuevoEvento);
    });

    $('#btnModificar').click(function () {
      RecolectarDatosGUI();
      EnviarInformacion('modificar', NuevoEvento);
    });


    function RecolectarDatosGUI() {
      NuevoEvento = {
        id: $('#txtID').val(),
        title: $('#txtTitulo').val(),
        start: $('#txtFecha').val() + " " + $('#txtHora').val(),
        color: $('#txtColor').val(),
        descripcion: $('#txtDescripcion').val(),
        textColor: "#FFFFFF",
        end: $('#txtFecha').val() + " " + $('#txtHora').val()
      };

    }

    function EnviarInformacion(accion, objEvento, modal) {

      $.ajax({

        type: 'POST',
        url: 'eventos.php?accion=' + accion,
        data: objEvento,
        success: function (msg) {
          if (msg) {
            $('#CalendarioWeb').fullCalendar('refetchEvents');

            if (!modal) {

              $("#ModalEventos").modal('toggle');
            }



          }

        },
        error: function () {
          alert("hay un error");
        }

      });
    }

    function Limpiar() {
        $('#txtID').val('');
        $('#txtTitulo').val('');
        $('#txtColor').val('');
        $('#txtDescripcion').val('');

      }
  </script>
</body>

</html>