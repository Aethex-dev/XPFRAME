<?php

namespace xenonmc\xpframe\core\cli;

use xenonmc\xpframe\core\websockets\WebSockets;
use xenonmc\xpframe\core\websockets\WebSocketsHandle;

class CLI
{
    public function __construct()
    {
        // Check if running in PHP CLI
        if (php_sapi_name() === "cli") {
            // Start listening for commands
            $this->listen();
            return true;
        }
        return false;
    }

    /**
     * Listen for commands
     */
    public function listen()
    {
        // Read input from the command line
        $command_raw = readline();

        // Trigger an event listener and listen for another command
        $this->onCommand($command_raw, function () {
            $this->listen();
        });
    }

    /**
     * On command event
     * 
     * @param string $command_raw Raw command input
     * @param callable $callback Callback to fire on event finish
     */
    public function onCommand(string $command_raw, callable $callback)
    {
        if ($command_raw == "ws") {
            $ws = new WebSocketsHandle();
        }
        if ($command_raw == 'wrs') {
            echo "Restarting WebSockets...", PHP_EOL;
            $ws->server->stop();
            $ws->server->run();
            exit();
        }
        $callback();
    }
}