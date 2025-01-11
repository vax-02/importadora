<?php
$title = 'Personal | Agregar';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME;?>/Personal" class="text-secondary">
            Personal
        </a>
        > Agregar
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/personal/create" method="POST" class="border-form">
                <h3 class="mb-3">Nuevo personal</h3>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="namePer" required>
                            <small id="error_name" class="form-text text-danger">
                            </small>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Apellido Paterno</label>
                            <input type="text" class="form-control" name="apeP" id="lastNamePer" required>
                            <small id="error_paterno" class="form-text text-danger"></small>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Apellido Materno</label>
                            <input type="text" class="form-control" name="apeM" id="lasttName2Per" required>
                            <small id="error_materno" class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <label for="">Celular</label>
                            <input type="number" class="form-control" name="cel" id="numbertPer" required>
                            <small id="error_celular" class="form-text text-danger"></small>
                        </div>


                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <label for="">Usuario</label>
                            <input type="text" class="form-control" name="usuario" required>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <label for="">Contraseña</label>
                            <input type="text" class="form-control" name="pass" id="pass" required>
                            <small id="error_pass" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Cargo</label>
                            <select class="form-control" name="rol" id="" required>
                                <option value="1">Administrador</option>
                                <option value="3">Vendedor</option>
                            </select>
                            <small class="form-text text-muted">Seleccione un cargo</small>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Sucursal</label>
                            <select class="form-control" name="sucursal" id="" required>
                                <option value="0">Sin sucursal definida</option>
                                <?php foreach($datos as $row) {?>
                                <option value="<?php echo $row['CODSUCURSAL'] ?>"><?php echo $row['NOMBRE'] ?></option>
                                <?php } ?>
                            </select>
                            <small class="form-text text-muted">Seleccione sucursal</small>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <div class="clearfix">
                                <a href="/<?php echo APP_NAME.'/Personal'?>"
                                    class="btn btn-primary mt-5 float-left">Volver</a>
                                <input type="submit" value="Guardar" id="save" class="btn btn-success mt-5 float-right">
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
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorPersonal.js" defer></script>

<?php
include_once '../app/view/template/footer.php';

?>
