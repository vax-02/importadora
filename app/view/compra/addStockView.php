<?php
$title = 'Pedido | Agregar';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <h4 class="text-left mt-3">
                <a href="/<?php echo APP_NAME; ?>/Compra" class="text-secondary">
                    Pedido
                </a>
                > Confirmar
            </h4>

        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 mt-3 text-right">
            <a href="/<?php echo APP_NAME . '/Compra/addStock?id=' . $datos['CODCOMPRA'];?>"
                class="bg-primary p-2 text-white ">
                <i class="fa-solid fa-arrows-rotate"></i>
            </a>


        </div>

    </div>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
        <div class="col-md-12 col-sm-12 ">
            <div class="border-form mb-4 " style="overflow: hidden;" id="form-telas">
                <div class="container-fluid ">
                    <div class="form-section active" id="seccion1">
                        <div class="row justify-content-center info-sucursal">
                            <div class="col-12 text-center title-sucursal ">
                                <h4>
                                    Información general del pedido
                                </h4>
                            </div>

                            <div class="row p-3 text-center">
                                <div class="col-md-6 col-sm-12">
                                    <p class="sub-sucursal">Compra realizada por: </p>
                                    <p>
                                        <?php echo $datos['COMPRADOR'] ?>
                                    </p>
                                </div>
                                <div class="col-md-6 col-sm-12">
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
                                <div class="alert alert-warning mt-3 d-none" id="msg-data-incomplete">Debe ingresar toda
                                    la información necesaria</div>
                            </div>
                            <div class="col-12 mt-4 " style="overflow-x: scroll;">
                                <table class="table table-striped " id="tablaPedido">
                                    <thead class="">
                                        <tr>
                                            <td colspan="5"></td>
                                            <td colspan="3" class="bg-primary bg-opacity-25">Rollos</td>
                                        </tr>
                                        <tr>
                                            <th rowspan="2"> Nombre</th>
                                            <th class="d-none"> CodMarca</th>
                                            <th> Marca</th>
                                            <th class="d-none"> CodColor</th>
                                            <th> Color</th>
                                            <th class="d-none"> CodCalidad</th>
                                            <th> Calidad</th>
                                            <th> Cantidad</th>
                                            <th class="bg-primary bg-opacity-25">Metros </th>
                                            <th class="bg-primary bg-opacity-25">Precio </th>
                                            <th class="bg-primary bg-opacity-25" style="min-width: 140px;">Prec. Venta
                                            </th>
                                            <th style="min-width: 140px;">Precio Metro</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($datos2 as $row) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['NOMBRE']; ?>
                                            </td>
                                            <td class="d-none">
                                                <?php echo $row['CODMARCA']; ?>
                                            </td>

                                            <td>
                                                <?php echo $row['MARCA']; ?>
                                            </td>
                                            <td class="d-none">
                                                <?php echo $row['CODCOLOR']; ?>
                                            </td>

                                            <td>
                                                <div
                                                    style="display:inline-block; width:15px; height:15px; background: <?php echo $row['CODCOLOR'] ?>;">
                                                </div>

                                            </td>
                                            <td class="d-none">
                                                <?php echo $row['CODCALIDAD']; ?>
                                            </td>

                                            <td>
                                                <?php echo $row['CALIDAD']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['CANTIDAD']; ?>
                                            </td>
                                            <td>
                                                0
                                            </td>
                                            <td>
                                                0
                                            </td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>
                                                <button class="bg-primary p-2 text-white" type="button"
                                                    onclick="completarDetalleTela(this)" data-bs-toggle="modal"
                                                    data-bs-target="#showTela">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>

                                                <button class="bg-danger p-2 text-white" type="button"
                                                    onclick="quitarProducto(this)">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12  text-center mt-3">
                                <div class="clearfix">

                                    <a href="/<?php echo APP_NAME ?>/Compra" class="btn btn-primary mr-4">
                                        Volver
                                    </a>

                                    <button class="btn btn-success ml-4" type="button" onclick="validarTabla()"
                                        id="btn-save-pedido">
                                        Añadir stock
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <!--Modals-->
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
                                <label for="">Nombre de la tela</label>
                                <input type="text" id="nomTela" class="form form-control" disabled>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <label for="">Marca </label>
                                <input type="text" id="marcTela" class="form form-control" disabled>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <label for="">Calidad</label>
                                <select name="" id="caliTela" class="form-control">
                                    <option value="1">1RA</option>
                                    <option value="2">2DA</option>
                                    <option value="3">3RA</option>
                                    <option value="4">4TA</option>

                                </select>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12 ">
                                <label for="">Cantidad (rollo)</label>
                                <input type="text" id="cantidadRollo" class="form form-control" required>
                                <small class="p-2 text-danger " id="err_cantidadRollo"></small>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12 ">
                                <label for="">Metros por rollo</label>
                                <input type="number" id="metros" class=" form form-control" required>
                                <small class="p-2 text-danger " id="err_metros"></small>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <label for="">Precio (rollo, compra)</label>
                                <input type="number" id="precioTelaRollo" class="form form-control" required>
                                <small class="p-2 text-danger " id="err_precioTelaRollo"></small>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <label for="">Precio (rollo, venta)</label>
                                <input type="number" id="precioTelaRolloVenta" class="form form-control" required>
                                <small class="p-2 text-danger " id="err_precioTelaRolloVenta"></small>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <label for="">Precio (metro)</label>
                                <input type="number" id="precioTelaMetro" class="form form-control" required>
                                <small class="p-2 text-danger " id="err_precioTelaMetro"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="modTabla" data-bs-dismiss="modal" disabled
                        onclick="modTable()">Confirmar</button>
                </div>
                <form action="/<?php echo APP_NAME?>/Compra/concretarPedido" method="POST" id="form-pedido">
                    <input type="hidden" name="id" value="<?php  echo $_GET['id'] ?>"> 
                </form>
            </div>
        </div>
    </div>

    <?php
include_once '../app/view/nav/inferior.php'; 
?>

    <script src="/<?php echo APP_NAME ?>/public/js/Validator.js"></script>
    <script src="/<?php echo APP_NAME ?>/public/js/AddPedido.js"></script>


    <?php
include_once '../app/view/template/footer.php';

?>
