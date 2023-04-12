@section('title', 'Datos personales')
@extends('layouts.base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
    #cuerpo {
        margin: 1em;
    }

    #paginacion {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #cuerpo {
        margin: 2em;
    }

    table {
        text-align: center;
    }
</style>

@section('menu')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mr-6">
                    <div class="col-sm-6">
                        <h1>Datos personales</h1>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Datos personales</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md3 ml-3">
                            <div class="card card-success card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img src=@if ($user->sexo == 'hombre') {{ asset('img/avatarUser.png') }}
                                            @elseif ($user->sexo == 'mujer')
                                            {{ asset('img/avatarUserMujer.png') }} @endif
                                            alt="" class="profile-user-img img-fluid img-circle">
                                    </div>
                                    <h3 class="profile-username text-center text-success">{{ Auth::user()->nombre }}
                                    </h3>
                                    <p class="text-muted text-center">{{ Auth::user()->apellidos }}</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Edad</b>
                                            <span class="float-right" style="color:rgb(26, 57, 255)">
                                                <?php
                                                $fecha_nacimiento = new DateTime($user->fecha_nacimiento);
                                                $hoy = new DateTime();
                                                $edad = $hoy->diff($fecha_nacimiento)->y;
                                                echo $edad . ' años';
                                                ?>
                                            </span>
                                        </li>

                                        <li class="list-group-item">
                                            <b style="color:#0B7300">DNI</b><span class="float-right"
                                                style="color:rgb(26, 57, 255)">{{ $user->dni }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Tipo</b><span
                                                class="float-right badge badge-primary mt-1">
                                                @if ($user->tipo == 1)
                                                    Administrador
                                                @elseif ($user->tipo == 2)
                                                    Farmaceutico
                                                @elseif ($user->tipo == 3)
                                                    Técnico
                                                @elseif ($user->tipo == 4)
                                                    Auxiliar
                                                @endif
                                            </span>
                                        </li>
                                    </ul>
                                    <!-- Botón que abre el modal -->
                                    <button class="btn btn-warning" data-toggle="modal"
                                        data-target="#cambiar-contraseña-modal">Cambiar contraseña</button>

                                    <!-- Modal para cambiar la contraseña -->
                                    <div class="modal fade" id="cambiar-contraseña-modal" tabindex="-1" role="dialog"
                                        aria-labelledby="cambiar-contraseña-modal-label">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="text-center" style="margin-top: 10px">
                                                    <img src=@if ($user->sexo == 'hombre') {{ asset('img/avatarUser.png') }}
                                                        @elseif ($user->sexo == 'mujer')
                                                        {{ asset('img/avatarUserMujer.png') }} @endif
                                                        alt="" class="profile-user-img img-fluid img-circle">
                                                    <h3 class="profile-username text-center">{{ Auth::user()->nombre }}
                                                </div>
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cambiar-contraseña-modal-label">Cambiar
                                                        contraseña</h5>

                                                </div>
                                                <form id="cambiar-contraseña-form"
                                                    action="{{ route('updatePassword', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nueva-contraseña">Nueva contraseña</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control"
                                                                    id="nueva-contraseña" name="password">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary" type="button"
                                                                        id="toggle-password">
                                                                        <i class="fa fa-eye-slash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            {!! $errors->first('password', '<span style=color:red>:message</span>') !!}
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="confirmar-contraseña">Confirmar contraseña</label>
                                                            <div class="input-group">
                                                            <input type="password" class="form-control"
                                                                id="confirmar-contraseña" name="passwordConfirm">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary" type="button"
                                                                        id="toggle-password-confirm">
                                                                        <i class="fa fa-eye-slash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {!! $errors->first('passwordConfirm', '<span style=color:red>:message</span>') !!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            id="btn-guardar-cambios" disabled>Guardar cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card card-success">
                                <div class="car-header">
                                    <h3 class="card title text-center">Sobre mi</h3>
                                </div>
                                <div class="card-body mb-10">
                                    <strong style="color:#0B7300">
                                        <i class="bi bi-telephone-fill mr-1"></i>Teléfono
                                    </strong>
                                    <p class="text-muted">{{ $user->telefono == '' ? 'Sin definir' : $user->telefono }}
                                    </p>
                                    <strong style="color:#0B7300">
                                        <i class="bi bi-geo-alt-fill"></i> Dirección
                                    </strong>
                                    <p class="text-muted">{{ $user->direccion == '' ? 'Sin definir' : $user->direccion }}
                                    </p>
                                    <strong style="color:#0B7300">
                                        <i class="fas fa-at mr-1"></i>Correo electrónico
                                    </strong>
                                    <p class="text-muted">{{ $user->email }}</p>
                                    <strong style="color:#0B7300">
                                        <i class="bi bi-gender-ambiguous"></i> Sexo
                                    </strong>
                                    <p class="text-muted">{{ $user->sexo }}</p>
                                    <button class="btn btn-block bg-gradient-danger" id="editarBtn">Editar</button>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Editar datos personales</h3>
                                </div>

                                <div class="card-body">
                                    <div class="card-body">
                                        @if (session()->has('message'))
                                            <div class="text-center alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <form action="{{ route('datosPersonalesUpdate', $user->id) }}" method="POST"
                                            class="row g-3 needs-validation">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Nombre</label>
                                                <input type="text" name="nombre" class="form-control" id="nombre"
                                                    placeholder="Nombre" value="{{ old('nombre') }}">
                                                {!! $errors->first('nombre', '<span style=color:red>:message</span>') !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Apellidos</label>
                                                <input type="text" name="apellidos" class="form-control"
                                                    id="apellidos" placeholder="Apellidos"
                                                    value="{{ old('apellidos') }}">
                                                {!! $errors->first('apellidos', '<span style=color:red>:message</span>') !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Teléfono</label>
                                                <input type="text" name="telefono" class="form-control"
                                                    id="telefono" placeholder="Teléfono" value="{{ old('telefono') }}">
                                                {!! $errors->first('telefono', '<span style=color:red>:message</span>') !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Dirección</label>
                                                <input type="text" name="direccion" class="form-control"
                                                    id="direccion" placeholder="Direccion"
                                                    value="{{ old('direccion') }}">
                                                {!! $errors->first('direccion', '<span style=color:red>:message</span>') !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustomUsername" class="form-label">Correo
                                                    electrónico</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    <input type="text" name="email" class="form-control"
                                                        id="email" placeholder="Correo"
                                                        aria-describedby="inputGroupPrepend" value="{{ old('email') }}">
                                                </div>
                                                {!! $errors->first('email', '<span style=color:red>:message</span>') !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom04" class="form-label">Sexo</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sexo"
                                                        id="hombre" value="hombre"
                                                        {{ old('sexo') == 'hombre' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Hombre
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sexo"
                                                        id="mujer" value="mujer"
                                                        {{ old('sexo') == 'mujer' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Mujer
                                                    </label>
                                                </div>
                                                {!! $errors->first('sexo', '<span style=color:red>:message</span>') !!}
                                            </div>
                                            <div class="col-12 mt-4">
                                                <button class="btn btn-success" type="submit">Enviar Formulario</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    {{-- Pasar datos al formulario cuando pulsa editar --}}
    <script>
        var nombre = "{{ $user->nombre }}";
        var apellidos = "{{ $user->apellidos }}";
        var telefono = "{{ $user->telefono }}";
        var direccion = "{{ $user->direccion }}";
        var email = "{{ $user->email }}";
        var sexo = "{{ $user->sexo }}";

        // Agregar listener al botón de "Editar"
        $('#editarBtn').click(function() {
            // Establecer los valores de los inputs y radio buttons
            $('#nombre').val(nombre);
            $('#apellidos').val(apellidos);
            $('#telefono').val(telefono);
            $('#direccion').val(direccion);
            $('#email').val(email);
            if (sexo == 'hombre') {
                $('#hombre').prop('checked', true);
            } else if (sexo == 'mujer') {
                $('#mujer').prop('checked', true);
            }
        });
    </script>

    {{-- Activar boton hasta que sean iguales --}}
    <script>
        // Obtener los campos de contraseña
        const nuevaContraseña = document.getElementById('nueva-contraseña');
        const confirmarContraseña = document.getElementById('confirmar-contraseña');
        // Obtener el botón de "Guardar cambios"
        const btnGuardarCambios = document.getElementById('btn-guardar-cambios');
        // Agregar un evento para comprobar si las contraseñas coinciden
        nuevaContraseña.addEventListener('input', comprobarContraseñas);
        confirmarContraseña.addEventListener('input', comprobarContraseñas);

        function comprobarContraseñas() {
            // Comprobar si ambas contraseñas coinciden y no están vacías
            if (nuevaContraseña.value === confirmarContraseña.value && nuevaContraseña.value !== '' && confirmarContraseña
                .value !== '') {
                // Habilitar el botón de "Guardar cambios"
                btnGuardarCambios.disabled = false;
            } else {
                // Deshabilitar el botón de "Guardar cambios"
                btnGuardarCambios.disabled = true;
            }
        }
    </script>

    {{-- ver o ocultar contraseña --}}
    <script>
        $(document).ready(function() {
            $('#toggle-password').click(function() {
                var passwordInput = $('#nueva-contraseña');
                var passwordIcon = $('#toggle-password i');
                if (passwordInput.attr('type') == 'password') {
                    passwordInput.attr('type', 'text');
                    passwordIcon.removeClass('fa-eye-slash');
                    passwordIcon.addClass('fa-eye');
                } else {
                    passwordInput.attr('type', 'password');
                    passwordIcon.removeClass('fa-eye');
                    passwordIcon.addClass('fa-eye-slash');
                }
            });
            $('#toggle-password-confirm').click(function() {
                var passwordInput = $('#confirmar-contraseña');
                var passwordIcon = $('#toggle-password-confirm i');
                if (passwordInput.attr('type') == 'password') {
                    passwordInput.attr('type', 'text');
                    passwordIcon.removeClass('fa-eye-slash');
                    passwordIcon.addClass('fa-eye');
                } else {
                    passwordInput.attr('type', 'password');
                    passwordIcon.removeClass('fa-eye');
                    passwordIcon.addClass('fa-eye-slash');
                }
            });
        });
    </script>

@endsection
