<?php
$title = 'Sucursal | Nuevo';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>

<div class="container-fluid">
  <h4 class="text-left mt-3">
    <a href="/<?php echo APP_NAME;?>/Sucursal" class="text-secondary">
    Sucursal
    </a>
    > Nueva
  </h4>

  <div class="row justify-content-center align-items-center  text-center" style="min-height: 70vh;">
    <div class="col-10" >
    <form action="/<?php echo APP_NAME; ?>/Sucursal/create" method="POST" class="border-form">
    <h3 class="mb-3">Nueva sucursal</h3>

        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <label for="" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" id="nombre" required>
              <small id="error_nombre" class="form-text text-danger"></small>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
              <label for="">Dirección</label>
              <input type="text" class="form-control" name="direccion" id="direccion" required>
              <small id="error_direccion" class="form-text text-danger"></small>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">            
              <label for="">Descripción</label>
              <input type="text" class="form-control" name="descripcion" id="descripcion" required>
              <small id="error_descripcion" class="form-text text-danger"></small>
            
            </div>
          </div>   
          
          <div class="row mt-3 justify-content-center align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
              <label for="">Celular</label>
              <input type="number" class="form-control" name="cel" id="cel" required>
              <small id="error_cel" class="form-text text-danger"></small>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
              <label for="">Encargado</label>
              <select class="form-control" name="encargado" id="" required>
                <?php foreach($datos as $row) {?>  
                  <option value="<?php echo $row['ID'] ?>"><?php echo $row['NOMBRE'].' '.$row['PATERNO'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="row mt-3 justify-content-center align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
              <div class="clearfix">
                <a href="/<?php echo APP_NAME.'/Sucursal'?>" class="btn btn-primary mt-5 float-left">Volver</a>
                <button id="btnSave" type="submit" class="btn btn-success mt-5 float-right">Guardar</button>
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
<script src="/<?php echo APP_NAME ?>/public/js/ValidatorSucursal.js" defer></script>

<?php
include_once '../app/view/template/footer.php';

?>
