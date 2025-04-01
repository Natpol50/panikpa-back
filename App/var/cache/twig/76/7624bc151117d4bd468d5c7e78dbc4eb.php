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

/* partials/navbar.html.twig */
class __TwigTemplate_dce4099a11e31d1d691d81ee22b9eb55 extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<nav class=\"navbar\">
    <div class=\"nav-left\">
        <img src=\"/assets/img/PANIKPA.png\" alt=\"Logo PANIKPA\" class=\"logo\">
        <span class=\"site-name\">PANIKPA</span>
    </div>

    <button class=\"menu-toggle\" aria-label=\"Menu principal\" aria-controls=\"primary-menu\" aria-expanded=\"false\">
        <span class=\"menu-toggle__bar\"></span>
        <span class=\"menu-toggle__bar\"></span>
        <span class=\"menu-toggle__bar\"></span>
    </button>

    <div class=\"nav-right\" id=\"primary-menu\">
        <span class=\"nav-links\"><a href=\"/\" ";
        // line 14
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 14), "getPathInfo", [], "method", false, false, false, 14) == "/")) {
            yield "class=\"selected\"";
        }
        yield ">Accueil</a></span>
        <span class=\"nav-links\"><a href=\"/entreprises\" ";
        // line 15
        if ((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 15), "getPathInfo", [], "method", false, false, false, 15)) && is_string($_v1 = "/entreprises") && str_starts_with($_v0, $_v1))) {
            yield "class=\"selected\"";
        }
        yield ">Entreprises</a></span>
        <span class=\"nav-links\"><a href=\"/offres\" ";
        // line 16
        if ((is_string($_v2 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 16), "getPathInfo", [], "method", false, false, false, 16)) && is_string($_v3 = "/offres") && str_starts_with($_v2, $_v3))) {
            yield "class=\"selected\"";
        }
        yield ">Offres</a></span>
        ";
        // line 17
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "isAuthenticated", [], "method", false, false, false, 17)) {
            // line 18
            yield "            <span class=\"nav-links\"><a href=\"/wishlist\" ";
            if ((is_string($_v4 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 18), "getPathInfo", [], "method", false, false, false, 18)) && is_string($_v5 = "/wishlist") && str_starts_with($_v4, $_v5))) {
                yield "class=\"selected\"";
            }
            yield ">Wishlist</a></span>
            <span class=\"nav-links\"><a href=\"/interactions\" ";
            // line 19
            if ((is_string($_v6 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 19), "getPathInfo", [], "method", false, false, false, 19)) && is_string($_v7 = "/interactions") && str_starts_with($_v6, $_v7))) {
                yield "class=\"selected\"";
            }
            yield ">Candidatures</a></span>
        ";
        } else {
            // line 21
            yield "            <span class=\"nav-links\"><a href=\"/login\" ";
            if ((is_string($_v8 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 21), "getPathInfo", [], "method", false, false, false, 21)) && is_string($_v9 = "/login") && str_starts_with($_v8, $_v9))) {
                yield "class=\"selected\"";
            }
            yield ">Connexion</a></span>
        ";
        }
        // line 23
        yield "    </div>
</nav>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partials/navbar.html.twig";
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
        return array (  99 => 23,  91 => 21,  84 => 19,  77 => 18,  75 => 17,  69 => 16,  63 => 15,  57 => 14,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "partials/navbar.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\partials\\navbar.html.twig");
    }
}
