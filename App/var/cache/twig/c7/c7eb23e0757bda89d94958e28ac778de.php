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

/* enterprises/show.html.twig */
class __TwigTemplate_dc2d8f253308f587fa361c2d39aabb25 extends Template
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
            'stylesheets' => [$this, 'block_stylesheets'],
            'content' => [$this, 'block_content'],
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
        $this->parent = $this->loadTemplate("base.html.twig", "enterprises/show.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 3), "html", null, true);
        yield " - Détails - ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        .enterprise-header {
            background-color: var(--background-nav);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            margin-bottom: 2rem;
            position: relative;
        }
        
        .enterprise-info {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
        }
        
        .enterprise-logo {
            width: 120px;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--tag-background);
            flex-shrink: 0;
        }
        
        .enterprise-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        
        .placeholder-logo {
            font-size: 3rem;
            color: var(--primary-color);
        }
        
        .enterprise-details {
            flex-grow: 1;
        }
        
        .enterprise-details h1 {
            margin: 0 0 1rem 0;
            color: var(--onyx);
            font-size: 2rem;
        }
        
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--real-grey);
        }
        
        .enterprise-stats {
            display: flex;
            gap: 2rem;
            margin-top: 1.5rem;
        }
        
        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--real-grey);
        }
        
        .rating-stars {
            display: flex;
            gap: 0.25rem;
            margin-top: 0.5rem;
        }
        
        .star {
            color: var(--realsecondary-color);
        }
        
        .star.filled {
            color: var(--primary-color);
        }
        
        .enterprise-actions {
            position: absolute;
            top: 2rem;
            right: 2rem;
            display: flex;
            gap: 1rem;
        }
        
        .btn-edit {
            background-color: var(--secondary-color);
            color: var(--secondary-text);
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }
        
        .btn-evaluate {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }
        
        .enterprise-description {
            background-color: var(--background-nav);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            margin-bottom: 2rem;
        }
        
        .enterprise-description h2 {
            margin-top: 0;
            margin-bottom: 1rem;
            color: var(--primary-color);
            font-size: 1.5rem;
        }
        
        .enterprise-offers {
            background-color: var(--background-nav);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            margin-bottom: 2rem;
        }
        
        .enterprise-offers h2 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            font-size: 1.5rem;
        }
        
        .offers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .empty-offers {
            text-align: center;
            padding: 2rem;
            color: var(--real-grey);
        }
        
        .offre-card {
            border: 1px solid var(--real-grey);
            border-radius: 8px;
            padding: 1.5rem;
            transition: transform 0.2s ease;
            cursor: pointer;
        }
        
        .offre-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px var(--shadow-color);
        }
        
        .offre-card.highlighted {
            border: 2px solid var(--primary-color);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            margin-bottom: 0.5rem;
            position: relative;
        }
        
        .card-header h3 {
            margin: 0;
            flex: 1;
            padding-right: 30px;
        }
        
        .wishlist-star {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--real-grey);
            padding: 0;
            position: absolute;
            top: 0;
            right: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .wishlist-star svg {
            fill: transparent;
            stroke: var(--realsecondary-color);
            stroke-width: 1.5;
            transition: all 0.3s ease;
        }
        
        .wishlist-star.active svg {
            fill: var(--primary-color);
            stroke: var(--primary-color);
        }
        
        .evaluation-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: auto;
        }
        
        .modal-content {
            background-color: var(--background-nav);
            margin: 10% auto;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        
        .modal-header {
            margin-bottom: 1.5rem;
        }
        
        .modal-header h3 {
            margin: 0;
            color: var(--onyx);
        }
        
        .star-rating {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .rating-star {
            font-size: 2rem;
            color: var(--real-grey);
            cursor: pointer;
        }
        
        .rating-star.selected {
            color: var(--primary-color);
        }
        
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }
        
        .btn-cancel {
            background-color: var(--real-lgrey);
            border: 1px solid var(--real-grey);
            color: var(--onyx);
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn-submit-rating {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .website-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            text-decoration: none;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .website-link:hover {
            text-decoration: underline;
        }
        
        @media screen and (max-width: 768px) {
            .enterprise-info {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .contact-info {
                align-items: center;
            }
            
            .enterprise-stats {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .enterprise-actions {
                position: static;
                margin-top: 1.5rem;
                justify-content: center;
            }
            
            .offers-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
";
        yield from [];
    }

    // line 351
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 352
        yield "<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span><a href=\"/entreprises\">Entreprises</a></span>
        <span>";
        // line 356
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 356), "html", null, true);
        yield "</span>
    </nav>

    <section class=\"enterprise-header\">
        <div class=\"enterprise-info\">
            <div class=\"enterprise-logo\">
                ";
        // line 362
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_photo_url", [], "any", false, false, false, 362)) {
            // line 363
            yield "                    <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_photo_url", [], "any", false, false, false, 363), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 363), "html", null, true);
            yield "\">
                ";
        } else {
            // line 365
            yield "                    <div class=\"placeholder-logo\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 365))), "html", null, true);
            yield "</div>
                ";
        }
        // line 367
        yield "            </div>
            
            <div class=\"enterprise-details\">
                <h1>";
        // line 370
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 370), "html", null, true);
        yield "</h1>
                
                <div class=\"contact-info\">
                    <div class=\"contact-item\">
                        <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                            <path d=\"M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" />
                        </svg>
                        ";
        // line 377
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_phone", [], "any", false, false, false, 377), "html", null, true);
        yield "
                    </div>
                    
                    <div class=\"contact-item\">
                        <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                            <path d=\"M22 12h-4l-3 3-3-3H7\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                            <path d=\"M12 22l10-10M2 12l10 10M10 2l4 4-4 4\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                        </svg>
                        ";
        // line 385
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_email", [], "any", false, false, false, 385), "html", null, true);
        yield "
                    </div>
                    
                    ";
        // line 388
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_site", [], "any", false, false, false, 388)) {
            // line 389
            yield "                        <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_site", [], "any", false, false, false, 389), "html", null, true);
            yield "\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"website-link\">
                            <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                <path d=\"M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                                <path d=\"M15 3h6v6\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                                <path d=\"M10 14L21 3\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                            </svg>
                            Visiter le site web
                        </a>
                    ";
        }
        // line 398
        yield "                </div>
                
                <div class=\"enterprise-stats\">
                    <div class=\"stat-item\">
                        <span class=\"stat-value\">";
        // line 402
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["applicationCount"] ?? null), "html", null, true);
        yield "</span>
                        <span class=\"stat-label\">Candidatures</span>
                    </div>
                    
                    <div class=\"stat-item\">
                        <span class=\"stat-value\">";
        // line 407
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["offers"] ?? null)), "html", null, true);
        yield "</span>
                        <span class=\"stat-label\">Offres actives</span>
                    </div>
                    
                    <div class=\"stat-item\">
                        <span class=\"stat-value\">
                            ";
        // line 413
        if ( !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["ratings"] ?? null), "average_rating", [], "any", false, false, false, 413))) {
            // line 414
            yield "                                ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, ($context["ratings"] ?? null), "average_rating", [], "any", false, false, false, 414), 1), "html", null, true);
            yield "
                            ";
        } else {
            // line 416
            yield "                                -
                            ";
        }
        // line 418
        yield "                        </span>
                        <span class=\"stat-label\">Note moyenne</span>
                        <div class=\"rating-stars\">
                            ";
        // line 421
        if ( !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["ratings"] ?? null), "average_rating", [], "any", false, false, false, 421))) {
            // line 422
            yield "                                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(1, 5));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 423
                yield "                                    <span class=\"star ";
                if (($context["i"] <= Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, ($context["ratings"] ?? null), "average_rating", [], "any", false, false, false, 423), 0, "floor"))) {
                    yield "filled";
                }
                yield "\">
                                        <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                            <path d=\"M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z\" />
                                        </svg>
                                    </span>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 429
            yield "                                <span class=\"stat-label\">(";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["ratings"] ?? null), "comment_count", [], "any", false, false, false, 429), "html", null, true);
            yield ")</span>
                            ";
        } else {
            // line 431
            yield "                                <span class=\"stat-label\">Aucune évaluation</span>
                            ";
        }
        // line 433
        yield "                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class=\"enterprise-actions\">
            ";
        // line 440
        if (($context["canEdit"] ?? null)) {
            // line 441
            yield "                <a href=\"/entreprises/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "id_enterprise", [], "any", false, false, false, 441), "html", null, true);
            yield "/edit\" class=\"btn-edit\">Modifier</a>
            ";
        }
        // line 443
        yield "            
            ";
        // line 444
        if (($context["canEvaluate"] ?? null)) {
            // line 445
            yield "                <button class=\"btn-evaluate\" id=\"evaluateBtn\">Évaluer</button>
            ";
        }
        // line 447
        yield "        </div>
    </section>
    
    ";
        // line 450
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_description_url", [], "any", false, false, false, 450)) {
            // line 451
            yield "        <section class=\"enterprise-description\">
            <h2>À propos de l'entreprise</h2>
            <div class=\"description-content\">
                ";
            // line 454
            yield CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_description_url", [], "any", false, false, false, 454);
            yield "
            </div>
        </section>
    ";
        }
        // line 458
        yield "    
    <section class=\"enterprise-offers\">
        <h2>Offres de stage</h2>
        
        ";
        // line 462
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["offers"] ?? null)) > 0)) {
            // line 463
            yield "            <div class=\"offers-grid\">
                ";
            // line 464
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["offers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["offer"]) {
                // line 465
                yield "                    <div class=\"offre-card ";
                if (CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "highlighted", [], "any", false, false, false, 465)) {
                    yield "highlighted";
                }
                yield "\" data-id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "id", [], "any", false, false, false, 465), "html", null, true);
                yield "\">
                        <div class=\"card-header\">
                            <h3>";
                // line 467
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "title", [], "any", false, false, false, 467), "html", null, true);
                yield "</h3>
                            ";
                // line 468
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_wishlist"], "method", false, false, false, 468)) {
                    // line 469
                    yield "                                <button class=\"wishlist-star ";
                    if (CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "wishlisted", [], "any", false, false, false, 469)) {
                        yield "active";
                    }
                    yield "\" 
                                        data-id=\"";
                    // line 470
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "id", [], "any", false, false, false, 470), "html", null, true);
                    yield "\" 
                                        aria-label=\"";
                    // line 471
                    yield ((CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "wishlisted", [], "any", false, false, false, 471)) ? ("Retirer de la wishlist") : ("Ajouter à la wishlist"));
                    yield "\"
                                        title=\"";
                    // line 472
                    yield ((CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "wishlisted", [], "any", false, false, false, 472)) ? ("Retirer de la wishlist") : ("Ajouter à la wishlist"));
                    yield "\">
                                    <svg viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                                        <path d=\"M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z\" />
                                    </svg>
                                </button>
                            ";
                }
                // line 478
                yield "                        </div>
                        
                        <p class=\"reference\">";
                // line 480
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "location", [], "any", false, false, false, 480), "html", null, true);
                yield " | Réf. ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "reference", [], "any", false, false, false, 480), "html", null, true);
                yield "</p>
                        
                        <div class=\"tags\">
                            <span class=\"tag\">";
                // line 483
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "duration", [], "any", false, false, false, 483), "html", null, true);
                yield "</span>
                            <span class=\"tag\">";
                // line 484
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "level", [], "any", false, false, false, 484), "html", null, true);
                yield "</span>
                            ";
                // line 485
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "tags", [], "any", false, false, false, 485));
                foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                    // line 486
                    yield "                                <span class=\"";
                    yield ((CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "optional", [], "any", false, false, false, 486)) ? ("tag_optional") : ("tag"));
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "name", [], "any", false, false, false, 486), "html", null, true);
                    yield "</span>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['tag'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 488
                yield "                        </div>
                        
                        <p>Commence le : ";
                // line 490
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "startDate", [], "any", false, false, false, 490), "html", null, true);
                yield "</p>
                        <p class=\"";
                // line 491
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "remuneration", [], "any", false, false, false, 491) == 0)) ? ("remuneration_negative") : ("remuneration"));
                yield "\">
                            ";
                // line 492
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "remuneration", [], "any", false, false, false, 492) == 0)) ? ("Non Rémunéré") : ("Rémunéré"));
                yield "
                        </p>
                        
                        ";
                // line 495
                if (CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "highlighted", [], "any", false, false, false, 495)) {
                    // line 496
                    yield "                            <p class=\"tag_star\">Candidat star !</p>
                        ";
                }
                // line 498
                yield "                        
                        ";
                // line 499
                if (CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "wishlisted", [], "any", false, false, false, 499)) {
                    // line 500
                    yield "                            <p class=\"wishlist-badge\">Dans votre wishlist</p>
                        ";
                }
                // line 502
                yield "                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['offer'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 504
            yield "            </div>
        ";
        } else {
            // line 506
            yield "            <div class=\"empty-offers\">
                <p>Cette entreprise n'a pas d'offres de stage actives actuellement.</p>
            </div>
        ";
        }
        // line 510
        yield "    </section>
