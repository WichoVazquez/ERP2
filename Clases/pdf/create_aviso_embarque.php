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

	 $link=conect();

	 $ruta_detalle=new Logistica();
	 $ruta_detalle->conexion($link);
	 $this->arreglo_ruta=$ruta_detalle->detalle($id);

	 $req_compra=new Req_compra();
	 $req_compra->conexion($link);
	 $this->arreglo=$req_compra->detalle($id);
	


	 $req_compra_detalle=new Detalle_reqcompra();
	 $req_compra_detalle->conexion($link);
	 $req_compra_detalle->detalle($id);
	 $this->detalle=$req_compra_detalle->busqueda_detalle($id);

	 $usuario=new Usuario();
	 $usuario->conexion($link);
	 $this->usuario_req=$usuario->print_generales($this->arreglo[4]);
	 $this->usuario_autoriza=$usuario->print_generales($this->arreglo[4]);
/*
	 $cotizacion=new Cotizacion();
	 $cotizacion->conexion($link);
	 $this->arreglo=$cotizacion->detalle($id);

	 $cot_detalle=new Detalle_Cotizacion();
	 $cot_detalle->conexion($link);
	 $cot_detalle->detalle($id);


	 $cotizacion->conexion($link);
	 $this->detalle=$cot_detalle->busqueda_detalle($id);
	 $cliente=new Cliente();
	 $cliente->conexion($link);
	 $this->cliente=$cliente->detalle_print($this->arreglo[2]);
*/

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
					$this->Text($x[1], $y_i,$this->arreglo_ruta[$cont][5]);
					$this->Text($x[2], $y_i,$this->arreglo_ruta[$cont][9]);
					$this->Text($x[3], $y_i,$this->arreglo_ruta[$cont][3]);
			
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
	$datetime = strtotime($this->arreglo[1]);
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
	$this->Text(80,$y_header, utf8_decode("AVISO DE EMBARQUE"));
	$this->SetFont('Arial','',8);


	$y_header= $y_header + 10;
$this->Text(10,$y_header, utf8_decode("NO. DE CONTROL:  FO-AL-04"));
$this->Text(130,$y_header,utf8_decode('FECHA: '.$dia.' de '.$mes.' del '.$ano));

$y_header= $y_header + 4;
$this->Text(10,$y_header, utf8_decode("VERSIÓN::            0"));
	$this->Text(130,$y_header, utf8_decode("FOLIO: ".$this->arreglo[0].""));

$y_header= $y_header + 7;
$this->Text(10,$y_header, utf8_decode("VENDIDO A: ________________________________________________________"));
$y_header= $y_header + 4;
$this->Text(10,$y_header, utf8_decode("DOMICILIO: _________________________________________________________"));

	$this->SetFont('Arial','B',8);
	$y_header =  $y_header + 10;
	
/*

	$y_header =$y_header+ 3;
$this->Text(10,$y_header, utf8_decode('NOMBRE DEL SOLICITANTE:'.$this->usuario_req[0]." ".$this->usuario_req[1]." ".$this->usuario_req[2]));
	$y_header =$y_header+ 3;
$this->Text(10,$y_header, utf8_decode('PROYECTO, OBRA, CONTRATO (SEGÚN EL CASO):'));
	$y_header =$y_header+ 3;
$this->Text(10,$y_header, utf8_decode('DESCRIPCIÓN DE LOS TRABAJOS A REALIZAR CON LA COMPRA: '));
	$y_header =$y_header+ 3;
$this->Text(10,$y_header, utf8_decode('FECHA PARA CUANDO SE REQUIERE EL PRODUCTO Y/O SERVICIO: '));
	$y_header =$y_header+ 3;
$this->Text(10,$y_header, utf8_decode('LUGAR DE ENTREGA DEL PRODUCTO Y/O SERVICIO: '));

*/


}

function final_doc()
{
	

	$this->final_y+=5;



	$this->SetFont('Arial','B',7);


$this->Text(10,$this->final_y+=3, utf8_decode('CONTRATO:___________________________________'));
$this->Text(100,$this->final_y, utf8_decode('TRANSPORTE:'));

$this->Text(100,$this->final_y+=3, utf8_decode('CHOFER:'));

$this->Text(10,$this->final_y+=3, utf8_decode('REQUISICIÓN:__________________________________ '));
$this->Text(100,$this->final_y, utf8_decode('PLACAS: '));

$this->Text(100,$this->final_y+=3, utf8_decode('DESTINO:'));


$this->Text(28,$this->final_y+=20, utf8_decode('RECIBÍ DE CONFORMIDAD'));


	$this->SetFont('Arial','',8);
// $this->Image('../../upload/firmas/ButronJ.png',20,$this->final_y+2,40);
	$this->Text(30,$this->final_y+5, utf8_decode($this->usuario_req[0]." ".$this->usuario_req[1]." ".$this->usuario_req[2])); 



	$this->SetFont('Arial','B',8);

$this->Text(30,$this->final_y+=12, utf8_decode('NOMBRE Y FIRMA'));


	$this->SetFont('Arial','',8);


	}


function Footer()
{
    $this->SetY(-20);

	$this->SetFont('Arial','',6);

	$this->SetX(-10);
/*
	$this->Text($this->GetX()-10,$this->GetY()+15, "FO-VEN-02");
	$this->Text($this->GetX()-10,$this->GetY()+17, "REV-02");
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
			 $user=$this->arreglo[4];
			 $folio=$this->arreglo[0];
			 
			 //$filename="../../upload/$user/$cot/cotizacion_$folio";
			 //echo getcwd();
			 
			 $filename="../pdf/tmp/req$folio";
			 $this->Output($filename.'.pdf','F');
			 return $folio;
			 //chmod("../../upload/$user/$cot/", 755);
	}
}			 
				 
			 $pdf = new PDF();
			 if(!empty($_GET["req"]))
			 {
			 $pdf->loadData($_GET["req"]);
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
