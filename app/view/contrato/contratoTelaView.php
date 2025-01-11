<?php
$title = 'Contrato de tela';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
  <div class="row ml-1 my-3 title-option">
    <div class="col-8">
      <h4 class="text-left">
        <a href="/<?php echo APP_NAME; ?>/Contrato/tela" class="text-secondary">
          Contrato de telas
        </a>
        > Lista
      </h4>
    </div>
    <div class="col-4 mb-3 text-right">

      <a href="/<?php echo APP_NAME ?>/Contrato/formTela" class="btn btn-success">
        <i class="fas fa-plus"></i>

      </a>
    </div>
  </div>


  <div class="container cont-table">
    <table class="table display table-hover text-center" id="table2">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Vendedor</th>
          <th scope="col">Cliente</th>
          <th scope="col">Fecha</th>
          <th scope="col">Total (bs.)</th>
          <th scope="col">Opciones</th>
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
              <?php echo $row['SASTRE'] ?>
            </td>

            <td>
              <?php echo $row['FECHA_INICIO'] ?>
            </td>
            <td>
              <?php echo $row['FECHA_ENTREGA'] ?>
            </td>

            <td>
              <?php
              if ($row['ESTADO']) {
                ?>
                <a href="/<?php echo APP_NAME . '/Contrato/estado?id=' . $row['CODCONTRATO'] ?>"
                  class=" p-2 text-white mx-2 ">
                  <i class="text-success fa-solid fa-circle"></i>
                </a>

                <?php
              } else {
                ?>
                <a href="/<?php echo APP_NAME . '/Contrato/estado?id=' . $row['CODCONTRATO'] ?>"
                  class=" p-2 text-white mx-2 ">
                  <i class="text-danger fa-solid fa-circle"></i>
                </a>
                <?php
              }
              ?>
            </td>
            <td>

              <a href="/<?php echo APP_NAME . '/Contrato/detail?id=' . $row['CODCONTRATO'] ?>"
                class="bg-secondary p-2 text-white mr-1">
                <i class="fa-solid fa-pen"></i>
              </a>

              <a href="/<?php echo APP_NAME . '/Contrato/delete?id=' . $row['CODCONTRATO'] ?>"
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