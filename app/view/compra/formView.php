<?php
$title = 'Pedido | Agregar';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME; ?>/Compra" class="text-secondary">
            Pedido
        </a>
        > Agregar
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">

        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/compra/create" method="POST" class="border-form mb-4"
                id="form-telas">
                <div class="container-fluid">
                    <div class="form-section active" id="seccion1">
                        <h3>Proveedores</h3>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                                <select name="proveedor" id="" class="form-control mt-5">
                                    <?php
                  foreach ($datos as $row) {
                    ?>
                                    <option value="<?php echo $row['CODPROV'] ?>" class="">
                                        <?php echo $row['NOMBRE'] ?>
                                    </option>
                                    <?php
                  }
                  ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3 justify-content-center align-items-center ">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="clearfix">
                                    <a href="/<?php echo APP_NAME . '/Compra' ?>"
                                        class="btn btn-primary mt-5 float-left">Volver</a>
                                    <button class="btn btn-success mt-5 float-right" type="button"
                                        onclick="siguienteSeccion()">
                                        Siguiente <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section" id="seccion2">
                    <h3 class="mb-3">Agregar telas al pedido</h3>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="">Nombre </label>
                            <select name="nombre" id="nombre" class="form-control">
                                <?php foreach($msg as $pr){
                                    ?>
                                    <option value="<?php echo $pr['nombre'] ?>"><?php echo $pr['nombre'] ?></option>
                                <?php
                                } ?>
                            </select>
                            <!--input type="text" class="form-control" name="nombre" id="nombre"-->

                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="">Marca</label>
                            <select name="marca" class="form-control" id="marca">
                                <?php foreach ($datos2 as $row) { ?>
                                <option value="<?php echo $row['CODMARCA'] ?>">
                                    <?php echo $row['DESCRIPCION'] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="">Calidad</label>
                            <select name="calidad" class="form-control" id="calidad">
                                <option value="1">1RA</option>
                                <option value="2">2DA</option>
                                <option value="3">3RA</option>
                                <option value="4">4TA</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="">Color</label>
                            <input type="color" name="color" class="form-control" id="color">
                        </div>

                    </div>

                    <div class="row justify-content-center align-items-center mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="">Cantidad</label>

                            <input type="number" name="cantidad" class="form-control" id="cantidad">
                            <small id="error_cantidad" class="form-text text-danger"></small>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <button class="btn btn-primary" type="button"
                                onclick="agregarRolloCompra()">Agregar</button>
                        </div>

                    </div>


                    <div class="col-12">
                        <table class="table" id="tablaCompra">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th class="ocultar-columna">codmarca</th>
                                    <th>Marca</th>
                                    <th class="ocultar-columna">codcolor</th>
                                    <th>Color</th>
                                    <th class="ocultar-columna">codcalidad</th>
                                    <th>Calidad</th>
                                    <th>Numero de rollos</th>
                                    <th>Opción</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <input type="hidden" name="total" id="total" value="0">


                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="clearfix">
                                <button class="btn btn-primary mt-5 float-left" type="button"
                                    onclick="anteriorSeccion()" type="button">
                                    <i class="fas fa-arrow-left"> Anterior</i>
                                </button>

                                <button class="btn btn-success mt-5 float-right" type="button" onclick="guardar()"
                                    id="btnSave">
                                    Guardar <i class="fas fa-arrow-right"></i>
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
include_once '../app/view/nav/inferior.php'; ?>
<script src="/<?php echo APP_NAME ?>/public/js/form-part.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/compra.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/Validator.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorCompra.js"></script>


<?php
include_once '../app/view/template/footer.php';

?>
