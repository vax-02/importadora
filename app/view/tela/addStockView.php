<?php
//print_r($datos);
$title = 'Tela | Stock';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';

?>

<div class="modal fade" id="addMoreRollos" tabindex="-1" aria-labelledby="#addMoreRollos" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row text-center">
                        <h4>Agregar rollos</h4>
                    </div>

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container text-center">
                    <div class="row">
                        <input type="hidden" id="codColor">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="" class="text-label">Rollos actuales</label>
                            <input type="text" name="rolloCurrent" class="form-control" id="rollosCurrent" disabled>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="" class="text-label">Ingr. rollos a agregar</label>
                            <input type="number" name="rolloMore" id="rolloMore" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="btnSubmidAddRollo" class="btn btn-primary" data-bs-dismiss="modal"
                    disabled>Aceptar</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME; ?>/Tela" class="text-secondary">
            Tela
        </a>
        > Incrementar
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/tela/addStockSave" method="POST" class="border-form" id="formTela">
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" name="tcolores" id="tmetros" value="<?php echo $datos['METROS']?>">
                <div class="container-fluid">
                    <div class="form-section active" id="seccion1">
                        <h3 class="mb-3">Información de la tela</h3>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre"
                                    value="<?php echo $datos['NOMBRE'] ?>" required readonly>
                                <small class="form-text text-muted">Ingr. nombre</small>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label for="">Calidad</label>
                                <select name="calidad" class="form-control">
                                    <option value="<?php echo $datos['CODCALIDAD'] ?>"><?php echo $datos['CALIDAD'] ?>
                                    </option>
                                </select>
                                <small class="form-text text-muted">Seleccione la calidad</small>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label for="">Marca</label>
                                <select name="marca" class="form-control">
                                    <option value="<?php echo $datos['CODMARCA'] ?>"><?php echo $datos['MARCA'] ?>
                                    </option>

                                </select>
                                <small class="form-text text-muted">Seleccione la marca</small>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="clearfix">
                                    <a href="/<?php echo APP_NAME . '/Tela' ?>"
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
                        <h3 class="mb-3">Colores de la tela</h3>

                        <div class="row mt-3 justify-content-center align-items-center">

                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <input type="color" id="color" class="form-control">
                                <small class="form-text text-muted">Elija un color</small>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <input type="number" id="cantidad" class="form-control" min="0" step="1">
                                <small class="form-text text-muted">Ingr. cantidad de rollos</small>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <button class="btn btn-primary" type="button" onclick="nuevaTela()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-12">
                                <table class="table align-items-center justify-content-center text-center"
                                    id="tableTelas">
                                    <thead>
                                        <tr>
                                            <th>Color</th>
                                            <th style="display:none;">R Color</th>
                                            <th># Rollos</th>
                                            <th>Opción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($datos['rollos'] as $color){
                                        ?>
                                        <tr>
                                            <td>
                                                <div
                                                    style="display:inline-block; width:15px; height:15px; background: <?php echo $color['CODCOLOR'] ?>;">
                                                </div>
                                            </td>
                                            <td style="display:none;">
                                                <?php echo $color['CODCOLOR'] ?>
                                            </td>
                                            <td>
                                                <?php echo $color['NUMROLLOS'] ?>
                                            </td>
                                            <td>

                                                <button type="button" data-bs-toggle="modal" id="btnAddMoreRollos"
                                                    data-bs-target="#addMoreRollos" class="btn btn-warning text-white"
                                                    onclick="addMoreRollos(this)">
                                                    <i class="fas fa-pen"></i>
                                                </button>

                                                <button class="btn btn-danger" disabled>
                                                    <i class="fas fa-trash" enable></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                      } ?>
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
                                        onclick="siguienteSeccion()">
                                        Siguiente <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section" id="seccion3">
                        <h3 class="mb-3">Costo de la tela</h3>
                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label for="">Precio por ROLLO (real)</label>
                                <input type="number" name="precioRolloReal" id="precioRolloReal" class="form-control"
                                    value="<?php  echo $datos['rollos'][0]['PRECIOROLLOREAL']; ?>" required>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                <label for="">Incremento: <b id="incrementRolloValue">0</b> %
                                </label>
                                <input type="range" id="incrementRollo" class="form-control" max="50" value="0">
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label for="">Precio por ROLLO (Venta)</label>
                                <input type="number" name="precioRollo" id="precioRollo" class="form-control"
                                    value="<?php  echo $datos['rollos'][0]['PRECIOROLLO']; ?>" required>
                            </div>
                        </div>
<hr>
                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label for="">Precio por metro (real)</label>
                                <input type="number" name="precioMetro" id="precioMetro" class="form-control"
                                    value="<?php echo $datos['PRECIO_REAL'] ?>" required readonly>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                <label for="">Incremento: <b id="incrementMetroValue">0</b> %
                                </label>
                                <input type="range" id="incrementMetro" class="form-control" max="50" value="0">
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label for="">Precio por metro (venta)</label>
                                <input type="number" name="precioMetroVenta" step="0.1" id="precioMetroVenta" class="form-control"
                                    value="<?php echo $datos['PRECIO'] ?>" required>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="clearfix">
                                    <button class="btn btn-primary mt-5 float-left" type="button"
                                        onclick="anteriorSeccion()" type="button">
                                        <i class="fas fa-arrow-left"> Anterior</i>
                                    </button>
                                    <button type="submit" class="btn btn-success mt-5 float-right" id="btn-save-stock"
                                        onclick="addForm()">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>

    </div>
</div>

<?php include_once '../app/view/nav/inferior.php'; ?>
<script src="/<?php echo APP_NAME ?>/public/js/Validator.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/form-part.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/addStock.js"></script>


<?php include_once '../app/view/template/footer.php'; ?>