<?

require('fpdf_ordensalida.php');

class PDF extends FPDF_ordensalida
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

/*
	 $cotizacion=new Cotizacion();
	 $cotizacion->conexion($link);
	 $this->arreglo=$cotizacion->detalle($id);

	 $cot_detalle=new Detalle_Cotizacion();
	 $cot_detalle->conexion($link);
	 $cot_detalle->detalle($id);
	 $cotizacion->conexion($link);
	 $this->detalle=$cot_detalle->busqueda_detalle($id);

	 $usuario=new Usuario();
	 $usuario->conexion($link);
	 $this->usuario=$usuario->print_generales($this->arreglo[3]);

	 $cliente=new Cliente();
	 $cliente->conexion($link);
	 $this->cliente=$cliente->detalle_print($this->arreglo[2]);
*/

	 $pedido=new Pedido();
	 $pedido->conexion($link);
	 $this->orden_salida=$pedido->detalle($id);

	 $detalle_pedido=new Detalle_Pedido();
	 $detalle_pedido->conexion($link);
	 $this->orden_salida_detalle=$detalle_pedido->detalle($id);
	 echo "SI ENTRA AQUÍ PERO NO SE QUE PEX";

}

function loadData2($id)
{
	 
	 $pedido=new Pedido();
	 $pedido->conexion($link);
	 $this->arreglo=$pedido->detalle($id);

	 $detalle_pedido=new Detalle_Pedido();
	 $detalle_pedido->conexion($link);
	 $this->detalle=$detalle_pedido->detalle($id);
	 
}

function printDetalle($inicio, $fin){
				$subtotal=0;
	            $x1=10;
				$x2=200;
				$y1=60;
				$y2=60;
				$limite=$fin-$inicio;
				for($cont=0;$cont<$limite+2;$cont++)
				{
					$this->Line($x1, $y1,$x2, $y2);
					
					$y1+=10;
					$y2+=10;
				}
				$y2=$y2-10;
				$this->Line(10, 60,10, $y2);
				$this->Line(30, 60,30, $y2);
				$this->Line(53, 60,53, $y2);
				$this->Line(153, 60,153, $y2);
				$this->Line(175, 60,175, $y2);
				$this->Line(200, 60,200, $y2);
				$this->Line(153, $y2,153, $y2+24);
				$this->Line(153, $y2+8,200, $y2+8);
				$this->Line(175, $y2,175, $y2+24);
				$this->Line(153, $y2+16,200, $y2+16);
				$this->Line(200, $y2,200, $y2+24);
				$this->Line(153, $y2+24,200, $y2+24);
				
				$this->SetFont('Arial','B',8);
			    $x=array(12, 32, 90, 160, 180);
				$y_i=65;
				$this->Text($x[0], $y_i,'CANTIDAD');
				$this->Text($x[1], $y_i,'CAPACIDAD');
				$this->Text($x[2], $y_i,utf8_decode('DESCRIPCIÓN'));
				$this->Text($x[3], $y_i,'P/U');
				$this->text($x[4], $y_i,'IMPORTE');
				$this->Text($x[3]-5, $y2+5,'SUBTOTAL');
				$this->Text($x[3], $y2+13,'I.V.A.');
				$this->Text($x[3], $y2+21,'TOTAL');
				$this->SetFont('Arial','',6);
				for($cont=$inicio;$cont<$fin;$cont++)
				{
					$y_i+=10;
					$precio=$this->detalle[$cont][4]*$this->detalle[$cont][6];
					$importe=$precio*$this->detalle[$cont][2];
					$subtotal+=$importe;
					$this->Text($x[0], $y_i,$this->detalle[$cont][2]);
					$this->Text($x[1], $y_i,$this->detalle[$cont][8]);
					$this->Text($x[2], $y_i,$this->detalle[$cont][7]);
					$this->Text($x[3], $y_i,"$".number_format($precio, 2, '.', ''));
					$this->Text($x[4], $y_i,"$".number_format($importe, 2, '.', ''));
				}
				$this->Text($x[4], $y2+5,"$".number_format($subtotal, 2, '.', ''));
				$this->Text($x[4], $y2+13,"$".number_format($subtotal*0.16, 2, '.', ''));
				$this->Text($x[4], $y2+21,"$".number_format($subtotal*1.16, 2, '.', ''));
				$this->final_y=$y2;
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
	$ano = date("Y", $datetime);
	
	$cabecera=utf8_decode('Nezahualcoyotl, Edo. de México a '.$dia.' de '.$mes.' del '.$ano);
	
	
		$this->Text(140, 30,$cabecera);
	$this->Text(10,35, utf8_decode("Empresa:  ".$this->arreglo[3]));
	$this->Text(175,35, "COTIZACION:___".$this->arreglo[5]."___");
	$this->Text(10,40, utf8_decode("Dirección:  ".$this->cliente[3]." ".$this->cliente[4]." ".$this->cliente[5]." ".$this->cliente[6]." ".$this->cliente[7]." ".$this->cliente[8]." ".$this->cliente[9]));
	$this->Text(180,45,'HOJA: _____'.$this->PageNo().' de {nb}');
	$this->Text(10,45, utf8_decode("AT'N:	".$this->arreglo[15]." ".$this->arreglo[16]." ".$this->arreglo[17]));
	$this->Text(10,50, "EMAIL: ".$this->arreglo[18]);		
	$this->Text(10,55, utf8_decode($this->arreglo[12]));
}

