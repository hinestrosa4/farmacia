@section('title', 'Imagenes')
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

    .image-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
</style>

@section('menu')

    <!-- Modal para añadir imagenes -->
    <div class="modal fade" id="cambiarImagenModal" tabindex="-1" role="dialog" aria-labelledby="crearlaboratorio-label"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Cambiar imagen del producto
                        </h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('subirImagen') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCambiarImagenLabel">Cambiar imagen</h5>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3 text-center">
                                    <input type="file" class="form-control" name="imagen[]" id="imagen"
                                        accept="image/*" multiple>
                                    {{-- <br>
                                    <div id="dropzone" class="dropzone">
                                        <p>Arrastra y suelta la imagen aquí o haz clic para seleccionar una</p>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    ¿Estás seguro de que deseas eliminar esta imagen?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" action="{{ route('eliminarImagen') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="filenameModal" name="filename">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Configuración de imagenes</h1>
                        <br>
                        <h3>Productos</h3>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('configuracion') }}">Configuración</a></li>
                            <li class="breadcrumb-item active">Imagenes</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section>
            @if (Auth::check() && (Auth::user()->tipo == 1 || Auth::user()->tipo == 2))
                <button data-toggle="modal" data-target="#cambiarImagenModal" class="btn btn-primary ml-3 mb-4">Agregar
                    imagenes</button>
            @endif
            @if (session()->has('message'))
                <div class="alert alert-success text-center">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="image-gallery ml-3">
                <div class="row">
                    @foreach (File::allFiles(public_path('img/productos')) as $image)
                        @if (in_array($image->getExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                            <div class="col-md-3">
                                <div class="image-container">
                                    <img width="75%" src="{{ asset('img/productos/' . $image->getFilename()) }}"
                                        alt="{{ $image->getFilename() }}">
                                    <a href="#" class="btn btn-sm btn-danger mt-1 mr-1" data-toggle="modal"
                                        data-id="{{ $image->getFilename() }}" onclick="enviarFilename(this)"
                                        data-target="#confirmDeleteModal">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <script>
                                        function enviarFilename(boton) {
                                            var inputModal = document.getElementById('filenameModal')
                                            inputModal.value = boton.getAttribute("data-id")
                                        }
                                    </script>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <h3>Avatares</h3>
                    @foreach (File::allFiles(public_path('img/avatares')) as $image)
                        @if (in_array($image->getExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                            <div class="col-md-3">
                                <div class="image-container">
                                    <img width="75%" src="{{ asset('img/avatares/' . $image->getFilename()) }}"
                                        alt="{{ $image->getFilename() }}">
                                    <a href="#" class="btn btn-sm btn-danger mt-1 mr-1" data-toggle="modal"
                                        data-id="{{ $image->getFilename() }}" onclick="enviarFilename(this)"
                                        data-target="#confirmDeleteModal">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <script>
                                        function enviarFilename(boton) {
                                            var inputModal = document.getElementById('filenameModal')
                                            inputModal.value = boton.getAttribute("data-id")
                                        }
                                    </script>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </div>
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
