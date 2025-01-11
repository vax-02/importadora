<?php
$title = 'Telas';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>
<div class="container-fluid">
   <div class="row ml-1 my-3 title-option">
      <div class="col-10">
         <h4 class="text-left">
            <a href="/<?php echo APP_NAME; ?>/Tela" class="text-secondary">
               Tela
            </a>
            > Lista
         </h4>
      </div>
      <div class="col-2 mb-3">
         <a href="/<?php echo APP_NAME ?>/Tela/form" class="btn btn-primary">
            <i class="fas fa-plus"></i>
         </a>
      </div>
   </div>


   <div class="container cont-table">
      <table class="table display table-hover text-center" id="table2">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">Nombre</th>
               <th scope="col">Calidad</th>
               <th scope="col">Colores</th>
               <th scope="col">Marca</th>
               
               
               <th scope="col">Opciones</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $iter = 1;
            foreach ($datos as $row) {
               ?>
               <tr>
                  <th scope="row">
                     <?php echo $iter++ ?>
                  </th>
                  <td>
                     <?php echo $row['NOMBRE'] ?>
                  </td>
                  <td>
                     <?php echo $row['CALIDAD'] ?>
                  </td>
                  <td>
                     <?php
                     foreach ($row['colores'] as $color) {
                        ?>
                        <div
                           style="border:1px solid rgb(0,0,0); display:inline-block; width:15px; height:15px; background: <?php echo $color['CODCOLOR'] ?>;">
                        </div>
                        <?php
                     }
                     ?>

                  </td>
                  <td>
                     <?php echo $row['MARCA'] ?>
                  </td>
                 
                 
                  <td>
                     <a href="/<?php echo APP_NAME . '/Tela/addStock?id=' . $row['CODTELA'] ?>"
                        class="bg-success p-2 text-white mx-2 ">
                        <i class="fa-solid fa-add"></i>
                     </a>

                     <a href="/<?php echo APP_NAME . '/Tela/delete?id=' . $row['CODTELA'] ?>"
                        class="bg-danger p-2 text-white eliminar">
                        <i class="fa-solid fa-trash"></i>
                     </a>
                  </td>
               </tr>
            <?php } ?>

         </tbody>

      </table>
   </div>
</div>






<?php
include_once '../app/view/nav/inferior.php';
include_once '../app/view/template/footer.php';

?>