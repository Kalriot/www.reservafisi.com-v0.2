<?php

// Incluir o arquivo com a conexão com banco de dados
include_once '../../global/conexion.php';

$datos = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_edit_event = "UPDATE events SET title=:title, color=:color, start=:start, end=:end, obs=:obs WHERE id_reserva=:id_reserva";


$edit_event = $conn->prepare($query_edit_event);

$edit_event->bindParam(':title', $datos['edit_title']);
$edit_event->bindParam(':color', $datos['edit_color']);
$edit_event->bindParam(':start', $datos['edit_start']);
$edit_event->bindParam(':end', $datos['edit_end']);
$edit_event->bindParam(':obs', $datos['edit_obs']);
$edit_event->bindParam(':id_reserva', $datos['edit_id']);

if ($edit_event->execute()){
    $retorna = [
        'status' => true, 
        'msg' => 'Evento editado con éxito ✅', 
        'id'=> $datos['edit_id'], 
        'title' =>$datos['edit_title'], 
        'color' =>$datos['edit_color'], 
        'start' =>$datos['edit_start'], 
        'end' =>$datos['edit_end'], 
        'obs' =>$datos['edit_obs']];
} else {
     $retorna = ['status' => false, 'msg' => 'Error: evento no editado ❌'];
}

try {
    if ($edit_event->execute()) {
        $retorna = [
            'status' => true,
            'msg' => 'Evento editado con éxito ✅',
            'id' => $datos['edit_id'],
            'title' => $datos['edit_title'],
            'color' => $datos['edit_color'],
            'start' => $datos['edit_start'],
            'end' => $datos['edit_end'],
            'obs' => $datos['edit_obs']
        ];
    } else {
        $retorna = ['status' => false, 'msg' => 'Error: evento no editado ❌'];
    }
} catch (Exception $e) {
    $retorna = ['status' => false, 'msg' => 'Error de ejecución: ' . $e->getMessage()];
}

echo json_encode($retorna);