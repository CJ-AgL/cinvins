

  <div class="content-wrapper">
    
    <section class="content-header">

      <h1>
      Administrar Clientes

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

        <li class="active">Administrar categorías</li>

      </ol>

    </section>


  <section class="content">

      <div class="box">

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
            
            Agregar Cliente

          </button>
        
        </div>


          <div class="box-body">
          
          <table class="table table-bordered table-striped dt-responsive tablas">
            
            <thead>
              
              <tr>
                
                <th style="width: 10px">#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Total compras</th>
                <th>Última compra</th>
                <th>Ingreso al sistema</th>
                <th>Acciones</th>             

              </tr>

            </thead>

            <tbody>

                <tr>  
                <td>1</td>

                <td>Cristian Aguilar</td>
                <td>josue@gmail.com</td>
                <td>48226699</td>
                <td>Chiquimuillla</td>
                <td>25</td>
                <td>11/09/2022</td>
                <td>2021-12-11 12:05:32</td>  

                <td>
                  
                  <div class="btn-group">
                    
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                  </div>

                </td>

              </tr>

            </tbody>

          </table>

        </div>
    
    </div>
  
  </section>

</div>

<!-- =========================================
             MODAL CATEGORIA
  ===========================================-->

 
<!-- Modal -->
<div id="modalAgregarCliente" class="modal fade" role="dialog">

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

                  <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

          </div>

          <!-- ENTRADA PARA EL EMAIL -->

          <div class="form-group"> 

              <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                  <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar Email" required>

              </div>

          </div>

          <!-- ENTRADA PARA EL TELÉFONO -->

          <div class="form-group"> 

              <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                  <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 9999-9999'" data-mask required>

              </div>

          </div>

           <!-- ENTRADA PARA EL DIRECCIÓN -->

          <div class="form-group"> 

              <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                  <input type="text" class="form-control input-lg" name="nuevaDireccíon" placeholder="Ingresar Dirección"  required>

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

    </div>

  </div>

</div>