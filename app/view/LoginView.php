<?php
$title = 'Inicio de Sesión';
session_start();
include_once '../app/view/template/header.php';
?>

<div class="container-fluid bg-login" style="min-height: 100vh;">
    <div class="row justify-content-center align-items-center " style="min-height: 100vh;">
        <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header text-center">
                    <div class="row justify-content-center">
                        <div class="col-5  ">
                            <img src="public/img/user.png" class="img-fluid img-log" alt="nn">
                        </div>
                    </div>
                    <h4>
                        Inicio de sesión
                    </h4>
                    <?php

                    if (isset($_SESSION['error'])) {
                        if ($_SESSION['error'] == 'not user') { ?>
                            <div class="alert alert-danger" role="alert">
                                Credenciales incorrectas
                            </div>
                            <?php
                        }
                        if ($_SESSION['error'] == 'status') { ?>
                            <div class="alert alert-warning" role="alert">
                                Cuenta bloqueada, comuniquese con el administrador
                            </div>
                        <?php }
                        session_destroy();
                    }  ?>
                    
                </div>

                <div class="card-body ">

                    <form method="post" action="/<?php echo APP_NAME; ?>/login/check">
                        <div class="container">
                            <div class="form-group">
                                <label for="text">Usuario:</label>
                                <input type="text" class="form-control" name="user" placeholder="Ingrese su usuario"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <div class="row">
                                    <div class="col-10">
                                        <input type="password" class="form-control" name="pass" id="pass"
                                            placeholder="Ingrese su contraseña" required>
                                    </div>
                                    <div class="col-1 text-center ">
                                        <button class="btn btn-primary" type="button" id="btnPass" onclick="viewPass()">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-primary form-control mt-5 text-white font-weight-bold">Iniciar
                                    sesión</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="/<?php echo APP_NAME ?>/public/js/buttons.js"></script>

<?php
include_once '../app/view/template/footer.php';
?>