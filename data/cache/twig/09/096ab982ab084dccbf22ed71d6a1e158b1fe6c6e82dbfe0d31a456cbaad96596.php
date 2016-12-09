<?php

/* layout.html.twig */
class __TwigTemplate_0dda519ac90dc4b2470bd5b9c0e06b5e24106b4c0b82c509a5cc2a1fe3154214 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["min"] = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "query", array()), "get", array(0 => "min", 1 => 1), "method");
        // line 2
        echo "<!DOCTYPE html>
<html ng-app=\"blApp\">
    <head>
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <link rel=\"stylesheet\" href=\"/css/all";
        // line 6
        echo ((((array_key_exists("min", $context)) ? (_twig_default_filter((isset($context["min"]) ? $context["min"] : $this->getContext($context, "min")), true)) : (true))) ? (".min") : (""));
        echo ".css\" />
    </head>
    <body class=\"behat-launcher\">
        <div ng-include=\"'_menu.html'\"></div>
        <div class=\"container\">
            <div ng-view></div>
            <footer ng-bind-html=\"'<hr />' + ('footer'|translate)\">
            </footer>
        </div>
        <script type=\"text/javascript\" src=\"/js/all";
        // line 15
        echo ((((array_key_exists("min", $context)) ? (_twig_default_filter((isset($context["min"]) ? $context["min"] : $this->getContext($context, "min")), true)) : (true))) ? (".min") : (""));
        echo ".js\"></script>
    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Behat Launcher";
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 5,  43 => 15,  31 => 6,  27 => 5,  22 => 2,  20 => 1,);
    }
}
/* {% set min = app.request.query.get('min', 1) %}*/
/* <!DOCTYPE html>*/
/* <html ng-app="blApp">*/
/*     <head>*/
/*         <title>{% block title 'Behat Launcher' %}</title>*/
/*         <link rel="stylesheet" href="/css/all{{ min|default(true) ? '.min' : '' }}.css" />*/
/*     </head>*/
/*     <body class="behat-launcher">*/
/*         <div ng-include="'_menu.html'"></div>*/
/*         <div class="container">*/
/*             <div ng-view></div>*/
/*             <footer ng-bind-html="'<hr />' + ('footer'|translate)">*/
/*             </footer>*/
/*         </div>*/
/*         <script type="text/javascript" src="/js/all{{ min|default(true) ? '.min' : '' }}.js"></script>*/
/*     </body>*/
/* </html>*/
/* */
