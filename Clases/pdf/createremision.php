<?php


require('fpdf.php');

class PDF extends FPDF
{
	
public $arreglo=null;
public $detalle=null;
public $final_y=0;	
public $usuario=null;
public $cliente=null;
public $vandera=1;
public $total_total=0;


function loadData($id)
{
	 require_once("../Conexion/conexion_prueba_local.php");
	 require_once("../Objetos/cotizacion.php");
	 require_once("../Objetos/detalle_cotizacion.php");
	 require_once("../Objetos/usuario.php");
	 require_once("../Objetos/cliente.php");
	 require_once("../Objetos/almacen_material.php");
	 $link=conect();
	 $cotizacion=new Cotizacion();
	 $cotizacion->conexion($link);
	 $this->arreglo=$cotizacion->detalle($id);
	 $cot_detalle=new Detalle_Cotizacion();
	 $cot_detalle->conexion($link);
	 $cot_detalle->detalle($id);
	 $cotizacion->conexion($link);
	 $this->detalle=$cot_detalle->busqueda_detalle($id,$this->arreglo[27]);
	 $usuario=new Usuario();
	 $usuario->conexion($link);
	 $this->usuario=$usuario->print_generales($this->arreglo[3]);
	 $cliente=new Cliente();
	 $cliente->conexion($link);
	 $this->cliente=$cliente->detalle_print($this->arreglo[2]);
	 $almacen= new Almacen_material();
	 

	 
	 
}

function loadData2($id)
{
	 
	 $link=conect();
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
	 
}

function printDetalle($inicio, $fin){

	$subtotal=0;
	$total_total=0;
	$vandera=0;
	            $x1=10;
				$x2=200;
				$y1=80;
				$y2=80;
				$limite=$fin-$inicio;
				for($cont=0;$cont<$limite+2;$cont++)
				{
					$this->Line($x1, $y1,$x2, $y2);
					if ($cont==0){
								$y1+=10;
								$y2+=10;
					}	else {
								$y1+=10;
								$y2+=10;
					}

				}
				$y2=$y2-10;
				$this->Line(10, 80,10, $y2);
				$this->Line(22, 80,22, $y2);
		//		$this->Line(41, 80,41, $y2);
				$this->Line(50, 80,50, $y2);
				$this->Line(93, 80,93, $y2);
				$this->Line(113, 80,113, $y2);
					$this->Line(128, 80,128, $y2);
					$this->Line(145, 80,145, $y2);
				$this->Line(161, 80,161, $y2);


				$this->Line(180, 80,180, $y2);
				$this->Line(200, 80,200, $y2);
				$this->Line(161, $y2,161, $y2+8);
				$this->Line(161, $y2+8,200, $y2+8);
				$this->Line(180, $y2,180, $y2+8);
				$this->Line(161, $y2+8,200, $y2+8);
				$this->Line(200, $y2,200, $y2+8);
				$this->Line(161, $y2,200, $y2);
				
				$this->SetFont('Arial','B',6);
			    $x=array(11, 25, 23,55,55, 73, 115, 131, 146, 164, 185, );

				$y_i=85;
				$this->Text($x[0], $y_i,'PARTIDA');
				$this->Text($x[1]+5, $y_i,utf8_decode('NOMBRE'));
				$this->Text($x[2]+5, $y_i+4,utf8_decode('COMERCIAL'));
				//$this->Text($x[3], $y_i,'UNIDAD');
				//$this->Text($x[3], $y_i+4,'MEDIDA');
				$this->Text($x[3]+6, $y_i,utf8_decode('DESCRIPCIÓN'));
				$this->Text($x[6]-18, $y_i,utf8_decode('U/MEDIDA'));
				$this->Text($x[6], $y_i,'CANTIDAD');
				$this->Text($x[7]+2, $y_i,utf8_decode('FLETE'));
				$this->Text($x[7]+1, $y_i+4,utf8_decode('ÓPTIMO'));
				$this->Text($x[8], $y_i,utf8_decode('EXISTENCIA'));
				$this->Text($x[9], $y_i,'P/U');
				$this->text($x[10], $y_i,'IMPORTE');
				if ($inicio>=4)
				$this->Text($x[9], $y2+5,'TOTAL');
			else
				$this->Text($x[9], $y2+5,'SUB-TOTAL');
				$this->SetFont('Arial','',6);
				for($cont=$inicio;$cont<$fin;$cont++)
				{
					 if($cont==0){
					 			$y_i+=10;
					 			$vandera=1;
					 }
						else {
									$y_i+=10;
									if (($cont==12)||($cont==18)||($cont==24)||($cont==30)||($cont==36)||($cont==42)||($cont==48)||($cont==54)){
															$y_i-=5;
															
							  }
						}

						$vandera+=1;

					$precio=$this->detalle[$cont][4]*$this->detalle[$cont][6];
					$importe=$precio*$this->detalle[$cont][2];
					$subtotal+=$importe;

					$this->Text($x[0]+5, $y_i,$cont+1);
					//$this->Text($x[1]-2, $y_i,$this->detalle[$cont][7]); //ID SAE
					$this->corta_cadenas(strtoupper(utf8_decode($this->detalle[$cont][7])),20,$x[1]-2,$y_i);
					$this->corta_cadenas(strtoupper(utf8_decode($this->detalle[$cont][9])),30,$x[3]-3,$y_i);
					$this->Text($x[6]-20, $y_i,$this->detalle[$cont][10]);  //CAACIDAD
					$this->Text($x[6]+2, $y_i,$this->detalle[$cont][2]); //cantidad


					if ($this->arreglo[28]>0)
					$this->Text($x[7], $y_i,$this->detalle[$cont][13]); //FLETE OPTIMO
					else
						$this->Text($x[7], $y_i,"N/A"); //FLETE OPTIMO
						
					if($this->arreglo[27]>0)
					$this->Text($x[8]+4, $y_i,$this->detalle[$cont][12]); //EXISTENCIA
						else
								$this->Text($x[8]+4, $y_i,"N/A"); //EXISTENCIA

					$this->Text($x[9], $y_i,"$".number_format($precio, 2, '.', ''));
					$this->Text($x[10], $y_i,"$".number_format($importe, 2, '.', ''));
				}
				$total_total=$total_total+$subtotal;
				$this->Text($x[10], $y2+5,"$".number_format($total_total, 2, '.', ''));
				$this->final_y=$y2;
}

function corta_cadenas($string,$longuitud, $x, $y_i){
	$cadena_modif_temp_2 = "";
	$cadena_modif_temp = "";
	$cadena_modif = "";



$array_a_cortar = array();
$array_a_cortar = explode(" ", $string);



//echo "<br>".var_dump($array_a_cortar)."<br>";


	$arreglo_cortado = array();
	$arreglo_cortado[0] = "";
$arreglo_cortado[1] = "";
$arreglo_cortado[2] = "";
$arreglo_cortado[3] = "";
$arreglo_cortado[4] = "";
$arreglo_cortado[5] = "";
$arreglo_cortado[6] = "";
$arreglo_cortado[7] = "";
$arreglo_cortado[8] = "";
$arreglo_cortado[9] = "";
$arreglo_cortado[10] = "";
$arreglo_cortado[11] = "";
$arreglo_cortado[12] = "";

$y=0;

//echo "longuitud: ".sizeof($array_a_cortar);


for ($z=0; $z<sizeof($array_a_cortar); $z++){

 $cadena_modif_temp_2 = $arreglo_cortado[$y] . " " . $array_a_cortar[$z];
 if (strlen($cadena_modif_temp_2)>$longuitud){
  $y++;
  $cadena_modif_temp = "";
 }
 $cadena_modif_temp_1 = " " . $array_a_cortar[$z];
 $cadena_modif_temp = $cadena_modif_temp . $cadena_modif_temp_1;
 $size_cadena_modif_temp_1 = strlen($cadena_modif_temp_1);
 $size_cadena_modif = strlen($cadena_modif);
 $arreglo_cortado[$y] =  $cadena_modif_temp;
}


//echo "<br> CORTADO <BR>".var_dump($arreglo_cortado)."<br>";


$this->Text($x, $y_i,$arreglo_cortado[0]);
$this->Text($x, $y_i+3,$arreglo_cortado[1]);
$this->Text($x, $y_i+6,$arreglo_cortado[2]);
$this->Text($x, $y_i+9,$arreglo_cortado[3]);
$this->Text($x, $y_i+12,$arreglo_cortado[4]);
$this->Text($x, $y_i+15,$arreglo_cortado[5]);
$this->Text($x, $y_i+18,$arreglo_cortado[6]);
$this->Text($x, $y_i+21,$arreglo_cortado[7]);
$this->Text($x, $y_i+24,$arreglo_cortado[8]);


}

// Page header
function Header()
{
	
    // Logo
	//debe seleccionar de acuerdo a la compañia
	
    $this->Image('../../upload/empresas/'.$this->arreglo[4].'/cotizacion.png',10,7,190);
    

	$this->SetFont('Arial','',6);	
    /* direccion DF */
    $this->Text(145,10, utf8_decode("Ignacio Manual Altamirano 114 int 302 B Col. San Rafael"));
    $this->Text(182.5,12, utf8_decode("Del. Cuahutémoc"));
    $this->Text(181,14, utf8_decode("México D.F. 06470"));
    $this->Text(160.5,16, utf8_decode("Tel(s) (55) 5535 23 31 y (55) 5705 14 16"));
    $this->Text(176,18, utf8_decode("R.F.C.: MLF0711057D9"));


    /* Fin direccion DF */
    $this->SetFont('Arial','',8);	
	$datetime = strtotime($this->arreglo[7]);
	$dia = date("d", $datetime);
	$mes = date("M", $datetime);
	$mes_num = date("m", $datetime);
	$ano = date("Y", $datetime);
	$ano_num = date("y", $datetime);

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
	
	$cabecera=utf8_decode('Villahermosa, Tabasco a '.$dia.' de '.$mes.' del '.$ano);
	
	//$pdf->Cell(180-count($cabecera));
	$this->Text(135, 30,$cabecera);
	$this->Text(161,35, "No. DE CONTROL: FO-VT-02");
	$this->Text(181.5,40, utf8_decode("VERSIÓN: 02"));

 if (strlen($this->	arreglo[5])==1)
 	$FOLIO = "000".$this->	arreglo[5];
 else if (strlen($this->	arreglo[5])==2)
 	$FOLIO = "00".$this->	arreglo[5];
 else if (strlen($this->	arreglo[5])==3)
 	$FOLIO = "0".$this->	arreglo[5];

	$this->Text(177.5,45, "FOLIO: ".$this->arreglo[26]."-".$FOLIO);
//	$this->Text(140,50, utf8_decode("(SIGLAS DE MOGEL-SIGLAS DEL CLIENTE-NO DE COTIZACION-FECHA)"));

	$this->Text(10,50, utf8_decode($this->arreglo[15]." ".$this->arreglo[16]." ".$this->arreglo[17]));
	$this->Text(10,55, utf8_decode($this->arreglo[29]));
	$this->Text(10,60, utf8_decode($this->arreglo[13]));
	$this->Text(10,65, utf8_decode($this->cliente[3]." ".$this->cliente[4]." ".$this->cliente[5]." ".$this->cliente[6]." ".$this->cliente[7]." ".$this->cliente[8]." ".$this->cliente[9]));
	// $this->Text(180,45,'HOJA: _'.$this->PageNo().' de {nb}');
	//$this->Text(10,50, "EMAIL: ".$this->arreglo[18]);		
	//$this->Text(10,75, utf8_decode($this->arreglo[12]));

	//$this->Text(10,75, utf8_decode("Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos:"));
/*
	$this->Text(10,75, utf8_decode("Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos:"));
*/
	$this->corta_cadenas((utf8_decode($this->arreglo[12])),145,10,75);
}

function final_doc()
{
	$this->SetFont('Arial','',8);
	//$this->Text(70,$this->final_y+3, utf8_decode("(SE ANEXA COTIZACIÓN POR SEPARADO, ASI COMO DETALLES TÉCNICOS)"));
	$this->final_y+=10;
	
	$this->Text(10,$this->final_y+=4, utf8_decode("Precio: ".$this->arreglo[23]));
	$this->Text(10,$this->final_y+=4, utf8_decode("L.A.B.:  ".$this->arreglo[24]));
	$this->Text(10,$this->final_y+=4, utf8_decode("Forma de pago: ".$this->arreglo[20]));
	$this->Text(10,$this->final_y+=4, utf8_decode("Vigencia ".$this->arreglo[21]));
	$this->Text(10,$this->final_y+=4, utf8_decode("Capacidad de Entrega: ".$this->arreglo[25]));
	$this->Text(10,$this->final_y+=4, utf8_decode("Tiempo de entrega: ".$this->arreglo[19]));
	$this->Text(10,$this->final_y+=4, utf8_decode("Nota: Todos nuestros productos se entregarán entarimados y embalados de acuerdo a las normas P.4.0313.00 Y P.1.0000.09 que Pemex Exploración y"));
	$this->Text(10,$this->final_y+=4, utf8_decode("Producción tiene establecidas."));
	
$this->SetFont('Arial','B',8);

	$this->Text(10,$this->final_y+=10, utf8_decode("A T E N T A M E N T E"));
$this->SetFont('Arial','',8);
	$this->Text(10,$this->final_y+=5, utf8_decode($this->arreglo[14]));
	$this->Text(10,$this->final_y+=5, utf8_decode($this->usuario[0]." ".$this->usuario[1]." ".$this->usuario[2]));
	$this->Text(10,$this->final_y+=5, utf8_decode("VENTAS"));
	$this->final_y+=5;
	//$this->Image('../../upload/firmas/'.$this->arreglo[3].'.png',10,$this->final_y,40);
	$this->final_y+=15;

	//$this->Line(80, $this->final_y,140, $this->final_y);
	}


function Footer()
{
    $this->SetY(-20);
	$this->Line(10, $this->GetY()-5,200, $this->GetY()-5);
	$this->SetFont('Arial','',6);
	$this->Text(10,$this->GetY(), utf8_decode(" Av. Paseo Tabasco 1203, Col. Linda vista Torre Empresarial Piso 8, Dpto 805-B Villahermosa Tab. C.P. 86060 Tel 01(993)3161702"));

   
}

