<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "farmacia");

// Obtener el ID del evento a eliminar
$id = $_POST["id"];

// Escribir la consulta SQL de eliminación
$sql = "DELETE FROM calendario WHERE id='$id'";

// Ejecutar la consulta SQL
if (mysqli_query($conexion, $sql)) {
  echo json_encode(array("success" => true));
} else {
  echo json_encode(array("success" => false, "error" => mysqli_error($conexion)));
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
