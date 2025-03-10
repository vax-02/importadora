<?php
$title = 'Contrato | Cortinas';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';

include_once '../app/view/template/formModalCliente.php';

?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME; ?>/Contrato" class="text-secondary">
            Contrato
        </a>
        > Cortina
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/Contrato/create" method="POST" class="border-form mb-4"
                id="form-telas">
                <input type="hidden" name="color" id="codcolor">
                <input type="hidden" name="precioTelaOriginal" id="pto">
                <div class="form-section active" id="seccion1">
                    <h3 class="mb-3">Elegir tela</h3>
                    <div class="container cont-table">
                        <table class="table display table-hover text-center" id="table2">
                            <thead>
                                <tr>
                                    <th class="ocultar-columna" scope="col">#</th>
                                    <th class="ocultar-columna" scope="col">cod</th>
                                    <th scope="col">Nombre</th>
                                    <th class="ocultar-columna">cod_Color</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Calidad</th>
                                    <th scope="col">Marca</th>
                                    <th class="ocultar-columna">Precio</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $iter = 1;
                                    foreach ($datos as $row) { ?>
                                <tr>
                                    <td class="ocultar-columna">
                                        <?php echo $iter++ ?>
                                    </td>

                                    <td class="ocultar-columna">
                                        <?php echo $row['CODTELA'] ?>
                                    </td>

                                    <td>
                                        <?php echo $row['NOMBRE'] ?>
                                    </td>
                                    <td class="ocultar-columna">
                                        <?php echo $row['CODCOLOR'] ?>

                                    </td>
                                    <td>
                                        <div
                                            style=" display:inline-block; width:15px; height:15px; border: 1px solid #000000; background-color: <?php echo $row['CODCOLOR'] ?>;">

                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $row['CALIDAD'] ?>
                                    </td>

                                    <td>
                                        <?php echo $row['MARCA'] ?>
                                    </td>

                                    <td class="ocultar-columna">
                                        <?php echo $row['PRECIO'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($row['METROLLO'] > 0){ ?>
                                        <button type="button" class="bg-secondary text-white p-2"
                                            onclick="seleccionarTela(this)">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                        <?php
                                        } else{?>
                                        <button type="button" class="bg-danger text-white p-2" disabled>
                                            <i class="fas fa-times"></i>
                                        </button>

                                        <?php
                                        }?>
                                    </td>


                                </tr>

                                <?php
                                    } ?>
                            </tbody>

                        </table>
                        <input type="hidden" name="codtela" id="tela">
                    </div>


                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="clearfix">

                                <a href="/<?php echo APP_NAME . '/contrato' ?>"
                                    class="btn btn-primary mt-5 float-left">Volver</a>


                                <button class="btn btn-success mt-5 float-right" type="button"
                                    onclick="verificarSeleccionCortina()">
                                    Siguiente <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section" id="seccion2">
                    <h4>Dimenciones de las ventanas</h4>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="">Alto (m)</label>
                            <input type="number" class="form-control" id="alto" min="0">
                            <small id="error_alto" class="form-text text-danger"></small>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="">Ancho (m)</label>
                            <input type="number" class="form-control" id="ancho" min="0">
                            <small id="error_ancho" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="">Cantidad</label>
                            <input type="number" class="form-control" id="cantidadV" min="0">
                            <small id="error_cantidad" class="form-text text-danger"></small>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <button type="button" id="btnAdd" class="btn btn-primary"
                                onclick="agregarDimension()">Agregar</button>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12 mt-5">
                            <table class="table" id="tablaVentana">
                                <thead>
                                    <tr>
                                        <th>Alto</th>
                                        <th>Ancho</th>
                                        <th>Cantidad</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="clearfix">
                                <button class="btn btn-primary mt-5 float-left" type="button"
                                    onclick="anteriorSeccion()" type="button">
                                    <i class="fas fa-arrow-left"> Anterior</i>
                                </button>
                                <button class="btn btn-success mt-5 float-right" type="button"
                                    onclick="verificarSeleccionDimension()">
                                    Siguiente <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="form-section" id="seccion3">
                    <h3 class="mb-3">Detalles del Contrato</h3>
                    <div class="row ">
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Mano de obra (bs)</label>
                            <input id="precio_sastre" type="number" value="17" class="form-control" name="precio_sastre"
                                min="0" required>
                            <small id="error_precio_sastre" class="form-text text-danger"></small>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Fruncido de cortina (cm.)</label>
                            <input id="fruncido" type="number" class="form-control" value="2.5" name="frunsido" min="0"
                                step="0.5" required>
                            <small id="error_fruncido" class="form-text text-danger"></small>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Fecha de entrega</label>
                            <input type="date" class="form-control" name="fecha_entrega" min="0" required>
                        </div>
                    </div>



                    <div class="row align-items-center justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <label for="">Metros de tela</label>
                            <input id="metros_tela" type="number" class="form-control" name="metros_tela" min="0"
                                required>
                            <small id="error_metros_tela" class="form-text text-danger"></small>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <label for="">Costo (tela)</label>
                            <input id="precio_tela" type="number" class="form-control" name="precio_tela" min="0"
                                readonly required>
                            <small id="error_precio_tela" class="form-text text-danger"></small>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center m-3 p-3 bg-light">
                            <label for="">¿Calcular costo de instalación?</label>
                            <input type="checkbox" id="check">
                        </div>

                        <div id="install" class="d-none row p-4 bg-light">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center ">
                                <label for="">Costo del tubo</label>
                                <input type="number" name="costoTubo" id="costoTubo" class="form-control">
                                <small id="error_costoTubo" class="form-text text-danger"></small>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center">
                                <label for="">Numero de tubos</label>
                                <input type="number" name="numeroTubos" id="numeroTubos" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 text-center bg-success bg-opacity-20 p-3">
                            <label for="" class="text-white">Costo final del trabajo: Bs.</label>
                            <input type="number" name="costoFinal" id="costoFinal" class="form-control" readonly>
                        </div>


                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                            <label for="">Detalles</label>
                            <textarea name="descripcion" class="form-control p-2" id="" id="descripcion" cols="60"
                                required rows="3"></textarea>
                            <small id="error_descripcion" class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="row mt-2 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="clearfix">
                                <button class="btn btn-primary mt-5 float-left" type="button"
                                    onclick="anteriorSeccion()" type="button">
                                    <i class="fas fa-arrow-left"> Anterior</i>
                                </button>
                                <button class="btn btn-success mt-5 float-right" type="button"
                                    onclick="siguienteSeccion()">
                                    Siguiente <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-section " id="seccion4">
                    <div class="row mb-4">
                        <div class="col-10">
                            <h3 class="mb-3">Datos del cliente</h3>
                        </div>

                        <div class="col-2 mb-3 text-right">
                            <button class="btn btn-primary" type="button" onclick="addFormModalClient()"
                                data-bs-toggle="modal" data-bs-target="#formModalCliente">
                                <i class="fas fa-plus"></i>
                            </button>

                        </div>
                    </div>
                    <div class="container cont-table">
                        <table class="table display table-hover text-center" id="table3">
                            <thead>
                                <tr>
                                    <th scope="col" class="ocultar-columna">#</th>
                                    <th scope="col" class="ocultar-columna">COD</th>
                                    <th scope="col">Razón Social</th>
                                    <th scope="col">C.I. / NIT</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col" class="ocultar-columna">Celular</th>

                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $iter = 1;
                                    foreach ($datos2 as $row) { ?>
                                <tr>
                                    <td class="ocultar-columna">
                                        <?php echo $iter++ ?>
                                    </td>
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
                                    <td class="ocultar-columna"></td>

                                    <td>
                                        <button type="button" class="bg-secondary text-white p-2"
                                            onclick="seleccionarCliente(this)">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </td>

                                </tr>

                                <?php
                                    } ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="cliente" id="cliente">
                    </div>


                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="clearfix">
                                <button class="btn btn-primary mt-5 float-left" type="button"
                                    onclick="anteriorSeccion()" type="button">
                                    <i class="fas fa-arrow-left">Anterior</i>
                                </button>

                                <button class="btn btn-success mt-5 float-right" type="submit"
                                    onclick="realizarContrato()">
                                    Realizar Contrato <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>


        </div>
        </form>
    </div>

</div>
</div>


<?php
include_once '../app/view/nav/inferior.php';?>

<script src="/<?php echo APP_NAME ?>/public/js/contratoCortina.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/form-part.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/ventaCortina.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/Validator.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorCliente.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorContrato.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/SaveClientContratoModal.js"></script>


<?php
include_once '../app/view/template/footer.php';

?>