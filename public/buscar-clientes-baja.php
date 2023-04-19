<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "farmacia");
// $conexion = mysqli_connect("localhost", "rafaelhinestrosa", "Yv4*1z6c", "rafaelhinestrosa");

// Verificar si la solicitud POST está configurada correctamente
if (isset($_POST['funcion']) && isset($_POST['consulta'])) {
    $funcion = $_POST['funcion'];
    $consulta = $_POST['consulta'];
    
    if ($consulta == "todos") { // Si la consulta es "todos", selecciona todos los clientes
        $query = "SELECT * FROM usuario WHERE deleted_at IS NOT NULL";
    } else { // Si no, busca por nombres de usuario que contengan la consulta
        $query = "SELECT * FROM usuario WHERE nombre LIKE '%".$consulta."%' AND deleted_at IS NOT NULL";
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
