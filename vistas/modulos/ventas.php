<?php 

if($_SESSION["perfil"] == "Especial"){

  echo '<script>


  window.location = "inicio";

  </script>';

  return;

}
?>

  <div class="content-wrapper">
    
    <section class="content-header">

      <h1>
      Administrar Ventas

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

        <li class="active">Administrar ventas</li>

      </ol>

    </section>


  <section class="content">

      <div class="box">

        <div class="box-header with-border">

          <a href="crear-venta">

            <button class="btn btn-success">
              
              Agregar venta 

            </button>
          </a>

          <button type="button" class="btn btn-default pull-right" id="daterange-btn">
            
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

              <i class="fa fa-caret-down"></i>

          </button>

        </div>


          <div class="box-body">
          
          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            
            <thead>
              
              <tr>
                
                <th style="width: 10px">#</th>
                <th>Codigo</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Neto</th>
                <th>Total</th>
                <th>Fecha</th>
                <th style="width: 10px">Acciones</th>             

              </tr>

            </thead>

            <tbody>

              <?php

              if(isset($_GET["fechaInicial"])){

                  $fechaInicial = $_GET["fechaInicial"];
                  $fechaFinal = $_GET["fechaFinal"];

                }else{

                  $fechaInicial = null;
                  $fechaFinal = null;

                }

                // var_dump('$fechaInicial', $fechaInicial);

                // var_dump('$fechaFinal', $fechaFinal);

               $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);


              foreach ($respuesta as $key => $value) {
                
                echo '
                <tr>  
                <td>'.($key+1).'</td>

                <td>'.$value["codigo"].'</td>';

                $itemCliente = "id";
                $valorCliente = $value["id_cliente"];

                $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

               echo '<td>'.$respuestaCliente["nombre"].'</td>';

               $itemUsuario= "id";
               $valorUsuario= $value["id_vendedor"];

                $respuestaUsuario= ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

               echo '<td>'.$respuestaUsuario["nombre"].'</td>
               
                <td>Q. '.number_format($value["neto"], 2, '.', '').'</td>
                <td>Q. '.number_format($value["total"], 2, '.', '').'</td>
                <td>'.$value["fecha"].'</td>  

                <td>
                  
                  <div class="btn-group">
                    
                    <button class="btn btn-warning btnImprimirFactura"  codigoVenta="'.$value["codigo"].'">

                    <i class="fa fa-print"></i></button>
                    


                  </div>

                </td>

              </tr>';


              }

              ?>

            </tbody>

          </table>


        </div>
    
    </div>
  
  </section>

</div>

