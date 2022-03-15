
<?php
include "plantilla.php";

$idObra = "";
if (isset($_GET["idObra"])) {
	$idObra = ($_GET["idObra"]);
}
$idAutor = "";
if (isset($_GET["idAutor"])) {
	$idAutor = ($_GET["idAutor"]);
}

 
$obraPdf = new Obra($idObra);
$obraPdf->consultar();

$obra_Version = new Obra_Version("", $idObra);
$obra_Versiones = $obra_Version->consultarTodos();

$artista = new Artista("$idAutor");
$artista->consultar();



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$image1 = "img/default.png";

$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(190, 10, $artista->getNombre() . " " . $artista->getApellido(), 0, 1, 'C');
$pdf->Cell(190, 10, "Obra: " . $obraPdf->getIdObra(), 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);

/* $pdf->Cell(30, 12, 'id', 0, 0, 'C', 1);
$pdf->Cell(30, 12, 'nombre', 0, 0, 'C', 1);
$pdf->Cell(30, 12, 'precio', 0, 0, 'C', 1);
$pdf->Cell(40, 12, 'idtienda', 0, 0, 'C', 1);
 */
$pdf->SetLineWidth(1);
$pdf->Ln(2);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(40, 40, 40);

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(38, 10, 'Estado general: ', 0, 0, 'R', 1);
$pdf->Cell(30, 10, $obraPdf->getEstado(), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(38, 10, 'Autor: ', 0, 0, 'R', 1);
$pdf->Cell(80, 10, $artista->getNombre() . " " . $artista->getApellido(), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(38, 10, 'Identificacion: ', 0, 0, 'R', 1);
$pdf->Cell(30, 10, $artista->getIdArtista(), 0, 0, 'L');
$pdf->Ln();
$pdf->SetDrawColor(46, 204, 113);
$pdf->Line(195, $pdf->GetY(), $pdf->GetX(), $pdf->GetY());


foreach ($obra_Versiones as $obraActual) {
	/* 	$obra_version = new Obra_Version("",$idObra);
	$od = $obra_version->consultarUltimaVersion();*/

	$ultima = new Version($obraActual->getIdVersion());
	$ultima->consultar();

	$pdf->Ln();
	$pdf->Cell(38, 10, 'Fecha: ', 0, 0, 'R', 1);
	$pdf->Cell(38, 10, $ultima->getFecha(), 0, 0, 'L');
	$pdf->Cell(9, 10, 'Hora: ', 0, 0, 'R', 1);
	$pdf->Cell(38, 10, $ultima->getHora(), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(38, 06, 'Titulo: ', 0, 0, 'R', 1);
	$pdf->Cell(80, 06, $ultima->getTitulo(), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(38, 10, 'Version: ', 0, 0, 'R', 1);
	$pdf->Cell(30, 10, $ultima->getIdVersion(), 0, 0, 'L');
	$pdf->Cell(20, 10, 'Estado:', 0, 0, 'R', 1);
	$pdf->Cell(30, 10, $ultima->getEstado(), 0, 0, 'L');

	$pdf->Ln();
	$pdf->Cell(38, 10, 'Obra: ', 0, 0, 'R', 1);
	if ($ultima->getFoto() != "") {
		$image1 = $ultima->getFoto();
	} else {
		$image1 = "img/default.png";
	}
	$pdf->Cell(80, 95, $pdf->Image($image1, $pdf->GetX() + 5, $pdf->GetY() + 3, "", 90), 0, 0, 'C', false);
	$pdf->Ln();
	$pdf->Cell(38, 06, 'Descripcion: ', 0, 0, 'R', 1);
	$pdf->MultiCell(150, 06, $ultima->getDescripcion(), 0, 1, 'L');
	$pdf->Ln();
	$pdf->Cell(38, 06, 'Valor: $', 0, 0, 'R', 1);
	$pdf->Cell(30, 06, $ultima->getValor(), 0, 0, 'L');


	$pdf->Ln();
	if (230 <= $pdf->GetY()) {
		$pdf->AddPage();
	}

	$comentario = new Comentario("", "", $ultima->getIdVersion());
	$comentarios = $comentario->consultarTodosVersion();
	$contador=0;
	foreach ($comentarios as $comentarioActual) {
		$critico = new Critico($comentarioActual->getIdUsuario());
		$critico->consultar();
		
		if (230 <= $pdf->GetY()) {
			$pdf->AddPage();
		}else{
			$pdf->Ln();
		}
		$pdf->Cell(38, 10, 'Critico: ', 0, 0, 'R', 1);
		$pdf->Cell(30, 10, $critico->getNombre() . $critico->getApellido(), 0, 0, 'L');
		$pdf->Cell(38, 10, 'Identificacion: ', 0, 0, 'R', 1);
		$pdf->Cell(30, 10, $critico->getIdCritico(), 0, 0, 'L');
		
		if (230 <= $pdf->GetY()) {
			$pdf->AddPage();
		}else{
			$pdf->Ln();
		}
		$pdf->Cell(30, 06, 'Comentario: ', 0, 0, 'R', 1);
		$pdf->MultiCell(150, 06, $comentarioActual->getComentario(), 0, 1, 'L');
		$pdf->Ln();
		if (230 <= $pdf->GetY()) {
			$pdf->AddPage();
		}
		$pdf->Cell(30, 06, 'Fecha: ', 0, 0, 'R', 1);
		$pdf->Cell(30, 06, $comentarioActual->getFecha(), 0, 0, 'L');

		$pdf->Cell(30, 06, 'Hora: ', 0, 0, 'R', 1);
		$pdf->Cell(30, 06, $comentarioActual->getHora(), 0, 1, 'L');
		if (230 <= $pdf->GetY()) {
			$pdf->AddPage();
		}
		$contador ++;
	}
	
	if($contador==0){
		$pdf->Ln();
		$pdf->Cell(40, 06, 'No hay comentarios ', 0, 0, 'R', 1);	}
		$pdf->Ln();
	if (230 <= $pdf->GetY()) {
		$pdf->AddPage();
	}
	$pdf->SetDrawColor(46, 204, 113);
	$pdf->Line(195, $pdf->GetY(), $pdf->GetX(), $pdf->GetY());
}


$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(40, 40, 40);
$pdf->SetDrawColor(240, 240, 240);
$pdf->SetFont('Arial', '', 12);
$cont = 0;
$pdf->Ln();

$pdf->Output();
?>
