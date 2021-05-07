<?php
 
namespace xenonmc\xpframe\core\mvc\view;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigInit 
{
    /**
     * @var string Where all internal data for the framework is stored such as cache
     */
    public string $internal_dir;

    /** 
     * Initialize the Twig template engine
     */
    public function __construct()
    {
        // set default configuration
        $this->internal_dir = "internal";
    }

    /**
     * Build Twig object
     * 
     * @return Environment Twig template engine object
     */
    public function build(): Environment 
    {
        // Construct Twig environment object
        $loader = new FilesystemLoader($this->internal_dir);
        return new Environment($loader);
    }
}