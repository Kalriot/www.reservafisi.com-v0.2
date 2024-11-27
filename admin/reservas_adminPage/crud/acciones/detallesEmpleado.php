<?php
require_once("../config/config.php");

// Obtener el parámetro 'id_reserva' desde la URL
$id_reserva = intval($_GET['id']); // Asegurarse de que sea un número para evitar inyecciones SQL

// Consultar la base de datos para obtener los detalles del evento
$sql = "SELECT * FROM events WHERE id_reserva = $id_reserva LIMIT 1";
$query = $conexion->query($sql);

// Verificar si la consulta fue exitosa
if ($query && $query->num_rows > 0) {
    $evento = $query->fetch_assoc(); // Obtener los datos del evento como array asociativo
} else {
    // Si no se encuentra el registro, devolver un mensaje de error
    http_response_code(404);
    echo json_encode(['error' => 'Evento no encontrado']);
    exit;
}

// Devolver los detalles del evento como un objeto JSON
header('Content-type: application/json; charset=utf-8');
echo json_encode($evento);
exit;
?>