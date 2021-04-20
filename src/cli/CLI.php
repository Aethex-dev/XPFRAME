<?php

/**
 * COPYRIGHT XENONMC 2019 - Current
 *
 * XPFRAME and all of its named materials rights belong to XENONMC
 * You may fork and redistribute materials of this framework as long as proper crediting is given, learn more at https://xenonmc.xyz/resources/XENONMC/XPFRAME/copyright
 *
 * @package XENONMC\XPFRAME\cli
 * @author XENONMC <support@xenonmc.xyz>
 * @website https://xenonmc.xyz
 *
 */

namespace XENONMC\XPFRAME\cli;

// class imports
use XENONMC\XPFRAME\App;
use \XENONMC\XPFRAME\ext\Config;

class CLI
{

    /**
     * app class
     *
     */

    public App $app;

    /**
     * constructor
     *
     */

    public function __construct($app)
    {

        // get parent class
        $this->app = $app;

        // notify class start
        echo "Interface Started!", PHP_EOL;
        
        // start listening for commands
        $this->cmd_listen();
    }

    /**
     * listen for any commands
     *
     */

    public function cmd_listen()
    {

        // check if auto prefix is not enabled in config
        $skip_shift_root_cmd = false;

        if (Config::get("xpframe.yml")['cli-auto-prefix'] != true) {

            // check if command belongs to this script
            $command_raw = readLine(">_ ");
            if (substr(strtoupper(explode(" ", $command_raw)[0]), 0, strlen(explode(" ", $command_raw)[0])) != "XPFRAME") {

                // execute raw command as is in shell
                echo shell_exec($command_raw . " 1>&2"), PHP_EOL;

                // restart listener on command end
                $this->cmd_listen();
                return null;
            }
        } else {

            $command_raw = readLine("XPFRAME >_ ");
            $skip_shift_root_cmd = true;
        }

        // split command
        $command_segments = explode(" ", $command_raw);
        if ($skip_shift_root_cmd == false) {

            array_shift($command_segments);
        }

        // base command
        $cmd['command'] = $command_segments[0];

        // command arguments
        array_shift($command_segments);
        $cmd['args'] = $command_segments;

        echo $cmd['command'] . " args 1 " . $cmd['args'][0], PHP_EOL;

        // restart listener on command end
        $this->cmd_listen();
        return null;
    }

    /**
     * console print out
     *
     * @param string , text to output to the console
     *
     */

    public function cout(string $text)
    {

        echo $text, PHP_EOL;
    }
}