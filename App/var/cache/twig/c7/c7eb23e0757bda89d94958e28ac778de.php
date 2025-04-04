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

        /* Commentaires Section */
        .comments-section {
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 2rem;
            margin-top: 2rem;
        }

        .comments-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .comments-header h2 {
            margin: 0;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .comments-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .comment-card {
            background-color: white;
            border-radius: 8px;
            padding: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .comment-author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .comment-body {
            flex-grow: 1;
        }

        .comment-author {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .comment-text {
            color: var(--onyx);
        }

        .comment-date {
            color: var(--real-grey);
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        .comment-form {
            margin-top: 1rem;
            display: flex;
            gap: 1rem;
        }

        .comment-form textarea {
            flex-grow: 1;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            resize: vertical;
            min-height: 100px;
        }

        .comment-form button {
            align-self: flex-start;
            padding: 0.8rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comments-pagination {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
            gap: 1rem;
        }

        .star-rating {
            display: flex;
            gap: 0.25rem;
            margin-top: 0.5rem;
        }

        .star {
            color: #000;
        }

        .star.filled {
            color: var(--primary-color);
        }
        .rating-input {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .rating-input label {
            font-weight: bold;
            color: var(--onyx);
        }

        .rating-input .star-rating {
            display: flex;
            gap: 0.25rem;
        }

        .rating-input .rating-star {
            font-size: 1.5rem;
            color: #000;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .rating-input .rating-star.selected {
            color: var(--primary-color);
        }
        .comment-form {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .rating-input {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .rating-input label {
            font-weight: bold;
            color: var(--onyx);
        }

        .rating-input .star-rating {
            display: flex;
            gap: 0.25rem;
        }

        .rating-input .rating-star {
            font-size: 1.5rem;
            color: #000;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .rating-input .rating-star.selected {
            color: var(--primary-color);
        }

        .comment-form textarea {
            flex-grow: 1;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            resize: vertical;
            min-height: 100px;
        }

        .comment-form button {
            align-self: flex-start;
            padding: 0.8rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            display: none; /* Hidden by default */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>
";
        yield from [];
    }

    // line 555
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 556
        yield "<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span><a href=\"/entreprises\">Entreprises</a></span>
        <span>";
        // line 560
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 560), "html", null, true);
        yield "</span>
    </nav>

    <section class=\"enterprise-header\">
        <div class=\"enterprise-info\">
            <div class=\"enterprise-logo\">
                ";
        // line 566
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_photo_url", [], "any", false, false, false, 566)) {
            // line 567
            yield "                    <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_photo_url", [], "any", false, false, false, 567), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 567), "html", null, true);
            yield "\">
                ";
        } else {
            // line 569
            yield "                    <div class=\"placeholder-logo\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 569))), "html", null, true);
            yield "</div>
                ";
        }
        // line 571
        yield "            </div>
            
            <div class=\"enterprise-details\">
                <h1>";
        // line 574
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 574), "html", null, true);
        yield "</h1>
                
                <div class=\"contact-info\">
                    <div class=\"contact-item\">
                        <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                            <path d=\"M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" />
                        </svg>
                        ";
        // line 581
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_phone", [], "any", false, false, false, 581), "html", null, true);
        yield "
                    </div>
                    
                    <div class=\"contact-item\">
                        <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                            <path d=\"M22 12h-4l-3 3-3-3H7\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                            <path d=\"M12 22l10-10M2 12l10 10M10 2l4 4-4 4\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                        </svg>
                        ";
        // line 589
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_email", [], "any", false, false, false, 589), "html", null, true);
        yield "
                    </div>
                    
                    ";
        // line 592
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_site", [], "any", false, false, false, 592)) {
            // line 593
            yield "                        <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_site", [], "any", false, false, false, 593), "html", null, true);
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
        // line 602
        yield "                </div>
                
                <div class=\"enterprise-stats\">
                    <div class=\"stat-item\">
                        <span class=\"stat-value\">";
        // line 606
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["applicationCount"] ?? null), "html", null, true);
        yield "</span>
                        <span class=\"stat-label\">Candidatures</span>
                    </div>
                    
                    <div class=\"stat-item\">
                        <span class=\"stat-value\">";
        // line 611
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["offers"] ?? null)), "html", null, true);
        yield "</span>
                        <span class=\"stat-label\">Offres actives</span>
                    </div>
                    
                    <div class=\"stat-item\">
                        <span class=\"stat-value\">
                            ";
        // line 617
        if ( !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["ratings"] ?? null), "average_rating", [], "any", false, false, false, 617))) {
            // line 618
            yield "                                ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, ($context["ratings"] ?? null), "average_rating", [], "any", false, false, false, 618), 1), "html", null, true);
            yield "
                            ";
        } else {
            // line 620
            yield "                                -
                            ";
        }
        // line 622
        yield "                        </span>
                        <span class=\"stat-label\">Note moyenne</span>
                        <div class=\"rating-stars\">
                            ";
        // line 625
        if ( !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["ratings"] ?? null), "average_rating", [], "any", false, false, false, 625))) {
            // line 626
            yield "                                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(1, 5));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 627
                yield "                                    <span class=\"star ";
                if (($context["i"] <= Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, ($context["ratings"] ?? null), "average_rating", [], "any", false, false, false, 627), 0, "floor"))) {
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
            // line 633
            yield "                                <span class=\"stat-label\">(";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["ratings"] ?? null), "comment_count", [], "any", false, false, false, 633), "html", null, true);
            yield ")</span>
                            ";
        } else {
            // line 635
            yield "                                <span class=\"stat-label\">Aucune évaluation</span>
                            ";
        }
        // line 637
        yield "                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class=\"enterprise-actions\">
            ";
        // line 644
        if (($context["canEdit"] ?? null)) {
            // line 645
            yield "                <a href=\"/entreprises/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "id_enterprise", [], "any", false, false, false, 645), "html", null, true);
            yield "/edit\" class=\"btn-edit\">Modifier</a>
            ";
        }
        // line 647
        yield "            
        </div>
    </section>
    
    ";
        // line 651
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_description_url", [], "any", false, false, false, 651)) {
            // line 652
            yield "        <section class=\"enterprise-description\">
            <h2>À propos de l'entreprise</h2>
            <div class=\"description-content\">
                ";
            // line 655
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_description_url", [], "any", false, false, false, 655), "html", null, true));
            yield "
            </div>
        </section>
    ";
        }
        // line 659
        yield "    
    <section class=\"enterprise-offers\">
        <h2>Offres de stage</h2>
        
        ";
        // line 663
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["offers"] ?? null)) > 0)) {
            // line 664
            yield "            <div class=\"offers-grid\">
                ";
            // line 665
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["offers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["offer"]) {
                // line 666
                yield "                    <div class=\"offre-card ";
                if (CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "highlighted", [], "any", false, false, false, 666)) {
                    yield "highlighted";
                }
                yield "\" data-id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "id", [], "any", false, false, false, 666), "html", null, true);
                yield "\">
                        <div class=\"card-header\">
                            <h3>";
                // line 668
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "title", [], "any", false, false, false, 668), "html", null, true);
                yield "</h3>
                            ";
                // line 669
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_wishlist"], "method", false, false, false, 669)) {
                    // line 670
                    yield "                                <button class=\"wishlist-star ";
                    if (CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "wishlisted", [], "any", false, false, false, 670)) {
                        yield "active";
                    }
                    yield "\" 
                                        data-id=\"";
                    // line 671
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "id", [], "any", false, false, false, 671), "html", null, true);
                    yield "\" 
                                        aria-label=\"";
                    // line 672
                    yield ((CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "wishlisted", [], "any", false, false, false, 672)) ? ("Retirer de la wishlist") : ("Ajouter à la wishlist"));
                    yield "\"
                                        title=\"";
                    // line 673
                    yield ((CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "wishlisted", [], "any", false, false, false, 673)) ? ("Retirer de la wishlist") : ("Ajouter à la wishlist"));
                    yield "\">
                                    <svg viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                                        <path d=\"M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z\" />
                                    </svg>
                                </button>
                            ";
                }
                // line 679
                yield "                        </div>
                        
                        <p class=\"reference\">";
                // line 681
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "location", [], "any", false, false, false, 681), "html", null, true);
                yield " | Réf. ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "reference", [], "any", false, false, false, 681), "html", null, true);
                yield "</p>
                        
                        <div class=\"tags\">
                            <span class=\"tag\">";
                // line 684
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "duration", [], "any", false, false, false, 684), "html", null, true);
                yield "</span>
                            <span class=\"tag\">";
                // line 685
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "level", [], "any", false, false, false, 685), "html", null, true);
                yield "</span>
                            ";
                // line 686
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "tags", [], "any", false, false, false, 686));
                foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                    // line 687
                    yield "                                <span class=\"";
                    yield ((CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "optional", [], "any", false, false, false, 687)) ? ("tag_optional") : ("tag"));
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "name", [], "any", false, false, false, 687), "html", null, true);
                    yield "</span>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['tag'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 689
                yield "                        </div>
                        
                        <p>Commence le : ";
                // line 691
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "startDate", [], "any", false, false, false, 691), "html", null, true);
                yield "</p>
                        <p class=\"";
                // line 692
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "remuneration", [], "any", false, false, false, 692) == 0)) ? ("remuneration_negative") : ("remuneration"));
                yield "\">
                            ";
                // line 693
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "remuneration", [], "any", false, false, false, 693) == 0)) ? ("Non Rémunéré") : ("Rémunéré"));
                yield "
                        </p>
                        
                        ";
                // line 696
                if (CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "highlighted", [], "any", false, false, false, 696)) {
                    // line 697
                    yield "                            <p class=\"tag_star\">Candidat star !</p>
                        ";
                }
                // line 699
                yield "                        
                        ";
                // line 700
                if (CoreExtension::getAttribute($this->env, $this->source, $context["offer"], "wishlisted", [], "any", false, false, false, 700)) {
                    // line 701
                    yield "                            <p class=\"wishlist-badge\">Dans votre wishlist</p>
                        ";
                }
                // line 703
                yield "                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['offer'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 705
            yield "            </div>
        ";
        } else {
            // line 707
            yield "            <div class=\"empty-offers\">
                <p>Cette entreprise n'a pas d'offres de stage actives actuellement.</p>
            </div>
        ";
        }
        // line 711
        yield "    </section>
