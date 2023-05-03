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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
</style>

@section('menu')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mr-6">
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
        <section>
            <table id="tablaProductos" class="table">
                <tr style="background-color: rgba(40, 158, 40, 0.89)">
                    <th>Nombre</th>
                    <th>Concentración</th>
                    <th>Adicional</th>
                    <th>Presentación</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Eliminar</th>
                </tr>
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


            <div class="row">
                <div class="col">
                    <div class="card text-white bg-primary">
                        <div class="card-header text-center">
                            <h4>Precio de venta</h4>
                        </div>
                        <div class="card-body">
                            <span class="card-text">Precio sin IVA: </span><span class="sinIVA"></span><br>
                            <span class="card-text">IVA: </span><span class="conIVA">21%</span><br>
                            <span class="card-text">Precio total: </span><span class="total"></span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-primary">
                        <div class="card-header text-center">
                            <h4>Descuento</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Código de descuento</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="descuento"
                                        placeholder="Introduzca un código">
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-warning" id="descuento-btn">Descuento</button>
                                </div>
                            </div><br>
                            <span class="card-text">Precio total: </span><span class="totalDescuento"></span>
                        </div>
                    </div>
                </div>

                <script>
                    // Array de códigos de descuento
                    var codigosDescuento = ["aa", "descuento2", "descuento3", "descuento4", "descuento5"];
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
                            $('.totalDescuento').text((parseFloat($('.totalDescuento').text()) - (parseFloat($('.totalDescuento').text()) * 0.05)).toFixed(2) + '€');
                            $("#success_tic").modal("show");
                        } else {
                            // Si no está en el array, mostramos el modal de error
                            $("#myModal").modal("show");
                        }
                    });
                </script>

                <div class="col">
                    <div class="card text-white bg-primary">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h5 class="card-title">Primary card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card's content.</p>
                        </div>
                    </div>
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
                    $('#tablaProductos').append("<tr style='background-color: rgb(126, 235, 126)' data-index='" +
                        index + "'><td>" + producto.nombre +
                        "</td><td>" + producto.concentracion + "</td><td>" +
                        producto.adicional + "</td><td>" + producto.nombre_pre +
                        "</td><td><input min='1' pattern='^[0-9]+' class='text-center cantidad' style='width:80px' type='number' value = '1' data-precio='" +
                        producto.precio + "'></td><td class='precio-total'>" +
                        producto.precio +
                        "€</td><td><button type='button' class='btn btn-danger borrar'><i class='bi bi-x-lg'></i></button></td></tr>"
                    );
                }
                let total = 0;
                for (let i = 0; i < carrito.length; i++) {
                    const producto = carrito[i];
                    const cantidad = parseInt($('#tablaProductos tr[data-index="' + i + '"] input')
                        .val());
                    total += producto.precio * cantidad;
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
                    $(this).closest('tr').find('.precio-total').text(precioTotal.toFixed(2) + '€');
                    let total = 0;
                    for (let i = 0; i < carrito.length; i++) {
                        const producto = carrito[i];
                        const cantidad = parseInt($('#tablaProductos tr[data-index="' + i + '"] input')
                            .val());
                        total += producto.precio * cantidad;
                    }
                    $('.sinIVA').text((total / 1.21).toFixed(2) + '€');
                    $('.total').text(total.toFixed(2) + '€');

                    console.log(total);
                });
            }
        });
    </script>
@endsection
