<?php
$title = 'Cliente | Nuevo';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
  <h4 class="text-left mt-3">
    <a href="/<?php echo APP_NAME;?>/Cliente" class="text-secondary">
    Venta
    </a>
    > Cliente >Nuevo
  </h4>
  <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
    <div class="col-10" >
      <form action="/<?php echo APP_NAME; ?>/cliente/createVenta" method="POST" class="border-form">
        <div class="container-fluid">
          <div class="row mt-3 justify-content-center align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label for="" class="form-label">Razón Social</label>
              <input type="text" class="form-control" name="nombre" required>
              <small class="form-text text-muted">Ingr. razon social</small>
            
            </div>
            <div class="col-4">
              <label for="">CI / NIT</label>
              <input type="number" class="form-control" name="cinit" required>
              <small class="form-text text-muted">Ingr. C.I. o NIT</small>
            </div>
  

          </div>

          <div class="row mt-3 justify-content-center align-items-center">
            <div class="col-4">
              <label for="">Tipo de cliente</label>
              <select class="form-control" name="tipo" id="" required>
                  <option value="personal">Personal</option>
                  <option value="empresa">Empresa</option>

              </select>
              <small class="form-text text-muted">Seleccione un opción</small>
            </div>

            <div class="col-3">
              <label for="">Telefono</label>
              <input type="number" class="form-control" name="cel">
              <small class="form-text text-muted">Ingr. número de contacto</small>
            </div>
              
          </div>

          <div class="row mt-3 justify-content-center align-items-center">
            <div class="col-4">
              <div class="clearfix">
                <a href="/<?php echo APP_NAME.'/Cliente'?>" class="btn btn-primary mt-5 float-left">Volver</a>
                <input type="submit" value="Guardar" class="btn btn-success mt-5 float-right">
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
include_once '../app/view/template/footer.php';

?>