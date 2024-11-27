<?php

// Incluir o arquivo com a conexão com banco de dados
include_once '../../global/conexion.php';

session_start();

$datos = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$nombre_completo = $_SESSION['nombre_completo'];

$query_ag_event = "INSERT INTO events (title, color, start, end, obs, usuario) VALUES (:title, :color, :start, :end, :obs, :usuario)";

$ag_event = $conn->prepare($query_ag_event);

$ag_event->bindParam(':title', $datos['ag_title']);
$ag_event->bindParam(':color', $datos['ag_color']);
$ag_event->bindParam(':start', $datos['ag_start']);
$ag_event->bindParam(':end', $datos['ag_end']);
$ag_event->bindParam(':obs', $datos['ag_obs']);
$ag_event->bindParam(':usuario', $nombre_completo);

if ($ag_event->execute()){
    $retorna = [
        'status' => true, 
        'msg' => 'Evento agendado con éxito 👻', 
        'id'=> $conn->lastInsertId(), 
        'title' =>$datos['ag_title'], 
        'color' =>$datos['ag_color'], 
        'start' =>$datos['ag_start'], 
        'end' =>$datos['ag_end'], 
        'obs' =>$datos['ag_obs'],
        'usuario' => $nombre_completo];
}else {
     $retorna = ['status' => false, 'msg' => 'Error: evento no registrado'];
}

echo json_encode($retorna);