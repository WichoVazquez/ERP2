

	<h2>PALABRAS</h2>


		<?

$string = "POLIMERO REDUCTOR DE FILTRADO BASE AGUA CON AGUA PERO SIN AGUA A LA VEZ CON AGUA PERO SIN AGUA A LA VEZ";

$longuitud = 82;


$array_a_cortar = explode( " ", $string );
//print_r($string);echo "<br>";
//print_r(sizeof($array_a_cortar));echo "<br>";
$arreglo_cortado = array();
$y=0;

for ($x=0; $x<=sizeof($array_a_cortar); $x++){

 $cadena_modif_temp_2 = $arreglo_cortado[$y] . " " . $array_a_cortar[$x];
 if (strlen($cadena_modif_temp_2)>$longuitud){
  $y++;
  $cadena_modif_temp = "";
 }
 $cadena_modif_temp_1 = " " . $array_a_cortar[$x];
 $cadena_modif_temp = $cadena_modif_temp . $cadena_modif_temp_1;
 $size_cadena_modif_temp_1 = strlen($cadena_modif_temp_1);
 $size_cadena_modif = strlen($cadena_modif);
 $arreglo_cortado[$y] =  $cadena_modif_temp;
}

//print_r($arreglo_cortado);

?>


