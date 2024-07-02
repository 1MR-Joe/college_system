<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* auth/register.twig */
class __TwigTemplate_aed8375a30438f689bd515713d15274b extends Template
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
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Register</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #2e2e2e;
            color: #ffffff;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #444;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        input[type=\"text\"], input[type=\"password\"], input[type=\"email\"], input[type=\"number\"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        input[type=\"submit\"] {
            width: 100%;
            padding: 10px;
            background-color: #555;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        input[type=\"submit\"]:hover {
            background-color: #666;
        }
    </style>
</head>
<body>
<div class=\"container\">
    <h2>Register</h2>
    <form action=\"/register\" method=\"post\">
        <input type=\"text\" name=\"name\" placeholder=\"Name\" required>
        <input type=\"number\" name=\"ssn\" placeholder=\"SSN\" required>
        <input type=\"number\" name=\"phone\" placeholder=\"Phone Number\" required>
        <input type=\"date\" name=\"birthdate\" placeholder=\"Birthdate\" required>
        <select name=\"userType\" required>
            <option value=\"\">Choose User Type</option>
            <option value=\"student\">Student</option>
            <option value=\"professor\">Professor</option>
        </select>
        <select name=\"gender\" required>
            <option value=\"\">Choose Gender</option>
            <option value=\"female\">Female</option>
            <option value=\"male\">Male</option>
        </select>
        <select name=\"faculty\" required>
            <option value=\"\">Choose Faculty</option>
            ";
        // line 65
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["faculties"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 66
            yield "                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "id", [], "any", false, false, false, 66), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "name", [], "any", false, false, false, 66), "html", null, true);
            yield "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        yield "        </select>
        <input type=\"password\" name=\"password\" placeholder=\"Password\" required>
        <input type=\"password\" name=\"confirmPassword\" placeholder=\"Confirm Password\" required>
        <input type=\"submit\" value=\"Register\">
    </form>
</div>
</body>
</html>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "auth/register.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  119 => 68,  108 => 66,  104 => 65,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "auth/register.twig", "/home/joe/Desktop/code/collegeSystem/resources/views/auth/register.twig");
    }
}
