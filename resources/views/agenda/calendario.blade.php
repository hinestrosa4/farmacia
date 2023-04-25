<title>Calendario</title>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href={{ asset('templates/plugins/fontawesome-free/css/all.min.css') }}>
<!-- fullCalendar -->
<link rel="stylesheet" href={{ asset('templates/plugins/fullcalendar/main.css') }}>

<!-- Theme style -->
<link rel="stylesheet" href={{ asset('templates/dist/css/adminlte.min.css') }}>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Top navbar links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('listaProductos') }}" class="nav-link">Inicio</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <div class="image mr-4" data-toggle="dropdown">
                            <img src="{{ asset('img/carrito.png') }}" class="img" alt="{{ Auth::user()->nombre }}"
                                width="40px">
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <h4 class="text-center">Carrito de la compra</h4>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-container">
                                <table id="cestaProductos" class="table">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Concentración</th>
                                        <th>Adicional</th>
                                        <th>Presentación</th>
                                        <th>Precio</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </table>
                                <button class="btn btn-danger" style="width: 100%" id="vaciarCarrito">Vaciar
                                    carrito</button>
                                <button class="btn btn-primary" style="width: 100%" id="tramitarCompra">Tramitar
                                    compra</button>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <div class="image mr-4" data-toggle="dropdown">
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
        <!-- /.navbar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('listaProductos') }}" class="brand-link">
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
                                    <span style="color:rgb(190, 255, 164)">Administrador</span>
                                @elseif (Auth::user()->tipo == 2)
                                    <span style="color:rgb(184, 243, 160)">Farmacéutico</span>
                                @elseif (Auth::user()->tipo == 3)
                                    <span style="color:rgb(158, 212, 137)">Ténico</span>
                                @else
                                    <span style="color:rgb(160, 214, 139)">Auxiliar</span>
                                @endif
                            </span>
                        </div>
                    </a>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
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
                        <li class="nav-header">USUARIO</li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('datosPersonales', Auth::user()->id) }}" class="nav-link">
                                <i class="bi bi-person-fill-gear"></i>
                                <p>
                                    Datos personales
                                </p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('gestionUsuario') }}" class="nav-link">
                                <i class="bi bi-person-lines-fill"></i>
                                <p class="ml-1">
                                    Gestión de usuarios
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">ALMACEN</li>
                        <li class="nav-item">
                            <a href="{{ route('listaProductos') }}" class="nav-link">
                                <i class="bi bi-boxes"></i>
                                <p class="ml-1">
                                    Gestión de productos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listaLotes') }}" class="nav-link">
                                <i class="bi bi-archive-fill"></i>
                                <p class="ml-1">
                                    Gestión de lotes
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listaProveedores') }}" class="nav-link">
                                <i class="bi bi-people-fill"></i>
                                <p class="ml-1">
                                    Gestión de proveedores
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gestionAtributos') }}" class="nav-link">
                                <i class="bi bi-inboxes"></i>
                                <p class="ml-1">
                                    Gestión de atributos
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">AGENDA</li>
                        <li class="nav-item">
                            <a href="{{ route('calendario') }}" class="nav-link">
                                <i class="bi bi-calendar-event"></i>
                                <p class="ml-1">
                                    Calendario
                                </p>
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
                            <h1>Calendario</h1>
                        </div>
                        <div class="col-sm-5">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('listaProductos') }}">Inicio</a></li>
                                <li class="breadcrumb-item active">Calendario</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="sticky-top mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Lista de eventos</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- the events -->
                                        <div id="external-events">
                                            <h5 id="pedidos">Pedidos</h5>
                                            <div class="external-event bg-success">Recepción de pedidos</div>
                                            <div class="external-event bg-success">Devolución de pedidos</div>
                                            <div id="new-pedidos"></div>
                                            <h5 id="articulos">Artículos</h5>
                                            <div class="external-event bg-warning">Consulta rápida de artículos</div>
                                            <div class="external-event bg-warning">Repaso de stock</div>
                                            <div class="external-event bg-warning">Control de caducidades</div>
                                            <div class="external-event bg-warning">Control de recetas</div>
                                            <div id="new-articulos"></div>
                                            <h5 id="medicamentos">Medicamentos personalizados</h5>
                                            <div class="external-event bg-primary">Sistema de dosificación
                                                personalizada (SPD)</div>
                                            <div class="external-event bg-primary">Formulas magistrales</div>
                                            <div id="new-medicamentos"></div>
                                            <h5 id="facturas">Facturas</h5>
                                            <div class="external-event bg-info">Revisión de facturas</div>
                                            <div id="new-facturas"></div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Añadir un evento</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                            <ul class="fc-color-picker" id="color-chooser">
                                                <li><a class="text-primary" href="#"><i
                                                            class="fas fa-square"></i></a></li>
                                                <li><a class="text-warning" href="#"><i
                                                            class="fas fa-square"></i></a></li>
                                                <li><a class="text-success" href="#"><i
                                                            class="fas fa-square"></i></a></li>
                                                <li><a class="text-info" href="#"><i
                                                            class="fas fa-square"></i></a></li>
                                            </ul>
                                        </div>
                                        <!-- /btn-group -->
                                        <div class="input-group">
                                            <input id="new-event" type="text" class="form-control"
                                                placeholder="Titulo del evento">

                                            <div class="input-group-append">
                                                <button id="add-new-event" type="button"
                                                    class="btn btn-primary">Añadir</button>
                                            </div>
                                            <!-- /btn-group -->
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card card-primary">
                                <div class="card-body p-0">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar"></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
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
    <!-- fullCalendar 2.2.5 -->
    <script src={{ asset('templates/plugins/moment/moment.min.js') }}></script>
    <script src={{ asset('templates/plugins/fullcalendar/main.js') }}></script>
    <script>
        $(function() {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function() {

                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0 //  original position after the drag
                    })

                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };
                }
            });

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                locale: 'es',
                firstDay: 1,
                timeZone: 'local',
                nowIndicator: true,
                views: {
                    dayGridMonth: {
                        buttonText: 'Mes'
                    },
                    timeGridWeek: {
                        buttonText: 'Semana'
                    },
                    timeGridDay: {
                        buttonText: 'Día'
                    },
                },
                themeSystem: 'bootstrap',
                //Random default events
                events: [{
                        title: 'Recepción de pedidos',
                        start: new Date(y, m, 6),
                        backgroundColor: 'rgb(40, 167, 69)',
                        borderColor: 'rgb(40, 167, 69)',
                        allDay: true
                    },
                    {
                        title: 'Devolución de pedidos',
                        start: new Date(y, m, 9),
                        backgroundColor: 'rgb(40, 167, 69)',
                        color: 'black',
                        borderColor: 'rgb(40, 167, 69)',
                        allDay: true
                    },
                    {
                        title: 'Consulta rápida de articulos',
                        start: new Date(y, m, 4),
                        backgroundColor: 'rgb(255, 193, 7)',
                        borderColor: 'rgb(255, 193, 7)',
                        color: '#3B3B3B',
                        allDay: true,
                        textColor: 'black'
                    },
                    {
                        title: 'Repaso de sotck',
                        start: new Date(y, m, 11),
                        backgroundColor: 'rgb(255, 193, 7)',
                        borderColor: 'rgb(255, 193, 7)',
                        color: '#3B3B3B',
                        allDay: true,
                        textColor: 'black'
                    },
                    {
                        title: 'Control de recetas',
                        start: new Date(y, m, 13),
                        backgroundColor: 'rgb(255, 193, 7)',
                        borderColor: 'rgb(255, 193, 7)',
                        allDay: true,
                        textColor: 'black'
                    },
                    {
                        title: 'Sistema de dosificiacion personalizada',
                        start: new Date(y, m, 3),
                        backgroundColor: 'rgb(0, 123, 255)',
                        borderColor: 'rgb(0, 123, 255)',
                        allDay: true
                    },
                    {
                        title: 'Sistema de dosificiacion personalizada',
                        start: new Date(y, m, 10),
                        backgroundColor: 'rgb(0, 123, 255)',
                        borderColor: 'rgb(0, 123, 255)',
                        allDay: true
                    },
                    {
                        title: 'Sistema de dosificiacion personalizada',
                        start: new Date(y, m, 17),
                        backgroundColor: 'rgb(0, 123, 255)',
                        borderColor: 'rgb(0, 123, 255)',
                        color: '#3B3B3B',
                        allDay: true
                    },
                    {
                        title: 'Revisión de facturas',
                        start: new Date(y, m, 14),
                        backgroundColor: 'rgb(23, 162, 184)',
                        borderColor: 'rgb(23, 162, 184)',
                        allDay: true
                    },
                    // {
                    //     title: 'Click for Google',
                    //     start: new Date(y, m, 28),
                    //     end: new Date(y, m, 29),
                    //     // url: 'https://www.google.com/',
                    //     backgroundColor: '#3c8dbc', //Primary (light-blue)
                    //     borderColor: '#3c8dbc' //Primary (light-blue)
                    // }
                ],
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(info) {

                }
            });
            calendar.render();

            /* ADDING EVENTS */
            var currColor = 'rgb(0, 123, 255)'
            // Color chooser button
            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault()
                // Save color
                currColor = $(this).css('color')

                // Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })
            $('#add-new-event').click(function(e) {
                e.preventDefault()
                // Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                // Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.text(val)
                //azul - medicamentos
                if (event[0].attributes[1].nodeValue ==
                    "background-color: rgb(0, 123, 255); border-color: rgb(0, 123, 255); color: rgb(255, 255, 255);"
                ) {
                    $('#new-medicamentos').prepend(event)
                }
                //amarillo - articulos
                else if (event[0].attributes[1].nodeValue ==
                    "background-color: rgb(255, 193, 7); border-color: rgb(255, 193, 7); color: rgb(255, 255, 255);"
                ) {
                    event.css({
                        'color': '#3B3B3B',
                    })
                    $('#new-articulos').prepend(event)
                }
                //verde - pedidos
                else if (event[0].attributes[1].nodeValue ==
                    "background-color: rgb(40, 167, 69); border-color: rgb(40, 167, 69); color: rgb(255, 255, 255);"
                ) {
                    $('#new-pedidos').prepend(event)
                }
                //info - facturas
                else if (event[0].attributes[1].nodeValue ==
                    "background-color: rgb(23, 162, 184); border-color: rgb(23, 162, 184); color: rgb(255, 255, 255);"
                ) {
                    $('#new-facturas').prepend(event)
                } else {
                    $('#new-medicamentos').prepend(event)
                }

                console.log(event[0].attributes[1].nodeValue);

                // Add draggable funtionality
                ini_events(event)

                // Remove event from text input
                $('#new-event').val('')
            })
        })
    </script>
    <style>
        .external-event {
            font-weight: normal;
        }

        h5 {
            font-weight: bold;
        }
    </style>
</body>
