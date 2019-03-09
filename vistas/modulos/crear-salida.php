<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear Salida
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear Salida</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-lg-5 col-xs-12">
      
        <div class="box box-success">
        
          <div class="box-header with-border"></div>
          
          <form role="form" method="post" class="formularioSalida">
          
            <div class="box-body">
            
              <div class="box">
              
                <!-- USUARIO DE REGISTRO SALIDAS -->
                <div class="form-group">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoUsuario" 
                    value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">
                  
                  </div>
                
                </div>

                <!-- CODIGO DE TARJETA DE SALIDA -->
                <div class="form-group">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php  
                    
                      $item = null;
                      $valor = null;

                      $salidas = ControladorSalidas::ctrMostrarSalidas($item, $valor);

                      if(!$salidas){

                        echo '<input type="text" class="form-control" id="nuevaSalida" name="nuevaSalida" value="10001" readonly>';

                      }
                      else{
                        foreach ($ventas as $key => $value) {
                          
                        }

                        $codigo = $value["codigo"] + 1;

                        echo '<input type="text" class="form-control" id="nuevaSalida" name="nuevaSalida" value="'.$codigo.'" readonly>';
                      }
                    
                    ?>
                  
                  </div>
                
                </div>

                <!-- MOTIVO DE SALIDA -->
                <div class="form-group">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                    <select class="form-control" name="motivoSalida" id="motivoSalida" required>
                      <option value="">Seleccionar Motivo de Salida</option>
                      <option value="Venta">Venta</option>
                      <option value="Merma">Merma</option>
                    </select>
                  
                  </div>
                
                </div>
                
                <div class="form-group row nuevoProducto">
                
                  
                
                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <button type="button" class="btn btn-primary hidden-lg btnAgregarProducto">Agregar Producto</button>
                <hr>

                <div class="row">
                
                  <div class="col-xs-6 pull-right">

                    <table class="table">
                    
                      <thead>
                      
                        <tr>
                        
                          <th>Total</th>
                        
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                        
                          <td style="width:50%">
                          
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                              
                              <input type="text" class="form-control input-lg" id="nuevoTotalSalida" name="nuevoTotalSalida" placeholder="00000" readonly required>

                              <input type="hidden" name="totalSalida" id="totalSalida">
                            
                            </div>
                          
                          </td>
                        
                        </tr>
                      
                      </tbody>
                    
                    </table>

                  </div>
                
                </div>
              
              </div>
          
            </div>

            <div class="box-footer">
            
              <button type="submit" class="btn btn-primary pull-right">Guardar Tarjeta</button>
            
            </div>

          </form>

          <?php

            $guardarSalida = new ControladorSalidas();
            $guardarSalida -> ctrCrearSalida();

          ?>
        
        </div>

      </div>

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
      
        <div class="box box-warning">
        
          <div class="box-header with-border"></div>

          <div class="box-body">
          
            <table class="table table-bordered table-striped dt-responsive tablaSalidas">
            
              <thead>
              
                <tr>
                  
                  <th style="width:10px">#</th>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Stock</th>
                  <th>Proovedor</th>
                  <th>Acciones</th>

                </tr>
              
              </thead>

              <tbody>
              
                <!-- <tr>
                  
                  <th style="width:10px">#</th>
                  <th>Diclofenaco</th>
                  <th>Medicamento</th>
                  <th>20</th>
                  <th>Casa Medicin</th>
                  <th>
                  
                    <div class="btn-group">
                    
                      <button class="btn btn-primary">Agregar</button>
                    
                    </div>
                  
                  </th>

                </tr> -->
              
              </tbody>
            
            </table>
          
          </div>
        
        </div>

      </div>

    </div>    

  </section>

</div>