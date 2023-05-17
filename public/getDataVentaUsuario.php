<?php
// Conectar a la base de datos
$host = 'localhost';
$dbname = 'farmacia';
$user = 'root';
$password = '';

// $host = 'localhost';
// $dbname = 'rafaelhinestrosa';
// $user = 'rafaelhinestrosa';
// $password = 'Yv4*1z6c';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
    die();
}

// Consulta a la base de datos
$query = "SELECT u.nombre AS Usuario, COUNT(v.id) AS Ventas
FROM usuario u
LEFT JOIN venta v ON u.id = v.vendedor
WHERE u.deleted_at IS NULL
GROUP BY u.nombre;
";
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
