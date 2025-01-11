<?php
$title = 'Producto | Agregar';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME; ?>/Tela" class="text-secondary">
            Producto
        </a>
        > Agregar
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/Productos/create" method="POST" class="border-form" id="formTela">
                <div class="container-fluid">
                    <div class="form-section active" id="seccion1">
                        <?php if($datos == 'error'){
                            $datos = []; ?>
                        <div class="alert alert-warning">La tela ya existe</div>
                        <?php } ?>

                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nameTela" name="nombre" required>
                                <small id="error_name_tela" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="clearfix">
                                    <a href="/<?php echo APP_NAME . '/Productos' ?>"
                                        class="btn btn-primary mt-5 float-left">Volver</a>
                                    <button type="submit" class="btn btn-success mt-5 float-right" type="button"
                                        id="sigOne" disabled>
                                        Guardar
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
?>

<script src="/<?php echo APP_NAME ?>/public/js/Validator.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorAddTela.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorProduct.js"></script>

<?php

include_once '../app/view/template/footer.php';

?>
