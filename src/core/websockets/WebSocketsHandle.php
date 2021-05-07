<?php

namespace xenonmc\xpframe\core\websockets;

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use xenonmc\xpframe\core\websockets\WebSockets;

class WebSocketsHandle
{
    /**
     * WebSockets class for controlling and managing WebSockets input and running its server
     */
    public function __construct()
    {
        // Start the server
        $this->server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSockets()
                )
            ),
            2000
        );

        $this->server->run();
    }
}