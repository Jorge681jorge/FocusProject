
<?php
include "plantilla.php";
//require "persistencia/Conexion.php";

//$query = "SELECT idfactura, ciudad, barrio, direccion, telefono, estado from envio";
//$resultado = $mysqli->query($query);
$tienda = new Tienda();
$tiendas = $tienda -> consultarTodos();



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();



$pdf->SetFillColor(255, 255, 255);

$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(30, 12, 'idtienda', 0, 0, 'C', 1);
$pdf->Cell(50, 12, 'nombre', 0, 0, 'C', 1);
$pdf->Cell(50, 12, 'Direccion', 0, 0, 'C', 1);


$pdf->SetDrawColor(46, 204, 113);
$pdf->SetLineWidth(1);
$pdf->Line(10, 62, 195, 62);
$pdf->Ln(3);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(40,40,40);
$pdf->SetDrawColor(240, 240, 240);
$pdf->SetFont('Arial', '', 12);
$cont=0;
$pdf->Ln();
foreach($tiendas as $tiendaActual)
{
   

   $pdf->Cell(30, 10, $tiendaActual->getIdtienda(), 1, 0, 'C', 1);
   $pdf->Cell(50, 10, $tiendaActual->getNombre(), 1, 0, 'C', 1);
   $pdf->Cell(50, 10, $tiendaActual->getDireccion(), 1, 0, 'C', 1);   
   $pdf->Ln();
   $cont++; 

   if($cont==16){$pdf->AddPage(); $cont=0;}
   
}

$pdf->Output();
?>
