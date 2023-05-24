<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "farmacia");

// Obtener los datos enviados por AJAX
$id = $_POST["id"];
$newStart = $_POST["start"];
$newEnd = $_POST["end"];

// Escribir la consulta SQL de actualización
$sql = "UPDATE calendario SET start='$newStart', end='$newEnd' WHERE id='$id'";

// Ejecutar la consulta SQL
if (mysqli_query($conexion, $sql)) {
  echo json_encode(array("success" => true));
} else {
  echo json_encode(array("success" => false, "error" => mysqli_error($conexion)));
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
