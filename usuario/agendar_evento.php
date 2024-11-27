<?php

// Incluir la conexión con la base de datos
include_once '../global/conexion.php';

session_start();

$datos = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$nombre_completo = $_SESSION['nombre_completo'];

// Agregar estado inicial "pendiente" a la consulta
$query_ag_event = "INSERT INTO events (title, color, start, end, obs, usuario, estado) 
                   VALUES (:title, :color, :start, :end, :obs, :usuario, 'pendiente')";

$ag_event = $conn->prepare($query_ag_event);

$ag_event->bindParam(':title', $datos['ag_title']);
$ag_event->bindParam(':color', $datos['ag_color']);
$ag_event->bindParam(':start', $datos['ag_start']);
$ag_event->bindParam(':end', $datos['ag_end']);
$ag_event->bindParam(':obs', $datos['ag_obs']);
$ag_event->bindParam(':usuario', $nombre_completo);

if ($ag_event->execute()) {
    $idReserva = $conn->lastInsertId(); // Obtener el ID del evento recién creado

    // Crear el evento como un arreglo
    $evento = [
        'id' => $idReserva,
        'title' => $datos['ag_title'],
        'start' => $datos['ag_start'],
        'end' => $datos['ag_end'],
        'color' => $datos['ag_color'],
        'usuario' => $nombre_completo,
        'obs' => $datos['ag_obs'],
        'estado' => 'pendiente' // Estado inicial de la reserva
    ];

    // Notificar al servidor WebSocket usando CURL
    $ch = curl_init('http://localhost:3000/solicitud-pendiente'); // Nueva ruta para solicitudes pendientes
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($evento));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    // Verificar la respuesta del servidor WebSocket
    if ($httpCode === 200) {
        $retorna = [
            'status' => true,
            'msg' => 'Solicitud enviada con éxito 👻',
            'evento' => $evento
        ];
    } else {
        $retorna = [
            'status' => false,
            'msg' => 'Solicitud enviada, pero no se pudo notificar en tiempo real.',
            'evento' => $evento
        ];
    }
} else {
    $retorna = ['status' => false, 'msg' => 'Error: El evento no pudo ser enviado, por favor intente de nuevo'];
}

echo json_encode($retorna);
