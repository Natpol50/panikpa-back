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

/* enterprises/index.html.twig */
class __TwigTemplate_6e748eda529f5203064ef6e92b6873d7 extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'breadcrumb' => [$this, 'block_breadcrumb'],
            'content' => [$this, 'block_content'],
            'stylesheets' => [$this, 'block_stylesheets'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.html.twig", "enterprises/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Entreprises - ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield from [];
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumb(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "<nav class=\"breadcrumb\">
<span><a href=\"/\">Accueil</a></span>
<span>Entreprises</span>
</nav>
";
        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 10
        yield "<div class=\"enterprises-container\">
<div class=\"page-header\">
<h1>Entreprises partenaires</h1>
";
        // line 13
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", [4], "method", false, false, false, 13)) {
            // line 14
            yield "<a href=\"/entreprises/create\" class=\"btn-add-enterprise\">
<svg viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
<path d=\"M12 2v20m10-10H2\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
</svg>
Ajouter une entreprise
</a>
";
        }
        // line 21
        yield "</div>
<div class=\"search-section\">
        <form method=\"GET\" action=\"/entreprises\" class=\"search-form\">
            <div class=\"form-row\">
                <div class=\"form-section\">
                    <label for=\"search-name\">Nom de l'entreprise</label>
                    <input type=\"text\" id=\"search-name\" name=\"name\" placeholder=\"Ex: Google, Microsoft\" 
                           value=\"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 28), "query", [], "any", false, false, false, 28), "get", ["name"], "method", false, false, false, 28), "html", null, true);
        yield "\">
                </div>
                <div class=\"form-section\">
                    <label for=\"search-email\">Email de contact</label>
                    <input type=\"email\" id=\"search-email\" name=\"email\" placeholder=\"Ex: contact@entreprise.com\" 
                           value=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 33), "query", [], "any", false, false, false, 33), "get", ["email"], "method", false, false, false, 33), "html", null, true);
        yield "\">
                </div>
                <button type=\"submit\" class=\"btn-search\">Rechercher</button>
            </div>
        </form>
    </div>

    ";
        // line 40
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["enterprises"] ?? null))) {
            // line 41
            yield "        <div class=\"enterprises-grid\">
            ";
            // line 42
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["enterprises"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["enterprise"]) {
                // line 43
                yield "                <div class=\"enterprise-card\">
                    <div class=\"card-header\">
                        <div class=\"enterprise-logo\">
                            ";
                // line 46
                if (CoreExtension::getAttribute($this->env, $this->source, $context["enterprise"], "enterprise_photo_url", [], "any", false, false, false, 46)) {
                    // line 47
                    yield "                                <img src=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["enterprise"], "enterprise_photo_url", [], "any", false, false, false, 47), "html", null, true);
                    yield "\" alt=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["enterprise"], "enterprise_name", [], "any", false, false, false, 47), "html", null, true);
                    yield "\">
                            ";
                } else {
                    // line 49
                    yield "                                <div class=\"placeholder-logo\">
                                    ";
                    // line 50
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["enterprise"], "enterprise_name", [], "any", false, false, false, 50), 0, 1)), "html", null, true);
                    yield "
                                </div>
                            ";
                }
                // line 53
                yield "                        </div>
                        <div class=\"enterprise-details\">
                            <h2>";
                // line 55
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["enterprise"], "enterprise_name", [], "any", false, false, false, 55), "html", null, true);
                yield "</h2>
                            <p class=\"enterprise-contact\">
                                <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                    <path d=\"M22 12h-4l-3 3-3-3H7\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                                    <path d=\"M12 22l10-10M2 12l10 10M10 2l4 4-4 4\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                                </svg>
                                ";
                // line 61
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["enterprise"], "enterprise_email", [], "any", false, false, false, 61), "html", null, true);
                yield "
                            </p>
                            <p class=\"enterprise-phone\">
                                <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                    <path d=\"M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z\" />
                                </svg>
                                ";
                // line 67
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["enterprise"], "enterprise_phone", [], "any", false, false, false, 67), "html", null, true);
                yield "
                            </p>
                        </div>
                    </div>
                    <div class=\"card-actions\">
                        <a href=\"/entreprises/";
                // line 72
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["enterprise"], "id_enterprise", [], "any", false, false, false, 72), "html", null, true);
                yield "\" class=\"btn-view\">Voir détails</a>
                        ";
                // line 73
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", [8], "method", false, false, false, 73)) {
                    // line 74
                    yield "                            <a href=\"/entreprises/";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["enterprise"], "id_enterprise", [], "any", false, false, false, 74), "html", null, true);
                    yield "/edit\" class=\"btn-edit\">Modifier</a>
                        ";
                }
                // line 76
                yield "                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['enterprise'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 79
            yield "        </div>

        ";
            // line 81
            if ((($context["totalPages"] ?? null) > 1)) {
                // line 82
                yield "            <div class=\"pagination\">
                <div class=\"pagination-controls\">
                    ";
                // line 84
                if ((($context["currentPage"] ?? null) > 1)) {
                    // line 85
                    yield "                        <a href=\"?page=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["currentPage"] ?? null) - 1), "html", null, true);
                    yield "&name=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 85), "query", [], "any", false, false, false, 85), "get", ["name"], "method", false, false, false, 85), "html", null, true);
                    yield "&email=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 85), "query", [], "any", false, false, false, 85), "get", ["email"], "method", false, false, false, 85), "html", null, true);
                    yield "\" class=\"pagination-prev\">Précédent</a>
                    ";
                }
                // line 87
                yield "                    
                    <span class=\"page-info\">Page ";
                // line 88
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["currentPage"] ?? null), "html", null, true);
                yield " sur ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["totalPages"] ?? null), "html", null, true);
                yield "</span>
                    
                    ";
                // line 90
                if ((($context["currentPage"] ?? null) < ($context["totalPages"] ?? null))) {
                    // line 91
                    yield "                        <a href=\"?page=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["currentPage"] ?? null) + 1), "html", null, true);
                    yield "&name=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 91), "query", [], "any", false, false, false, 91), "get", ["name"], "method", false, false, false, 91), "html", null, true);
                    yield "&email=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 91), "query", [], "any", false, false, false, 91), "get", ["email"], "method", false, false, false, 91), "html", null, true);
                    yield "\" class=\"pagination-next\">Suivant</a>
                    ";
                }
                // line 93
                yield "                </div>
            </div>
        ";
            }
            // line 96
            yield "    ";
        } else {
            // line 97
            yield "        <div class=\"empty-state\">
            <svg viewBox=\"0 0 24 24\" width=\"64\" height=\"64\">
                <path d=\"M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
            </svg>
            <h2>Aucune entreprise trouvée</h2>
            <p>Il n'y a pas d'entreprises correspondant à vos critères de recherche.</p>
            ";
            // line 103
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", [4], "method", false, false, false, 103)) {
                // line 104
                yield "                <a href=\"/entreprises/create\" class=\"btn-add-enterprise-alt\">Ajouter une nouvelle entreprise</a>
            ";
            }
            // line 106
            yield "        </div>
    ";
        }
        // line 108
        yield "</div>
