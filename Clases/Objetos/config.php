<? class Configuracion
{
  private $link;	
  function __construct()
  {
     
  }
  function conexion($link_bd)
  {
      $link=$link_bd;
  }
  function update(
		   $servidor_smtp,
		   $puerto,
		   $usuario_correo_notificaciones,
		   $contrasena_usuario_correo_notificaciones,
		   $frecuencia_notificaciones_pago,
		   $frecuencia_notificaciones_cotizacion_pedido,
		   $frecuencia_notificaciones_material_minimo,
		   $frecuencia_notificaciones_material_caduco
    )
  	{   
      $id=0;
      $sql = "
      update CONFIGURACION set servidor_smtp='".$servidor_smtp."',
      						   puerto=".$puerto.",
							   usuario_correo_notificaciones='".$usuario_correo_notificaciones."',
							   contrasena_usuario_correo_notificaciones='".$contrasena_usuario_correo_notificaciones."',
							   frecuencia_notificaciones_pago='".$frecuencia_notificaciones_pago."',
							   frecuencia_notificaciones_cotizacion_a_pedido='".$frecuencia_notificaciones_cotizacion_pedido."',
							   frecuencia_notificaciones_material_minimo='".$frecuencia_notificaciones_material_minimo."',
							   frecuencia_notificaciones_material_caduco='".$frecuencia_notificaciones_material_caduco."'";
      $res=mysql_query($sql);
      if($res)
              
          $id=1;
      else{
          $id=0;
          printf("Error:".mysql_error());
      }
      return $id;
  }
  
  function detalle()
  {
	  $sql="select * from CONFIGURACION";
	  $res=mysql_query($sql);
	  if($res&&mysql_num_rows($res)>0)
	  {
		  $row=mysql_fetch_row($res);
		  return $row;
	  }
	  else
	  {
		  return null;
	  }
  }
}
?> 