</div>

<section class=\"comments-section\">
    <div class=\"comments-header\">
        <h2>Commentaires</h2>
    </div>

    ";
        // line 719
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_grade_company"], "method", false, false, false, 719)) {
            // line 720
            yield "    <div class=\"comment-form\">
        <div class=\"rating-input\">
            <label>Note : </label>
            <div id=\"starRating\" class=\"star-rating\">
                <span class=\"rating-star\" data-value=\"1\">★</span>
                <span class=\"rating-star\" data-value=\"2\">★</span>
                <span class=\"rating-star\" data-value=\"3\">★</span>
                <span class=\"rating-star\" data-value=\"4\">★</span>
                <span class=\"rating-star\" data-value=\"5\">★</span>
            </div>
        </div>
        ";
            // line 731
            if ((array_key_exists("usercomment", $context) &&  !Twig\Extension\CoreExtension::testEmpty(($context["usercomment"] ?? null)))) {
                // line 732
                yield "            <textarea
            id=\"commentTextarea\"
            placeholder=\"Partagez votre expérience avec cette entreprise...\"
            maxlength=\"500\"
            >";
                // line 736
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["usercomment"] ?? null), "html", null, true);
                yield "</textarea>
        ";
            } else {
                // line 738
                yield "            <textarea
            id=\"commentTextarea\"
            placeholder=\"Partagez votre expérience avec cette entreprise...\"
            maxlength=\"500\"
            ></textarea>
        ";
            }
            // line 744
            yield "        <button id=\"submitCommentBtn\">Publier</button>
    </div>
    ";
        }
        // line 747
        yield "
    <div id=\"commentsList\" class=\"comments-list\">
        <!-- Commentaires seront chargés dynamiquement -->
    </div>

    <div id=\"commentsPagination\" class=\"comments-pagination\">
        <button id=\"prevCommentsBtn\" class=\"pagination-button\" disabled>Précédent</button>
        <span id=\"commentPageInfo\"></span>
        <button id=\"nextCommentsBtn\" class=\"pagination-button\" disabled>Suivant</button>
    </div>
