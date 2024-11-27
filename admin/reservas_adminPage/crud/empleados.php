<div class="table-responsive">
    <table class="table table-hover" id="table_eventos">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Usuario</th>
                <th scope="col">Título</th>
                <th scope="col">Hora de inicio</th>
                <th scope="col">Hora de finalización</th>
                <th scope="col">Avatar</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Se asume que $usuarios es un array con los datos de los usuarios
            $usuariosAvatares = [];
            foreach ($usuarios as $usuario) {
                $usuariosAvatares[$usuario['nombre_completo']] = $usuario['avatar']; // Relación nombre_completo => avatar
            }

            // Se asume que $eventos es un array con los datos de los eventos
            foreach ($eventos as $evento) {
                $startDateTime = date("Y-m-d h:i A", strtotime($evento['start'])); // Formato deseado para 'start'
                $endDateTime = date("Y-m-d h:i A", strtotime($evento['end']));
            ?>
                <tr id="evento_<?php echo $evento['id_reserva']; ?>">
                    <th scope='row'><?php echo $evento['id_reserva']; ?></th>
                    <td><?php echo $evento['usuario']; ?></td>
                    <td> <?php echo $evento['title']; ?></td>
                    <td><?php echo $startDateTime; ?></td>
                    <td><?php echo $endDateTime; ?></td>
                    <td>
                        <?php
                        $avatar = isset($usuariosAvatares[$evento['usuario']]) ? $usuariosAvatares[$evento['usuario']] : ''; // Buscar avatar según nombre_completo
                        if (empty($avatar)) {
                            $avatar = 'crud/assets/imgs/ying_yang.png'; // Placeholder si no tiene avatar
                        } else {
                            $avatar = "crud/acciones/fotos_empleados/" . $avatar; // Ruta al avatar si existe
                        }
                        ?>
                        <img class="rounded-circle" src="<?php echo $avatar; ?>" alt="<?php echo $evento['title']; ?>" width="50" height="50">
                    </td>
                    <td>
                        <a title="Ver detalles de la reserva" href="#" onclick="verDetallesEvento(<?php echo $evento['id_reserva']; ?>)" class="btn btn-warning">
                            <i class="bi bi-info-circle"></i>
                        </a>
                        <a title="Aprobar reserva" href="#" onclick="aceptarReserva(<?php echo $evento['id_reserva']; ?>)" class="btn btn-success">
                            <i class="bi bi-calendar2-check"></i>
                        </a>
                        <a title="Denegar Reserva" href="#" onclick="eliminarEvento(<?php echo $evento['id_reserva']; ?>, '<?php echo $avatar; ?>')" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.socket.io/4.5.0/socket.io.min.js"></script>
<script>
    // Configurar DataTable
    const table = new DataTable('#table_eventos', {
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        }
    });

    // Conectar a WebSocket
    const socket = io('http://localhost:3000');

    socket.on('connect', () => {
        console.log('Conectado al servidor WebSocket');
    });

    // Escuchar nuevas solicitudes de reserva
    socket.on('nuevaSolicitud', (evento) => {
        console.log('Nueva solicitud recibida:', evento);

        // Agregar fila a la tabla con DataTables
        table.row.add([ 
            evento.id,
            evento.usuario,
            evento.title,
            new Date(evento.start).toLocaleString(),
            new Date(evento.end).toLocaleString(),
            `<img class="rounded-circle" src="crud/assets/imgs/ying_yang.png" alt="${evento.title}" width="50" height="50">`,
            `
            <a title="Ver detalles de la reserva" href="#" onclick="verDetallesEvento(${evento.id})" class="btn btn-warning">
                <i class="bi bi-info-circle"></i>
            </a>
            <a title="Aprobar reserva" href="#" onclick="aceptarReserva(${evento.id})" class="btn btn-success">
                <i class="bi bi-calendar2-check"></i>
            </a>
            <a title="Denegar Reserva" href="#" onclick="eliminarEvento(${evento.id})" class="btn btn-danger">
                <i class="bi bi-trash"></i>
            </a>
            `
        ]).draw(false); // Dibujar la tabla sin recargar
    });

    socket.on('disconnect', () => {
        console.log('Desconectado del servidor WebSocket');
    });

    // Función para aceptar una reserva
    function aceptarReserva(id) {
        console.log(`Reserva aceptada: ${id}`);
        // Aquí puedes realizar una solicitud al backend para actualizar la base de datos
    }

    // Función para ver detalles de una reserva
    function verDetallesEvento(id) {
        console.log(`Ver detalles del evento: ${id}`);
        // Aquí puedes mostrar un modal con los detalles del evento
    }
</script>