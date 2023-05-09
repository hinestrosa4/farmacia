@section('title', 'Detalles del Lote')
@extends('layouts.base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                        <h1>Detalles del lote</h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('ventaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('listaProductos') }}">Gestión de lotes</a>
                            </li>
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
                                        <img src="{{ asset($lote->producto->imagen) }}" alt="" class="img-fluid"
                                            width="150px">
                                    </div>
                                    <h3 class="profile-username text-center text-success">
                                        {{ $lote->producto->nombre }}
                                    </h3>
                                    <br>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Stock</b>
                                            <span class="float-right ml-4" style="color:rgb(26, 57, 255)">
                                                {{ $lote->stock }}
                                            </span>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Caducidad</b>
                                            <span class="float-right ml-4" style="color:rgb(26, 57, 255)">
                                                {{ DateTime::createFromFormat('Y-m-d', $lote->vencimiento)->format('d-m-Y') }}
                                            </span>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Producto</b><span class="float-right"
                                                style="color:rgb(26, 57, 255)">{{ $lote->proveedor->nombre }}</span>
                                        </li>
                                    </ul>
                                    <button class="btn btn-block bg-gradient-danger" id="editarBtn">Editar</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Editar datos del lote</h3>
                                </div>

                                <div class="card-body">
                                    <div class="card-body">
                                        @if (session()->has('message'))
                                            <div class="text-center alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <form action="{{ route('editarLoteUpdate', $lote->id) }}" method="POST"
                                            class="row g-3 needs-validation">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-md-4">
                                                <label for="validationCustom02" class="form-label">Stock</label>
                                                <input type="number" name="stock" class="form-control" id="stock"
                                                    value="{{ old('stock') }}" placeholder="Introduzca un stock">
                                                {!! $errors->first('stock', '<span style=color:red>:message</span>') !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom02" class="form-label">Fecha de
                                                    caducidad</label>
                                                <input type="date" name="vencimiento" class="form-control"
                                                    id="vencimiento" value="{{ old('vencimiento') }}"
                                                    placeholder="Introduzca una fecha de vencimiento">
                                                {!! $errors->first('vencimiento', '<span style=color:red>:message</span>') !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Producto</label>
                                                <select class="form-control" name="lote_id_prod" id="lote_id_prod">
                                                    @foreach ($productos as $producto)
                                                        <option value="{{ $producto->id }}"
                                                            {{ old('lote_id_prod') == $producto->id ? 'selected' : '' }}>
                                                            {{ $producto->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Proveedor</label>
                                                <select class="form-control" name="lote_id_prov"
                                                    data-placeholder="Selecciona un tipo" id="lote_id_prov">
                                                    @foreach ($proveedores as $proveedor)
                                                        <option value={{ $proveedor->id }}
                                                            {{ old('lote_id_prov') == $proveedor->nombre ? 'selected' : '' }}>
                                                            {{ $proveedor->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
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

    <script>
        var stock = "{{ $lote->stock }}";
        var vencimiento = "{{ $lote->vencimiento }}";
        var lote_id_prod = "{{ $lote->lote_id_prod }}";
        var lote_id_prov = "{{ $lote->lote_id_prov }}";

        // Agregar listener al botón de "Editar"
        $('#editarBtn').click(function() {
            // Establecer los valores de los inputs y radio buttons
            $('#stock').val(stock);
            $('#vencimiento').val(vencimiento);
            $('#lote_id_prod').val(lote_id_prod);
            $('#lote_id_prov').val(lote_id_prov);
        });


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
