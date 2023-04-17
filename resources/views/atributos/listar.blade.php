@section('title', 'Gestión de Atributos')
@extends('layouts.base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestión de Atributos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión de atributos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Modal borrar laboratorio -->
        <div class="modal fade" id="confirmLab" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmLabLabel">Confirmar eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar este laboratorio?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form id="deleteFormLab" action="{{ route('borrarLab', '') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal borrar tipo -->
        <div class="modal fade" id="confirmTipo" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmTipoLabel">Confirmar eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar este tipo?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form id="deleteFormTipo" action="{{ route('borrarTipo', '') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal borrar tipo -->
        <div class="modal fade" id="confirmPre" tabindex="-1" role="dialog"
            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmPresentacionLabel">Confirmar eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar esta presentación?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form id="deleteFormPre" action="{{ route('borrarPre', '') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para crear un laboratorio -->
        <div class="modal fade" id="crearlaboratorio" tabindex="-1" role="dialog"
            aria-labelledby="crearlaboratorio-label" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                Crear laboratorio
                            </h3>
                            <button data-dismiss="modal" aria-label="close" class="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="formlaboratorio" class="g-3 needs-validation" method="POST"
                                action="{{ route('createLab') }}">
                                @csrf
                                <h1>Crear laboratorio</h1>
                                <br>
                                <div class="">
                                    <label for="validationCustom01" class="form-label">Laboratorio</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre"
                                        value="{{ old('nombre') }}" placeholder="Introduzca un laboratorio">
                                </div>
                                <br>
                                <div class="col-12">
                                    <button id="btnSubmit" class="btn btn-success" type="submit">Crear
                                        laboratorio</button>
                                </div>
                            </form>

                            <script>
                                $(document).ready(function() {
                                    $("#formlaboratorio").submit(function(event) {
                                        // Prevenir la acción predeterminada del formulario
                                        event.preventDefault();
                                        // Validar el campo de laboratorio
                                        if ($("#nombre").val() == "") {
                                            $("#nombre").addClass("is-invalid");
                                            $("#nombre").parent().find(".invalid-feedback")
                                                .remove(); // eliminar cualquier div existente
                                            $("#nombre").parent().append(
                                                "<div class='invalid-feedback'>Por favor, introduce un laboratorio.</div>");
                                        } else {
                                            $("#nombre").removeClass("is-invalid");
                                            $("#nombre").addClass("is-valid");
                                        }
                                        // Enviar el formulario si todos los campos son válidos
                                        if ($(".is-invalid").length == 0) {
                                            $("#formlaboratorio").unbind("submit").submit();
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para crear un tipo -->
        <div class="modal fade" id="creartipo" tabindex="-1" role="dialog" aria-labelledby="creartipo-label"
            data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                Crear tipo
                            </h3>

                            <button data-dismiss="modal" aria-label="close" class="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="formtipo" class="g-3 needs-validation" method="POST"
                                action="{{ route('createTipo') }}">
                                @csrf
                                <h1>Crear tipo</h1>
                                <br>
                                <div class="">
                                    <label for="validationCustom01" class="form-label">Tipo</label>
                                    <input type="text" name="nombre" class="form-control"
                                        value="{{ old('nombre') }}" id="tipo" placeholder="Introduzca un tipo">
                                </div>
                                <br>
                                <div class="col-12">
                                    <button id="btnSubmittipo" class="btn btn-success" type="submit">Crear tipo</button>
                                </div>
                            </form>

                            <script>
                                $(document).ready(function() {
                                    $("#formtipo").submit(function(event) {
                                        // Prevenir la acción predeterminada del formulario
                                        event.preventDefault();
                                        // Validar el campo de tipo
                                        if ($("#tipo").val() == "") {
                                            $("#tipo").addClass("is-invalid");
                                            $("#tipo").parent().find(".invalid-feedback")
                                                .remove(); // eliminar cualquier div existente
                                            $("#tipo").parent().append(
                                                "<div class='invalid-feedback'>Por favor, introduce un tipo.</div>");
                                        } else {
                                            $("#tipo").removeClass("is-invalid");
                                            $("#tipo").addClass("is-valid");
                                        }
                                        // Enviar el formulario si todos los campos son válidos
                                        if ($(".is-invalid").length == 0) {
                                            $("#formtipo").unbind("submit").submit();
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para crear una presentacion -->
        <div class="modal fade" id="crearpresentacion" tabindex="-1" role="dialog"
            aria-labelledby="crearpresentacion-label" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                Crear presentacion
                            </h3>

                            <button data-dismiss="modal" aria-label="close" class="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="formpresentacion" class="g-3 needs-validation" method="POST"
                                action="{{ route('createPresentacion') }}">
                                @csrf
                                <h1>Crear presentacion</h1>
                                <br>
                                <div class="">
                                    <label for="validationCustom01" class="form-label">Presentacion</label>
                                    <input type="text" name="nombre" class="form-control" id="presentacion"
                                        value="{{ old('nombre') }}" placeholder="Introduzca una presentacion">
                                </div>
                                <br>
                                <div class="col-12">
                                    <button id="btnSubmitpresentacion" class="btn btn-success" type="submit">Crear
                                        presentacion</button>
                                </div>
                            </form>

                            <script>
                                $(document).ready(function() {
                                    $("#formpresentacion").submit(function(event) {
                                        // Prevenir la acción predeterminada del formulario
                                        event.preventDefault();
                                        // Validar el campo de presentacion
                                        if ($("#presentacion").val() == "") {
                                            $("#presentacion").addClass("is-invalid");
                                            $("#presentacion").parent().find(".invalid-feedback")
                                                .remove(); // eliminar cualquier div existente
                                            $("#presentacion").parent().append(
                                                "<div class='invalid-feedback'>Por favor, introduce una presentacion.</div>");
                                        } else {
                                            $("#presentacion").removeClass("is-invalid");
                                            $("#presentacion").addClass("is-valid");
                                        }
                                        // Enviar el formulario si todos los campos son válidos
                                        if ($(".is-invalid").length == 0) {
                                            $("#formpresentacion").unbind("submit").submit();
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a href="#laboratoriotab"
                                            class="nav-link {{ session()->has('messageLab') ? 'active' : '' }}"
                                            data-toggle="tab">Laboratorio</a></li>
                                    <li class="nav-item"><a href="#tipotab"
                                            class="nav-link {{ session()->has('messageTipo') ? 'active' : '' }}"
                                            data-toggle="tab">Tipo</a>
                                    </li>
                                    <li class="nav-item"><a href="#presentaciontab"
                                            class="nav-link {{ session()->has('messagePre') ? 'active' : '' }}"
                                            data-toggle="tab">Presentación</a></li>
                                </ul>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    // Obtener el mensaje de sesión correspondiente
                                    var messageLab = "{{ session()->get('messageLab') }}";
                                    var messageTipo = "{{ session()->get('messageTipo') }}";
                                    var messagePresentacion = "{{ session()->get('messagePre') }}";

                                    // Agregar la clase "active" al enlace de pestaña correspondiente
                                    if (messageLab) {
                                        $('a[href="#laboratoriotab"]').addClass('active');
                                    } else if (messageTipo) {
                                        $('a[href="#tipotab"]').addClass('active');
                                    } else if (messagePresentacion) {
                                        $('a[href="#presentaciontab"]').addClass('active');
                                    }
                                });
                            </script>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="laboratoriotab">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <div class="card-title">Buscar laboratorio <button type="button"
                                                        data-toggle="modal" data-target="#crearlaboratorio"
                                                        class="btn bg-gradient-primary btn-sm m-2">Crear
                                                        laboratorio</button></div>
                                                <div class="input-group">
                                                    <input type="text" id="buscar-laboratorio"
                                                        class="form-control float-left" placeholder="Ingrese nombre">
                                                    <div class="input-group-append"><button class="btn btn-default"><i
                                                                class="bi bi-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @if (session()->has('messageLab'))
                                                    <div class="alert alert-success text-center">
                                                        {{ session()->get('messageLab') }}
                                                    </div>
                                                @endif

                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="tabla-laboratorio">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th scope="col">Laboratorio</th>
                                                                <th scope="col">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($laboratorios as $laboratorio)
                                                                <tr class="laboratorio">
                                                                    <td>{{ $laboratorio->nombre }}</td>
                                                                    <td><a class="btn btn-danger" data-toggle="modal"
                                                                            data-target="#confirmLab"
                                                                            data-id="{{ $laboratorio->id }}"
                                                                            onclick="pasarIdLab(this)"><i
                                                                                class="bi bi-trash"></i></a> <a
                                                                            class="btn btn-warning" href="#"><i
                                                                                class="bi bi-pencil-square"></i></a></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="card-footer"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tipotab">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <div class="card-title">Buscar tipo <button type="button"
                                                        data-toggle="modal" data-target="#creartipo"
                                                        class="btn bg-gradient-primary btn-sm m-2">Crear tipo</button>
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" id="buscar-tipo"
                                                        class="form-control float-left" placeholder="Ingrese nombre">
                                                    <div class="input-group-append"><button class="btn btn-default"><i
                                                                class="bi bi-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @if (session()->has('messageTipo'))
                                                    <div class="alert alert-success text-center">
                                                        {{ session()->get('messageTipo') }}
                                                    </div>
                                                @endif

                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="tabla-tipo">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th scope="col">Tipo</th>
                                                                <th scope="col">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($tipos as $tipo)
                                                                <tr class="tipo">
                                                                    <td>{{ $tipo->nombre }}</td>
                                                                    <td><a class="btn btn-danger" data-toggle="modal"
                                                                            data-target="#confirmTipo"
                                                                            data-id="{{ $tipo->id }}"
                                                                            onclick="pasarIdTipo(this)"><i
                                                                                class="bi bi-trash"></i></a> <a
                                                                            class="btn btn-warning" href="#"><i
                                                                                class="bi bi-pencil-square"></i></a></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="card-footer"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="presentaciontab">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <div class="card-title">Buscar presentación <button type="button"
                                                        data-toggle="modal" data-target="#crearpresentacion"
                                                        class="btn bg-gradient-primary btn-sm m-2">Crear
                                                        presentacion</button></div>
                                                <div class="input-group">
                                                    <input type="text" id="buscar-presentacion"
                                                        class="form-control float-left" placeholder="Ingrese nombre">
                                                    <div class="input-group-append"><button class="btn btn-default"><i
                                                                class="bi bi-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @if (session()->has('messagePre'))
                                                    <div class="alert alert-success text-center">
                                                        {{ session()->get('messagePre') }}
                                                    </div>
                                                @endif

                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="tabla-presentacion">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th scope="col">Presentación</th>
                                                                <th scope="col">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($presentaciones as $presentacion)
                                                                <tr class="presentacion">
                                                                    <td>{{ $presentacion->nombre }}</td>
                                                                    <td><a class="btn btn-danger" data-toggle="modal"
                                                                            data-target="#confirmPre"
                                                                            data-id="{{ $presentacion->id }}"
                                                                            onclick="pasarIdPre(this)"><i
                                                                                class="bi bi-trash"></i></a> <a
                                                                            class="btn btn-warning" href="#"><i
                                                                                class="bi bi-pencil-square"></i></a></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="card-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script>
        function pasarIdLab(botonEliminar) {
            // Obtener el valor del data-id del botón eliminar
            const idLab = botonEliminar.getAttribute("data-id");

            // Obtener el elemento form por su id
            const formularioEliminar = document.getElementById("deleteFormLab");

            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formularioEliminar.action = "{{ route('borrarLab', '') }}/" + idLab;
        }

        function pasarIdTipo(botonEliminar) {
            // Obtener el valor del data-id del botón eliminar
            const idTipo = botonEliminar.getAttribute("data-id");

            // Obtener el elemento form por su id
            const formularioEliminar = document.getElementById("deleteFormTipo");

            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formularioEliminar.action = "{{ route('borrarTipo', '') }}/" + idTipo;
        }

        function pasarIdPre(botonEliminar) {
            // Obtener el valor del data-id del botón eliminar
            const idPre = botonEliminar.getAttribute("data-id");

            // Obtener el elemento form por su id
            const formularioEliminar = document.getElementById("deleteFormPre");

            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formularioEliminar.action = "{{ route('borrarPre', '') }}/" + idPre;
        }

        $(document).ready(function() {
            $('#buscar-laboratorio').keyup(function() {
                var texto = $(this).val().toLowerCase();
                $('table tbody tr.laboratorio').filter(function() {
                    return $(this).text().toLowerCase().indexOf(texto) < 0;
                }).hide();
                $('table tbody tr.laboratorio').filter(function() {
                    return $(this).text().toLowerCase().indexOf(texto) >= 0;
                }).show();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#buscar-tipo').keyup(function() {
                var texto = $(this).val().toLowerCase();
                $('table tbody tr.tipo').filter(function() {
                    return $(this).text().toLowerCase().indexOf(texto) < 0;
                }).hide();
                $('table tbody tr.tipo').filter(function() {
                    return $(this).text().toLowerCase().indexOf(texto) >= 0;
                }).show();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#buscar-presentacion').keyup(function() {
                var texto = $(this).val().toLowerCase();
                $('table tbody tr.presentacion').filter(function() {
                    return $(this).text().toLowerCase().indexOf(texto) < 0;
                }).hide();
                $('table tbody tr.presentacion').filter(function() {
                    return $(this).text().toLowerCase().indexOf(texto) >= 0;
                }).show();
            });
        });
    </script>

@endsection
