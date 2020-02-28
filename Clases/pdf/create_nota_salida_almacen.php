<?

require('fpdf_req_compra.php');

class PDF extends FPDF
{
	
public $arreglo=null;
public $detalle=null;
public $final_y=0;	
public $usuario_req=null;
public $usuario_autoriza=null;

public $cliente=null;

public $y_header = 0;


function loadData($id)
{
	 require_once("../Conexion/conexion_prueba_local.php");
	 require_once("../Objetos/usuario.php");
	 require_once("../Objetos/requisicion_compra.php");
	 require_once("../Objetos/detalle_reqcompra.php");
	 require_once("../Objetos/logistica.php");
	 require_once("../Objetos/pedido.php");


	 $link=conect();
/*
	 $ruta_detalle=new Logistica();
	 $ruta_detalle->conexion($link);
	 $this->arreglo_ruta=$ruta_detalle->detalle($id);
	 $this->arreglo_ruta_sum=$ruta_detalle->sumarioEntrega($id);

	 $req_compra=new Req_compra();
	 $req_compra->conexion($link);
	 $this->arreglo=$req_compra->detalle($id);


	 $usuario=new Usuario();
	 $usuario->conexion($link);
	 $this->usuario_req=$usuario->print_generales($this->arreglo[4]);
	 $this->usuario_autoriza=$usuario->print_generales($this->arreglo[4]);
*/
	 $detalle_ped=new Pedido();
	 $detalle_ped->conexion($link);
	 $this->arreglo_detalle=$detalle_ped->detalle_pedido_nota($id);
	
}


function printDetalle($inicio, $fin){

$y_inical = 66;

	$subtotal=0;
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
				$this->Line(30, $y_inical,30, $y2);
				$this->Line(53, $y_inical,53, $y2);
				$this->Line(76, $y_inical,76, $y2);
					$this->Line(150, $y_inical,150, $y2);
				
				$this->Line(200, $y_inical,200, $y2);
			
			

				
				$this->SetFont('Arial','B',8);
			    $x=array(12, 32, 55, 80, 180);
				$y_i=$y_inical+5;
				$this->Text($x[0], $y_i,'PARTIDA');
				$this->Text($x[1], $y_i,'CANTIDAD');
				$this->Text($x[2], $y_i,'U/MEDIDA');
				$this->Text(90, $y_i,utf8_decode('DESCRIPCIÓN'));
				$this->Text(155, $y_i,utf8_decode('OBSERVACIONES'));

				$this->SetFont('Arial','',6);



				for($cont=$inicio;$cont<$fin;$cont++)
				{
					$y_i+=10;
					
					$this->Text($x[0], $y_i,$cont+1);
					$this->Text($x[1], $y_i,($this->arreglo_detalle[$cont][2]*-1));
					$this->Text($x[2], $y_i,$this->arreglo_detalle[$cont][8]);
					$this->Text($x[3], $y_i,$this->arreglo_detalle[$cont][3]);
					//$this->Text($x[4], $y_i,$this->arreglo_detalle[$cont][5]);
			
				}

				$this->final_y=$y2;
}


// Page header
function Header()
{
	
    // Logo
	//debe seleccionar de acuerdo a la compañia
	   $this->Image('../../upload/empresas/3/cotizacion.png',10,7,190);
    

	$this->SetFont('Arial','',6);	
    /* direccion DF */
    $this->Text(145,10, utf8_decode("Ignacio Manual Altamirano 114 int 302 B Col. San Rafael"));
    $this->Text(182.5,12, utf8_decode("Del. Cuahutémoc"));
    $this->Text(181,14, utf8_decode("México D.F. 06470"));
    $this->Text(160.5,16, utf8_decode("Tel(s) (55) 5535 23 31 y (55) 5705 14 16"));
    $this->Text(176,18, utf8_decode("R.F.C.: MLF0711057D9"));
 //   $this->Image('../../upload/empresas/3/3.png',10,5,70);
    
	$this->SetFont('Arial','',8);	
	
	$datetime = strtotime($this->arreglo_detalle[0][9]);
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

$y_header=20;


	$y_header = $y_header + 15;
	$this->SetFont('Arial','B',14);
	$this->Text(80,$y_header, utf8_decode("NOTA DE SALIDA"));
	$this->SetFont('Arial','',8);


	$y_header= $y_header + 15;
$this->Text(10,$y_header, utf8_decode("NO. DE CONTROL:  FO-AL-03"));
$this->Text(130,$y_header,utf8_decode('FECHA: '.$dia.' de '.$mes.' del '.$ano));

$y_header= $y_header + 5;
$this->Text(10,$y_header, utf8_decode("VERSIÓN::                0"));
$this->Text(130,$y_header, utf8_decode("FOLIO: ".$this->arreglo_detalle[0][10].""));




	$this->SetFont('Arial','B',8);
	$y_header =  $y_header + 10;
	



}

function final_doc()
{
	

	$this->final_y+=5;



	$this->SetFont('Arial','B',7);



$this->Text(10,$this->final_y, utf8_decode('TRANSPORTE: '));
$this->SetFont('Arial','',7);
$this->Text(30,$this->final_y, utf8_decode('PENDIENTE POR ASIGNAR EN LOGÍSTICA'));
$this->SetFont('Arial','B',7);
$this->Text(10,$this->final_y+=4, utf8_decode('PLACAS: '));
$this->SetFont('Arial','',7);
$this->Text(30	,$this->final_y, utf8_decode('PENDIENTE POR ASIGNAR EN LOGÍSTICA'));
$this->SetFont('Arial','B',7);
$this->Text(10,$this->final_y+=4, utf8_decode('DESTINO: '));
$this->Text(10,$this->final_y+=4, utf8_decode('HORA DE SALIDA: '));
$this->Text(10,$this->final_y+=4, utf8_decode('REMISIÓN / FACTURA: '));


$this->Text(35,$this->final_y+=20, utf8_decode('ENTREGA'));
$this->Text(98,$this->final_y, utf8_decode('RECIBE'));
$this->Text(165,$this->final_y, utf8_decode('REVISA'));



	$this->SetFont('Arial','',8);
//	$this->Text(30,$this->final_y+5, utf8_decode($this->usuario_req[0]." ".$this->usuario_req[1]." ".$this->usuario_req[2])); 

/*

if ($this->arreglo[7]==2)
{

	$this->Text(155,$this->final_y+5, utf8_decode($this->usuario_autoriza[0]." ".$this->usuario_autoriza[1]." ".$this->usuario_autoriza[2])); // quien autoriza
}
*/
	$this->SetFont('Arial','B',8);

$this->Text(30,$this->final_y+=12, utf8_decode('NOMBRE Y FIRMA'));
$this->Text(80,$this->final_y, utf8_decode('TRANSPORTE DEL PROVEEDOR'));
$this->Text(150,$this->final_y, utf8_decode('RESPONSABLE DE LA BASE'));


	$this->SetFont('Arial','',8);
/* if ($this->arreglo[7]==2)
	$this->Text(110,$this->final_y, utf8_decode($this->usuario_req[0]." ".$this->usuario_req[1]." ".$this->usuario_req[2])); //quien spolicita
*/

	}


function Footer()
{
    $this->SetY(-20);

	$this->SetFont('Arial','',6);

	$this->SetX(-10);
  
}

	function printandsave($cot)
	{
			 
			 $this->loadData($cot);
			 ob_end_clean();
			 $this->AliasNbPages();
			 $tamano=count($this->arreglo_detalle);
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
			 //$user=$this->arreglo[4];
			 //$folio=$this->arreglo[0];
			 

			 $filename="../pdf/tmp/req$folio";
			 $this->Output($filename.'.pdf','F');
			 return $folio;
			
	}
}			 
				 
			 $pdf = new PDF();
			 if(!empty($_GET["req"]))
			 {
			 $pdf->loadData($_GET["req"]);
			 ob_end_clean();
			 $pdf->AliasNbPages();
			 $tamano=count($pdf->arreglo_detalle);
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
