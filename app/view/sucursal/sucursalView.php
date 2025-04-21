<?php
$title = 'Sucursal';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>
<div class="container-fluid">
  <div class="row ml-1 my-3 title-option">
    <div class="col-10">
      <h4 class="text-left">
          <a href="/<?php echo APP_NAME;?>/Sucursal" class="text-secondary">
          Sucursales
          </a>
          > 
          Sucursales
        </h4>
    </div>  
    <div class="col-2 mb-3">
      <a href="/<?php echo APP_NAME?>/Sucursal/form" class="btn btn-primary">
      <i class="fas fa-plus"></i>
      </a>
    </div>
  </div>

  
  <div class="container cont-table">
    <table class="table display table-hover text-center" id="table2">
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Dirección</th>
          <th class="text-center">Telefono</th>
          <th class="text-center">Encargado</th>
          <th class="text-center">Detalle</th>
          <th class="text-center">Opciones</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $iter = 1;
        foreach ($datos as $row) {
        ?>
        <tr>
          <th scope="row"> <?php echo $iter++ ?> </th>
          <td> <?php echo $row['NOMBRE'] ?> </td>
          <td> <?php echo $row['DIRECCION'] ?> </td>
          <td> <?php echo $row['TELEFONO'] ?> </td>
          <td> <?php echo $row['ENCARGADO'] ?> </td>

          <td>
            <a href="/<?php echo APP_NAME . '/Sucursal/detail?id=' . $row['CODSUCURSAL'] ?>"
            class="bg-secondary p-2 text-white mx-2 ">
              <i class="fa-solid fa-circle-info"></i>
            </a>
          </td>
          <td>
            <a href="/<?php echo APP_NAME . '/Sucursal/update?id=' . $row['CODSUCURSAL'] ?>"
            class="bg-success p-2 text-white mx-2 ">
              <i class="fa-solid fa-pen"></i>
            </a>

            <a href="/<?php echo APP_NAME . '/Sucursal/delete?id=' . $row['CODSUCURSAL'] ?>"
            class="bg-danger p-2 text-white eliminar">
              <i class="fa-solid fa-trash"></i>
            </a>
          </td>
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