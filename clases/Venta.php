<?php
date_default_timezone_set("America/Lima");
class Venta{
            public function save($clientee,$total,$tipo,$numero)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$cliente = $c->test_input($clientee);
            $fecha = date('y-m-d');
			$sql = "INSERT INTO ventas(cliente,fecha,estado,total,tipo,numero) values('$cliente','$fecha','activo','$total','$tipo','$numero')";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }
            public function save_detalle()
        {
            $c = new Conexion();
			$conexion = $c->conectar();
            $id = self::trae_venta();

            
            if(isset($_SESSION['tablacomprastemp']))
            {
            $datos = $_SESSION['tablacomprastemp'];
            $r=0;
            for($i=0;$i < count($datos);$i++)
            {
                $d = explode("||",$datos[$i]);
                $sql = "INSERT into detalle_ventas(id_ventas,id_productos,cantidad,precio,importe)
                values('$id','$d[4]','$d[2]','$d[1]','$d[3]')";
                $this->baja_stock($d[2],$d[4]);
                $r = $r + $result = mysqli_query($conexion,$sql);
                
            }   
            return $r;
            }
                else{
                return "not";
            }

        }
            public function trae_venta()
        {
            $c = new Conexion();
			$conexion = $c->conectar();
            $sql = "SELECT id_venta from ventas group by id_venta desc";
            $result= mysqli_query($conexion,$sql);
            $id=mysqli_fetch_row($result)[0];

              return $id ;
        }
            public function baja_stock($stock,$id)
            {
            $c = new Conexion();
			$conexion = $c->conectar();
            $sql = "CALL baja_stock('$stock','$id')";
            $result= mysqli_query($conexion,$sql);
            return $result;
            }
    public function mostrar()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from ventas where estado = 'activo'";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }
    public function mostrar_porid($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select id_venta,cliente,fecha,total,tipo,numero from ventas where id_venta = '$id'";
			$result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            $datos = array(
               "id_venta" =>html_entity_decode($ver[0]),
               "cliente" =>html_entity_decode($ver[1]),
               "fecha" =>html_entity_decode($ver[2]),
               "total" =>html_entity_decode($ver[3]),
               "tipo" =>html_entity_decode($ver[4]),
               "numero" =>html_entity_decode($ver[5])
             );
            return $datos;
    }
    public function traer_detalles($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select de.cantidad,p.nombre,de.precio,de.importe from detalle_ventas as de
            inner join productos as p on p.id_producto=de.id_productos where de.id_ventas = $id";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }
    public function marcar_venta($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "update ventas set estado = 'vista' where id_venta = '$id'";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }
            public function consultar_venta($f1,$f2)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
            $sql = "SELECT * FROM ventas WHERE fecha BETWEEN '$f1' AND '$f2'";
            $result= mysqli_query($conexion,$sql);

              return $result ;
    }
        
    
}
