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

	 $link=conect();

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

				/*** header 1 ****/

				$this->Line($x1, $y1-40,$x2, $y2-40);
				$this->Line($x1, $y1-23,$x2, $y2-23);

					/********** ****/

/***** DETALLE *************/
				for($cont=0;$cont<$limite+2;$cont++)
				{
					$this->Line($x1, $y1,$x2, $y2);
					
					$y1+=10;
					$y2+=10;
				}
/******************************/
				$y2=$y2-10;

					/*** header 2 ****/
				$this->Line(10, $y_inical-40,10, $y2-20);
				$this->Line(200, $y_inical-40,200, $y2-20);
		/****************/


				$this->Line(10, $y_inical,10, $y2);
				$this->Line(30, $y_inical,30, $y2);
				$this->Line(53, $y_inical,53, $y2);
				$this->Line(96, $y_inical,96, $y2);
				$this->Line(125, $y_inical,125, $y2);
				$this->Line(155, $y_inical,155, $y2);
				$this->Line(200, $y_inical,200, $y2);
			
			

				$this->Line(200, 80,200, $y2);
				$this->Line(155, $y2,155, $y2+10);
				$this->Line(155, $y2+10,200, $y2+10);
				$this->Line(200, $y2,200, $y2+10);
				
				$this->SetFont('Arial','B',8);
			    $x=array(12, 32, 55, 80, 180);
				$y_i=$y_inical+5;
				$this->Text($x[0], $y_i,utf8_decode('NÚMERO DE'));$this->Text($x[0]+2, $y_i+3,utf8_decode('PIEZAS'));
				
				$this->Text($x[1]+2, $y_i,utf8_decode('TIPO DE')); $this->Text($x[1], $y_i+3,utf8_decode('EMBALAJE'));
				$this->Text($x[2], $y_i,utf8_decode('PRODUCTO/CONTENIDO'));
				$this->Text(100, $y_i,utf8_decode('PESO BRUTO'));
				$this->Text(128, $y_i,utf8_decode('VOLUMEN en M3'));
				$this->Text(162, $y_i,utf8_decode('VALOR DECLARADO'));	

				$this->SetFont('Arial','',6);



				for($cont=$inicio;$cont<$fin;$cont++)
				{
					$y_i+=10;
					$this->Text($x[2], $y_i,$this->detalle[$cont][6]);
			
				}

				$this->final_y=$y2;

				$this->SetFont('Arial','B',8);

				$this->Text(100,$this->final_y+=10, utf8_decode('VALOR TOTAL DECLARADO:'));

/************** TIPO DE MERCANCÍA ********************/

$this->Text(12,$this->final_y+=10, utf8_decode('TIPO DE MERCANCÍA:'));
$this->SetFont('Arial','',8);

$this->SetFont('Arial','B',8);$this->Text(12,$this->final_y+=5, utf8_decode('Nacional:'));
$this->SetFont('Arial','',8);$this->Text(35,$this->final_y, utf8_decode('(   X   )'));

$this->SetFont('Arial','B',8);$this->Text(45,$this->final_y, utf8_decode('No. Factura / Remisión:'));
$this->SetFont('Arial','',8);$this->Text(80,$this->final_y, utf8_decode('GSM-MF-051'));

$this->SetFont('Arial','B',8);$this->Text(12,$this->final_y+=5, utf8_decode('De Importación:'));
$this->SetFont('Arial','',8);$this->Text(35,$this->final_y, utf8_decode('(        )'));

$this->SetFont('Arial','B',8);$this->Text(45,$this->final_y, utf8_decode('No. de Pedimento:'));
$this->SetFont('Arial','',8);$this->Text(80,$this->final_y, utf8_decode(''));

$this->SetFont('Arial','B',10);$this->Text(100,$this->final_y+=10, utf8_decode('FLETE'));

