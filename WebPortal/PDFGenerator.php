<?php
ob_start();
require('./FPDF/fpdf.php');
require_once 'config.php';

$client_count = getClientCount();
$job_count = getJobCount();
$company_count = getCompanyCount();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(0, 5, $pdf->Image('images/logo_block_cropped.png', 93, 3, 25, 25), 0, 1, 'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0 ,5,'Report',0,1, "C");
$pdf->Ln();

$pdf->SetFont('Arial','B',15);
$pdf->Cell(59 ,5,'Details',0,1);
$pdf->Ln();

$pdf->SetFont('Arial','',10);

$pdf->Cell(25 ,5,'Report Date:',0,0);
$pdf->Cell(34 ,5, date("d-m-yy"),0,1);
$pdf->Ln();


$pdf->SetFont('Arial','B',15);
$pdf->Cell(130 ,5,'Information',0,0);
$pdf->Cell(59 ,5,'',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(189 ,10,'',0,1);


$pdf->SetFont('Arial','B',10);
/*Heading Of the table*/
$pdf->Cell(80 ,6,'Description',1,0,'L');
$pdf->Cell(23 ,6,'Qty',1,0,'R');
$pdf->Cell(25 ,6,'Total',1,1,'R');/*end of line*/
/*Heading Of the table end*/
$pdf->SetFont('Arial','',10);

/*TABLE CONTENT*/
$pdf->Cell(80 ,6,'Client Count',1,0);
$pdf->Cell(23 ,6,'N/A',1,0,'R');
$pdf->Cell(25 ,6,$client_count,1,1,'R');

$pdf->Cell(80 ,6,'Company Count',1,0);
$pdf->Cell(23 ,6,'N/A',1,0,'R');
$pdf->Cell(25 ,6,$company_count,1,1,'R');

$pdf->Cell(80 ,6,'Job Count',1,0);
$pdf->Cell(23 ,6,'N/A',1,0,'R');
$pdf->Cell(25 ,6,$job_count,1,1,'R');

$pdf->Output();
ob_end_flush();