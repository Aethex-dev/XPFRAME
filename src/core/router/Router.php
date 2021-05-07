<?php

namespace xenonmc\xpframe\core\router;

use xenonmc\xpframe\core\router\Event;

class Router
{
    /**
     * @var Event Event class object
     */
    public Event $event;

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
        $this->event = new Event();
        $this->header = new Header();
    }
}