";
        yield from [];
    }

    // line 110
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 111
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
<style>
.enterprises-container {
max-width: 1200px;
margin: 0 auto;
padding: 2rem;
}
.page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .btn-add-enterprise {
        display: flex;
        align-items: center;
        background-color: var(--primary-color);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        text-decoration: none;
        gap: 0.5rem;
    }

    .enterprises-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .enterprise-card {
        background-color: var(--background-nav);
        border-radius: 8px;
        box-shadow: 0 2px 4px var(--shadow-color);
        padding: 1.5rem;
        transition: transform 0.3s ease;
    }

    .enterprise-card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .enterprise-logo {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--tag-background);
    }

    .placeholder-logo {
        font-size: 2rem;
        color: var(--primary-color);
    }

    .enterprise-details h2 {
        margin-bottom: 0.5rem;
        color: var(--primary-color);
    }

    .enterprise-contact, .enterprise-phone {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--real-grey);
        margin-bottom: 0.25rem;
    }

    .card-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .btn-view, .btn-edit {
        padding: 0.5rem 1rem;
        border-radius: 4px;
        text-decoration: none;
        text-align: center;
        font-weight: bold;
    }

    .btn-view {
        background-color: var(--tag-background);
        color: var(--primary-color);
    }

    .btn-edit {
        background-color: var(--secondary-color);
        color: var(--secondary-text);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background-color: var(--background-nav);
        border-radius: 8px;
        box-shadow: 0 2px 4px var(--shadow-color);
    }

    .empty-state svg {
        color: var(--realsecondary-color);
        opacity: 0.5;
        margin-bottom: 1rem;
    }

    .btn-add-enterprise-alt {
        display: inline-block;
        margin-top: 1rem;
        background-color: var(--primary-color);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        text-decoration: none;
    }

    .pagination {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .pagination-controls {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-info {
        color: var(--real-grey);
    }

    .pagination-prev, .pagination-next {
        padding: 0.5rem 1rem;
        background-color: var(--tag-background);
        color: var(--primary-color);
        text-decoration: none;
        border-radius: 4px;
    }
</style>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "enterprises/index.html.twig";
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
        return array (  298 => 111,  291 => 110,  285 => 108,  281 => 106,  277 => 104,  275 => 103,  267 => 97,  264 => 96,  259 => 93,  249 => 91,  247 => 90,  240 => 88,  237 => 87,  227 => 85,  225 => 84,  221 => 82,  219 => 81,  215 => 79,  207 => 76,  201 => 74,  199 => 73,  195 => 72,  187 => 67,  178 => 61,  169 => 55,  165 => 53,  159 => 50,  156 => 49,  148 => 47,  146 => 46,  141 => 43,  137 => 42,  134 => 41,  132 => 40,  122 => 33,  114 => 28,  105 => 21,  96 => 14,  94 => 13,  89 => 10,  82 => 9,  73 => 4,  66 => 3,  54 => 2,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "enterprises/index.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\enterprises\\index.html.twig");
    }
}
