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
          
          <form role="form" method="post">
          
            <div class="box-body">
            
              <div class="box">
              
                <!-- USUARIO DE REGISTRO SALIDAS -->
                <div class="form-group">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevoUsuario" name="nuevoUsuario" value="admin" readonly>
                  
                  </div>
                
                </div>

                <!-- CODIGO DE TARJETA DE SALIDA -->
                <div class="form-group">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" id="nuevaSalida" name="nuevaSalida" value="1000123" readonly>
                  
                  </div>
                
                </div>

                <!-- MOTIVO DE SALIDA -->
                <div class="form-group">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                    <select class="form-control" name="motivoSalida" id="motivoSalida" required>
                      <option value="">Seleccionar Motivo de Salida</option>
                      <option value="0">Venta</option>
                      <option value="1">Merma</option>
                    </select>
                  
                  </div>
                
                </div>
                
                <div class="form-group row nuevoProducto">
                
                  <div class="col-xs-6" style="padding-right:0px">
                    
                    <div class="input-group">
                    
                      <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs">
                      <i class="fa fa-times"></i></button></span>
                      <input type="text" class="form-control" id="agregarProducto" name="agregarProducto" style="float: none" placeholder="Nombre del Producto" required>
                    
                    </div>
                  
                  
                  </div>

                  <div class="col-xs-3">
                  
                    <input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" placeholder="0"
                    min="1" required>
                  
                  </div>

                  <div class="col-xs-3" style="padding-left:0px">
                  
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                      
                      <input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" placeholder="000000" min="1" readonly required>

                    
                    </div>
                  
                  </div>
                
                </div>

                <button type="button" class="btn btn-primary hidden-lg">Agregar Producto</button>
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
                              
                              <input type="number" min="1" class="form-control" id="nuevoTotalSalida" name="nuevoTotalSalida" placeholder="00000" readonly required>
                            
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
        
        </div>

      </div>

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
      
        <div class="box box-warning">
        
          <div class="box-header with-border"></div>

          <div class="box-body">
          
            <table class="table table-bordered table-striped dt-responsive tablas">
            
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
              
                <tr>
                  
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

                </tr>
              
              </tbody>
            
            </table>
          
          </div>
        
        </div>

      </div>

    </div>    

  </section>

</div>