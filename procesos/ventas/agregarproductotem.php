<?php
  session_start();
  require_once '../../clases/Conexion.php';
  $c = new Conexion();
  $conexion = $c->conectar();
  $producto=$_POST['txtproducto'];
  $precio=$_POST['txtprecio'];
  $cantidad = $_POST['txtcantidad'];
  if(!empty($cantidad) and !empty($precio)  and is_numeric($cantidad))
  {
  $consulta = "select nombre,precio_venta,stock,id_producto from productos where id_producto='$producto'";
  $result = mysqli_query($conexion,$consulta);
  $tablap = $result->fetch_object();
 $total = 0;
       if(isset($_SESSION['tablacomprastemp']))
 {
           
  foreach (@$_SESSION['tablacomprastemp'] as $key) {

  $d=explode("||",@$key);
  if($d[4] == $producto)
  {
      $total=$total+$d[2];
  }
  
   }     
  }
  if(($tablap->stock < ($cantidad + $total)))
  {
      echo "s";
  }
  else 
  {
      if($cantidad <=0)
      {
          echo "n";
      }
      else
      {
            $importe=$cantidad*$precio;
  $articulo = $tablap->nombre."||".
  $precio."||".
  $cantidad."||".
  $importe."||".
  $tablap->id_producto."||";
  //variable de session-

  $_SESSION['tablacomprastemp'][]=$articulo;
      echo "1";   
      }
   
  }
  }

  else
  {
      echo "camposventa";
  }


?>