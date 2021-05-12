<?php

namespace xenonmc\xpframe\core\mvc;

use xenonmc\xpframe\core\mvc\MVC;

class Controller
{
    /**
     * @var MVC MVC class object
     */
    public MVC $mvc;
    /**
     * Controller class for starting, managing apps and more
     * 
     * @param MVC $mvc MVC class object
     */
    public function __construct(MVC $mvc)
    {
        // Define parent class
        $this->mvc = $mvc;
    }

    /**
     * Get the specific app class object
     * 
     * @param string $app Name of the app
     * @param string $controller Name of the controller to get form the app
     */
    public function get_app(string $app, string $controller): object
    {
        // Build namespace
        $namespace = "\\xenonmc\\xpframe\\apps\\" . $app . "\\controllers\\" . $controller;

        // Construct object and return
        return new $namespace();
    }
}