</div>

";
        // line 513
        if (($context["canEvaluate"] ?? null)) {
            // line 514
            yield "<!-- Evaluation Modal -->
<div class=\"evaluation-modal\" id=\"evaluationModal\">
    <div class=\"modal-content\">
        <div class=\"modal-header\">
            <h3>Évaluer ";
            // line 518
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 518), "html", null, true);
            yield "</h3>
        </div>
        
        <form id=\"ratingForm\" action=\"/api/evaluate-enterprise\" method=\"POST\">
            <input type=\"hidden\" name=\"enterpriseId\" value=\"";
            // line 522
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "id_enterprise", [], "any", false, false, false, 522), "html", null, true);
            yield "\">
            <input type=\"hidden\" name=\"rating\" id=\"ratingValue\" value=\"0\">
            
            <div class=\"star-rating\" id=\"starRating\">
                ";
            // line 526
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(1, 5));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 527
                yield "                    <span class=\"rating-star\" data-value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                yield "\">★</span>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 529
            yield "            </div>
            
            <div class=\"modal-actions\">
                <button type=\"button\" class=\"btn-cancel\" id=\"cancelEvaluation\">Annuler</button>
                <button type=\"submit\" class=\"btn-submit-rating\" id=\"submitRating\" disabled>Soumettre</button>
            </div>
        </form>
    </div>
