<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class WebSocketServer extends Command implements MessageComponentInterface
{
    protected $signature = 'websocket:serve'; // Nombre del comando
    protected $description = 'Run WebSocket server'; // Descripción del comando

    protected $clients; // Variable para almacenar las conexiones activas

    public function __construct() {
        parent::__construct();
        $this->clients = new \SplObjectStorage; // Almacena múltiples conexiones
    }

    public function handle() {
        // Iniciar el servidor WebSocket en el puerto 8080
        $server = IoServer::factory(
            new HttpServer(
                new WsServer($this)
            ),
            8080 // El puerto en el que el servidor WebSocket va a correr
        );
        $server->run();
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "Nueva conexión WebSocket ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // Guardar el stream de video en un archivo temporal
        file_put_contents("/tmp/stream-video.webm", $msg, FILE_APPEND);
        
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // Enviar el stream a otros clientes conectados como datos binarios
                $client->send($msg, true); // El segundo parámetro indica que se envían datos binarios
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Conexión WebSocket cerrada ({$conn->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}