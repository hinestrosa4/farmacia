<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Factura</title>
</head>

<body>
    <div class="container text-center">
        <h1 class="">Farmalize</h1>
        <span>C.I.F: A42492611</span><br>
        <span>C/ Andalucía, 4</span><br>
        <span>C.P: 21800 Moguer (Huelva)</span><br>
        <span>628765487</span><br>
        <span>farmalize@gmail.com</span>

        <div class="mt-4">
            <span><b>Factura Ident.: </b>{{ $venta['id'] }}</span><br>
            <span><b>Cliente: </b>{{ $venta['cliente'] }}</span><br>
            {{-- <span><b>Vendedor: </b>{{ $venta['vendedor'] }}</span><br> --}}
            <span><b>Fecha: </b>{{ (new DateTime($venta['fecha']))->format('d/m/Y H:i:s') }}
            </span><br>
            <span><b>Método de Pago: </b>{{ $venta['metodoPago'] }}</span>
        </div>

        <div class="text-center mt-5">
            <table class="table text-center">
                <tr>
                    <th>Producto</th>
                    <th>Adicional</th>
                    <th>Presentación</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
                <?php
                $productos = json_decode($venta['productos'], true);
                ?>
                @foreach ($productos as $producto)
                    <tr>
                        @foreach ($producto as $dato)
                            <td>{{ $dato[0] }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
        <hr>
    </div>

    <div class="mt-2">
        <div class="col">
            <div class="row">
                <span style="margin-left:90px">TOTAL SIN I.V.A.</span>
                <span
                    style="float:right;margin-right:130px">{{ number_format(floatval($venta['total']) / 1.21, 2, '.', '') }}€</span>
            </div>
            <br>
            <div class="row">
                <span style="margin-left:90px">TOTAL</span>
                <span style="float:right;margin-right:130px">{{ $venta['total'] }}</span>
            </div>
        </div>
    </div>
</body>

</html>
