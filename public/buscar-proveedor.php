<?php
// Conectar a la base de datos
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Carga el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$conexion = mysqli_connect(
    $_ENV['DB_HOST'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD'],
    $_ENV['DB_DATABASE'],
    $_ENV['DB_PORT']
);
// Verificar si la solicitud POST está configurada correctamente
if (isset($_POST['funcion']) && isset($_POST['consulta'])) {
    $funcion = $_POST['funcion'];
    $consulta = $_POST['consulta'];

    if ($consulta == "todos") { // Si la consulta es "todos", selecciona todos los clientes
        $query = "SELECT * FROM proveedor WHERE deleted_at IS NULL";
    } else { // Si no, busca por nombres de usuario que contengan la consulta
        $query = "SELECT * FROM proveedor WHERE nombre LIKE '%" . $consulta . "%' AND deleted_at IS NULL";
    }

    $result = mysqli_query($conexion, $query);

    // Mostrar los resultados en formato JSON
    if ($result) {
        $filas = array();
        while ($fila = mysqli_fetch_array($result)) {
            $filas[] = $fila;
        }
        echo json_encode($filas);
    } else {
        echo json_encode(array("error" => "No se encontraron resultados"));
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
