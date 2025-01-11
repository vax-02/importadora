
<!-- jQuery desde CDN -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- JS de DataTables desde CDN -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- JS de DataTables desde CDN para Bootstrap (opcional) -->
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>


<!--JS DEL MENU barra-lateral-->
<script src = "/<?php echo APP_NAME ?>/public/js/naveg.js" >


<script src="/<?php echo APP_NAME ?>/public/bootstrap/js/ bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>


<script>
    $('.eliminar').click(function (event) {

        event.preventDefault();

        var url = $(this).attr('href');
        Swal.fire({
            title: '¿Decea eliminar?',
            text: "La elimacion no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    })

    let filteredData;
    $(document).ready(function () {
        var table = $('#table').DataTable({
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ Elementos",
                info: "Mostrando _START_ a _END_ de _TOTAL_ Elementos totales",
                infoEmpty: "Elementos de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",

                infoEmpty: 'No hay resultados',
                infoFiltered: '(buscados de _MAX_ elementos)',

                zeroRecords: 'Sin resultados',
                paginate: {
                    first: "Premier",
                    previous: "Actual",
                    next: "Siguiente",
                    last: "Dernier"
                }
            },
            "pageLength": 10, // Establece el número mínimo de filas por página
            "lengthMenu": [5, 10, 25, 50, 100],
            scrollCollapse: true,
            scrollY: '30vh',
            scrollX: true
        });
        table.on('draw.dt', function () {
            filteredData = table.rows({
                search: 'applied'
            }).data().toArray();
            //console.log(filteredData);

        });
    });

    //Para tablas pqueñas
    $(document).ready(function () {
        var table = $('#table2').DataTable({
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ Elementos",
                info: "Mostrando _START_ a _END_ de _TOTAL_ Elementos totales",
                infoEmpty: "Elementos de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",

                infoEmpty: 'No hay resultados',
                infoFiltered: '(buscados de _MAX_ elementos)',

                zeroRecords: 'Sin resultados',
                paginate: {
                    first: "Premier",
                    previous: "Actual",
                    next: "Siguiente",
                    last: "Dernier"
                }
            },
            "pageLength": 15, // Establece el número mínimo de filas por página
            "lengthMenu": [5, 10, 25, 50, 100],
            scrollCollapse: true,
            scrollY: '45vh'
        });
        table.on('draw.dt', function () {
            filteredData = table.rows({
                search: 'applied'
            }).data().toArray();
            //console.log(filteredData);

        });
    });


    $(document).ready(function () {
        var table = $('#table3').DataTable({
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ Elementos",
                info: "Mostrando _START_ a _END_ de _TOTAL_ Elementos totales",
                infoEmpty: "Elementos de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",

                infoEmpty: 'No hay resultados',
                infoFiltered: '(buscados de _MAX_ elementos)',

                zeroRecords: 'Sin resultados',
                paginate: {
                    first: "Premier",
                    previous: "Actual",
                    next: "Siguiente",
                    last: "Dernier"
                }
            },
            "pageLength": 5, // Establece el número mínimo de filas por página
            "lengthMenu": [5, 10, 25, 50, 100],
            scrollCollapse: true,
            scrollY: '45vh'
        });
        table.on('draw.dt', function () {
            filteredData = table.rows({
                search: 'applied'
            }).data().toArray();
            //console.log(filteredData);

        });
    });

    $(document).ready(function () {
        var table_list_telas = $('#table4').DataTable({
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ Elementos",
                info: "Mostrando _START_ a _END_ de _TOTAL_ Elementos totales",
                infoEmpty: "Elementos de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",

                infoEmpty: 'No hay resultados',
                infoFiltered: '(buscados de _MAX_ elementos)',

                zeroRecords: 'Sin resultados',
                paginate: {
                    first: "Premier",
                    previous: "Actual",
                    next: "Siguiente",
                    last: "Dernier"
                }
            },
            "pageLength": 5, // Establece el número mínimo de filas por página
            "lengthMenu": [5, 10, 25, 50, 100],
            scrollCollapse: true,
            scrollY: '45vh'
        });
        table.on('draw.dt', function () {
            filteredData = table.rows({
                search: 'applied'
            }).data().toArray();
            //console.log(filteredData);

        });
    });
    ///Para los reportes
    $('#reporte').click(function (event) {
        event.preventDefault(); //prevenir
        // Encuentra el input utilizando un selector que coincida con su posición en el DOM
        var inputElement = document.querySelector('.container input');
        // Obtiene el valor del input
        var valor = inputElement.value;

        // Obtén una referencia al formulario
        var formElement = document.querySelector('form');

        // Obtén una referencia al elemento input
        var inputElement = document.getElementById('pivo');
        if (valor.length > 0) {
            // Asigna un valor al input
            inputElement.value = valor;
            if (filteredData[0] === undefined) {
                Swal.fire({
                    title: 'REPORTES',
                    text: "No hay coincidencias, ¿Desea realizar un reporte general?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, por favor',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var inputElement = document.getElementById('pivo');
                        inputElement.value = 0;
                        var formElement = document.querySelector('form');
                        formElement.submit();
                    }
                })
            } else {
                formElement.submit();

            }

        } else {
            Swal.fire({
                title: 'REPORTES',
                text: "No hay coincidencias o no realizo una busqueda, ¿Desea realizar un reporte general?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, por favor',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var inputElement = document.getElementById('pivo');
                    inputElement.value = '0';
                    var formElement = document.querySelector('form');
                    formElement.submit();
                }
            })
        }
    })

</script>

</body>

</html>
