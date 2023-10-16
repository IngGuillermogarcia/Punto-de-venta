<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{



?>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel" style="color:white"><span class="fa fa-file"></span> Detalle de Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="fgenerarecibo">
                <div class="card mb-3">
                                <div class="card-header">
                                    <div class="row">
                                    <div class="col-lg-6"><h5>Detalle de Venta <label id="txtidcontr"></label></h5></div>
                                    
                                    </div>
                                </div>

                                <div class="card-body">

                                    <form>
                                        <div class="form-group">
                                        <div class="row">
                                         <div class="col-lg-6">
                                          <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1">Cliente</span>
                                            </div>
                                            <input id="txtcliente" name="txtcliente" type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
                                          </div>
                                        </div>
                                            <div class="col-lg-6">
                                              <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="basic-addon1">Fecha</span>
                                                </div>
                                                <input id="txtfecha" name="txtfecha" type="text" class="form-control"  aria-describedby="basic-addon1">
                                              </div>
                                            </div>
                                        </div>
                                          <div class="row">
                                         <div class="col-lg-6">
                                          <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1">Tipo</span>
                                            </div>
                                            <input id="txttipo" name="txttipo" type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
                                          </div>
                                        </div>
                                            <div class="col-lg-6">
                                              <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="basic-addon1">Numero</span>
                                                </div>
                                                <input id="txtnumero" name="txtnumero" type="text" class="form-control"  aria-describedby="basic-addon1">
                                              </div>                                          
                                            </div>

                                          </div>
                                          
                                          
                                        </div>
                                        <div class="bordde">
                                        <div id="tablaaa"></div>
                                        <div class="col-lg-12"><h4 style="text-align:right">TOTAL S/.
                                        <label  id="txttotal" name="txttotal"></label></h4></div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
</div>
    
    


    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
                
                    <div class="row">
                                <div class="col-xl-12">
                                        <div class="breadcrumb-holder">
                                                <h1 class="main-title float-left">Consultar Ventas</h1>
                                                <div class="clearfix">
                                                
                                                </div>
                                        </div>
                                </div>
                    </div>
                    <!-- end row -->
                    <form action="consultar_ventas.php" method="post">
                    <div class="row">
                       <div class="col-lg-1"></div>
                        <div class="col-lg-3">
                            <input type="date"  class="form-control" name="txtfecha1" required/>
                        </div>
                        <div class="col-lg-3">
                            <input type="date" class="form-control" name="txtfecha2" required/>
                        </div>
                        <div class="col-lg-4">
                            <input type="submit" value="Buscar" class="btn btn-primary">
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                    <hr>
                    </form>
                    <div class="row">
                       <!-- Button trigger modal -->

                       

                                                                                            
                        <div class="col-lg-12">


<?php
if(isset($_POST['txtfecha1']) and isset($_POST['txtfecha2']))
{
        require_once '../clases/Conexion.php';
        require_once '../clases/Venta.php';
        $obj = new Venta();
        $result = $obj->consultar_venta($_POST['txtfecha1'],$_POST['txtfecha2']);
?>

   <table id="dtventas" class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Cliente</td>
                            <td>Fecha</td>
                            <td>Tipo</td>
                            <td>Numero</td>
                            <td>Total</td>

                            <!--<td>Fecha Sepelio</td>-->
                            <td style="width:15px"></td>
                        </tr>
                    </thead>
                    <tbody>
<?php
	while($fila=mysqli_fetch_row($result))
	{
 ?>

    <tr>
		<td><?php echo $fila[0] ?></td>
		<td><?php echo $fila[2] ?></td>
		<td><?php echo $fila[1] ?></td>
		<td><?php echo $fila[5] ?></td>
		<td><?php echo $fila[6] ?></td>
		<td><?php echo $fila[4] ?></td>

        <td>

                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="functions('<?php echo $fila[0] ?>')">
                        <span class="fa fa-credit-card" role="button" data-toggle="tooltip" data-placement="top" title="Generar Recibo"></span> Ver Detalles
                    </a>
              
            
        </td>
	</tr>
	<?php
} 
                        }
                        else{
                        }?>

                    </tbody>
</table>
                        </div>
                        
                    </div>



        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

</div>
<!-- END content-page -->



<?php
require 'footer.php';
}
else {
	header("location:../index.php");  
}

?>


<script>
    

    
    
    function functions(id){
      agregadatosventa(id);
      mostrardetalle(id)
    }
    
    function mostrardetalle(id){
        $.ajax({
        type:"POST",
        data:"id_venta=" + id,
        url:"../procesos/ventas/mostrar_porid.php",
        success:function(r){
            var dato=JSON.parse(r);
            $('#txtcliente').val(dato['cliente']);
            $('#txttotal').html(dato['total']);
            $('#txttipo').val(dato['tipo']);
            $('#txtnumero').val(dato['numero']);
            $('#txtfecha').val(dato['fecha']);
        }
      });
    }    

    function agregadatosventa(id){
        $.ajax({
        type:"POST",
        data:"id_venta=" + id,
        url:"../procesos/ventas/traer_detalles.php",
        success:function(r){
            $('#tablaaa').html(r);
        }
      });
    
    }

$(document).ready(function(){
$('#dtventas').dataTable({
        "ordering": false,
        "info":     false
});    
});
  
    
  
</script>


