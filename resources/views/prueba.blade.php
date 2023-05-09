@section('title', 'Gestión de Ventas')
@extends('layouts.base')

<head>
    <title>Ejemplo de DataTable</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>

@section('menu')

    <body>

        <table id="tablaProductos" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Producto 1</td>
                    <td>10.99</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Producto 2</td>
                    <td>15.99</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Producto 3</td>
                    <td>20.99</td>
                </tr>
            </tbody>
        </table>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#tablaProductos').DataTable();
            });
        </script>

    </body>

    </html>
@endsection
