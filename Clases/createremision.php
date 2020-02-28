<?

require('pdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    $this->Image('pdf/logo.jpg',10,5,70);
}

// Page footer
function Footer()
{
    // Position at 1 cm from bottom
    $this->SetY(-10);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');
}
}			 

			$id=$_GET["cot"]; 
			$pdf = new PDF();
			 
			 include("Conexion/conexion_prueba_local.php");
			/*
			 require("../Objetos/cotizacion.php");
			 $link=conect();
			 $cotizacion=new Cotizacion();
			 $cotizacion->conexion($link);
			 //echo "Si sale?:".$id;
			 $array=$cotizacion->detalle($id);
			 if($array!=null)
			 {
			 */	 
				//echo "que es esto".$array[1]; 
				
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(20);
				$pdf->Cell(10, 0,'Nezahualcoyotl, Edo. de Mexico a '.$row[8].' de '.$row[9].' del '.$row[10],0,2,'R');
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
				$pdf->Line(153, 240,200, 240);
				
				$pdf->Line(175, 230,175, 260);
				$pdf->Line(153, 250,200, 250);
				
				$pdf->Line(200, 230,200, 260);
				$pdf->Line(153, 260,200, 260);
				/*$pdf->Line(10, 120,200, 120);
				$pdf->Line(10, 180,200, 180);
				$pdf->Line(10, 180,10, 110);
				$pdf->Line(30, 180,30, 110);
				$pdf->Line(120, 180,120, 110);
				$pdf->Line(160, 180,160, 110);
				$pdf->Line(200, 180,200, 110);*/
				$pdf->GetX();
				$pdf->GetY();
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
				/*$pdf->SetFont('Arial','',11);
				$pdf->Text(40, 130,'%PRODUCTO%');
				$pdf->Text(130, 130,'%UNIDAD%');
				$pdf->Text(170, 130,'%CANTIDAD%');
				
				$pdf->Text(40, 240,'');
				
				$pdf->SetFont('Arial','',8);
				$pdf->Text(40, 250,'RECIBI DE CONFORMIDAD:');
				$pdf->Line(30, 265,90, 265);
				$pdf->Text(50, 270,'Nombre y Firma');
				$pdf->Line(120, 250,200, 250);
				$pdf->Line(120, 265,200, 265);
				$pdf->Line(120, 250,120, 265);
				$pdf->Line(200, 265,200, 250);
				$pdf->SetFont('Arial','',12);
				$pdf->Text(125, 255,'FOLIO NO.');
				$pdf->SetFont('Arial','',9);
				$pdf->SetTextColor(204,0,0);
				$pdf->Text(122, 260,$id);
				$pdf->SetTextColor(0,0,0);
				*/
				/*for($i=1;$i<=40;$i++)
					$pdf->Cell(0,10,'Printing line number '.$i,0,1);*/
				$pdf->Output();
			 //}
			 /*
			   else
			 	echo "Error al generar Vista Previa de Cotización:".$array;
			*/	
		/*}
	}*/
//}
?>
