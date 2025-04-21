<?php
$title = 'Venta';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';


?>



<div class="container-fluid">
  <div class="row ml-1 my-3 title-option">
    <div class="col-lg-8 col-md-6 col-sm-10">
      <h4 class="text-left">
        <a href="/<?php echo APP_NAME; ?>/Venta" class="text-secondary">
          Venta
        </a>
        > Ventas
      </h4>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-10 mb-3 text-right ">
      <a href="/<?php echo APP_NAME ?>/Venta/formRollos" class="btn btn-success mx-2">
        <i class="fas fa-shopping-cart"></i>
        Rollos
      </a>

      <a href="/<?php echo APP_NAME ?>/Venta/form" class="btn btn-primary">
        <i class="fas fa-shopping-cart"></i>
        Metros
      </a>
    </div>
  </div>


  <div class="container cont-table">
    <table class="table display table-hover text-center" id="table2">
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Fecha / Hora</th>
          <th class="text-center">Vendedor</th>
          <th class="text-center">Sucursal</th>
          <th class="text-center">Detalle</th>
          <!--th scope="col">Opciones</th-->
        </tr>
      </thead>
      <tbody>
        <?php
        $iter = 1;
        foreach ($datos as $row) {
          ?>
        <tr>
          <th scope="row">
            <?php echo $iter++ ?>
          </th>
          <td>
            <?php echo $row['FECHA_VENTA'] ?>
          </td>
          <td>
            <?php echo $row['IDPERSONAL'] ?>
          </td>
          <td>
            <?php echo $row['CODSUCURSAL'] ?>
          </td>
          <td>
            <a href="/<?php echo APP_NAME . '/Venta/detail?id=' . $row['CODVENTA'] ?>"
              class="bg-secondary p-2 text-white mx-2 ">
              <i class="fas fa-print"></i>
            </a>
          </td>

          <!--td>
              <a href="/<?php //echo APP_NAME . '/Venta/delete?id=' . $row['CODVENTA'] ?>"
                class="bg-danger p-2 text-white eliminar">
                <i class="fa-solid fa-trash"></i>
              </a>
            </td-->
        </tr>
        <?php } ?>

      </tbody>

    </table>
  </div>
</div>






<?php
include_once '../app/view/nav/inferior.php';
include_once '../app/view/template/footer.php';

?>