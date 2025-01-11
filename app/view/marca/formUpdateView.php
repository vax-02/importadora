<?php
$title = 'Marca | Modificar';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME;?>/Marca" class="text-secondary">
            Marca
        </a>
        > Modificar
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/Marca/save" method="POST" class="border-form">
                <h3 class="mb-3">Modificación de datos</h3>

                <input type="hidden" name="id" value="<?php echo $datos['CODMARCA'] ?>">
                <div class="container-fluid">
                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-12">
                            <label for="">Descripción</label>
                            <input type="text" class="form-control" id="descri" name="descri"
                                value="<?php echo $datos['DESCRIPCION'] ?>" required>
                            <small id="error_descri" class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 ">
                            <div class="clearfix">
                                <a href="/<?php echo APP_NAME.'/Marca'?>"
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
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorMarca.js" defer></script>

<?php
include_once '../app/view/template/footer.php';

?>
