<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Conectar a la base de datos
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
    die();
}

// Consulta a la base de datos
$query = "SELECT * FROM calendario";
$resultado = $conexion->query($query);

// Mostrar los resultados en formato JSON
if ($resultado) {
    $filas = array();
    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $filas[] = $fila;
    }
    echo json_encode($filas);
} else {
    echo json_encode(array("error" => "No se encontraron resultados"));
}

// Cerrar la conexión a la base de datos
$conexion = null;
