<?php

namespace xenonmc\xpframe\core\router;

use xenonmc\xpframe\core\router\Event;

class Router
{
    /**
     * @var Event Event class object
     */
    private Event $event;

    /**
     * @var bool Event triggered
     */
    public bool $event_triggered;

    /**
     * @var array All registered events
     */
    public array $events;

    /**
     * @var Header Http header control object
     */
    public Header $header;

    /**
     * Router class used for manipulating the url, handling events based on the url and more
     */
    public function __construct()
    {
        // Initialize Router components
        $this->event = new Event($this);
        $this->header = new Header();

        // Initialize variables
        $this->events = [];
        $this->event_triggered = false;
    }

    /**
     * On event handler
     * 
     * @param string $event Event name
     * @param string $param Event param
     * @param callable $callback Event callback
     */
    public function on(string $event, string $param, callable $callback)
    {
        // Register event to events
        $this->events[count($this->events)] = [
            "url" => $param,
            "callback" => $callback,
            "event" => $event
        ];
    }

    /**
     * Handle all events
     */
    public function handle_events()
    {
        // Get all events
        $events = $this->events;

        // Loop through all events
        foreach ($events as $event) {
            // get requests
            switch (strtolower($event["event"])) {
                case "get":
                    $this->event->get($event["url"], function () use (&$event) {
                        $this->event_triggered = true;
                        $event["callback"]();
                    });
                    break;
                case "post":
                    $this->event->post($event["url"], function () use (&$event) {
                        $this->event_triggered = true;
                        $event["callback"]();
                    });
                    break;
                case "404":
                    $this->event->none($event["callback"]);
                    break;
            }
        }
    }
}