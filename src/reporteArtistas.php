<?php
require "fpdf/fpdf.php";
require_once "Logica/Artista.php";

$artista = new Artista();
$artistas = $artista->consultarTodosReporte();

$pdf = new FPDF("P", "mm", "Letter");
$pdf->SetFont("Arial", "B", 20);
$pdf->AddPage();
$pdf->SetXY(0, 0);
$pdf->Cell(216, 30, "FOCUS", 0, 2, "C");
$pdf->Cell(216, 15, "Lista de artistas", 0, 2, "C");
$pdf->Image('img/logo.png', 10, 10, 30);

$estado = "";
$image1 = "img/default.png";



$pdf->SetFont("Courier", "B", 10);
$pdf->SetFont('Arial', 'B', 12);

$pdf->Ln();


$pdf->Cell(30, 12, "Id", 0, 0, 'C', 0);
$pdf->Cell(30, 12, "Nombre", 0, 0, 'C', 0);
$pdf->Cell(30, 12, "Apellido", 0, 0, 'C', 0);
$pdf->Cell(40, 12, "Correo", 0, 0, 'C', 0);
$pdf->Cell(30, 12, "Estado", 0, 0, 'C', 0);
$pdf->Cell(25, 12, "Foto", 0, 1, 'C', 0);

$pdf->SetDrawColor(52, 152, 219);
$pdf->SetLineWidth(1);
$pdf->Line(10, 70, 195, 70);

$pdf->Ln();
$cont=0;
foreach ($artistas as $artistaActual) {
    
    if ($artistaActual->getFoto() != "") {
        $image1 = $artistaActual->getFoto();
    } else {
        $image1 = "img/default.png";
    }
        
    if ($artistaActual->getEstado()==1){
        $estado = "Activo";
    }else{
        $estado = "Inactivo";
    }

    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(40, 40, 40);
    $pdf->SetDrawColor(240, 240, 240);
    $pdf->SetFont('Arial', '', 12);
    
    $pdf->Cell(30, 20, $artistaActual->getIdArtista(), 1, 0, 'C', 1);
    $pdf->Cell(30, 20, $artistaActual->getNombre(), 1, 0, 'C');
    $pdf->Cell(30, 20, $artistaActual->getApellido(), 1, 0, 'C');
    $pdf->Cell(40, 20, $artistaActual->getCorreo(), 1, 0, 'C');
    $pdf->Cell(25, 20, $estado, 1, 0, 'C');
    

    $pdf->Cell(30, 20, $pdf->Image($image1, $pdf->GetX() + 5, $pdf->GetY() + 3, 14,), 1, 0, 'C', false);



    $pdf->Ln();
    if($cont==4){$pdf->AddPage(); $cont=0;}
}

$pdf->Output();


