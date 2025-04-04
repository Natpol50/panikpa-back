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

/* application/list.html.twig */
class __TwigTemplate_9bb39e26f21793f480a8a7f24280e711 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "application/list.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Mes candidatures - ";
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
        <span>Mes candidatures</span>
    </nav>

    <div class=\"applications-container\">
        <h1>Mes candidatures</h1>
        
        ";
        // line 15
        if ((array_key_exists("error", $context) && ($context["error"] ?? null))) {
            // line 16
            yield "            <div class=\"error-message\">
                <p>";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "</p>
            </div>
        ";
        }
        // line 20
        yield "        
        ";
        // line 21
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["applications"] ?? null)) > 0)) {
            // line 22
            yield "            <div class=\"applications-list\">
                ";
            // line 23
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["applications"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["application"]) {
                // line 24
                yield "                    <div class=\"application-card\">
                        <div class=\"application-header\">
                            <h2>";
                // line 26
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "offer", [], "any", false, false, false, 26), "offer_title", [], "any", false, false, false, 26), "html", null, true);
                yield "</h2>
                            <span class=\"application-date\">
                                Postulé le ";
                // line 28
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "interaction", [], "any", false, false, false, 28), "interaction_first_date", [], "any", false, false, false, 28), "d/m/Y"), "html", null, true);
                yield "
                            </span>
                        </div>
                        
                        <div class=\"application-details\">
                            <div class=\"application-company\">
                                <strong>Entreprise:</strong> ";
                // line 34
                yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "offer", [], "any", false, true, false, 34), "company_name", [], "any", true, true, false, 34) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "offer", [], "any", false, false, false, 34), "company_name", [], "any", false, false, false, 34)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "offer", [], "any", false, false, false, 34), "company_name", [], "any", false, false, false, 34), "html", null, true)) : ("Non spécifiée"));
                yield "
                            </div>
                            
                            <div class=\"application-status\">
                                <strong>Statut:</strong> 
                                ";
                // line 39
                if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "interaction", [], "any", false, false, false, 39), "interaction_followup_date", [], "any", false, false, false, 39)) {
                    // line 40
                    yield "                                    ";
                    if ( !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "interaction", [], "any", false, false, false, 40), "interaction_followup_reply_type", [], "any", false, false, false, 40))) {
                        // line 41
                        yield "                                        ";
                        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "interaction", [], "any", false, false, false, 41), "interaction_followup_reply_type", [], "any", false, false, false, 41) == 1)) {
                            // line 42
                            yield "                                            <span class=\"status-accepted\">Acceptée</span>
                                        ";
                        } else {
                            // line 44
                            yield "                                            <span class=\"status-rejected\">Refusée</span>
                                        ";
                        }
                        // line 46
                        yield "                                    ";
                    } elseif (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "interaction", [], "any", false, false, false, 46), "interaction_followup_interview_date", [], "any", false, false, false, 46)) {
                        // line 47
                        yield "                                        <span class=\"status-interview\">Entretien le ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "interaction", [], "any", false, false, false, 47), "interaction_followup_interview_date", [], "any", false, false, false, 47), "d/m/Y"), "html", null, true);
                        yield "</span>
                                    ";
                    } else {
                        // line 49
                        yield "                                        <span class=\"status-processing\">En traitement</span>
                                    ";
                    }
                    // line 51
                    yield "                                ";
                } else {
                    // line 52
                    yield "                                    <span class=\"status-pending\">En attente</span>
                                ";
                }
                // line 54
                yield "                            </div>
                        </div>
                        
                        <div class=\"application-content\">
                            <div class=\"application-section\">
                                <h3>Lettre de motivation</h3>
                                <div class=\"motivation-text\">
                                    ";
                // line 61
                yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "interaction", [], "any", false, false, false, 61), "interaction_cover_letter_url", [], "any", false, false, false, 61), "html", null, true));
                yield "
                                </div>
                            </div>
                            
                            <div class=\"application-section\">
                                <h3>CV</h3>
                                <a href=\"";
                // line 67
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "interaction", [], "any", false, false, false, 67), "interaction_cv_url", [], "any", false, false, false, 67), "html", null, true);
                yield "\" target=\"_blank\" class=\"cv-link\">
                                    <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                        <path d=\"M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z\" fill=\"currentColor\"/>
                                    </svg>
                                    Voir mon CV
                                </a>
                            </div>
                        </div>
                        
                        ";
                // line 76
                if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "interaction", [], "any", false, false, false, 76), "interaction_followup_reply", [], "any", false, false, false, 76)) {
                    // line 77
                    yield "                            <div class=\"application-section\">
                                <h3>Réponse de l'entreprise</h3>
                                <div class=\"reply-text\">
                                    ";
                    // line 80
                    yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "interaction", [], "any", false, false, false, 80), "interaction_followup_reply", [], "any", false, false, false, 80), "html", null, true));
                    yield "
                                </div>
                            </div>
                        ";
                }
                // line 84
                yield "                        
                        <div class=\"application-actions\">
                            <a href=\"/offres/";
                // line 86
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["application"], "offer", [], "any", false, false, false, 86), "id_offer", [], "any", false, false, false, 86), "html", null, true);
                yield "\" class=\"btn-view-offer\">
                                Voir l'offre
                            </a>
                        </div>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['application'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 92
            yield "            </div>
        ";
        } else {
            // line 94
            yield "            <div class=\"no-applications\">
                <svg viewBox=\"0 0 24 24\" width=\"48\" height=\"48\">
                    <path d=\"M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM10 4h4v2h-4V4zm10 15H4V8h16v11z\" fill=\"currentColor\"/>
                    <path d=\"M11 11h2v2h-2z\" fill=\"currentColor\"/>
                    <path d=\"M11 14h2v2h-2z\" fill=\"currentColor\"/>
                    <path d=\"M8 11h2v2H8z\" fill=\"currentColor\"/>
                    <path d=\"M8 14h2v2H8z\" fill=\"currentColor\"/>
                    <path d=\"M14 11h2v2h-2z\" fill=\"currentColor\"/>
                    <path d=\"M14 14h2v2h-2z\" fill=\"currentColor\"/>
                </svg>
                <h2>Aucune candidature</h2>
                <p>Vous n'avez pas encore postulé à des offres.</p>
                <a href=\"/offres/stages\" class=\"btn-primary\">Découvrir les offres</a>
            </div>
        ";
        }
        // line 109
        yield "    </div>
