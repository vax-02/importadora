<?php
$title = 'Inicio';
//session_start();
include_once '../app/view/template/header.php';
include_once '../app/view/nav/superior.php';
?>


<div class="container-fluid text-center ">
    <div class="title-inicio mx-0">
        <h2 class="">Panel de inicio</h2>
    </div>

    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <?php
        if($datos == []){?>
            <div class="alert alert-warning">
                El sistema no cuenta con datos
            </div>
        <?php
        }
        foreach ($datos as $row) {
            ?>
        <div class="col-sm-10 col-md-5 col-lg-5 p-2 border b-3 text-left m-1 recuadro">
            <h2 class="">
                <?php echo ucwords($row['NOMBRE']) ?>
            </h2>
            <div class="row contenido pb-5">
                <div class="col-5  text-right">
                    <p><b>Marca:</b></p>
                </div>
                <div class="col-7">
                    <p>
                        <?php echo $row['MARCA'] ?>
                    </p>
                </div>
                <div class="col-5 text-right">
                    <p><b>Calidad:</b></p>
                </div>
                <div class="col-7">
                    <p>
                        <?php echo $row['CALIDAD'] ?>
                    </p>
                </div>
                <div class="col-12 text-center">
                    <b>Disponibilidad</b>
                </div>
                <div class="contenido-colors">
                    <div class="col-12 text-center">
                        <table class="table ">
                            <thead>
                                <th>Color</th>
                                <th>Rollos</th>
                                <th>Metros</th>
                                <th>Estado</th>
                            </thead>
                            <tbody>
                                <?php foreach ($row['rollos'] as $rollo) { ?>
                                <tr>
                                    <td>
                                        <div style="display:inline-block; width:15px; height:15px; background: <?php echo $rollo['CODCOLOR'] ?>; border:1px solid
                                            rgb(0,0,0)">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-inline-block"><?php echo $rollo['NUMROLLOS'] ?></div>
                                    </td>
                                    <td>
                                        <div class="d-inline-block"><?php echo $rollo['METROLLO'] ?></div>
                                    </td>
                                    <?php if($rollo['NUMROLLOS'] * $rollo['METROLLO'] < 10){ ?>

                                    <td class="bg-warning bg-opacity-50">
                                        Poco stock
                                    </td>
                                    <?php
                                        }else{ ?>
                                    <td class="bg-success bg-opacity-25">
                                        Disponible
                                    </td>
                                    <?php
                                        }  ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <?php
        }
        ?>
    </div>

    <?php
    include_once '../app/view/nav/inferior.php';    
?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const recuadros = document.querySelectorAll('.recuadro');

            recuadros.forEach(function (recuadro) {
                recuadro.addEventListener('click', function () {
                    this.classList.toggle('expandido');
                });
            });
        });

    </script>



    <?php
    include_once '../app/view/template/footer.php';
?>
