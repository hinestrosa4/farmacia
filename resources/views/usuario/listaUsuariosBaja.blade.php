@section('title', 'Gestión de usuarios')
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
        background-color: red;
    }
</style>

@section('menu')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mr-6">
                    <div class="col-sm-6">
                        <h1>Usuarios de baja</h1>
                        {{-- <button type="button" data-toggle="modal" data-target="#crearUsuario"
                            class="btn bg-gradient-primary" style="margin-top: 20px">Crear usuario</button> --}}
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('ventaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión de usuario</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="cotainer-fluid">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Buscar usuario de baja</h3>
                        <div class="input-group">
                            <input type="text" id="buscar" placeholder="Introduzca nombre de usuario de baja"
                                class="form-control float-left">
                            <div class="input-group-append"><button class="btn btn-default"><i
                                        class="bi bi-search"></i></button></div>
                        </div>
                    </div>
                    <div class="form-check form-switch d-flex" style="margin-top:5px;margin-right:5px;margin-bottom:-15px">
                        <div class="ml-auto">
                            <a type="button" href="{{ route('gestionUsuario') }}" class="btn bg-gradient-success"><i
                                    class="fa-solid fa-user-check"></i> Usuarios
                                activos</a>
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
                        url: 'buscar-clientes-baja.php',
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
                            $('#usuarios').empty();
                            // Agrega los nuevos resultados al cuerpo del card
                            // if (!this.checked) {
                            respuesta.forEach(function(usuario) {
                                let tipo = usuario.tipo;
                                let sexo = usuario.sexo;
                                let direccion = usuario.direccion == null ?
                                    "sin definir" : usuario
                                    .direccion;
                                let telefono = usuario.telefono == null ?
                                    "sin definir" : usuario
                                    .telefono;

                                let ascender = usuario.tipo == 1 ? "" : `<a href="#" class="btn btn-sm btn-primary mt-1" data-id="${usuario.id}" id="ascendButton" data-toggle="modal" data-target="#ascenderModal">
                                <i class="bi bi-sort-up"></i>
                                Ascender
                                </a>`;

                                let descender = usuario.tipo == 4 ? "" : `<a href="#" data-id="${usuario.id}" id="descendButton"  class="btn btn-sm btn-secondary mt-1" data-toggle="modal" data-target="#descenderModal">
                                <i class="bi bi-sort-down"></i>
                                Descender
                                </a>`;

                                let rol = tipo == 1 ? 'Administrador' :
                                    tipo == 2 ? 'Farmacéutico' :
                                    tipo == 3 ? 'Técnico' :
                                    tipo == 4 ? 'Auxiliar' : 'Desconocido';

                                let imagen = sexo == "hombre" ?
                                    '<img width=90px src="img/avatares/avatarUser.png" class="img-circle elevation-2" alt="User Image">' :
                                    sexo == "mujer" ?
                                    '<img width=90px src="img/avatares/avatarUserMujer.png" class="img-circle elevation-2" alt="User Image">' :
                                    "No definido";

                                let html = `<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                          <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                              ${rol}
                            </div>
                            <div class="card-body pt-0">
                              <div class="row">
                                <div class="col-7">
                                  <h2 class="lead"><b>${usuario.nombre}</b></h2>
                                  <br>
                                  <ul class="ml-2 fa-ul">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <strong>Dirección:</strong> ${direccion}</li>
                                    <li></li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> <strong>Teléfono:</strong> ${telefono}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-user"></i></span> <strong>Estado:</strong> <span class="status-indicator"></span></li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                            ${imagen}
                                </div>
                              </div>
                            </div>
                            <div class="card-footer" >
                              <div class="text-right">
                                @if (Auth::check() && (Auth::user()->tipo == 1 || Auth::user()->tipo == 2))
                                <a href="#" class="btn btn-sm btn-success mt-1 mr-1" data-toggle="modal" data-target="#confirmAltaModal" data-id="${usuario.id}" onclick="actualizarAccionFormulario(this)">
                                    <i class="bi bi-check2-circle"></i> Alta
                                </a>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <!-- Modal de confirmación de alta -->
                        <div class="modal fade" id="confirmAltaModal" tabindex="-1" role="dialog"
                            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmAltaModalLabel">Confirmar Alta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas dar de alta a este usuario?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <form id="altaForm" action="{{ route('altaUsuario', '') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-success">Dar de Alta</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                                $('#usuarios').append(html);
                            }); //foreach
                            // } //if
                            // else {
                            //     console.log("borrados")
                            // }
                        } else {
                            // Si no se encontraron resultados, muestra un mensaje de error
                            $('#usuarios').html(
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
            const idUsuario = botonEliminar.getAttribute("data-id");

            // Obtener el elemento form por su id
            const formularioEliminar = document.getElementById("altaForm");

            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formularioEliminar.action = "{{ route('altaUsuario', '') }}/" + idUsuario;

        }


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
