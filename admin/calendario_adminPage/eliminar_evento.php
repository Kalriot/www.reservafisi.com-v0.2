<?php

// Incluir o arquivo com a conexão com banco de dados
include_once '../../global/conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_elim_event = "DELETE FROM events WHERE id_reserva=:id_reserva";

    $eliminar_event = $conn-> prepare($query_elim_event);

    $eliminar_event->bindParam(':id_reserva', $id);

    if ($eliminar_event->execute()){
        $retorna = ['status' => true, 'msg' => 'Evento eliminado con éxito ✅'];
    }else {
        $retorna = ['status' => false, 'msg' => 'Error: es necesario enviar el id del evento ❌'];
    }

}else {
    $retorna = ['status' => false, 'msg' => 'Error: es necesario enviar el id del evento ❌'];
}

echo json_encode($retorna);
