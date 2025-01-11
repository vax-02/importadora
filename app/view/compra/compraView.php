<?php
$title = 'Pedido';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';

?>
<div class="container-fluid">
    <div class="row ml-1 my-3 title-option">
        <div class="col-10">
            <h4 class="text-left">
                <a href="/<?php echo APP_NAME; ?>/Compra" class="text-secondary">
                    Pedido
                </a>
                > Lista
            </h4>
        </div>
        <div class="col-2 mb-3">
            <a href="/<?php echo APP_NAME ?>/compra/form" class="btn btn-primary">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>


    <div class="container cont-table">
        <table class="table display table-hover text-center" id="table2">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha / Hora</th>
                    <th scope="col">Comprador</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Detalle</th>
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
                        <?php echo $row['FECHA'] ?>
                    </td>
                    <td>
                        <?php echo $row['COMPRADOR'] ?>
                    </td>
                    <td>
                        <?php echo $row['PROVEEDOR'] ?>
                    </td>
                    <td>
                        <a href="/<?php echo APP_NAME . '/Compra/detail?id=' . $row['CODCOMPRA'] ?>"
                            class="bg-secondary p-2 text-white mx-2 ">
                            <i class="fa-solid fa-circle-info"></i>
                        </a>
                    </td>
                    <td>

                        <?php
                        if( $row['ESTADO'] == 1) { ?>
                        <a href="/<?php echo APP_NAME . '/Compra/addStock?id=' . $row['CODCOMPRA'] ?>"
                            class="bg-success p-2 m-2 text-white ">
                            <i class="fa-solid fa-check-to-slot"></i>
                        </a>
                        <?php } else{ ?>
                        <button class="bg-secondary bg-opacity-25 p-2 m-2 text-white ">
                            <i class="fa-solid fa-check-to-slot"></i>
                        </button>

                        <?php } ?>

                        <a href="/<?php echo APP_NAME . '/Compra/delete?id=' . $row['CODCOMPRA'] ?>"
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
