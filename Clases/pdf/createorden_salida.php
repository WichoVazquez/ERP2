<?

require('fpdf_ordensalida.php');

class PDF extends FPDF
{
	
public $arreglo=null;
public $detalle=null;
public $final_y=0;	
public $usuario=null;
public $cliente=null;


function loadData($id)
{
	 require_once("../Conexion/conexion_prueba_local.php");
	 require_once("../Objetos/cotizacion.php");
	 require_once("../Objetos/detalle_cotizacion.php");
	 require_once("../Objetos/usuario.php");
	 require_once("../Objetos/cliente.php");
	 	 require_once("../Objetos/pedido.php");
	 require_once("../Objetos/detalle_pedido.php");
	 $link=conect();
	 $pedido=new Pedido();
	 $pedido->conexion($link);
	 $this->arreglo=$pedido->detalle($id);

	 $detalle_pedido=new Detalle_Pedido();
	 $detalle_pedido->conexion($link);
	 $this->detalle=$detalle_pedido->detalle($id);
	 
}

function loadData2($id)
{
	 
	 $link=conect();
	 $pedido=new Pedido();
	 $pedido->conexion($link);
	 $this->arreglo=$pedido->detalle($id);

	 $detalle_pedido=new Detalle_Pedido();
	 $detalle_pedido->conexion($link);
	 $this->detalle=$detalle_pedido->detalle($id);
	 
}

function printDetalle($tamano){
	

				$this->SetFont('Arial','B',8);
				$y_12 = 36; // with
				$y_13 = 15;  //heigh

			    $x=array(15, 27, 40);
				$y_i=55+$y_13;
	//			$this->Text($x[0], $y_i,'CANTIDAD');
	//			$this->Text($x[1], $y_i,'KILOS');
	//			$this->Text($x[2], $y_i,utf8_decode('DESCRIPCIÓN'));
				$this->SetFont('Arial','',6);
				for($cont=0;$cont<$tamano;$cont++)
				{
					$y_i+=6;
			
					//$this->Text($x[0], $y_i,$this->detalle[$cont][0]);
					$this->Text($x[0]+$y_12,$y_i, utf8_decode($this->detalle[$cont][0]));
					$this->Text($x[1]+$y_12,$y_i, utf8_decode($this->detalle[$cont][1]));
					$this->Text($x[2]+$y_12,$y_i, utf8_decode($this->detalle[$cont][2]));
			
				}

			
}


// Page header
function Header()
{
	
    // Logo
	//debe seleccionar de acuerdo a la compañia
	
   
    
	$this->SetFont('Arial','',8);	
	$datetime = strtotime($this->arreglo[0]);
	$dia = date("d", $datetime);

	$mes = date("M", $datetime);

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


	$ano = date("Y", $datetime);
	
	$cabecera=utf8_decode('            '.$dia.'                         '.$mes.'                                                         '.$ano);
	
	//$pdf->Cell(180-count($cabecera));

	$y_12 = 50; //width
	$y_13 = 14;  //height

	$this->Text(25+$y_12,33+$y_13,$cabecera);
	$this->Text(15+$y_12,39+$y_13, utf8_decode($this->arreglo[3]));

	$this->Text(15+$y_12,44+$y_13, utf8_decode(
		$this->arreglo[4]." ".
		$this->arreglo[9]." ".
		$this->arreglo[10]." ".
		$this->arreglo[11]." ".
		$this->arreglo[6]." ".
		$this->arreglo[5]." ".
		$this->arreglo[12]." ".
		$this->arreglo[13]." "
		));
	
}

function final_doc()
{
	$this->SetFont('Arial','',6);

	}


function Footer()
{
    $this->SetY(-20);
	
   
}


}		// termina ñla clase	 
				 
			 $pdf = new PDF();
			 if(!empty($_GET["cot"]))
			 {
			 $pdf->loadData($_GET["cot"]);
			 ob_end_clean();
			 $pdf->AliasNbPages();
			 $tamano=count($pdf->detalle);

				 $pdf->AddPage();
				 $pdf->printDetalle($tamano);
			 
			 $pdf->final_doc();
			 
			 
			 	$pdf->Output();
			 }
			 
			 
?>
