<?
 require("../Conexion/conexion_prueba_local.php");
 $link=conect(); 
 $id=$_GET['id'];
 require("../Objetos/pedido.php");
 require("../Objetos/detalle_pedido.php");
 $detalle_pedido=new Detalle_pedido();
 $detalle_pedido->conexion($link);
 $pedido=new Pedido();
 $pedido->conexion($link);
 $array=$pedido->delete($id);
 if($array=="OK")  
  echo "<p>Pedido ".$id." fue eliminado</p>";
 else 
  echo "<p>Error BD en pedido: ".$array."</p>";  
  
  
?>