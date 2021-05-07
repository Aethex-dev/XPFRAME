<?php

namespace xenonmc\xpframe\core\websockets;

use Exception;
use SplObjectStorage;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class WebSockets implements MessageComponentInterface
{
    /**
     * WebSockets class for controlling and managing WebSockets input and running its server
     */
    public function __construct()
    {
        // Create connection storage
        $this->clients = new SplObjectStorage();
        echo "[ XPFRAME ] WebSockets server started on port [ 2000 ]", PHP_EOL;
    }

    public function onOpen($conn)
    {
        // Add connection to storage
        $this->clients->attach($conn);
    }

    public function onMessage($from, $msg)
    {
        foreach ( $this->clients as $client ) {

            if ( $from->resourceId == $client->resourceId ) {
                continue;
            }

            $client->send( "Client $from->resourceId said $msg" );
            echo "Request Sent updated", PHP_EOL;
        }
    }
    
    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, Exception $e) {
    }
}