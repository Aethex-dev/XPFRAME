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
        $this->data = [];
    }
    
    public $data;

    /**
     * Application run method
     */
    public function run()
    {
        // Initialize MVC
        $mvc = new MVC();
        
        // Get MVC components
        $model = $mvc->model;
        $view = $mvc->view;
        $controller = $mvc->controller;
        
        // Initialize Router
        $router = new Router();
        
        // Build the database connection
        $model->database->add("main", $model->database->new("sql", [
            "hostname" => "localhost",
            "username" => "emeraxyz_x",
            "password" => "helloworld1219",
            "database" => "emeraxyz_x"
        ]));
        
        // log the user in
        if (isset($_COOKIE["tkey"]) && !empty($_COOKIE["tkey"])) {
            $db = $model->database->get("main");
            $res = $db->query->select("*")->from("ec_users")->where("tkey = '" . $_COOKIE["tkey"] . "' AND token = '" . $_COOKIE["token"] . "'")->run();
            if ($res->num_rows > 0) {
                $this->data = $mvc->data = $res->fetch_assoc();
            }
        }
        
        // ROUTES
        // [ /hello ] route
        $router->on("get", "hello", function () {
            echo "Hello World was called on /hello";
        });

        // Home page route
        $router->on("get", "", function () use (&$controller) {
            $controller->get_app("home", "Main")->start($controller->mvc);
        });
        
        // Discord route
        $router->on("get", "discord", function () use (&$view) {
            $view->render("Default", "Discord", "Main", false, [
                "template" => [

                ],
                "layout" => [
                    "data" => $this->data
                ]
            ]);
        });
        
        // Register route
        $router->on("get", "register", function () use($view, $router) {
            // Logic
            $errors = [];
            $error_yes = false;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                foreach ($_POST as $post => $value) {
                    if (empty(trim($value))) {
                        $error_yes = true;
                        array_push($errors, ucfirst($post) . " may not be empty");
                    }
                }
                
                // Check if the username is taken
                $db = $view->mvc->model->database->get("main");
                $result = $db->query->select("username")->from("ec_users")->where("username = '" . $_POST["username"] . "'")->run();
                if ($result->num_rows > 0) {
                    $error_yes = true;
                    array_push($errors, "An account with that username already exist");
                }
                
                // Check if the email address is already registers
                $result = $db->query->select("email")->from("ec_users")->where("email = '" . $_POST["email"] . "'")->run();
                if ($result->num_rows > 0) {
                    $error_yes = true;
                    array_push($errors, "An account with that email address already exist");
                }
                
                if ($error_yes == false) {
                    // Prepare user data
                    $tkey = bin2hex(random_bytes(50));
                    $token = bin2hex(random_bytes(50));
                    
                    // Insert user data
                    $success = $db->query->insert("ec_users", "username, email, password, tkey, token")->values("'" . $_POST["username"] . "', '" . $_POST["email"] . "', '" . $_POST["password"] . "', '" . $tkey ."', '" . $token . "'")->run();
                    if ($db->query->success == true) {
                        setcookie("tkey", $tkey);
                        setcookie("token", $token);
                        header("Location: /");
                    }
                }
            }

            // Render
            $view->render("Default", "Register", "Main", false, [
                "template" => [
                    "error_yes" => $error_yes,
                    "errors" => $errors
                ],
                "layout" => [
                    "data" => $this->data
                ]
            ]);
        });

        echo $_SERVER["REMOTE_ADDR"];
        
        // [ /login ] route
        $router->on("get", "login", function () use ($view, $router) {
            // Logic
            $errors = [];
            $error_yes = false;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                foreach ($_POST as $post => $value) {
                    if (empty(trim($value))) {
                        $error_yes = true;
                        array_push($errors, ucfirst($post) . " must not be empty");
                    }
                }
                if ($error_yes == false) {
                    $db = $view->mvc->model->database->get("main");
                    $res = $db->query->select("*")->from("ec_users")->where("password = '" . $_POST["password"] . "' AND email = '" . $_POST["email"] . "'")->run();
                    $row = $res->fetch_assoc();
                }
            
                if ($res->num_rows > 0) {
                    setcookie("tkey", $row["tkey"]);
                    setcookie("token", $row["token"]);
                }
            }
            
            // Render the page
            $view->render("Default", "Login", "Main", false, [
                "template" => [
                    "error_yes" => $error_yes,
                    "errors" => $errors
                ],
                "layout" => [
                    "data" => $this->data
                ]
            ]);
        });
        
        // Contact route
        $router->on("get", "contact", function () use (&$view, &$controller) {
            $controller->get_app("contact", "Main")->start($controller->mvc);
        });

        // 404 route
        $router->on("404", "", function () use (&$view) {
            $view->render("Default", "404", "Main", false, [
                "template" => [

                ],
                "layout" => [
                    "data" => $this->data
                ]
            ]);
        });
        $router->handle_events();
    }
}

// Start the main class of the application
$main = new Main();
$main->run();
