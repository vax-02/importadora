  <?php
$title = 'Venta | Detalle';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

  <div class="container-fluid">
      <h4 class="text-left mt-3">
          <a href="/<?php echo APP_NAME; ?>/Venta" class="text-secondary">
              Ventas
          </a>
          > Detalle
      </h4>

      <div class="container cont-table p-3">
          <div class="row justify-content-center info-sucursal">

              <div class="col-12 text-center title-sucursal ">
                  <h2>
                      Detalle de la venta
                  </h2>
              </div>
              <div class="row p-3 text-center">
                  <div class="col-4">
                      <p class="sub-sucursal">Vendedor: </p>
                      <p>
                          <?php echo $datos['IDPERSONAL'] ?>
                      </p>
                  </div>
                  <div class="col-4">
                      <p class="sub-sucursal">Cliente: </p>
                      <p>
                          <?php echo $datos['CLIENTE'] ?>
                      </p>
                  </div>

                  <div class="col-4">
                      <p class="sub-sucursal">Sucursal:</p>
                      <p>
                          <?php echo $datos['CODSUCURSAL'] ?>
                      </p>
                  </div>
                  <div class="col-12">
                      <p class="sub-sucursal">FECHA Y HORA:</p>
                      <p>
                          <?php echo $datos['FECHA_VENTA'] ?>
                      </p>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-12 text-center sub-title-sucursal ">
                  <h4>Detalle de los productos vendidos</h4>
              </div>

              <div class="col-12">
                  <table class="table text-center">
                      <thead>
                          <tr>
                              <th scope="col"> Nombre</th>
                              <th scope="col"> Color</th>
                              <th scope="col"> Calidad</th>
                              <th scope="col"> Cantidad</th>
                              <th scope="col"> Precio</th>
                              <th scope="col" class="sub-total"> Subtotal</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          
                          $total = 0;
                          foreach ($datos2 as $row) { ?>
                          <tr>
                              <td>
                                  <?php echo $row['NOMBRE']; ?>
                              </td>

                              <td>
                                  <div
                                      style="display:inline-block; width:15px; height:15px; border: 1px solid #000000; background: <?php echo $row['CODCOLOR'] ?>;">
                                  </div>
                              </td>

                              <td>
                                  <?php echo $row['CALIDAD']; ?>
                              </td>
                              <td>
                                  <?php echo $row['CANTIDAD']; ?>
                              </td>
                              <td>
                                  <?php echo $row['PRECIO']; ?>
                              </td>

                              <td>
                                  <?php 
                                  $total += $row['CANTIDAD'] * $row['PRECIO'];
                                   echo $row['CANTIDAD'] * $row['PRECIO']; ?>
                              </td>
                          </tr>
                          <?php } 
                          ?>
                          <tr>
                              <td colspan="4"></td>
                              <td>Monto total: </td>
                              <td> <?php echo $total ?> </td>
                          </tr>
                      </tbody>
                  </table>
              </div>

              <div class="col-12  text-center mt-3">
                  <a href="/<?php echo APP_NAME ?>/Venta" class="btn btn-primary">
                      Volver
                  </a>
                  <a href="/<?php echo APP_NAME ?>/Venta/pdf?id=<?php echo $datos['CODVENTA'] ?>" target="_blank"
                      class="btn btn-success ml-5">
                      RECIBO
                  </a>


                  <a href="/<?php echo APP_NAME ?>/Venta/Contrato?id=<?php echo $datos['CODVENTA'] ?>" target="_blank"
                      class="btn btn-secondary ml-5">
                      CONTRATO
                  </a>

              </div>
          </div>
      </div>






  </div>

  <?php
include_once '../app/view/nav/inferior.php';
include_once '../app/view/template/footer.php';

?>
