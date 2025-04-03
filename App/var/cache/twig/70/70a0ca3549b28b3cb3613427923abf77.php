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

/* enterprises/create.html.twig */
class __TwigTemplate_64e9083c480c6f479b4c0984a7df5084 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "enterprises/create.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Créer une entreprise - ";
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
    <span>Créer une entreprise</span>
</nav>
";
        yield from [];
    }

    // line 10
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 11
        yield "<div class=\"container\">
    <div class=\"enterprise-create-container\">
        <h1>Ajouter une nouvelle entreprise</h1>

        <form id=\"create-enterprise-form\" action=\"/entreprises\" method=\"POST\" class=\"enterprise-form\">
            <div class=\"form-row\">
                <div class=\"form-group\">
                    <label for=\"enterpriseName\">Nom de l'entreprise *</label>
                    <input 
                        type=\"text\" 
                        id=\"enterpriseName\" 
                        name=\"enterpriseName\" 
                        placeholder=\"Entrez le nom de l'entreprise\" 
                        value=\"";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterpriseName", [], "any", true, true, false, 24)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterpriseName", [], "any", false, false, false, 24), "")) : ("")), "html", null, true);
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
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterprisePhone", [], "any", true, true, false, 38)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterprisePhone", [], "any", false, false, false, 38), "")) : ("")), "html", null, true);
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
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterpriseEmail", [], "any", true, true, false, 54)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterpriseEmail", [], "any", false, false, false, 54), "")) : ("")), "html", null, true);
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
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterpriseSite", [], "any", true, true, false, 67)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterpriseSite", [], "any", false, false, false, 67), "")) : ("")), "html", null, true);
        yield "\"
                    >
                    <small class=\"form-hint\">Optionnel, lien web complet</small>
                </div>
            </div>

            <div class=\"form-group\">
                <label for=\"enterpriseDescriptionUrl\">Lien vers description</label>
                <textarea 
                    id=\"enterpriseDescriptionUrl\" 
                    name=\"enterpriseDescriptionUrl\" 
                    placeholder=\"Entrez une description de l'entreprise\" 
                    rows=\"5\"
                    style=\"resize: vertical;\"
                >";
        // line 81
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterpriseDescriptionUrl", [], "any", true, true, false, 81)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterpriseDescriptionUrl", [], "any", false, false, false, 81), "")) : ("")), "html", null, true);
        yield "</textarea>
                <small class=\"form-hint\">Optionnel, Une histoire, un but ? n'hésitez pas, c'est ici</small>
            </div>

            <div class=\"form-group\">
                <label for=\"enterprisePhotoUrl\">URL de la photo</label>
                <input 
                    type=\"url\" 
                    id=\"enterprisePhotoUrl\" 
                    name=\"enterprisePhotoUrl\" 
                    placeholder=\"https://www.entreprise.com/logo.png\" 
                    value=\"";
        // line 92
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterprisePhotoUrl", [], "any", true, true, false, 92)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "enterprisePhotoUrl", [], "any", false, false, false, 92), "")) : ("")), "html", null, true);
        yield "\"
                >
                <small class=\"form-hint\">Optionnel, lien direct vers une image</small>
            </div>

            <div class=\"form-actions\">
                <button type=\"submit\" class=\"btn-primary\">Créer l'entreprise</button>
                <a href=\"/entreprises\" class=\"btn-secondary\">Annuler</a>
            </div>
        </form>
    </div>
