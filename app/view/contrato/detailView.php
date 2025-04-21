<?php
$title = 'Contrato | Detalle';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>


<div class="container-fluid">

  <h4 class="text-left mt-3">
    <a href="/<?php echo APP_NAME; ?>/Contrato" class="text-secondary">
      Contrato
    </a>
    > Detalle
  </h4>

  <div class="accordion" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
          aria-expanded="true" aria-controls="collapseOne">
          <h3 class="">
            Información general del contrato
          </h3>
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">

          <div class="row p-3 text-center">
            <?php
            if ($datos['ESTADO']){ ?>
            <div class="col-12 text-center">
              <div class="alert alert-warning" role="alert">
                Pendiente
              </div>
            </div>
            <?php } else {?>
            <div class="col-12 text-center">
              <div class="alert alert-success" role="alert">
                Completado
              </div>
            </div>

            <?php } ?>
            <div class="col-6">
              <p>
                <b>Contrato realizado por:</b>
                <?php echo $datos['EMPLEADO'] ?>
              </p>
              <p><b> Celular:</b>
                <?php echo $datos['CELULAR'] ?>
              </p>
            </div>

            <div class="col-6">
              <p> <b>Cliente:</b>
                <?php echo $datos['RAZONSOCIAL'] ?>
              </p>

              <p> <b>Telefono:</b>
                <?php echo $datos['TELEFONO'] ?>
              </p>

              <p> <b>Tipo de cliente:</b>
                <?php echo ucwords($datos['CODTIPO']) ?>
              </p>
            </div>

            <div class="col-6">
              <p>
                <b>FECHA DE INICIO:</b><br>
                <?php echo $datos['FECHA_INICIO'] ?>
              </p>

            </div>
            <div class="col-6">
              <p>
                <b>FECHA DE INICIO:</b> <br>
                <?php echo $datos['FECHA_ENTREGA'] ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
          aria-expanded="false" aria-controls="collapseTwo">
          <h3>Detalle del contrato </h3>

        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

          <div class="col-12 mt-3 ">
            <div class="row justify-content-center align-items-center">
              <div class="col-5 text-left ">
                <p><b>Costo mano de obra : Bs. </b>
                  <?php echo  $datos['COSTO_SASTRE'] ?>
                </p>

                <p><b>Fruncido : cm. </b>
                  <?php echo  $datos['FRUNCIDO'] ?>
                </p>
              </div>

              <div class="col-3 text-left">
                <p><b>Tela: </b>
                  <?php echo $datos['NOMBRE'] ?>
                </p>
                <p><b>Cantidad (m): </b>
                  <?php echo $datos['METROS_TELA'] ?>
                </p>

                <p><b>Precio tela: </b>
                  <?php echo ' Bs.  ' . $datos['COSTO_TOTAL_TELA'] ?>
                </p>

              </div>
              <div class="col-3 text-left">

                <p><b>Marca: </b>
                  <?php echo $datos['MARCA'] ?>
                </p>
                <p><b>Calidad: </b>
                  <?php echo $datos['CALIDAD'] ?>
                </p>
              </div>

              <div class="col-5 text-center">
                <p><b>Total (Bs):
                    <?php echo $datos['TOTAL'] ?>
                  </b></p>
              </div>
            </div>

          </div>
          <div class="col-12 mt-3">
            <p>
              <b>Descripción:</b>
            </p>
            <div class="col-12 bg-light p-3">
              <p class="ml-5 ">
                <?php echo $datos['DESCRIPCION'] ?>
              </p>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <h3>Material e instalación</h3>

        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

          <div class="row">
            <?php if($msg['c_herraje'] != 0){ ?>

            <p><b>N° De ventanas: </b>
              <?php echo  $msg['ventanas'] ?>
            </p>
            <div class="col-4 text-left ">
              <p><b>Metros de tubo: (m.) </b>
                <?php echo  $msg['metrosTubo'] ?>
              </p>
              <p><b>N° Herrajes: </b>
                <?php echo  $msg['numHerraje'] ?>
              </p>
            </div>

            <div class="col-4 text-left ">
              <p><b>Costo del tubo: (Bs.)</b>
                <?php echo  $msg['c_tubo'] ?>
              </p>
              <p><b>Costo del Herraje: (Bs.) </b>
                <?php echo  $msg['c_herraje'] ?>
              </p>
            </div>

            <div class="col-4 text-left ">
              <p><b>Costo Total: (Bs.)</b>
                <?php echo  $msg['metrosTubo'] * $msg['c_tubo'] ?>
              </p>
              <p><b>Costo Total: (Bs.) </b>
                <?php echo  $msg['numHerraje'] * $msg['c_herraje'] ?>
              </p>
            </div>
            <?php } else{ ?>
            <div class="col-12 text-center">
              <div class="alert alert-warning" role="alert">
                Sin material de instalación
              </div>
            </div>

            <?php
            } ?>


            <?php if($msg['c_instalacion'] == 0){ ?>
            <div class="col-12 text-center">
              <div class="alert alert-warning" role="alert">
                Sin instalación
              </div>
            </div>

            <?php }else{ ?>
            <div class="col-12 text-center">
              <p><b>Costo de instalacion: (Bs.)</b>
                <?php echo  $msg['c_instalacion']?>
              </p>

            </div>

            <?php } ?>

          </div>
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <h3>Dimensiones y cantidad</h3>

        </button>
      </h2>
      <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

          <div class="col-12 text-center sub-title-sucursal ">
            <h4>Medidas y cantidad</h4>
            <div class="col-12 text-center">

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"> Alto (m)</th>
                    <th scope="col"> Ancho (m)</th>
                    <th scope="col"> Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($datos2 as $row) { ?>
                  <tr>
                    <td>
                      <?php echo $row['ALTO']; ?>
                    </td>
                    <td>
                      <?php echo $row['ANCHO']; ?>
                    </td>

                    <td>
                      <?php echo $row['CANTIDAD']; ?>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>




  <div class="col-12  text-center mt-3">
    <a href="/<?php echo APP_NAME ?>/Contrato" class="btn btn-primary">
      Volver
    </a>
    <a href="/<?php echo APP_NAME ?>/Contrato/Pdf?id=<?php echo $datos['CODCONTRATO'] ?>" class="btn btn-success ml-5"
      target="_blank">
      PDF
    </a>
  </div>
</div>
</div>






</div>

<?php
include_once '../app/view/nav/inferior.php';
include_once '../app/view/template/footer.php';

?>