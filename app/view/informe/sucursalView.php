<?php
$title = 'Informe | Sucursal';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
    <div class="row ml-1 mt-3 title-option">
        <div class="col-8">
            <h4 class="text-left">
                <a href="/<?php echo APP_NAME; ?>/Informe" class="text-secondary">
                    Informes
                </a>
                > Sucursales
            </h4>
        </div>
        <div class="col-4 mb-1 text-right">
            <a href="/<?php echo APP_NAME ?>/Informe/sucursalesToExcel?date=<?php echo $datos?>" class="btn btn-success"
                id="sucursalToExcel">
                <i class="fab fa-microsoft"></i>
            </a>
        </div>
    </div>


    <div class="row">
        <div class="col-12 text-center">
            <div class="row ">
                <div class="col-12 text-center ">
                    <h3 class="title-graf"><b>Ventas realizadas por sucursal</b></h3>
                    <div class="row">
                        <div class="col-lg-6 text-center">
                            <canvas id="sucursales"></canvas>
                        </div>
                        <div class="col-lg-6 p-4 opcionVendedores text-center">
                            <div class="row justify-content-center" style="height: 50%;">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Filtrado por:</label>
                                        <select name="typeFilter" id="typeFilter" class="form-control">
                                            <option value="1">Dia</option>
                                            <option value="2">Semana</option>
                                            <option value="3">Mes</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="row  justify-content-center align-items-center">

                                        <div class="col-lg-6 col-xlg-6 col-sm-12 col-md-12">
                                            <label for="">Seleccione una fecha</label>
                                            <input type="date" class="form-control" id="dateSucursal"
                                                value="<?php echo $datos ?>">

                                            <input id="week" type="week" class="form-control d-none">
                                            <input id="month" type="month" class="form-control d-none">
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="row " style="height: 50%;">
                                <h5> <b>
                                        Ventas realizadas por sucursal
                                    </b>
                                </h5>
                                <div class="col-12  text-center justify-content-center align-items-center">
                                    <div id="labelsContainer"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once '../app/view/nav/inferior.php';
?>
<script src="/<?php echo APP_NAME ?>/public/js/SucursalGrafica.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/graficas.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/filterGrafica.js"></script>


<?php
include_once '../app/view/template/footer.php';

?>
