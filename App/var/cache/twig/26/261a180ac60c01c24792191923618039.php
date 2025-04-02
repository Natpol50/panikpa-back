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

/* offers/stages.html.twig */
class __TwigTemplate_a4e463cb78f17e4cfe524e973ec2a1e9 extends Template
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
            'content' => [$this, 'block_content'],
            'javascripts' => [$this, 'block_javascripts'],
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
        $this->parent = $this->loadTemplate("base.html.twig", "offers/stages.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageTitle"] ?? null), "html", null, true);
        yield " - ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "
    <div class=\"container\">
        <nav class=\"breadcrumb\">
            <span><a href=\"/\">Accueil</a></span>
            <span><a href=\"/offres\">Offres</a></span>
            <span>";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageTitle"] ?? null), "html", null, true);
        yield "</span>
        </nav>

        <section class=\"offers-section\">
            <header class=\"offers-header\">
                <h1>";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pageTitle"] ?? null), "html", null, true);
        yield "</h1>
                
                <div class=\"offers-actions\">
                    <div class=\"search-container\">
                        <input type=\"text\" id=\"search-input\" placeholder=\"Rechercher...\" aria-label=\"Rechercher une offre\">
                        <button id=\"search-button\" aria-label=\"Rechercher\">
                            <svg viewBox=\"0 0 24 24\" width=\"20\" height=\"20\">
                                <path d=\"M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z\" fill=\"currentColor\"/>
                            </svg>
                        </button>
                    </div>
                    
                    ";
        // line 28
        if (($context["canCreateOffer"] ?? null)) {
            // line 29
            yield "                        <a href=\"/offres/create\" class=\"create-btn\">
                            <svg viewBox=\"0 0 24 24\" width=\"20\" height=\"20\" style=\"margin-right: 8px;\">
                                <path d=\"M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z\" fill=\"currentColor\"/>
                            </svg>
                            Créer une offre
                        </a>
                    ";
        }
        // line 36
        yield "                </div>
            </header>

            <!-- Loading state for offers -->
            <div id=\"offers-loading\" class=\"loading-container\">
                <div class=\"spinner\"></div>
                <p>Chargement des offres...</p>
            </div>

            <!-- Error message container -->
            <div id=\"offers-error\" class=\"error-container\" style=\"display: none;\">
                <svg viewBox=\"0 0 24 24\" width=\"48\" height=\"48\">
                    <path d=\"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z\" fill=\"currentColor\"/>
                </svg>
                <h3>Erreur lors du chargement des offres</h3>
                <p id=\"error-message\">Impossible de charger les offres. Veuillez réessayer plus tard.</p>
                <button class=\"login-btn\" style=\"max-width: 300px;\" onclick=\"fetchOffers()\">Réessayer</button>
            </div>

            <!-- Empty state for no offers -->
            <div id=\"offers-empty\" class=\"empty-container\" style=\"display: none;\">
                <svg viewBox=\"0 0 24 24\" width=\"48\" height=\"48\">
                    <path d=\"M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 9c-1.65 0-3-1.35-3-3s1.35-3 3-3 3 1.35 3 3-1.35 3-3 3zm0-4c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1zm6 10H6v-1.53c0-2.5 3.97-3.58 6-3.58s6 1.08 6 3.58V18zm-9.69-2h7.38c-.69-.56-2.38-1.12-3.69-1.12s-3.01.56-3.69 1.12z\" fill=\"currentColor\"/>
                </svg>
                <h3>Aucune offre disponible</h3>
                <p>Aucune offre ne correspond à votre recherche.</p>
            </div>

            <!-- Offers container -->
            <div id=\"offers-container\" class=\"offres-container\" style=\"display: none;\"></div>

            <!-- Pagination -->
            <div id=\"pagination\" class=\"pagination\" style=\"display: none;\">
                <button id=\"prev-page\" class=\"pagination-button\">Précédent</button>
                <span id=\"page-info\">Page 1 sur 1</span>
                <button id=\"next-page\" class=\"pagination-button\">Suivant</button>
            </div>
        </section>
    </div>
";
        yield from [];
    }

    // line 77
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 78
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script> const offerType = \"";
        // line 79
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["offerType"] ?? null), "html", null, true);
        yield "\"; </script>
    <script src=\"/assets/js/stages.js\" defer></script>
";
        yield from [];
    }

    // line 83
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 84
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        /* Header styles */
        .offers-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .offers-header h1 {
            margin: 0;
            font-size: 2rem;
            color: var(--onyx);
        }
        
        .offers-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        /* Search styles */
        .search-container {
            display: flex;
            align-items: center;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            overflow: hidden;
            background-color: white;
        }

        .offres-container {
            background-color: var(--background-nav);
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px var(--shadow-color);
        }
        
        #search-input {
            border: none;
            padding: 0.5rem 1rem;
            flex: 1;
            min-width: 200px;
            font-size: 1rem;
        }
        
        #search-input:focus {
            outline: none;
        }
        
        #search-button {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 0.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .create-btn {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 0.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            text-decoration: none;
        }
        
        /* Loading state */
        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 0;
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
        }
        
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Error and empty states */
        .error-container, .empty-container {
            text-align: center;
            padding: 3rem 0;
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
        }
        
        .error-container svg, .empty-container svg {
            color: var(--real-grey);
            opacity: 0.6;
            margin-bottom: 1rem;
        }
        
        .error-container h3, .empty-container h3 {
            margin-bottom: 0.5rem;
            color: var(--onyx);
        }
        
        .error-container p, .empty-container p {
            color: var(--real-grey);
            margin-bottom: 1.5rem;
        }
        
        /* Offer card animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .offre-card {
            animation: fadeIn 0.3s ease-out forwards;
            opacity: 0;
        }
        
        .apply-button {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 1rem;
            transition: filter 0.3s ease;
        }
        
        .apply-button:hover {
            filter: brightness(0.9);
        }
        
        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .offers-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .offers-actions {
                width: 100%;
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-container {
                width: 100%;
            }
        }
        
        /* For users who prefer reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .spinner {
                animation: none;
            }
            
            .offre-card {
                animation: none;
                opacity: 1;
            }
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
        return "offers/stages.html.twig";
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
        return array (  186 => 84,  179 => 83,  171 => 79,  166 => 78,  159 => 77,  115 => 36,  106 => 29,  104 => 28,  89 => 16,  81 => 11,  74 => 6,  67 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "offers/stages.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\offers\\stages.html.twig");
    }
}
