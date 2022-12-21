<?php

require_once "conexion.php";

class ModeloVentas{

   /*=============================================
   MOSTRAR VENTAS
   =============================================*/

   static public function mdlMostrarVentas($tabla, $item, $valor){

      if($item != null){

         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

         $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

         $stmt -> execute();

         return $stmt -> fetch();

          }else{

         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

         $stmt -> execute();

         return $stmt -> fetchAll();

      }
      
      $stmt -> close();

      $stmt = null;

   }


   /*=============================================
   REGISTRO DE VENTA
   =============================================*/


   static public function mdlIngresarVenta($tabla, $datos){

      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, productos, impuesto, neto, total) VALUES (:codigo, :id_cliente, :id_vendedor, :productos, :impuesto, :neto, :total)");

      $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
      $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
      $stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
      $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
      $stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
      $stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
      $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
      

      if($stmt->execute()){

         return "ok";

      }else{

         return "error";
      
      }

      $stmt -> close();
      $stmt = null;



      }


   /*=============================================
   RANGO FECHAS
   =============================================*/ 

   static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

      if($fechaInicial == null){

         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

         $stmt -> execute();

         return $stmt -> fetchAll();   


      }else if($fechaInicial == $fechaFinal){

         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

         $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

         $stmt -> execute();

         return $stmt -> fetchAll();


         }else{


            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

         }
      
         $stmt -> execute();

         return $stmt -> fetchAll();

      }



   /*=============================================
   RANGO FECHAS
   =============================================*/ 

   static public function mdlSumaTotalVentas($tabla){

      $stmt = Conexion::conectar()-prepare("SELECT SUM(neto) as total FROM $tabla");

      $stmt - execute();

      return $stmt - fetch();

      $stmt - close();

      $stmt = null;

   }

}