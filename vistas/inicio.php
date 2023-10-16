<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{
date_default_timezone_set("America/Lima");

?>



    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
                
                    <div class="row">
                                <div class="col-xl-12">
                                        <div class="breadcrumb-holder">
                                                <h1 class="main-title float-left"><?php echo $_SESSION['datos']->tipo ?></h1>
                                                <div class="clearfix"></div>
                                        </div>
                                </div>
                    </div>
                    <!-- end row -->

                    
                        <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card-box noradius noborder bg-default">
                                                <i class="fa fa-shopping-cart  float-right text-white"></i>
                                                <h5 class="text-white text-uppercase m-b-20">Ventas del Dia</h5>
                                                <h4 class="m-b-20 text-white counter">
                                                                    <?php
                                                                        require_once '../clases/Reporte.php';
                                                                        require_once '../clases/Conexion.php';
                                                                        $obj1 = new Reporte();
                                                                        $r1 = $obj1->ventas_dia();
                                                                        echo $r1;
                                                                    ?>
                                                </h4>
                                                <span class="text-white"><br><br></span>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card-box noradius noborder bg-warning">
                                                <i class="fa fa-money float-right text-white"></i>
                                                <h5 class="text-white text-uppercase m-b-20">Dinero del Dia</h5>
                                                <h4 class="m-b-20 text-white counter">S/ 
                                                                    <?php
                                                                        require_once '../clases/Reporte.php';
                                                                        require_once '../clases/Conexion.php';
                                                                        $obj1 = new Reporte();
                                                                        $r1 = $obj1->dinero_dia();
                                                                        if(empty($r1))
                                                                        {
                                                                            echo "0";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $r1;
                                                                        }
                                                                        
                                                                    ?>
                                                </h4>
                                                <span class="text-white"><br><br></span>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card-box noradius noborder bg-info">
                                                <i class="fa fa-product-hunt  float-right text-white"></i>
                                                <h5 class="text-white text-uppercase m-b-20">Productos Vendidos</h5>
                                                <h4 class="m-b-20 text-white counter">
                                                                    <?php
                                                                        require_once '../clases/Reporte.php';
                                                                        require_once '../clases/Conexion.php';
                                                                        $obj2 = new Reporte();
                                                                        $r2 = $obj2->productos_dia();
                                                                        if(empty($r2))
                                                                        {
                                                                            echo "0";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $r2;
                                                                        }
                                                                    ?>
                                                </h4>
                                                <span class="text-white"><br></span>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card-box noradius noborder bg-danger">
                                                <i class="fa fa-bell-o float-right text-white"></i>
                                                <h5 class="text-white text-uppercase m-b-20">Stock<br> Bajo</h5>
                                                <h4 class="m-b-20 text-white counter">
                                                                    <?php
                                                                        require_once '../clases/Reporte.php';
                                                                        require_once '../clases/Conexion.php';
                                                                        $obj2 = new Reporte();
                                                                        $r2 = $obj2->stock_0();
                                                                        echo $r2;
                                                                    ?>
                                                </h4>
                                                <span class="text-white"><br></span>
                                        </div>
                                </div>
                        </div>
                        <!-- end row -->


                        
                        <div class="row">
                        
                                <H4>Tabla de productos con stock menor a 10 unidades</H4>
<table id="dtventas" class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Producto</td>
                            <td>Stock</td>
                            <!--<td>Fecha Sepelio</td>-->
                            <td style="width:15px"></td>
                        </tr>
                    </thead>
                    <tbody>

<?php
        require_once '../clases/Conexion.php';
        require_once '../clases/Reporte.php';
        $obj = new Reporte();
        $result = $obj->productos_0();
	while($fila=mysqli_fetch_row($result))
	{
 ?>
    <tr>
		<td><?php echo $fila[0] ?></td>
		<td><?php echo $fila[1] ?></td>
		<td><?php echo "<h5 style='color:red;'>$fila[2]</h5>"; ?></td>


	</tr>
	<?php
} ?>

                    </tbody>
</table>
                                
                        </div>
                        <!-- end row -->
 

        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

</div>
<!-- END content-page -->



<?php
require 'footer.php';
?>

<script>
$(document).ready(function() {
			

} );		
</script>
	
	
<!-- END Java Script for this page -->


<?php
}
else {
	header("location:../index.php");  
}

?>