<?php

namespace XENONMC\XPFRAME;
use XENONMC\XPFRAME\Mvc\Mvc;
use XENONMC\XPFRAME\ext\Config;

trait execute
{
    
    /**
     * main logic function
     */
    public function execute()
    {
        // check if script was opened in cli
        if ($this->is_cli()) {

            // check if cli is enabled
            if (Config::get("xpframe.yml")['use-cli'] == true) {
                echo 'Starting Command Line Interface...', PHP_EOL;

                // initialize cli class and stop function
                new CLI($this);
                return null;
            }
            
            // stop function
            return null;
        }

        $this->mvc = new Mvc(Config::get("xpframe.yml")["mvc"]);
        
        $router = $this->router;
        $mvc = $this->mvc;

        $router->on_get(["App.php", "page", "{beans}"], 200, function($beans) {
            echo "Welcome to <strong>/Test</strong>" . " Found param: $beans";
        });
        
        $router->on_get(["{beans}"], 200, function($beans) {
            echo "Welcome to <strong>/Test</strong>" . " Found param: $beans";
        });
    }
}