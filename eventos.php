<?php
session_start();    

header('Content-Type: application/json');

$pdo=new PDO("mysql:dbname=scejc;host=localhost","root","");

$accion=(isset($_GET['accion']))?$_GET['accion']:'leer';

switch($accion){
    case 'agregar':
    //intstrucciones de agregado
    $SentenciaSQL=$pdo->prepare("INSERT INTO eventos(id_usuario,usuario,curso,bloque,title,descripcion,color,textColor,start,end)
    VALUES(:id_usuario,:usuario,:curso,:bloque,:title,:descripcion,:color,:textColor,:start,:end)");

    $respuesta=$SentenciaSQL->execute(array(
        "id_usuario"=>$_POST['id_usuario'],
        "usuario"=>$_POST['usuario'],
        "curso"=>$_POST['curso'],
        "bloque"=>$_POST['bloque'],
        "title"=>$_POST['title'],
        "descripcion"=>$_POST['descripcion'],
        "color"=>$_POST['color'],
        "textColor"=>$_POST['textColor'],
        "start"=>$_POST['start'],
        "end"=>$_POST['end']

    ));

    echo json_encode($respuesta);

    break;
    case 'eliminar':
    //intstrucciones de eliminar
    $respuesta=false;

    if(isset($_POST['id'])){

        $sentenciaSQL=$pdo->prepare("DELETE FROM eventos WHERE ID=:ID");
         $respuesta= $sentenciaSQL->execute(array("ID"=>$_POST['id']));

    }

    echo json_encode($respuesta);

    break;

    case 'modificar':
    //intstrucciones de modificar

    $sentenciaSQL=$pdo->prepare("UPDATE eventos SET 
    id_usuario=:id_usuario,
    usuario=:usuario,
    curso=:curso,
    bloque=:bloque,
    title=:title,
    descripcion=:descripcion,
    color=:color,
    textColor=:textColor,
    start=:start,
    end=:end
     WHERE ID=:ID");

$respuesta=$sentenciaSQL->execute(array(
    "ID"=>$_POST['id'],
    "id_usuario"=>$_POST['id_usuario'],
    "usuario"=>$_POST['usuario'],
    "curso"=>$_POST['curso'],
    "bloque"=>$_POST['bloque'],
    "title"=>$_POST['title'],
    "descripcion"=>$_POST['descripcion'],
    "color"=>$_POST['color'],
    "textColor"=>$_POST['textColor'],
    "start"=>$_POST['start'],
    "end"=>$_POST['end']
));

echo json_encode($respuesta);

    break;

    default:
    //seleccionar los eventos del calendadrio

$SentenciaSQL=$pdo->prepare("SELECT * FROM eventos");

$SentenciaSQL->execute();

$resultado=$SentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultado);

    break;
}


?>