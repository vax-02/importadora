<?php
$title = 'Contrato | Tela';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME; ?>/Contrato/tela" class="text-secondary">
            Contrato de tela
        </a>
        > Agregar
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">

        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/Contrato/telaCreate" method="POST" class="border-form mb-4"
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
                            <input type="hidden" name="cliente" id="cliente">
                        </div>


                        <div class="row mt-2 justify-content-center align-items-center">
                            <div class="col-4">
                                <div class="clearfix">
                                    <a href="/<?php echo APP_NAME . '/Contrato/Tela' ?>"
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
                        <h3 class="mb-3">Agregar tela</h3>
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
                                                    onclick="">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </td>

                                        </tr>

                                        <?php
                                    } ?>
                                </tbody>

                            </table>
                            <input type="hidden" name="codtela" id="tela">
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


                    <div class="form-section" id="seccion3">
                        <h3 class="mb-3">Telas seleccionadas</h3>
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
                                                    onclick="   ">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </td>

                                        </tr>

                                        <?php
                                    } ?>
                                </tbody>

                            </table>
                            <input type="hidden" name="codtela" id="tela">
                        </div>

                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-4">
                                <div class="clearfix">
                                    <button class="btn btn-primary mt-5 float-left" type="button"
                                        onclick="anteriorSeccion()" type="button">
                                        <i class="fas fa-arrow-left"> Anterior</i>
                                    </button>

                                    <button class="btn btn-success mt-5 float-right" type="button"
                                        onclick="">
                                        Realizar contrato <i class="fas fa-arrow-right"></i>
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