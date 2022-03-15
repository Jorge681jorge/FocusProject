<?php
require "fpdf/fpdf.php";
require_once "Logica/Obra.php";
require_once "Logica/Version.php";
require_once "Logica/Obra_Version.php";

$obra = new Obra();
$obra_Version = new Obra_Version();
$obras = $obra->consultarTodos();

$pdf = new FPDF("P", "mm", "Letter");
$pdf->SetFont("Arial", "B", 20);
$pdf->AddPage();
$pdf->SetXY(0, 0);
$pdf->Cell(216, 30, "FOCUS", 0, 2, "C");
$pdf->Cell(216, 15, "Lista de obras", 0, 2, "C");
$pdf->Image('img/logo.png', 10, 10, 30);

$image1 = "img/default.png";

$pdf->SetFont("Courier", "B", 10);
$pdf->SetFont('Arial', 'B', 12);

$pdf->Ln();

$pdf->Cell(38, 12, "IdObra", 0, 0, 'C', 0);
$pdf->Cell(30, 12, "Titulo", 0, 0, 'C', 0);
$pdf->Cell(30, 12, "Descripcion", 0, 0, 'C', 0);
$pdf->Cell(28, 12, "Valor", 0, 0, 'C', 0);
$pdf->Cell(30, 12, "Fecha", 0, 0, 'C', 0);
$pdf->Cell(30, 12, "Foto", 0, 1, 'C', 0);

$pdf->SetDrawColor(52, 152, 219);
$pdf->SetLineWidth(1);
$pdf->Line(10, 70, 195, 70);

$pdf->Ln();
$cont = 0;
foreach ($obras as $obraActual) {

    $obra_version = new Obra_Version("", $obraActual->getIdObra());
    $od = $obra_version->consultarUltimaVersion();
    $ultima = new Version($od->getIdVersion());
    $ultima->consultar();

    if ($ultima->getFoto() != "") {
        $image1 = $ultima->getFoto();
    } else {
        $image1 = "img/default.png";
    }

    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(40, 40, 40);
    $pdf->SetDrawColor(240, 240, 240);
    $pdf->SetFont('Arial', '', 12);
    
    $pdf->Cell(38, 40, $obra_version->getIdObra(), 1, 0, 'C', 1);
    $pdf->Cell(30, 40, $ultima->getTitulo(), 1, 0, 'C');
    $pdf->Cell(30, 40, $ultima->getDescripcion(), 1, 0, 'C');
    $pdf->Cell(28, 40, $ultima->getValor(), 1, 0, 'C');
    $pdf->Cell(30, 40, $ultima->getFecha(), 1, 0, 'C');
    

    $pdf->Cell(30, 40, $pdf->Image($image1, $pdf->GetX() + 5, $pdf->GetY() + 3, 20,), 1, 0, 'C', false);



    $pdf->Ln();
    if($cont==4){$pdf->AddPage(); $cont=0;}
}

$pdf->Output();
