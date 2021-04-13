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

/* theme/Default/templates/contact.twig */
class __TwigTemplate_14d0792e3d39e01d65274f49044f998e64804575548d4e776f4660b2102a7d30 extends Template
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
        if ((5 == 5)) {
            // line 2
            echo "
yay it worked

";
        }
        // line 6
        echo "
";
        // line 7
        echo "d";
    }

    public function getTemplateName()
    {
        return "theme/Default/templates/contact.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 7,  45 => 6,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "theme/Default/templates/contact.twig", "C:\\xampp\\htdocs\\XPFRAME\\internal\\theme\\Default\\templates\\contact.twig");
    }
}