function final_doc()
{
	$this->SetFont('Arial','',6);
	$this->Text(70,$this->final_y+3, utf8_decode("(SE ANEXA COTIZACIÓN POR SEPARADO, ASI COMO DETALLES TÉCNICOS)"));
	$this->final_y+=10;
	
	$this->Text(10,$this->final_y+=3, "CONDICIONES COMERCIALES");
	$this->Text(10,$this->final_y+=3, utf8_decode("*TIEMPO DE ENTREGA: ".$this->arreglo[19]." DIAS HABILES A PARTIR DE LA CONFIRMACIÓN"));
	$this->Text(10,$this->final_y+=3, utf8_decode("*CONDICIONES DE PAGO: ".$this->arreglo[20].""));
	$this->Text(10,$this->final_y+=3, utf8_decode("*VIGENCIA DE LA COTIZACION: ".$this->arreglo[21].""));
	$this->Text(100,$this->final_y+=10, "ATENTAMENTE");
	$this->Text(90,$this->final_y+=3, $this->arreglo[14]);
	$this->final_y+=5;
	
	$this->final_y+=15;

	$this->Line(80, $this->final_y,140, $this->final_y);
	$this->Text(100,$this->final_y+=3, utf8_decode($this->usuario[0]." ".$this->usuario[1]." ".$this->usuario[2]));
	}


function Footer()
{
    $this->SetY(-20);
	$this->Line(10, $this->GetY()-5,200, $this->GetY()-5);
	$this->SetFont('Arial','',6);
	$this->Text(10,$this->GetY(), "CALLE SALTILLO No.29");
	$this->Text(10,$this->GetY()+3, "COL. JARDINES DE GUADALUPE");
	$this->Text(10,$this->GetY()+6, "C.P. 57140");
	$this->Text(10,$this->GetY()+9, "MUNICIPIO DE NEZAHUALCOYOTL");
	$this->Text(10,$this->GetY()+12, "R.F.C.: PEX 961112 RA6");
	$this->SetX(-10);
	$this->Text($this->GetX()-20,$this->GetY(), "TELS. 51.20.03.24");
	$this->Text($this->GetX()-15,$this->GetY()+3, " 51.20.52.03");
	$this->Text($this->GetX()-20,$this->GetY()+6, " CEL. 55 1850.8977");
	$this->Text($this->GetX()-35,$this->GetY()+9, " E-mail:promexextintores@hotmail.com");
   
}

	function printandsave($cot)
	{
			 
			 $this->loadData($cot);
			 ob_end_clean();
			 $this->AliasNbPages();
			 $tamano=count($this->detalle);
			 $cuanto=$tamano/15;
			 echo "tamaño:".$tamano; 
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
			 $user=$this->arreglo[3];
			 $folio=$this->arreglo[5];
			 
			 //$filename="../../upload/$user/$cot/cotizacion_$folio";
			 //echo getcwd();
			 
			 $filename="../pdf/tmp/orden_salida$folio";
			 $this->Output($filename.'.pdf','F');
			 return $folio;
			 //chmod("../../upload/$user/$cot/", 755);
	}
}			 
				 
			 $pdf = new PDF();
			 echo "a ver si aqui entra";
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
