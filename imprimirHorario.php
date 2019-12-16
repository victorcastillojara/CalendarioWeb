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
        $this->SetFont('Arial', 'B', 10);
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

include 'horario.php';

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);



$pdf->Cell(30, 10,"8:00 a 9:15", 1, 0, 'C', 0);
if ($rowLunes != null && $rowLunes[0]['bloque'] == "8:00 a 9:30") {
    $pdf->MultiCell(30,5,utf8_decode($rowLunes[0]['curso'].' '.$rowLunes[0]['ramo']), 1,'C',0);
}

if ($rowMartes != null && $rowMartes[0]['bloque'] == "8:00 a 9:30"){
    $pdf->SetY(40);
    $pdf->SetX(70);
    $pdf->MultiCell(30, 5,utf8_decode($rowMartes[0]['curso'].' '.$rowMartes[0]['ramo']), 1,'C',0); 
} 

if ($rowMiercoles != null && $rowMiercoles[0]['bloque'] == "8:00 a 9:30"){
    $pdf->SetY(40);
    $pdf->SetX(100);
    $pdf->MultiCell(30, 5,utf8_decode($rowMiercoles[0]['curso'].' '.$rowMiercoles[0]['ramo']), 1,'C',0); 
} 
if ($rowJueves != null && $rowJueves[0]['bloque'] == "8:00 a 9:30"){
    $pdf->SetY(40);
    $pdf->SetX(130);
    $pdf->MultiCell(30, 5,utf8_decode($rowJueves[0]['curso'].' '.$rowJueves[0]['ramo']), 1,'C',0); 
} 
if ($rowViernes != null && $rowViernes[0]['bloque'] == "8:00 a 9:30"){
    $pdf->SetY(40);
    $pdf->SetX(160);
    $pdf->MultiCell(30, 5,utf8_decode($rowViernes[0]['curso'].' '.$rowViernes[0]['ramo']),1,'C',0); 
} 


