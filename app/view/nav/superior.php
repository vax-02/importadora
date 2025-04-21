<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['rol'])) {
    header('Location: /' . APP_NAME . '/login');
}

function optionSelect($option){
    $url = rtrim($_GET['url'],'/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);
    return strtolower( $url[0] ) == strtolower( $option);
}
function getUri(){
    $url = rtrim($_GET['url'],'/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);
    return $url;
}
function optionSucursal(){
    $uri = getUri();
    if($uri[0] == 'Sucursal'){
        if(isset($uri[1])){
            if($uri[1] == 'Inicio' || $uri[1] == 'Supervisar' || $uri[1] == 'selectSucursal')
                return false;
        }
        return true;
    }
    return false;
}
?>

<!-- Modal -->
<div class="modal fade" id="misucursal" tabindex="-1" aria-labelledby="misucursal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row text-center">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            <?php echo $_SESSION['sucursal'] ?>
                        </h1>
                    </div>

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row text-justify">
                        <p>Usted se encuentra designado en la sucursal
                            <?php echo $_SESSION['sucursal'] ?>, usted se encuentra en esta sucursal como
                            <?php echo $_SESSION["cargo"] ?>

                        </p>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="miperfil" tabindex="-1" aria-labelledby="miperfil" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container ">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mi Perfil</h1>
                        </div>
                        <div class="col-12 bg-info text-center text-light">
                            <i class="fas fa-user  m-3"></i>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6 text-right mb-1">
                            <b>Nombre:</b>
                        </div>
                        <div class="col-6 text-left mb-1">
                            <?php
                            echo $_SESSION['nombre']
                                ?>
                        </div>
                        <div class="col-6 text-right mb-1">
                            <b>Usuario:</b>
                        </div>
                        <div class="col-6 text-left mb-1">
                            <?php
                            echo $_SESSION['usuario']
                                ?>
                        </div>


                        <div class="col-6 text-right mb-4">
                            <b>Celular:</b>
                        </div>
                        <div class="col-6 text-left mb-4">
                            <?php
                            echo $_SESSION['celular']
                                ?>
                        </div>

                        <div class="col-6 text-right ">
                            <b>Cargo:</b>
                        </div>
                        <div class="col-6 text-left ">
                            <?php
                            echo $_SESSION['cargo']
                                ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="/<?php echo APP_NAME ?>/login/logout" class="btn btn-danger">Cerrar session</a>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>



<div class="row"></div>
<div class="barra-lateral">
    <!--CONTENEDORES PARA HACER RESPONSIVO-->
    <div>
        <div class="name-page">
            <i id="icon-app">
                <img src="/<?php echo APP_NAME ?>/public/img/importadora.png" alt="404">
            </i>
            <span id="title-app" class="text-center">
                <small class="form-text text-muted">importadora</small>
                <b>Fernandez</b>
            </span>
        </div>

        <button class="button">
            <i class="fas fa-store "></i>
            <span><?php echo $_SESSION['sucursal'] ?></span>
        </button>
    </div>

    <nav class="navegacion" id="navigation">
        <ul style="padding-left: 5px;">
            <?php if ($_SESSION['rol'] < 2) { //SUPERVISOR AND ADMIN  ?>
            <li <?php echo optionSelect("inicio") ?  'class="option-select"':'' ?>>

                <a href="/<?php echo APP_NAME; ?>/Inicio">
                    <i class="fas fa-home mx-3"></i>
                    <span>Inicio</span>
                </a>

            </li>

            <li <?php echo optionSelect("informe") ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Informe">
                    <i class="fa-solid fa-file-contract mx-3"></i>

                    <span>Informes</span>
                </a>
            </li>

            <?php } ?>

            <li <?php echo getUri()[1]=='Inicio' ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Sucursal/Inicio">
                    <i class="fas fa-home mx-3"></i>
                    <span>Inicio sucursal</span>
                </a>
            </li>


            <?php  if ($_SESSION['rol'] <= 2) { //SUPERVISOR AND ADMIN  ?>
            <li <?php echo getUri()[1]=='Supervisar' || getUri()[1]=='selectSucursal' ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Sucursal/Supervisar">
                    <i class="fas fa-home mx-3"></i>
                    <span>Gestionar sucursal</span>
                </a>
            </li>
            <?php } ?>

            <?php 
            if ($_SESSION['rol'] < 3) { ?>
            <li <?php echo optionSelect("personal") ?  'class="option-select"':'' ?>>

                <a href="/<?php echo APP_NAME; ?>/Personal">
                    <i class="fas fa-users mx-3"></i>

                    <span>Personal</span>
                </a>
            </li>
            <?php } ?>

            <li <?php echo optionSelect("contrato") ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Contrato">
                    <i class="fa-solid fa-file-contract mx-3"></i>

                    <span>Cto. de cortina</span>
                </a>
            </li>

            <li <?php echo optionSelect("venta") ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Venta">
                    <i class="fa-solid fa-bag-shopping mx-3"></i>
                    <span>Venta</span>
                </a>
            </li>

            <li <?php echo optionSelect("cliente") ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Cliente">
                    <i class="fas fa-user-friends mx-3"></i>
                    <span>Clientes</span>
                </a>
            </li>

            <?php if ($_SESSION['rol'] < 2) { // ADMIN  ?>
            <li <?php echo optionSucursal() ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Sucursal">
                    <i class="fas fa-store mx-3"></i>
                    <span>Sucursales</span>
                </a>
            </li>
            <li <?php echo optionSelect("proveedor") ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Proveedor">
                    <i class="fas fa-boxes mx-3"></i>
                    <span>Proveedores</span>
                </a>
            </li>
            <?php } ?>

            <?php if ($_SESSION['rol'] < 3) { //Super y admin ?>

            <li <?php echo optionSelect("marca") ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Marca">
                    <i class="fas fa-bookmark mx-3"></i>
                    <span>Marca</span>
                </a>
            </li>

            <li <?php echo optionSelect("compra") ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Compra">
                    <i class="fas fa-bookmark mx-3"></i>
                    <span>Pedido</span>
                </a>
            </li>
            <li <?php echo optionSelect("tela") ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Tela">
                    <i class="fas fa-bookmark mx-3"></i>
                    <span>Telas (stock)</span>
                </a>

            </li>
            <li <?php echo optionSelect("Productos") ?  'class="option-select"':'' ?>>
                <a href="/<?php echo APP_NAME; ?>/Productos">
                    <i class="fas fa-bookmark mx-3"></i>
                    <span>Productos</span>
                </a>
            </li>
            <?php } ?>

        </ul>
    </nav>
    <div>

        <div class="linea"></div>
        <div class="modo-oscuro">
            <div class="info">
                <i class="fas fa-moon mx-3"></i>
                <span>Modo oscuro</span>
            </div>
            <div class="switch">
                <div class="base">
                    <div class="circulo"></div>
                </div>
            </div>
        </div>

        <div class="usuario">
            <img src="img/user.png" alt="">
            <div class="info-usuario">
                <div class="name-email">
                    <span class="nombre">
                        <?php echo $_SESSION['nombre'] ?>
                    </span>
                    <span class="email">
                        <?php echo $_SESSION["cargo"] ?>
                    </span>
                </div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#miperfil">
                    <i class="fas fa-ellipsis-v info-user"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="content">