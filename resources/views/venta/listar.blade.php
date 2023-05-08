@section('title', 'Gestión de Ventas')
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
                        <h1>Gestión de Ventas</h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión de ventas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        {{-- <!-- Modal borrar laboratorio -->
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
        <div class="modal fade" id="confirmPre" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card card-success">
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
        </div> --}}

        {{-- <!-- Modal para crear un laboratorio -->
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

        <!-- Modal para modificar un laboratorio -->
        <div class="modal fade" id="modificarLab" tabindex="-1" role="dialog"
            aria-labelledby="crearlaboratorio-label" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">
                                Modificar laboratorio
                            </h3>
                            <button data-dismiss="modal" aria-label="close" class="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="formeditlaboratorio" class="g-3 needs-validation" method="POST"
                                action="{{ route('editLab', '') }}">
                                @csrf
                                <h1>Modificar laboratorio</h1>
                                <br>
                                <div class="">
                                    <label for="validationCustom01" class="form-label">Laboratorio</label>
                                    <input type="text" name="nombre" class="form-control" id="newnombre"
                                        value="{{ old('nombre') }}" placeholder="Introduzca un laboratorio">
                                </div>
                                <br>
                                <div class="col-12">
                                    <button id="btnSubmitEdit" class="btn btn-warning" type="submit">Modificar
                                        laboratorio</button>
                                </div>
                            </form>

                            <script>
                                $(document).ready(function() {
                                    $("#formeditlaboratorio").submit(function(event) {
                                        // Prevenir la acción predeterminada del formulario
                                        event.preventDefault();
                                        // Validar el campo de laboratorio
                                        if ($("#newnombre").val() == "") {
                                            $("#newnombre").addClass("is-invalid");
                                            $("#newnombre").parent().find(".invalid-feedback")
                                                .remove(); // eliminar cualquier div existente
                                            $("#newnombre").parent().append(
                                                "<div class='invalid-feedback'>Por favor, introduce un laboratorio.</div>");
                                        } else {
                                            $("#newnombre").removeClass("is-invalid");
                                            $("#newnombre").addClass("is-valid");
                                        }
                                        // Enviar el formulario si todos los campos son válidos
                                        if ($(".is-invalid").length == 0) {
                                            $("#formeditlaboratorio").unbind("submit").submit();
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

        <!-- Modal para modificar un tipo -->
        <div class="modal fade" id="modificarTipo" tabindex="-1" role="dialog"
            aria-labelledby="crearlaboratorio-label" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">
                                Modificar tipo
                            </h3>
                            <button data-dismiss="modal" aria-label="close" class="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="formedittipo" class="g-3 needs-validation" method="POST"
                                action="{{ route('editTipo', '') }}">
                                @csrf
                                <h1>Modificar tipo</h1>
                                <br>
                                <div class="">
                                    <label for="validationCustom01" class="form-label">Laboratorio</label>
                                    <input type="text" name="nombre" class="form-control" id="newnombreTipo"
                                        value="{{ old('nombre') }}" placeholder="Introduzca un laboratorio">
                                </div>
                                <br>
                                <div class="col-12">
                                    <button id="btnSubmitEditTipo" class="btn btn-warning" type="submit">Modificar
                                        Tipo</button>
                                </div>
                            </form>

                            <script>
                                $(document).ready(function() {
                                    $("#formedittipo").submit(function(event) {
                                        // Prevenir la acción predeterminada del formulario
                                        event.preventDefault();
                                        // Validar el campo de laboratorio
                                        if ($("#newnombreTipo").val() == "") {
                                            $("#newnombreTipo").addClass("is-invalid");
                                            $("#newnombreTipo").parent().find(".invalid-feedback")
                                                .remove(); // eliminar cualquier div existente
                                            $("#newnombreTipo").parent().append(
                                                "<div class='invalid-feedback'>Por favor, introduce un tipo.</div>");
                                        } else {
                                            $("#newnombreTipo").removeClass("is-invalid");
                                            $("#newnombreTipo").addClass("is-valid");
                                        }
                                        // Enviar el formulario si todos los campos son válidos
                                        if ($(".is-invalid").length == 0) {
                                            $("#formedittipo").unbind("submit").submit();
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
                                Crear presentación
                            </h3>

                            <button data-dismiss="modal" aria-label="close" class="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="formpresentacion" class="g-3 needs-validation" method="POST"
                                action="{{ route('createPresentacion') }}">
                                @csrf
                                <h1>Crear presentación</h1>
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

        <!-- Modal para modificar una presentacion -->
        <div class="modal fade" id="modificarPre" tabindex="-1" role="dialog"
            aria-labelledby="crearlaboratorio-label" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">
                                Modificar Presentación
                            </h3>
                            <button data-dismiss="modal" aria-label="close" class="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="formeditPre" class="g-3 needs-validation" method="POST"
                                action="{{ route('editPre', '') }}">
                                @csrf
                                <h1>Modificar presentación</h1>
                                <br>
                                <div class="">
                                    <label for="validationCustom01" class="form-label">Laboratorio</label>
                                    <input type="text" name="nombre" class="form-control" id="newnombrePre"
                                        value="{{ old('nombre') }}" placeholder="Introduzca un laboratorio">
                                </div>
                                <br>
                                <div class="col-12">
                                    <button id="btnSubmitEditPre" class="btn btn-warning" type="submit">Modificar
                                        presentación</button>
                                </div>
                            </form>

                            <script>
                                $(document).ready(function() {
                                    $("#formedittipo").submit(function(event) {
                                        // Prevenir la acción predeterminada del formulario
                                        event.preventDefault();
                                        // Validar el campo de laboratorio
                                        if ($("#newnombreTipo").val() == "") {
                                            $("#newnombreTipo").addClass("is-invalid");
                                            $("#newnombreTipo").parent().find(".invalid-feedback")
                                                .remove(); // eliminar cualquier div existente
                                            $("#newnombreTipo").parent().append(
                                                "<div class='invalid-feedback'>Por favor, introduce un tipo.</div>");
                                        } else {
                                            $("#newnombreTipo").removeClass("is-invalid");
                                            $("#newnombreTipo").addClass("is-valid");
                                        }
                                        // Enviar el formulario si todos los campos son válidos
                                        if ($(".is-invalid").length == 0) {
                                            $("#formedittipo").unbind("submit").submit();
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Modal de confirmación de eliminación -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas borrar esta venta?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form id="deleteForm" action="{{ route('borrarVenta', '') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
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
                                <h4>Historial de Ventas</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th style="border-spacing:10px">Productos</th>
                                                <th>Total</th>
                                                <th>Cliente</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // $ventas = json_decode($ventas, true);
                                            // print_r($ventas);
                                            ?>
                                            @foreach ($ventas as $venta)
                                                <?php
                                                $productos = json_decode($venta['productos'], true);
                                                ?>
                                                <tr>
                                                    <td>{{ $venta['id'] }}</td>
                                                    <td>
                                                        <button class="btn btn-success"
                                                            style="padding-left: 100px;padding-right: 100px" type="button"
                                                            data-toggle="collapse"
                                                            data-target="#productos-{{ $venta['id'] }}"
                                                            aria-expanded="false"
                                                            aria-controls="productos-{{ $venta['id'] }}">
                                                            {{ count($productos) }} productos
                                                        </button>
                                                        <div class="collapse" id="productos-{{ $venta['id'] }}">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Producto</th>
                                                                        <th>Cantidad</th>
                                                                        {{-- <th>Unidad</th> --}}
                                                                        <th>Precio</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($productos as $producto)
                                                                        <tr>
                                                                            <td>{{ $producto[0][0] }}</td>
                                                                            <td>{{ $producto[3][0] }}</td>
                                                                            {{-- <td>{{ $producto[2][0] }}</td> --}}
                                                                            <td>{{ $producto[4][0] }}€</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                    <td>{{ $venta['total'] }}</td>
                                                    <td>{{ $venta['cliente'] }}</td>
                                                    <td>{{ (new DateTime($venta['fecha']))->format('d/m/Y H:i:s') }}</td>
                                                    <td>
                                                        <a href="{{ route('generatePDF', ['venta' => $venta['id']]) }}"
                                                            class="btn btn-secondary">
                                                            <i class="bi bi-printer"></i>
                                                        </a>
                                                        <a class="btn btn-success" href=""><i
                                                                class="bi bi-envelope-at"></i></a>
                                                        <a class="btn btn-warning" href=""><i
                                                                class="bi bi-pencil-square"></i></a>
                                                        <a class="btn btn-danger" href="" data-toggle="modal"
                                                            data-target="#confirmDeleteModal" data-id="{{ $venta['id'] }}"
                                                            onclick="actualizarBorrar(this)"><i class="bi bi-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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

    <script>
        function actualizarBorrar(botonEliminar) {
            // Obtener el valor del data-id del botón eliminar
            const idVenta = botonEliminar.getAttribute("data-id");

            // Obtener el elemento form por su id
            const formularioEliminar = document.getElementById("deleteForm");

            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formularioEliminar.action = "{{ route('borrarVenta', '') }}/" + idVenta;

        }
    </script>

    {{-- Carrito --}}
    <script>
        $(document).on('click', '.borrar', function(event) {
            event.preventDefault();
            event.stopPropagation(); // Evitar cierre del menú desplegable
            // Obtener el índice del elemento que se debe eliminar
            const index = $(this).closest('tr').data('index');

            // Eliminar el elemento del array
            carrito.splice(index, 1);

            // Eliminar el elemento del DOM
            $(this).closest('tr').remove();

            // Guardar el carrito actualizado en localStorage
            localStorage.setItem('carrito', JSON.stringify(carrito));
            console.log(carrito);
            $('#contador').empty()
            $('#contador').append(carrito.length)
            return false; // Evitar cualquier acción adicional
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
        //añadir
        // Declarar variable global para el carrito
        let carrito = [];
        $(document).ready(function() {
            // Cargar el carrito desde el almacenamiento local
            if (localStorage.getItem("carrito")) {
                carrito = JSON.parse(localStorage.getItem("carrito"));

                $('#contador').empty()
                $('#contador').append(carrito.length)

                for (let i = 0; i < carrito.length; i++) {
                    const producto = carrito[i];
                    console.log(producto);
                    const index = i;
                    $('#cestaProductos').append("<tr data-index='" + index + "'><td>" + producto.nombre +
                        "</td><td>" + producto.concentracion + "</td><td>" +
                        producto.adicional + "</td><td>" + producto.nombre_pre + "</td><td>" + producto
                        .precio +
                        "€</td><td><button type='button' class='btn btn-danger borrar'><i class='bi bi-x-lg'></i></button></td></tr>"
                    );
                }
            }
        });
    </script>



@endsection
