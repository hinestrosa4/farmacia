@section('title', 'Gestión de lotes')
@extends('layouts.base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/2e015df9b7.js" crossorigin="anonymous"></script>
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

    .status-indicator {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin-left: 5px;
        border-radius: 50%;
        background-color: rgb(0, 224, 0);
    }
</style>

@section('menu')


    <!-- Modal de confirmación de alta -->
    <div class="modal fade" id="confirmAltaModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmAltaModalLabel">Restaurar lote</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas restaurar este lote?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="altaForm" action="{{ route('altaLote', '') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-success">Restaurar</button>
                    </form>
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
                        <h1>Lotes eliminados</h1>
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
                    <div class="form-check form-switch d-flex" style="margin-top:5px;margin-right:5px;margin-bottom:-15px">
                        <div class="ml-auto">
                            <a type="button" href="{{ route('listaLotes') }}" class="btn bg-gradient-success"><i
                                    class="bi bi-archive-fill"></i> Lotes activos</a>
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

    <script>
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
                        url: 'buscar-lotes-eliminados.php',
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
                                <a href="#" class="btn btn-sm btn-success mt-1 mr-1" data-toggle="modal" data-target="#confirmAltaModal" data-id="${lote.id}" onclick="actualizarAccionFormulario(this)">
                                    <i class="bi bi-check2-circle"></i> Restaurar
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
            const formularioEliminar = document.getElementById("altaForm");

            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formularioEliminar.action = "{{ route('altaLote', '') }}/" + idLote;
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
