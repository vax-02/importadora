<?php
$title = 'Informe | Personal';
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
                > Personal
            </h4>
        </div>
        <div class="col-4 mb-1 text-right">
            <a href="/<?php echo APP_NAME ?>/Informe/sellsToExcel" target="_blank" class="btn btn-success">
                <i class="fab fa-microsoft"></i>
            </a>

            <a href="/<?php echo APP_NAME ?>/Informe/sellsToPdf" target="_blank" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i>
            </a>
        </div>
    </div>


    <div class="row">
        <div class="col-12 text-center">
            <div class="row ">
                <div class="col-12 text-center ">
                    <h3 class="title-graf"> <b> Ventas realizadas por el personal </b></h3>
                    <div class="row">
                        <div class="col-6">
                            <div>
                                <canvas id="vendedores"></canvas>
                            </div>
                        </div>
                        <div class="col-6 p-4 opcionVendedores text-center">
                            <div class="row ">
                                <h5> <b>
                                        Los 5 mejores empleados
                                    </b>
                                </h5>
                                <div class="col-12  text-center justify-content-center align-items-center">

                                    <div id="labelVendedores">
                                    </div>
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
<script src="/<?php echo APP_NAME ?>/public/js/graficas.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/filterGrafica.js"></script>


<?php
include_once '../app/view/template/footer.php';

?>
