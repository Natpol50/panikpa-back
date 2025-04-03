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
use Twig\TemplateWrapper;

/* base.html.twig */
class __TwigTemplate_1ace3ef04f0ac1d5c1e903d87ddd38f0 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'breadcrumb' => [$this, 'block_breadcrumb'],
            'content' => [$this, 'block_content'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>";
        // line 6
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    <link rel=\"stylesheet\" href=\"/assets/css/global.css\">
    <link rel=\"icon\" href=\"/assets/img/PANIKPA.ico\" type=\"image/x-icon\">
    ";
        // line 9
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 10
        yield "</head>
<body>
    <header>
        ";
        // line 13
        yield from $this->loadTemplate("partials/navbar.html.twig", "base.html.twig", 13)->unwrap()->yield($context);
        // line 14
        yield "    </header>
    <main>
        <div class=\"app\">
            <div class=\"container\">
                ";
        // line 18
        yield from $this->unwrap()->yieldBlock('breadcrumb', $context, $blocks);
        // line 19
        yield "                

                
                ";
        // line 22
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 23
        yield "            </div>
        </div>
    </main>
    ";
        // line 26
        yield from $this->loadTemplate("partials/cookies.html.twig", "base.html.twig", 26)->unwrap()->yield($context);
        // line 27
        yield "    ";
        yield from $this->loadTemplate("partials/footer.html.twig", "base.html.twig", 27)->unwrap()->yield($context);
        // line 28
        yield "    
    <div class=\"notifications-container active-path-container\">
        <div class=\"notification active-path\">
            <div class=\"notification-content\">Current Path: ";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["current_path"] ?? null), "html", null, true);
        yield "</div>
        </div>
    </div>

    ";
        // line 36
        yield "        ";
        yield from $this->loadTemplate("partials/notifications.html.twig", "base.html.twig", 36)->unwrap()->yield(CoreExtension::merge($context, ["success" => ((        // line 37
array_key_exists("success", $context)) ? (Twig\Extension\CoreExtension::default(($context["success"] ?? null), [])) : ([])), "error" => ((        // line 38
array_key_exists("error", $context)) ? (Twig\Extension\CoreExtension::default(($context["error"] ?? null), [])) : ([])), "path" => ((        // line 39
array_key_exists("current_path", $context)) ? (Twig\Extension\CoreExtension::default(($context["current_path"] ?? null), "")) : (""))]));
        // line 41
        yield "
    <script src=\"/assets/js/notifications.js\" defer></script>
    <script src=\"/assets/js/navbar.js\" defer></script>
    ";
        // line 44
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 47
        yield "</body>
</html>";
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "PANIKPA";
        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 18
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumb(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 22
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 44
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 45
        yield "    
    ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  173 => 45,  166 => 44,  156 => 22,  146 => 18,  136 => 9,  125 => 6,  119 => 47,  117 => 44,  112 => 41,  110 => 39,  109 => 38,  108 => 37,  106 => 36,  99 => 31,  94 => 28,  91 => 27,  89 => 26,  84 => 23,  82 => 22,  77 => 19,  75 => 18,  69 => 14,  67 => 13,  62 => 10,  60 => 9,  54 => 6,  47 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>{% block title %}PANIKPA{% endblock %}</title>
    <link rel=\"stylesheet\" href=\"/assets/css/global.css\">
    <link rel=\"icon\" href=\"/assets/img/PANIKPA.ico\" type=\"image/x-icon\">
    {% block stylesheets %}{% endblock %}
</head>
<body>
    <header>
        {% include 'partials/navbar.html.twig' %}
    </header>
    <main>
        <div class=\"app\">
            <div class=\"container\">
                {% block breadcrumb %}{% endblock %}
                

                
                {% block content %}{% endblock %}
            </div>
        </div>
    </main>
    {% include 'partials/cookies.html.twig' %}
    {% include 'partials/footer.html.twig' %}
    
    <div class=\"notifications-container active-path-container\">
        <div class=\"notification active-path\">
            <div class=\"notification-content\">Current Path: {{ current_path }}</div>
        </div>
    </div>

    {# Include our new notification component #}
        {% include 'partials/notifications.html.twig' with {
            'success': success|default([]),
            'error': error|default([]),
            'path': current_path|default('')
        } %}

    <script src=\"/assets/js/notifications.js\" defer></script>
    <script src=\"/assets/js/navbar.js\" defer></script>
    {% block javascripts %}
    
    {% endblock %}
</body>
</html>", "base.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\base.html.twig");
    }
}
