<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{

?>
    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container">
                
                    <div class="row">
                                <div class="col-xl-12">
                                        <div class="breadcrumb-holder">
                                                <h1 class="main-title float-left">Generar Venta</h1>
                                                <div class="clearfix">
                                                
                                                </div>
                                        </div>
                                </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                       <!-- Button trigger modal -->
                       
                        <div class="col-lg-5">
                        <label>Cliente</label>
                        <input id="txtcliente" name="txtcliente" class="form-control"/>
                        </div>
                        <div class="col-lg-3">
                        <label>Tipo</label>
                        <select name="txttipo" id="txttipo" class="form-control">
                            <option id="boleta">Boleta</option>
                            <option id="factura">Factura</option>
                            <option id="orden">Orden de Compra</option>
                        </select>
                        </div>
                        <div class="col-lg-2">
                        <label>Numero</label>
                        <input id="txtnumero" name="txtnumero" class="form-control"/>
                        </div>
                        <div class="col-lg-2">
                        <label>Fecha</label>
                        <?php date_default_timezone_set("America/Lima"); $fecha = date("Y-m-d");?>
                        <input type="date" class="form-control" value="<?= $fecha ?>">
                        </div>
                        
                    </div>
                    
                    <hr>
                    <form id="frmventa">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Producto</label>
                            
                            <select id="txtproducto" name="txtproducto" class="form-control">
                                <option value="A">Seleccione</option>
                                <?php
                                    require_once '../clases/Producto.php';
                                    require_once '../clases/Conexion.php';
                                    $obj1 = new Producto();
                                    $producto = $obj1->mostrar();
                                    while($pro=mysqli_fetch_row($producto))
                                    {
                                ?>
                                <option value="<?php echo $pro[0] ?>" ><?php echo $pro[1] ?></option>
                                <?php
                                    }

                                ?>               
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label>Stock</label>
                            <input readonly class="form-control" id="txtstock" name="txtstock" type="number"/>
                        </div>
                        <div class="col-lg-2">
                            <label>Precio</label>
                            <input readonly  class="form-control" id="txtprecio" name="txtprecio" type="number"/>
                        </div>
                        <div class="col-lg-2">
                            <label>Cantidad</label>
                            <input  class="form-control" id="txtcantidad" name="txtcantidad" type="number"/>
                        </div>
                        <div class="col-lg-2">
                           <label>´</label>
                            <input type="button" Value="Agregar" id="btnagregar" name="btnagregar" class="form-control btn btn-primary"/>
                        </div>
                    </div>
                    </form>
                    <div class="row">
                        <div  class="col-lg-12">
                            <div id="tabla_temporal">
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                           <center>
                            <span class="btn btn-danger" id="btncancelar">Cancelar</span>
                            <span class="btn btn-success" id="btnguardar">Guardar Venta</span>
                            </center>
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
    
    function quitarp(index){
	$.ajax({
		type:"POST",
		data:"ind="+index,
		url:"../procesos/ventas/quitarproducto.php",
		success:function(r)
		{
			$('#tabla_temporal').load('tabla_temporal.php'); 
			alertify.success("Se quito el producto");
		}
	   });
    }
    
$(document).ready(function(){
   $('#tabla_temporal').load('tabla_temporal.php'); 
    


    
     $('#txtproducto').change(function (){
         if($('#txtproducto').val() != "A")
            {
                 $.ajax({
                     type:"POST",
                     data:"idproducto=" + $('#txtproducto').val(),
                     url:"../procesos/ventas/llenarproductos.php",
                     success:function(r){
                         if(r=="A"){
                            $('#txtprecio').val('');
                        }
                        else{
                            var data =JSON.parse(r);
                            $('#txtprecio').val(data['precio_venta']);
                            $('#txtstock').val(data['stock']);
                        }
                    }
                });            
            }
        else{
                            $('#txtprecio').val('');
                            $('#txtstock').val('');
            }

    });
    
    $('#btnagregar').click(function(){
        datos = $('#frmventa').serialize();
        vacios = validarFormVacio('frmventa');
        if(vacios <= 0 ){
            $.ajax({
               url:'../procesos/ventas/agregarproductotem.php',
               data : datos,
               type : 'POST',
                success:function(r)
                {
                    if(r=="camposventa")
                        {
                            alertify.error("Complete los datos para aregar producto");
                        }
                    else if(r==1)
                        {
                            $('#txtprecio').val('');
                            $('#txtstock').val('');
                            $('#txtproducto').val('A');
                            $('#tabla_temporal').load('tabla_temporal.php');
                        }
                    else if(r=="s")
                        {
                            
                            alertify.error("La cantidad es mayor al stock.");
                        }
                    else if(r=="n")
                        {
                            
                            alertify.error("Ingrese una cantidad valida");
                        }
                    else if(r==0)
                        {
                            alert(r);
                        }
                    else{
                        alert(r);
                    }
                    
                }
            });
        }
        else
            {
                alertify.error("Complete los datos para aregar producto");
            }
    });
    
    $('#btncancelar').click(function(){
        
        alertify.confirm('Venta','¿Desea cancelar la venta?', function(){
       $.ajax({
          url:'../procesos/ventas/vaciartemp.php',
           success:function(r)
           {
               $('#tabla_temporal').load('tabla_temporal.php');
                            $('#txtprecio').val('');
                            $('#txtstock').val('');
                            $('#txtproducto').val('A');
                            $('#txtcliente').val('');
           }
       });             
            alertify.success('Ok');
                            $('#txtprecio').val('');
                            $('#txtstock').val('');
                            $('#txtproducto').val('A');
                            $('#txtcliente').val('');            
        }, function(){
            alertify.error('Cancel')
        });
        

    });
    
    $('#btnguardar').click(function(){
        nom = $('#txtcliente').val();
        total = $('#txttotal').html();
        tipo = $('#txttipo').val();
        numero = $('#txtnumero').val();
        if(nom.length != 0 ){
                             datos = {
						                "txttotal" : total , "txtcliente" : nom,
                                        "txttipo" : tipo, "txtnumero" :numero
                                };
            $.ajax({
               url:'../procesos/ventas/guardar_venta.php',
               data : datos,
               type : 'POST',
                success:function(r)
                {
                    if(r=="camposventa")
                        {
                            alertify.error("Complete los datos para guardar la venta");
                        }
                    else if(r=="ok")
                        {
                            
                            $('#tabla_temporal').load('tabla_temporal.php');
                            alertify.success("Venta guardada correctamente");
                            $('#txtprecio').val('');
                            $('#txtstock').val('');
                            $('#txtproducto').val('A');
                            $('#txtcliente').val('');
                        }
                    else if(r=="v")
                        {
                            
                            alertify.error("Complete los datos para guardar la venta");
                        }

                    else if(r=="tablav")
                        {
                            
                            alertify.error("Esta venta no tiene productos");
                        }
                    else if(r==0)
                        {
                            alert(r);
                        }
                    else{
                        alert(r);
                    }
                    
                }
            });
        }
        else
            {
                alertify.error("Complete los datos para guardar la venta");
            }        
    })
    
    
});
</script>


  
