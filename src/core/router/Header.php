<?php

namespace xenonmc\xpframe\core\router;

class Header
{
    /**
     * Set an HTTP header
     * 
     * @param string $header Header to set
     * @param string $value Value to set for the header
     */
    public function set(string $header, string $value)
    {
        // Set the header
        header(ucfirst($header) . ": " . $value);
    }

    /**
     * Get an HTTP header
     * 
     * @param string $header Name of the header to get
     * @return mixed Value of the header
     */
    public function get(string $header): mixed
    {
        // Return the header
        return $_SERVER["HTTP_" . strtoupper($header)] ?? $_SERVER[strtoupper($header)];
    }
}