$pdf->Cell(30, 10,"9:45 a 11:15", 1, 0, 'C', 0);
if ($rowLunes != null && $rowLunes[1]['bloque'] == "9:45 a 11:15"){
    $pdf->MultiCell(30, 5,utf8_decode($rowLunes[1]['curso'].' '.$rowLunes[1]['ramo']), 1,'C',0);
} 
if ($rowMartes != null && $rowMartes[1]['bloque'] == "9:45 a 11:15"){
    $pdf->SetY(60);
    $pdf->SetX(70);
    $pdf->MultiCell(30, 5,utf8_decode($rowMartes[1]['curso'].' '.$rowMartes[1]['ramo']), 1,'C',0);
} 
if ($rowMiercoles != null && $rowMiercoles[1]['bloque'] == "9:45 a 11:15"){
    $pdf->SetY(60);
    $pdf->SetX(100);
    $pdf->MultiCell(30, 5,utf8_decode($rowMiercoles[1]['curso'].' '.$rowMiercoles[1]['ramo']), 1,'C',0);
} 
if ($rowJueves != null && $rowJueves[1]['bloque'] == "9:45 a 11:15"){
    $pdf->SetY(60);
    $pdf->SetX(130);
    $pdf->MultiCell(30, 5,utf8_decode($rowJueves[1]['curso'].' '.$rowJueves[1]['ramo']), 1,'C',0);
} 
if ($rowViernes != null && $rowViernes[1]['bloque'] == "9:45 a 11:15"){
    $pdf->SetY(60);
    $pdf->SetX(160);
    $pdf->MultiCell(30, 5,utf8_decode($rowViernes[1]['curso'].' '.$rowViernes[1 ]['ramo']), 1,'C',0);
} 


    $pdf->Cell(30, 10,"11:30 a 12:45", 1, 0, 'C', 0);
    if ($rowLunes != null && $rowLunes[2]['bloque'] == "11:30 a 12:45"){
        $pdf->MultiCell(30, 5,utf8_decode($rowLunes[2]['curso'].' '.$rowLunes[2]['ramo']), 1,'C',0);
    } 
    if ($rowMartes != null && $rowMartes[2]['bloque'] == "11:30 a 12:45"){
        $pdf->SetY(80);
        $pdf->SetX(70);
        $pdf->MultiCell(30, 5,utf8_decode($rowMartes[2]['curso'].' '.$rowMartes[2]['ramo']), 1,'C',0);
    } 
    if ($rowMiercoles != null && $rowMiercoles[2]['bloque'] == "11:30 a 12:45"){
        $pdf->SetY(80);
        $pdf->SetX(100);
        $pdf->MultiCell(30, 5,utf8_decode($rowMiercoles[2]['curso'].' '.$rowMiercoles[2]['ramo']), 1,'C',0);
    } 
    if ($rowJueves != null && $rowJueves[2]['bloque'] == "11:30 a 12:45"){
        $pdf->SetY(80);
        $pdf->SetX(130);
        $pdf->MultiCell(30, 5,utf8_decode($rowJueves[2]['curso'].' '.$rowJueves[2]['ramo']), 1,'C',0);
    } 
    if ($rowViernes != null && $rowViernes[2]['bloque'] == "11:30 a 12:45"){
        $pdf->SetY(80);
        $pdf->SetX(160);
        $pdf->MultiCell(30, 5,utf8_decode($rowViernes[2]['curso'].' '.$rowViernes[2]['ramo']), 1,'C',0);
    } 


    $pdf->Cell(30, 10,"14:00 a 15:30", 1, 0, 'C', 0);
    if ($rowLunes != null && $rowLunes[3]['bloque'] == "14:00 a 15:30"){
        $pdf->MultiCell(30, 10,utf8_decode($rowLunes[3]['curso'].' '.$rowLunes[3]['ramo']), 1,'C',0);
    }   
    if ($rowMartes != null && $rowMartes[3]['bloque'] == "14:00 a 15:30"){
        $pdf->SetY(100);
        $pdf->SetX(70);
        $pdf->MultiCell(30, 6.7,utf8_decode($rowMartes[3]['curso'].' '.$rowMartes[3]['ramo']), 1,'C',0);
    } 
    if ($rowMiercoles != null && $rowMiercoles[3]['bloque'] == "14:00 a 15:30"){
        $pdf->SetY(100);
        $pdf->SetX(100);
        $pdf->MultiCell(30, 10,utf8_decode($rowMiercoles[3]['curso'].' '.$rowMiercoles[3]['ramo']), 1,'C',0);
    } 
    if ($rowJueves != null && $rowJueves[3]['bloque'] == "14:00 a 15:30"){
        $pdf->SetY(100);
        $pdf->SetX(130);
        $pdf->MultiCell(30, 6.7,utf8_decode($rowJueves[3]['curso'].' '.$rowJueves[3]['ramo']), 1,'C',0);
    } 
    if ($rowViernes != null && $rowViernes[3]['bloque'] == "14:00 a 15:30"){
        $pdf->SetY(100);
        $pdf->SetX(160);
        $pdf->MultiCell(30, 6.7,utf8_decode($rowViernes[3]['curso'].' '.$rowViernes[3]['ramo']), 1,'C',0);
    } 
    
    $pdf->Cell(30, 20,"15:45 a 17:00", 1, 0, 'C', 0);
    if ($rowLunes != null && $rowLunes[4]['bloque'] == "15:45 a 17:00"){
        $pdf->MultiCell(30, 10,utf8_decode($rowLunes[4]['curso'].' '.$rowLunes[4]['ramo']), 1,'C',0);
    } 
    if ($rowMartes != null && $rowMartes[4]['bloque'] == "15:45 a 17:00"){
        $pdf->SetY(120);
        $pdf->SetX(70);
        $pdf->MultiCell(30, 10,utf8_decode($rowMartes[4]['curso'].' '.$rowMartes[4]['ramo']), 1,'C',0);
    } 
    if ($rowMiercoles != null && $rowMiercoles[4]['bloque'] == "15:45 a 17:00"){
        $pdf->SetY(120);
        $pdf->SetX(100);
        $pdf->MultiCell(30, 6.7,utf8_decode($rowMiercoles[4]['curso'].' '.$rowMiercoles[4]['ramo']), 1,'C',0);
    } 
    if ($rowJueves != null && $rowJueves[4]['bloque'] == "15:45 a 17:00"){
        $pdf->SetY(120);
        $pdf->SetX(130);
        $pdf->MultiCell(30, 10,utf8_decode($rowJueves[4]['curso'].' '.$rowJueves[4]['ramo']), 1,'C',0);
    } 
    if ($rowViernes != null && $rowViernes[4]['bloque'] == "15:45 a 17:00"){
        $pdf->SetY(120);
        $pdf->SetX(160);
        $pdf->MultiCell(30, 6.7,utf8_decode($rowViernes[4]['curso'].' '.$rowViernes[4]['ramo']), 1,'C',0);
    }
$pdf->Output();
?>