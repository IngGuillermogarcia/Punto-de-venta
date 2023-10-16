<?php
date_default_timezone_set("America/Lima");
class Reporte{
    
    public function ventas_dia(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('y-m-d');
            $sql = "SELECT COUNT(*) FROM ventas where fecha='$fecha'";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

              return $re ;
    }
    public function dinero_dia(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('y-m-d');
            $sql = "SELECT SUM(total) FROM ventas where fecha='$fecha'";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

            return $re ;
    }
    public function stock_0(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('y-m-d');
            $sql = "SELECT count(id_producto) FROM productos where stock < 10";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

            return $re ;
    }
    public function productos_dia(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('y-m-d');
            $sql = "SELECT SUM(de.cantidad) FROM detalle_ventas AS de
            INNER JOIN ventas AS ve ON ve.id_venta=de.id_ventas
            WHERE ve.fecha = '$fecha'";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

            return $re ;
    }
    
    public function productos_0(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('y-m-d');
            $sql = "SELECT id_producto,nombre,stock from productos where stock < 10 order by stock asc";
            $result= mysqli_query($conexion,$sql);
            return $result ;
    }
    public function productos_01(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('y-m-d');
            $sql = "SELECT pro.id_producto,pro.nombre,pro.precio_compra,pro.precio_venta,pro.stock,pr.nombre as id_proveedor,ca.nombre
            as id_categoria FROM categorias AS ca
            INNER JOIN productos AS pro ON pro.id_categoria=ca.id_categoria INNER JOIN proveedores AS pr ON pr.id_proveedor=pro.id_proveedor where stock < 10 order by stock asc";
            $result= mysqli_query($conexion,$sql);
            return $result ;
    }
    
}

?>