<?php

namespace xenonmc\xpframe\core\mvc;

use Twig\Environment;
use xenonmc\xpframe\core\mvc\view\TwigInit;

class View
{
    /**
     * @var MVC Parent class object
     */
    public MVC $mvc;

    /**
     * @var string Internal data dir
     */
    public string $internal_dir;

    /**
     * @var Environment Twig template environment object
     */
    public Environment $twig;

    /**
     * View class used for rendering templates, caching, executing and more
     * 
     * @param MVC $mvc MVC class object
     */
    public function __construct(MVC $mvc)
    {
        // Define parent class
        $this->mvc = &$mvc;

        // Get the framework config
        $this->config = $config = $mvc->config;

        // Configure View class
        $this->internal_dir = "internal";
        if (isset($config["mvc"]["view"]["internal_dir"]) && $config["mvc"]["view"]["internal_dir"] !== $this->internal_dir) {
            $this->internal_dir = $config["mvc"]["view"]["internal_dir"];
        }

        // Configure and build Twig template engine object
        $twigInit = new TwigInit();
        if (isset($config["mvc"]["view"]["internal_dir"]) && $config["mvc"]["view"]["internal_dir"] !== $twigInit->internal_dir) {
            $twigInit->internal_dir = 
            
            $config["mvc"]["view"]["internal_dir"];
        }
        $this->twig = $twigInit->build();
        unset($twigInit);

        // Build directory structure
        if (!file_exists($this->internal_dir . "/views")) {
            mkdir($this->internal_dir . "/views", 0777, true);
        }
    }

    /**
     * Compile a template
     * 
     * @param string $group Name of the view group to get template from
     * @param string $template Name of the template to get
     * @param string $type Type of template
     * @return string Raw PHP code
     */
    public function compile(string $group, string $template, string $type = "template"): string
    {
        // Get twig template engine
        $twig = &$this->twig;

        // Get the template source
        if ($type == "layout") {
            $template_type_path = "layouts";
        } else {
            $template_type_path = "templates";
        }
        $source = $twig->getLoader()->getSourceContext("views/" . $group . "/" . $template_type_path . "/" . $template . ".twig");

        // Compile the source and return
        return $twig->compileSource($source);
    }

    /**
     * Cache a template
     * 
     * @param string $group Name of the view group to get the template from
     * @param string $template Name of the template to get
     * @param string $type Type of template
     * @return bool If the template was cached correctly
     */
    public function cache(string $group, string $template, string $type): bool
    {
        // Compile the template
        $template_compiled = $this->compile($group, $template, $type);

        // Insert compiled template to cache file
        if ($type == "layout") {
            $template_type_path = "layouts";
        } else {
            $template_type_path = "templates";
        }
        if (file_put_contents($this->internal_dir . "/cache/views/" . $group . "/" . $template_type_path . "/" . $template . ".php", $template_compiled)) {
            return true;
        }
        return false;
    }

    /**
     * Render a page
     * 
     * @param string $group Name of group to render templates from
     * @param string $template Name of the template to render
     * @param string $layout Name of the layout to render template inside of
     * @param array $environment Environment variables for layout and template
     */
    public function render(string $group, string $template, string $layout, bool $useCache = true, array $environment = ["template" => [], "layout" => []])
    {
        if ($useCache == true) {
            // render page from cache
            $template_compiled = file_get_contents($this->internal_dir . "/cache/views/" . $group . "/templates/" . $template . ".php");
            $layout_compiled = file_get_contents($this->internal_dir . "/cache/views/" . $group . "/layouts/" . $layout . ".php");
            eval("?>" . $template_compiled);
            eval("?>" . $layout_compiled);

            // get template classes
            preg_match("~class (.+?) ~", $template_compiled, $template_class);
            $template_class = $template_class[1];
            preg_match("~class (.+?) ~", $layout_compiled, $layout_class);
            $layout_class = $layout_class[1];

            // construct template object and execute
            $template_object = new $template_class($this->twig);
            $layout_object = new $layout_class($this->twig);
            echo str_replace("<template/>", $template_object->render($environment["template"]), $layout_object->render($environment["layout"]));
        } else {
            // Compile and render page
            $template_compiled = $this->compile($group, $template, "template");
            $layout_compiled = $this->compile($group, $layout, "layout");
            eval("?>" . $template_compiled);
            eval("?>" . $layout_compiled);

            // get template classes
            preg_match("~class (.+?) ~", $template_compiled, $template_class);
            $template_class = $template_class[1];
            preg_match("~class (.+?) ~", $layout_compiled, $layout_class);
            $layout_class = $layout_class[1];

            // construct template object and execute
            $template_object = new $template_class($this->twig);
            $layout_object = new $layout_class($this->twig);
            echo str_replace("<template/>", $template_object->render($environment["template"]), $layout_object->render($environment["layout"]));
        }
    }
}