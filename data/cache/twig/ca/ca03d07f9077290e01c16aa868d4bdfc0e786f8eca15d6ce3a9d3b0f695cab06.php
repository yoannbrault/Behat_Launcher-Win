<?php

/* outputFile_text.html.twig */
class __TwigTemplate_4e0b2964b9975a83b059a03a63575ef6b9ea9cd44635f09d4de276d193ecb264 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <body style=\"background-color: black\">
        <div>
            <pre id=\"content\" class=\"refresh output\" data-refresh=\"content\">";
        // line 5
        echo (isset($context["content"]) ? $context["content"] : $this->getContext($context, "content"));
        echo "</pre>
        </div>
        <script type=\"text/javascript\" src=\"/js/all.min.js\"></script>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "outputFile_text.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 5,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <body style="background-color: black">*/
/*         <div>*/
/*             <pre id="content" class="refresh output" data-refresh="content">{{ content|raw }}</pre>*/
/*         </div>*/
/*         <script type="text/javascript" src="/js/all.min.js"></script>*/
/*     </body>*/
/* </html>*/
/* */
