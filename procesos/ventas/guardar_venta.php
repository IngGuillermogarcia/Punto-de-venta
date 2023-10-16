<?php
session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/Venta.php";
$objc = new Conexion();
$obj = new Venta();
$ccn = $objc->conectar();

$nombre = mysqli_real_escape_string($ccn,$_POST['txtcliente']);
$tipo = $_POST['txttipo'];
$numero = $_POST['txtnumero'];

if($tipo=="orden")
{
    $tipo = "orden de compra";
}
$total = $_POST['txttotal'];

if(empty($nombre))
{
  echo "v";

}
else {
    if(isset($_SESSION['tablacomprastemp']))
    {
        

    if(count(@$_SESSION['tablacomprastemp']) == 0)
    {
        echo "tablav";
    }
        else {
        //echo $datoscontrato;
        try{

            $obj->save($nombre,$total,$tipo,$numero);
            $obj->save_detalle();
            echo "ok";
            unset($_SESSION['tablacomprastemp']);
        }catch(Exception $ex){
            echo $ex;
        }
      }
    }
    else
    {
        echo "tablav";
    }

}


?>
