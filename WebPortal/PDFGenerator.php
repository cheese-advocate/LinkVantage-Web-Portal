<?php
ob_start();
require('./FPDF/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40,10,'Hello World');
$pdf->Cell(60,10,'Powered by FPDF.',0,1,'C');
for($i=1;$i<=40;$i++){
    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
} 
$pdf->Output();
ob_end_flush();