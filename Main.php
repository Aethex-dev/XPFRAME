<?php

namespace xenonmc\xpframe;

use xenonmc\xpframe\core\app\App;
use xenonmc\xpframe\core\cli\CLI;
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
        $model->database->add("main", $model->database->new("sql", [
            "hostname" => "localhost",
            "username" => "root",
            "password" => "", 
            "database" => ""
        ]));

        $result = $model->database->databases[0]["main"]["connection"]->query("SHOW DATABASES");
        var_dump($result);

        // Home page route
        $router->event->get("", function () use (&$controller) {
            $controller->get_app("home", "Main")->start($controller->mvc);
        });

        // 404 route
        $router->event->none(function () use (&$view) {
            $view->render("Default", "404", "Main", false, [
                "template" => [

                ],
                "layout" => [

                ]
            ]);
        });
    }
}

// Start the main class of the application
$main = new Main();
$main->run();