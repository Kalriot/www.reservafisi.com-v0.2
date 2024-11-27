<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include("../config/config.php");

    // Obtener el ID de empleado de la solicitud GET y asegurarse de que sea un entero
    $IdEvento = (int)$_GET['id_reserva'];

    // Realizar la consulta para obtener los detalles del empleado con el ID proporcionado
    $sql = "SELECT * FROM events WHERE id_reserva = $IdEvento LIMIT 1";
    $resultado = $conexion->query($sql);

    // Verificar si la consulta se ejecutó correctamente
    if (!$resultado) {
        // Manejar el error aquí si la consulta no se ejecuta correctamente
        echo json_encode(["error" => "Error al obtener los detalles de la reserva: " . $conexion->error]);
        exit();
    }

    // Obtener los detalles del empleado como un array asociativo
    $evento = $resultado->fetch_assoc();

    // Devolver los detalles del empleado como un objeto JSON
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($evento);
    exit;
}
