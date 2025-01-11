<?php
$title = 'Sucursal | Detalle';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>
<div class="container-fluid">
  <div class="row ml-1 my-3">
    <div class="col-10">
      <h4 class="text-left">
        <a href="/<?php echo APP_NAME; ?>/Sucursal" class="text-secondary">
          Sucursal
        </a>
        > Detalle
      </h4>
    </div>
    <div class="col-2">
      <a href="/<?php echo APP_NAME ?>/Sucursal/" class="btn btn-primary">Volver</a>
      </di2v>
    </div>


    <div class="container cont-table p-3">
      <div class="row justify-content-center info-sucursal">

        <div class="col-12 text-center title-sucursal ">
          <h2>
            <?php echo $datos['NOMBRE'] ?>
          </h2>
        </div>
        <div class="row p-3">
          <div class="col-4">
            <p class="sub-sucursal">Direccion: </p>
            <p>
              <?php echo $datos['DIRECCION'] ?>
            </p>
          </div>
          <div class="col-4">
            <p class="sub-sucursal">Detalle:</p>
            <p>
              <?php echo $datos['DESCRIPCION'] ?>
            </p>
          </div>
          <div class="col-4">
            <p class="sub-sucursal">Telefono:</p>
            <p>
              <?php echo $datos['TELEFONO'] ?>
            </p>
          </div>

          <div class="col-12 text-center">
            <p class="sub-sucursal">Encargado (actual)*:</p>
            <p>
              <?php echo $datos['ENCARGADO'] ?>
            </p>
          </div>

        </div>



      </div>
      <div class="row">
        <div class="col-12 text-center sub-title-sucursal ">
          <h4>Historial de Encargado(s)</h4>
        </div>

        <div class="col-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col"> Nombre</th>
                <th scope="col"> Celular</th>
                <th scope="col"> Inicio</th>
                <th scope="col"> Fin</th>

              </tr>
            </thead>
            <tbody>
              <?php foreach ($msg as $row) {
                if ($row['FIN'] == null) {
                  echo "<tr class='bg-info'>";

                } else {
                  echo '<tr>';
                }
                ?>

                <td>
                  <?php echo $row['NOMBRE']; ?>
                </td>
                <td>
                  <?php echo $row['CELULAR']; ?>
                </td>
                <td>
                  <?php echo $row['INICIO']; ?>
                </td>
                <td>
                  <?php
                  if ($row['FIN'] == null)
                    echo 'Sup. Actual';
                  else
                    echo $row['FIN'];
                  ?>
                </td>

                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center sub-title-sucursal ">
          <h4>EMPLEADOS</h4>
        </div>

        <div class="col-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col"> Nombre</th>
                <th scope="col"> Celular</th>
                <th scope="col"> Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($datos2 as $row) { ?>
                <tr>
                  <td>
                    <?php echo $row['EMPLEADO']; ?>
                  </td>
                  <td>
                    <?php echo $row['CELULAR']; ?>
                  </td>
                  <td>
                    <?php echo $row['ESTADO']; ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>






    <?php
    include_once '../app/view/nav/inferior.php';
    include_once '../app/view/template/footer.php';

    ?>