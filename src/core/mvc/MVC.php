<?php

namespace xenonmc\xpframe\core\mvc;

use xenonmc\xpframe\core\mvc\View;
use xenonmc\xpframe\core\mvc\Model;
use xenonmc\xpframe\core\mvc\Controller;

class MVC 
{
    /**
     * MVC central control class
     */
    public function __construct()
    {
        // Get the framework's config
        $this->config = $config = json_decode(file_get_contents("config/xpframe.json"), true);

        // Initialize MVC classes based on config
        if ($config["mvc"]["use"]["Model"] == true) {
            $model = $this->model = new Model($this);
        }
        if ($config["mvc"]["use"]["View"] == true) {
            $view = $this->view = new View($this);
        }
        if ($config["mvc"]["use"]["Controller"] == true) {
            $controller = $this->controller = new Controller($this);
        }
    }
}