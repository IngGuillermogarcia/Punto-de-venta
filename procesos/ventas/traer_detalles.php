<?php
setlocale(LC_MONETARY, 'es_PE');
    require_once "../../clases/Venta.php";
    require_once "../../clases/Conexion.php";
    $obj = new Venta();
    $id = $_POST['id_venta'];
    $result = $obj->traer_detalles($id);

$re = "<div >
<table id='tbdetalle' class='table table-responsive'>
                                            <tr class='bg-warning'>
                                              <th scope='col' style='width:20%'>Cantidad</th>
                                              <th scope='col' style='width:70%'>Descripción</th>
                                              <th scope='col' style='width:70%'>Precio</th>
                                              <th scope='col' style='width:10%''>Importe</th>
                                            </tr>
";

while($r = mysqli_fetch_array($result))
{

    $re .= '
    <tr>
    <td> '. utf8_decode($r['cantidad']) .'</td>
    <td>'. html_entity_decode($r['nombre']) .'</td>
    <td>'. utf8_decode(number_format( $r['precio'],2)) .'</td>
    <td>'. utf8_decode(number_format( $r['importe'],2)) .'</td>
    </tr>
    ';
}
$re .="</table";

echo $re;
?>