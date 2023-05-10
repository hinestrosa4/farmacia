@section('title', 'Gestión de Ventas')
@extends('layouts.base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


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
                            <li class="breadcrumb-item"><a href="{{ route('ventaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión de ventas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Modal de confirmación de eliminación -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
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

        <!-- Modal de enviar correo -->
        <div class="modal fade" id="enviarCorreo" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" id="enviarCorreoL">Enviar recibo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="mb-4">Enviar a:</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        Comprador
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <form id="formEnviar" action="{{ route('enviarCorreo', '') }}"
                                                class="g-3 needs-validation" method="POST">
                                                @csrf
                                                <label for="validationCustomUsername" class="form-label">Correo
                                                    electrónico</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    <input type="text" name="email" class="form-control" id="email"
                                                        value="{{ old('email') }}" placeholder="Correo electrónico"
                                                        aria-describedby="inputGroupPrepend">
                                                </div><br>
                                                <button type="submit" class="btn btn-success">Enviar</button>
                                            </form>
                                            <script>
                                                $(document).ready(function() {
                                                    $("#formEnviar").submit(function(event) {
                                                        // Prevenir la acción predeterminada del formulario
                                                        event.preventDefault();

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

                                                        // Enviar el formulario si todos los campos son válidos
                                                        if ($(".is-invalid").length == 0) {
                                                            $("#formEnviar").unbind("submit").submit();
                                                        }
                                                    });
                                                });

                                                function isValidEmail(email) {
                                                    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                                    return regex.test(email);
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        Otro usuario
                                    </div>
                                    <div class="card-body">
                                        <form id="formEnviarUsuario" action="{{ route('enviarCorreo', '') }}"
                                            class="g-3 needs-validation" method="POST">
                                            @csrf
                                            <label for="exampleFormControlInput1" class="form-label">Usuarios</label>
                                            <select class="form-select">
                                                @foreach ($usuarios as $usuario)
                                                    <option value="{{ $usuario->email }}">{{ $usuario->nombre }}</option>
                                                @endforeach
                                            </select><br>
                                            <button type="submit" class="btn btn-success">Enviar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="modal-footer">
                    </div> --}}
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
                                @if (session()->has('message'))
                                    <div class="alert alert-success text-center">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-light text-center">
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
                                            @foreach ($ventas as $venta)
                                                <?php
                                                $productos = json_decode($venta['productos'], true);
                                                ?>
                                                <tr>
                                                    <td>{{ $venta['id'] }}</td>
                                                    <td>
                                                        <button id="boton-{{ $venta['id'] }}" class="btn btn-primary"
                                                            style="padding-left: 100px;padding-right: 100px"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#productos-{{ $venta['id'] }}"
                                                            aria-expanded="false"
                                                            aria-controls="productos-{{ $venta['id'] }}">
                                                            {{ count($productos) }} productos
                                                        </button>

                                                        {{-- Boton collapse --}}
                                                        <script>
                                                            $(function() {
                                                                // Cuando se muestra la tabla, cambia el color del botón a rojo
                                                                $('#productos-{{ $venta['id'] }}').on('shown.bs.collapse', function() {
                                                                    $('#boton-{{ $venta['id'] }}').removeClass('btn-primary').addClass('btn-danger');
                                                                });

                                                                // Cuando se oculta la tabla, cambia el color del botón a verde
                                                                $('#productos-{{ $venta['id'] }}').on('hidden.bs.collapse', function() {
                                                                    $('#boton-{{ $venta['id'] }}').removeClass('btn-danger').addClass('btn-primary');
                                                                });
                                                            });
                                                        </script>

                                                        <div class="collapse" id="productos-{{ $venta['id'] }}">
                                                            <table class="table table-light">
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
                                                            class="btn btn-secondary" target="_blank">
                                                            <i class="bi bi-filetype-pdf"></i>
                                                        </a>
                                                        <a class="btn btn-success" href="" data-toggle="modal"
                                                            data-target="#enviarCorreo" data-id="{{ $venta['id'] }}"
                                                            onclick="enviarID(this)"><i class="bi bi-envelope-at"></i></a>

                                                        <script>
                                                            function enviarID(btnID) {
                                                                // Obtener el valor del data-id del botón eliminar
                                                                const id = btnID.getAttribute("data-id");

                                                                // Obtener el elemento form por su id
                                                                const form = document.getElementById("formEnviar");

                                                                // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
                                                                form.action = "{{ route('enviarCorreo', '') }}/" + id;

                                                            }
                                                        </script>

                                                        <a class="btn btn-danger" href="" data-toggle="modal"
                                                            data-target="#confirmDeleteModal"
                                                            data-id="{{ $venta['id'] }}"
                                                            onclick="actualizarBorrar(this)"><i
                                                                class="bi bi-trash"></i></a>
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
    </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        text: "<i class='bi bi-clipboard'></i> Copiar",
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="bi bi-filetype-csv"></i> CSV',
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="bi bi-file-excel"></i> Excel',
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="bi bi-filetype-pdf"></i> PDF',
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'print',
                        text: '<i class="bi bi-printer"></i> Imprimir',
                        className: 'btn btn-light'
                    }
                ]
            });
        });
    </script>

    {{-- Borrar venta --}}
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
