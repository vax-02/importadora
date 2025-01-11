<?php
$title = 'Personal | Modificar';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME;?>/Personal" class="text-secondary">
            Personal
        </a>
        > Modificar
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/personal/save" method="POST" class="border-form">
            <h3 class="mb-3">Modificación de datos</h3>

                <input type="hidden" name="id" value="<?php echo $datos['ID'] ?>">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="namePer"
                                value="<?php echo $datos['NOMBRE'] ?>" required>
                            <small id="error_name" class="form-text text-danger">
                            </small>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Apellido Paterno</label>
                            <input type="text" class="form-control" name="apeP" id="lastNamePer"
                                value="<?php echo $datos['PATERNO'] ?>" required>
                            <small id="error_paterno" class="form-text text-danger"></small>

                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Apellido Materno</label>
                            <input type="text" class="form-control" name="apeM" id="lasttName2Per"
                                value="<?php echo $datos['MATERNO'] ?>" required>
                            <small id="error_materno" class="form-text text-danger"></small>

                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <label for="">Celular</label>
                            <input type="number" class="form-control" name="cel" id="numbertPer"
                                value="<?php echo $datos['CELULAR'] ?>" required>
                            <small id="error_celular" class="form-text text-danger"></small>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <label for="">Usuario</label>
                            <input type="text" class="form-control" name="usuario"
                                value="<?php echo $datos['USUARIO'] ?>" required>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Cargo</label>
                            <select class="form-control" name="rol" id="" required>
                                <option value="<?php echo $datos['CODCARGO'] ?>"><?php echo $datos['CARGO'] ?></option>
                                <?php if($msg != []){ ?>
                                <option value="<?php echo $msg[0] ?>"><?php echo $msg[1] ?></option>

                                <?php } ?>
                            </select>
                            <small class="form-text text-muted">Seleccione un cargo</small>
                        </div>

                    </div>
                    <div class="row mt-3 justify-content-center align-items-center">

                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <label for="">Sucursal</label>

                            <select class="form-control" name="sucursal" id="" required>
                                <option value="<?php echo $datos['CODSUCURSAL'] ?>"><?php echo $datos['SUCURSAL'] ?>
                                </option>
                                <?php foreach($datos2 as $row) {?>
                                <option value="<?php echo $row['CODSUCURSAL'] ?>"> <?php echo $row['NOMBRE'] ?></option>

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
                                <button type="submit" id="save" class="btn btn-success mt-5 float-right">Guardar</button>
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
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorPersonal.js"></script>

<?php
include_once '../app/view/template/footer.php';

?>
