@section('title', 'Detalles del Producto')
@extends('layouts.base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<script>
    $(document).ready(function() {
        $('select').select2();
    });
</script>

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
                <div class="row mb-2 mr-6">
                    <div class="col-sm-6">
                        <h1>Detalles del producto</h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('ventaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('listaProductos') }}">Gestión de
                                    productos</a></li>
                            <li class="breadcrumb-item active">Detalles</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 ml-3">
                            <div class="card card-success card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img src="{{ asset($producto->imagen) }}" alt="" class="img-fluid"
                                            width="150px">
                                    </div>
                                    <h3 class="profile-username text-center text-success">{{ $producto->nombre }}
                                    </h3>
                                    <br>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Concentración</b>
                                            <span class="float-right ml-4" style="color:rgb(26, 57, 255)">
                                                {{ $producto->concentracion }}
                                            </span>
                                        </li>

                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Adicional</b><span class="float-right"
                                                style="color:rgb(26, 57, 255)">{{ $producto->adicional }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Laboratorio</b><span class="float-right"
                                                style="color:rgb(26, 57, 255)">{{ $producto->laboratorio->nombre }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Tipo</b><span class="float-right"
                                                style="color:rgb(26, 57, 255)">{{ $producto->tipo->nombre }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Presentación</b><span class="float-right"
                                                style="color:rgb(26, 57, 255)">{{ $producto->presentacion->nombre }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Precio</b><span class="float-right"
                                                style="color:rgb(26, 57, 255)">{{ $producto->precio }}€</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Descuento</b><span class="float-right"
                                                style="color:rgb(26, 57, 255)">
                                                @if ($producto->descuento == null)
                                                    Sin descuento
                                                @else
                                                    {{ $producto->descuento }}%
                                                @endif
                                            </span>
                                        </li>
                                    </ul>
                                    <button class="btn btn-block bg-gradient-danger" id="editarBtn">Editar</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Editar datos del producto</h3>
                                </div>

                                <div class="card-body">
                                    <div class="card-body">
                                        @if (session()->has('message'))
                                            <div class="text-center alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <form action="{{ route('detallesProductoUpdate', $producto->id) }}" method="POST"
                                            class="row g-3 needs-validation">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Nombre</label>
                                                <input type="text" name="nombre" class="form-control" id="nombre"
                                                    placeholder="Nombre" value="{{ old('nombre') }}">
                                                {!! $errors->first('nombre', '<span style=color:red>:message</span>') !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Concentración</label>
                                                <input type="text" name="concentracion" class="form-control"
                                                    id="concentracion" placeholder="Concentracion (500mg)"
                                                    value="{{ old('concentracion') }}">
                                                {!! $errors->first('concentracion', '<span style=color:red>:message</span>') !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Adicional</label>
                                                <input type="number" name="adicional" class="form-control" id="adicional"
                                                    placeholder="Adicional" value="{{ old('adicional') }}">
                                                {!! $errors->first('adicional', '<span style=color:red>:message</span>') !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Precio</label>
                                                <input type="number" step="0.01" name="precio" class="form-control"
                                                    id="precio" placeholder="Precio" value="{{ old('precio') }}">
                                                {!! $errors->first('precio', '<span style=color:red>:message</span>') !!}
                                            </div>

                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Descuento</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label mr-4" for="flexRadioDefault1">
                                                        Si
                                                    </label>

                                                    <input class="form-check-input ml-2" type="radio"
                                                        name="flexRadioDefault" id="flexRadioDefault2"
                                                        onclick="borrarDescuento()">
                                                    <label class="form-check-label ml-4" for="flexRadioDefault2">
                                                        No
                                                    </label>
                                                </div>

                                                <div id="inputDescuento" style="display: none;width:100%">
                                                    <input type="number" name="descuento" class="form-control"
                                                        id="descuento" value="{{ old('descuento') }}"
                                                        placeholder="Descuento (sin %)">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Laboratorio</label>
                                                <select class="form-control" name="producto_lab" id="laboratorio">
                                                    @foreach ($laboratorios as $laboratorio)
                                                        <option value="{{ $laboratorio->id }}"
                                                            {{ old('producto_lab') == $laboratorio->id ? 'selected' : '' }}>
                                                            {{ $laboratorio->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Tipo</label>
                                                <select class="form-control" name="producto_tipo"
                                                    data-placeholder="Selecciona un tipo" id="tipo">
                                                    @foreach ($tipos as $tipo)
                                                        <option value={{ $tipo->id }}
                                                            {{ old('tipo') == $tipo->nombre ? 'selected' : '' }}>
                                                            {{ $tipo->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Presentación</label>
                                                <select class="form-control" name="producto_pre" id="presentacion"
                                                    data-placeholder="Selecciona una presentacion">
                                                    @foreach ($presentaciones as $presentacion)
                                                        <option value={{ $presentacion->id }}
                                                            {{ old('presentacion') == $presentacion->nombre ? 'selected' : '' }}>
                                                            {{ $presentacion->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <button class="btn btn-success" type="submit">Modificar datos</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Pasar datos al formulario cuando pulsa editar --}}
    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('select').select2();
            $('input[type="radio"]').change(function() {
                if ($(this).attr('id') === 'flexRadioDefault1') {
                    $('#inputDescuento').slideDown('slow');
                } else {
                    $('#inputDescuento').slideUp('slow');
                }
            });
        });
    </script>
    <script>
        var nombre = "{{ $producto->nombre }}";
        var concentracion = "{{ $producto->concentracion }}";
        var adicional = "{{ $producto->adicional }}";
        var precio = "{{ $producto->precio }}";
        var laboratorio = "{{ $producto->producto_lab }}";
        var tipo = "{{ $producto->producto_tipo }}";
        var presentacion = "{{ $producto->producto_pre }}";
        var descuento = "{{ $producto->descuento }}";

        // Agregar listener al botón de "Editar"
        $('#editarBtn').click(function() {
            // Establecer los valores de los inputs y radio buttons
            $('#nombre').val(nombre);
            $('#concentracion').val(concentracion);
            $('#adicional').val(adicional);
            $('#precio').val(precio);
            $('#laboratorio').val(laboratorio);
            $('#tipo').val(tipo);
            $('#presentacion').val(presentacion);
            $('#descuento').val(descuento);
        });

        function borrarDescuento() {
            $('#descuento').val("");
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
                $('#cestaProductos').append("<tr data-id='" + carrito[i].id + "'><td><img src='../" + carrito[i].imagen +
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