	function printandsave($cot)
	{
			 
			 $this->loadData($cot);
			 ob_end_clean();
			 $this->AliasNbPages();
			 $tamano=count($this->detalle);
			 $cuanto=$tamano/12;	 
			 for($x=0;$x<$cuanto;$x++)
			 {
				 $inicio= $x * 12;
				 if($inicio+12<$tamano)
				 	$fin= $inicio+12;
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
			 
			 $filename="../pdf/tmp/cotizacion$folio";
			 $this->Output($filename.'.pdf','F');
			 return $folio;
			 //chmod("../../upload/$user/$cot/", 755);
	}
}			 
				 
			 $pdf = new PDF();
			 if(!empty($_GET["cot"]))
			 {
			 $pdf->loadData($_GET["cot"]);
			 ob_end_clean();
			 $pdf->AliasNbPages();
			 $tamano=count($pdf->detalle);
			 $cuanto=$tamano/12;	 
			 for($x=0;$x<$cuanto;$x++)
			 {
				 $inicio= $x * 12;
				 if($inicio+12<$tamano)
				 	$fin= $inicio+12;
				 else
				 	$fin=($tamano-$inicio)+$inicio;	
				 $pdf->AddPage();
				 $pdf->printDetalle($inicio,$fin);
			 }
			 $pdf->final_doc();
			 
			 
			 	$pdf->Output();
			 }
			 
			 
?>
