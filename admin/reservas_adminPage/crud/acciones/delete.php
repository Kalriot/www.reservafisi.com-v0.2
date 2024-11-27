<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");

    // Leer el cuerpo de la solicitud JSON
    $json_data = file_get_contents("php://input");
    // Decodificar los datos JSON en un array asociativo
    $data = json_decode($json_data, true);

    // Verificar si los datos se decodificaron correctamente
    if ($data !== null) {
        $id = $data['id'];
        $avatarName = $data['avatar'];

        $sql = "DELETE FROM events WHERE id_reserva=$id";
        if ($conexion->query($sql) === TRUE) {
            // Eliminar el archivo de imagen si existe
            $dirLocal = "fotos_empleados";
            $filePath = $dirLocal . '/' . $avatarName;
            if (file_exists($filePath)) {
                unlink($filePath); // Eliminar el archivo de imagen
            }
            echo json_encode(array("success" => true, "message" => "Evento eliminado correctamente"));
        } else {
            echo json_encode(array("success" => false, "message" => "El parámetro 'id' no se proporcionó"));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "La acción no se proporcionó"));
    }
}
