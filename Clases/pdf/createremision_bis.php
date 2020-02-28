<?

require('fpdf.php');

class PDF extends FPDF
{
	
// Page header
function Header()
{
    // Logo
	//debe seleccionar de acuerdo a la compañia
    $this->Image('logo.jpg',10,5,70);
    // Arial bold 15
    //$this->SetFont('Arial','B',7);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-10);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    //$this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');
}
}			 
				 
			 $id=$_GET["cot"];
			 require("../Conexion/conexion_prueba_local.php");
			 require("../Objetos/cotizacion.php");
			 $pdf = new PDF();
			 ob_end_clean(); 
			 $link=conect();
			 $cotizacion=new Cotizacion();
			 $cotizacion->conexion($link);
			 //echo "Si sale?:".$id;
			 $array=$cotizacion->detalle($id);
			 if($array!=null)
			 { 
				//echo "que es esto".$array[1]; 
				
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->SetFont('Arial','',8);
				
				$datetime = strtotime($array[7]);
				$dia = date("d", $datetime);
				$mes = date("M", $datetime);
				$ano = date("Y", $datetime);
				$cabecera='Nezahualcoyotl, Edo. de Mexico a '.$dia.' de '.$mes.' del '.$ano;
				//$pdf->Cell(180-count($cabecera));
				$pdf->Text(140, 30,$cabecera);
				$pdf->Text(10,40, "Empresa:  ".$array[13]);
				$pdf->Text(175,40, "COTIZACION:___".$array[5]."___");
				$pdf->Text(10,50, "Dirección:  ");
				$pdf->Text(180,50,'HOJA: _____'.$pdf->PageNo().' de {nb}');
				$pdf->Text(10,50, "Dirección:  ");
				$pdf->Text(10,60, $array[12]);
				
				
    			// Line break
    			
				$pdf->Ln(10);
				$x1=10;
				$x2=200;
				$y1=60;
				$y2=60;
				for($cont=0;$cont<18;$cont++)
				{
					$pdf->Line($x1, $y1,$x2, $y2);
					$y1+=10;
					$y2+=10;
				}
				$pdf->Line(10, 60,10, 230);
				$pdf->Line(30, 60,30, 230);
				$pdf->Line(53, 60,53, 230);
				$pdf->Line(153, 60,153, 230);
				$pdf->Line(175, 60,175, 230);
				$pdf->Line(200, 60,200, 230);
				
				$pdf->Line(153, 230,153, 260);
				$pdf->Line(153, 238,200, 238);
				
				$pdf->Line(175, 230,175, 260);
				$pdf->Line(153, 246,200, 246);
				
				$pdf->Line(200, 230,200, 260);
				$pdf->Line(153, 254,200, 254);
	
				$pdf->SetFont('Arial','B',8);
				
				$pdf->Cell(1);
				$pdf->Cell(0, 90,'CANTIDAD',0,2);
				$pdf->Cell(21);
				$pdf->Cell(0, -90,'CAPACIDAD',0,2);
				$pdf->Cell(50);
				$pdf->Cell(0, 90,'DESCRIPCION',0,1);
				$pdf->Cell(150);
				$pdf->Cell(0, -90,'P/U',0,1);
				$pdf->Cell(170);
				$pdf->Cell(0, 90,'IMPORTE',0,1);
				
				$pdf->Output();
			 } 
			   else
			 	echo "Error al generar Vista Previa de Cotización:".$array;
				
		/*}
	}*/
//}
?>
