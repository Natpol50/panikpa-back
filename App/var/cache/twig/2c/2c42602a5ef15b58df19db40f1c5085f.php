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

/* offers/show.html.twig */
class __TwigTemplate_8658fd48beaf64cfbf19081129a255b1 extends Template
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
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascripts' => [$this, 'block_javascripts'],
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
        $this->parent = $this->loadTemplate("base.html.twig", "offers/show.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "title", [], "any", false, false, false, 3), "html", null, true);
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
        yield "<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span><a href=\"/offres\">Offres</a></span>
        <span><a href=\"/offres/";
        // line 10
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "type", [], "any", false, false, false, 10) == 0)) ? ("stages") : ("alternances"));
        yield "\">";
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "type", [], "any", false, false, false, 10) == 0)) ? ("Stages") : ("Alternances"));
        yield "</a></span>
        <span>";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "title", [], "any", false, false, false, 11), "html", null, true);
        yield "</span>
    </nav>

    <div class=\"offer-detail\">
        <header class=\"offer-header\">
            <div class=\"offer-title-section\">
                <h1>";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "title", [], "any", false, false, false, 17), "html", null, true);
        yield "</h1>
                
                ";
        // line 19
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "isAuthenticated", [], "method", false, false, false, 19) && CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_wishlist"], "method", false, false, false, 19))) {
            // line 20
            yield "                <button id=\"wishlist-button\" class=\"wishlist-button ";
            yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "wishlisted", [], "any", false, false, false, 20)) ? ("active") : (""));
            yield "\" 
                        data-id=\"";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id", [], "any", false, false, false, 21), "html", null, true);
            yield "\" 
                        aria-label=\"";
            // line 22
            yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "wishlisted", [], "any", false, false, false, 22)) ? ("Retirer de la wishlist") : ("Ajouter à la wishlist"));
            yield "\">
                    <svg viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                        <path d=\"M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z\" />
                    </svg>
                    ";
            // line 26
            yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "wishlisted", [], "any", false, false, false, 26)) ? ("Retirer de la wishlist") : ("Ajouter à la wishlist"));
            yield "
                </button>
                ";
        }
        // line 29
        yield "            </div>
            
            <div class=\"offer-meta\">
                <div class=\"offer-company\">
                    <h2>";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "company", [], "any", false, false, false, 33), "html", null, true);
        yield "</h2>
                    <p>";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "location", [], "any", false, false, false, 34), "html", null, true);
        yield "</p>
                </div>
                <div class=\"offer-details\">
                    <p class=\"offer-date\">Publié le ";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "publishDate", [], "any", false, false, false, 37), "html", null, true);
        yield "</p>
                    <p class=\"reference\">Référence: ";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "reference", [], "any", false, false, false, 38), "html", null, true);
        yield "</p>
                </div>
            </div>
            
            <div class=\"offer-tags\">
                <span class=\"tag\">";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "duration", [], "any", false, false, false, 43), "html", null, true);
        yield "</span>
                <span class=\"tag\">";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "level", [], "any", false, false, false, 44), "html", null, true);
        yield "</span>
                ";
        // line 45
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "tags", [], "any", false, false, false, 45));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 46
            yield "                    <span class=\"";
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "optional", [], "any", false, false, false, 46)) ? ("tag_optional") : ("tag"));
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "name", [], "any", false, false, false, 46), "html", null, true);
            yield "</span>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['tag'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        yield "                <span class=\"";
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "remuneration", [], "any", false, false, false, 48) == "0")) ? ("remuneration_negative") : ("remuneration"));
        yield "\">
                    ";
        // line 49
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "remuneration", [], "any", false, false, false, 49) == "0")) ? ("Non Rémunéré") : ("Rémunéré"));
        yield "
                </span>
                ";
        // line 51
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "highlighted", [], "any", false, false, false, 51)) {
            // line 52
            yield "                    <span class=\"tag_star\">Candidat star !</span>
                ";
        }
        // line 54
        yield "            </div>
        </header>

        <div class=\"offer-content\">
            <div class=\"offer-sections\">
                <section class=\"offer-section\">
                    <h3>Description du poste</h3>
                    <div class=\"offer-description\">
                        ";
        // line 62
        yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "description", [], "any", false, false, false, 62), ["Description: " => ""]), "html", null, true));
        yield "
                    </div>
                </section>
                
                <section class=\"offer-section\">
                    <h3>Entreprise</h3>
                    <div class=\"company-details\">
                        <h4>";
        // line 69
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 69), "html", null, true);
        yield "</h4>
                        ";
        // line 70
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_description_url", [], "any", false, false, false, 70)) {
            // line 71
            yield "                            <p>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_description_url", [], "any", false, false, false, 71), "html", null, true);
            yield "</p>
                        ";
        }
        // line 73
        yield "                        <p><strong>Contact:</strong> ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_email", [], "any", false, false, false, 73), "html", null, true);
        yield "</p>
                        <p><strong>Téléphone:</strong> ";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_phone", [], "any", false, false, false, 74), "html", null, true);
        yield "</p>
                        ";
        // line 75
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_site", [], "any", false, false, false, 75)) {
            // line 76
            yield "                            <p><strong>Site web:</strong> <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_site", [], "any", false, false, false, 76), "html", null, true);
            yield "\" target=\"_blank\" rel=\"noopener\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_site", [], "any", false, false, false, 76), "html", null, true);
            yield "</a></p>
                        ";
        }
        // line 78
        yield "                    </div>
                </section>
                
                <section class=\"offer-section\">
                    <h3>Informations pratiques</h3>
                    <div class=\"practical-info\">
                        <p><strong>Date de début:</strong> ";
        // line 84
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "startDate", [], "any", false, false, false, 84), "html", null, true);
        yield "</p>
                        <p><strong>Durée:</strong> ";
        // line 85
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "duration", [], "any", false, false, false, 85), "html", null, true);
        yield "</p>
                        <p><strong>Lieu:</strong> ";
        // line 86
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "location", [], "any", false, false, false, 86), "html", null, true);
        yield "</p>
                        <p><strong>Niveau requis:</strong> ";
        // line 87
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "level", [], "any", false, false, false, 87), "html", null, true);
        yield "</p>
                    </div>
                </section>
            </div>
            
            <div class=\"offer-actions\">
                ";
        // line 93
        if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "isAuthenticated", [], "method", false, false, false, 93)) {
            // line 94
            yield "                    <a href=\"/login\" class=\"btn-primary login-to-apply\">Se connecter pour postuler</a>
                ";
        } elseif ((        // line 95
($context["canApply"] ?? null) &&  !CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "hasApplied", [], "any", false, false, false, 95))) {
            // line 96
            yield "                    <button id=\"apply-button\" class=\"btn-primary login-to-apply\">Postuler à cette offre</button>
                ";
        } elseif (CoreExtension::getAttribute($this->env, $this->source,         // line 97
($context["offer"] ?? null), "hasApplied", [], "any", false, false, false, 97)) {
            // line 98
            yield "                    <div class=\"already-applied\">
                        <svg viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                            <path d=\"M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z\" fill=\"currentColor\"/>
                        </svg>
                        <span>Vous avez déjà postulé à cette offre</span>
                    </div>
                ";
        } else {
            // line 105
            yield "                    <div class=\"cannot-apply\">
                        <p>Vous n'avez pas les permissions nécessaires pour postuler à cette offre.</p>
                    </div>
                ";
        }
        // line 109
        yield "            </div>
        </div>
    </div>
    
    <!-- Application modal -->
    <div id=\"application-modal\" class=\"modal\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h2>Postuler à l'offre: ";
        // line 117
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "title", [], "any", false, false, false, 117), "html", null, true);
        yield "</h2>
                <button class=\"close-modal\">&times;</button>
            </div>
            <div class=\"modal-body\">
                <form id=\"application-form\" enctype=\"multipart/form-data\">
                    <input type=\"hidden\" name=\"offerId\" value=\"";
        // line 122
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id", [], "any", false, false, false, 122), "html", null, true);
        yield "\">
                    
                    <div class=\"form-group\">
                        <label for=\"motivation\">Lettre de motivation</label>
                        <textarea id=\"motivation\" name=\"motivation\" rows=\"8\" required></textarea>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"cv\">CV (PDF)</label>
                        <div class=\"file-upload\">
                            <input type=\"file\" id=\"cv\" name=\"cv\" accept=\".pdf\" required>
                            <label for=\"cv\" class=\"file-label\">Choisir un fichier</label>
                            <span class=\"file-name\">Aucun fichier choisi</span>
                        </div>
                    </div>
                    
                    <div class=\"form-actions\">
                        <button type=\"button\" class=\"btn-secondary cancel-application\">Annuler</button>
                        <button type=\"submit\" class=\"btn-primary\">Envoyer ma candidature</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Loading overlay -->
    <div id=\"loading-overlay\" class=\"loading-overlay\">
        <div class=\"spinner\"></div>
        <p>Envoi en cours...</p>
    </div>
