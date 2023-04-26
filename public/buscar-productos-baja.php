<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "farmacia");
// $conexion = mysqli_connect("localhost", "rafaelhinestrosa", "Yv4*1z6c", "rafaelhinestrosa");

// Verificar si la solicitud POST está configurada correctamente
if (isset($_POST['funcion']) && isset($_POST['consulta'])) {
    $funcion = $_POST['funcion'];
    $consulta = $_POST['consulta'];
    
    if ($consulta == "todos") { // Si la consulta es "todos", selecciona todos los clientes
        $query = "SELECT p.*, pre.nombre as nombre_pre, lab.nombre as nombre_lab, t.nombre as nombre_tipo FROM producto p
        JOIN presentacion pre on p.producto_pre = pre.id
        JOIN laboratorio lab on p.producto_lab = lab.id
        JOIN tipo_producto t on p.producto_tipo = t.id WHERE p.deleted_at IS NOT NULL GROUP BY p.id";
    } else { // Si no, busca por nombres de usuario que contengan la consulta
        $query = "SELECT p.*, pre.nombre as nombre_pre, lab.nombre as nombre_lab, t.nombre as nombre_tipo FROM producto p
        JOIN presentacion pre on p.producto_pre = pre.id
        JOIN laboratorio lab on p.producto_lab = lab.id
        JOIN tipo_producto t on p.producto_tipo = t.id WHERE p.nombre LIKE '%".$consulta."%' AND p.deleted_at IS NOT NULL GROUP BY p.id";
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
?>