</section>

";
        yield from [];
    }

    // line 761
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 762
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
                        const response = await fetch(`/API/wishlist/toggle/\${offerId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            button.classList.toggle('active', data.wishlisted);
                            button.setAttribute('aria-label', data.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist');
                            button.setAttribute('title', data.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist');

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

                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'success');
                            }
                        } else {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }

                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'error');
                            }
                        }
                    } catch (error) {
                        console.error('Error toggling wishlist:', error);

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
                    ratingStars.forEach(star => star.classList.remove('selected'));
                    ratingValueInput.value = '0';
                    submitRatingBtn.disabled = true;
                });
            }

            if (evaluationModal) {
                evaluationModal.addEventListener('click', (e) => {
                    if (e.target === evaluationModal) {
                        evaluationModal.style.display = 'none';
                        ratingStars.forEach(star => star.classList.remove('selected'));
                        ratingValueInput.value = '0';
                        submitRatingBtn.disabled = true;
                    }
                });
            }

            if (starRating) {
                ratingStars.forEach(star => {
                    star.addEventListener('mouseover', () => {
                        const value = parseInt(star.dataset.value);
                        ratingStars.forEach(s => {
                            const starValue = parseInt(s.dataset.value);
                            s.style.color = starValue <= value ? 'var(--primary-color)' : 'var(--real-grey)';
                        });
                    });

                    star.addEventListener('mouseout', () => {
                        ratingStars.forEach(s => {
                            s.style.color = s.classList.contains('selected') ? 'var(--primary-color)' : 'var(--real-grey)';
                        });
                    });

                    star.addEventListener('click', () => {
                        const value = parseInt(star.dataset.value);
                        ratingStars.forEach(s => {
                            const starValue = parseInt(s.dataset.value);
                            s.classList.toggle('selected', starValue <= value);
                        });
                        ratingValueInput.value = value;
                        submitRatingBtn.disabled = false;
                    });
                });
            }

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
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'success');
                            }
                            evaluationModal.style.display = 'none';
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'error');
                            }
                        }
                    } catch (error) {
                        console.error('Error submitting rating:', error);
                        if (typeof addNotification === 'function') {
                            addNotification('Une erreur est survenue lors de l\\'évaluation de l\\'entreprise.', 'error');
                        }
                    }
                });
            }

            // Comments functionality
            const commentsList = document.getElementById('commentsList');
            const prevCommentsBtn = document.getElementById('prevCommentsBtn');
            const nextCommentsBtn = document.getElementById('nextCommentsBtn');
            const commentPageInfo = document.getElementById('commentPageInfo');
            const spinner = document.createElement('div');
            spinner.className = 'spinner';
            commentsList.appendChild(spinner);

            let currentPage = 1;
            const commentsPerPage = 5;

            async function loadComments(page = 1) {
                spinner.style.display = 'block'; // Show spinner
                try {
                    const enterpriseId = \"";
        // line 954
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "id_enterprise", [], "any", false, false, false, 954), "html", null, true);
        yield "\";
                    const response = await fetch(`/API/entreprises/\${enterpriseId}/comments?page=\${page}&limit=\${commentsPerPage}`);
                    const data = await response.json();

                    if (data.success) {
                        commentsList.innerHTML = data.comments.map(comment => `
                            <div class=\"comment-card\">
                                <img
                                    src=\"\${comment.authorPhoto}\"
                                    alt=\"\${comment.author}\"
                                    class=\"comment-author-avatar\"
                                >
                                <div class=\"comment-body\">
                                    <div class=\"comment-author\">\${comment.author}</div>
                                    <div class=\"star-rating\">
                                        \${'★'.repeat(comment.grade).split('').map(() => `<span class=\"star filled\">★</span>`).join('')}
                                        \${'★'.repeat(5 - comment.grade).split('').map(() => `<span class=\"star\">★</span>`).join('')}
                                    </div>
                                    <div class=\"comment-text\">\${comment.text}</div>
                                </div>
                            </div>
                        `).join('');

                        commentsList.appendChild(spinner); // Re-add spinner to the DOM
                        currentPage = page;
                        commentPageInfo.textContent = `Page \${page} of \${data.totalPages}`;
                        prevCommentsBtn.disabled = page <= 1;
                        nextCommentsBtn.disabled = page >= data.totalPages;
                    } else {
                        console.error('Failed to load comments:', data.message);
                    }
                } catch (error) {
                    console.error('Error loading comments:', error);
                } finally {
                    spinner.style.display = 'none'; // Hide spinner
                }
            }

            ";
        // line 992
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_grade_company"], "method", false, false, false, 992)) {
            // line 993
            yield "                console.log('User has permission to evaluate and comment.');
                const submitCommentBtn = document.getElementById('submitCommentBtn');
                const commentTextarea = document.getElementById('commentTextarea');
                const ratingStarsComment = document.querySelectorAll('#starRating .rating-star');

                let selectedRating = 0;

                ratingStarsComment.forEach(star => {
                    star.addEventListener('click', () => {
                        const value = parseInt(star.dataset.value);
                        selectedRating = value;
                        ratingStarsComment.forEach(s => {
                            const starValue = parseInt(s.dataset.value);
                            s.classList.toggle('selected', starValue <= value);
                        });
                    });
                });

                async function submitComment() {
                    const commentText = commentTextarea.value.trim();

                    if (!commentText) {
                        if (typeof addNotification === 'function') {
                            addNotification('Le commentaire ne peut pas être vide', 'error');
                        } else {
                            alert('Le commentaire ne peut pas être vide');
                        }
                        return;
                    }

                    if (selectedRating === 0) {
                        if (typeof addNotification === 'function') {
                            addNotification('Veuillez sélectionner une note', 'error');
                        } else {
                            alert('Veuillez sélectionner une note');
                        }
                        return;
                    }

                    try {
                        const enterpriseId = \"";
            // line 1033
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "id_enterprise", [], "any", false, false, false, 1033), "html", null, true);
            yield "\";
                        const response = await fetch('/API/entreprises/comments', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                enterpriseId: enterpriseId,
                                commentText: commentText,
                                rating: selectedRating
                            })
                        });

                        const data = await response.json();
                        if (data.success) {
                            commentTextarea.value = '';
                            selectedRating = 0;
                            ratingStarsComment.forEach(star => star.classList.remove('selected'));
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'success');
                            }
                            loadComments(1);
                        } else {
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'error');
                            }
                        }
                    } catch (error) {
                        console.error('Error submitting comment:', error);
                        if (typeof addNotification === 'function') {
                            addNotification('Une erreur est survenue lors de l\\'envoi du commentaire', 'error');
                        }
                    }
                }

                submitCommentBtn.addEventListener('click', submitComment);
                commentTextarea.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        submitComment();
                    }
                });

                prevCommentsBtn.addEventListener('click', () => {
                    if (currentPage > 1) {
                        loadComments(currentPage - 1);
                    }
                });

                nextCommentsBtn.addEventListener('click', () => {
                    if (currentPage < data.totalPages) {
                        loadComments(currentPage + 1);
                    }
                });
            ";
        }
        // line 1089
        yield "
            loadComments(); // Always load comments
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
        return array (  1377 => 1089,  1318 => 1033,  1276 => 993,  1274 => 992,  1233 => 954,  1037 => 762,  1030 => 761,  1013 => 747,  1008 => 744,  1000 => 738,  995 => 736,  989 => 732,  987 => 731,  974 => 720,  972 => 719,  962 => 711,  956 => 707,  952 => 705,  945 => 703,  941 => 701,  939 => 700,  936 => 699,  932 => 697,  930 => 696,  924 => 693,  920 => 692,  916 => 691,  912 => 689,  901 => 687,  897 => 686,  893 => 685,  889 => 684,  881 => 681,  877 => 679,  868 => 673,  864 => 672,  860 => 671,  853 => 670,  851 => 669,  847 => 668,  837 => 666,  833 => 665,  830 => 664,  828 => 663,  822 => 659,  815 => 655,  810 => 652,  808 => 651,  802 => 647,  796 => 645,  794 => 644,  785 => 637,  781 => 635,  775 => 633,  760 => 627,  755 => 626,  753 => 625,  748 => 622,  744 => 620,  738 => 618,  736 => 617,  727 => 611,  719 => 606,  713 => 602,  700 => 593,  698 => 592,  692 => 589,  681 => 581,  671 => 574,  666 => 571,  660 => 569,  652 => 567,  650 => 566,  641 => 560,  635 => 556,  628 => 555,  74 => 6,  67 => 5,  54 => 3,  43 => 1,);
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

        /* Commentaires Section */
        .comments-section {
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 2rem;
            margin-top: 2rem;
        }

        .comments-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .comments-header h2 {
            margin: 0;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .comments-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .comment-card {
            background-color: white;
            border-radius: 8px;
            padding: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .comment-author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .comment-body {
            flex-grow: 1;
        }

        .comment-author {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .comment-text {
            color: var(--onyx);
        }

        .comment-date {
            color: var(--real-grey);
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        .comment-form {
            margin-top: 1rem;
            display: flex;
            gap: 1rem;
        }

        .comment-form textarea {
            flex-grow: 1;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            resize: vertical;
            min-height: 100px;
        }

        .comment-form button {
            align-self: flex-start;
            padding: 0.8rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comments-pagination {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
            gap: 1rem;
        }

        .star-rating {
            display: flex;
            gap: 0.25rem;
            margin-top: 0.5rem;
        }

        .star {
            color: #000;
        }

        .star.filled {
            color: var(--primary-color);
        }
        .rating-input {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .rating-input label {
            font-weight: bold;
            color: var(--onyx);
        }

        .rating-input .star-rating {
            display: flex;
            gap: 0.25rem;
        }

        .rating-input .rating-star {
            font-size: 1.5rem;
            color: #000;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .rating-input .rating-star.selected {
            color: var(--primary-color);
        }
        .comment-form {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .rating-input {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .rating-input label {
            font-weight: bold;
            color: var(--onyx);
        }

        .rating-input .star-rating {
            display: flex;
            gap: 0.25rem;
        }

        .rating-input .rating-star {
            font-size: 1.5rem;
            color: #000;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .rating-input .rating-star.selected {
            color: var(--primary-color);
        }

        .comment-form textarea {
            flex-grow: 1;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            resize: vertical;
            min-height: 100px;
        }

        .comment-form button {
            align-self: flex-start;
            padding: 0.8rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            display: none; /* Hidden by default */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
            
        </div>
    </section>
    
    {% if enterprise.enterprise_description_url %}
        <section class=\"enterprise-description\">
            <h2>À propos de l'entreprise</h2>
            <div class=\"description-content\">
                {{ enterprise.enterprise_description_url|nl2br }}
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

<section class=\"comments-section\">
    <div class=\"comments-header\">
        <h2>Commentaires</h2>
    </div>

    {% if request.hasPermission('perm_grade_company') %}
    <div class=\"comment-form\">
        <div class=\"rating-input\">
            <label>Note : </label>
            <div id=\"starRating\" class=\"star-rating\">
                <span class=\"rating-star\" data-value=\"1\">★</span>
                <span class=\"rating-star\" data-value=\"2\">★</span>
                <span class=\"rating-star\" data-value=\"3\">★</span>
                <span class=\"rating-star\" data-value=\"4\">★</span>
                <span class=\"rating-star\" data-value=\"5\">★</span>
            </div>
        </div>
        {% if usercomment is defined and usercomment is not empty %}
            <textarea
            id=\"commentTextarea\"
            placeholder=\"Partagez votre expérience avec cette entreprise...\"
            maxlength=\"500\"
            >{{ usercomment }}</textarea>
        {% else %}
            <textarea
            id=\"commentTextarea\"
            placeholder=\"Partagez votre expérience avec cette entreprise...\"
            maxlength=\"500\"
            ></textarea>
        {% endif %}
        <button id=\"submitCommentBtn\">Publier</button>
    </div>
    {% endif %}

    <div id=\"commentsList\" class=\"comments-list\">
        <!-- Commentaires seront chargés dynamiquement -->
    </div>

    <div id=\"commentsPagination\" class=\"comments-pagination\">
        <button id=\"prevCommentsBtn\" class=\"pagination-button\" disabled>Précédent</button>
        <span id=\"commentPageInfo\"></span>
        <button id=\"nextCommentsBtn\" class=\"pagination-button\" disabled>Suivant</button>
    </div>
</section>

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
                        const response = await fetch(`/API/wishlist/toggle/\${offerId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            button.classList.toggle('active', data.wishlisted);
                            button.setAttribute('aria-label', data.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist');
                            button.setAttribute('title', data.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist');

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

                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'success');
                            }
                        } else {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }

                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'error');
                            }
                        }
                    } catch (error) {
                        console.error('Error toggling wishlist:', error);

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
                    ratingStars.forEach(star => star.classList.remove('selected'));
                    ratingValueInput.value = '0';
                    submitRatingBtn.disabled = true;
                });
            }

            if (evaluationModal) {
                evaluationModal.addEventListener('click', (e) => {
                    if (e.target === evaluationModal) {
                        evaluationModal.style.display = 'none';
                        ratingStars.forEach(star => star.classList.remove('selected'));
                        ratingValueInput.value = '0';
                        submitRatingBtn.disabled = true;
                    }
                });
            }

            if (starRating) {
                ratingStars.forEach(star => {
                    star.addEventListener('mouseover', () => {
                        const value = parseInt(star.dataset.value);
                        ratingStars.forEach(s => {
                            const starValue = parseInt(s.dataset.value);
                            s.style.color = starValue <= value ? 'var(--primary-color)' : 'var(--real-grey)';
                        });
                    });

                    star.addEventListener('mouseout', () => {
                        ratingStars.forEach(s => {
                            s.style.color = s.classList.contains('selected') ? 'var(--primary-color)' : 'var(--real-grey)';
                        });
                    });

                    star.addEventListener('click', () => {
                        const value = parseInt(star.dataset.value);
                        ratingStars.forEach(s => {
                            const starValue = parseInt(s.dataset.value);
                            s.classList.toggle('selected', starValue <= value);
                        });
                        ratingValueInput.value = value;
                        submitRatingBtn.disabled = false;
                    });
                });
            }

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
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'success');
                            }
                            evaluationModal.style.display = 'none';
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'error');
                            }
                        }
                    } catch (error) {
                        console.error('Error submitting rating:', error);
                        if (typeof addNotification === 'function') {
                            addNotification('Une erreur est survenue lors de l\\'évaluation de l\\'entreprise.', 'error');
                        }
                    }
                });
            }

            // Comments functionality
            const commentsList = document.getElementById('commentsList');
            const prevCommentsBtn = document.getElementById('prevCommentsBtn');
            const nextCommentsBtn = document.getElementById('nextCommentsBtn');
            const commentPageInfo = document.getElementById('commentPageInfo');
            const spinner = document.createElement('div');
            spinner.className = 'spinner';
            commentsList.appendChild(spinner);

            let currentPage = 1;
            const commentsPerPage = 5;

            async function loadComments(page = 1) {
                spinner.style.display = 'block'; // Show spinner
                try {
                    const enterpriseId = \"{{ enterprise.id_enterprise }}\";
                    const response = await fetch(`/API/entreprises/\${enterpriseId}/comments?page=\${page}&limit=\${commentsPerPage}`);
                    const data = await response.json();

                    if (data.success) {
                        commentsList.innerHTML = data.comments.map(comment => `
                            <div class=\"comment-card\">
                                <img
                                    src=\"\${comment.authorPhoto}\"
                                    alt=\"\${comment.author}\"
                                    class=\"comment-author-avatar\"
                                >
                                <div class=\"comment-body\">
                                    <div class=\"comment-author\">\${comment.author}</div>
                                    <div class=\"star-rating\">
                                        \${'★'.repeat(comment.grade).split('').map(() => `<span class=\"star filled\">★</span>`).join('')}
                                        \${'★'.repeat(5 - comment.grade).split('').map(() => `<span class=\"star\">★</span>`).join('')}
                                    </div>
                                    <div class=\"comment-text\">\${comment.text}</div>
                                </div>
                            </div>
                        `).join('');

                        commentsList.appendChild(spinner); // Re-add spinner to the DOM
                        currentPage = page;
                        commentPageInfo.textContent = `Page \${page} of \${data.totalPages}`;
                        prevCommentsBtn.disabled = page <= 1;
                        nextCommentsBtn.disabled = page >= data.totalPages;
                    } else {
                        console.error('Failed to load comments:', data.message);
                    }
                } catch (error) {
                    console.error('Error loading comments:', error);
                } finally {
                    spinner.style.display = 'none'; // Hide spinner
                }
            }

            {% if request.hasPermission('perm_grade_company') %}
                console.log('User has permission to evaluate and comment.');
                const submitCommentBtn = document.getElementById('submitCommentBtn');
                const commentTextarea = document.getElementById('commentTextarea');
                const ratingStarsComment = document.querySelectorAll('#starRating .rating-star');

                let selectedRating = 0;

                ratingStarsComment.forEach(star => {
                    star.addEventListener('click', () => {
                        const value = parseInt(star.dataset.value);
                        selectedRating = value;
                        ratingStarsComment.forEach(s => {
                            const starValue = parseInt(s.dataset.value);
                            s.classList.toggle('selected', starValue <= value);
                        });
                    });
                });

                async function submitComment() {
                    const commentText = commentTextarea.value.trim();

                    if (!commentText) {
                        if (typeof addNotification === 'function') {
                            addNotification('Le commentaire ne peut pas être vide', 'error');
                        } else {
                            alert('Le commentaire ne peut pas être vide');
                        }
                        return;
                    }

                    if (selectedRating === 0) {
                        if (typeof addNotification === 'function') {
                            addNotification('Veuillez sélectionner une note', 'error');
                        } else {
                            alert('Veuillez sélectionner une note');
                        }
                        return;
                    }

                    try {
                        const enterpriseId = \"{{ enterprise.id_enterprise }}\";
                        const response = await fetch('/API/entreprises/comments', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                enterpriseId: enterpriseId,
                                commentText: commentText,
                                rating: selectedRating
                            })
                        });

                        const data = await response.json();
                        if (data.success) {
                            commentTextarea.value = '';
                            selectedRating = 0;
                            ratingStarsComment.forEach(star => star.classList.remove('selected'));
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'success');
                            }
                            loadComments(1);
                        } else {
                            if (typeof addNotification === 'function') {
                                addNotification(data.message, 'error');
                            }
                        }
                    } catch (error) {
                        console.error('Error submitting comment:', error);
                        if (typeof addNotification === 'function') {
                            addNotification('Une erreur est survenue lors de l\\'envoi du commentaire', 'error');
                        }
                    }
                }

                submitCommentBtn.addEventListener('click', submitComment);
                commentTextarea.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        submitComment();
                    }
                });

                prevCommentsBtn.addEventListener('click', () => {
                    if (currentPage > 1) {
                        loadComments(currentPage - 1);
                    }
                });

                nextCommentsBtn.addEventListener('click', () => {
                    if (currentPage < data.totalPages) {
                        loadComments(currentPage + 1);
                    }
                });
            {% endif %}

            loadComments(); // Always load comments
        });

   </script>
{% endblock %}", "enterprises/show.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\enterprises\\show.html.twig");
    }
}