</div>
";
        yield from [];
    }

    // line 113
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 114
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        .applications-container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .applications-container h1 {
            margin-bottom: 2rem;
            color: var(--primary-color);
        }
        
        .error-message {
            background-color: #ffebee;
            border-left: 4px solid var(--tertiary-color);
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: var(--tertiary-color);
        }
        
        .applications-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .application-card {
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 1.5rem;
        }
        
        .application-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--tag-background);
        }
        
        .application-header h2 {
            margin: 0;
            font-size: 1.3rem;
            color: var(--primary-color);
        }
        
        .application-date {
            font-size: 0.9rem;
            color: var(--real-grey);
        }
        
        .application-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        
        .application-company, .application-status {
            font-size: 1rem;
        }
        
        .status-pending {
            color: var(--realsecondary-color);
        }
        
        .status-processing {
            color: var(--primary-color);
        }
        
        .status-interview {
            color: var(--primary-color);
            font-weight: bold;
        }
        
        .status-accepted {
            color: #4caf50;
            font-weight: bold;
        }
        
        .status-rejected {
            color: var(--tertiary-color);
        }
        
        .application-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .application-section h3 {
            font-size: 1.1rem;
            margin: 0 0 0.5rem 0;
            color: var(--onyx);
        }
        
        .motivation-text {
            background-color: #f9f9f9;
            padding: 1rem;
            border-radius: 4px;
            border-left: 3px solid var(--tag-background);
            font-style: italic;
            line-height: 1.6;
        }
        
        .cv-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
        }
        
        .reply-text {
            background-color: #f9f9f9;
            padding: 1rem;
            border-radius: 4px;
            border-left: 3px solid var(--tag-background);
            line-height: 1.6;
            margin-top: 0.5rem;
        }
        
        .application-actions {
            display: flex;
            justify-content: flex-end;
        }
        
        .btn-view-offer {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            background-color: var(--tag-background);
            color: var(--primary-color);
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        
        .no-applications {
            text-align: center;
            padding: 3rem;
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            color: var(--real-grey);
        }
        
        .no-applications svg {
            opacity: 0.5;
            margin-bottom: 1rem;
        }
        
        .no-applications h2 {
            color: var(--onyx);
            margin-bottom: 0.5rem;
        }
        
        .no-applications p {
            margin-bottom: 1.5rem;
        }
        
        .btn-primary {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
            .application-header {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .application-details {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .application-content {
                grid-template-columns: 1fr;
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
        return "application/list.html.twig";
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
        return array (  263 => 114,  256 => 113,  249 => 109,  232 => 94,  228 => 92,  216 => 86,  212 => 84,  205 => 80,  200 => 77,  198 => 76,  186 => 67,  177 => 61,  168 => 54,  164 => 52,  161 => 51,  157 => 49,  151 => 47,  148 => 46,  144 => 44,  140 => 42,  137 => 41,  134 => 40,  132 => 39,  124 => 34,  115 => 28,  110 => 26,  106 => 24,  102 => 23,  99 => 22,  97 => 21,  94 => 20,  88 => 17,  85 => 16,  83 => 15,  72 => 6,  65 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Mes candidatures - {{ parent() }}{% endblock %}

{% block content %}
<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span>Mes candidatures</span>
    </nav>

    <div class=\"applications-container\">
        <h1>Mes candidatures</h1>
        
        {% if error is defined and error %}
            <div class=\"error-message\">
                <p>{{ error }}</p>
            </div>
        {% endif %}
        
        {% if applications|length > 0 %}
            <div class=\"applications-list\">
                {% for application in applications %}
                    <div class=\"application-card\">
                        <div class=\"application-header\">
                            <h2>{{ application.offer.offer_title }}</h2>
                            <span class=\"application-date\">
                                Postulé le {{ application.interaction.interaction_first_date|date('d/m/Y') }}
                            </span>
                        </div>
                        
                        <div class=\"application-details\">
                            <div class=\"application-company\">
                                <strong>Entreprise:</strong> {{ application.offer.company_name ?? 'Non spécifiée' }}
                            </div>
                            
                            <div class=\"application-status\">
                                <strong>Statut:</strong> 
                                {% if application.interaction.interaction_followup_date %}
                                    {% if application.interaction.interaction_followup_reply_type is not null %}
                                        {% if application.interaction.interaction_followup_reply_type == 1 %}
                                            <span class=\"status-accepted\">Acceptée</span>
                                        {% else %}
                                            <span class=\"status-rejected\">Refusée</span>
                                        {% endif %}
                                    {% elseif application.interaction.interaction_followup_interview_date %}
                                        <span class=\"status-interview\">Entretien le {{ application.interaction.interaction_followup_interview_date|date('d/m/Y') }}</span>
                                    {% else %}
                                        <span class=\"status-processing\">En traitement</span>
                                    {% endif %}
                                {% else %}
                                    <span class=\"status-pending\">En attente</span>
                                {% endif %}
                            </div>
                        </div>
                        
                        <div class=\"application-content\">
                            <div class=\"application-section\">
                                <h3>Lettre de motivation</h3>
                                <div class=\"motivation-text\">
                                    {{ application.interaction.interaction_cover_letter_url|nl2br }}
                                </div>
                            </div>
                            
                            <div class=\"application-section\">
                                <h3>CV</h3>
                                <a href=\"{{ application.interaction.interaction_cv_url }}\" target=\"_blank\" class=\"cv-link\">
                                    <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                        <path d=\"M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z\" fill=\"currentColor\"/>
                                    </svg>
                                    Voir mon CV
                                </a>
                            </div>
                        </div>
                        
                        {% if application.interaction.interaction_followup_reply %}
                            <div class=\"application-section\">
                                <h3>Réponse de l'entreprise</h3>
                                <div class=\"reply-text\">
                                    {{ application.interaction.interaction_followup_reply|nl2br }}
                                </div>
                            </div>
                        {% endif %}
                        
                        <div class=\"application-actions\">
                            <a href=\"/offres/{{ application.offer.id_offer }}\" class=\"btn-view-offer\">
                                Voir l'offre
                            </a>
                        </div>
                    </div>
                {% endfor %}
            </div>
        {% else %}
            <div class=\"no-applications\">
                <svg viewBox=\"0 0 24 24\" width=\"48\" height=\"48\">
                    <path d=\"M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM10 4h4v2h-4V4zm10 15H4V8h16v11z\" fill=\"currentColor\"/>
                    <path d=\"M11 11h2v2h-2z\" fill=\"currentColor\"/>
                    <path d=\"M11 14h2v2h-2z\" fill=\"currentColor\"/>
                    <path d=\"M8 11h2v2H8z\" fill=\"currentColor\"/>
                    <path d=\"M8 14h2v2H8z\" fill=\"currentColor\"/>
                    <path d=\"M14 11h2v2h-2z\" fill=\"currentColor\"/>
                    <path d=\"M14 14h2v2h-2z\" fill=\"currentColor\"/>
                </svg>
                <h2>Aucune candidature</h2>
                <p>Vous n'avez pas encore postulé à des offres.</p>
                <a href=\"/offres/stages\" class=\"btn-primary\">Découvrir les offres</a>
            </div>
        {% endif %}
    </div>
</div>
{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .applications-container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .applications-container h1 {
            margin-bottom: 2rem;
            color: var(--primary-color);
        }
        
        .error-message {
            background-color: #ffebee;
            border-left: 4px solid var(--tertiary-color);
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: var(--tertiary-color);
        }
        
        .applications-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .application-card {
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 1.5rem;
        }
        
        .application-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--tag-background);
        }
        
        .application-header h2 {
            margin: 0;
            font-size: 1.3rem;
            color: var(--primary-color);
        }
        
        .application-date {
            font-size: 0.9rem;
            color: var(--real-grey);
        }
        
        .application-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        
        .application-company, .application-status {
            font-size: 1rem;
        }
        
        .status-pending {
            color: var(--realsecondary-color);
        }
        
        .status-processing {
            color: var(--primary-color);
        }
        
        .status-interview {
            color: var(--primary-color);
            font-weight: bold;
        }
        
        .status-accepted {
            color: #4caf50;
            font-weight: bold;
        }
        
        .status-rejected {
            color: var(--tertiary-color);
        }
        
        .application-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .application-section h3 {
            font-size: 1.1rem;
            margin: 0 0 0.5rem 0;
            color: var(--onyx);
        }
        
        .motivation-text {
            background-color: #f9f9f9;
            padding: 1rem;
            border-radius: 4px;
            border-left: 3px solid var(--tag-background);
            font-style: italic;
            line-height: 1.6;
        }
        
        .cv-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
        }
        
        .reply-text {
            background-color: #f9f9f9;
            padding: 1rem;
            border-radius: 4px;
            border-left: 3px solid var(--tag-background);
            line-height: 1.6;
            margin-top: 0.5rem;
        }
        
        .application-actions {
            display: flex;
            justify-content: flex-end;
        }
        
        .btn-view-offer {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            background-color: var(--tag-background);
            color: var(--primary-color);
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        
        .no-applications {
            text-align: center;
            padding: 3rem;
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            color: var(--real-grey);
        }
        
        .no-applications svg {
            opacity: 0.5;
            margin-bottom: 1rem;
        }
        
        .no-applications h2 {
            color: var(--onyx);
            margin-bottom: 0.5rem;
        }
        
        .no-applications p {
            margin-bottom: 1.5rem;
        }
        
        .btn-primary {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
            .application-header {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .application-details {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .application-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
{% endblock %}", "application/list.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\application\\list.html.twig");
    }
}
