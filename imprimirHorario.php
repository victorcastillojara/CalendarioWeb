<?php
require ('fpdf.php');
require "conReporte.php";
require "Rol.php";
require "horario.php";




class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {



        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(60);
        // Título

        $this->Cell(70, 10, 'Horario profesor', 0, 0, 'C');

        // Salto de línea
        $this->Ln(20);

        $this->Cell(30, 10, 'Bloque', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Lunes', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Martes', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Miercoles', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Jueves', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Viernes', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}


$consulta = "SELECT dia.dia,docente.apellido,docente.nombre,curso.curso,bloque.bloque,ramo.ramo
FROM horario inner join docente on docente.id_docente=horario.id_docente 
 inner join curso on curso.id_curso=horario.id_curso
 inner join bloque on bloque.id_bloque=horario.id_bloque
 inner join ramo on ramo.id_ramo=horario.id_ramo
 inner join dia on dia.id_dia=horario.id_dia
 where horario.id_docente=3";
$resultado = $mysqli->query($consulta);


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

while ($row = $resultado->fetch_assoc()) {

    $pdf->Cell(30, 10, $row['bloque'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10,utf8_decode($row['ramo'].' '.$row['curso']), 1, 1, 'C', 0);
}


$pdf->Output();
?>

<input type="hidden" name="id_usuario" value="<?php echo $rol1 ?>">