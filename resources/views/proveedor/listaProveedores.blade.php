@section('title', 'Gestión de proveedores')
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
                    ¿Estás seguro de que deseas dar de baja a este proveedor?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" action="{{ route('borrarProveedor', '') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button id="btn-eliminar" type="submit" class="btn btn-danger">Dar de Baja</button>
                    </form>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var btnIniciarSesion = document.getElementById("btn-eliminar");
                            var haHechoClic = false;

                            btnIniciarSesion.addEventListener("click", function(event) {
                                if (haHechoClic) {
                                    event.preventDefault(); // Evita que se envíe el formulario nuevamente
                                    return false;
                                }

                                haHechoClic = true;
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para crear un proveedor -->
    <div class="modal fade" id="crearProveedor" tabindex="-1" role="dialog" aria-labelledby="crearProveedor-label"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Crear proveedor
                        </h3>

                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form id="form" class="g-3 needs-validation" method="POST"
                            action="{{ route('createProveedor') }}">
                            @csrf
                            <h1>Crear proveedor</h1>
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre"
                                    value="{{ old('nombre') }}" placeholder="Introduzca el nombre">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom02" class="form-label">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" id="telefono"
                                    value="{{ old('telefono') }}" placeholder="Introduzca el telefono">
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
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom02" class="form-label">Dirección</label>
                                <input type="text" name="direccion" class="form-control" id="direccion"
                                    value="{{ old('direccion') }}" placeholder="Introduzca la dirección">
                            </div>
                            <br>
                            <div class="col-12">
                                <button id="btnSubmit" class="btn btn-success" type="submit">Crear proveedor</button>
                            </div>
                        </form>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var btnIniciarSesion = document.getElementById("btnSubmit");
                                var haHechoClic = false;

                                btnIniciarSesion.addEventListener("click", function(event) {
                                    if (haHechoClic) {
                                        event.preventDefault(); // Evita que se envíe el formulario nuevamente
                                        return false;
                                    }

                                    haHechoClic = true;
                                });
                            });
                        </script>
                        <script>
                            $(document).ready(function() {
                                $("#form").submit(function(event) {
                                    // Prevenir la acción predeterminada del formulario
                                    event.preventDefault();
                                    // Validar el campo de nombre
                                    if ($("#nombre").val() == "") {
                                        $("#nombre").addClass("is-invalid");
                                        $("#nombre").parent().find(".invalid-feedback")
                                            .remove(); // eliminar cualquier div existente
                                        $("#nombre").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tu nombre.</div>");
                                    } else {
                                        $("#nombre").removeClass("is-invalid");
                                        $("#nombre").addClass("is-valid");
                                    }

                                    // // Validar el campo de direccion
                                    if ($("#direccion").val() == "") {
                                        $("#direccion").addClass("is-invalid");
                                        $("#direccion").parent().find(".invalid-feedback")
                                            .remove(); // eliminar cualquier div existente
                                        $("#direccion").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce una direccion.</div>");
                                    } else {
                                        $("#direccion").removeClass("is-invalid");
                                        $("#direccion").addClass("is-valid");
                                    }

                                    // Validar el campo de telefono
                                    if ($("#telefono").val() == "") {
                                        $("#telefono").addClass("is-invalid");
                                        $("#telefono").parent().find(".invalid-feedback").remove();
                                        $("#telefono").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tu teléfono.</div>"
                                        );
                                    } else if (!isValidPhoneNumber($("#telefono").val())) {
                                        $("#telefono").addClass("is-invalid");
                                        $("#telefono").parent().find(".invalid-feedback").remove();
                                        $("#telefono").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce un teléfono válido.</div>"
                                        );
                                    } else {
                                        $("#telefono").removeClass("is-invalid");
                                        $("#telefono").addClass("is-valid");
                                    }

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
                                        $("#form").unbind("submit").submit();
                                    }
                                });
                            });

                            function isValidEmail(email) {
                                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                return regex.test(email);
                            }

                            function isValidPhoneNumber(phoneNumber) {
                                const regex = /^(\+?\d{1,3}[- ]?)?\d{9}$/;
                                return regex.test(phoneNumber);
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
                        <h1>Gestión de proveedores</h1>
                        <button type="button" data-toggle="modal" data-target="#crearProveedor"
                            class="btn bg-gradient-primary" style="margin-top: 20px">Crear proveedor</button>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('ventaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión de proveedores</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="cotainer-fluid">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Buscar proveedor</h3>
                        <div class="input-group">
                            <input type="text" id="buscar" placeholder="Introduzca nombre de un proveedor"
                                class="form-control float-left">
                            <div class="input-group-append"><button class="btn btn-default"><i
                                        class="bi bi-search"></i></button></div>
                        </div>
                    </div>
                    <div class="form-check form-switch d-flex mt-3">
                        <a type="button" href="{{ route('listaProveedoresBaja') }}" class="btn bg-gradient-danger"><i
                                class="fa-sharp fa-solid fa-user-xmark"></i> Proveedores
                            de baja</a>

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
                        url: 'buscar-proveedor.php',
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
                            respuesta.forEach(function(proveedor) {
                                let direccion = proveedor.direccion == null ?
                                    "sin definir" : proveedor
                                    .direccion;
                                let telefono = proveedor.telefono == null ?
                                    "sin definir" : proveedor
                                    .telefono;
                                let imagen =
                                    '<img width=90px src="img/avatares/avatarProveedor.png" class="img-circle elevation-2" alt="Proveedor Image">';

                                let html = `<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                          <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                            </div>
                            <div class="card-body pt-0">
                              <div class="row">
                                <div class="col-7">
                                  <h2 class="lead"><b>${proveedor.nombre}</b></h2>
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
                            <div class="card-footer">
                              <div class="text-right">
                                <a href="#" class="btn btn-sm btn-danger mt-1 mr-1" data-toggle="modal" data-target="#confirmDeleteModal" data-id="${proveedor.id}" onclick="actualizarAccionFormulario(this)">
                                    <i class="bi bi-x-circle"></i> Baja
                                </a>
                                <a href="{{ route('perfilProveedor', '') }}/${proveedor.id}" class="btn btn-sm btn-info mt-1" id="perfil" data-id="${proveedor.id}">
                                    <i class="fas fa-user"></i> Perfil
                                    </a>
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
                                '<p class="MgNoProduc">No se han encontrado resultados</p>');
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
            const idProveedor = botonEliminar.getAttribute("data-id");

            // Obtener el elemento form por su id
            const formularioEliminar = document.getElementById("deleteForm");
            const verPerfil = document.getElementById("perfil");

            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formularioEliminar.action = "{{ route('borrarProveedor', '') }}/" + idProveedor;
            verPerfil.href = "{{ route('perfilProveedor', '') }}/" + idProveedor;

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
                $('#cestaProductos').append("<tr data-id='" + carrito[i].id + "'><td><img src='" + carrito[i].imagen +
                    "' width='50px'></td><td>" + carrito[i]
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
