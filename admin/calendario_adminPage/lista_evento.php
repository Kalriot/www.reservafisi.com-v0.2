<?php

// Incluir o arquivo com a conexão com banco de dados
include_once '../../global/conexion.php';

// QUERY para recuperar os eventos
$query_events = "SELECT id_reserva, usuario, title, color, start, end, obs FROM events where estado = 'aprobada'";

// Prepara a QUERY
$result_events = $conn->prepare($query_events);

// Executar a QUERY
$result_events->execute();

// Criar o array que recebe os eventos
$eventos = [];

// Percorrer a lista de registros retornado do banco de dados
while($row_events = $result_events->fetch(PDO::FETCH_ASSOC)){

    // Extrair o array
    extract($row_events);

    $eventos[] = [
        'id' => $id_reserva,
        'title' => $title,
        'color' => $color,
        'start' => $start,
        'end'=> $end,
        'usuario'=> $usuario,
        'obs'=> $obs,
    ];
}

echo json_encode($eventos);