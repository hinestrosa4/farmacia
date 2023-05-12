@section('title', 'Tramitar compra')
@extends('layouts.base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/2e015df9b7.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/checkModal.css') }}">
<link rel="stylesheet" href="{{ asset('css/errorModal.css') }}">
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

    .cantidad {
        border-radius: 10px;
    }
</style>

@section('menu')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mr-6">
                    <div class="col-sm-6">
                        <h1>Tramitar compra</h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('listaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Tramitar compra</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="text-center mb-2">
            <img src="{{ asset('img/logo.png') }}" style="width:80px" alt="">
        </section>
        <div class="text-center"
            style="background-color: rgb(205, 205, 205); border-top:#6aa259 3px solid;border-bottom:#6aa259 3px solid; color:rgb(82, 160, 82)">
            <span class="mt-5" style="font-size: 28px">Solicitud de compra</span>
        </div>
        <section class="ml-4 mr-4 mt-3 mb-4">
            <div class="row mb-2">
                <div class="col-md-3 align-self-center">
                    <label for="cliente" style="color:#4d7342">Cliente</label>
                </div>
                <div class="col-md-9">
                    <input style="width: 80%" type="text" class="form-control" id="cliente"
                        placeholder="Introduzca el cliente">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 align-self-center">
                    <label for="vendedor" style="color:#4d7342">Vendedor</label>
                </div>
                <div class="col-md-9">
                    <input id="vendedor" readonly style="width: 80%" type="text" class="form-control"
                        value="{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}">
                </div>
            </div>

        </section>
        <section>
            <a id="actualizar" style="width: 100%" class="btn btn-warning mt-2">Actualizar productos</a>
            <table id="tablaProductos" class="table">

            </table>
            <style>
                body {
                    overflow-x: hidden;
                }
            </style>
            <!-- Modal Error -->
            <div id="myModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center">
                            <div class="icon-box">
                                <i class="material-icons">&#xE5CD;</i>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <h4>Ooops!</h4>
                            <p>Parece que el código no es válido o ya ha sido utilizado</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Success -->
            <div id="success_tic" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <a class="close" href="#" data-dismiss="modal">&times;</a>
                        <div class="page-body">
                            <div class="head">
                                <h4>El descuento ha sido aplicado correctamente</h4>
                            </div><br>
                            <h1 style="text-align:center;">
                                <div class="checkmark-circle">
                                    <div class="background"></div>
                                    <div class="checkmark draw"></div>
                                </div>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cards --}}

            <div class="d-flex flex-wrap">
                {{-- Precio de venta --}}
                <div id="ventaCard" style="display: none" class="col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Precio de venta</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-2 p-4" style="background-color:#f8cb46; border-radius:8px">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('img/tag.png') }}" style="width: 50px" alt="">
                                    </div>
                                    <div class="col mx-4">
                                        <span class="card-text">SIN IVA: </span><br>
                                        <b><span class="sinIVA"></span></b>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 p-4" style="background-color:#f8cb46; border-radius:8px">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('img/tag.png') }}" style="width: 50px" alt="">
                                    </div>
                                    <div class="col mx-4">
                                        <span class="card-text">IVA: </span><br>
                                        <b><span class="conIVA">21%</span></b>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 p-4" style="background-color: rgb(137, 255, 202); border-radius:8px">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('img/tageuro.png') }}" style="width: 50px" alt="">
                                    </div>
                                    <div class="col mx-4">
                                        <span class="card-text">Precio total: </span><br>
                                        <b><span class="total"></span></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('listaProductos') }}" class="btn btn-primary" style="width:100%">Seguir
                                comprando</a>
                        </div>
                    </div>
                </div>
                {{-- Descuento --}}
                <div id="descuentoCard" style="display: none" class="col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Descuento</h4>
                        </div>
                        <div class="card-body">
                            <div class="p-2 mb-2" style="background-color:rgb(241, 124, 124);border-radius:8px">
                                <p class="card-text"><b>Código de descuento</b></p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="descuento" placeholder="Código"
                                            onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-warning"
                                            id="descuento-btn">Descuento</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 p-4"
                                style="background-color:#f8cb46; border-radius:8px;background-color:rgb(165, 249, 154);border-radius:8px;display:none"
                                id="descuentoOculto">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('img/descuento.png') }}" style="width: 90px" alt="">
                                    </div>
                                    <div class="col">
                                        <img src="{{ asset('img/aplicado.png') }}" style="width: 90px" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 p-4" style="background-color: rgb(137, 255, 202); border-radius:8px">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('img/tageuro.png') }}" style="width: 50px" alt="">
                                    </div>
                                    <div class="col mx-4">
                                        <span class="card-text">Total: </span><br>
                                        <b> <span class="totalDescuento"></span>
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Metodo de pago --}}
                <div id="metodoPago" style="display: none" class="col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Método de pago</h4>
                        </div>
                        <div class="card-body">
                            <a href="#" id="metodoPagoEfectivo" class="btn btn-success mb-2" style="width:100%"><i
                                    class="bi bi-cash"></i> Efectivo</a>
                            <a href="#" id="metodoPagoPayPal" class="btn btn-primary" style="width:100%"><i
                                    class="bi bi-paypal"></i> PayPal</a>
                        </div>
                    </div>
                </div>
                {{-- Efectivo --}}
                <div id="efectivo" class="col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Efectivo</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-2 p-4" style="background-color: rgb(124, 215, 122); border-radius:8px">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('img/billete.png') }}" style="width: 50px" alt="">
                                    </div>
                                    <div class="col mx-4">
                                        <span class="card-text">Ingreso: </span><br>
                                        <input min="0" pattern="^[0-9]+" value="0" type="number"
                                            style="width:100%" class="form-control" id="ingreso"
                                            placeholder="Ingreso">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 p-4" style="background-color: rgb(137, 255, 202); border-radius:8px">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('img/cajaReg.png') }}" style="width: 50px" alt="">
                                    </div>
                                    <div class="col mx-4">
                                        <span class="card-text">Cambio: </span><br>
                                        <b> <span id="cambio">0€</span>
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="imprimirRecibo" class="btn btn-success mb-2" style="width:100%"
                                onclick="pasarVenta()">Realizar
                                compra</button>
                            <a href="#" id="cambiarMetodoPago" class="btn btn-primary" style="width:100%">Cambiar
                                método de pago</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Imprimir recibo -->
        <div class="modal fade" id="imprimirReciboModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-green">
                        <h5 class="modal-title" id="exampleModalLabel">Recibo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Deseas imprimir el recibo?
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('listaProductos') }}" class="btn btn-danger text-white">No</a>
                        <form id="formEnviar" action="{{ route('createVenta', '') }}" method="POST">
                            @csrf
                            <input type="hidden" name="venta" id="venta">
                            <button type="submit" class="btn btn-success text-white" onclick="abrirPDF()">Si</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Error -->
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <h5 class="modal-title" id="errorModalLabel">Conflicto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Debes rellenar el nombre del cliente
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary text-white" data-dismiss="modal">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let venta = []
        let producto = []
        let ventaS = ""

        function abrirPDF() {

            // Redirigir a la ruta del PDF en una nueva pestaña
            // window.open("{{ route('generatePDF', '') }}/" + 2, '_blank');

            carrito = []
            localStorage.setItem('carrito', JSON.stringify(carrito));

            // Redirigir a la página de listaProducto
            window.location.href = "{{ route('listaProductos') }}";
        }

        function generarCodigoTicket() {
            var caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            var longitudCodigo = 8;
            var codigo = "";
            for (var i = 0; i < longitudCodigo; i++) {
                codigo += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
            }
            return codigo;
        }

        function pasarVenta() {
            venta = []
            producto = []
            ventaS = ""
            generateVenta();

            console.log("producto: " + venta);

            var formEnviar = document.getElementById("formEnviar")
            // Actualizar la acción del formulario con la ruta correcta que contenga el data-id
            formEnviar.action = "{{ route('createVenta', '') }}/" + ventaS;
        }

        function generateVenta() {
            for (var i = 0; i < carrito.length; i++) {
                producto.push([
                    [carrito[i].nombre],
                    [carrito[i].adicional],
                    [carrito[i].nombre_pre],
                    [carrito[i].cantidad],
                    [carrito[i].precio],
                ])
            }
            console.log(carrito);
            console.log(producto);

            // console.log(producto);
            var now = new Date();
            var timezoneOffset = now.getTimezoneOffset() * 60000; // convierte la diferencia horaria a milisegundos
            var fechaHoraEspaña = new Date(now - timezoneOffset).toLocaleString("es-ES", {
                timeZone: "Europe/Madrid"
            });

            // venta.push(generarCodigoTicket())
            venta.push(new Date(fechaHoraEspaña).toISOString());
            venta.push($('#cliente').val())
            venta.push("efectivo")
            venta.push($('.totalDescuento').text())
            venta.push({{ Auth::user()->id }})
            venta.push(producto); // Encierra el array de productos dentro de otro array
            console.log(venta);
            ventaS = JSON.stringify(venta);
        }

        $('#tablaProductos').on('change', '.cantidad', function() {
            const cantidad = $(this).val();
            const index = $(this).closest('tr').data('index');
            carrito[index].cantidad = cantidad;
            // console.log(carrito);
        });

        $('#cliente').on('change', function() {
            for (let i = 0; i < carrito.length; i++) {
                if (!carrito[i].cantidad) {
                    carrito[i].cantidad = 1;
                }
            }
            console.log(carrito);
        });

        $("#imprimirRecibo").click(function() {
            if ($('#cliente').val() == "")
                $('#errorModal').modal('show')
            else
                $('#imprimirReciboModal').modal('show')
        })

        // DESCUENTO
        // Array de códigos de descuento
        var codigosDescuento = ["FARMALIZE", "VACTOR", "PRIME", "HSN", "AA"];
        var c = 0
        // Capturamos el evento del botón de descuento
        $("#descuento-btn").click(function() {
            // Obtenemos el valor del input
            var codigoIntroducido = $("#descuento").val();
            // console.log(codigoIntroducido);
            // Verificamos si el código introducido está en el array
            if (codigosDescuento.includes(codigoIntroducido) && c == 0) {
                // Si está en el array, mostramos el modal de éxito
                c++;
                $('.totalDescuento').text((parseFloat($('.totalDescuento').text()) - (parseFloat($(
                    '.totalDescuento').text()) * 0.1)).toFixed(2) + '€');
                $('#descuentoOculto').show('slow')
                $("#success_tic").modal("show");
                $('#ingreso').val('0');
                $('#cambio').text('0€');
                $("#imprimirRecibo").attr('disabled', true);
            } else {
                // Si no está en el array, mostramos el modal de error
                $("#myModal").modal("show");
            }
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

        $(document).ready(function() {
            $('#ventaCard').show('slow')
            $('#descuentoCard').show('slow')
            $('#metodoPago').show('slow')

            //añadir
            // Declarar variable global para el carrito

            $("#imprimirRecibo").attr('disabled', true);

            $("#actualizar").click(function() {
                actualizartabla()
                actualizar()
            })

            $("#metodoPagoEfectivo").click(function() {
                event.preventDefault(); // Evita la acción por defecto
                $("#metodoPago").hide();
                $("#efectivo").show('slow');
            });

            $("#cambiarMetodoPago").click(function() {
                event.preventDefault(); // Evita la acción por defecto
                $("#efectivo").hide();
                $("#metodoPago").show('slow');
            });


        })

        actualizar()
        actualizartabla()

        function actualizartabla() {
            carrito = JSON.parse(localStorage.getItem("carrito"));

            $('#contador').empty()
            $('#contador').append(carrito.length)

            $('#tablaProductos').empty()

            $('#tablaProductos').append(
                "<tr style='background-color: #E5F5DF'><th>Stock</th><th>Nombre</th><th>Concentración</th><th>Adicional</th><th>Presentación</th><th>Cantidad</th><th>Precio</th></tr>"
            )

            for (let i = 0; i < carrito.length; i++) {
                const producto = carrito[i];
                // console.log(producto);
                const index = i;

                $('#tablaProductos').append(
                    "<tr style='background-color:#EEF3EC' data-index='" +
                    index + "'><td>" + producto.stock + "</td><td>" + producto.nombre +
                    "</td><td>" + producto.concentracion + "</td><td>" +
                    producto.adicional + "</td><td>" + producto.nombre_pre +
                    "</td><td><input onkeypress='return (event.charCode >= 48 && event.charCode <= 57)' min='1' pattern='^[0-9]+' class='text-center cantidad' style='width:80px; border:none; background-color:white;' type='number' value='1' data-precio='" +
                    producto.precio + "'></td><td class='precio-total'>" +
                    producto.precio +
                    "€</td></tr>"
                );
            }
        }

        function actualizar() {
            $(document).ready(function() {
                $('#metodoPago').show('slow')
                $('#efectivo').hide()
                $('#descuentoOculto').hide()
                $('#descuento').val("")
                c = 0
                // Cargar el carrito desde el almacenamiento local
                if (localStorage.getItem("carrito")) {
                    carrito = JSON.parse(localStorage.getItem("carrito"));

                    $('#contador').empty()
                    $('#contador').append(carrito.length)

                    let total = 0;
                    for (let i = 0; i < carrito.length; i++) {
                        const producto = carrito[i];
                        const cantidad = parseInt($('#tablaProductos tr[data-index="' + i + '"] input')
                            .val());
                        total += producto.precio * cantidad;
                        console.log(cantidad);
                    }
                    $('.sinIVA').text((total / 1.21).toFixed(2) + '€');
                    $('.total').text(total.toFixed(2) + '€');
                    $('.totalDescuento').text(total.toFixed(2) + '€');

                    console.log(total);

                    // Actualizar precio total cada vez que se cambie la cantidad
                    $('#tablaProductos').on('change', '.cantidad', function() {
                        const cantidad = $(this).val();
                        const precioUnitario = $(this).data('precio');
                        const precioTotal = cantidad * precioUnitario;
                        $(this).closest('tr').find('.precio-total').text(precioTotal.toFixed(2) +
                            '€');
                        let total = 0;
                        for (let i = 0; i < carrito.length; i++) {
                            const producto = carrito[i];
                            const cantidad = parseInt($('#tablaProductos tr[data-index="' + i +
                                    '"] input')
                                .val());
                            total += producto.precio * cantidad;
                        }
                        $('#ingreso').val('');
                        $('#cambio').text('0€');
                        $('.sinIVA').text((total / 1.21).toFixed(2) + '€');
                        $('.total').text(total.toFixed(2) + '€');
                        if (c == 0)
                            $('.totalDescuento').text(total.toFixed(2) + '€');
                        else
                            $('.totalDescuento').text((parseFloat($('.total').text()) - ((
                                parseFloat($(
                                        '.total')
                                    .text())) * 0.1)).toFixed(2) + '€');

                        console.log(total);
                    });

                    $('#ingreso').on('change', function() {
                        // console.log((parseFloat($('.totalDescuento').text())) - (parseFloat($('#ingreso').val())));
                        $('#cambio').text(((parseFloat($('#ingreso').val())) - (parseFloat($(
                                '.totalDescuento')
                            .text()))).toFixed(2) + '€');
                        if ($('#ingreso').val() == "" || $('#ingreso').val() <= parseFloat($(
                                    '.totalDescuento')
                                .text())) {
                            $('#cambio').text("0€")
                        }

                        if ($('#cambio').text() == "0€")
                            $("#imprimirRecibo").attr('disabled', true);
                        else
                            $("#imprimirRecibo").attr('disabled', false);
                    });
                }
            });
        }
    </script>
@endsection
