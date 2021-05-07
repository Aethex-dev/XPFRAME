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

/* views/Default/templates/Contact.twig */
class __TwigTemplate_327c3f59fd8c1dec31a58c6e147ab6a151c73764ac49adf056ff362fa2a2cf90 extends Template
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
        echo "<h1>Contact Us</h1><br>
<div class=\"errors\">
    ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["errors"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
            // line 4
            echo "        ";
            echo twig_escape_filter($this->env, $context["error"], "html", null, true);
            echo "<br>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 6
        echo "</div>
<form method=\"POST\" action=\"/contact\">
    <input name=\"email\" placeholder=\"Email Address\"/><br>
    <textarea name=\"message\" placeholder=\"Message\"></textarea><br>
    <button>SEND</button>
</form>

<html>
    <head>
        <style>
            input, button { padding: 10px; }
        </style>
    </head>
    <body>
        <input type=\"text\" id=\"message\" />
        <button onclick=\"transmitMessage()\">Send</button>
        <script>
            // Create a new WebSocket.
            var socket  = new WebSocket('ws://localhost:2000');

            // Define the 
            var message = document.getElementById('message');

            function transmitMessage() {
                socket.send( message.value );
            }

            socket.onmessage = function(e) {
                alert( e.data );
            }
        </script>
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "views/Default/templates/Contact.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 6,  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "views/Default/templates/Contact.twig", "/home/xenonmc/XENONMC/XPFRAME/internal/views/Default/templates/Contact.twig");
    }
}