</div>
";
        }
        yield from [];
    }

    // line 541
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 542
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Wishlist functionality
            const wishlistButtons = document.querySelectorAll('.wishlist-star');
            
            wishlistButtons.forEach(button => {
                button.addEventListener('click', async (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const offerId = button.dataset.id;
                    
                    try {
                        // Send request to toggle wishlist status
                        const response = await fetch(`/API/wishlist/toggle/\${offerId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            // Update button state
                            button.classList.toggle('active', data.wishlisted);
                            button.setAttribute('aria-label', data.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist');
                            button.setAttribute('title', data.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist');
                            
                            // Update wishlist badge
                            const offerCard = button.closest('.offre-card');
                            let wishlistBadge = offerCard.querySelector('.wishlist-badge');
                            
                            if (data.wishlisted) {
                                if (!wishlistBadge) {
                                    wishlistBadge = document.createElement('p');
                                    wishlistBadge.className = 'wishlist-badge';
                                    wishlistBadge.textContent = 'Dans votre wishlist';
                                    offerCard.appendChild(wishlistBadge);
                                }
                            } else {
                                if (wishlistBadge) {
                                    wishlistBadge.remove();
                                }
                            }
                            
                            // Show notification
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'success');
                            }
                        } else {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }
                            
                            // Show error notification
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'error');
                            }
                        }
                    } catch (error) {
                        console.error('Error toggling wishlist:', error);
                        
                        // Show error notification
                        if (typeof addNotification === 'function') {
                            addNotification('Une erreur est survenue lors de la mise à jour de votre wishlist.', 'error');
                        }
                    }
                });
            });
            
            // Click handler for offer cards
            const offerCards = document.querySelectorAll('.offre-card');
            
            offerCards.forEach(card => {
                card.addEventListener('click', (e) => {
                    // Don't navigate if clicking on the wishlist star
                    if (!e.target.closest('.wishlist-star')) {
                        window.location.href = `/offres/\${card.dataset.id}`;
                    }
                });
            });
            
            // Evaluation modal functionality
            const evaluateBtn = document.getElementById('evaluateBtn');
            const evaluationModal = document.getElementById('evaluationModal');
            const cancelEvaluationBtn = document.getElementById('cancelEvaluation');
            const starRating = document.getElementById('starRating');
            const ratingStars = document.querySelectorAll('.rating-star');
            const ratingValueInput = document.getElementById('ratingValue');
            const submitRatingBtn = document.getElementById('submitRating');
            const ratingForm = document.getElementById('ratingForm');
            
            if (evaluateBtn) {
                evaluateBtn.addEventListener('click', () => {
                    evaluationModal.style.display = 'block';
                });
            }
            
            if (cancelEvaluationBtn) {
                cancelEvaluationBtn.addEventListener('click', () => {
                    evaluationModal.style.display = 'none';
                    
                    // Reset rating
                    ratingStars.forEach(star => star.classList.remove('selected'));
                    ratingValueInput.value = '0';
                    submitRatingBtn.disabled = true;
                });
            }
            
            // Close modal when clicking outside
            if (evaluationModal) {
                evaluationModal.addEventListener('click', (e) => {
                    if (e.target === evaluationModal) {
                        evaluationModal.style.display = 'none';
                        
                        // Reset rating
                        ratingStars.forEach(star => star.classList.remove('selected'));
                        ratingValueInput.value = '0';
                        submitRatingBtn.disabled = true;
                    }
                });
            }
            
            // Star rating functionality
            if (starRating) {
                ratingStars.forEach(star => {
                    star.addEventListener('mouseover', () => {
                        const value = parseInt(star.dataset.value);
                        
                        // Highlight stars up to the hovered one
                        ratingStars.forEach(s => {
                            const starValue = parseInt(s.dataset.value);
                            if (starValue <= value) {
                                s.style.color = 'var(--primary-color)';
                            } else {
s.style.color = 'var(--real-grey)';
                           }
                       });
                   });
                   
                   star.addEventListener('mouseout', () => {
                       // Reset colors to match selected state
                       ratingStars.forEach(s => {
                           if (s.classList.contains('selected')) {
                               s.style.color = 'var(--primary-color)';
                           } else {
                               s.style.color = 'var(--real-grey)';
                           }
                       });
                   });
                   
                   star.addEventListener('click', () => {
                       const value = parseInt(star.dataset.value);
                       
                       // Update selected stars
                       ratingStars.forEach(s => {
                           const starValue = parseInt(s.dataset.value);
                           s.classList.toggle('selected', starValue <= value);
                       });
                       
                       // Update hidden input
                       ratingValueInput.value = value;
                       
                       // Enable submit button
                       submitRatingBtn.disabled = false;
                   });
               });
           }
           
           // Handle form submission
           if (ratingForm) {
               ratingForm.addEventListener('submit', async (e) => {
                   e.preventDefault();
                   
                   const formData = new FormData(ratingForm);
                   
                   try {
                       const response = await fetch('/api/evaluate-enterprise', {
                           method: 'POST',
                           body: formData
                       });
                       
                       const data = await response.json();
                       
                       if (data.success) {
                           // Show success notification
                           if (typeof addNotification === 'function') {
                               addNotification(data.message, 'success');
                           }
                           
                           // Close modal
                           evaluationModal.style.display = 'none';
                           
                           // Reload page to show updated rating
                           setTimeout(() => {
                               window.location.reload();
                           }, 1000);
                       } else {
                           // Show error notification
                           if (typeof addNotification === 'function') {
                               addNotification(data.message, 'error');
                           }
                       }
                   } catch (error) {
                       console.error('Error submitting rating:', error);
                       
                       // Show error notification
                       if (typeof addNotification === 'function') {
                           addNotification('Une erreur est survenue lors de l\\'évaluation de l\\'entreprise.', 'error');
                       }
                   }
               });
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
        return "enterprises/show.html.twig";
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
        return array (  828 => 542,  821 => 541,  806 => 529,  797 => 527,  793 => 526,  786 => 522,  779 => 518,  773 => 514,  771 => 513,  766 => 510,  760 => 506,  756 => 504,  749 => 502,  745 => 500,  743 => 499,  740 => 498,  736 => 496,  734 => 495,  728 => 492,  724 => 491,  720 => 490,  716 => 488,  705 => 486,  701 => 485,  697 => 484,  693 => 483,  685 => 480,  681 => 478,  672 => 472,  668 => 471,  664 => 470,  657 => 469,  655 => 468,  651 => 467,  641 => 465,  637 => 464,  634 => 463,  632 => 462,  626 => 458,  619 => 454,  614 => 451,  612 => 450,  607 => 447,  603 => 445,  601 => 444,  598 => 443,  592 => 441,  590 => 440,  581 => 433,  577 => 431,  571 => 429,  556 => 423,  551 => 422,  549 => 421,  544 => 418,  540 => 416,  534 => 414,  532 => 413,  523 => 407,  515 => 402,  509 => 398,  496 => 389,  494 => 388,  488 => 385,  477 => 377,  467 => 370,  462 => 367,  456 => 365,  448 => 363,  446 => 362,  437 => 356,  431 => 352,  424 => 351,  74 => 6,  67 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ enterprise.enterprise_name }} - Détails - {{ parent() }}{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .enterprise-header {
            background-color: var(--background-nav);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            margin-bottom: 2rem;
            position: relative;
        }
        
        .enterprise-info {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
        }
        
        .enterprise-logo {
            width: 120px;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--tag-background);
            flex-shrink: 0;
        }
        
        .enterprise-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        
        .placeholder-logo {
            font-size: 3rem;
            color: var(--primary-color);
        }
        
        .enterprise-details {
            flex-grow: 1;
        }
        
        .enterprise-details h1 {
            margin: 0 0 1rem 0;
            color: var(--onyx);
            font-size: 2rem;
        }
        
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--real-grey);
        }
        
        .enterprise-stats {
            display: flex;
            gap: 2rem;
            margin-top: 1.5rem;
        }
        
        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--real-grey);
        }
        
        .rating-stars {
            display: flex;
            gap: 0.25rem;
            margin-top: 0.5rem;
        }
        
        .star {
            color: var(--realsecondary-color);
        }
        
        .star.filled {
            color: var(--primary-color);
        }
        
        .enterprise-actions {
            position: absolute;
            top: 2rem;
            right: 2rem;
            display: flex;
            gap: 1rem;
        }
        
        .btn-edit {
            background-color: var(--secondary-color);
            color: var(--secondary-text);
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }
        
        .btn-evaluate {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }
        
        .enterprise-description {
            background-color: var(--background-nav);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            margin-bottom: 2rem;
        }
        
        .enterprise-description h2 {
            margin-top: 0;
            margin-bottom: 1rem;
            color: var(--primary-color);
            font-size: 1.5rem;
        }
        
        .enterprise-offers {
            background-color: var(--background-nav);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            margin-bottom: 2rem;
        }
        
        .enterprise-offers h2 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            font-size: 1.5rem;
        }
        
        .offers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .empty-offers {
            text-align: center;
            padding: 2rem;
            color: var(--real-grey);
        }
        
        .offre-card {
            border: 1px solid var(--real-grey);
            border-radius: 8px;
            padding: 1.5rem;
            transition: transform 0.2s ease;
            cursor: pointer;
        }
        
        .offre-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px var(--shadow-color);
        }
        
        .offre-card.highlighted {
            border: 2px solid var(--primary-color);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            margin-bottom: 0.5rem;
            position: relative;
        }
        
        .card-header h3 {
            margin: 0;
            flex: 1;
            padding-right: 30px;
        }
        
        .wishlist-star {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--real-grey);
            padding: 0;
            position: absolute;
            top: 0;
            right: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .wishlist-star svg {
            fill: transparent;
            stroke: var(--realsecondary-color);
            stroke-width: 1.5;
            transition: all 0.3s ease;
        }
        
        .wishlist-star.active svg {
            fill: var(--primary-color);
            stroke: var(--primary-color);
        }
        
        .evaluation-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: auto;
        }
        
        .modal-content {
            background-color: var(--background-nav);
            margin: 10% auto;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        
        .modal-header {
            margin-bottom: 1.5rem;
        }
        
        .modal-header h3 {
            margin: 0;
            color: var(--onyx);
        }
        
        .star-rating {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .rating-star {
            font-size: 2rem;
            color: var(--real-grey);
            cursor: pointer;
        }
        
        .rating-star.selected {
            color: var(--primary-color);
        }
        
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }
        
        .btn-cancel {
            background-color: var(--real-lgrey);
            border: 1px solid var(--real-grey);
            color: var(--onyx);
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn-submit-rating {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .website-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            text-decoration: none;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .website-link:hover {
            text-decoration: underline;
        }
        
        @media screen and (max-width: 768px) {
            .enterprise-info {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .contact-info {
                align-items: center;
            }
            
            .enterprise-stats {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .enterprise-actions {
                position: static;
                margin-top: 1.5rem;
                justify-content: center;
            }
            
            .offers-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
{% endblock %}

{% block content %}
<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span><a href=\"/entreprises\">Entreprises</a></span>
        <span>{{ enterprise.enterprise_name }}</span>
    </nav>

    <section class=\"enterprise-header\">
        <div class=\"enterprise-info\">
            <div class=\"enterprise-logo\">
                {% if enterprise.enterprise_photo_url %}
                    <img src=\"{{ enterprise.enterprise_photo_url }}\" alt=\"{{ enterprise.enterprise_name }}\">
                {% else %}
                    <div class=\"placeholder-logo\">{{ enterprise.enterprise_name|first|upper }}</div>
                {% endif %}
            </div>
            
            <div class=\"enterprise-details\">
                <h1>{{ enterprise.enterprise_name }}</h1>
                
                <div class=\"contact-info\">
                    <div class=\"contact-item\">
                        <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                            <path d=\"M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" />
                        </svg>
                        {{ enterprise.enterprise_phone }}
                    </div>
                    
                    <div class=\"contact-item\">
                        <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                            <path d=\"M22 12h-4l-3 3-3-3H7\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                            <path d=\"M12 22l10-10M2 12l10 10M10 2l4 4-4 4\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                        </svg>
                        {{ enterprise.enterprise_email }}
                    </div>
                    
                    {% if enterprise.enterprise_site %}
                        <a href=\"{{ enterprise.enterprise_site }}\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"website-link\">
                            <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                <path d=\"M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                                <path d=\"M15 3h6v6\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                                <path d=\"M10 14L21 3\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                            </svg>
                            Visiter le site web
                        </a>
                    {% endif %}
                </div>
                
                <div class=\"enterprise-stats\">
                    <div class=\"stat-item\">
                        <span class=\"stat-value\">{{ applicationCount }}</span>
                        <span class=\"stat-label\">Candidatures</span>
                    </div>
                    
                    <div class=\"stat-item\">
                        <span class=\"stat-value\">{{ offers|length }}</span>
                        <span class=\"stat-label\">Offres actives</span>
                    </div>
                    
                    <div class=\"stat-item\">
                        <span class=\"stat-value\">
                            {% if ratings.average_rating is not null %}
                                {{ ratings.average_rating|number_format(1) }}
                            {% else %}
                                -
                            {% endif %}
                        </span>
                        <span class=\"stat-label\">Note moyenne</span>
                        <div class=\"rating-stars\">
                            {% if ratings.average_rating is not null %}
                                {% for i in 1..5 %}
                                    <span class=\"star {% if i <= ratings.average_rating|round(0, 'floor') %}filled{% endif %}\">
                                        <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                            <path d=\"M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z\" />
                                        </svg>
                                    </span>
                                {% endfor %}
                                <span class=\"stat-label\">({{ ratings.comment_count }})</span>
                            {% else %}
                                <span class=\"stat-label\">Aucune évaluation</span>
                            {% endif %}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class=\"enterprise-actions\">
            {% if canEdit %}
                <a href=\"/entreprises/{{ enterprise.id_enterprise }}/edit\" class=\"btn-edit\">Modifier</a>
            {% endif %}
            
            {% if canEvaluate %}
                <button class=\"btn-evaluate\" id=\"evaluateBtn\">Évaluer</button>
            {% endif %}
        </div>
    </section>
    
    {% if enterprise.enterprise_description_url %}
        <section class=\"enterprise-description\">
            <h2>À propos de l'entreprise</h2>
            <div class=\"description-content\">
                {{ enterprise.enterprise_description_url|raw }}
            </div>
        </section>
    {% endif %}
    
    <section class=\"enterprise-offers\">
        <h2>Offres de stage</h2>
        
        {% if offers|length > 0 %}
            <div class=\"offers-grid\">
                {% for offer in offers %}
                    <div class=\"offre-card {% if offer.highlighted %}highlighted{% endif %}\" data-id=\"{{ offer.id }}\">
                        <div class=\"card-header\">
                            <h3>{{ offer.title }}</h3>
                            {% if request.hasPermission('perm_wishlist') %}
                                <button class=\"wishlist-star {% if offer.wishlisted %}active{% endif %}\" 
                                        data-id=\"{{ offer.id }}\" 
                                        aria-label=\"{{ offer.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist' }}\"
                                        title=\"{{ offer.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist' }}\">
                                    <svg viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                                        <path d=\"M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z\" />
                                    </svg>
                                </button>
                            {% endif %}
                        </div>
                        
                        <p class=\"reference\">{{ offer.location }} | Réf. {{ offer.reference }}</p>
                        
                        <div class=\"tags\">
                            <span class=\"tag\">{{ offer.duration }}</span>
                            <span class=\"tag\">{{ offer.level }}</span>
                            {% for tag in offer.tags %}
                                <span class=\"{{ tag.optional ? 'tag_optional' : 'tag' }}\">{{ tag.name }}</span>
                            {% endfor %}
                        </div>
                        
                        <p>Commence le : {{ offer.startDate }}</p>
                        <p class=\"{{ offer.remuneration == 0 ? 'remuneration_negative' : 'remuneration' }}\">
                            {{ offer.remuneration == 0 ? 'Non Rémunéré' : 'Rémunéré' }}
                        </p>
                        
                        {% if offer.highlighted %}
                            <p class=\"tag_star\">Candidat star !</p>
                        {% endif %}
                        
                        {% if offer.wishlisted %}
                            <p class=\"wishlist-badge\">Dans votre wishlist</p>
                        {% endif %}
                    </div>
                {% endfor %}
            </div>
        {% else %}
            <div class=\"empty-offers\">
                <p>Cette entreprise n'a pas d'offres de stage actives actuellement.</p>
            </div>
        {% endif %}
    </section>
</div>

{% if canEvaluate %}
<!-- Evaluation Modal -->
<div class=\"evaluation-modal\" id=\"evaluationModal\">
    <div class=\"modal-content\">
        <div class=\"modal-header\">
            <h3>Évaluer {{ enterprise.enterprise_name }}</h3>
        </div>
        
        <form id=\"ratingForm\" action=\"/api/evaluate-enterprise\" method=\"POST\">
            <input type=\"hidden\" name=\"enterpriseId\" value=\"{{ enterprise.id_enterprise }}\">
            <input type=\"hidden\" name=\"rating\" id=\"ratingValue\" value=\"0\">
            
            <div class=\"star-rating\" id=\"starRating\">
                {% for i in 1..5 %}
                    <span class=\"rating-star\" data-value=\"{{ i }}\">★</span>
                {% endfor %}
            </div>
            
            <div class=\"modal-actions\">
                <button type=\"button\" class=\"btn-cancel\" id=\"cancelEvaluation\">Annuler</button>
                <button type=\"submit\" class=\"btn-submit-rating\" id=\"submitRating\" disabled>Soumettre</button>
            </div>
        </form>
    </div>
</div>
{% endif %}
{% endblock %}

{% block javascripts %}
    {{ parent() }}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Wishlist functionality
            const wishlistButtons = document.querySelectorAll('.wishlist-star');
            
            wishlistButtons.forEach(button => {
                button.addEventListener('click', async (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const offerId = button.dataset.id;
                    
                    try {
                        // Send request to toggle wishlist status
                        const response = await fetch(`/API/wishlist/toggle/\${offerId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            // Update button state
                            button.classList.toggle('active', data.wishlisted);
                            button.setAttribute('aria-label', data.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist');
                            button.setAttribute('title', data.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist');
                            
                            // Update wishlist badge
                            const offerCard = button.closest('.offre-card');
                            let wishlistBadge = offerCard.querySelector('.wishlist-badge');
                            
                            if (data.wishlisted) {
                                if (!wishlistBadge) {
                                    wishlistBadge = document.createElement('p');
                                    wishlistBadge.className = 'wishlist-badge';
                                    wishlistBadge.textContent = 'Dans votre wishlist';
                                    offerCard.appendChild(wishlistBadge);
                                }
                            } else {
                                if (wishlistBadge) {
                                    wishlistBadge.remove();
                                }
                            }
                            
                            // Show notification
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'success');
                            }
                        } else {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }
                            
                            // Show error notification
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'error');
                            }
                        }
                    } catch (error) {
                        console.error('Error toggling wishlist:', error);
                        
                        // Show error notification
                        if (typeof addNotification === 'function') {
                            addNotification('Une erreur est survenue lors de la mise à jour de votre wishlist.', 'error');
                        }
                    }
                });
            });
            
            // Click handler for offer cards
            const offerCards = document.querySelectorAll('.offre-card');
            
            offerCards.forEach(card => {
                card.addEventListener('click', (e) => {
                    // Don't navigate if clicking on the wishlist star
                    if (!e.target.closest('.wishlist-star')) {
                        window.location.href = `/offres/\${card.dataset.id}`;
                    }
                });
            });
            
            // Evaluation modal functionality
            const evaluateBtn = document.getElementById('evaluateBtn');
            const evaluationModal = document.getElementById('evaluationModal');
            const cancelEvaluationBtn = document.getElementById('cancelEvaluation');
            const starRating = document.getElementById('starRating');
            const ratingStars = document.querySelectorAll('.rating-star');
            const ratingValueInput = document.getElementById('ratingValue');
            const submitRatingBtn = document.getElementById('submitRating');
            const ratingForm = document.getElementById('ratingForm');
            
            if (evaluateBtn) {
                evaluateBtn.addEventListener('click', () => {
                    evaluationModal.style.display = 'block';
                });
            }
            
            if (cancelEvaluationBtn) {
                cancelEvaluationBtn.addEventListener('click', () => {
                    evaluationModal.style.display = 'none';
                    
                    // Reset rating
                    ratingStars.forEach(star => star.classList.remove('selected'));
                    ratingValueInput.value = '0';
                    submitRatingBtn.disabled = true;
                });
            }
            
            // Close modal when clicking outside
            if (evaluationModal) {
                evaluationModal.addEventListener('click', (e) => {
                    if (e.target === evaluationModal) {
                        evaluationModal.style.display = 'none';
                        
                        // Reset rating
                        ratingStars.forEach(star => star.classList.remove('selected'));
                        ratingValueInput.value = '0';
                        submitRatingBtn.disabled = true;
                    }
                });
            }
            
            // Star rating functionality
            if (starRating) {
                ratingStars.forEach(star => {
                    star.addEventListener('mouseover', () => {
                        const value = parseInt(star.dataset.value);
                        
                        // Highlight stars up to the hovered one
                        ratingStars.forEach(s => {
                            const starValue = parseInt(s.dataset.value);
                            if (starValue <= value) {
                                s.style.color = 'var(--primary-color)';
                            } else {
s.style.color = 'var(--real-grey)';
                           }
                       });
                   });
                   
                   star.addEventListener('mouseout', () => {
                       // Reset colors to match selected state
                       ratingStars.forEach(s => {
                           if (s.classList.contains('selected')) {
                               s.style.color = 'var(--primary-color)';
                           } else {
                               s.style.color = 'var(--real-grey)';
                           }
                       });
                   });
                   
                   star.addEventListener('click', () => {
                       const value = parseInt(star.dataset.value);
                       
                       // Update selected stars
                       ratingStars.forEach(s => {
                           const starValue = parseInt(s.dataset.value);
                           s.classList.toggle('selected', starValue <= value);
                       });
                       
                       // Update hidden input
                       ratingValueInput.value = value;
                       
                       // Enable submit button
                       submitRatingBtn.disabled = false;
                   });
               });
           }
           
           // Handle form submission
           if (ratingForm) {
               ratingForm.addEventListener('submit', async (e) => {
                   e.preventDefault();
                   
                   const formData = new FormData(ratingForm);
                   
                   try {
                       const response = await fetch('/api/evaluate-enterprise', {
                           method: 'POST',
                           body: formData
                       });
                       
                       const data = await response.json();
                       
                       if (data.success) {
                           // Show success notification
                           if (typeof addNotification === 'function') {
                               addNotification(data.message, 'success');
                           }
                           
                           // Close modal
                           evaluationModal.style.display = 'none';
                           
                           // Reload page to show updated rating
                           setTimeout(() => {
                               window.location.reload();
                           }, 1000);
                       } else {
                           // Show error notification
                           if (typeof addNotification === 'function') {
                               addNotification(data.message, 'error');
                           }
                       }
                   } catch (error) {
                       console.error('Error submitting rating:', error);
                       
                       // Show error notification
                       if (typeof addNotification === 'function') {
                           addNotification('Une erreur est survenue lors de l\\'évaluation de l\\'entreprise.', 'error');
                       }
                   }
               });
           }
       });
   </script>
{% endblock %}", "enterprises/show.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\enterprises\\show.html.twig");
    }
}
