<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "farmacia");
// $conexion = mysqli_connect("localhost", "rafaelhinestrosa", "Yv4*1z6c", "rafaelhinestrosa");

// Verificar si la solicitud POST está configurada correctamente
    
        $query = "SELECT * FROM calendario";

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
