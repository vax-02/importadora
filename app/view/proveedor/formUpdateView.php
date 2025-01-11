<?php
$title = 'Proveedor | Modificar';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME;?>/Proveedor" class="text-secondary">
            Proveedor
        </a>
        > Modificar
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/proveedor/save" method="POST" class="border-form">
                <h3 class="mb-3">Modificación de datos</h3>

                <input type="hidden" name="id" value="<?php echo $datos['CODPROV'] ?>">
                <div class="container-fluid">
                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?php echo $datos['NOMBRE'] ?>" required>
                            <small id="error_nombre" class="form-text text-danger"></small>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Celular</label>
                            <input type="number" class="form-control" name="cel" id="cel"
                                value="<?php echo $datos['TELEFONO'] ?>" required>
                            <small id="error_cel" class="form-text text-danger"></small>
                        </div>

                    </div>

                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label for="" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direc"
                                value="<?php echo $datos['DIRECCION'] ?>" required>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="clearfix">
                                <a href="/<?php echo APP_NAME.'/Proveedor'?>"
                                    class="btn btn-primary mt-5 float-left">Volver</a>
                                <button type="submit" id="btnSave"
                                    class="btn btn-success mt-5 float-right">Guardar</button>

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
?>

<script src="/<?php echo APP_NAME ?>/public/js/Validator.js" defer></script>
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorProveedor.js" defer></script>

<?php
include_once '../app/view/template/footer.php';

?>
