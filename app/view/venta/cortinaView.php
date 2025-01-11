<?php
$title = 'Venta | Cortina';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME; ?>/Venta" class="text-secondary">
            Venta
        </a>
        > Cortina
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">

        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/Venta/ventaCortina" method="POST" class="border-form mb-4"
                id="form-telas">

                <div class="container-fluid">
                    <div class="form-section active" id="seccion1">
                        <div class="row mb-4">
                            <div class="col-10">
                                <h3 class="mb-3">Datos del cliente</h3>
                            </div>
                            <div class="col-2">
                                <a href="/<?php echo APP_NAME ?>/Cliente/formVenta" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </a>

                            </div>

                        </div>
                        <div class="container cont-table">
                            <table class="table display table-hover text-center" id="table3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" class="ocultar-columna">COD</th>
                                        <th scope="col">Razón Social</th>

                                        <th scope="col">C.I. / NIT</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Telefono</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $iter = 1;
                                    foreach ($datos2 as $row) { ?>
                                        <tr>
                                            <td>
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
                                            <td>
                                                <?php echo $row['TELEFONO'] ?>
                                            </td>
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
                            <input type="number" name="cliente" id="cliente">
                        </div>


                        <div class="row mt-2 justify-content-center align-items-center">
                            <div class="col-4">
                                <div class="clearfix">
                                    <a href="/<?php echo APP_NAME . '/Venta' ?>"
                                        class="btn btn-primary mt-5 float-left">Volver</a>


                                    <button class="btn btn-success mt-5 float-right" type="button"
                                        onclick="siguienteSeccion()">
                                        Siguiente <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section" id="seccion2">
                        <div class="row justify-content-center align-items-center">

                            <h4>Dimenciones de las ventanas</h4>
                            <div class="row justify-content-center align-items-center">

                                <div class="col-5">
                                    <label for="">Alto (m)</label>
                                    <input type="number" class="form-control" id="alto" min="0">
                                    <small class="form-text text-muted">Ingr. dimesión</small>
                                </div>
                                <div class="col-5">
                                    <label for="">Ancho (m)</label>
                                    <input type="number" class="form-control" id="ancho" min="0">
                                    <small class="form-text text-muted">Ingr. dimesión</small>
                                </div>
                                <div class="col-5">
                                    <label for="">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidadV" min="0">
                                    <small class="form-text text-muted">Ingr. cantidad</small>
                                </div>

                                <div class="col-5">
                                    <button type="button" class="btn btn-primary"
                                        onclick="agregarDimension()">Agregar</button>
                                </div>

                            </div>

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

                            <div class="row mt-3 justify-content-center align-items-center">
                                <div class="col-4">
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
                    </div>

                    <div class="form-section" id="seccion3">
                        <h3 class="mb-3">Elegir tela</h3>
                        <div class="container cont-table">
                            <table class="table display table-hover text-center" id="table2">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th class="ocultar-columna" scope="col">cod</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Calidad</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $iter = 1;
                                    foreach ($datos as $row) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $iter++ ?>
                                            </td>

                                            <td class="ocultar-columna">
                                                <?php echo $row['CODTELA'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['NOMBRE'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['CALIDAD'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['MARCA'] ?>
                                            </td>
                                            <td>
                                                <button type="button" class="bg-secondary text-white p-2"
                                                    onclick="seleccionarTela(this)">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </td>

                                        </tr>

                                        <?php
                                    } ?>
                                </tbody>

                            </table>
                            <input type="text" name="codtela" id="tela">
                        </div>

                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-4">
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

                    <div class="form-section" id="seccion4">
                        <h3 class="mb-3">Detalle del Contrato</h3>
                        <div class="row">
                            <div class="col-6">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" name="sastre">
                                <small class="form-text text-muted">Ingr. nombre del sastre</small>
                            </div>

                            <div class="col-6">
                                <label for="">Costo del trabajo</label>
                                <input type="number" class="form-control" name="precio_sastre" min="0">
                                <small class="form-text text-muted">Precio del trabajo (bs)</small>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-3">
                                <label for="">Metros de tela</label>
                                <input type="number" class="form-control" name="metros_tela" min="0">
                            </div>
                            <div class="col-3">
                                <label for="">Costo de la tela</label>
                                <input type="number" class="form-control" name="precio_tela" min="0">
                            </div>

                            <div class="col-3">
                                <label for="">Fecha de entrega</label>
                                <input type="date" class="form-control" name="fecha_entrega" min="0">
                            </div>

                            <div class="col-12 mt-3">
                                <label for="">Detalle de bordado</label>
                                <textarea name="descripcion" class="form-control p-2" id="" cols="60"
                                    rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-4">
                                <div class="clearfix">
                                    <button class="btn btn-primary mt-5 float-left" type="button"
                                        onclick="anteriorSeccion()" type="button">
                                        <i class="fas fa-arrow-left"> Anterior</i>
                                    </button>

                                    <button class="btn btn-success mt-5 float-right" type="submit" onclick="realizarContrato()">
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
include_once '../app/view/nav/inferior.php';
include_once '../app/view/template/footer.php';

?>