<?
		
 	
	$fechaI=$_GET['fecha1'];
	$fechaF=$_GET['fecha2'];
	$delimitador='/';
	list($diaI,$mesI,$ano)=explode($delimitador, $fechaI);
	echo "$diaI <br>";
	echo "$mesI <br>";
    list($diaF,$mesF,$ano)=explode($delimitador, $fechaF);
	echo "lA FECHA 1 = $fechaI";
	echo "<br> La fecha 2 $fechaF";
	
if(!isset($_SESSION['user']))
{
  require("../Clases/Sesion/checarSesion.php");
  checarSesion();
  //checa perfil de usuario
}
 $user=$_SESSION['user'];
 

require_once("index_header.php");
  $user=sesiones_start();
  librerias();		 
$user=$_SESSION['user'];
  require_once("../Clases/Conexion/conexion_prueba_local.php");
  require_once("../Clases/Objetos/reportes.php");
  $link=conect();
  $reporte=new Reporte();
  $reporte->conexion($link);
 $array=$reporte->reporte_cotizacion($user);
 $array1=$reporte->reporte_OrdenSalida($user);
 $arrayf=$reporte->reporte_Facturado($user);
 $arrayE=$reporte->reporte_Entregado($user);
 $array3=array();
 $j=$diaI;
 $k=$diaI;
 $i=$diaI;
 $l=$diaI;
 $m=$diaI;
 $n=$diaI;


for ($l=$diaI; $l <=$diaF +1; $l++) { 

  $array3[$l][0]=$l;
  $array3[$l][1]=$mesI;
  $array3[$l][2]=0;
  $array3[$l][3]=0;
  $array3[$l][4]=0;
  $array3[$l][5]=0;
  
}

for ($i=$diaI; $i <= $diaF; $i++) 
{ 
  

    for ($j=0; $j <count($array) ; $j++) 
    { 
      if ($array3[$i][0]== $array[$j][0] && $array3[$i][1]== $array[$j][1]) 
      {
        
        
        $array3[$i][2]=$array[$j][2];
      }
      

    }

       
    for ($k=0; $k <count($array1) ; $k++) 
    { 
      if ($array3[$i][0]== $array1[$k][0]) 
      {
        
        $array3[$i][3]=$array1[$k][2];
      
      }
   
    }

      for ($m=0; $m <count($arrayf) ; $m++) 
    { 
      if ($array3[$i][0]== $arrayf[0][0]) 
      {
        
        $array3[$i][4]=$arrayf[$m][2];
      
      }
   
    }

    for ($n=0; $n <count($arrayE) ; $n++) 
    { 
      if ($array3[$i][0]== $arrayE[0][0]) 
      {
        
        $array3[$i][5]=$arrayE[$n][2];
      
      }
   
    }

    //fin for

}

echo "
        <table class='myTable'>
            <th>DIA</th>
            <th>MES</th>
            <th>Tot.V(Cotizaciones)</th>
            <th>Tot.V(O.S)</th>
            <th>Tot.V(Fact)</th>
            <th>Tot.V(Entregado)</th>
               
          ";
for($renglones=$diaI; $renglones<=count($array3);$renglones++)
            {
                echo "<tr>";
                
                echo "<td>".$array3[$renglones][0]."</td>";
                echo "<td>".$array3[$renglones][1]."</td>";
                echo "<td>".$array3[$renglones][2]."</td>";
                 echo "<td>".$array3[$renglones][3]."</td>";
                echo "<td>".$array3[$renglones][4]."</td>";
                echo "<td>".$array3[$renglones][5]."</td>";
                echo "</tr>";
               
             }
              echo "</table>";






?>