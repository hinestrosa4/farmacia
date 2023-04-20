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
        {{-- <script>
            // Obtener el área de la zona de arrastre
            var dropzone = document.getElementById('dropzone');

            // Agregar los eventos de arrastre
            dropzone.addEventListener('dragenter', function(e) {
                e.stopPropagation();
                e.preventDefault();
                dropzone.classList.add('dragover');
            });
            dropzone.addEventListener('dragover', function(e) {
                e.stopPropagation();
                e.preventDefault();
            });
            dropzone.addEventListener('dragleave', function(e) {
                e.stopPropagation();
                e.preventDefault();
                dropzone.classList.remove('dragover');
            });

            // Agregar el evento de soltar
            dropzone.addEventListener('drop', function(e) {
                e.stopPropagation();
                e.preventDefault();
                dropzone.classList.remove('dragover');

                // Obtener el archivo de imagen
                var files = e.dataTransfer.files;
                if (files.length > 0) {
                    var file = files[0];

                    // Verificar si el archivo es una imagen
                    if (file.type.match(/image.*/)) {
                        var reader = new FileReader();

                        // Cargar la imagen
                        reader.onload = function(e2) {
                            var img = document.createElement('img');
                            img.src = e2.target.result;
                            img.style.maxWidth = '100%';
                            img.style.height = 'auto';
                            dropzone.innerHTML = '';
                            dropzone.appendChild(img);

                            // Mostrar el campo de entrada de archivos
                            var input = document.getElementById('image');
                            input.style.display = 'block';
                            input.files = files;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert('El archivo seleccionado no es una imagen.');
                    }
                }

            });
        </script> --}}
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
                                    @if (Auth::check() && (Auth::user()->tipo == 1 || Auth::user()->tipo == 2))
                                        <a href="#" class="btn btn-sm btn-danger mt-1 mr-1" data-toggle="modal"
                                            data-id="{{ $image->getFilename() }}" onclick="enviarFilename(this)"
                                            data-target="#confirmDeleteModal">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
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
@endsection
