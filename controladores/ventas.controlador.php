<?php


class ControladorVentas{

  /*=============================================
  MOSTRAR VENTAS
  =============================================*/

  static public function ctrMostrarVentas($item, $valor){

    $tabla = "ventas";

    $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

    return $respuesta;

  }

  /*=============================================
  CREAR VENTA
  =============================================*/

  static public function ctrCrearVenta(){

    if(isset($_POST["nuevaVenta"])){

      /*=============================================
      ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
      =============================================*/

      $listaProductos = json_decode($_POST["listaProductos"], true);

      $totalProductosComprados = array();

      foreach ($listaProductos as $key => $value) {

         array_push($totalProductosComprados, $value["cantidad"]);
        
         $tablaProductos = "productos";

          $item = "id";
          $valor = $value["id"];
          $orden = "id";

          $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

        $item1a = "ventas";
        $valor1a = $value["cantidad"] + $traerProducto["ventas"];

          $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

        $item1b = "stock";
        $valor1b = $traerProducto["stock"] - $value["cantidad"];

        $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

      }

      $tablaClientes = "clientes";

      $item = "id";
      $valor = $_POST["seleccionarCliente"];

      $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

      $item1a = "compras";
      $valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

      $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

      $item1b = "ultima_compra";


      date_default_timezone_set('America/Guatemala');

      $fecha = date('Y-m-d');
      $hora = date('H:i:s');
      $valor1b = $fecha.' '.$hora;

      $fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

      


      /*=============================================
      GUARDAR LA COMPRA
      =============================================*/ 

      $tabla = "ventas";

      $datos = array("id_vendedor"=>$_POST["idVendedor"],
               "id_cliente"=>$_POST["seleccionarCliente"],
               "codigo"=>$_POST["nuevaVenta"],
               "productos"=>$_POST["listaProductos"],
               "impuesto"=>$_POST["nuevoPrecioImpuesto"],
               "neto"=>$_POST["nuevoPrecioNeto"],
               "total"=>$_POST["totalVenta"]);

      $respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

      if($respuesta == "ok"){

        echo'<script>

        localStorage.removeItem("rango");

        swal({
            type: "success",
            title: "La venta ha sido guardada correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then((result) => {
                if (result.value) {

                window.location = "ventas";

                }
              })

        </script>';

      }

    }

  }

   /*=============================================
      RANGO DE FECHAS 
    =============================================*/ 

    static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

      $tabla = "ventas";


      $nuevafecha = strtotime('+1 day', strtotime($fechaFinal));
      $fechaFinal = date ('Y-m-d', $nuevafecha);


      $respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

      return $respuesta;

    }

/*=============================================
  DESCARGAR EXCEL
  =============================================*/

  public function ctrDescargarReporte(){

    if(isset($_GET["reporte"])){

      $tabla = "ventas";

      if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

        $ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

      }else{

        $item = null;
        $valor = null;

        $ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

      }


      /*=============================================
      CREAMOS EL ARCHIVO DE EXCEL
      =============================================*/

      $Name = $_GET["reporte"].'.xls';

      header('Expires: 0');
      header('Cache-control: private');
      header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
      header("Cache-Control: cache, must-revalidate"); 
      header('Content-Description: File Transfer');
      header('Last-Modified: '.date('D, d M Y H:i:s'));
      header("Pragma: public"); 
      header('Content-Disposition:; filename="'.$Name.'"');
      header("Content-Transfer-Encoding: binary");

      echo utf8_decode("<table border='0'> 

          <tr> 
          <td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
          <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
          <td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
          <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
          <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
          <td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
          <td style='font-weight:bold; border:1px solid #eee;'>NETO</td>    
          <td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>   
          <td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>   
          </tr>");

      foreach ($ventas as $row => $item){

        $cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
        $vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

       echo utf8_decode("<tr>
            <td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
            <td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
            <td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
            <td style='border:1px solid #eee;'>");

        $productos =  json_decode($item["productos"], true);

        foreach ($productos as $key => $valueProductos) {
            
            echo utf8_decode($valueProductos["cantidad"]."<br>");
          }

        echo utf8_decode("</td><td style='border:1px solid #eee;'>"); 

        foreach ($productos as $key => $valueProductos) {
            
          echo utf8_decode($valueProductos["descripcion"]."<br>");
        
        }

        echo utf8_decode("</td>
          <td style='border:1px solid #eee;'>Q. ".number_format($item["impuesto"],2)."</td>
          <td style='border:1px solid #eee;'>Q. ".number_format($item["neto"],2)."</td>  
          <td style='border:1px solid #eee;'>Q. ".number_format($item["total"],2)."</td>
          <td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>   
          </tr>");


      }


      echo "</table>";

    }

  }
  
  /*=============================================
  SUMA TOTAL VENTAS
  =============================================*/

  public function ctrSumaTotalVentas(){

    $tabla = "ventas";

    $respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

    return $respuesta;

  }

}