</div>
";
        yield from [];
    }

    // line 155
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 156
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        /* Offer detail styles */
        .offer-detail {
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        /* Header section */
        .offer-header {
            padding: 2rem;
            border-bottom: 1px solid var(--real-lgrey);
            background-color: #f7f7f7;
        }
        
        .offer-title-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .offer-title-section h1 {
            font-size: 1.8rem;
            margin: 0;
            color: var(--onyx);
            flex: 1;
        }
        
        .wishlist-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background-color: white;
            border: 1px solid var(--real-grey);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .wishlist-button:hover {
            border-color: var(--primary-color);
        }
        
        .wishlist-button svg {
            fill: transparent;
            stroke: var(--realsecondary-color);
            stroke-width: 1.5;
            transition: all 0.3s ease;
        }
        
        .wishlist-button.active {
            border-color: var(--primary-color);
        }
        
        .wishlist-button.active svg {
            fill: var(--primary-color);
            stroke: var(--primary-color);
        }
        
        .offer-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        
        .offer-company h2 {
            font-size: 1.3rem;
            margin: 0 0 0.3rem 0;
            color: var(--primary-color);
        }
        
        .offer-company p {
            font-size: 1rem;
            margin: 0;
            color: var(--real-grey);
        }
        
        .offer-details {
            text-align: right;
            font-size: 0.9rem;
            color: var(--real-grey);
        }
        
        .offer-details p {
            margin: 0 0 0.3rem 0;
        }
        
        .offer-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        /* Content section */
        .offer-content {
            padding: 2rem;
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 2rem;
        }
        
        .offer-section {
            margin-bottom: 2rem;
        }
        
        .offer-section h3 {
            color: var(--primary-color);
            font-size: 1.3rem;
            margin: 0 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--tag-background);
        }
        
        .offer-section h4 {
            font-size: 1.1rem;
            margin: 0 0 0.5rem 0;
            color: var(--onyx);
        }
        
        .offer-description, .company-details, .practical-info {
            line-height: 1.6;
        }
        
        .offer-actions {
            background-color: var(--background-grey);
            padding: 1.5rem;
            border-radius: 8px;
            position: sticky;
            top: 2rem;
            height: fit-content;
        }
        
        .btn-primary {
            display: block;
            width: 100%;
            padding: 1rem;
            text-align: center;
        }
        
        .already-applied, .cannot-apply {
            text-align: center;
            color: var(--real-grey);
        }
        
        .already-applied {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: var(--primary-color);
        }
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            overflow: auto;
        }
        
        .modal-content {
            margin: 10% auto;
            width: 80%;
            max-width: 600px;
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--real-lgrey);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--onyx);
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 1.8rem;
            cursor: pointer;
            color: var(--real-grey);
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: var(--onyx);
        }
        
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            resize: vertical;
        }
        
        .file-upload {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .file-upload input {
            display: none;
        }
        
        .file-label {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }
        
        .file-name {
            font-size: 0.9rem;
            color: var(--real-grey);
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .btn-secondary {
            background-color: var(--real-grey);
            color: var(--onyx);
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        /* Loading overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 1100;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        
        .loading-overlay .spinner {
            width: 50px;
            height: 50px;
            margin-bottom: 1rem;
        }
        
        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .offer-content {
                grid-template-columns: 1fr;
            }
            
            .offer-actions {
                position: static;
                margin-top: 1rem;
            }
            
            .offer-title-section {
                flex-direction: column;
                gap: 1rem;
            }
            
            .wishlist-button {
                align-self: flex-start;
            }
            
            .offer-meta {
                flex-direction: column;
                gap: 1rem;
            }
            
            .offer-details {
                text-align: left;
            }
            
            .modal-content {
                width: 95%;
                margin: 5% auto;
            }
        }
        
        /* Animation for wishlist button */
        @keyframes heartbeat {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        
        .wishlist-button.clicked {
            animation: heartbeat 0.4s ease;
        }
        
        /* For users who prefer reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .wishlist-button.clicked {
                animation: none;
            }
        }
        
        /* Styling the spinner animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top: 4px solid var(--primary-color);
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }
</style>
";
        yield from [];
    }

    // line 512
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 513
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const applyButton = document.getElementById('apply-button');
            const modal = document.getElementById('application-modal');
            const closeModalButton = document.querySelector('.close-modal');
            const cancelButton = document.querySelector('.cancel-application');
            const applicationForm = document.getElementById('application-form');
            const loadingOverlay = document.getElementById('loading-overlay');
            const fileInput = document.getElementById('cv');
            const fileName = document.querySelector('.file-name');
            const wishlistButton = document.getElementById('wishlist-button');
            
            // Set up wishlist button functionality
            if (wishlistButton) {
                wishlistButton.addEventListener('click', async function() {
                    const offerId = this.dataset.id;
                    
                    // Add clicked class for animation
                    this.classList.add('clicked');
                    setTimeout(() => {
                        this.classList.remove('clicked');
                    }, 400);
                    
                    try {
                        // Send API request to toggle wishlist status
                        const response = await fetch('/API/wishlist/toggle/' + offerId, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            // Toggle active class
                            this.classList.toggle('active');
                            
                            // Update button text and aria-label
                            if (data.wishlisted) {
                                this.textContent = 'Retirer de la wishlist';
                                this.setAttribute('aria-label', 'Retirer de la wishlist');
                            } else {
                                this.textContent = 'Ajouter à la wishlist';
                                this.setAttribute('aria-label', 'Ajouter à la wishlist');
                            }
                            
                            // Re-add the SVG that got replaced by textContent
                            const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                            svg.setAttribute('viewBox', '0 0 24 24');
                            svg.setAttribute('width', '24');
                            svg.setAttribute('height', '24');
                            
                            const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                            path.setAttribute('d', 'M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z');
                            
                            svg.appendChild(path);
                            this.prepend(svg);
                            
                            // Display notification if provided
                            if (data.message) {
                                showNotification(data.message, data.wishlisted ? 'success' : 'info');
                            }
                        } else {
                            throw new Error(data.message || 'Something went wrong');
                        }
                    } catch (error) {
                        console.error('Error toggling wishlist:', error);
                        showNotification('Une erreur est survenue. Veuillez réessayer.', 'error');
                    }
                });
            }
            
            // Set up application modal functionality
            if (applyButton) {
                // Open the modal when apply button is clicked
                applyButton.addEventListener('click', function() {
                    modal.style.display = 'block';
                });
                
                // Close the modal with X button
                closeModalButton.addEventListener('click', function() {
                    modal.style.display = 'none';
                });
                
                // Close the modal with Cancel button
                cancelButton.addEventListener('click', function() {
                    modal.style.display = 'none';
                });
                
                // Close the modal when clicking outside
                window.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        modal.style.display = 'none';
                    }
                });
                
                // Update file name when file is selected
                fileInput.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        fileName.textContent = this.files[0].name;
                    } else {
                        fileName.textContent = 'Aucun fichier choisi';
                    }
                });
                
                // Handle form submission
                applicationForm.addEventListener('submit', async function(event) {
                    event.preventDefault();
                    
                    // Validate form
                    const motivation = document.getElementById('motivation').value.trim();
                    if (!motivation) {
                        showNotification('Veuillez rédiger une lettre de motivation.', 'error');
                        return;
                    }
                    
                    if (!fileInput.files.length) {
                        showNotification('Veuillez sélectionner un CV.', 'error');
                        return;
                    }
                    
                    // Check file type and size
                    const file = fileInput.files[0];
                    if (file.type !== 'application/pdf') {
                        showNotification('Veuillez sélectionner un fichier PDF.', 'error');
                        return;
                    }
                    
                    if (file.size > 5 * 1024 * 1024) { // 5MB max
                        showNotification('Le fichier est trop volumineux. Maximum 5 Mo.', 'error');
                        return;
                    }
                    
                    // Show loading overlay
                    loadingOverlay.style.display = 'flex';
                    
                    try {
                        // Create FormData for file upload
                        const formData = new FormData(applicationForm);
                        
                        // Send the application to the server
                        const response = await fetch('/apply', {
                            method: 'POST',
                            body: formData
                        });
                        
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            // Close modal and show success message
                            modal.style.display = 'none';
                            showNotification(data.message || 'Votre candidature a été envoyée avec succès.', 'success');
                            
                            // Refresh the page after a short delay
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        } else {
                            throw new Error(data.message || 'Something went wrong');
                        }
                    } catch (error) {
                        console.error('Error submitting application:', error);
                        showNotification('Une erreur est survenue lors de l\\'envoi de votre candidature. Veuillez réessayer.', 'error');
                    } finally {
                        // Hide loading overlay
                        loadingOverlay.style.display = 'none';
                    }
                });
            }
            
            // Utility function to create and show notifications
            function showNotification(message, type = 'info') {
                // Create notification element if it doesn't already exist
                let notificationContainer = document.querySelector('.notification-container');
                
                if (!notificationContainer) {
                    notificationContainer = document.createElement('div');
                    notificationContainer.className = 'notification-container';
                    notificationContainer.style.position = 'fixed';
                    notificationContainer.style.bottom = '20px';
                    notificationContainer.style.right = '20px';
                    notificationContainer.style.zIndex = '1200';
                    document.body.appendChild(notificationContainer);
                }
                
                // Create notification
                const notification = document.createElement('div');
                notification.className = `notification \${type}`;
                notification.style.backgroundColor = type === 'success' ? 'var(--primary-color)' : 
                                                 type === 'error' ? 'var(--tertiary-color)' : 
                                                 'var(--realsecondary-color)';
                notification.style.color = 'white';
                notification.style.padding = '1rem';
                notification.style.borderRadius = '4px';
                notification.style.marginTop = '0.5rem';
                notification.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.2)';
                notification.style.transition = 'opacity 0.3s, transform 0.3s';
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(20px)';
                notification.style.maxWidth = '300px';
                
                // Add message
                notification.textContent = message;
                
                // Add close button
                const closeButton = document.createElement('button');
                closeButton.textContent = '×';
                closeButton.style.border = 'none';
                closeButton.style.background = 'none';
                closeButton.style.color = 'white';
                closeButton.style.fontSize = '1.2rem';
                closeButton.style.fontWeight = 'bold';
                closeButton.style.cursor = 'pointer';
                closeButton.style.position = 'absolute';
                closeButton.style.top = '0.5rem';
                closeButton.style.right = '0.5rem';
                
                closeButton.addEventListener('click', () => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        notificationContainer.removeChild(notification);
                    }, 300);
                });
                
                // Position the button correctly
                notification.style.position = 'relative';
                notification.appendChild(closeButton);
                
                // Add to container
                notificationContainer.appendChild(notification);
                
                // Show with animation
                setTimeout(() => {
                    notification.style.opacity = '1';
                    notification.style.transform = 'translateY(0)';
                }, 10);
                
                // Auto-dismiss after 5 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.style.opacity = '0';
                        notification.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            if (notification.parentNode) {
                                notificationContainer.removeChild(notification);
                            }
                        }, 300);
                    }
                }, 5000);
            }
            
            // Add ESC key support for closing modal
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && modal.style.display === 'block') {
                    modal.style.display = 'none';
                }
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            const wishlistButton = document.getElementById('wishlist-button');
            
            if (wishlistButton) {
                wishlistButton.addEventListener('click', async function(e) {
                    e.preventDefault();
                    
                    // Add loading and clicked states for visual feedback
                    wishlistButton.classList.add('loading');
                    wishlistButton.classList.add('clicked');
                    
                    // Get the offer ID from the button's data attribute
                    const offerId = this.dataset.id;
                    
                    try {
                        // Send API request to toggle wishlist status
                        const response = await fetch(`/API/wishlist/toggle/\${offerId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            // Update button appearance based on new wishlist state
                            if (data.wishlisted) {
                                wishlistButton.classList.add('active');
                                wishlistButton.setAttribute('aria-label', 'Retirer de la wishlist');
                                wishlistButton.textContent = 'Retirer de la wishlist';
                                
                                // Add wishlist badge if it doesn't exist
                                if (!document.querySelector('.wishlist-badge')) {
                                    const badge = document.createElement('p');
                                    badge.className = 'wishlist-badge';
                                    badge.textContent = 'Dans votre wishlist';
                                    document.querySelector('.offer-tags').appendChild(badge);
                                }
                            } else {
                                wishlistButton.classList.remove('active');
                                wishlistButton.setAttribute('aria-label', 'Ajouter à la wishlist');
                                wishlistButton.textContent = 'Ajouter à la wishlist';
                                
                                // Remove wishlist badge if it exists
                                const badge = document.querySelector('.wishlist-badge');
                                if (badge) {
                                    badge.remove();
                                }
                            }
                            
                            // Show success notification
                            addNotification(data.message, 'success');
                        } else {
                            // Show error notification
                            addNotification(data.message, 'error');
                        }
                    } catch (error) {
                        console.error('Error toggling wishlist:', error);
                        addNotification('Une erreur s\\'est produite lors de la mise à jour de votre wishlist.', 'error');
                    } finally {
                        // Remove loading state
                        wishlistButton.classList.remove('loading');
                        
                        // Remove clicked class after animation completes
                        setTimeout(() => {
                            wishlistButton.classList.remove('clicked');
                        }, 400);
                    }
                });
            }
            
            // Helper function to add notifications
            function addNotification(message, type = 'success') {
                // Check if notifications.js is available and provides the function
                if (typeof window.addNotification === 'function') {
                    window.addNotification(message, type);
                } else {
                    // Simple fallback if the notification system isn't available
                    alert(message);
                }
            }
        });
    </script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "offers/show.html.twig";
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
        return array (  728 => 513,  721 => 512,  360 => 156,  353 => 155,  316 => 122,  308 => 117,  298 => 109,  292 => 105,  283 => 98,  281 => 97,  278 => 96,  276 => 95,  273 => 94,  271 => 93,  262 => 87,  258 => 86,  254 => 85,  250 => 84,  242 => 78,  234 => 76,  232 => 75,  228 => 74,  223 => 73,  217 => 71,  215 => 70,  211 => 69,  201 => 62,  191 => 54,  187 => 52,  185 => 51,  180 => 49,  175 => 48,  164 => 46,  160 => 45,  156 => 44,  152 => 43,  144 => 38,  140 => 37,  134 => 34,  130 => 33,  124 => 29,  118 => 26,  111 => 22,  107 => 21,  102 => 20,  100 => 19,  95 => 17,  86 => 11,  80 => 10,  74 => 6,  67 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "offers/show.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\offers\\show.html.twig");
    }
}
