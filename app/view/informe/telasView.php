<?php
$title = 'Informe | Telas';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>
<!--MODALS-->
<div class="modal fade" id="selectReport" tabindex="-1" aria-labelledby="selectReport" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row text-center">
                        <h2 class="modal-title fs-5" id="exampleModalLabel">
                            Seleccione una opción para exportar
                        </h2>
                    </div>

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row justify-content-center align-items-center d-flex">
                        <div class="col-6 text-center">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                                <a href="/<?php echo APP_NAME ?>/Informe/telasToExcel" class="btn">
                                    <i class="fab fa-microsoft"></i>
                                    Telas
                                </a>
                            </button>
                        </div>
                        <div class="col-6 text-center">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                                <a href="/<?php echo APP_NAME ?>/Informe/marcasToExcel" class="btn">
                                    <i class="fab fa-microsoft"></i>
                                    Marcas
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="selectReportPdf" tabindex="-1" aria-labelledby="selectReportPdf" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row text-center">
                        <h2 class="modal-title fs-5" id="exampleModalLabel">
                            Seleccione una opción para exportar
                        </h2>
                    </div>

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row justify-content-center align-items-center d-flex">
                        <div class="col-6 text-center">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                <a href="/<?php echo APP_NAME ?>/Informe/telasToPdf" class="btn" target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                    Telas
                                </a>
                            </button>
                        </div>
                        <!--div class="col-6 text-center">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                                <a href="/<?php echo '' ?>/Informe/marcasToPdf" class="btn" target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                    Marcas
                                </a>
                            </button>
                        </div-->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row ml-1 mt-3 title-option">
        <div class="col-8">
            <h4 class="text-left">
                <a href="/<?php echo APP_NAME; ?>/Informe" class="text-secondary">
                    Informes
                </a>
                > Telas y marcas
            </h4>
        </div>
        <div class="col-4 mb-1 text-right">

            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#selectReport">
                <i class="fab fa-microsoft"></i>
            </button>
            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#selectReportPdf">
                <i class="fas fa-file-pdf"></i>
            </button>
        </div>
    </div>


    <div class="row text-center justify-content-center">

        <div class="col-3 ">
            <select name="" id="selectGrafica" class="form-control">
                <option value="1">Telas</option>
                <option value="2">Marcas</option>
            </select>
        </div>

        <div class="col-12 ">
            <canvas id="telasColores"></canvas>
        </div>
    </div>
</div>


<?php
include_once '../app/view/nav/inferior.php';
?>
<script src="/<?php echo APP_NAME ?>/public/js/graficas.js"></script>
<script src="/<?php echo APP_NAME ?>/public/js/filterGrafica.js"></script>
<script>
    const selectGrafica = document.getElementById("selectGrafica");
    selectGrafica.addEventListener("change", () => {
        const valorSeleccionado = selectGrafica.value;
        console.log("Valor seleccionado:", valorSeleccionado);

        chartMarcaTela.destroy();
        if (valorSeleccionado == 1) {
            grafTelas();
        } else {
            grafMarcas();
        }
    });

</script>

<?php
include_once '../app/view/template/footer.php';

?>
