<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

<!-- =========================================
            FORMULARIO
  ===========================================-->


     <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">
                  
                <!-- =========================================
                               ENTRADA DEL VENDEDOR
                 ===========================================-->

                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div> 
                    <!-- =========================================
                               ENTRADA DEL CODIGO
                 ===========================================-->

                   <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;

                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                    if(!$ventas){

                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                  

                    }else{

                      foreach ($ventas as $key => $value) {
                        
                        
                      
                      }

                      $codigo = $value["codigo"] + 1;



                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                  

                    }

                    ?>
                    
                    
                  </div>
                
                </div>


                <!-- =========================================
                               ENTRADA EL CLIENTE
                 ===========================================-->

             <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="">Seleccionar cliente</option>

                    <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarClienteV" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
                
                </div>
                <!-- =========================================
                         ENTRADA PARA AGREGAR EL PRODUCTO
                 ===========================================-->

                <div class="form-group row nuevoProducto">

                

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!-- =========================================
                              BOTON PARA AGREGAR PRODUCTO
                  ===========================================-->

                   <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                    <hr>

                    <div class="row">



                  <!-- =========================================
                              ENTRADA IMPUESTO Y TOTAL
                    ===========================================-->
                       
                  <div class="col-xs-8 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>

                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i>Q.</i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>


                  <!-- =========================================
                              ENTRADA METODO DE PAGO
                    ===========================================-->

              
                <div class="form-group row">
                  
                  <div class="col-xs-6" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>                  
                      </select>    

                    </div>

                  </div>

                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

          </div>

        </form>

        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();
          
        ?>


        </div>
            
      </div>

<!-- =========================================
            LA TABLA DE PRODUCTOS
  ===========================================-->
      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
         <div class="box box-warning">
          
            <div class="box-header with-border"></div>

            <div class="box-body">
              
              <table class="table table-bordered table-striped dt-responsive tablaVentas">
                
                <thead>
                  
                  <tr>
                    <th style="width: 10px;">#</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                  </tr>

                </thead>
           
              </table>

            </div>
            
        </div>


      </div>
      
    </div> 

  </section>

</div>


<!-- =========================================
             MODAL AGREGAR CLIENTE
  ===========================================-->

 
<!-- Modal -->
<div id="modalAgregarClienteV" class="modal fade" role="dialog">

  <div class="modal-dialog">

    
    <div class="modal-content">

        <form role="form" method="post">  
  <!-- =========================================
             CABEZA DEL MODAL
  ===========================================-->

      <div class="modal-header" style="background: #3c8dbc; color: white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar cliente</h4>

      </div>

<!-- =========================================
             CUERPO DEL MODAL
  ===========================================-->\
      <div class="modal-body">
      
      <div class=" box-body">

        <!-- ENTRADA PARA EL NOMBRE -->

          <div class="form-group"> 

              <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-user"></i></span>

                  <input type="text" class="form-control input-lg" name="nuevoClienteV" placeholder="Ingresar nombre" required>

              </div>

          </div>

          <!-- ENTRADA PARA EL EMAIL -->

          <div class="form-group"> 

              <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                  <input type="email" class="form-control input-lg" name="nuevoEmailV" placeholder="Ingresar email" required>

              </div>

          </div>

          <!-- ENTRADA PARA EL TELÉFONO -->

          <div class="form-group"> 

              <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                  <input type="text" class="form-control input-lg" name="nuevoTelefonoV" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 9999-9999'" data-mask required>

              </div>

          </div>

           <!-- ENTRADA PARA EL DIRECCIÓN -->

          <div class="form-group"> 

              <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                  <input type="text" class="form-control input-lg" name="nuevaDireccionV" placeholder="Ingresar dirección"  required>

              </div>

          </div>


      </div>  


</div>
<!-- =========================================
             PIE DEL MODAL
  ===========================================-->
      <div class="modal-footer">

        <button type="button" class="btn btn-default  pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar cliente</button>

      </div>

      </form>


      <?php 

      $crearCliente = new ControladorClientes();
      $crearCliente -> ctrCrearClienteV();

       ?>

    </div>

  </div>

</div>  