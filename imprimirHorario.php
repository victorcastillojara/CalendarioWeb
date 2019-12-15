<?php
require('fpdf.php');


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Horario de Profesor',0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(30,10,'Bloque',1,0,'C',0);
    $this->Cell(30,10,'Lunes',1,0,'C',0);
    $this->Cell(30,10,'Martes',1,0,'C',0);
    $this->Cell(30,10,'Miercoles',1,0,'C',0);
    $this->Cell(30,10,'Jueves',1,0,'C',0);
    $this->Cell(30,10,'Viernes',1,1,'C',0);

    
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}
require "conReporte.php";
require "Rol.php";
require "horario.php";

$consulta="SELECT * FROM bloque";
$resultado=$mysqli->query($consulta);


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

while($row = $resultado->fetch_assoc()){
    
    $pdf->Cell(30,10,$row['bloque'],1,1,'C',0);   
}
 

$pdf->Output();
?>

<input type="hidden" name="id_usuario" value="<?php echo $rol1 ?>">