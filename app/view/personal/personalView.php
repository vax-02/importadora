<?php
$title = 'Personal';
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>
<div class="container-fluid">
    <div class="row ml-1 my-3 title-option">
        <div class="col-8">
            <h4 class="text-left">
                <a href="/<?php echo APP_NAME;?>/Personal" class="text-secondary">
                    Personal
                </a>
                > Lista
            </h4>
        </div>
        <div class="col-2 mb-3">
            <a href="/<?php echo APP_NAME?>/Personal/formAdmin" class="btn btn-primary">
                <i class="fas fa-plus"></i> Admin
            </a>
        </div>
        <div class="col-2 mb-3">
            <a href="/<?php echo APP_NAME?>/Personal/form" class="btn btn-primary">
                <i class="fas fa-plus"></i> Personal
            </a>
        </div>
    </div>


    <div class="row">

        <div class="container m-4 ">

            <table class="table display table-hover text-center" id="table2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Sucursal</th>
                        <th scope="col">Celular</th>

                        <th scope="col">Estado</th>
                        <th scope="col" style="min-width: 150px;">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
        $iter = 1;
        foreach ($datos as $row) {
        ?>
                    <tr>
                        <th scope="row"> <?php echo $iter++ ?> </th>
                        <td> <?php echo $row['NOMBRE'] ?> </td>
                        <td> <?php echo $row['USUARIO'] ?> </td>
                        <td> <?php echo $row['CARGO'] ?> </td>
                        <td> <?php echo $row['SUCURSAL'] ?> </td>

                        <td>
                            <?php echo $row['CELULAR']  ?>
                        </td>
                        <td>
                            <?php if ($row['ESTADO']) { ?>
                            <a href="/<?php echo APP_NAME . '/Personal/lock?id=' . $row['ID'] ?>"
                                class="bg-success p-2 text-white" data-toggle="tooltip" data-placement="bottom"
                                title="Precio total con factura">
                                <i class="fa-solid fa-unlock"></i>
                            </a>
                            <?php
              } else {?>
                            <a href="/<?php echo APP_NAME . '/Personal/unlock?id=' . $row['ID'] ?>"
                                class="bg-danger p-2 text-white">
                                <i class="fa-solid fa-lock"></i>
                            </a>
                            <?php } ?>
                        </td>

                        <td>
                            <a href="/<?php echo APP_NAME . '/Personal/update?id=' . $row['ID'] ?>"
                                class="bg-warning p-2 text-white mx-2 ">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <a href="https://wa.me/591<?php echo $row['CELULAR']?>" target="_blank"
                                class="bg-success p-2 text-white mx-2">
                                <i class="fab fa-whatsapp"></i>

                            </a>
                            <a href="/<?php echo APP_NAME . '/Personal/delete?id=' . $row['ID'] ?>"
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
