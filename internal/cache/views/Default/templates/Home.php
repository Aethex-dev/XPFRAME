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

/* views/Default/templates/Home.twig */
class __TwigTemplate_55c3bbe5d96b9783025ac0bddacc6e6f21ee0d93fa8c2798e35273804ded02a6 extends Template
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
        echo "<p>lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet lorem ipsum dolor sit ammet</p>";
    }

    public function getTemplateName()
    {
        return "views/Default/templates/Home.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "views/Default/templates/Home.twig", "/home/xenonmc/XENONMC/XPFRAME/internal/views/Default/templates/Home.twig");
    }
}
