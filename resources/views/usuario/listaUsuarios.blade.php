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

    <!-- Modal para cambiar la contraseña -->
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
                        <form id="form" class="g-3 needs-validation" method="POST"
                            action="{{ route('formRegister') }}">
                            @csrf
                            <h1>Crear usuario</h1>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre"
                                    value="{{ old('nombre') }}" placeholder="Introduzca su nombre">
                                {!! $errors->first('nombre', '<span style=color:red>:message</span>') !!}
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom02" class="form-label">Apellidos</label>
                                <input type="text" name="apellidos" class="form-control" id="apellidos"
                                    value="{{ old('apellidos') }}" placeholder="Introduzca sus apellidos">
                                {!! $errors->first('apellidos', '<span style=color:red>:message</span>') !!}
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom02" class="form-label">Edad</label>
                                <input type="text" name="edad" class="form-control" id="edad"
                                    value="{{ old('edad') }}" placeholder="Introduzca su edad">
                                {!! $errors->first('edad', '<span style=color:red>:message</span>') !!}
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">DNI</label>
                                <input type="text" name="dni" class="form-control" id="dni"
                                    value="{{ old('dni') }}" placeholder="Introduzca su DNI">
                                {!! $errors->first('dni', '<span style=color:red>:message</span>') !!}
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
                                {!! $errors->first('email', '<span style=color:red>:message</span>') !!}
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    value="{{ old('password') }}" placeholder="Introduzca su clave">
                                {!! $errors->first('password', '<span style=color:red>:message</span>') !!}
                            </div>
                            <br>
                            <div>
                                <label for="validationCustom01" class="form-label">Tipo</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                {!! $errors->first('tipo', '<span style=color:red>:message</span>') !!}
                            </div>
                            <br>
                            <div class="col-12">
                                <button id="btnSubmit" class="btn btn-success" type="submit">Crear usuario</button>
                            </div>
                        </form>
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
                            <li class="breadcrumb-item"><a href="{{ route('listaProductos') }}">Home</a></li>
                            <li class="breadcrumb-item active">Gestión de usuarios</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="cotainer-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Buscar usuario</h3>
                        <div class="input-group">
                            <input type="text" id="buscar" placeholder="Introduzca nombre de usuario"
                                class="form-control float-left">
                            <div class="input-group-append"><button class="btn btn-default"><i
                                        class="bi bi-search"></i></button></div>
                        </div>
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

    <script>
        $(document).ready(function() {
            $('#btnSubmit').click(function(e) {
                e.preventDefault();

                // Deshabilita el botón de envío mientras se procesa la petición AJAX
                $(this).prop('disabled', true);

                // Realiza la petición AJAX al servidor
                $.ajax({
                    type: 'POST',
                    url: '{{ route('formRegister') }}',
                    data: $('#form').serialize(),
                    success: function(data) {
                        // La petición fue exitosa
                        $('#modal').modal('hide'); // Cierra el modal
                        // Agrega aquí el código para mostrar un mensaje de éxito, actualizar la página, etc.
                    },
                    error: function(data) {
                        // La petición falló
                        // Agrega aquí el código para mostrar un mensaje de error, habilitar el botón de envío, etc.
                    },
                    complete: function() {
                        // Habilita el botón de envío después de que se complete la petición AJAX, independientemente del resultado
                        $('#btnSubmit').prop('disabled', false);
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('js/buscador.js') }}"></script>

@endsection
