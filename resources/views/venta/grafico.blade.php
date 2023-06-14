<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gráficos</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ asset('templates/plugins/fontawesome-free/css/all.min.css') }}>
    <!-- fullCalendar -->
    <link rel="stylesheet" href={{ asset('templates/plugins/fullcalendar/main.css') }}>

    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('templates/dist/css/adminlte.min.css') }}>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
    <style>
        .dropdown-item:hover {
            color: rgb(255, 255, 255);
            background-color: rgb(78, 78, 78);
        }

        body {
            padding-top: 56px;
            /* altura del navbar */
        }

        .analog-clock {
            position: relative;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1px solid #000;
            overflow: hidden;
        }

        .hour-hand,
        .minute-hand,
        .second-hand {
            position: absolute;
            top: 50%;
            left: 50%;
            background-color: #000;
            transform-origin: bottom center;
        }

        .hour-hand {
            width: 1.2px;
            height: 9px;
            margin-left: -0.5px;
            border-radius: 2px;
            z-index: 3;
            transform: translateX(-50%);
        }

        .minute-hand {
            width: 1.2px;
            height: 13px;
            margin-left: -0.5px;
            border-radius: 2px;
            z-index: 2;
            transform: translateX(-50%);
        }

        .second-hand {
            width: 1.1px;
            height: 16px;
            margin-left: -0.5px;
            border-radius: 2px;
            z-index: 1;
            transform: translateX(-50%);
        }

        .center-dot {
            position: absolute;
            top: 50%;
            left: 49%;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background-color: #000;
            transform: translate(-50%, -50%);
        }

        .nav-link.dentro {
            background-color: #bebebe;
            /* Establece el fondo gris clarito */
        }

        .table-container {
            max-height: 350px;
            /* Ajusta la altura máxima deseada */
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #b8b8b8 #f0f0f0;
        }

        /* Estilos del scroll en navegadores basados en WebKit, como Chrome y Safari */
        .table-container::-webkit-scrollbar {
            width: 6px;
            /* Ajusta el ancho del scroll */
        }

        .table-container::-webkit-scrollbar-track {
            background-color: #fafafa;
            /* Color de fondo del track del scroll */
        }

        .table-container::-webkit-scrollbar-thumb {
            background-color: #bebebe;
            /* Color del thumb del scroll */
        }

        .MgNoProduc {
            text-align: center;
            font-size: 16px;
            color: #121212;
        }
    </style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
            <!-- Top navbar links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('ventaProductos') }}" class="nav-link">Inicio</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('ventaProductos') }}" class="nav-link">Atención al cliente</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-inline-block mr-3" style="margin-top: 12px">
                    <div class="analog-clock d-inline-block">
                        <div class="hour-hand" id="hour-hand"></div>
                        <div class="minute-hand" id="minute-hand"></div>
                        <div class="second-hand" id="second-hand"></div>
                        <div class="center-dot"></div>
                    </div>
                </li>
                <li class="nav-item d-none d-inline-block mr-4 mt-3">
                    <div class="d-inline-block" id="reloj"></div>
                </li>

                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <div class="image mt-2 mr-4" data-toggle="dropdown">
                            <img src="{{ asset('img/carrito.png') }}" class="img" alt="{{ Auth::user()->nombre }}"
                                width="40px">
                            <span id="contador"
                                class="position-absolute top-0 start-55 translate-middle badge rounded-pill bg-danger">
                                0
                            </span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <h4 class="text-center">Carrito de la compra</h4>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-container">
                                <div class="table-container">
                                    <table id="cestaProductos" class="table text-center">
                                        <tr>
                                            <th>Producto</th>
                                            <th>Nombre</th>
                                            <th>Concentración</th>
                                            <th>Adicional</th>
                                            <th>Presentación</th>
                                            <th>Precio</th>
                                            <th>Eliminar</th>
                                        </tr>
                                        <!-- Filas de productos -->
                                    </table>
                                </div>
                                <div class="row ml-4 mt-2">
                                    <button class="btn btn-danger" style="width: 47%" id="vaciarCarrito">
                                        <img class="mr-2 mb-1" width="32px"
                                            src="{{ asset('img/vaciarCarrito.png') }}"> Vaciar carrito</button>
                                    <a href="{{ route('tramitarCompra') }}" class="btn btn-primary ml-2"
                                        style="width: 47%" id="tramitarCompra">
                                        <img class="mr-2 mb-1" width="32px"
                                            src="{{ asset('img/tramitarCompra.png') }}"> Tramitar compra</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <div class="image mt-1 mr-4" data-toggle="dropdown">
                            <img src="@if (Auth::user()->sexo == 'hombre') {{ asset('img/avatares/avatarUser.png') }}
                            @elseif (Auth::user()->sexo == 'mujer')
                            {{ asset('img/avatares/avatarUserMujer.png') }} @endif"
                                class="img-circle elevation-2" alt="{{ Auth::user()->nombre }}" width="40px">
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <span class="dropdown-header">{{ Auth::user()->nombre }}
                                {{ Auth::user()->apellidos }}</span>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('datosPersonales', Auth::user()->id) }}" class="dropdown-item">Mi
                                Perfil</a>
                            <a href="{{ route('configuracion') }}" class="dropdown-item">Configuración</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="dropdown-item">Cerrar Sesión</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>

        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('ventaProductos') }}" class="brand-link">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">Farmalize</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <a href="{{ route('datosPersonales', Auth::user()->id) }}">
                        <div class="image">
                            <img src=@if (Auth::user()->sexo == 'hombre') {{ asset('img/avatares/avatarUser.png') }}
                                 @elseif (Auth::user()->sexo == 'mujer')
                                 {{ asset('img/avatares/avatarUserMujer.png') }} @endif
                                class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="{{ route('datosPersonales', Auth::user()->id) }}"
                                class="d-block">{{ Auth::user()->apellidos }},
                                {{ Auth::user()->nombre }}</a>
                            <span>
                                @if (Auth::user()->tipo == 1)
                                    <span style="color:rgb(66, 153, 30)">Administrador</span>
                                @elseif (Auth::user()->tipo == 2)
                                    <span style="color:rgb(66, 153, 30)">Farmacéutico</span>
                                @elseif (Auth::user()->tipo == 3)
                                    <span style="color:rgb(66, 153, 30)">Técnico</span>
                                @else
                                    <span style="color:rgb(66, 153, 30)">Auxiliar</span>
                                @endif
                            </span>
                        </div>
                    </a>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Buscar"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-header">VENTA</li>
                        <li class="nav-item">
                            <a href="{{ route('ventaProductos') }}"
                                class="nav-link{{ request()->is('ventaProductos') ? ' dentro' : '' }}">
                                <i class="bi bi-bag"></i>
                                <p>Venta de productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gestionVentas') }}"
                                class="nav-link{{ request()->is('gestionVentas') ? ' dentro' : '' }}">
                                <i class="bi bi-currency-dollar"></i>
                                <p>Gestión de ventas</p>
                            </a>
                        </li>
                        <li class="nav-header">AGENDA</li>
                        <li class="nav-item">
                            <a href="{{ route('calendario') }}"
                                class="nav-link{{ request()->is('calendario') ? ' dentro' : '' }}">
                                <i class="bi bi-calendar-event"></i>
                                <p>Calendario</p>
                            </a>
                        </li>
                        <li class="nav-header">ALMACEN</li>
                        <li class="nav-item">
                            <a href="{{ route('listaProductos') }}"
                                class="nav-link{{ request()->is('listaProductos') ? ' dentro' : '' }}">
                                <i class="bi bi-boxes"></i>
                                <p>Gestión de productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listaLotes') }}"
                                class="nav-link{{ request()->is('listaLotes') ? ' dentro' : '' }}">
                                <i class="bi bi-archive-fill"></i>
                                <p>Gestión de lotes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listaProveedores') }}"
                                class="nav-link{{ request()->is('listaProveedores') ? ' dentro' : '' }}">
                                <i class="bi bi-people-fill"></i>
                                <p>Gestión de proveedores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gestionAtributos') }}"
                                class="nav-link{{ request()->is('gestionAtributos') ? ' dentro' : '' }}">
                                <i class="bi bi-inboxes"></i>
                                <p>Gestión de atributos</p>
                            </a>
                        </li>
                        <li class="nav-header">USUARIO</li>
                        <li class="nav-item">
                            <a href="{{ route('gestionUsuario') }}"
                                class="nav-link{{ request()->is('gestionUsuario') ? ' dentro' : '' }}">
                                <i class="bi bi-person-lines-fill"></i>
                                <p>Gestión de usuarios</p>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Gráfico de Ventas</h1>
                        </div>
                        <div class="col-sm-5">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('ventaProductos') }}">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('gestionVentas') }}">Gestión de
                                        ventas</a></li>
                                <li class="breadcrumb-item active">Graficos</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- AREA CHART -->
                            <div class="card card-primary" id="ventaMensual" style="display: none">
                                <div class="card-header">
                                    <h3 class="card-title">Ventas mensuales</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="areaChart"
                                            style="
                                                    min-height: 250px;
                                                    height: 250px;
                                                    max-height: 250px;
                                                    max-width: 100%;
                                                    ">
                                        </canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- DONUT CHART -->
                            <div class="card card-danger" id="ventaUsuario" style="display: none">
                                <div class="card-header">
                                    <h3 class="card-title">Ventas de usuarios</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="donutChart"
                                        style="
                        min-height: 250px;
                        height: 250px;
                        max-height: 250px;
                        max-width: 100%;
                      "></canvas>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.col (LEFT) -->
                        <div class="col-md-12">


                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Add Content Here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src={{ asset('templates/plugins/jquery/jquery.min.js') }}></script>
    <!-- Bootstrap -->
    <script src={{ asset('templates/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- jQuery UI -->
    <script src={{ asset('templates/plugins/jquery-ui/jquery-ui.min.js') }}></script>
    <!-- AdminLTE App -->
    <script src={{ asset('templates/dist/js/adminlte.min.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-animate"></script>

    <!-- AdminLTE for demo purposes -->
    {{-- <script src={{ asset('templates/dist/js/demo.js') }}></script> --}}
    <!-- Page specific script -->
    <script>
        $(document).ready(function() {
            $('#ventaMensual').slideToggle('slow');
            $('#ventaUsuario').slideToggle('slow');
        })
        $(function() {

            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Grafico de ventas
            let datos = []
            $.ajax({
                url: 'getDataGrafico.php',
                method: 'POST',
                dataType: 'json',
                data: {},
                success: function(respuesta) {
                    // console.log(respuesta);
                    for (let i = 0; i < respuesta.length; i++) {
                        datos.push(respuesta[i].Ventas)
                    }
                    // Get context with jQuery - using jQuery's .get() method.
                    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
                    // console.log(areaChartCanvas);

                    var areaChartData = {
                        labels: [
                            "Enero",
                            "Febrero",
                            "Marzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre",
                        ],
                        datasets: [{
                            label: "Ventas",
                            backgroundColor: "rgba(60,141,188,0.9)",
                            borderColor: "rgba(60,141,188,0.8)",
                            pointColor: "#3b8bba",
                            pointStrokeColor: "rgba(60,141,188,1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(60,141,188,1)",
                            data: datos,
                        }, ],
                    };

                    var areaChartOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        legend: {
                            display: false,
                        },
                        animation: {
                            duration: 2100, // Duración de la animación en milisegundos
                            delay: 2100, // Retraso de inicio de la animación en milisegundos
                        },
                    };


                    // This will get the first returned node in the jQuery collection.
                    new Chart(areaChartCanvas, {
                        type: "line",
                        data: areaChartData,
                        options: areaChartOptions,
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus +
                        " - " + errorThrown);
                }
            });

            // Grafico de venta por usuario
            let usuario = []
            let ventas = []

            $.ajax({
                url: 'getDataVentaUsuario.php',
                method: 'POST',
                dataType: 'json',
                data: {},
                success: function(respuesta) {
                    console.log(respuesta);

                    for (let i = 0; i < respuesta.length; i++) {
                        usuario.push(respuesta[i].Usuario)
                        ventas.push(respuesta[i].Ventas)
                    }

                    //-------------
                    //- DONUT CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var donutChartCanvas = $("#donutChart").get(0).getContext("2d");
                    var donutData = {
                        labels: usuario,
                        datasets: [{
                            data: ventas,
                            backgroundColor: [
                                "#f56954",
                                "#00a65a",
                                "#f39c12",
                                "#00c0ef",
                                "#3c8dbc",
                                "#d2d6de",
                            ],
                        }, ],
                    };
                    var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                    };
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    new Chart(donutChartCanvas, {
                        type: "doughnut",
                        data: donutData,
                        options: donutOptions,
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus +
                        " - " + errorThrown);
                }
            });
        });

        //vaciar carrito
        $('#vaciarCarrito').click(function() {
            event.stopPropagation(); // Evitar cierre del menú desplegable
            $('#cestaProductos tr:not(:first)').remove();
            carrito = [];
            localStorage.removeItem('carrito');
            $('#contador').empty()
            $('#contador').append(carrito.length)
        });

        //borrar individual
        $(document).on('click', '.borrar', function(event) {
            event.preventDefault();
            event.stopPropagation(); // Evitar cierre del menú desplegable
            // Obtener el id del producto que se debe eliminar
            const id = $(this).closest('tr').data('id');

            // Encontrar el índice del producto con ese id en el array
            const index = carrito.findIndex(item => item.id === id);

            // Eliminar el elemento del array
            carrito.splice(index, 1);

            // Eliminar el elemento del DOM
            $(this).closest('tr').remove();

            // Actualizar los índices de los elementos en la tabla
            $('#cestaProductos tr:not(:first)').each(function(index, elemento) {
                $(elemento).attr('data-index', index);
            });

            // Guardar el carrito actualizado en localStorage
            localStorage.setItem('carrito', JSON.stringify(carrito));
            console.log(carrito);
            $('#contador').empty()
            $('#contador').append(carrito.length)

            return false; // Evitar cualquier acción adicional
        });

        // Cargar el carrito desde el almacenamiento local
        if (localStorage.getItem("carrito")) {
            carrito = JSON.parse(localStorage.getItem("carrito"));

            $('#contador').empty();
            $('#contador').append(carrito.length);

            for (let i = 0; i < carrito.length; i++) {
                $('#cestaProductos').append("<tr data-id='" + carrito[i].id + "'><td><img src='" + carrito[i].imagen +
                    "' width='50px'></td><td>" + carrito[i]
                    .nombre +
                    "</td><td>" + carrito[i].concentracion + "</td><td>" +
                    carrito[i].adicional + "</td><td>" + carrito[i].nombre_pre + "</td><td>" +
                    carrito[i].precio +
                    "€</td><td><button type='button' class='btn btn-danger borrar'><i class='i bi-x-lg'></i></button></td></tr>"
                );
            }
        }

        // Función para eliminar un producto del carrito
        function removeProduct(id) {
            const index = carrito.findIndex(producto => producto.id === id);
            if (index !== -1) {
                carrito.splice(index, 1);
                localStorage.setItem('carrito', JSON.stringify(carrito));
                $('#contador').empty();
                $('#contador').append(carrito.length);
                $(`tr[data-id=${id}]`).remove();
            }
        }

        // Evento para eliminar un producto del carrito al hacer clic en el botón "Eliminar"
        $('#cestaProductos').on('click', '.borrar', function() {
            const id = $(this).closest('tr').data('id');
            removeProduct(id);
        });

        // Evento para vaciar el carrito al hacer clic en el botón "Vaciar cesta"
        $('#vaciarCesta').on('click', function() {
            carrito = [];
            localStorage.removeItem('carrito');
            $('#contador').empty();
            $('#contador').append(carrito.length);
            $('#cestaProductos').empty();
        });
    </script>
    {{-- Reloj --}}
    <script>
        $(document).ready(function() {
            setInterval(function() {
                var date = new Date();
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();
                if (hours < 10) {
                    hours = "0" + hours;
                }
                if (minutes < 10) {
                    minutes = "0" + minutes;
                }
                if (seconds < 10) {
                    seconds = "0" + seconds;
                }
                var time = hours + ":" + minutes + ":" + seconds;
                $('#reloj').html(time);
            });
        });
    </script>
    {{-- Relojes --}}
    <script>
        function updateClock() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();
            const seconds = now.getSeconds();

            const hourHand = document.getElementById("hour-hand");
            const minuteHand = document.getElementById("minute-hand");
            const secondHand = document.getElementById("second-hand");

            const hourAngle = (hours % 12) * 30 + (minutes / 60) * 30;
            const minuteAngle = (minutes / 60) * 360;
            const secondAngle = (seconds / 60) * 360;

            hourHand.style.transform = `translate(-50%, -100%) rotate(${hourAngle}deg)`;
            minuteHand.style.transform = `translate(-50%, -100%) rotate(${minuteAngle}deg)`;
            secondHand.style.transform = `translate(-50%, -100%) rotate(${secondAngle}deg)`;

            // Actualizar el reloj digital
            const relojDigital = document.getElementById("reloj");
            relojDigital.textContent = now.toLocaleTimeString();
        }

        // Actualizar el reloj cada segundo
        setInterval(updateClock, 1000);

        // Actualizar el reloj al cargar la página
        updateClock();
    </script>
</body>

</html>
