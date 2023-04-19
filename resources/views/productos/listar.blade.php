@section('title', 'Gestión de productos')
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

    {{-- <!-- Modal Ascender-->
    <div class="modal fade" id="ascenderModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog text-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="passwordModalLabel">Ascender producto</h4>
                    <button data-dismiss="modal" aria-label="close" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <p class="mb-0" style="font-style: oblique">Al darle más privilegios a este producto, podrá
                            realizar acciones y acceder a información que antes estaba restringida.</p>
                        <br>
                        <p><strong>¿Deseas continuar?</strong></p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" style="width: 46px; height:38px" class="btn btn-secondary mr-3" data-dismiss="modal">No</button>
                        <form id="formAscender" class="g-3 needs-validation" method="POST"
                            action="{{ route('ascenderproducto', '') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="producto_id" id="producto_id" value="">
                            <button type="submit" style="width: 46px" class="btn btn-primary" id="acceptPasswordButton">Sí</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <script>
        $(document).on('click', '#ascendButton', function() {
            var producto_id = $(this).data('id');
            console.log(producto_id)
            $('#producto_id').val(producto_id);
            var action_url = '{{ route('ascenderproducto', '') }}';
            action_url = action_url.replace('{{ route('ascenderproducto', '') }}',
                '{{ route('ascenderproducto', '') }}/' + producto_id);
            $('#formAscender').attr('action', action_url);
        });
    </script> --}}

    {{-- <!-- Modal Descender -->
    <div class="modal fade" id="descenderModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog text-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="passwordModalLabel2">Descender producto</h4>
                    <button data-dismiss="modal" aria-label="close" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <p class="mb-0" style="font-style: oblique">Al darle menos privilegios a este producto, no podrá
                            realizar acciones y acceder a información que antes estaba permitida.</p>
                        <br>
                        <p><strong>¿Deseas continuar?</strong></p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" style="width: 46px; height:38px" class="btn btn-secondary mr-3" data-dismiss="modal">No</button>
                        <form id="formDescender" class="g-3 needs-validation" method="POST"
                            action="{{ route('descenderproducto', '') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="producto_id_des" id="producto_id_des" value="">
                            <button type="submit" style="width: 46px" class="btn btn-primary" id="acceptPasswordButton2">Sí</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <script>
        $(document).on('click', '#descendButton', function() {
            var producto_id_des = $(this).data('id');
            console.log(producto_id_des)
            $('#producto_id_des').val(producto_id_des);
            var action_url = '{{ route('descenderproducto', '') }}';
            action_url = action_url.replace('{{ route('descenderproducto', '') }}',
                '{{ route('descenderproducto', '') }}/' + producto_id_des);
            $('#formDescender').attr('action', action_url);
        });
    </script>
 --}}


    <!-- Modal para crear un producto -->
    <div class="modal fade" id="crearproducto" tabindex="-1" role="dialog" aria-labelledby="crearproducto-label"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Crear producto
                        </h3>

                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form id="form" class="g-3 needs-validation" method="POST"
                            action="{{ route('createProduct') }}" enctype="multipart/form-data">
                            @csrf
                            <h1>Crear producto</h1>
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre"
                                    value="{{ old('nombre') }}" placeholder="Introduzca un nombre">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom02" class="form-label">Concentración</label>
                                <input type="text" name="concentracion" class="form-control" id="concentracion"
                                    value="{{ old('concentracion') }}" placeholder="Introduzca una concentración (500mg)">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom02" class="form-label">Adicional</label>
                                <input type="number" name="adicional" class="form-control" id="adicional"
                                    value="{{ old('adicional') }}" placeholder="Introduzca un adicional (10 cápsulas)">
                            </div>
                            <br>
                            <div class="">
                                <label for="validationCustom01" class="form-label">Precio</label>
                                <input type="number" step="0.01" name="precio" class="form-control" id="precio"
                                    value="{{ old('precio') }}" placeholder="Introduzca un precio">
                            </div>
                            <br>
                            <div>
                                <label for="validationCustom01" class="form-label">Laboratorio</label>
                                <select class="form-control" name="producto_lab">
                                    @foreach ($laboratorios as $laboratorio)
                                        <option value={{ $laboratorio->id }}
                                            {{ old('laboratorio') == $laboratorio->nombre ? 'selected' : '' }}>
                                            {{ $laboratorio->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <br>
                            <div>
                                <label for="validationCustom01" class="form-label">Tipo</label>
                                <select class="form-control" name="producto_tipo" data-placeholder="Selecciona un tipo">
                                    @foreach ($tipos as $tipo)
                                        <option value={{ $tipo->id }}
                                            {{ old('tipo') == $tipo->nombre ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div>
                                <label for="validationCustom01" class="form-label">Presentación</label>
                                <select class="form-control" name="producto_pre"
                                    data-placeholder="Selecciona una presentacion">
                                    @foreach ($presentaciones as $presentacion)
                                        <option value={{ $presentacion->id }}
                                            {{ old('presentacion') == $presentacion->nombre ? 'selected' : '' }}>
                                            {{ $presentacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div>
                                <label for="imagen" class="form-label">Imagen</label>
                                <input type="file" name="imagen" id="imagen" class="form-control">
                            </div>
                            <br>
                            <div class="col-12">
                                <button id="btnSubmit" class="btn btn-success" type="submit">Crear producto</button>
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
                                            "<div class='invalid-feedback'>Por favor, introduce un nombre.</div>");
                                    } else {
                                        $("#nombre").removeClass("is-invalid");
                                        $("#nombre").addClass("is-valid");
                                    }

                                    // Validar el campo de concentracion
                                    if ($("#concentracion").val() == "") {
                                        $("#concentracion").addClass("is-invalid");
                                        $("#concentracion").parent().find(".invalid-feedback")
                                            .remove(); // eliminar cualquier div existente
                                        $("#concentracion").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce una concentracion.</div>");
                                    } else {
                                        $("#concentracion").removeClass("is-invalid");
                                        $("#concentracion").addClass("is-valid");
                                    }


                                    // Validar el campo de adicional
                                    if ($("#adicional").val() == "") {
                                        $("#adicional").addClass("is-invalid");
                                        $("#adicional").parent().find(".invalid-feedback")
                                            .remove(); // eliminar cualquier div existente
                                        $("#adicional").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce un adicional.</div>"
                                        );
                                    } else {
                                        $("#adicional").removeClass("is-invalid");
                                        $("#adicional").addClass("is-valid");
                                    }

                                    // Validar el campo de precio
                                    if ($("#precio").val() == "") {
                                        $("#precio").addClass("is-invalid");
                                        $("#precio").parent().find(".invalid-feedback").remove();
                                        $("#precio").parent().append(
                                            "<div class='invalid-feedback'>Por favor, introduce un precio.</div>");
                                    } else {
                                        $("#precio").removeClass("is-invalid");
                                        $("#precio").addClass("is-valid");
                                    }

                                    // Validar el campo de laboratorio
                                    if ($("#laboratorio").val() == "") {
                                        $("#laboratorio").addClass("is-invalid");
                                        $("#laboratorio").parent().find(".invalid-feedback").remove();
                                        $("#laboratorio").parent().append(
                                            "<div class='invalid-feedback'>Por favor, selecciona un laboratorio.</div>"
                                        );
                                    } else {
                                        $("#laboratorio").removeClass("is-invalid");
                                        $("#laboratorio").addClass("is-valid");
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

                                    // Validar el campo de presentacion
                                    if ($("#presentacion").val() == "") {
                                        $("#presentacion").addClass("is-invalid");
                                        $("#presentacion").parent().find(".invalid-feedback").remove();

                                        $("#presentacion").parent().append(
                                            "<div class='invalid-feedback'>Por favor, selecciona una presentación.</div>");
                                    } else {
                                        $("#presentacion").removeClass("is-invalid");
                                        $("#presentacion").addClass("is-valid");
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

                            function validarprecio(precio) {
                                const letras = "TRWAGMYFPDXBNJZSQVHLCKE";
                                const regex = /^(\d{8})([A-Z])$/i;

                                if (regex.test(precio)) {
                                    const precioNum = parseInt(precio.substring(0, 8));
                                    const letra = precio.substring(8).toUpperCase();
                                    const letraCorrecta = letras.charAt(precioNum % 23);

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
                        <h1>Gestión de productos</h1>
                        <button type="button" data-toggle="modal" data-target="#crearproducto"
                            class="btn bg-gradient-primary" style="margin-top: 20px">Crear producto</button>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('listaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestión de productos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="cotainer-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Buscar producto</h3>
                        <div class="input-group">
                            <input type="text" id="buscar" placeholder="Introduzca nombre de un producto"
                                class="form-control float-left">
                            <div class="input-group-append"><button class="btn btn-default"><i
                                        class="bi bi-search"></i></button></div>
                        </div>
                    </div>
                    <div class="form-check form-switch" style="margin-left:32px; margin-top:5px">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Mostrar productos borrados</label>
                    </div>

                    <br>
                    @if (session()->has('message'))
                        <div class="alert alert-success text-center">
                            {{ session()->get('message') }}
                    @endif
                </div>
                <?php
                $presentaciones = [];
                $laboratorios = [];
                $tipos = [];
                ?>
                @foreach ($productos as $producto)
                    <?php
                    $presentaciones[] = $producto->presentacion->nombre;
                    $presentaciones_json = json_encode($presentaciones);
                    $laboratorios[] = $producto->laboratorio->nombre;
                    $laboratorios_json = json_encode($laboratorios);
                    $tipos[] = $producto->tipo->nombre;
                    $tipos_json = json_encode($tipos);
                    ?>
                @endforeach

                <div class="card-body">
                    <div id="productos" class="row d-flex align-items-stretch">
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>

    <script>
        $(document).ready(function() {
            var presentaciones = <?php echo $presentaciones_json; ?>;
            var laboratorios = <?php echo $laboratorios_json; ?>;
            var tipos = <?php echo $tipos_json; ?>;

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
                if (!consulta) { // Si no hay consulta, selecciona todos los productos
                    consulta = "todos";
                }


                // $('#mostrarBorrados').change(function() {
                $.ajax({
                        url: 'buscar-productos.php',
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
                            $('#productos').empty();
                            // Agrega los nuevos resultados al cuerpo del card
                            // if (!this.checked) {

                            respuesta.forEach(function(producto, indice) {
                                let imagen = producto.imagen == null ?
                                    "img/productos/sinFoto.png" : producto
                                    .imagen;
                                let presentacionNombre = presentaciones[indice]
                                let laboratorioNombre = laboratorios[indice]
                                let tipoNombre = tipos[indice]

                                let html = `<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                          <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                              
                            </div>
                            <div class="card-body pt-0">
                              <div class="row">
                                <div class="col-7">
                                  <h2 class=""><b>${producto.nombre}</b></h2>
                                  <h5>${producto.precio} €</h5>
                                  <ul class="ml-2 fa-ul">
                                    <li style="margin-left:-15px"><i class="fas fa-mortar-pestle"></i><strong> Concentración:</strong> ${producto.concentracion}</li>
                                    <li style="margin-left:-15px"<i class="fas fa-prescription-bottle-alt"></i><strong> Adicional:</strong> ${producto.adicional}</li>
                                    <li style="margin-left:-15px"><i class="fas fa-flask"></i><strong> Laboratorio:</strong> ${laboratorioNombre}</li>
                                    <li style="margin-left:-15px"><i class="bi bi-c-circle-fill"></i><strong> Tipo:</strong> ${tipoNombre}</li>
                                    <li style="margin-left:-15px"><i class="bi bi-capsule-pill"></i><strong> Presentación:</strong> ${presentacionNombre}</li>
                                  </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img width=100% style="margin-top:20px" src="${imagen}" class="img" alt="Product Image">
                                </div>
                              </div>
                            </div>
                            <div class="card-footer">
                              <div class="text-right">
                                <a href="#" class="btn btn-sm btn-info mt-1" data-toggle="modal" data-target="#cambiarImagenModal" id="cambiarImagen" data-id="${producto.imagen}" data-id2="${producto.id}" onclick="mostrarImagen(this)">
                                <i class="bi bi-card-image"></i> Imagen
                            </a>
                                <a href="#" class="btn btn-sm btn-danger mt-1" data-toggle="modal" data-target="#confirmDeleteModal" data-id="${producto.id}" onclick="actualizarAccionFormulario(this)">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                                <a href="" class="btn btn-sm btn-warning mt-1" id="perfil" data-id="${producto.id}">
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
                                        ¿Estás seguro de que deseas eliminar a este producto?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <form id="deleteForm" action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para cambiar imagen del producto -->
                        <div class="modal fade" id="cambiarImagenModal" tabindex="-1" aria-labelledby="modalCambiarImagenLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('actualizarImagen') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="producto_id" id="producto_id">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCambiarImagenLabel">Cambiar imagen del producto</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3 text-center">
                                                <img  src="{{ asset('') }}" class="img-fluid mb-3" style="width:250px" id="imagen_actual">
                                                <input class="form-control" style="margin-top:20px" type="file" name="imagen" id="imagen_nueva">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        `;

                                $('#productos').append(html);
                            }); //foreach
                            // } //if
                            // else {
                            //     console.log("borrados")
                            // }
                        } else {
                            // Si no se encontraron resultados, muestra un mensaje de error
                            $('#productos').html(
                                '<p class="text-danger">No se encontraron resultados</p>');
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    });
                // })// change checkbox
            }
        });

        function mostrarImagen(botonImagen) {
            const id_producto = botonImagen.getAttribute("data-id2");
            document.getElementById('producto_id').value = id_producto;
            // console.log(id_producto)
            const imagen_actual = botonImagen.getAttribute("data-id");
            const img = document.getElementById("imagen_actual")
            // formularioEliminar.action = "{{ route('borrarProducto', '') }}/" + idProducto;
            img.src = "{{ asset('') }}" + imagen_actual;
        }

        function actualizarAccionFormulario(botonEliminar) {
            // Obtener el valor del data-id del botón eliminar
            const idProducto = botonEliminar.getAttribute("data-id");

            // Obtener el elemento form por su id
            const formularioEliminar = document.getElementById("deleteForm");
            // const verPerfil = document.getElementById("perfil");

            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formularioEliminar.action = "{{ route('borrarProducto', '') }}/" + idProducto;
            // verPerfil.href = "{{ route('datosPersonales', '') }}/" + idProducto;

        }
    </script>
@endsection
