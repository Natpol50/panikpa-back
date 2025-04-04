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

/* enterprises/edit.html.twig */
class __TwigTemplate_518f8b3c4306eb6c04d88b65f5f9da4a extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "enterprises/edit.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Modifier ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 2), "html", null, true);
        yield " - ";
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
    <span><a href=\"/entreprises\">Entreprises</a></span>
    <span><a href=\"/entreprises/";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "id_enterprise", [], "any", false, false, false, 7), "html", null, true);
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 7), "html", null, true);
        yield "</a></span>
    <span>Modification</span>
</nav>
";
        yield from [];
    }

    // line 11
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 12
        yield "<div class=\"container\">
    <div class=\"enterprise-edit-container\">
        <h1>Modifier l'entreprise : ";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 14), "html", null, true);
        yield "</h1>

        <form id=\"edit-enterprise-form\" action=\"/entreprises/edit\" method=\"POST\" class=\"enterprise-form\">
            <input type=\"hidden\" name=\"enterpriseId\" value=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "id_enterprise", [], "any", false, false, false, 17), "html", null, true);
        yield "\">
            
            <div class=\"form-row\">
                <div class=\"form-group\">
                    <label for=\"enterpriseName\">Nom de l'entreprise *</label>
                    <input 
                        type=\"text\" 
                        id=\"enterpriseName\" 
                        name=\"enterpriseName\" 
                        placeholder=\"Entrez le nom de l'entreprise\" 
                        value=\"";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_name", [], "any", false, false, false, 27), "html", null, true);
        yield "\" 
                        required 
                        maxlength=\"100\"
                    >
                    <small class=\"form-hint\">Requis, maximum 100 caractères</small>
                </div>
                
                <div class=\"form-group\">
                    <label for=\"enterprisePhone\">Téléphone *</label>
                    <input 
                        type=\"tel\" 
                        id=\"enterprisePhone\" 
                        name=\"enterprisePhone\" 
                        placeholder=\"Numéro de téléphone\" 
                        value=\"";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_phone", [], "any", false, false, false, 41), "html", null, true);
        yield "\" 
                        required 
                        pattern=\"[0-9]{10}\"
                    >
                    <small class=\"form-hint\">Requis, 10 chiffres</small>
                </div>
            </div>

            <div class=\"form-row\">
                <div class=\"form-group\">
                    <label for=\"enterpriseEmail\">Email *</label>
                    <input 
                        type=\"email\" 
                        id=\"enterpriseEmail\" 
                        name=\"enterpriseEmail\" 
                        placeholder=\"contact@entreprise.com\" 
                        value=\"";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_email", [], "any", false, false, false, 57), "html", null, true);
        yield "\" 
                        required
                    >
                    <small class=\"form-hint\">Requis, format email valide</small>
                </div>
                
                <div class=\"form-group\">
                    <label for=\"enterpriseSite\">Site web</label>
                    <input 
                        type=\"url\" 
                        id=\"enterpriseSite\" 
                        name=\"enterpriseSite\" 
                        placeholder=\"https://www.entreprise.com\" 
                        value=\"";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_site", [], "any", false, false, false, 70), "html", null, true);
        yield "\"
                    >
                    <small class=\"form-hint\">Optionnel, lien web complet</small>
                </div>
            </div>

            <div class=\"form-group\">
                <label for=\"enterpriseDescriptionUrl\">Description de l'entreprise</label>
                <textarea 
                    id=\"enterpriseDescriptionUrl\" 
                    name=\"enterpriseDescriptionUrl\" 
                    placeholder=\"Entrez une description de l'entreprise\" 
                    rows=\"5\"
                    style=\"resize: vertical;\"
                >";
        // line 84
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_description_url", [], "any", false, false, false, 84), "html", null, true);
        yield "</textarea>
                <small class=\"form-hint\">Optionnel, parlez-nous de l'histoire et des objectifs de l'entreprise</small>
            </div>

            <div class=\"form-group\">
                <label for=\"enterprisePhotoUrl\">URL de la photo/logo</label>
                <input 
                    type=\"url\" 
                    id=\"enterprisePhotoUrl\" 
                    name=\"enterprisePhotoUrl\" 
                    placeholder=\"https://www.entreprise.com/logo.png\" 
                    value=\"";
        // line 95
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "enterprise_photo_url", [], "any", false, false, false, 95), "html", null, true);
        yield "\"
                >
                <small class=\"form-hint\">Optionnel, lien direct vers une image</small>
            </div>

            <div class=\"form-actions\">
                <button type=\"submit\" class=\"btn-primary\">Enregistrer les modifications</button>
                <a href=\"/entreprises/";
        // line 102
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "id_enterprise", [], "any", false, false, false, 102), "html", null, true);
        yield "\" class=\"btn-secondary\">Annuler</a>
            </div>
        </form>

        ";
        // line 106
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_admin"], "method", false, false, false, 106) || CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_modify_comp_info"], "method", false, false, false, 106))) {
            // line 107
            yield "        <div class=\"danger-zone\">
            <h3>Zone de danger</h3>
            <div class=\"danger-content\">
                <p>La suppression de cette entreprise est irréversible et supprimera toutes les offres et interactions associées.</p>
                <button id=\"delete-enterprise-btn\" class=\"btn-danger\" data-enterprise-id=\"";
            // line 111
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["enterprise"] ?? null), "id_enterprise", [], "any", false, false, false, 111), "html", null, true);
            yield "\">
                    Supprimer l'entreprise
                </button>
            </div>
        </div>
        ";
        }
        // line 117
        yield "    </div>
