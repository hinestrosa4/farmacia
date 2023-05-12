@section('title', 'Gestión de lotes')
@extends('layouts.base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/2e015df9b7.js" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

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

    <!-- Modal de confirmación de eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este lote?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" action="{{ route('borrarLote', '') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar lote</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para crear un lote -->
    <div class="modal fade" id="crearLote" tabindex="-1" role="dialog" aria-labelledby="crearLote-label"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Crear lote
                        </h3>

                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form id="form" class="g-3 needs-validation" method="POST" action="{{ route('createLote') }}">
                            @csrf
                            <h1>Crear lote</h1>
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" id="stock"
                                    value="{{ old('stock') }}" placeholder="Introduzca un stock">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom02" class="form-label">Fecha de vencimiento</label>
                                <input type="date" name="vencimiento" class="form-control" id="vencimiento"
                                    value="{{ old('vencimiento') }}" placeholder="Introduzca una fecha de vencimiento">
                            </div>
                            <br>
                            <div>
                                <label for="validationCustom01" class="form-label">Producto</label>
                                <select class="form-control" name="lote_id_prod" style="width: 100%">
                                    @foreach ($productos as $producto)
                                        <option value={{ $producto->id }}
                                            {{ old('producto') == $producto->nombre ? 'selected' : '' }}>
                                            {{ $producto->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div>
                                <label for="validationCustom01" class="form-label">Proveedor</label>
                                <select class="form-control" name="lote_id_prov" style="width: 100%">
                                    @foreach ($proveedores as $proveedor)
                                        <option value={{ $proveedor->id }}
                                            {{ old('proveedor') == $proveedor->nombre ? 'selected' : '' }}>
                                            {{ $proveedor->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="col-12">
                                <button id="btnSubmit" class="btn btn-success" type="submit">Crear lote</button>
                            </div>
                        </form>

                        <script>
                            $(document).ready(function() {
                                $("#form").submit(function(event) {
                                    // Prevenir la acción predeterminada del formulario
                                    event.preventDefault();
                                    // Validar el campo de stock
                                    if ($("#stock").val() == "") {
                                        $("#stock").addClass("is-invalid");
                                        $("#stock").parent().find(".invalid-feedback")
                                            .remove(); // eliminar cualquier div existente
                                        $("#stock").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce un stock.</div>");
                                    } else {
                                        $("#stock").removeClass("is-invalid");
                                        $("#stock").addClass("is-valid");
                                    }

                                    // Validar el campo de vencimiento
                                    if ($("#vencimiento").val() == "") {
                                        $("#vencimiento").addClass("is-invalid");
                                        $("#vencimiento").parent().find(".invalid-feedback")
                                            .remove(); // eliminar cualquier div existente
                                        $("#vencimiento").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce una fecha de vencimiento.</div>"
                                        );
                                    } else {
                                        $("#vencimiento").removeClass("is-invalid");
                                        $("#vencimiento").addClass("is-valid");
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
                        <h1>Gestión de lotes</h1>
                        @if (Auth::check() && (Auth::user()->tipo == 1 || Auth::user()->tipo == 2))
                            <button type="button" data-toggle="modal" data-target="#crearLote"
                                class="btn bg-gradient-primary" style="margin-top: 20px">Crear lote</button>
                        @endif
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('ventaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión de lotes</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="cotainer-fluid">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Buscar lote</h3>
                        <div class="input-group">
                            <input type="text" id="buscar" placeholder="Introduzca nombre de un lote"
                                class="form-control float-left">
                            <div class="input-group-append"><button class="btn btn-default"><i
                                        class="bi bi-search"></i></button></div>
                        </div>
                    </div>
                    <div class="form-check form-switch d-flex"
                        style="margin-top:5px;margin-right:5px;margin-bottom:-15px">
                        <div class="ml-auto">
                            <a type="button" href="{{ route('gestionLotesEliminados') }}"
                                class="btn bg-gradient-danger"><i class="bi bi-archive-fill"></i> Lotes eliminados</a>
                        </div>
                    </div>
                    <br>
                    @if (session()->has('message'))
                        <div class="alert alert-success text-center">
                            {{ session()->get('message') }}
                    @endif
                </div>
                <div class="card-body">
                    <div id="lotes" class="row d-flex align-items-stretch">

                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
    </div>
    </section>
    </div>

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('select').select2();
        });

        $(document).ready(function() {
            // verifica si el campo de búsqueda está vacío
            if ($('#buscar').val() == "") {
                buscarDatos(); // Llama a buscarDatos() sin pasar ningún parámetro
            }

            $(document).on('keyup', '#buscar', function() {
                let valor = $(this).val();
                buscarDatos(valor); // Llama a buscarDatos() con el valor del campo de búsqueda
            });

            function buscarDatos(consulta) {
                funcion = "buscar";
                if (!consulta) { // Si no hay consulta, selecciona todos los clientes
                    consulta = "todos";
                }
                // $('#mostrarBorrados').change(function() {
                $.ajax({
                        url: 'buscar-lotes.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            consulta: consulta,
                            funcion: funcion
                        },
                    })
                    .done(function(respuesta) {
                        if (respuesta.length > 0) {
                            // Borra los resultados anteriores
                            $('#lotes').empty();
                            // Agrega los nuevos resultados al cuerpo del card
                            // if (!this.checked) {
                            respuesta.forEach(function(lote, indice) {

                                let d = lote.vencimiento.substring(8)
                                let m = lote.vencimiento.substring(7, 5)
                                let y = lote.vencimiento.substring(0, 4)

                                let html = `<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                          <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                            </div>
                            <div class="card-body pt-0">
                              <div class="row">
                                <div class="col-7">
                                  <h2 class="lead"><b>Lote de ${lote.nombre}</b></h2>
                                  <br>
                                  <ul class="ml-2 fa-ul">
                                    <li class="small"><span class="fa-li"><i class="fa-solid fa-key"></i></span> <strong>Identificador:</strong> ${lote.id}</li>
                                    <li class="small"><span class="fa-li"><i class="fa-solid fa-boxes-stacked"></i></span> <strong>Stock:</strong> ${lote.stock}</li>
                                    <li></li>
                                    <li class="small"><span class="fa-li"><i class="fa-regular fa-calendar fa-lg"></i></span> <strong>Fecha de caducidad:</strong> ${d}/${m}/${y}</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img width=70% style="margin-bottom:20px" src="${lote.imagen}" class="img" alt="Product Image">
                                </div>
                              </div>
                            </div>
                            <div class="card-footer">
                              <div class="text-right">
                                <a href="#" class="btn btn-sm btn-danger mt-1 mr-1" data-toggle="modal" data-target="#confirmDeleteModal" data-id="${lote.id}" onclick="actualizarAccionFormulario(this)">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            <a href="{{ route('editarLote', '') }}/${lote.id}" class="btn btn-sm btn-warning mt-1" id="editar" data-id="${lote.id}">
                                <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                              </div>
                            </div>
                          </div>
                        </div>                                           
                        `;
                                $('#lotes').append(html);
                            }); //foreach
                            // } //if
                            // else {
                            //     console.log("borrados")
                            // }
                        } else {
                            // Si no se encontraron resultados, muestra un mensaje de error
                            $('#lotes').html(
                                '<p class="text-danger">No se encontraron resultados</p>');
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    });
                // })// change checkbox
            }

        });

        function actualizarAccionFormulario(botonEliminar) {
            // Obtener el valor del data-id del botón eliminar
            const idLote = botonEliminar.getAttribute("data-id");

            // Obtener el elemento form por su id
            const formularioEliminar = document.getElementById("deleteForm");
            const editar = document.getElementById("editar");

            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formularioEliminar.action = "{{ route('borrarLote', '') }}/" + idLote;
            editar.href = "{{ route('editarLote', '') }}/" + idLote;
        }

        //vaciar carrito
        $('#vaciarCarrito').click(function() {
            event.stopPropagation(); // Evitar cierre del menú desplegable
            $('#cestaProductos tr:not(:first)').remove();
            carrito = [];
            localStorage.removeItem('carrito');
            $('#contador').empty()
            $('#contador').append(carrito.length)
        });

        //borrar individual
        $(document).on('click', '.borrar', function(event) {
            event.preventDefault();
            event.stopPropagation(); // Evitar cierre del menú desplegable
            // Obtener el id del producto que se debe eliminar
            const id = $(this).closest('tr').data('id');

            // Encontrar el índice del producto con ese id en el array
            const index = carrito.findIndex(item => item.id === id);

            // Eliminar el elemento del array
            carrito.splice(index, 1);

            // Eliminar el elemento del DOM
            $(this).closest('tr').remove();

            // Actualizar los índices de los elementos en la tabla
            $('#cestaProductos tr:not(:first)').each(function(index, elemento) {
                $(elemento).attr('data-index', index);
            });

            // Guardar el carrito actualizado en localStorage
            localStorage.setItem('carrito', JSON.stringify(carrito));
            console.log(carrito);
            $('#contador').empty()
            $('#contador').append(carrito.length)
            cargarCarrito()
            return false; // Evitar cualquier acción adicional
        });

        // Cargar el carrito desde el almacenamiento local
        if (localStorage.getItem("carrito")) {
            carrito = JSON.parse(localStorage.getItem("carrito"));

            $('#contador').empty();
            $('#contador').append(carrito.length);
            for (let i = 0; i < carrito.length; i++) {
                $('#cestaProductos').append("<tr data-id='" + carrito[i].id + "'><td>" + carrito[i]
                    .nombre +
                    "</td><td>" + carrito[i].concentracion + "</td><td>" +
                    carrito[i].adicional + "</td><td>" + carrito[i].nombre_pre + "</td><td>" +
                    carrito[i].precio +
                    "€</td><td><button type='button' class='btn btn-danger borrar'><i class='i bi-x-lg'></i></button></td></tr>"
                );
            }
        }

        // Función para eliminar un producto del carrito
        function removeProduct(id) {
            const index = carrito.findIndex(producto => producto.id === id);
            if (index !== -1) {
                carrito.splice(index, 1);
                localStorage.setItem('carrito', JSON.stringify(carrito));
                $('#contador').empty();
                $('#contador').append(carrito.length);
                $(`tr[data-id=${id}]`).remove();
            }
        }

        // Evento para eliminar un producto del carrito al hacer clic en el botón "Eliminar"
        $('#cestaProductos').on('click', '.borrar', function() {
            const id = $(this).closest('tr').data('id');
            removeProduct(id);
        });

        // Evento para vaciar el carrito al hacer clic en el botón "Vaciar cesta"
        $('#vaciarCesta').on('click', function() {
            carrito = [];
            localStorage.removeItem('carrito');
            $('#contador').empty();
            $('#contador').append(carrito.length);
            $('#cestaProductos').empty();
        });
    </script>
@endsection
