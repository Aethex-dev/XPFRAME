<?php


namespace xenonmc\xpframe\core\router;

use xenonmc\xpframe\core\router\Router;

class Event
{

    /**
     * @var Router Router object`
     */
    public Router $router;

    /**
     * Event handler container for router
     */
    public function __construct(Router $router)
    {
        // Define parent class
        $this->router = $router;
    }

    /**
     * On get request event
     * 
     * @param string $url Url to trigger get event on
     * @param callable $callback Callback to trigger on event
     */
    public function get(string $url, callable $callback)
    {
        // Split URL segments
        $url = explode("/", $url);
        $request_url = explode("/", $_SERVER["REQUEST_URI"]);
        $request_url_count = count($request_url);
        if ($request_url[$request_url_count - 1] == "" && $request_url_count > 2) {
            unset($request_url[$request_url_count - 1]);
        }
        array_shift($request_url);

        // Loop through all URL segments and match
        $url_current_matches = 0;
        $url_match_index = 0;
        $url_required_matches = count($url);
        $request_url_count = count($request_url);
        $callback_params = [];

        // Check if the number of request URL segments and event URL segments matches
        if ($url_required_matches == $request_url_count) {
            foreach ($url as $url_seg) {
                // Check if param is a variable param
                preg_replace_callback_array([
                    "~{(.+?)}~" => function ($param) use(&$callback_params, &$request_url, &$url_match_index, &$url_current_matches) {
                        array_push($callback_params, urldecode($request_url[$url_match_index]));
                        $url_current_matches++;
                    }
                ], $url_seg);

                // Check if param matches event param segment as a string
                if (strtolower($url_seg) == strtolower($request_url[$url_match_index])) {
                    $url_current_matches++;
                }

                // increase the match checking index
                $url_match_index++;

                // Check if enough matches are ready to call the event
                if ($url_required_matches == $url_current_matches) {
                    $callback(...$callback_params);
                    break;
                }
            }
        }
    }

    /**
     * On post request event
     * 
     * @param string $url Url to listen for post event on
     * @param callable $callback Callback to run on event fire
     */
    public function post(string $url, callable $callback)
    {
        // Check if event should be fired via get event
        $this->get($url, function (...$callback_params) use(&$callback) {
            // Check if event is a post event
            if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
                $callback(...$callback_params);
            }
        });
    }

    /**
     * On no event trigger
     * 
     * @param callable $callback Callback to trigger if triggered
     */
    public function none(callable $callback)
    {
        // Check if event should trigger
        if ($this->router->event_triggered == false) {
            $callback();
        }
    }
}