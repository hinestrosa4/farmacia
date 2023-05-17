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
$query = "SELECT m.Mes, COUNT(v.fecha) AS Ventas
FROM (
    SELECT 1 AS Mes UNION ALL
    SELECT 2 AS Mes UNION ALL
    SELECT 3 AS Mes UNION ALL
    SELECT 4 AS Mes UNION ALL
    SELECT 5 AS Mes UNION ALL
    SELECT 6 AS Mes UNION ALL
    SELECT 7 AS Mes UNION ALL
    SELECT 8 AS Mes UNION ALL
    SELECT 9 AS Mes UNION ALL
    SELECT 10 AS Mes UNION ALL
    SELECT 11 AS Mes UNION ALL
    SELECT 12 AS Mes
) AS m
LEFT JOIN venta AS v ON m.Mes = MONTH(v.fecha) AND YEAR(v.fecha) = YEAR(CURDATE())
GROUP BY m.Mes
ORDER BY m.Mes
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
