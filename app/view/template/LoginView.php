<?php
    $title = 'Login';
    include_once '../app/view/template/header.php';
?>

<div class="container-fluid bg" style="min-height: 100vh;">
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
                        Iniciar Secion
                    </h4>
                    
                </div>

                <div class="card-body">

                    <form method="post" action="login/check">
                        <div class="form-group">
                            <label for="text">Usuario:</label>
                            <input type="text" class="form-control" name="user" placeholder="Ingresa tu usuario"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" name="pass" placeholder="Ingresa tu contraseña"
                                required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary text-white font-weight-bold">Iniciar sesión</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once '../app/view/template/footer.php';
?>