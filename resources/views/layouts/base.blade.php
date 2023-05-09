<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('templates/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/dist/css/adminlte.min.css') }}">
</head>
@yield('header')

<style>
    .dropdown-item:hover {
        color: rgb(255, 255, 255);
        background-color: rgb(78, 78, 78);
    }

    body {
        padding-top: 56px;
        /* altura del navbar */
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
                <li class="nav-item d-none d-sm-inline-block">

                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <div class="image mr-4" data-toggle="dropdown">
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
                                <div class="row ml-4">
                                    <button class="btn btn-danger" style="width: 47%" id="vaciarCarrito">
                                        <img class="mr-2 mb-1" width="32px"
                                            src="{{ asset('img/vaciarCarrito.png') }}"> Vaciar
                                        carrito</button>
                                    <a href="{{ route('tramitarCompra') }}" class="btn btn-primary ml-2"
                                        style="width: 47%" id="tramitarCompra">
                                        <img class="mr-2 mb-1" width="32px"
                                            src="{{ asset('img/tramitarCompra.png') }}"> Tramitar
                                        compra</a>
                                </div>
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
                            <a href="{{ route('ventaProductos') }}" class="nav-link">
                                <i class="bi bi-bag"></i>
                                <p class="">
                                    Venta de productos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gestionVentas') }}" class="nav-link">
                                <i class="bi bi-currency-dollar"></i>
                                <p class="">
                                    Gestión de ventas
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
                        <li class="nav-header">USUARIO</li>
                        <li class="nav-item">
                            <a href="{{ route('gestionUsuario') }}" class="nav-link">
                                <i class="bi bi-person-lines-fill"></i>
                                <p class="ml-1">
                                    Gestión de usuarios
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        @yield('menu')
        {{-- <footer class="main-footer">
            <strong>Copyright &copy; 2023 <p>Rafael Hinestrosa</p></strong>
        </footer> --}}
    </div>
    {{-- <script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('templates/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('templates/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
