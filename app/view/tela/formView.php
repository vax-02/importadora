<?php
$title = 'Tela | Agregar';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <h4 class="text-left mt-3">
        <a href="/<?php echo APP_NAME; ?>/Tela" class="text-secondary">
            Tela
        </a>
        > Agregar
    </h4>
    <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
        <div class="col-10">
            <form action="/<?php echo APP_NAME; ?>/tela/create" method="POST" class="border-form mb-4" id="formTela">
                <div class="container-fluid">
                    <div class="form-section active" id="seccion1">
                        <h3>Información de la Tela</h3>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label for="" class="form-label">Nombre</label>
                                <select name="nombre" id="" class="form-control">
                                    <?php foreach($datos2 as $pr){
                                    ?>
                                    <option value="<?php echo $pr['nombre'] ?>"><?php echo $pr['nombre'] ?></option>
                                    <?php
                                } ?>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label for="">Calidad</label>
                                <select name="calidad" class="form-control">
                                    <option value="1">1RA</option>
                                    <option value="2">2DA</option>
                                    <option value="3">3RA</option>
                                    <option value="4">4TA</option>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label for="">Marca</label>
                                <select name="marca" class="form-control">
                                    <?php foreach ($datos as $row) { ?>
                                    <option value="<?php echo $row['CODMARCA'] ?>">
                                        <?php echo $row['DESCRIPCION'] ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center align-items-center ">
                            <div class="container ">

                                <div class="container mt-2">
                                    <label><b>Metraje (m.)</b></label>
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <label for="">Metros por rollo</label>
                                            <input type="number" name="metros" id="metroRollo" class="form-control"
                                                required>
                                            <small id="error_metroRollo" class="form-text text-danger"></small>
                                        </div>
                                    </div>
                                </div>
                                <label><b>Precio por rollo</b></label>
                                <div class="row justify-content-center">
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <label for="">Ingr. precio real <b>(Bs.)</b> </label>
                                        <input type="number" class="form-control" name="pVentaRolloReal"
                                            id="precioRealRollo" min="0" required>
                                        <small id="error_precioRealRollo" class="form-text text-danger"></small>
                                    </div>

                                    <div class="col-md-3 col-lg-3 col-sm-12">
                                        <label for="">Incremento del: <b id="val-incremento-rollo">10</b> %</label>
                                        <input type="range" class="form-control" id="incremento-rollo" min="0" step="1" max="30" value="10">
                                        <small id="error_precioRealRollo" class="form-text text-danger"></small>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <label for="">Ingr. precio de venta <b>(Bs.)</b></label>
                                        <input type="number" class="form-control" name="pVentaRollo"
                                            id="precioVentaRollo" required >
                                        <small class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>



                            <div class="container mt-2">
                                <label><b>Precio metro</b></label>
                                <div class="row justify-content-center">
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <label for="">Precio real <b>(Bs.)</b></label>
                                        <input type="number" name="precioMetroReal" id="precioMetroReal"
                                            class="form-control" readonly required>
                                        <small id="" class="form-text text-danger"></small>
                                    </div>

                                    
                                    <div class="col-md-3 col-lg-3 col-sm-12">
                                        <label for="">Incremento del: <b id="val-incremento-metro">10</b> %</label>
                                        <input type="range" class="form-control" id="incremento-metro" min="0" step="1" max="50" value="10">
                                    </div>


                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <label for="">Precio de venta <b>(Bs.)</b></label>
                                        <input type="number" name="precioMetro" id="precioMetro" class="form-control"
                                            required >
                                        <small id="error_precioMetro" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row mt-1 justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="clearfix">
                                    <a href="/<?php echo APP_NAME . '/Tela' ?>"
                                        class="btn btn-primary mt-5 float-left">Volver</a>
                                    <button class="btn btn-success mt-5 float-right" type="button"
                                        onclick="siguienteSeccion()" id="sigOne" >
                                        Siguiente <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section" id="seccion2">
                        <h3>Colores de la Tela</h3>

                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label class="">Elija un color</label>
                                <input type="color" name="color" id="color" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <label class="">Ingr. cantidad de rollos</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" min="0"
                                    step="1">
                                <small class="form-text text-muted"></small>
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
                                            <th>Numero de rollos</th>
                                            <th>Opción</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
                                    <button type="submit" class="btn btn-success mt-5 float-right" id="btnSave"
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

<?php
include_once '../app/view/nav/inferior.php';
?>

<script src="/<?php echo APP_NAME ?>/public/js/form-part.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/addRollo.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/Validator.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorAddTela.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/PreciosTela.js"></script>

<?php

include_once '../app/view/template/footer.php';

?>