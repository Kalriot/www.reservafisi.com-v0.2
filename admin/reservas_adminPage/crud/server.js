const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const bodyParser = require('body-parser');

const app = express();
const server = http.createServer(app);

const io = new Server(server, {
    cors: {
        origin: "http://localhost", // Permite solicitudes desde http://localhost
        methods: ["GET", "POST"], // Métodos permitidos
    },
});

// Middleware para procesar JSON
app.use(bodyParser.json());

// Ruta para recibir eventos aprobados desde PHP
app.post('/evento-aprobado', (req, res) => {
    const evento = req.body;
    console.log('Evento aprobado recibido desde PHP:', evento); // Log para depuración

    if (evento.estado === 'aprobada') {
        console.log('Evento aprobado emitido:', evento);
        io.emit('nuevoEvento', evento); // Emitir el evento a los clientes conectados
        res.status(200).json({ status: true, msg: 'Evento emitido a los clientes' });
    } else {
        console.warn('Evento ignorado, no está aprobado:', evento);
        res.status(400).json({ status: false, msg: 'Evento no aprobado' });
    }
});

// Nueva ruta para recibir solicitudes pendientes desde PHP
app.post('/solicitud-pendiente', (req, res) => {
    const evento = req.body;
    console.log('Nueva solicitud recibida desde PHP:', evento); // Log para depuración

    // Emitir el evento a todos los clientes conectados (administradores)
    io.emit('nuevaSolicitud', evento);
    res.status(200).json({ status: true, msg: 'Solicitud emitida a los administradores' });
});

// Manejo de conexión de WebSocket
io.on('connection', (socket) => {
    console.log('Cliente conectado:', socket.id);

    // Escuchar solicitudes de reserva (en tiempo real desde los clientes, si es necesario)
    socket.on('solicitudReserva', (evento) => {
        console.log('Nueva solicitud de reserva recibida desde cliente:', evento);

        // Emitir la solicitud de reserva a los administradores
        io.emit('nuevaSolicitud', evento);
    });

    socket.on('disconnect', () => {
        console.log('Cliente desconectado:', socket.id);
    });
});

// Servidor escuchando en el puerto 3000
server.listen(3000, () => {
    console.log('Servidor WebSocket escuchando en http://localhost:3000');
});
