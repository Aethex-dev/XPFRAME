<?php

namespace xenonmc\xpframe;

use xenonmc\xpframe\core\app\App;
use xenonmc\xpframe\core\mvc\MVC;
use xenonmc\xpframe\core\router\Router;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include str_replace("\\", "/", __DIR__) . "/src/vendor/autoload.php";

class Main implements App
{
    /**
     * XPFRAME application main class
     */
    public function __construct()
    {
    }

    /**
     * Application run method
     */
    public function run()
    {
        // Get MVC components
        $this->mvc = new MVC();
        $model = &$this->mvc->model;
        $view = &$this->mvc->view;
        $controller = &$this->mvc->controller;

        // Router
        $router = new Router();
        
        // Home page route
        $router->on("get", "page", function () {
            echo "yoyoyoyo";
        });
        $router->on("get", "", function () {
            
        });
        $router->on("404", "", function () {
            echo "404";
        });
        $router->handle_events();
    }
}

// Start the main class of the application
$main = new Main();
$main->run();