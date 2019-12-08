<?php

include_once 'database.php';

$db=new Database();

$queryLunes=$db->connect()->prepare('SELECT dia.dia,docente.apellido,docente.nombre,curso.curso,bloque.bloque,ramo.ramo
FROM horario inner join docente on docente.id_docente=horario.id_docente 
 inner join curso on curso.id_curso=horario.id_curso
 inner join bloque on bloque.id_bloque=horario.id_bloque
 inner join ramo on ramo.id_ramo=horario.id_ramo
 inner join dia on dia.id_dia=horario.id_dia
 where horario.id_docente=:rol1 and dia="Lunes" order by horario.id_bloque');
$queryLunes->execute(['rol1'=>$rol1]);
$rowLunes=$queryLunes->fetchAll(PDO::FETCH_ASSOC);

$queryMartes=$db->connect()->prepare('SELECT dia.dia,docente.apellido,docente.nombre,curso.curso,bloque.bloque,ramo.ramo
FROM horario inner join docente on docente.id_docente=horario.id_docente 
 inner join curso on curso.id_curso=horario.id_curso
 inner join bloque on bloque.id_bloque=horario.id_bloque
 inner join ramo on ramo.id_ramo=horario.id_ramo
 inner join dia on dia.id_dia=horario.id_dia
 where horario.id_docente=:rol1 and horario.id_dia=2 order by horario.id_bloque');
$queryMartes->execute(['rol1'=>$rol1]);
$rowMartes=$queryMartes->fetchAll(PDO::FETCH_ASSOC);

$queryMiercoles=$db->connect()->prepare('SELECT dia.dia,docente.apellido,docente.nombre,curso.curso,bloque.bloque,ramo.ramo
FROM horario inner join docente on docente.id_docente=horario.id_docente 
 inner join curso on curso.id_curso=horario.id_curso
 inner join bloque on bloque.id_bloque=horario.id_bloque
 inner join ramo on ramo.id_ramo=horario.id_ramo
 inner join dia on dia.id_dia=horario.id_dia
 where horario.id_docente=:rol1 and horario.id_dia=3 order by horario.id_bloque');
$queryMiercoles->execute(['rol1'=>$rol1]);
$rowMiercoles=$queryMiercoles->fetchAll(PDO::FETCH_ASSOC);

$queryJueves=$db->connect()->prepare('SELECT dia.dia,docente.apellido,docente.nombre,curso.curso,bloque.bloque,ramo.ramo
FROM horario inner join docente on docente.id_docente=horario.id_docente 
 inner join curso on curso.id_curso=horario.id_curso
 inner join bloque on bloque.id_bloque=horario.id_bloque
 inner join ramo on ramo.id_ramo=horario.id_ramo
 inner join dia on dia.id_dia=horario.id_dia
 where horario.id_docente=:rol1 and horario.id_dia=4 order by horario.id_bloque');
$queryJueves->execute(['rol1'=>$rol1]);
$rowJueves=$queryJueves->fetchAll(PDO::FETCH_ASSOC);

$queryViernes=$db->connect()->prepare('SELECT dia.dia,docente.apellido,docente.nombre,curso.curso,bloque.bloque,ramo.ramo
FROM horario inner join docente on docente.id_docente=horario.id_docente 
 inner join curso on curso.id_curso=horario.id_curso
 inner join bloque on bloque.id_bloque=horario.id_bloque
 inner join ramo on ramo.id_ramo=horario.id_ramo
 inner join dia on dia.id_dia=horario.id_dia
 where horario.id_docente=:rol1 and horario.id_dia=5 order by horario.id_bloque');
$queryViernes->execute(['rol1'=>$rol1]);
$rowViernes=$queryViernes->fetchAll(PDO::FETCH_ASSOC);

?>