<?php
$title = 'Compra | Detalle';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME; ?>/Compra" class="text-secondary">
            Pedido
        </a>
        > Detalle
    </h4>

    <div class="container cont-table p-3">
        <div class="row justify-content-center info-sucursal">
            <div class="col-12 text-center title-sucursal ">
                <h2>
                    Información general
                </h2>

                <?php
        if ($datos['ESTADO']) {
          ?>
                <small class="bg-success p-2 text-light">Pendiente</small>
                <?php
        } else {
          ?>
                <small class="bg-warning bg-opacity-50 p-2 text-light">Registrado</small>
                <?php
        }
        ?>

            </div>
            <div class="row p-3 text-center">
                <div class="col-6">
                    <p class="sub-sucursal">Pedido realizada por: </p>
                    <p>
                        <?php echo $datos['COMPRADOR'] ?>
                    </p>
                </div>
                <div class="col-6">
                    <p class="sub-sucursal">Proveedor:</p>
                    <p>
                        <?php echo $datos['PROVEEDOR'] ?>
                    </p>
                </div>
                <div class="col-12">
                    <p class="sub-sucursal">FECHA Y HORA:</p>
                    <p>
                        <?php echo $datos['FECHA'] ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center sub-title-sucursal ">
                <h4>Detalle de los productos pedidos</h4>
            </div>

            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"> Nombre</th>
                            <th scope="col"> Marca</th>
                            <th scope="col"> Color</th>
                            <th scope="col"> Calidad</th>
                            <th scope="col"> Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos2 as $row) { ?>
                        <tr>
                            <td>
                                <?php echo $row['NOMBRE']; ?>
                            </td>
                            <td>
                                <?php echo $row['MARCA']; ?>
                            </td>

                            <td>
                                <div
                                    style="display:inline-block; width:15px; height:15px; border: 1px solid black; background: <?php echo $row['CODCOLOR'] ?>;">
                                </div>

                            </td>
                            <td>
                                <?php echo $row['CALIDAD']; ?>
                            </td>
                            <td>
                                <?php echo $row['CANTIDAD']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="col-12  text-center mt-3">
                <a href="/<?php echo APP_NAME ?>/Compra" class="btn btn-primary">
                    Volver
                </a>
                <a href="/<?php echo APP_NAME ?>/Compra/Pdf?id=<?php echo $datos['CODCOMPRA']?>"
                    class="btn btn-success ml-5">
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
