<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <title>@yield('title')</title>
</head>
<style>
    .dropdown-item {
        transition: background-color 0.5s ease;
        cursor: pointer;
    }

    .dropdown-item:hover {
        background-color: #5c6976;
        cursor: pointer;
    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-black" style="background-color: #8BC34A;">
            <div class="container-fluid">
                <h2 style="margin-top: 10px"><a class="navbar-brand text-geen">FARMACIA</a></h2>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav text-black">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-black text-black" href="#" id="listarDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Añadir
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="addDropdown">
                                {{-- @if (Auth::check() && Auth::user()->es_admin === 1) --}}
                                <a
                                    class="dropdown-item text-white {{ request()->routeIs('formTarea') ? 'active' : '' }} text-dark">Tarea</a>

                                <a
                                    class="dropdown-item text-white {{ request()->routeIs('formRegCliente') ? 'active' : '' }}">Cliente</a>
                                <a
                                    class="dropdown-item text-white {{ request()->routeIs('formRegEmpleado') ? 'active' : '' }}">Empleado</a>
                                <a
                                    class="dropdown-item text-white {{ request()->routeIs('formMantenimiento') ? 'active' : '' }}">Remesa
                                    Mensual</a>
                                <a
                                    class="dropdown-item text-white {{ request()->routeIs('formCuotaExcep') ? 'active' : '' }}">Cuota
                                    Excepcional</a>
                                {{-- @endif --}}
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-black {{ request()->routeIs('listaTareas') ? 'active' : '' }} text-black"
                                href="#" id="listarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Listar
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="listDropdown">

                                <a
                                    class="dropdown-item text-white {{ request()->routeIs('listaTareas') ? 'active' : '' }} text-dark">Tareas</a>
                                {{-- @if (Auth::check() && Auth::user()->es_admin === 1) --}}
                                <a
                                    class="dropdown-item text-white {{ request()->routeIs('listaClientes') ? 'active' : '' }} text-dark">Clientes</a>
                                <a
                                    class="dropdown-item text-white {{ request()->routeIs('listaEmpleados') ? 'active' : '' }} text-dark">Empleados</a>
                                <a
                                    class="dropdown-item text-white {{ request()->routeIs('listaCuotas') ? 'active' : '' }} text-dark">Cuotas</a>
                                {{-- @endif --}}
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
            <div>
                @if (Auth::check())
                    <p style="color:white;margin-left:-30%">
                        <b>Nombre:</b>
                        {{-- <a href="{{ route('formMiCuenta', Auth::user()->id) }}"
                            style="text-decoration: none; color: inherit;"> --}}
                        {{ Auth::user()->apellidos }}, {{ Auth::user()->nombre }}
                        {{-- </a> --}}
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <img src="{{ asset('img/log_out.png') }}" width="40px">
                        </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                    </p>
                    <p style="color:white;margin-left:-30%">
                        <b>Rol:</b> {{ Auth::user()->tipo != 1 ? 'Operario 👷‍♂️' : 'Administrador 👨‍💻' }}
                        | <b>Fecha:</b> {{ session('hora_login') ?? (session('administrador') ?? '') }}
                    </p>
                @endif
            </div>
        </nav>

        @yield('menu')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