</div>
";
        yield from [];
    }

    // line 121
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 122
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        .enterprise-edit-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: var(--background-nav);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
        }

        .enterprise-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-weight: bold;
            color: var(--onyx);
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            background-color: white;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--focus-shadow);
        }

        .form-hint {
            font-size: 0.8rem;
            color: var(--real-grey);
            margin-top: 0.25rem;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .btn-primary,
        .btn-secondary {
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            transition: filter 0.3s ease;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            filter: brightness(0.9);
        }

        .btn-secondary {
            background-color: var(--tag-background);
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn-secondary:hover {
            background-color: var(--tag-background-secondary);
        }

        .danger-zone {
            margin-top: 2rem;
            background-color: rgba(220, 53, 69, 0.05);
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .danger-zone h3 {
            color: var(--tertiary-color);
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .danger-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .danger-content p {
            color: var(--real-grey);
            margin: 0;
            flex: 1;
        }

        .btn-danger {
            background-color: var(--tertiary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: filter 0.3s ease;
            font-size: 1rem;
        }

        .btn-danger:hover {
            filter: brightness(0.9);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .danger-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .btn-danger {
                width: 100%;
            }
        }
    </style>
";
        yield from [];
    }

    // line 282
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 283
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteEnterpriseBtn = document.getElementById('delete-enterprise-btn');
            
            if (deleteEnterpriseBtn) {
                deleteEnterpriseBtn.addEventListener('click', async () => {
                    const enterpriseId = deleteEnterpriseBtn.getAttribute('data-enterprise-id');
                    
                    // Confirm deletion
                    const confirmDelete = confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ? Cette action est irréversible.');
                    
                    if (confirmDelete) {
                        try {
                            const response = await fetch(`/api/delete-enterprise?id=\${enterpriseId}`, {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });
                            
                            const data = await response.json();
                            
                            if (data.success) {
                                if (typeof addNotification === 'function') {
                                    addNotification(data.message, 'success');
                                }
                                
                                // Redirect to enterprises list
                                setTimeout(() => {
                                    window.location.href = '/entreprises';
                                }, 1500);
                            } else {
                                // Show error notification
                                if (typeof addNotification === 'function') {
                                    addNotification(data.message, 'error');
                                }
                            }
                        } catch (error) {
                            console.error('Error deleting enterprise:', error);
                            
                            // Show error notification
                            if (typeof addNotification === 'function') {
                                addNotification('Une erreur est survenue lors de la suppression de l\\'entreprise.', 'error');
                            }
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
        return "enterprises/edit.html.twig";
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
        return array (  425 => 283,  418 => 282,  253 => 122,  246 => 121,  239 => 117,  230 => 111,  224 => 107,  222 => 106,  215 => 102,  205 => 95,  191 => 84,  174 => 70,  158 => 57,  139 => 41,  122 => 27,  109 => 17,  103 => 14,  99 => 12,  92 => 11,  81 => 7,  76 => 4,  69 => 3,  55 => 2,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Modifier {{ enterprise.enterprise_name }} - {{ parent() }}{% endblock %}
{% block breadcrumb %}
<nav class=\"breadcrumb\">
    <span><a href=\"/\">Accueil</a></span>
    <span><a href=\"/entreprises\">Entreprises</a></span>
    <span><a href=\"/entreprises/{{ enterprise.id_enterprise }}\">{{ enterprise.enterprise_name }}</a></span>
    <span>Modification</span>
</nav>
{% endblock %}
{% block content %}
<div class=\"container\">
    <div class=\"enterprise-edit-container\">
        <h1>Modifier l'entreprise : {{ enterprise.enterprise_name }}</h1>

        <form id=\"edit-enterprise-form\" action=\"/entreprises/edit\" method=\"POST\" class=\"enterprise-form\">
            <input type=\"hidden\" name=\"enterpriseId\" value=\"{{ enterprise.id_enterprise }}\">
            
            <div class=\"form-row\">
                <div class=\"form-group\">
                    <label for=\"enterpriseName\">Nom de l'entreprise *</label>
                    <input 
                        type=\"text\" 
                        id=\"enterpriseName\" 
                        name=\"enterpriseName\" 
                        placeholder=\"Entrez le nom de l'entreprise\" 
                        value=\"{{ enterprise.enterprise_name }}\" 
                        required 
                        maxlength=\"100\"
                    >
                    <small class=\"form-hint\">Requis, maximum 100 caractères</small>
                </div>
                
                <div class=\"form-group\">
                    <label for=\"enterprisePhone\">Téléphone *</label>
                    <input 
                        type=\"tel\" 
                        id=\"enterprisePhone\" 
                        name=\"enterprisePhone\" 
                        placeholder=\"Numéro de téléphone\" 
                        value=\"{{ enterprise.enterprise_phone }}\" 
                        required 
                        pattern=\"[0-9]{10}\"
                    >
                    <small class=\"form-hint\">Requis, 10 chiffres</small>
                </div>
            </div>

            <div class=\"form-row\">
                <div class=\"form-group\">
                    <label for=\"enterpriseEmail\">Email *</label>
                    <input 
                        type=\"email\" 
                        id=\"enterpriseEmail\" 
                        name=\"enterpriseEmail\" 
                        placeholder=\"contact@entreprise.com\" 
                        value=\"{{ enterprise.enterprise_email }}\" 
                        required
                    >
                    <small class=\"form-hint\">Requis, format email valide</small>
                </div>
                
                <div class=\"form-group\">
                    <label for=\"enterpriseSite\">Site web</label>
                    <input 
                        type=\"url\" 
                        id=\"enterpriseSite\" 
                        name=\"enterpriseSite\" 
                        placeholder=\"https://www.entreprise.com\" 
                        value=\"{{ enterprise.enterprise_site }}\"
                    >
                    <small class=\"form-hint\">Optionnel, lien web complet</small>
                </div>
            </div>

            <div class=\"form-group\">
                <label for=\"enterpriseDescriptionUrl\">Description de l'entreprise</label>
                <textarea 
                    id=\"enterpriseDescriptionUrl\" 
                    name=\"enterpriseDescriptionUrl\" 
                    placeholder=\"Entrez une description de l'entreprise\" 
                    rows=\"5\"
                    style=\"resize: vertical;\"
                >{{ enterprise.enterprise_description_url }}</textarea>
                <small class=\"form-hint\">Optionnel, parlez-nous de l'histoire et des objectifs de l'entreprise</small>
            </div>

            <div class=\"form-group\">
                <label for=\"enterprisePhotoUrl\">URL de la photo/logo</label>
                <input 
                    type=\"url\" 
                    id=\"enterprisePhotoUrl\" 
                    name=\"enterprisePhotoUrl\" 
                    placeholder=\"https://www.entreprise.com/logo.png\" 
                    value=\"{{ enterprise.enterprise_photo_url }}\"
                >
                <small class=\"form-hint\">Optionnel, lien direct vers une image</small>
            </div>

            <div class=\"form-actions\">
                <button type=\"submit\" class=\"btn-primary\">Enregistrer les modifications</button>
                <a href=\"/entreprises/{{ enterprise.id_enterprise }}\" class=\"btn-secondary\">Annuler</a>
            </div>
        </form>

        {% if request.hasPermission('perm_admin') or request.hasPermission('perm_modify_comp_info') %}
        <div class=\"danger-zone\">
            <h3>Zone de danger</h3>
            <div class=\"danger-content\">
                <p>La suppression de cette entreprise est irréversible et supprimera toutes les offres et interactions associées.</p>
                <button id=\"delete-enterprise-btn\" class=\"btn-danger\" data-enterprise-id=\"{{ enterprise.id_enterprise }}\">
                    Supprimer l'entreprise
                </button>
            </div>
        </div>
        {% endif %}
    </div>
</div>
{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .enterprise-edit-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: var(--background-nav);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
        }

        .enterprise-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-weight: bold;
            color: var(--onyx);
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            background-color: white;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--focus-shadow);
        }

        .form-hint {
            font-size: 0.8rem;
            color: var(--real-grey);
            margin-top: 0.25rem;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .btn-primary,
        .btn-secondary {
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            transition: filter 0.3s ease;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            filter: brightness(0.9);
        }

        .btn-secondary {
            background-color: var(--tag-background);
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn-secondary:hover {
            background-color: var(--tag-background-secondary);
        }

        .danger-zone {
            margin-top: 2rem;
            background-color: rgba(220, 53, 69, 0.05);
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .danger-zone h3 {
            color: var(--tertiary-color);
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .danger-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .danger-content p {
            color: var(--real-grey);
            margin: 0;
            flex: 1;
        }

        .btn-danger {
            background-color: var(--tertiary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: filter 0.3s ease;
            font-size: 1rem;
        }

        .btn-danger:hover {
            filter: brightness(0.9);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .danger-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .btn-danger {
                width: 100%;
            }
        }
    </style>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteEnterpriseBtn = document.getElementById('delete-enterprise-btn');
            
            if (deleteEnterpriseBtn) {
                deleteEnterpriseBtn.addEventListener('click', async () => {
                    const enterpriseId = deleteEnterpriseBtn.getAttribute('data-enterprise-id');
                    
                    // Confirm deletion
                    const confirmDelete = confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ? Cette action est irréversible.');
                    
                    if (confirmDelete) {
                        try {
                            const response = await fetch(`/api/delete-enterprise?id=\${enterpriseId}`, {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });
                            
                            const data = await response.json();
                            
                            if (data.success) {
                                if (typeof addNotification === 'function') {
                                    addNotification(data.message, 'success');
                                }
                                
                                // Redirect to enterprises list
                                setTimeout(() => {
                                    window.location.href = '/entreprises';
                                }, 1500);
                            } else {
                                // Show error notification
                                if (typeof addNotification === 'function') {
                                    addNotification(data.message, 'error');
                                }
                            }
                        } catch (error) {
                            console.error('Error deleting enterprise:', error);
                            
                            // Show error notification
                            if (typeof addNotification === 'function') {
                                addNotification('Une erreur est survenue lors de la suppression de l\\'entreprise.', 'error');
                            }
                        }
                    }
                });
            }
        });
    </script>
{% endblock %}", "enterprises/edit.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\enterprises\\edit.html.twig");
    }
}
