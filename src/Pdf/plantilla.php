<?php
require 'libreria/fpdf.php';

class PDF extends FPDF
{
	function Header()
	{

		$this->SetFont('Arial', 'B', 15);
		$this->Cell(30);
		$this->Cell(130, 10, 'FOCUS', 0, 1, 'C');
		$this->SetFont('Arial', '', 15);
		$this->Cell(190, 10, 'Proceso publicacion de obras', 0, 1, 'C');
		$this->SetFont('Arial', 'B', 15);

		$this->SetDrawColor(36, 113, 163);
		$this->SetLineWidth(1);
		$this->Line(10, 40, 195, 40);

		$this->Cell(190, 10, 'Reporte', 0, 0, 'C');

		$this->Image('img/logo.png', 10, 10, 30);

		$this->Ln(10);
	}

	function Footer()
	{
		$this->SetY(-50);
		/* 	$this->Cell(190, 10, 'FOCUS', 0, 1,'C');
		$this->Cell(190, 10, 'Focus@gmail.com', 0, 0,'C'); */
		$this->SetDrawColor(23, 32, 42);
		$this->SetLineWidth(1);
	/* 	$this->Line(10, 270, 195, 270); */
		$this->SetY(-15);
		$this->SetFont('Arial', 'I', 8);
		$this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
}
