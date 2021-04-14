<?php

namespace XENONMC\XPFRAME\apps\contact;

class App
{

    /**
     * constructor
     * 
     * @param object, mvc framework object
     * 
     */

    function __construct($mvc)
    {

        $this->mvc = $mvc;
        $mvc->view->cache('Default', 'contact');
        $mvc->view->cache('Default', 'main', true);
    }

    /**
     * on ready method
     * 
     */

    function onReady()
    {

        $this->mvc->view->render($this->mvc->view->theme, 'contact', 'main', [

            'beans' => 'epic'
        ],
        [

            'brand' => 'XPFRAME'
        ]);
    }
}
