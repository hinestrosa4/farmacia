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

    if ($consulta == "todos") { // Si la consulta es "todos", selecciona todos los lotes
        $query = "SELECT l.*, p.imagen, p.nombre FROM lote l JOIN producto p on lote_id_prod = p.id WHERE l.deleted_at IS NOT NULL ORDER BY p.nombre";
    } else { // Si no, busca por id de lote que contengan la consulta
        $query = "SELECT l.*, p.imagen, p.nombre FROM lote l JOIN producto p on lote_id_prod = p.id WHERE p.nombre LIKE '%" . $consulta . "%' AND l.deleted_at IS NOT NULL ORDER BY p.nombre";
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
