<?php

/* AcmeBlogBundle:Default:index.html.twig */
class __TwigTemplate_1cd1db8242359cec7cfdc15fbbb28583 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "Hello ";
        echo twig_escape_filter($this->env, $this->getContext($context, "name"), "html", null, true);
        echo "!
";
    }

    public function getTemplateName()
    {
        return "AcmeBlogBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