</div>
";
        yield from [];
    }

    // line 105
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 106
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        .enterprise-create-container {
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
        }

        .form-group input {
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            background-color: white;
        }

        .form-group input:focus {
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

        .btn-primary, .btn-secondary {
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            transition: filter 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-secondary {
            background-color: var(--tag-background);
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
";
        yield from [];
    }

    // line 192
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 193
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('create-enterprise-form');
            const fields = form.querySelectorAll('input[required]');

            function validateField(field) {
                // Remove previous error
                const previousError = field.parentNode.querySelector('.field-error');
                if (previousError) previousError.remove();

                let errorMessage = '';

                if (field.validity.valueMissing) {
                    errorMessage = 'Ce champ est requis';
                } else if (field.validity.typeMismatch) {
                    if (field.type === 'email') errorMessage = 'Veuillez saisir une adresse email valide';
                    if (field.type === 'tel') errorMessage = 'Veuillez saisir un numéro de téléphone valide';
                } else if (field.validity.patternMismatch) {
                    if (field.id === 'enterprisePhone') errorMessage = 'Le numéro de téléphone doit comporter 10 chiffres';
                }

                if (errorMessage) {
                    const errorEl = document.createElement('div');
                    errorEl.className = 'field-error';
                    errorEl.style.color = 'var(--tertiary-color)';
                    errorEl.style.fontSize = '0.8rem';
                    errorEl.style.marginTop = '0.25rem';
                    errorEl.textContent = errorMessage;
                    field.parentNode.appendChild(errorEl);
                    return false;
                }

                return true;
            }

            // Validation on input and submit
            fields.forEach(field => {
                field.addEventListener('input', () => validateField(field));
                field.addEventListener('blur', () => validateField(field));
            });

            form.addEventListener('submit', (e) => {
                let isValid = true;

                fields.forEach(field => {
                    if (!validateField(field)) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });
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
        return "enterprises/create.html.twig";
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
        return array (  313 => 193,  306 => 192,  214 => 106,  207 => 105,  189 => 92,  175 => 81,  158 => 67,  142 => 54,  123 => 38,  106 => 24,  91 => 11,  84 => 10,  74 => 4,  67 => 3,  55 => 2,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Créer une entreprise - {{ parent() }}{% endblock %}
{% block breadcrumb %}
<nav class=\"breadcrumb\">
    <span><a href=\"/\">Accueil</a></span>
    <span><a href=\"/entreprises\">Entreprises</a></span>
    <span>Créer une entreprise</span>
</nav>
{% endblock %}
{% block content %}
<div class=\"container\">
    <div class=\"enterprise-create-container\">
        <h1>Ajouter une nouvelle entreprise</h1>

        <form id=\"create-enterprise-form\" action=\"/entreprises\" method=\"POST\" class=\"enterprise-form\">
            <div class=\"form-row\">
                <div class=\"form-group\">
                    <label for=\"enterpriseName\">Nom de l'entreprise *</label>
                    <input 
                        type=\"text\" 
                        id=\"enterpriseName\" 
                        name=\"enterpriseName\" 
                        placeholder=\"Entrez le nom de l'entreprise\" 
                        value=\"{{ formData.enterpriseName|default('') }}\" 
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
                        value=\"{{ formData.enterprisePhone|default('') }}\" 
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
                        value=\"{{ formData.enterpriseEmail|default('') }}\" 
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
                        value=\"{{ formData.enterpriseSite|default('') }}\"
                    >
                    <small class=\"form-hint\">Optionnel, lien web complet</small>
                </div>
            </div>

            <div class=\"form-group\">
                <label for=\"enterpriseDescriptionUrl\">Lien vers description</label>
                <textarea 
                    id=\"enterpriseDescriptionUrl\" 
                    name=\"enterpriseDescriptionUrl\" 
                    placeholder=\"Entrez une description de l'entreprise\" 
                    rows=\"5\"
                    style=\"resize: vertical;\"
                >{{ formData.enterpriseDescriptionUrl|default('') }}</textarea>
                <small class=\"form-hint\">Optionnel, Une histoire, un but ? n'hésitez pas, c'est ici</small>
            </div>

            <div class=\"form-group\">
                <label for=\"enterprisePhotoUrl\">URL de la photo</label>
                <input 
                    type=\"url\" 
                    id=\"enterprisePhotoUrl\" 
                    name=\"enterprisePhotoUrl\" 
                    placeholder=\"https://www.entreprise.com/logo.png\" 
                    value=\"{{ formData.enterprisePhotoUrl|default('') }}\"
                >
                <small class=\"form-hint\">Optionnel, lien direct vers une image</small>
            </div>

            <div class=\"form-actions\">
                <button type=\"submit\" class=\"btn-primary\">Créer l'entreprise</button>
                <a href=\"/entreprises\" class=\"btn-secondary\">Annuler</a>
            </div>
        </form>
    </div>
</div>
{% endblock %}
{% block stylesheets %}
    {{ parent() }}
    <style>
        .enterprise-create-container {
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
        }

        .form-group input {
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            background-color: white;
        }

        .form-group input:focus {
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

        .btn-primary, .btn-secondary {
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            transition: filter 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-secondary {
            background-color: var(--tag-background);
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
{% endblock %}
{% block javascripts %}
    {{ parent() }}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('create-enterprise-form');
            const fields = form.querySelectorAll('input[required]');

            function validateField(field) {
                // Remove previous error
                const previousError = field.parentNode.querySelector('.field-error');
                if (previousError) previousError.remove();

                let errorMessage = '';

                if (field.validity.valueMissing) {
                    errorMessage = 'Ce champ est requis';
                } else if (field.validity.typeMismatch) {
                    if (field.type === 'email') errorMessage = 'Veuillez saisir une adresse email valide';
                    if (field.type === 'tel') errorMessage = 'Veuillez saisir un numéro de téléphone valide';
                } else if (field.validity.patternMismatch) {
                    if (field.id === 'enterprisePhone') errorMessage = 'Le numéro de téléphone doit comporter 10 chiffres';
                }

                if (errorMessage) {
                    const errorEl = document.createElement('div');
                    errorEl.className = 'field-error';
                    errorEl.style.color = 'var(--tertiary-color)';
                    errorEl.style.fontSize = '0.8rem';
                    errorEl.style.marginTop = '0.25rem';
                    errorEl.textContent = errorMessage;
                    field.parentNode.appendChild(errorEl);
                    return false;
                }

                return true;
            }

            // Validation on input and submit
            fields.forEach(field => {
                field.addEventListener('input', () => validateField(field));
                field.addEventListener('blur', () => validateField(field));
            });

            form.addEventListener('submit', (e) => {
                let isValid = true;

                fields.forEach(field => {
                    if (!validateField(field)) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
{% endblock %}", "enterprises/create.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\enterprises\\create.html.twig");
    }
}
