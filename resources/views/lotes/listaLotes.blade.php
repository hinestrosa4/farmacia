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

    <!-- Modal para crear un lote -->
    <div class="modal fade" id="crearLote" tabindex="-1" role="dialog" aria-labelledby="crearLote-label" data-backdrop="static"
        data-keyboard="false">
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
                        <form id="form" class="g-3 needs-validation" method="POST" action="{{ route('createUser') }}">
                            @csrf
                            <h1>Crear lote</h1>
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre"
                                    value="{{ old('nombre') }}" placeholder="Introduzca su nombre">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom02" class="form-label">Apellidos</label>
                                <input type="text" name="apellidos" class="form-control" id="apellidos"
                                    value="{{ old('apellidos') }}" placeholder="Introduzca sus apellidos">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom02" class="form-label">Fecha de nacimiento</label>
                                <input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento"
                                    value="{{ old('fecha_nacimiento') }}" placeholder="Introduzca su fecha de nacimiento">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">DNI</label>
                                <input type="text" name="dni" class="form-control" id="dni"
                                    value="{{ old('dni') }}" placeholder="Introduzca su DNI">
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
                                <label for="validationCustom01" class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    value="{{ old('password') }}" placeholder="Introduzca su clave">
                            </div>
                            <br>
                            <div>
                                <label for="validationCustom01" class="form-label">Tipo</label>
                                <select class="form-control" name="tipo">
                                    <option value="2" {{ old('tipo') == 'farmaceutico' ? 'selected' : '' }}>
                                        Farmacéutico</option>
                                    <option value="3" {{ old('tipo') == 'tecnico' ? 'selected' : '' }}>Técnico
                                    </option>
                                    <option value="4" {{ old('tipo') == 'auxiliar' ? 'selected' : '' }}>Auxiliar
                                    </option>
                                    <option value="1" {{ old('tipo') == 'administrador' ? 'selected' : '' }}>
                                        Administrador</option>
                                </select>
                            </div>
                            <br>
                            <div class="col-12">
                                <button id="btnSubmit" class="btn btn-success" type="submit">Crear usuario</button>
                            </div>
                        </form>

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

                                    // Validar el campo de apellidos
                                    if ($("#apellidos").val() == "") {
                                        $("#apellidos").addClass("is-invalid");
                                        $("#apellidos").parent().find(".invalid-feedback")
                                            .remove(); // eliminar cualquier div existente
                                        $("#apellidos").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tus apellidos.</div>");
                                    } else {
                                        $("#apellidos").removeClass("is-invalid");
                                        $("#apellidos").addClass("is-valid");
                                    }


                                    // Validar el campo de fecha de nacimiento
                                    if ($("#fecha_nacimiento").val() == "") {
                                        $("#fecha_nacimiento").addClass("is-invalid");
                                        $("#fecha_nacimiento").parent().find(".invalid-feedback")
                                            .remove(); // eliminar cualquier div existente
                                        $("#fecha_nacimiento").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tu fecha de nacimiento.</div>"
                                        );
                                    } else {
                                        $("#fecha_nacimiento").removeClass("is-invalid");
                                        $("#fecha_nacimiento").addClass("is-valid");
                                    }

                                    // Validar el campo de DNI
                                    if ($("#dni").val() == "") {
                                        $("#dni").addClass("is-invalid");
                                        $("#dni").parent().find(".invalid-feedback").remove();
                                        $("#dni").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tu DNI.</div>");
                                    } else if (!validarDNI($("#dni").val())) {
                                        $("#dni").addClass("is-invalid");
                                        $("#dni").parent().find(".invalid-feedback").remove();
                                        $("#dni").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce un dni válido.</div>"
                                        );
                                    } else {
                                        $("#dni").removeClass("is-invalid");
                                        $("#dni").addClass("is-valid");
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

                                    // Validar el campo de contraseña
                                    if ($("#password").val() == "") {
                                        $("#password").addClass("is-invalid");
                                        $("#password").parent().find(".invalid-feedback").remove();

                                        $("#password").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce tu contraseña.</div>");
                                    } else {
                                        $("#password").removeClass("is-invalid");
                                        $("#password").addClass("is-valid");
                                    }

                                    // Validar el campo de tipo
                                    if ($("#tipo").val() == "") {
                                        $("#tipo").addClass("is-invalid");
                                        $("#tipo").parent().find(".invalid-feedback").remove();

                                        $("#tipo").parent().append(
                                            "<div class='invalid-feedback'>Por favor, selecciona un tipo.</div>");
                                    } else {
                                        $("#tipo").removeClass("is-invalid");
                                        $("#tipo").addClass("is-valid");
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
                            <li class="breadcrumb-item"><a href="{{ route('listaProductos') }}">Inicio</a></li>
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
                            <a type="button" href="{{ route('gestionUsuarioBaja') }}" class="btn bg-gradient-danger"><i
                                    class="bi bi-archive-fill"></i> Lotes eliminados</a>
                        </div>
                    </div>
                    <br>
                    @if (session()->has('message'))
                        <div class="alert alert-success text-center">
                            {{ session()->get('message') }}
                    @endif
                </div>
                <?php
                $productos = [];
                $productosImagen = [];
                $proveedores = [];
                ?>
                @foreach ($lotes as $lote)
                    <?php
                    $productos[] = $lote->producto->nombre;
                    $productos_json = json_encode($productos);

                    $productosImagen[] = $lote->producto->imagen;
                    $productos_imagen_json = json_encode($productosImagen);

                    $laboratorios[] = $lote->proveedor->nombre;
                    $proveedores_json = json_encode($proveedores);
                    ?>
                @endforeach
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
            var productos = <?php echo $productos_json; ?>;
            var productos_imagen = <?php echo $productos_imagen_json; ?>;

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

                                let productoNombre = productos[indice]

                                let imagen = productos_imagen[indice] == null ?
                                    "img/productos/sinFoto.png" : productos_imagen[indice];

                                let d= lote.vencimiento.substring(8)
                                let m = lote.vencimiento.substring(7,5)
                                let y = lote.vencimiento.substring(0,4)

                                let html = `<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                          <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                            </div>
                            <div class="card-body pt-0">
                              <div class="row">
                                <div class="col-7">
                                  <h2 class="lead"><b>Lote de ${productoNombre}</b></h2>
                                  <br>
                                  <ul class="ml-2 fa-ul">
                                    <li class="small"><span class="fa-li"><i class="fa-solid fa-key"></i></span> <strong>Identificador:</strong> ${lote.id}</li>
                                    <li class="small"><span class="fa-li"><i class="fa-solid fa-boxes-stacked"></i></span> <strong>Stock:</strong> ${lote.stock}</li>
                                    <li></li>
                                    <li class="small"><span class="fa-li"><i class="fa-regular fa-calendar fa-lg"></i></span> <strong>Vencimiento:</strong> ${d}/${m}/${y}</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img width=70% style="margin-bottom:20px" src="${imagen}" class="img" alt="Product Image">
                                </div>
                              </div>
                            </div>
                            <div class="card-footer">
                              <div class="text-right">
                                <a href="#" class="btn btn-sm btn-danger mt-1 mr-1" data-toggle="modal" data-target="#confirmDeleteModal" data-id="${lote.id}" onclick="actualizarAccionFormulario(this)">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            <a href="{{ route('datosPersonales', '') }}/${lote.id}" class="btn btn-sm btn-warning mt-1" id="editar" data-id="${lote.id}">
                                <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        
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
            editar.href = "{{ route('datosPersonales', '') }}/" + idLote;
        }
    </script>
@endsection
