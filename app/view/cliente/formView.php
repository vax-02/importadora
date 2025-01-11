<?php
$title = 'Cliente | Nuevo';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME;?>/Cliente" class="text-secondary">
            Cliente
        </a>
        > Nuevo
    </h4>
    <div class="row justify-content-center align-items-center text-center" style="min-height: 70vh;">
        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/cliente/create" method="POST" class="border-form">
                <h3 class="mb-3">Nuevo Cliente</h3>
                <div class="container-fluid">
                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="" class="form-label">Razón Social</label>
                            <input type="text" class="form-control" name="nombre" id="nameCli" required>
                            <small id="error_razon" class="form-text text-danger"></small>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">CI / NIT</label>
                            <input type="number" class="form-control" name="cinit" id="cinitCli" required>
                            <small id="error_cinit" class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Tipo de cliente</label>
                            <select class="form-control" name="tipo" id="" required>
                                <option value="personal">Personal</option>
                                <option value="empresa">Empresa</option>

                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <label for="">Celular</label>
                            <input type="number" class="form-control" name="cel" id="celCli" required>
                            <small id="error_cel" class="form-text text-danger"></small>
                        </div>

                    </div>

                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                            <div class="clearfix">
                                <a href="/<?php echo APP_NAME.'/Cliente'?>"
                                    class="btn btn-primary mt-5 float-left">Volver</a>
                                <input type="submit" value="Guardar" id="btnSave"
                                    class="btn btn-success mt-5 float-right">
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
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorCliente.js"></script>

<?php
include_once '../app/view/template/footer.php';

?>
