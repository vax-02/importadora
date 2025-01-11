<?php
$title = 'Cargo | Nuevo';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
  <h4 class="text-left mt-3">
    <a href="/<?php echo APP_NAME;?>/Cargo" class="text-secondary">
    Cargo
    </a>
    > Agregar
  </h4>
  <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
    <div class="col-6" >
      <form action="/<?php echo APP_NAME; ?>/Cargo/create" method="POST" class="border-form">
        <div class="container-fluid">
          <div class="row mt-3 justify-content-center align-items-center">
            <div class="col-12">
            <label for="">Descrición</label>
              <input type="text" class="form-control" name="descri" required>
              <small class="form-text text-muted">Ingr. descripcion del cargo</small>
            </div>
          </div>

          <div class="row mt-3 justify-content-center align-items-center">
            <div class="col-8 ">
              <div class="clearfix">
                <a href="/<?php echo APP_NAME.'/Cargo'?>" class="btn btn-primary mt-5 float-left">Volver</a>
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