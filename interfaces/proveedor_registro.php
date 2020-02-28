<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="../Clases/Verificadores/general.js"> </script>

</head>
<body>

 <?php

 /*iniciarSession();
 $nivel=$_SESSION["nivel"];
 if($nivel==0)
 {
 */ 
  if(!isset($_POST['Guardar']))
  {
   echo "
  <form  method='post' name='myform' onsubmit=\"return validarDatosProveedor(true)\" action='proveedor_registro.php'>
  <span class='Titulo'>Registro de Proveedor</span>
  <div id='separa3'></div>

     <table border='0' style='padding-top:10px;'>
   <tr>  
          <td  width='100' style='font-size:12px;'>Razón Social</td>
        <td width='100'><input type='text' required name='rs' id='rs' maxlength='100'  onBlur=\"return validarRSProveedor(this.value)\" /></td>
    
    <td width='100' style='font-size:12px;'>R.F.C.</td>
          <td width='100'><input type='text' required id='rfc' name='rfc' maxlength='13'  onBlur=\"return validarRFCProveedor(this.value)\" /></td>
    </tr>
     
  
   
         <td height='20' colspan=4><span class='Subtitulo'>Domicilio: &nbsp;</td> 
         
  <tr>
    <td style='font-size:12px;'>Calle</td>
          <td width='100'><input type='text' name='calle' id='calle' required maxlength='50'></td>
    <td  style='font-size:12px;'>Número Ext</td>
          <td width='100' style='font-size:12px;'><input type='text' required id='num_ext' name='num_ext' maxlength='20'> </td>

  </tr>
  <tr>
    <td  style='font-size:12px;'>Número Int</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_int' maxlength='50'></td>
    <td  style='font-size:12px;'>Colonia</td>
          <td width='100'><input type='text' name='colonia' id='colonia' required maxlength='50'></td>
  </tr>
  <tr>
  <td style='font-size:12px;'>Municipio</td>
          <td width='100' style='font-size:12px;'><input type='text' id='municipio' name='municipio' required maxlength='50'></td>
    <td  style='font-size:12px;'>Ciudad</td>
          <td width='100'><input type='text' name='ciudad' id='ciudad' required maxlength='50'></td>
  </tr>
  <tr>
  <td  style='font-size:12px;'>Estado</td>
          <td width='100'><input type='text' name='estado' id='estado'  required maxlength='20'></td>
    <td  style='font-size:12px;' >CP</td>
          <td width='100'><input type='text' name='cp' required maxlength='5' id='cp' onkeypress=\"return NumEntero(event)\" ></td>
  </tr>
  
  <td height='20' colspan=4><span class='Subtitulo'>Contacto Principal: &nbsp;</td>
  
       
  <tr>
              <td  width='100' style='font-size:12px;'>Nombre</td>
              <td width='100'><input type='text' required name='nombre' id='nombre' maxlength='50'></td>
              <td  width='100' style='font-size:12px;'>Apellido Paterno</td>
              <td width='100'><input type='text' required name='apel_p' id='apel_p' maxlength='50'></td>
        </tr>

        <tr>
          <td width='100' style='font-size:12px;'>Apellido Materno</td>
          <td width='100'><input type='text' name='apel_m' id='apel_m' maxlength='50'></td>
          <td width='100' style='font-size:12px;'>Correo Electr&oacute;nico</td>
          <td width='100'><input type='text' required name='email' id='email' maxlength='50' ></td>
  </tr>
        </tr>
        
  <tr>
  <td width='100' style='font-size:12px;'>Telefono (Trabajo)</td>
          <td width='100'><input type='text' name='tel_trabajo' id='tel_trabajo' maxlength='12'></td>
    <td width='100' style='font-size:12px;'>Ext. (Trabajo)</td>
          <td width='100'><input type='text' name='ext_tel_trabajo' maxlength='12'></td>
  </tr>
  <tr>
  <td width='100' style='font-size:12px;'>Telefono (Casa)</td>
          <td width='100'><input type='text' name='tel_casa' id='tel_casa' maxlength='12'></td>
    <td width='100' style='font-size:12px;'>Celular</td>
          <td width='100'><input type='text' name='tel_cel' maxlength='12'></td>
  </tr> 
  <tr>
  
  <td colspan='5'>
   <div id=\"error\"  class='error1'>
   </div>
  </td>
   
  <tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
             <input  class='botones-metro' type='submit' name='Guardar' value='Guardar'>            </td>
        </tr>
  
  
      </table>
  </form>
    ";
   
  }else
  { 
   require("../Clases/Objetos/domicilio.php");
   require("../Clases/Objetos/generales.php");
   require("../Clases/Objetos/proveedor.php");
   require("../Clases/Conexion/conexion_prueba_local.php");
   $link=conect();
   $generales=new Generales();
   $generales->conexion($link);
   $domicilio=new Domicilio();
   $domicilio->conexion($link);
   $proveedor=new Proveedor();
   $proveedor->conexion($link);
   
if(!$generales->email_duplicado($_POST['email']))
 {
  $result_gen=$generales->insert(
  $_POST['nombre'],
  $_POST['apel_p'],
  $_POST['apel_m'],
  $_POST['tel_trabajo'],
  $_POST['ext_tel_trabajo'],
  $_POST['tel_casa'],
  $_POST['tel_cel'],
  $_POST['email']);
  
  if($result_gen!=0)
  {   
   $res_dom=$domicilio->insert(
   $_POST['calle'],
   $_POST['num_ext'],
   $_POST['num_int'],
   $_POST['colonia'],
   $_POST['municipio'],
   $_POST['ciudad'],
   $_POST['estado'],
   $_POST['cp']);
  
   if($res_dom!=0)
   {
    
    $res_pro=$proveedor->insert(
    $_POST['clave'],
    $_POST['rs'],
    $_POST['rfc'],
    $res_dom,
    $result_gen);
   
    if($res_pro!=0)
   
    {
     echo "<br>
         <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Proveedor ha sido registrado</p>";
    }
    else
    {
     echo "
       <br>
       <p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Proveedor no se ha podido registrar</p>";
       $domicilio->delete($res_dom);
    }
   }//domicilio  
   else
   {
    echo "<br>
       <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Domicilio del Proveedor no se ha podido registrar</p>";
   }
  }
     else
   {
    echo "<br>
       <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: Los datos Generales del Proveedor no se ha podido registrar</p>";
   }//email generales
  }
  }
?>
</body>
</html>
