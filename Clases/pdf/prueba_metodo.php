<?
include("createremision.php");

function salvaCotizacion($cot)
{
	$pdf=new PDF();
	return $pdf->printandsave($cot);
}
?>