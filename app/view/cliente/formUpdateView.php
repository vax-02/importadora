<?php
$title = 'Cliente | Modificar';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME;?>/Cliente" class="text-secondary">
            Cliente
        </a>
        > Modificar
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/cliente/save" method="POST" class="border-form">
                <h3 class="mb-3">Modificación de datos</h3>

                <input type="hidden" name="id" value="<?php echo $datos['IDCLIENTE'] ?>">

                <div class="container-fluid">
                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="" class="form-label">Razón Social</label>
                            <input type="text" class="form-control" name="nombre" id="nameCli"
                                value="<?php echo $datos['RAZONSOCIAL'] ?>" required>
                            <small id="error_razon" class="form-text text-danger"></small>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">CI / NIT</label>
                            <input type="number" class="form-control" name="cinit" id="cinitCli"
                                value="<?php echo $datos['CI_NIT'] ?>" required>
                            <small id="error_cinit" class="form-text text-danger"></small>
                        </div>


                    </div>

                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Tipo de cliente</label>
                            <select class="form-control" name="tipo" id="" required>
                                <option value="<?php echo $datos['TIPO'] ?>"><?php echo ucwords($datos['TIPO']) ?>
                                </option>
                                <?php if ($datos['TIPO'] == 'personal'){?>
                                <option value="empresa">Empresa</option>
                                <?php
                }else{?>
                                <option value="personal">Personal</option>
                                <?php
                }?>

                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Celular</label>
                            <input type="number" class="form-control" name="cel" id="celCli"
                                value="<?php echo $datos['TELEFONO'] ?>">
                            <small id="error_cel" class="form-text text-danger"></small>

                        </div>

                    </div>

                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="clearfix">
                                <a href="/<?php echo APP_NAME.'/Cliente'?>"
                                    class="btn btn-primary mt-5 float-left">Volver</a>
                                <input type="submit" value="Guardar" class="btn btn-success mt-5 float-right"
                                    id="btnSave">
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
