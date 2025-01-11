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

  <div class="container cont-table p-3">
    <div class="row justify-content-center info-sucursal">

      <div class="col-12 text-center title-sucursal ">
        <h2>Información del contrato
        </h2>
        
        <?php
        if ($datos['ESTADO']) {
          ?>
          <small class="bg-success p-2 text-light">Pendiente</small>
          <?php
        } else {
          ?>
          <small class="bg-warning bg-opacity-50 p-2 text-light">Atendido</small>
          <?php
        }
        ?>
      </div>

      <div class="row p-3 text-center">
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

    <div class="row">
      <div class="col-12 text-center sub-title-sucursal ">
        <h4>Detalle del contrato </h4>
      </div>
      <div class="col-12 mt-3">
        <div class="row justify-content-center align-items-center">
          <div class="col-5 text-left">
            <p><b>Costo de trabajo: </b>
              <?php echo ' Bs.  ' . $datos['COSTO_SASTRE'] ?>
            </p>

          </div>

          <div class="col-3 text-left">
            <p><b>Tela: </b>
              <?php echo $datos['NOMBRE'] ?>
            </p>
            <p><b>Cantidad (m): </b>
              <?php echo $datos['METROS_TELA'] ?>
            </p>

            <p><b>Precio: </b>
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


      <div class="col-12 text-center sub-title-sucursal ">
        <h4>Medidas y cantidad</h4>
      </div>
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

    <div class="col-12  text-center mt-3">
      <a href="/<?php echo APP_NAME ?>/Contrato" class="btn btn-primary">
        Volver
      </a>
      <a href="/<?php echo APP_NAME ?>/Contrato/Pdf?id=<?php echo $datos['CODCONTRATO'] ?>"
        class="btn btn-success ml-5" target="_blank">
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