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

// Paso 2: Obtener los datos enviados por AJAX
$titulo = $_POST["title"];
$className = $_POST["className"];
$start = $_POST['start'];
$end = $_POST['end'];
// $email = $_POST["email"];

// Paso 3: Validar los datos recibidos
// if (empty($nombre) || empty($apellido) || empty($email)) {
//   die("Error: Todos los campos son requeridos");
// }

// Paso 4: Escribir la consulta SQL de inserción
$sql = "INSERT INTO calendario (title, start, end, className) VALUES ('$titulo', '$start', '$end', '$className')";

// Paso 5: Ejecutar la consulta SQL
if (mysqli_query($conexion, $sql)) {
  echo "Registro insertado correctamente";
} else {
  echo "Error al insertar registro: " . mysqli_error($conexion);
}

// Paso 6: Cerrar la conexión a la base de datos
mysqli_close($conexion);
