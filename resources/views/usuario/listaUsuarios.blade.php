@section('title', 'Gestión de usuarios')
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

    <!-- Modal para crear un usuario -->
    <div class="modal fade" id="crearUsuario" tabindex="-1" role="dialog" aria-labelledby="crearUsuario-label"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Crear usuario
                        </h3>

                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form id="form" class="g-3 needs-validation" method="POST" action="{{ route('createUser') }}">
                            @csrf
                            <h1>Crear usuario</h1>
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre"
                                    value="{{ old('nombre') }}" placeholder="Introduzca su nombre">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom02" class="form-label">Apellidos</label>
                                <input type="text" name="apellidos" class="form-control" id="apellidos"
                                    value="{{ old('apellidos') }}" placeholder="Introduzca sus apellidos">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom02" class="form-label">Fecha de nacimiento</label>
                                <input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento"
                                    value="{{ old('fecha_nacimiento') }}" placeholder="Introduzca su fecha de nacimiento">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">DNI</label>
                                <input type="text" name="dni" class="form-control" id="dni"
                                    value="{{ old('dni') }}" placeholder="Introduzca su DNI">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustomUsername" class="form-label">Correo electrónico</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" name="email" class="form-control" id="email"
                                        value="{{ old('email') }}" placeholder="Correo electrónico"
                                        aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    value="{{ old('password') }}" placeholder="Introduzca su clave">
                            </div>
                            <br>
                            <div>
                                <label for="validationCustom01" class="form-label">Tipo</label>
                                <select class="form-control" name="tipo">
                                    <option value="2" {{ old('tipo') == 'farmaceutico' ? 'selected' : '' }}>
                                        Farmacéutico</option>
                                    <option value="3" {{ old('tipo') == 'tecnico' ? 'selected' : '' }}>Técnico
                                    </option>
                                    <option value="4" {{ old('tipo') == 'auxiliar' ? 'selected' : '' }}>Auxiliar
                                    </option>
                                    <option value="1" {{ old('tipo') == 'administrador' ? 'selected' : '' }}>
                                        Administrador</option>
                                </select>
                            </div>
                            <br>
                            <div class="col-12">
                                <button id="btnSubmit" class="btn btn-success" type="submit">Crear usuario</button>
                            </div>
                        </form>

                        <script>
                            $(document).ready(function() {
                                $("#form").submit(function(event) {
                                    // Prevenir la acción predeterminada del formulario
                                    event.preventDefault();
                                    // Validar el campo de nombre
                                    if ($("#nombre").val() == "") {
                                        $("#nombre").addClass("is-invalid");
                                        $("#nombre").parent().find(".invalid-feedback")
                                            .remove(); // eliminar cualquier div existente
                                        $("#nombre").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tu nombre.</div>");
                                    } else {
                                        $("#nombre").removeClass("is-invalid");
                                        $("#nombre").addClass("is-valid");
                                    }

                                    // Validar el campo de apellidos
                                    if ($("#apellidos").val() == "") {
                                        $("#apellidos").addClass("is-invalid");
                                        $("#apellidos").parent().find(".invalid-feedback")
                                            .remove(); // eliminar cualquier div existente
                                        $("#apellidos").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tus apellidos.</div>");
                                    } else {
                                        $("#apellidos").removeClass("is-invalid");
                                        $("#apellidos").addClass("is-valid");
                                    }


                                    // Validar el campo de fecha de nacimiento
                                    if ($("#fecha_nacimiento").val() == "") {
                                        $("#fecha_nacimiento").addClass("is-invalid");
                                        $("#fecha_nacimiento").parent().find(".invalid-feedback")
                                            .remove(); // eliminar cualquier div existente
                                        $("#fecha_nacimiento").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tu fecha de nacimiento.</div>"
                                        );
                                    } else {
                                        $("#fecha_nacimiento").removeClass("is-invalid");
                                        $("#fecha_nacimiento").addClass("is-valid");
                                    }

                                    // Validar el campo de DNI
                                    if ($("#dni").val() == "") {
                                        $("#dni").addClass("is-invalid");
                                        $("#dni").parent().find(".invalid-feedback").remove();
                                        $("#dni").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tu DNI.</div>");
                                        } else if (!validarDNI($("#dni").val())) {
                                        $("#dni").addClass("is-invalid");
                                        $("#dni").parent().find(".invalid-feedback").remove();
                                        $("#dni").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce un dni válido.</div>"
                                        );
                                    } else {
                                        $("#dni").removeClass("is-invalid");
                                        $("#dni").addClass("is-valid");
                                    }

                                    // Validar el campo de correo electrónico
                                    if ($("#email").val() == "") {
                                        $("#email").addClass("is-invalid");
                                        $("#email").parent().find(".invalid-feedback").remove();
                                        $("#email").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tu correo electrónico.</div>"
                                        );
                                    } else if (!isValidEmail($("#email").val())) {
                                        $("#email").addClass("is-invalid");
                                        $("#email").parent().find(".invalid-feedback").remove();
                                        $("#email").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce un correo electrónico válido.</div>"
                                        );
                                    } else {
                                        $("#email").removeClass("is-invalid");
                                        $("#email").addClass("is-valid");
                                    }

                                    // Validar el campo de contraseña
                                    if ($("#password").val() == "") {
                                        $("#password").addClass("is-invalid");
                                        $("#password").parent().find(".invalid-feedback").remove();

                                        $("#password").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tu contraseña.</div>");
                                    } else {
                                        $("#password").removeClass("is-invalid");
                                        $("#password").addClass("is-valid");
                                    }

                                    // Validar el campo de tipo
                                    if ($("#tipo").val() == "") {
                                        $("#tipo").addClass("is-invalid");
                                        $("#tipo").parent().find(".invalid-feedback").remove();

                                        $("#tipo").parent().append(
                                            "<div class='invalid-feedback'>Por favor, selecciona un tipo.</div>");
                                    } else {
                                        $("#tipo").removeClass("is-invalid");
                                        $("#tipo").addClass("is-valid");
                                    }

                                    // Enviar el formulario si todos los campos son válidos
                                    if ($(".is-invalid").length == 0) {
                                        $("#form").unbind("submit").submit();
                                    }
                                });
                            });

                            function isValidEmail(email) {
                                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                return regex.test(email);
                            }

                            function validarDNI(dni) {
                                const letras = "TRWAGMYFPDXBNJZSQVHLCKE";
                                const regex = /^(\d{8})([A-Z])$/i;

                                if (regex.test(dni)) {
                                    const dniNum = parseInt(dni.substring(0, 8));
                                    const letra = dni.substring(8).toUpperCase();
                                    const letraCorrecta = letras.charAt(dniNum % 23);

                                    return letra === letraCorrecta;
                                }

                                return false;
                            }
                        </script>



                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mr-6">
                    <div class="col-sm-6">
                        <h1>Gestión de usuarios</h1>
                        <button type="button" data-toggle="modal" data-target="#crearUsuario"
                            class="btn bg-gradient-primary" style="margin-top: 20px">Crear Usuario</button>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('listaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión de usuarios</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="cotainer-fluid">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Buscar usuario</h3>
                        <div class="input-group">
                            <input type="text" id="buscar" placeholder="Introduzca nombre de usuario"
                                class="form-control float-left">
                            <div class="input-group-append"><button class="btn btn-default"><i
                                        class="bi bi-search"></i></button></div>
                        </div>
                    </div>
                    <br>
                    @if (session()->has('message'))
                        <div class="alert alert-success text-center">
                            {{ session()->get('message') }}
                    @endif
                </div>
                <div class="card-body">
                    <div id="usuarios" class="row d-flex align-items-stretch">

                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
    </div>
    </section>
    </div>

    <script src="{{ asset('js/buscador.js') }}"></script>

@endsection
