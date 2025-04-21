<?php
$title = 'Informes';
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
                > Gráficos
            </h4>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 text-center">
            <div class="row ">
                <div class="col-12 pb-4" style="height: 43vh;">
                    <div class="row">
                        <div class="col-12">
                            <h5> <b> TELAS MAS VENDIDAS (TOP 3) </b></h5>
                        </div>
                    </div>
                    <div class="row  pb-4 justify-content-center align-items-center" style="height: 100%;">
                        <div class="col-10 ">
                            <div id="fist" class="bg-first  my-1 justify-content-center align-items-center d-flex">
                                <h5>
                                    <?php echo $datos[0]['NOMBRE']. ' -- ' . $datos[0]['CALIDAD'] . ' -- '. $datos[0]['MARCA'] ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-9 ">
                            <div id="second" class="bg-second my-1 justify-content-center align-items-center d-flex">
                                <h5>
                                    <?php echo $datos[1]['NOMBRE']. ' -- ' . $datos[1]['CALIDAD'] . ' -- '. $datos[1]['MARCA'] ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-8">
                            <div id="third" class="bg-third my-1 justify-content-center align-items-center d-flex">
                                <h5>
                                    <?php echo $datos[2]['NOMBRE']. ' -- ' . $datos[2]['CALIDAD'] . ' -- '. $datos[2]['MARCA'] ?>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 text-center " style="height: 43vh;">
                    <h5 class="title-graf"> <b>VENTAS REALIZADAS POR EL PERSONAL </b>
                        <a href="/<?php echo APP_NAME ?>/informe/ventasPersonal" class="ml-5 info-graf">
                            <i class="fa-solid fa-circle-info text-light"></i>
                        </a>
                    </h5>


                    <div class="row">
                        <div class="col-6">
                            <div>
                                <canvas id="vendedores"></canvas>
                            </div>
                        </div>
                        <div class="col-6 text-left justify-content-center align-items-center d-flex">
                            <div id="labelVendedores">

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-12 text-center" style="43vh;">
                    <h5 class="title-graf"> <b>VENTAS POR SUCURSAL</b>
                        <a href="/<?php echo APP_NAME?>/informe/ventasSucursal" class="ml-5 info-graf">
                            <i class="fa-solid fa-circle-info text-light"></i>
                        </a>
                    </h5>
                    <div class="row">
                        <div class="col-6">
                            <canvas id="sucursales"></canvas>
                        </div>

                        <div class="col-6 text-left justify-content-center align-items-center d-flex">
                            <div id="labelsContainer"></div>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center" style="43vh;">
                    <h5 class="title-graf"> <b> VENTA DE TELAS </b>
                        <a href="/<?php echo APP_NAME ?>/informe/ventaTelas" class="ml-5 info-graf">
                            <i class="fa-solid fa-circle-info text-light"></i>
                        </a>
                    </h5>
                    <canvas id="telasColores"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 text-center" style="43vh;">
                <h5 class="title-graf"> <b> COMPRAS DE CLIENTES </b>
                    <a href="/<?php echo APP_NAME ?>/informe/compras" class="ml-5 info-graf">
                        <i class="fa-solid fa-circle-info text-light"></i>
                    </a>
                </h5>
                <div class="row">
                    <div class="col-6">
                        <div>
                            <canvas id="comprasCliente"></canvas>
                        </div>
                    </div>
                    <div class="col-6 text-left justify-content-center align-items-center d-flex">
                        <div id="labelsClientes"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<?php
include_once '../app/view/nav/inferior.php';
?>
<script src="/<?php echo APP_NAME ?>/public/js/graficas.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/filterGrafica.js"></script>


<?php
include_once '../app/view/template/footer.php';

?>