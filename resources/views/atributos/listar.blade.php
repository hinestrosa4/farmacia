@section('title', 'Listado de Productos')
@extends('layouts.base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

        <!-- Modal para crear un laboratorio -->
        <div class="modal fade" id="crearlaboratorio" tabindex="-1" role="dialog" aria-labelledby="crearlaboratorio-label"
            data-backdrop="static" data-keyboard="false">
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
                                    <button id="btnSubmit" class="btn btn-success" type="submit">Crear laboratorio</button>
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
                                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" id="tipo"
                                        placeholder="Introduzca un tipo">
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
                                    <li class="nav-item"><a href="#laboratoriotab" class="nav-link active"
                                            data-toggle="tab">Laboratorio</a></li>
                                    <li class="nav-item"><a href="#tipotab" class="nav-link" data-toggle="tab">Tipo</a>
                                    </li>
                                    <li class="nav-item"><a href="#presentaciontab" class="nav-link"
                                            data-toggle="tab">Presentación</a></li>
                                </ul>
                            </div>
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
                                                {{-- @if (session()->has('message'))
                                                    <div class="alert alert-success text-center">
                                                        {{ session()->get('message') }}
                                                @endif --}}
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
                                            <div class="card-body"></div>
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
                                            <div class="card-body"></div>
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
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
