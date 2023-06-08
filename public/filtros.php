<?php
// Conectar a la base de datos
// $conexion = mysqli_connect("localhost", "root", "", "farmacia");

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
    $filtro = $_POST['filtro'];

    if ($consulta == "filtro") {
        $query = "SELECT * FROM producto";

        if ($filtro != "") {
            $query .= $filtro;
        }
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