/******************fletes*****************/

	$x1=10;
	$x2=200;


					/*** VERTICALES ****/
				$this->Line(10, $this->final_y+=5,10, $this->final_y+20);
				$this->Line(30,$this->final_y,30, $this->final_y+20);
				$this->Line(53,$this->final_y,53, $this->final_y+20);
				$this->Line(125	,$this->final_y,125, $this->final_y+60);
				$this->Line(155,$this->final_y,155, $this->final_y+20);
				$this->Line(200,$this->final_y,200, $this->final_y+20);
		/****************/
				$this->Line($x1, $this->final_y,$x2, $this->final_y);
				$this->Line($x1, $this->final_y+=10,$x2, $this->final_y);
				$this->Line($x1, $this->final_y+=10,$x2, $this->final_y);


				$this->final_y-=15;
				$this->SetFont('Arial','B',8);

			 $x=array(12, 36, 73, 134, 170);

				$this->Text($x[0], $this->final_y,utf8_decode('CANTIDAD'));			
				$this->Text($x[1], $this->final_y,utf8_decode('UNIDAD')); 
				$this->Text($x[2], $this->final_y,utf8_decode('CONCEPTO/DESCRIPCIÓN'));
				$this->Text($x[3], $this->final_y,utf8_decode('VALOR'));$this->Text($x[3]-2, $this->final_y+3,utf8_decode('UNITARIO'));			
				$this->Text($x[4], $this->final_y,utf8_decode('IMPORTE'));	

				$y2 = $this->final_y+15;

				$this->Line(200, 80,200, $y2);
				$this->Line(155, $y2,155, $y2+10);
				$this->Line(125, $y2+10,200, $y2+10);
				$this->Line(200, $y2,200, $y2+=10);

				$this->Line(200, 80,200, $y2);
				$this->Line(155, $y2,155, $y2+10);
				$this->Line(125, $y2+10,200, $y2+10);
				$this->Line(200, $y2,200, $y2+=10);

				$this->Line(200, 80,200, $y2);
				$this->Line(155, $y2,155, $y2+10);
				$this->Line(125, $y2+10,200, $y2+10);
				$this->Line(200, $y2,200, $y2+=10);

				$this->Line(200, 80,200, $y2);
				$this->Line(155, $y2,155, $y2+10);
				$this->Line(125, $y2+10,200, $y2+10);
				$this->Line(200, $y2,200, $y2+=10);

				$this->final_y+=10;

					$this->SetFont('Arial','',8);

				$this->Text($x[0], $this->final_y,utf8_decode('1'));			
				$this->Text($x[1]-2, $this->final_y,utf8_decode('Movimiento')); 
				$this->Text($x[2]-15, $this->final_y,utf8_decode('MOVIMIENTO DE BARITA EN EL POZO Jacinto'));
				$this->Text($x[2]-15, $this->final_y+3,utf8_decode('1002-A de GSM SERVICIOS INTEGRALES'));
				$this->Text($x[3], $this->final_y,utf8_decode('$6,474.00'));	$this->Text($x[4], $this->final_y,utf8_decode('$6,474.00'));


				$this->Text($x[3], $this->final_y+=10,utf8_decode('SUB-TOTAL')); $this->Text($x[4], $this->final_y,utf8_decode('$6,474.00'));
				$this->Text($x[3], $this->final_y+=10,utf8_decode('I.V.A 16%')); $this->Text($x[4], $this->final_y,utf8_decode('$1,035.84'));
				$this->Text($x[3], $this->final_y+=10,utf8_decode('RET I.V.A 4%')); $this->Text($x[4], $this->final_y,utf8_decode('$258.96'));
				$this->Text($x[3], $this->final_y+=10,utf8_decode('TOTAL')); $this->Text($x[4], $this->final_y,utf8_decode('$7,250.88'));

				$this->final_y+=10;



				$this->Line($x1, $this->final_y+20,$x2, $this->final_y+20);
				$this->Line($x1, $this->final_y+50,$x2, $this->final_y+50);
				$this->Line(10, 80,10, $this->final_y+50);
				$this->Line(200, 80,200, $this->final_y+50);
}

