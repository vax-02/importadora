<?php
$title = 'Venta | Telas';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';


include_once '../app/view/template/formModalCliente.php';

?>
<!--MODALS-->
<div class="modal fade" id="showInfo" tabindex="-1" aria-labelledby="showInfo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row text-center">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Detalle de la tela
                        </h1>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row text-center justify-content-center align-items-center">
                        <h4 class="bg-warning p-3">Tela no disponible</h4>
                        <h6>Tela disponible en: </h6>
                        <input class="form-control" type="text" id="nombreSu" disabled>
                        <input class="form form-control" type="text" id="direcSu" disabled>
                        <input class="form form-control" type="text" id="telefSu" disabled>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showTela" tabindex="-1" aria-labelledby="showTela" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row text-center">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Detalle de la tela
                        </h1>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row text-center justify-content-center align-items-center">

                        <input type="hidden" id="id_tela">
                        <input type="hidden" id="color_tela">

                        <div class="col-12">
                            <div class="alert alert-warning" id="msg-alert">El stock del producto es bajo</div>
                        </div>
                        <div class="col-12">
                            <label for="">Nombre de la tela</label>
                            <input type="text" id="nomTela" class="form form-control" disabled>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label for="">Marca </label>
                            <input type="text" id="marcTela" class="form form-control" disabled>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label for="">Calidad</label>
                            <input type="text" id="caliTela" class="form form-control" disabled>
                        </div>
                        <div class="col-12">
                            <label for="">Metraje</label>
                            <input type="text" id="metrajeTela" class="form form-control" disabled>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <input type="hidden" id="precioTelaRef" class="form form-control">
                            <label for="">Precio</label>
                            <input type="number" id="precioTela" class="form form-control" readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label for="">Metros</label>
                            <input type="number" id="metrTela" class="form form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                    id="btnInsertTela">Agregar</button>
            </div>
        </div>
    </div>
</div>
<button class="button ocultar-columna" id="btnShowTela" type="button" data-bs-toggle="modal"
    data-bs-target="#showTela"></button>


