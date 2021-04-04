<?php

namespace XENONMC\XPFRAME\apps\contact;

class App {

    /**
     * constructor
     * 
     * @param object, mvc framework object
     * 
     */

    function __construct($mvc)
    {
        
        $this->mvc = $mvc;
    }

    /**
     * on ready method
     * 
     */

    function onReady() {

        echo 'the contact app controller was loaded';
    }
}