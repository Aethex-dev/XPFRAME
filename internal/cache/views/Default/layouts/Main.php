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

/* views/Default/layouts/Main.twig */
class __TwigTemplate_40cbd0f550f6cfc3cc177cf35c01b51bf233369113da1dab5c4eec65e43f7ac1 extends Template
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
        echo "<!doctype html>
<html>
    <head>
        <style>
            body {
                background: #121212;
                margin: 0;
            }
            
            header {
                width: 100%;
                height: 50px;
                display: flex;
                justify-content: space-between;
                box-sizing: border-box;
                padding: 0px 20px;
                align-items: center;
                background: #1e1e1e;
                overflow: hidden;
            }
            header > .logo {
                color: #55ffff;
                text-decoration: none;
                font-size: 13px;
                font-family: sans-serif;
            }
            header > .links > a {
                text-decoration: none;
                padding: 30px 20px;
                height: 50px;
                color: #fff;
                opacity: 60%;
                font-size: 11px;
                font-family: sans-serif;
            }
            header > .links > a:hover {
                opacity: 100%;
                background: #282828;
            }

            .content {
                margin: 20px;
                background: #202020;
                padding: 20px;
                font-size: 11px;
                color: #fff;
                font-family: sans-serif;
                box-sizing: border-box;
            }
            .content > p {
                padding: 0;
                margin: 0;
                min-height: 70vh;
            }
        </style>
        <title>";
        // line 56
        echo twig_escape_filter($this->env, ($context["brand"] ?? null), "html", null, true);
        echo "</title>
    </head>
    <body>
        <header>
            <a class=\"logo\" href=\"/\">
                ";
        // line 61
        echo twig_escape_filter($this->env, ($context["project"] ?? null), "html", null, true);
        echo "
            </a>

            <div class=\"links\">
                <a href=\"/\">HOME</a>
                <a href=\"/about\">ABOUT</a>
                <a href=\"/contact\">CONTACT</a>
            </div>
        </header>
        <div class=\"content\">
            <template/>
        </div>
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "views/Default/layouts/Main.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 61,  94 => 56,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "views/Default/layouts/Main.twig", "/home/xenonmc/XENONMC/XPFRAME/internal/views/Default/layouts/Main.twig");
    }
}