<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME; ?>/Venta" class="text-secondary">
            Venta
        </a>
        > Tela

    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/Venta/create" method="POST" class="border-form mb-4"
                id="form-venta-telas">
                <input type="hidden" name="clinte" id="cliente">

                <div class="form-section active" id="seccion1">
                    <div class="row justify-content-center align-items-center">
                        <h4>Telas</h4>
                        <div class="container cont-table">
                            <table class="table display table-hover text-center" id="table3">
                                <thead>
                                    <tr>
                                        <th scope="col" class="ocultar-columna">cod</th>
                                        <th scope="col" class="ocultar-columna">cod_cor</th>
                                        <th scope="col" class="ocultar-columna">cod_su</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Calidad</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Opciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                    foreach ($datos as $row) {
                      ?>
                                    <tr>
                                        <td class="ocultar-columna">
                                            <?php echo $row['CODTELA'] ?>
                                        </td>

                                        <td class="ocultar-columna">
                                            <?php echo $row['CODCOLOR'] ?>
                                        </td>
                                        <td class="ocultar-columna">
                                            <?php echo $row['CODSUCURSAL'] ?>
                                        </td>

                                        <td>
                                            <?php echo $row['NOMBRE'] ?>
                                        </td>

                                        <td>
                                            <?php echo "<div style='height: 15px; width: 15px; background:" . $row['CODCOLOR'] . "; display: inline-block;'></div>" ?>
                                        </td>

                                        <td>
                                            <?php echo $row['CALIDAD'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['MARCA'] ?>
                                        </td>
                                        <td>
                                            <?php if ($row['CODSUCURSAL'] == $_SESSION['cod_sucursal']) { ?>
                                            <button type="button" class="btn btn-success" onclick="insertTela(this)">
                                                <i class="fas fa-add"></i>
                                            </button>
                                            <?php
                          } else if (($row['METROS'] == 0 && $row['ROLLOS']) || $row['CODSUCURSAL'] != $_SESSION['cod_sucursal']) { ?>
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                                                data-bs-target="#showInfo" onclick="infoSucursal(this)">
                                                <i class="fas fa-add"></i>
                                            </button>


                                            <?php
                          } ?>

                                        </td>

                                    </tr>
                                    <?php } ?>

                                </tbody>

                            </table>
                        </div>

                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-5 mr-3">
                                <a href="/<?php echo APP_NAME . '/Venta' ?>" class="btn btn-primary mt-5 ">Volver</a>
                            </div>
                            <div class="col-5">
                                <button class="btn btn-success mt-5 float-right" type="button" onclick="subtotal()">
                                    Siguiente <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section" id="seccion2">
                    <div class="row mb-3">
                        <div class="col-10">
                            <h3>Telas seleccionadas</h3>
                        </div>
                        <div class="col-2 ">
                            <p class="mb-0"><b>Precio total:</b></p>
                            <div class="text-white bg-success py-1 d-flex align-items-center">
                                <i class="fas fa-money-bill px-2"></i>
                                <p id="priceTotal" class="mr-2 mb-0 ms-auto">0</p>

                            </div>
                        </div>


                    </div>
                    <div class="container cont-table">
                        <table class="table display table-hover text-center" id="table4">
                            <thead>
                                <tr>
                                    <th scope="col">Tela</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cod. Color</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad (m)</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>

                    <div class="row mt-3 d-flex justify-content-center align-items-center">
                        <div class="col-5 mr-3">
                            <button class="btn btn-primary mt-5" type="button" onclick="anteriorSeccion()"
                                type="button">
                                <i class="fas fa-arrow-left"> Anterior</i>
                            </button>
                        </div>
                        <div class="col-5">
                            <button class="btn btn-success mt-5" type="button" onclick="verificarTelas()">
                                Siguiente <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-section" id="seccion3">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-10">
                            <h4>Cliente</h4>
                        </div>

                        <div class="col-2 mb-3 text-right">
                            <button class="btn btn-primary" type="button" onclick="addFormModalClient()"
                                data-bs-toggle="modal" data-bs-target="#formModalCliente">
                                <i class="fas fa-plus"></i>
                            </button>

                        </div>

                        <div class="container cont-table">
                            <table class="table display table-hover text-center" id="table2">
                                <thead>
                                    <tr>
                                        <th scope="col" class="ocultar-columna">cod</th>
                                        <th scope="col">Razon Social</th>
                                        <th scope="col">NIT / CI</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                    $iter = 1;
                    foreach ($datos2 as $row) {
                      ?>
                                    <tr>
                                        <td class="ocultar-columna">
                                            <?php echo $row['IDCLIENTE'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['RAZONSOCIAL'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['CI_NIT'] ?>
                                        </td>
                                        <td>
                                            <?php echo ucwords($row['TIPO']) ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-secondary"
                                                onclick="selectClienteTela(this)">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </td>

                                    </tr>
                                    <?php } ?>

                                </tbody>

                            </table>
                        </div>

                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-5 mr-3">
                                <button class="btn btn-primary mt-5 float-left" type="button"
                                    onclick="anteriorSeccion()" type="button">
                                    <i class="fas fa-arrow-left"> Anterior</i>
                                </button>
                            </div>
                            <div class="col-5">

                                <button class="btn btn-success mt-5 float-right" id="realizarVenta" type="button"
                                    onclick="guardarTelas()">
                                    Vender <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="total" name="total">
            </form>
        </div>
    </div>
</div>

<?php
include_once '../app/view/nav/inferior.php';
?>
<script src="/<?php echo APP_NAME ?>/public/js/form-part.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/ventaTela.js"></script>

<script src="/<?php echo APP_NAME ?>/public/js/Validator.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorCliente.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/SaveClientModal.js"></script>




<?php
include_once '../app/view/template/footer.php';

?>
