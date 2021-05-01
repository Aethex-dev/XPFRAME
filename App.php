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
 */

namespace XENONMC\XPFRAME;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "src/vendor/autoload.php";

use Exception;
use XENONMC\XPFRAME\cli\CLI;
use XENONMC\XPFRAME\ext\Config;
use XENONMC\XPFRAME\vendor\Mvc\Mvc;
use XENONMC\XPFRAME\vendor\Router\Router;

class App
{

    /**
     * @var Mvc app mvc object
     */
    public Mvc $mvc;

    /**
     * @var Router app router object
     */
    public Router $router;

    /**
     * @var array|null framework config
     */
    public array|null $config;

    /**
     * @var array framework main class construct options
     */
    public array $options = array(
        'no-prop' => false
    );

    /**
     * XPFRAME framework start point
     *
     * @param array|null all options for the constructor
     */
    public function __construct(array|null $options = null)
    {
        if ($options == null) {
            $options = $this->options;
        } else {
            $options = array_merge($options, $this->options);
        }
        echo $options['no-prop'];
        $this->config = Config::get('xpframe.yml');

        // initialize mvc components
        $this->router = new Router();
    }

    /**
     * check if the script was started in cli
     *
     * @return boolean , if the script was opened in cli
     */
    public function is_cli(): bool
    {
        if (defined('STDIN')) {
            return true;
        }
        if (php_sapi_name() === 'cli') {
            return true;
        }
        if (array_key_exists('SHELL', $_ENV)) {
            return true;
        }
        if (empty($_SERVER['REMOTE_ADDR']) and !isset($_SERVER['HTTP_USER_AGENT']) and count($_SERVER['argv']) > 0) {
            return true;
        }
        if (!array_key_exists('REQUEST_METHOD', $_SERVER)) {
            return true;
        }
        return false;
    }

    /**
     * main logic function
     * @throws Exception
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
        $router->on_get(["page"], true, true, function() {
            echo "No param found";
        });
        $router->on_get(["page", "{page_name}"], true, true, function($page_name) {
            $this->mvc->view->render($page_name, "main", "theme",true);
            $this->mvc->controller->start("test");
        });
    }
}

// initialize framework main class
$xpframe = new App();

// run the app class
try {
    $xpframe->execute();
} catch (Exception $e) {
    echo $e;
}