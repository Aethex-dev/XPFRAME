<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* views/Default/templates/About.twig */
class __TwigTemplate_66f40e73fde07a5c0999c3c3bfeb056b7d814999c09ee9a2e42f5f89e15c0905 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<h1>About Us</h1>
<p>XPFRAME | A Framework by XENONMC | XPFRAME is a progressive PHP framework allowing you to save time learning how to use the framework and while building your application with maximum productivity.</p>";
    }

    public function getTemplateName()
    {
        return "views/Default/templates/About.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "views/Default/templates/About.twig", "/home/xenonmc/XENONMC/XPFRAME/internal/views/Default/templates/About.twig");
    }
}
