<?php
$title = 'Supervisar';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>
<div class="container-fluid text-center">
    <div class="title-inicio mx-0">
        <h2 class="">Panel del Supervisor</h2>
    </div>
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <?php
    $colors = [
      'bg-primary',
      'bg-info',
      'bg-success'
    ];
    $iter = 0;
    foreach ($datos as $sucursal) {
      $iter = ($iter > 2) ? 0 : $iter;
      ?>

        <div class="col-sm-10 col-md-5 col-lg-5 <?php echo $colors[$iter++] ?> sucursales text-left border border-light p-2 text-white m-2 "
            style="height: 50vh;">
            <form action="/<?php echo APP_NAME; ?>/Sucursal/selectSucursal" method="POST">
                <div class="row">
                    <div class="col-9">
                        <h3>
                            <?php echo $sucursal['NOMBRE'] ?>
                        </h3>
                    </div>
                    <input type="hidden" name="idS" id="idS" value="<?php echo $sucursal['CODSUCURSAL'] ?>">
                    <button type="submit" class="col-3 justify-content-center align-items-center btn-sucursal text-white
                
            <?php if ($_SESSION['cod_sucursal'] == $sucursal['CODSUCURSAL']) {
              echo 'select';
            }
            ?>" style="height: 100%;">
                        <?php
              if ($_SESSION['cod_sucursal'] == $sucursal['CODSUCURSAL']) {
                echo '<i class="fa-solid fa-circle-check"></i>';
              } else {
                echo '<i class="fa-solid fa-circle-xmark"></i>';
              }
              ?>
                    </button>

                </div>
            </form>

            <label>
                <?php echo $sucursal['DESCRIPCION'] ?>
            </label>

            <p>
                <b>Direccion: </b>
            </p>
            <p class="text-center">

                <?php echo $sucursal['DIRECCION'] ?>
            </p>


            <p>
                <b>Telefono: </b>
            </p>
            <p class="text-center">

                <?php echo $sucursal['TELEFONO'] ?>
            </p>

        </div>



        <?php }
    ?>
    </div>


    <?php
  include_once '../app/view/nav/inferior.php';

  ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sucursales = document.querySelectorAll('.sucursales');
            sucursales.forEach(function (sucursal) {
                sucursal.addEventListener('click', function () {
                    this.classList.toggle('expandido')
                })

            })
        })
    </script>

    <?php
  include_once '../app/view/template/footer.php';

  ?>