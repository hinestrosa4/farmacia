@section('title', 'Venta de productos')
@extends('layouts.base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

    .status-indicator-success {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin-left: 5px;
        border-radius: 50%;
        background-color: rgb(0, 224, 0);
    }

    .status-indicator-warning {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin-left: 5px;
        border-radius: 50%;
        background-color: rgb(255, 186, 26);
    }

    .status-indicator-danger {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin-left: 5px;
        border-radius: 50%;
        background-color: rgb(224, 0, 0);
    }

    .card-productos:hover {
        border: 1px solid #a6a6a6;
    }

    .enlace-card {
        color: black
    }

    .enlace-card:hover {
        color: black
    }

    .card-productos {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .card-productos {
        position: relative;
    }

    .discount-badge {
        position: absolute;
        top: 20;
        right: 8;
        background-color: #FF7800;
        border-top-left-radius: 12px;
        color: white;
        font-weight: bold;
        padding: 5px;
        font-size: 16px;
    }

    button.custom-checkbox:hover {
        transform: translateY(-3px);
        /* Eleva el botón 3 píxeles hacia arriba */
    }

    button.custom-checkbox {
        border: none;
        background-color: transparent;
        padding: 0;
        margin-left: 1%;
        transition: transform 0.2s ease-in-out;
    }

    button.custom-checkbox input[type=checkbox] {
        display: none;
    }

    button.custom-checkbox span {
        display: none;
    }

    button.custom-checkbox input[type=checkbox]:checked+label span.active {
        color: white;
        /* font-weight: normal; */
        border-radius: 5px;
        padding: 10px;
        display: inline-block;
        background-color: #158d1b;
        /* Color verde oscuro */
    }

    button.custom-checkbox input[type=checkbox]:not(:checked)+label span.not-active {
        color: rgb(255, 255, 255);
        /* font-weight: normal; */
        border-radius: 5px;
        padding: 10px;
        display: inline-block;
        background-color: #8edb92;
        /* Color verde claro */
    }
</style>

@section('menu')
    {{-- Producto ya existe en el carrito --}}
    <div class="modal fade" id="productoExistente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-red">
                    <h5 class="modal-title" id="exampleModalLabel">Producto existente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Este producto ya está añadido al carrito
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Producto agotado --}}
    <div class="modal fade" id="productoAgotado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-red">
                    <h5 class="modal-title" id="exampleModalLabel2">Producto agotado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Este producto está agotado
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
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
                        <h1>Venta de productos</h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('ventaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Venta de productos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="cotainer-fluid">
                <div class="card" style="">
                    {{-- <div class="card-header mb-3">
                        <h3 class="card-title">Filtros</h3>
                        <div class="input-group">
                            <input type="text" id="buscar" placeholder="Introduzca nombre de un producto"
                                class="form-control float-left">
                            <div class="input-group-append"><button class="btn btn-default"><i
                                        class="bi bi-search"></i></button></div>
                        </div>
                    </div> --}}
                    <div class="form-check form-switch d-flex justify-content-center flex-wrap"
                        style="margin-left:6%;padding: 25px; margin-right: 5px; margin-bottom: -20px;">
                        <div class="col">
                            <p class="mr-3">Tipo:</p>
                            <select name="selectTipo" id="selectTipo" style="width:180px">
                                <option value="-1">Todos</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <p class=" mr-3">Presentación:</p>
                            <select name="selectPre" id="selectPre" style="width:180px">
                                <option value="-1">Todos</option>
                                @foreach ($presentaciones as $presentacion)
                                    <option value="{{ $presentacion->id }}">{{ $presentacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <p class="mr-3" for="priceRange">Precio máximo:</p>
                            <input type="range" id="priceRange" min="0" max="50" value="25"
                                step="1" oninput="updatePriceLabel()">
                            <span id="priceLabel">25</span><span>€</span>
                        </div>
                        <div class="col">
                            <p class="mr-3">Producto:</p>
                            <select name="selectPro" id="selectPro" style="width:180px">
                                <option value="-1">Todos</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').select2();
        });

        function updatePriceLabel() {
            var priceRange = document.getElementById("priceRange");
            var priceLabel = document.getElementById("priceLabel");

            priceLabel.innerText = priceRange.value;
        }

        var presentaciones = <?php echo $presentaciones_json; ?>;
        var laboratorios = <?php echo $laboratorios_json; ?>;
        var tipos = <?php echo $tipos_json; ?>;

        var filtro = " ORDER BY p.id";
        var checkbox = document.getElementById('cbEstado')
        var checkboxPrecio = document.getElementById('cbPrecio')

        var c = 0
        c == 0 ? buscarDatosSinFiltro() : ""
        c++

        // console.log("----------");
        //sin filtros
        function buscarDatosSinFiltro(consulta) {
            // console.log("todo");
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
                        funcion: funcion,
                        filtro: filtro
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
                            let descuento = producto.descuento != null ?
                                "<span class='discount-badge'>-" + producto.descuento + "%</span>" :
                                ""
                            let presentacionNombre = presentaciones[indice]
                            let laboratorioNombre = laboratorios[indice]
                            let tipoNombre = tipos[indice]
                            let precioTa = ((producto.descuento / 100) * producto.precio) +
                                parseFloat(producto.precio)
                            let precioTachado = parseFloat(precioTa).toFixed(2)
                            let tachado = producto.descuento != null ?
                                "<span class='mb-4' style='text-decoration:line-through;text-decoration-thickness: 1px;font-size:16px;color:#979B96'>" +
                                precioTachado + " €<span>" :
                                ""

                            let botonComprarStyle = producto.stock == 0 ?
                                "background-color: #BCBFBB;" : "background-color: #C4F6B0;";

                            let botonComprarTexto = producto.stock == 0 ? "Agotado" : "Comprar";

                            let html = `
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill card-productos">
                                        <a href="#" onclick="addCarrito(this)" class="enlace-card" data-id="${presentacionNombre}" data-info='${JSON.stringify(producto)}'>
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <img width=50% style="margin-bottom:20px;" src="${imagen}" class="img mt-4" alt="Product Image">
                                                </div>

                                                <p class="">${producto.nombre} ${producto.concentracion}</p>
                                                <span class="price mr-3" style="font-size:20px; font-weight:bold">${producto.precio} €</span>
                                                ${tachado}

                                                <div class="mt-3">
                                                    <a href="#" class="btn btn-sm mt-4" style="width:100%;${botonComprarStyle}" onclick="addCarrito(this)" data-id="${presentacionNombre}" data-info='${JSON.stringify(producto)}'>
                                                        <i class="bi bi-cart-plus-fill"></i> ${botonComprarTexto}
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    ${descuento}
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
                            '<p class="MgNoProduc">No se han encontrado resultados</p>');
                    }
                })
                .fail(function() {
                    console.log("error");
                });
            // })// change checkbox
        }

        // Filtros
        function aplicarFiltros() {
            var selectedPre = $('#selectPre').val();
            var selectedTipo = $('#selectTipo').val();
            var selectedPro = $('#selectPro').val();
            var maxPrice = $('#priceRange').val();

            var presentaciones = <?php echo $presentaciones_json; ?>;
            var laboratorios = <?php echo $laboratorios_json; ?>;
            var tipos = <?php echo $tipos_json; ?>;

            var filtro = " WHERE ";

            if (selectedPre != -1) {
                filtro += "producto_pre IN(" + selectedPre + ")";
            }

            if (selectedTipo != -1) {
                if (selectedPre != -1) {
                    filtro += " AND ";
                }
                filtro += "producto_tipo IN(" + selectedTipo + ")";
            }

            if (selectedPro != -1) {
                if (selectedPre != -1 || selectedTipo != -1) {
                    filtro += " AND ";
                }
                filtro += "id = " + selectedPro;
            }

            if (selectedPre == "-1" && selectedTipo == "-1" && selectedPro == "-1") {
                filtro = " WHERE deleted_at IS NULL";
            }
            filtro += " AND precio <= " + maxPrice + " AND deleted_at IS NULL";

            // console.log(filtro);

            $.ajax({
                    url: 'filtros.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        consulta: 'filtro',
                        funcion: funcion,
                        filtro: filtro
                    },
                })
                .done(function(respuesta) {
                    // console.log(respuesta);
                    if (respuesta.length > 0) {
                        // Borra los resultados anteriores
                        $('#productos').empty();
                        // Agrega los nuevos resultados al cuerpo del card

                        respuesta.forEach(function(producto, indice) {
                            let imagen = producto.imagen == null ?
                                "img/productos/sinFoto.png" : producto
                                .imagen;
                            let descuento = producto.descuento != null ?
                                "<span class='discount-badge'>-" + producto.descuento + "%</span>" :
                                ""
                            let presentacionNombre = presentaciones[indice]
                            let laboratorioNombre = laboratorios[indice]
                            let tipoNombre = tipos[indice]
                            let precioTa = ((producto.descuento / 100) * producto.precio) +
                                parseFloat(producto.precio)
                            let precioTachado = parseFloat(precioTa).toFixed(2)
                            let tachado = producto.descuento != null ?
                                "<span class='mb-4' style='text-decoration:line-through;text-decoration-thickness: 1px;font-size:16px;color:#979B96'>" +
                                precioTachado + " €<span>" :
                                ""

                            let botonComprarStyle = producto.stock == 0 ?
                                "background-color: #BCBFBB;" : "background-color: #C4F6B0;";

                            let botonComprarTexto = producto.stock == 0 ? "Agotado" : "Comprar";

                            let html = `
                                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                        <div class="card bg-light d-flex flex-fill card-productos">
                                            <a href="#" onclick="addCarrito(this)" class="enlace-card" data-id="${presentacionNombre}" data-info='${JSON.stringify(producto)}'>
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <img width=50% style="margin-bottom:20px" src="${imagen}" class="img mt-4" alt="Product Image">
                                                    </div>

                                                    <p class="">${producto.nombre} ${producto.concentracion}</p>
                                                    <span class="price mr-3" style="font-size:20px; font-weight:bold">${producto.precio} €</span>
                                                    ${tachado}
                                                    
                                                    <div class="mt-3">
                                                        <a href="#" class="btn btn-sm mt-4" style="width:100%;${botonComprarStyle}" onclick="addCarrito(this)" data-id="${presentacionNombre}" data-info='${JSON.stringify(producto)}'>
                                                            <i class="bi bi-cart-plus-fill"></i> ${botonComprarTexto}
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        ${descuento}
                                    </div>
                                `;
                            $('#productos').append(html);
                        }); //foreach
                    } else {
                        // Si no se encontraron resultados, muestra un mensaje de error
                        $('#productos').html('<p class="MgNoProduc">No se han encontrado resultados</p>');
                    }
                })
                .fail(function() {
                    // console.log("error");
                });
        }

        $('#selectPre').change(function() {
            aplicarFiltros();
        });

        $('#selectTipo').change(function() {
            aplicarFiltros();
        });

        $('#selectPro').change(function() {
            aplicarFiltros();
        });

        $('#priceRange').mouseup(function() {
            aplicarFiltros();
        });


        let carrito = [];

        //añadir
        // Función para añadir un producto al carrito
        function addCarrito(elemento) {
            event.preventDefault(); // previene que la página se mueva hacia arriba al hacer clic en el botón
            const producto = JSON.parse(elemento.dataset.info);
            const presentacionNombre = elemento.dataset.id;

            // Verificar si el stock del producto está agotado
            if (producto.stock == "0") {
                $('#productoAgotado').modal('show');
                return;
            }

            // Verificar si el producto ya está en el carrito
            const productoExistente = carrito.find(item => item.id === producto.id);
            if (productoExistente) {
                $('#productoExistente').modal('show');
                return;
            }

            // Agregar el producto al array carrito
            carrito.push({
                id: producto.id,
                nombre: producto.nombre,
                concentracion: producto.concentracion,
                adicional: producto.adicional,
                precio: producto.precio,
                stock: producto.stock,
                imagen: producto.imagen,
                producto_lab: producto.producto_lab,
                producto_tipo: producto.producto_tipo,
                producto_pre: producto.producto_pre,
                nombre_pre: producto.nombre_pre,
                nombre_lab: producto.nombre_lab,
                nombre_tipo: producto.nombre_tipo
            });

            // Guardar el carrito en localStorage
            localStorage.setItem('carrito', JSON.stringify(carrito));

            // Actualizar el contador de productos
            $('#contador').empty();
            $('#contador').append(carrito.length);

            // Mostrar el producto en la tabla de la vista
            $('#cestaProductos').append("<tr data-id='" + producto.id + "'><td><img src='" + producto.imagen +
                "' width='50px'></td><td>" + producto.nombre +
                "</td><td>" + producto.concentracion + "</td><td>" +
                producto.adicional + "</td><td>" + producto.nombre_pre + "</td><td>" + producto
                .precio +
                "€</td><td><button type='button' class='btn btn-danger borrar'><i class='i bi-x-lg'></i></button></td></tr>"
            );
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

            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formularioEliminar.action = "{{ route('borrarProducto', '') }}/" + idProducto;
        }

        function actualizarAccionFormularioLote(addLote) {
            // Obtener el valor del data-id del botón eliminar
            const idProducto = addLote.getAttribute("data-id");

            // Obtener el elemento form por su id
            const formLote = document.getElementById("formLote");

            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formLote.action = "{{ route('addLote', '') }}/" + idProducto;
        }
    </script>

@endsection