// Page header
function Header()
{
	
    // Logo
	//debe seleccionar de acuerdo a la compañia
	   $this->Image('../../upload/empresas/3/transporte.jpg',10,7,190);

$datetime = strtotime($this->arreglo[1]);
	$dia = date("d", $datetime);
	$mes = date("M", $datetime);
	$ano = date("Y", $datetime);



	$this->SetFont('Arial','B',10);	
	$y_direccion_header = 8;
	$this->Text(155,$y_direccion_header, utf8_decode("CARTA PORTE"));
	$this->SetFont('Arial','',8);	
	$this->Text(155,$y_direccion_header+=5, utf8_decode("SERIE:"));
	$this->Text(170,$y_direccion_header, utf8_decode("VI"));

	$this->Text(155,$y_direccion_header+=3, utf8_decode("FOLIO:"));
	$this->Text(170,$y_direccion_header, utf8_decode("201"));

	$this->Text(155,$y_direccion_header+=3, utf8_decode("FECHA:"));
	$this->Text(170,$y_direccion_header, utf8_decode($dia.' / '.$mes.' / '.$ano));



    /* direccion DF */
				$this->SetFont('Arial','',6);	
	$y_direccion_header = 15;

    $this->Text(90,$y_direccion_header, utf8_decode("Ignacio Manual Altamirano 114 int 302 B Col. San Rafael"));
    $this->Text(90,$y_direccion_header+=2, utf8_decode("Del. Cuahutémoc"));
    $this->Text(90,$y_direccion_header+=2, utf8_decode("México D.F. 06470"));
    $this->Text(90,$y_direccion_header+=2, utf8_decode("Tel(s) (55) 5535 23 31 y (55) 5705 14 16"));
    $this->Text(90,$y_direccion_header+=2, utf8_decode("R.F.C.: MTR120820BX1"));
 //   $this->Image('../../upload/empresas/3/3.png',10,5,70);
    
	$this->SetFont('Arial','',8);	


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


	
	//$this->SetFont('Arial','B',14);
	//$this->Text(80,$y_header, utf8_decode("AVISO DE EMBARQUE"));
	$this->SetFont('Arial','',8);


	$y_header= $y_header + 10;
$this->SetFont('Arial','B',8); $this->Text(12,$y_header, utf8_decode("CLIENTE:"));
$this->SetFont('Arial','',8); $this->Text(30,$y_header, utf8_decode("MOGEL FLUÍDOS S.A. DE C.V."));

$this->SetFont('Arial','B',8);$this->Text(12,$y_header+=3,utf8_decode('RFC:'));
$this->SetFont('Arial','',8);$this->Text(30,$y_header,utf8_decode('MLF0711057D9'));



$this->SetFont('Arial','B',8);$this->Text(12,$y_header+=3, utf8_decode("DOMICILIO:"));
$this->SetFont('Arial','',8);$this->Text(30,$y_header, utf8_decode("IGNACIO MANUEL ALTAMIRANO No. 114 INT 302-B"));

$this->SetFont('Arial','B',8);$this->Text(130,$y_header, utf8_decode("ESTADO:"));
$this->SetFont('Arial','',8);$this->Text(150,$y_header, utf8_decode("DISTRITO FEDERAL"));

	$this->SetFont('Arial','B',8);$this->Text(12,$y_header+=3, utf8_decode("COLONIA: "));
	$this->SetFont('Arial','',8);$this->Text(30,$y_header, utf8_decode("SAN RAFAEL"));

	$this->SetFont('Arial','B',8);$this->Text(90,$y_header, utf8_decode("CIUDAD:"));
$this->SetFont('Arial','',8);	$this->Text(105,$y_header, utf8_decode("MÉXICO"));

	$this->SetFont('Arial','B',8);$this->Text(130,$y_header, utf8_decode("C.P.:"));
	$this->SetFont('Arial','',8);$this->Text(137,$y_header, utf8_decode("06470"));

	$this->SetFont('Arial','B',8);$this->Text(156,$y_header, utf8_decode("PAÍS:"));
	$this->SetFont('Arial','',8);$this->Text(170,$y_header, utf8_decode("MÉXICO"));


	$this->SetFont('Arial','B',8);$this->Text(130,$y_header, utf8_decode("C.P.:"));
	$this->SetFont('Arial','',8);$this->Text(137,$y_header, utf8_decode("06470"));

	$this->SetFont('Arial','B',8);$this->Text(156,$y_header, utf8_decode("PAÍS:"));
	$this->SetFont('Arial','',8);$this->Text(170,$y_header, utf8_decode("MÉXICO"));

/**********ORIGEN ***********************************************************/

$y_header+=5;

$this->SetFont('Arial','B',8);$this->Text(12,$y_header+=3, utf8_decode("ORIGEN:"));
$this->SetFont('Arial','',8);$this->Text(30,$y_header, utf8_decode("BASE VILLA HERMOSA, TABASCO"));

$this->SetFont('Arial','B',8);$this->Text(105,$y_header, utf8_decode("DESTINO:"));
$this->SetFont('Arial','',8);$this->Text(130,$y_header, utf8_decode("POZO JACINTO 1002-A"));

$this->SetFont('Arial','B',8);$this->Text(12,$y_header+=3, utf8_decode("REMITENTE:"));
$this->SetFont('Arial','',8);$this->Text(30,$y_header, utf8_decode("MOGEL FLUIDOS S.A. DE C.V."));

$this->SetFont('Arial','B',8);$this->Text(105,$y_header, utf8_decode("DESTINATARIO:"));
$this->SetFont('Arial','',8);$this->Text(130,$y_header, utf8_decode("SERVICIOS INTEGRALES GSM"));


$this->SetFont('Arial','B',8);$this->Text(12,$y_header+=3,utf8_decode('RFC:'));
$this->SetFont('Arial','',8);$this->Text(30,$y_header,utf8_decode('MLF0711057D9'));

$this->SetFont('Arial','B',8);$this->Text(105,$y_header,utf8_decode('RFC:'));
$this->SetFont('Arial','',8);$this->Text(130,$y_header,utf8_decode(''));


$this->SetFont('Arial','B',8);$this->Text(12,$y_header+=3,utf8_decode('DOMICILIO:'));
$this->SetFont('Arial','',8);$this->Text(30,$y_header,utf8_decode('CARRETERA VHSA-REFORMA R/A RIO VIEJO'));

$this->SetFont('Arial','B',8);$this->Text(105,$y_header,utf8_decode('DOMICILIO:'));
$this->SetFont('Arial','',8);$this->Text(130,$y_header,utf8_decode(''));

	$this->SetFont('Arial','B',8);
	$y_header =  $y_header + 10;
	

	$this->Text(100,$this->final_y, utf8_decode('TRANSPORTE:'));
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
	

	$this->SetFont('Arial','B',7);


$this->Text(12,$this->final_y, utf8_decode('OPERADOR:'));$this->SetFont('Arial','',7);
$this->Text(50,$this->final_y, utf8_decode('PABLO LEÓN GÓMEZ'));$this->SetFont('Arial','B',7);
	

$this->Text(12,$this->final_y+=5, utf8_decode('REMOLQUE:'));$this->SetFont('Arial','',7);
$this->Text(50,$this->final_y, utf8_decode('052-XP-44'));$this->SetFont('Arial','B',7);

$this->Text(12,$this->final_y+=5, utf8_decode('CAMIÓN, PLACAS, NUM:'));$this->SetFont('Arial','',7);
$this->Text(50,$this->final_y, utf8_decode('329-EV-4'));$this->SetFont('Arial','B',7);

$this->Text(12,$this->final_y+=5, utf8_decode('Fecha y Hora de Salida:'));$this->SetFont('Arial','',7);
$this->Text(50,$this->final_y, utf8_decode('16/08/2015 17:10 HRS'));$this->SetFont('Arial','B',7);

$this->Text(100,$this->final_y, utf8_decode('Fecha y Hora de Salida: _________________________________'));


$this->Text(28,$this->final_y+=10, utf8_decode('DOCUMENTO'));


$this->Text(85,$this->final_y, utf8_decode('RECIBÍ DE CONFORMIDAD'));

$this->Text(150,$this->final_y, utf8_decode('OBSERVACIONES'));


	$this->SetFont('Arial','',8);
$this->Image('../../upload/firmas/ButronJ.png',80,$this->final_y,40);
	$this->Text(83,$this->final_y+5, utf8_decode($this->usuario_req[0]." ".$this->usuario_req[1]." ".$this->usuario_req[2])); 



	$this->SetFont('Arial','B',8);

$this->Text(87,$this->final_y+=12, utf8_decode('NOMBRE Y FIRMA'));


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
