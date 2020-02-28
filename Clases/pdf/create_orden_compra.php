<?

require('fpdf_orden_compra.php');

class PDF extends FPDF
{
	
public $arreglo=null;
public $detalle=null;
public $final_y=0;	
public $usuario=null;
public $cliente=null;
public $proveedor=null;

function loadData($id)
{


 	 require_once("../Conexion/conexion_prueba_local.php");
	 require_once("../Objetos/cotizacion.php");
	 require_once("../Objetos/detalle_cotizacion.php");
	 require_once("../Objetos/usuario.php");
	 require_once("../Objetos/cliente.php");
	 require_once("../Objetos/proveedor.php");
	 require_once("../Objetos/orden_compra.php");
	 require_once("../Objetos/detalle_ordencompra.php");

	 $link=conect();


	 $orden_compra=new Orden_Compra();
	 $orden_compra->conexion($link);
	 $this->arreglo=$orden_compra->detalle($id);

	 $ord_detalle=new Detalle_ordencompra();
	 $ord_detalle->conexion($link);
	 $this->detalle=$ord_detalle->busqueda_detalle($id);

	  $proveedor=new Proveedor();
	 $proveedor->conexion($link);
	 $this->proveedor=$proveedor->detalle_print($this->arreglo[2]);

	 $usuario=new Usuario();
	 $usuario->conexion($link);
	 $this->usuario=$usuario->print_generales($this->arreglo[1]);
	 $cliente=new Cliente();
	 $cliente->conexion($link);
	 $this->cliente=$cliente->detalle_print($this->arreglo[2]);
	 
}

function loadData2($id)
{
	 
	 $link=conect();
	 

	 $orden_compra=new Orden_Compra();
	 $orden_compra->conexion($link);
	 $this->arreglo=$orden_compra->detalle($id);

	 $ord_detalle=new Detalle_ordencompra();
	 $ord_detalle->conexion($link);
	 $this->detalle=$ord_detalle->busqueda_detalle($id);

	  $proveedor=new Proveedor();
	 $proveedor->conexion($link);
	 $this->proveedor=$proveedor->detalle_print($this->arreglo[2]);

/*
	 $cot_detalle=new Detalle_Cotizacion();
	 $cot_detalle->conexion($link);
	 $cot_detalle->detalle($id);
	 $this->detalle=$cot_detalle->busqueda_detalle($id);
*/

	 $usuario=new Usuario();
	 $usuario->conexion($link);
	 $this->usuario=$usuario->print_generales($this->arreglo[1]);

	 $cliente=new Cliente();
	 $cliente->conexion($link);
	 $this->cliente=$cliente->detalle_print($this->arreglo[2]);
	 


	 
}

function printDetalle($inicio, $fin){
	$subtotal=0;
	$y_inical = 120;
	            $x1=10;
				$x2=200;
				$y1=$y_inical;
				$y2=$y_inical;
				$limite=$fin-$inicio;
				for($cont=0;$cont<$limite+2;$cont++)
				{
					$this->Line($x1, $y1,$x2, $y2);
					
					$y1+=10;
					$y2+=10;
				}
				$y2=$y2-10;
				$this->Line(10, $y_inical,10, $y2);
				$this->Line(26, $y_inical,26, $y2);
				$this->Line(45, $y_inical,45, $y2);
				$this->Line(76, $y_inical,76, $y2);
				$this->Line(153, $y_inical,153, $y2);
				$this->Line(175, $y_inical,175, $y2);
				$this->Line(200, $y_inical,200, $y2);


				$this->Line(153, $y2,153, $y2+40);
				$this->Line(153, $y2+8,200, $y2+8);
				$this->Line(175, $y2,175, $y2+40);
				$this->Line(153, $y2+16,200, $y2+16);
				$this->Line(200, $y2,200, $y2+40);
				$this->Line(153, $y2+24,200, $y2+24);

				$this->Line(153, $y2+32,200, $y2+32);
				$this->Line(153, $y2+40,200, $y2+40);
				
				$this->SetFont('Arial','B',8);
			    $x=array(12, 28, 47, 158, 180);
				$y_i=$y_inical+5;
				$this->Text($x[0], $y_i,'PARTIDA');
				$this->Text($x[1], $y_i,'CANTIDAD');
				$this->Text($x[2]+6, $y_i,'UNIDAD');
				$this->Text($x[2]+60, $y_i,utf8_decode('DESCRIPCIÓN'));
				$this->Text($x[3], $y_i,'PRECIO');
				$this->Text($x[3]-1.5, $y_i+3,'UNITARIO');
				$this->text($x[4], $y_i,'IMPORTE');

				$this->Text($x[2], $y2+5,utf8_decode('AUTORIZADO POR DEPARTAMENTO DE COMPRAS'));

				$this->Text($x[3]-5, $y2+5,'SUBTOTAL');
				$this->Text($x[3]-5, $y2+13,'I.V.A. 16%');

				$this->Text($x[3]-5, $y2+21,'RET. 4% IVA');
				$this->Text($x[3]-5, $y2+29,'DESCUENTO');


				$this->Text($x[3]-5, $y2+37,'TOTAL');
				$this->SetFont('Arial','',6);
				for($cont=$inicio;$cont<$fin;$cont++)
				{
					$y_i+=10;
					$precio=$this->detalle[$cont][5];
					$importe=$precio*$this->detalle[$cont][2];
					$subtotal+=$importe;
					$this->Text($x[0]+3, $y_i,$cont+1);
					$this->Text($x[1]+3, $y_i,$this->detalle[$cont][2]);
					$this->Text($x[2], $y_i,$this->detalle[$cont][8]); // UNIDAD
					$this->Text($x[2]+30, $y_i,$this->detalle[$cont][7]);
					$this->Text($x[2]+30, $y_i+3,"(".$this->detalle[$cont][4].")");
					$this->Text($x[3], $y_i,"$".number_format($precio, 2, '.', ''));
					$this->Text($x[4], $y_i,"$".number_format($importe, 2, '.', ''));
				}
				$this->Text($x[4], $y2+5,"$".number_format($subtotal, 2, '.', ''));
				$this->Text($x[4], $y2+13,"$".number_format($subtotal*0.16, 2, '.', ''));
				$this->Text($x[4], $y2+37,"$".number_format($subtotal*1.16, 2, '.', ''));
				$this->final_y=$y2;

				$this->SetFont('Arial','B',8);
				$this->Text(10,$this->final_y+=47, utf8_decode("ESPECIFICACIONES ESPECIALES:"));
				$this->SetFont('Arial','',8);
				$this->Text(10,$this->final_y+=5, utf8_decode($this->arreglo[5]));
}


// Page header
function Header()
{
	
    // Logo
	//debe seleccionar de acuerdo a la compañia
	  $this->Image('../../upload/empresas/'.$this->arreglo[15].'/cotizacion.png',10,7,190);
    

	$this->SetFont('Arial','',6);	
    /* direccion DF */
    $this->Text(145,10, utf8_decode("Ignacio Manual Altamirano 114 int 302 B Col. San Rafael"));
    $this->Text(182.5,12, utf8_decode("DFel. Cuahutémoc"));
    $this->Text(181,14, utf8_decode("México D.F. 06470"));
    $this->Text(160.5,16, utf8_decode("Tel(s) (55) 5535 23 31 y (55) 5705 14 16"));
    $this->Text(176,18, utf8_decode("R.F.C.: MLF0711057D9"));
  //  $this->Image('../../upload/empresas/3/3.png',10,5,70);
    
	$this->SetFont('Arial','',8);	
	$datetime = strtotime($this->arreglo[4]);
	$dia = date("d", $datetime);
	$mes = date("M", $datetime);
	$ano = date("Y", $datetime);

	$mes = str_replace("Jan","Enero",$mes);
$mes = str_replace("Feb","Febrero",$mes);
$mes = str_replace("Mar","Marzo",$mes);
$mes = str_replace("Apr","Abril",$mes);
$mes = str_replace("May","Mayo",$mes);
$mes = str_replace("Jun","Junio",$mes);
$mes = str_replace("Jul","Julio",$mes);
$mes = str_replace("Aug","Agosto",$mes);
$mes = str_replace("Sep","Septiembre",$mes);
$mes = str_replace("Oct","Octubre",$mes);
$mes = str_replace("Nov","Noviembre",$mes);
$mes = str_replace("Dec","Diciembre",$mes);

$datetime_2 = strtotime($this->arreglo[3]);
	$dia_2 = date("d", $datetime_2);
	$mes_2 = date("M", $datetime_2);
	$ano_2 = date("Y", $datetime_2);

	$mes_2 = str_replace("Jan","Enero",$mes_2);
$mes_2 = str_replace("Feb","Febrero",$mes_2);
$mes_2 = str_replace("Mar","Marzo",$mes_2);
$mes_2 = str_replace("Apr","Abril",$mes_2);
$mes_2 = str_replace("May","Mayo",$mes_2);
$mes_2 = str_replace("Jun","Junio",$mes_2);
$mes_2 = str_replace("Jul","Julio",$mes_2);
$mes_2 = str_replace("Aug","Agosto",$mes_2);
$mes_2 = str_replace("Sep","Septiembre",$mes_2);
$mes_2 = str_replace("Oct","Octubre",$mes_2);
$mes_2 = str_replace("Nov","Noviembre",$mes_2);
$mes_2 = str_replace("Dec","Diciembre",$mes_2);

$y_header=20;

/*
	$y_header =$y_header+ 3;
$this->Text(40,$y_header, utf8_decode('CALLE IGNACIO MANUEL ALTAMIRANO NO. 114 - 302"B" COL. SAN RAFAEL MEXICO, D. F. C.P. 06470'
));
	$y_header =$y_header+ 3;
$this->Text(50,$y_header, utf8_decode('RFC: MFL 0711057D9       TEL. (55) 5535-2331,  (55) 5705-1416   (55) 5535-5155'
));
	$y_header =$y_header+ 3;
$this->Text(60,$y_header, utf8_decode('regina.rodriguez@mogelfluidos.com          rosarodriguez@mogel.com.mx'
));
*/
	$y_header = $y_header + 15;
	$this->SetFont('Arial','B',14);
	$this->Text(80,$y_header, utf8_decode("ORDEN DE COMPRA"));
	$this->SetFont('Arial','',8);


	$y_header= $y_header + 15;
$this->Text(10,$y_header, utf8_decode("NO. DE CONTROL:  FO-GC-04"));
//$this->Text(130,$y_header,utf8_decode('FECHA DE SOLICITUD: '.$dia.' de '.$mes.' del '.$ano));

$y_header= $y_header + 5;
$this->Text(10,$y_header, utf8_decode("VERSIÓN:                1"));
//	$this->Text(130,$y_header, utf8_decode("REQUISICIÓN NO: ".$this->arreglo[10].""));

	$this->SetFont('Arial','B',8);
$this->Text(10,$y_header+=10, utf8_decode("PROVEEDOR: "));
$this->Text(170,$y_header, utf8_decode("HOJA: "));
$this->SetFont('Arial','',8);


$this->Text(10,$y_header+=5, utf8_decode($this->proveedor[1]));
$this->Text(172,$y_header, utf8_decode("1/2"));

	$this->SetFont('Arial','B',8);
$this->Text(10,$y_header+=5, utf8_decode("ATENCIÓN: "));
$this->Text(160,$y_header, utf8_decode("ORDEN DE COMPRA "));
$this->SetFont('Arial','',8);

$this->Text(10,$y_header+=5, utf8_decode($this->arreglo[12]));
$this->Text(166,$y_header, utf8_decode($this->arreglo[11]));

	$this->SetFont('Arial','B',6);
$this->Text(10,$y_header+=5, utf8_decode("FECHA DE ENTREGA DEL PRODUCTO/SERVICIO "));
	$this->SetFont('Arial','B',8);

if ($this->arreglo[17]==1)
	$certificado = "SI";
else
	$certificado = "NO";
$this->Text(70,$y_header, utf8_decode("CONDICIONES DE PAGO "));
$this->Text(125,$y_header, utf8_decode("GARANTÍA "));

$this->Text(160,$y_header, utf8_decode("FECHA DE EXPEDICION "));
$this->SetFont('Arial','',8);


$this->Text(10,$y_header+5, utf8_decode($dia.' de '.$mes.' del '.$ano));
$this->Text(75,$y_header+5, utf8_decode($this->arreglo[16]));
$this->Text(130,$y_header+5, utf8_decode($certificado));
$this->Text(160,$y_header+=5, utf8_decode($dia_2.' de '.$mes_2.' del '.$ano_2));

$this->SetFont('Arial','B',8);


$this->Text(10,$y_header+10, utf8_decode("ENCARGADO DE RECIBIR EL"));
	
$this->Text(60,$y_header+10, utf8_decode("NOMBRE: "));

$this->SetFont('Arial','',8);
$this->Text(80,$y_header+=10, utf8_decode($this->arreglo[18]));
$this->SetFont('Arial','B',8);

$this->Text(12,$y_header+=5, utf8_decode("PRODUCTO Y/O SERVICIO"));
$this->Text(60,$y_header, utf8_decode("DOMICILIO:"));
$this->SetFont('Arial','',8);

$this->Text(80,$y_header, utf8_decode($this->arreglo[19]));

	$this->SetFont('Arial','B',8);
	$this->Text(22,$y_header+=5, utf8_decode("ADQUIRIDO"));

$this->SetFont('Arial','',8);


}

function final_doc()
{


	/* USUARIO!!!
	$this->Text(100,$this->final_y+=3, utf8_decode($this->usuario[0]." ".$this->usuario[1]." ".$this->usuario[2]));
	*/
	}


function Footer()
{

    $this->SetY(-10);
	$this->Line(10, $this->GetY()-5,200, $this->GetY()-5);
	$this->SetFont('Arial','',6);
	$this->Text(10,$this->GetY(), utf8_decode("
* Los Términos y Condiciones Generales de Compra se encuentran al final del presente documento y son considerados como parte integral del mismo."));
	$this->Text(10,$this->GetY()+3, utf8_decode("* Todas las entregas, sean bienes o servicios, deberán ser acompañadas de una remisión o documento de registro de la recepción del servicio.  ."));
/*
	$this->Text(10,$this->GetY()+6, "C.P. 57140");
	$this->Text(10,$this->GetY()+9, "MUNICIPIO DE NEZAHUALCOYOTL");
*/
   
}

	function printandsave($cot)
	{
			 
			 $this->loadData($cot);
			 ob_end_clean();
			 $this->AliasNbPages();
			 $tamano=count($this->detalle);
			 $cuanto=$tamano/15;	 
			 for($x=0;$x<$cuanto;$x++)
			 {
				 $inicio= $x * 15;
				 if($inicio+15<$tamano)
				 	$fin= $inicio+15;
				 else
				 	$fin=($tamano-$inicio)+$inicio;	
				 $this->AddPage();
				 $this->printDetalle($inicio,$fin);
			 }
			 $this->final_doc();
			 $user=$this->arreglo[1];
			 $folio=$this->arreglo[11];
			 
			 //$filename="../../upload/$user/$cot/cotizacion_$folio";
			 //echo getcwd();
			 
			 $filename="../pdf/tmp/orden_compra$folio";
			 $this->Output($filename.'.pdf','F');
			 return $folio;
			 //chmod("../../upload/$user/$cot/", 755);
	}
}			 
				 
			 $pdf = new PDF();
			 if(!empty($_GET["ord"]))
			 {
			 $pdf->loadData($_GET["ord"]);
			 ob_end_clean();
			 $pdf->AliasNbPages();
			 $tamano=count($pdf->detalle);
			 $cuanto=$tamano/15;	 
			 for($x=0;$x<$cuanto;$x++)
			 {
				 $inicio= $x * 15;
				 if($inicio+15<$tamano)
				 	$fin= $inicio+15;
				 else
				 	$fin=($tamano-$inicio)+$inicio;	
				 $pdf->AddPage();
				 $pdf->printDetalle($inicio,$fin);
			 }
			 $pdf->final_doc();
			 
			 
			 	$pdf->Output();
			 }
			 
			 
?>
