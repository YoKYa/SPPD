<?php
include(app_path().'\FPDF\fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',80);
$pdf->Page('3');
$pdf->Cell(40,90,'Hello World!');
$pdf->Output();
exit;
?>
