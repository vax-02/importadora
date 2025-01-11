<div class="modal fade" id="formModalCliente" tabindex="-1" aria-labelledby="formModalCliente" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row text-center">
                        <h1 class="modal-title fs-5">
                            Nuevo Cliente
                        </h1>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="" method="POST" class="" id="formModal">
                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-3">
                                <label for="" class="form-label">Razón Social</label>
                                <input type="text" class="form-control" name="nombre" id="nameCli" required>
                                <small id="error_razon" class="form-text text-danger "></small>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-3">
                                <label for="">CI / NIT</label>
                                <input type="number" class="form-control" name="cinit" id="cinitCli" required>
                                <small id="error_cinit" class="form-text text-danger "></small>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label for="">Tipo de cliente</label>
                                <select class="form-control" name="tipo" id="tipo" required>
                                    <option value="personal">Personal</option>
                                    <option value="empresa">Empresa</option>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-3">
                                <label for="">Celular</label>
                                <input type="number" class="form-control" name="cel" id="celCli" required>
                                <small id="error_cel" class="form-text text-danger "></small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary mr-5" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success ml-5" data-bs-dismiss="modal" id="btnSave" onclick="saveClient()">Guardar</button>
            </div>
        </div>
    </div>
</div>
