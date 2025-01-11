<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo (isset($title)) ? $title : 'TELA'; ?>
    </title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- googlo charts desde CDN -->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/grafica.css">
    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/buttons.css">

    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/login.css">
    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/tela.css">
    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/style.css">
    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/login.css">
    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/forms.css">
    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/listado.css">
    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/detail.css">
    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/form-part.css">
    <link rel="stylesheet" href="/<?php echo APP_NAME ?>/public/css/scroll.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!--Data tables-->

    <!-- CSS de DataTables desde CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- CSS de DataTables desde CDN para Bootstrap (opcional) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">


    <link rel="shortcut icon" href="/<?php echo APP_NAME ?>/public/img/ico/ico.ico" type="image/x-icon">

    <script>
        // Aplicar el tema antes de cargar el contenido de la página
        (function () {
            let savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark-mode');
            } else {
                document.documentElement.classList.remove('dark-mode');
            }
        })();

    </script>

</head>

<body>
    <?php
    error_reporting(0);
    session_start();
    if (isset($_SESSION['msg'])) {
        if (isset($_SESSION['icon'])) {
            ?>
    <script>
        Swal.fire(
            '<?php echo $_SESSION['title'] ?>',
            '<?php echo $_SESSION['msg'] ?>.',
            '<?php echo $_SESSION['icon'] ?>'
        )

    </script>
    <?php
        } else {
            ?>
    <script>
        Swal.fire(
            '<?php echo $_SESSION['title'] ?>',
            '<?php echo $_SESSION['msg'] ?>.',
            'success'
        )

    </script>
    <?php
        }
        unset($_SESSION['msg']);
        unset($_SESSION['title']);
        unset($_SESSION['icon']);
    }

    ?>
