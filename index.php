<?php
namespace XENONMC\XPFRAME;

include 'vendor/autoload.php';

$t = new Router\App();

// url handler
$t->get('/', function() {

    echo "Hey! Welcome to the homepage of this website";
    exit();
});

// another page
$t->get($t->url[0], function() use(&$t) {

    if(file_exists('src/apps/' . ucfirst(strtolower($t->url[0])) . '/App.php')) {

        // initialize the mvc framework
        $mvc = new Mvc\App();

        // initialize app controller
        $mvc->controller->init(array(

            'app' => $t->url[0],

        ), function($cntlr) {

            // start controller
            $cntlr->onReady();
        });
    } else {

        echo 'ERROR: 404';
        http_response_code(404);
    }
});