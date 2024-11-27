<?php
// Incluir la conexión a la base de datos
include '../config/config.php';

// Leer los datos enviados en el cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

// Verificar que se haya recibido un ID y un estado
if (!isset($data['id']) || !isset($data['estado'])) {
    echo json_encode(['status' => false, 'msg' => 'Datos incompletos para actualizar la reserva.']);
    exit;
}

$idReserva = $data['id'];
$estado = $data['estado'];

// Actualizar el estado de la reserva en la base de datos
$query = "UPDATE events SET estado = ? WHERE id_reserva = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("si", $estado, $idReserva);

if ($stmt->execute()) {
    // Recuperar los datos del evento aprobado
    $queryEvento = "SELECT id_reserva AS id, estado, title, start, end, color, usuario, obs FROM events WHERE id_reserva = ?";
    $stmtEvento = $conexion->prepare($queryEvento);
    $stmtEvento->bind_param("i", $idReserva);
    $stmtEvento->execute();
    $resultadoEvento = $stmtEvento->get_result();

    if ($resultadoEvento->num_rows > 0) {
        $evento = $resultadoEvento->fetch_assoc();
    
        // Depuración: Verifica que el atributo 'estado' esté presente
        error_log("Evento recuperado: " . json_encode($evento)); // Esto escribirá en el log de PHP
    
        // Notificar al servidor WebSocket usando CURL
        $ch = curl_init('http://localhost:3000/evento-aprobado'); // URL del servidor WebSocket
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($evento));
    
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        curl_close($ch);
    
        if ($httpCode === 200) {
            echo json_encode(['status' => true, 'msg' => 'Reserva aprobada exitosamente.', 'evento' => $evento]);
        } else {
            echo json_encode(['status' => false, 'msg' => 'Error al notificar al servidor WebSocket.', 'evento' => $evento]);
        }
    }
} else {
    echo json_encode(['status' => false, 'msg' => 'Error al actualizar la reserva.']);
}
