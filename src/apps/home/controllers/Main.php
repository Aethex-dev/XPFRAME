<?php

namespace xenonmc\xpframe\apps\home\controllers;

use xenonmc\xpframe\core\mvc\MVC;

class Main
{
    public function start(MVC $mvc)
    {
        // Render the home page
        $mvc->view->render("Default", "Home", "Main", false, [
            "template" => [

            ],
            "layout" => [
                
            ]
        ]);
    }
}