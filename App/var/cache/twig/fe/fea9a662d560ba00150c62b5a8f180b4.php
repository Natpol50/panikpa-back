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
class __TwigTemplate_c70f06ae3f6b99230434d19922271e5f extends Template
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
        <img src=\"/assets/img/PANIKPA.webp\" alt=\"Logo PANIKPA\" class=\"logo\">
        <span class=\"site-name\">PANIKPA</span>
    </div>

    <button class=\"menu-toggle\" aria-label=\"Menu principal\" aria-controls=\"primary-menu\" aria-expanded=\"false\">
        <span class=\"menu-toggle__bar\"></span>
        <span class=\"menu-toggle__bar\"></span>
        <span class=\"menu-toggle__bar\"></span>
    </button>

    <div class=\"nav-right\" id=\"primary-menu\">
        <span class=\"nav-links\" data-page=\"accueil\"><a href=\"/\" ";
        // line 14
        if ((($context["current_path"] ?? null) == "/")) {
            yield "class=\"selected\"";
        }
        yield ">Accueil</a></span>
        <span class=\"nav-links\" data-page=\"entreprises\"><a href=\"/entreprises\" ";
        // line 15
        if ((Twig\Extension\CoreExtension::slice($this->env->getCharset(), ($context["current_path"] ?? null), 0, 12) == "/entreprises")) {
            yield "class=\"selected\"";
        }
        yield ">Entreprises</a></span>
        <span class=\"nav-links\" data-page=\"offres\"><a href=\"/offres\" ";
        // line 16
        if ((Twig\Extension\CoreExtension::slice($this->env->getCharset(), ($context["current_path"] ?? null), 0, 7) == "/offres")) {
            yield "class=\"selected\"";
        }
        yield ">Offres</a></span>
        ";
        // line 17
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "isAuthenticated", [], "method", false, false, false, 17)) {
            // line 18
            yield "            ";
            if (((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasRole", [1], "method", false, false, false, 18) || CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasRole", [2], "method", false, false, false, 18)) || CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasRole", [3], "method", false, false, false, 18))) {
                // line 19
                yield "                <span class=\"nav-links\" data-page=\"gestion\"><a href=\"/gestion\" ";
                if ((Twig\Extension\CoreExtension::slice($this->env->getCharset(), ($context["current_path"] ?? null), 0, 8) == "/gestion")) {
                    yield "class=\"selected\"";
                }
                yield ">Gestion</a></span>
            ";
            } else {
                // line 21
                yield "                <span class=\"nav-links\" data-page=\"wishlist\"><a href=\"/wishlist\" ";
                if ((Twig\Extension\CoreExtension::slice($this->env->getCharset(), ($context["current_path"] ?? null), 0, 9) == "/wishlist")) {
                    yield "class=\"selected\"";
                }
                yield ">Wishlist</a></span>
                <span class=\"nav-links\" data-page=\"candidatures\"><a href=\"/applications\" ";
                // line 22
                if ((Twig\Extension\CoreExtension::slice($this->env->getCharset(), ($context["current_path"] ?? null), 0, 13) == "/applications")) {
                    yield "class=\"selected\"";
                }
                yield ">Candidatures</a></span>
            ";
            }
            // line 24
            yield "        ";
        } else {
            // line 25
            yield "            <span class=\"nav-links\" data-page=\"connexion\"><a href=\"/login\" ";
            if ((((is_string($_v0 = ($context["current_path"] ?? null)) && is_string($_v1 = "/login") && str_starts_with($_v0, $_v1)) || (is_string($_v2 = ($context["current_path"] ?? null)) && is_string($_v3 = "/new-account") && str_starts_with($_v2, $_v3))) || (is_string($_v4 = ($context["current_path"] ?? null)) && is_string($_v5 = "/forgot-password") && str_starts_with($_v4, $_v5)))) {
                yield " class=\"selected\"";
            }
            yield ">Connexion</a></span>
        ";
        }
        // line 27
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
        return array (  113 => 27,  105 => 25,  102 => 24,  95 => 22,  88 => 21,  80 => 19,  77 => 18,  75 => 17,  69 => 16,  63 => 15,  57 => 14,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<nav class=\"navbar\">
    <div class=\"nav-left\">
        <img src=\"/assets/img/PANIKPA.webp\" alt=\"Logo PANIKPA\" class=\"logo\">
        <span class=\"site-name\">PANIKPA</span>
    </div>

    <button class=\"menu-toggle\" aria-label=\"Menu principal\" aria-controls=\"primary-menu\" aria-expanded=\"false\">
        <span class=\"menu-toggle__bar\"></span>
        <span class=\"menu-toggle__bar\"></span>
        <span class=\"menu-toggle__bar\"></span>
    </button>

    <div class=\"nav-right\" id=\"primary-menu\">
        <span class=\"nav-links\" data-page=\"accueil\"><a href=\"/\" {% if current_path == '/' %}class=\"selected\"{% endif %}>Accueil</a></span>
        <span class=\"nav-links\" data-page=\"entreprises\"><a href=\"/entreprises\" {% if current_path|slice(0, 12) == '/entreprises' %}class=\"selected\"{% endif %}>Entreprises</a></span>
        <span class=\"nav-links\" data-page=\"offres\"><a href=\"/offres\" {% if current_path|slice(0, 7) == '/offres' %}class=\"selected\"{% endif %}>Offres</a></span>
        {% if request.isAuthenticated() %}
            {% if request.hasRole(1) or request.hasRole(2) or request.hasRole(3) %}
                <span class=\"nav-links\" data-page=\"gestion\"><a href=\"/gestion\" {% if current_path|slice(0, 8) == '/gestion' %}class=\"selected\"{% endif %}>Gestion</a></span>
            {% else %}
                <span class=\"nav-links\" data-page=\"wishlist\"><a href=\"/wishlist\" {% if current_path|slice(0, 9) == '/wishlist' %}class=\"selected\"{% endif %}>Wishlist</a></span>
                <span class=\"nav-links\" data-page=\"candidatures\"><a href=\"/applications\" {% if current_path|slice(0, 13) == '/applications' %}class=\"selected\"{% endif %}>Candidatures</a></span>
            {% endif %}
        {% else %}
            <span class=\"nav-links\" data-page=\"connexion\"><a href=\"/login\" {% if current_path starts with '/login' or current_path starts with '/new-account' or current_path starts with '/forgot-password'%} class=\"selected\"{% endif %}>Connexion</a></span>
        {% endif %}
    </div>
</nav>", "partials/navbar.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\partials\\navbar.html.twig");
    }
}
