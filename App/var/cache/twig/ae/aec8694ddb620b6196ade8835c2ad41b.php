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

/* application/form.html.twig */
class __TwigTemplate_7bf61724ce000093274fce5989259c20 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "application/form.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Postuler - ";
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
        <span>Postuler</span>
    </nav>

    <div class=\"application-container\">
        <h1>Postuler à une offre</h1>

        ";
        // line 16
        if ((array_key_exists("error", $context) && ($context["error"] ?? null))) {
            // line 17
            yield "            <div class=\"error-message\">
                <p>";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "</p>
            </div>
        ";
        }
        // line 21
        yield "
        <!-- Display Offer Information -->
        <div class=\"offer-details\">
            <h2>Détails de l'offre</h2>
            <p><strong>Nom de l'offre:</strong> ";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["offerName"] ?? null), "html", null, true);
        yield "</p>
            <p><strong>Entreprise:</strong> ";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["enterpriseId"] ?? null), "html", null, true);
        yield "</p>
            <p><strong>Durée:</strong> ";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["offerDuration"] ?? null), "html", null, true);
        yield "</p>
            <div class=\"offer-tags\">
                <span class=\"tag\">";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["offerDuration"] ?? null), "html", null, true);
        yield "</span>
                ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["offerTags"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 31
            yield "                    <span class=\"";
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "optional", [], "any", false, false, false, 31)) ? ("tag_optional") : ("tag"));
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "tag_name", [], "any", false, false, false, 31), "html", null, true);
            yield "</span>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['tag'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        yield "            </div>
        </div>

        <form id=\"application-form\" method=\"POST\" action=\"/submit_application\" enctype=\"multipart/form-data\">
            <input type=\"hidden\" name=\"offerId\" value=\"";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("offerId", $context)) ? (Twig\Extension\CoreExtension::default(($context["offerId"] ?? null), "")) : ("")), "html", null, true);
        yield "\">

            <div class=\"form-group\">
                <label for=\"motivation\">Lettre de motivation</label>
                <textarea id=\"motivation\" name=\"motivation\" rows=\"10\" required>";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "motivation", [], "any", true, true, false, 41)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "motivation", [], "any", false, false, false, 41), "")) : ("")), "html", null, true);
        yield "</textarea>
                <div class=\"form-hint\">Expliquez pourquoi vous êtes intéressé par cette offre et ce que vous pouvez apporter.</div>
            </div>

            <div class=\"form-group\">
                <label for=\"cv\">CV (PDF, max 2MB)</label>
                <div class=\"file-upload\">
                    <input type=\"file\" id=\"cv\" name=\"cv\" accept=\".pdf\" required>
                    <label for=\"cv\" class=\"file-label\">Choisir un fichier</label>
                    <span class=\"file-name\">Aucun fichier choisi</span>
                </div>
                <div class=\"form-hint\">Seuls les fichiers PDF de moins de 2Mo sont acceptés.</div>
            </div>

            <div class=\"form-actions\">
                <button type=\"submit\" class=\"btn-primary\">Envoyer ma candidature</button>
            </div>
        </form>
    </div>
</div>
";
        yield from [];
    }

    // line 63
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 64
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        .application-container {
            background-color: var(--background-nav);
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px var(--shadow-color);
            max-width: 800px;
            margin: 0 auto;
        }

        .application-container h1 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .error-message {
            background-color: #ffebee;
            border-left: 4px solid var(--tertiary-color);
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: var(--tertiary-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            resize: vertical;
        }

        .form-hint {
            font-size: 0.8rem;
            color: var(--real-grey);
            margin-top: 0.5rem;
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
            max-width: 200px;
        }

        .file-name {
            font-size: 0.9rem;
            color: var(--real-grey);
        }

        .form-actions {
            margin-top: 2rem;
            display: flex;
            justify-content: flex-end;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .offer-details {
            margin-bottom: 2rem;
        }

        .offer-details h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .offer-details p {
            margin-bottom: 0.5rem;
        }

        .offer-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .offer-tags .tag {
            background-color: var(--tag-background);
            color: var(--tag-text);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .offer-tags .tag_optional {
            background-color: var(--tag-optional-background);
            color: var(--tag-optional-text);
        }
    </style>
";
        yield from [];
    }

    // line 189
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 190
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('cv');
            const fileName = document.querySelector('.file-name');
            const form = document.getElementById('application-form');

            // Update file name when file is selected
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    fileName.textContent = this.files[0].name;

                    // Validate file type and size
                    validateFile(this.files[0]);
                } else {
                    fileName.textContent = 'Aucun fichier choisi';
                }
            });

            // Validate file type and size
            function validateFile(file) {
                // Check file type
                if (file.type !== 'application/pdf') {
                    alert('Seuls les fichiers PDF sont acceptés.');
                    fileInput.value = '';
                    fileName.textContent = 'Aucun fichier choisi';
                    return false;
                }

                // Check file size (2MB max)
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                if (file.size > maxSize) {
                    alert('La taille du fichier dépasse la limite de 2Mo.');
                    fileInput.value = '';
                    fileName.textContent = 'Aucun fichier choisi';
                    return false;
                }

                return true;
            }

            // Form submit validation
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const motivation = document.getElementById('motivation').value.trim();

                if (!motivation) {
                    showNotification('Veuillez rédiger une lettre de motivation.', 'error');
                    return;
                }

                if (!fileInput.files.length) {
                    showNotification('Veuillez sélectionner un CV.', 'error');
                    return;
                }

                // Validate file again
                if (!validateFile(fileInput.files[0])) {
                    return;
                }

                // Create FormData for file upload
                const formData = new FormData(form);

                try {
                    // Send the application to the server
                    const response = await fetch('/submit_application', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Show success notification
                        showNotification('Votre candidature a été envoyée avec succès.', 'success');

                        // Redirect after 2 seconds
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 2000);
                    } else {
                        // Show error notification
                        showNotification('Une erreur est survenue lors de l\\'envoi de votre candidature.', 'error');
                    }
                } catch (error) {
                    console.error('Error submitting application:', error);
                    showNotification('Une erreur est survenue lors de l\\'envoi de votre candidature.', 'error');
                }
            });

            // Function to display notifications
            function showNotification(message, type = 'info') {
                const notificationContainer = document.createElement('div');
                notificationContainer.className = `notification \${type}`;
                notificationContainer.textContent = message;
                document.body.appendChild(notificationContainer);

                // Remove notification after 5 seconds
                setTimeout(() => {
                    notificationContainer.remove();
                }, 5000);
            }
        });
    </script>
    <style>
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 1rem;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 1200;
            max-width: 300px;
            color: white;
        }

        .notification.success {
            background-color: var(--primary-color);
        }

        .notification.error {
            background-color: var(--tertiary-color);
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
        return "application/form.html.twig";
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
        return array (  317 => 190,  310 => 189,  180 => 64,  173 => 63,  147 => 41,  140 => 37,  134 => 33,  123 => 31,  119 => 30,  115 => 29,  110 => 27,  106 => 26,  102 => 25,  96 => 21,  90 => 18,  87 => 17,  85 => 16,  73 => 6,  66 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Postuler - {{ parent() }}{% endblock %}

{% block content %}
<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span><a href=\"/offres\">Offres</a></span>
        <span>Postuler</span>
    </nav>

    <div class=\"application-container\">
        <h1>Postuler à une offre</h1>

        {% if error is defined and error %}
            <div class=\"error-message\">
                <p>{{ error }}</p>
            </div>
        {% endif %}

        <!-- Display Offer Information -->
        <div class=\"offer-details\">
            <h2>Détails de l'offre</h2>
            <p><strong>Nom de l'offre:</strong> {{ offerName }}</p>
            <p><strong>Entreprise:</strong> {{ enterpriseId }}</p>
            <p><strong>Durée:</strong> {{ offerDuration }}</p>
            <div class=\"offer-tags\">
                <span class=\"tag\">{{ offerDuration }}</span>
                {% for tag in offerTags %}
                    <span class=\"{{ tag.optional ? 'tag_optional' : 'tag' }}\">{{ tag.tag_name }}</span>
                {% endfor %}
            </div>
        </div>

        <form id=\"application-form\" method=\"POST\" action=\"/submit_application\" enctype=\"multipart/form-data\">
            <input type=\"hidden\" name=\"offerId\" value=\"{{ offerId|default('') }}\">

            <div class=\"form-group\">
                <label for=\"motivation\">Lettre de motivation</label>
                <textarea id=\"motivation\" name=\"motivation\" rows=\"10\" required>{{ formData.motivation|default('') }}</textarea>
                <div class=\"form-hint\">Expliquez pourquoi vous êtes intéressé par cette offre et ce que vous pouvez apporter.</div>
            </div>

            <div class=\"form-group\">
                <label for=\"cv\">CV (PDF, max 2MB)</label>
                <div class=\"file-upload\">
                    <input type=\"file\" id=\"cv\" name=\"cv\" accept=\".pdf\" required>
                    <label for=\"cv\" class=\"file-label\">Choisir un fichier</label>
                    <span class=\"file-name\">Aucun fichier choisi</span>
                </div>
                <div class=\"form-hint\">Seuls les fichiers PDF de moins de 2Mo sont acceptés.</div>
            </div>

            <div class=\"form-actions\">
                <button type=\"submit\" class=\"btn-primary\">Envoyer ma candidature</button>
            </div>
        </form>
    </div>
</div>
{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .application-container {
            background-color: var(--background-nav);
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px var(--shadow-color);
            max-width: 800px;
            margin: 0 auto;
        }

        .application-container h1 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .error-message {
            background-color: #ffebee;
            border-left: 4px solid var(--tertiary-color);
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: var(--tertiary-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            resize: vertical;
        }

        .form-hint {
            font-size: 0.8rem;
            color: var(--real-grey);
            margin-top: 0.5rem;
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
            max-width: 200px;
        }

        .file-name {
            font-size: 0.9rem;
            color: var(--real-grey);
        }

        .form-actions {
            margin-top: 2rem;
            display: flex;
            justify-content: flex-end;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .offer-details {
            margin-bottom: 2rem;
        }

        .offer-details h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .offer-details p {
            margin-bottom: 0.5rem;
        }

        .offer-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .offer-tags .tag {
            background-color: var(--tag-background);
            color: var(--tag-text);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .offer-tags .tag_optional {
            background-color: var(--tag-optional-background);
            color: var(--tag-optional-text);
        }
    </style>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('cv');
            const fileName = document.querySelector('.file-name');
            const form = document.getElementById('application-form');

            // Update file name when file is selected
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    fileName.textContent = this.files[0].name;

                    // Validate file type and size
                    validateFile(this.files[0]);
                } else {
                    fileName.textContent = 'Aucun fichier choisi';
                }
            });

            // Validate file type and size
            function validateFile(file) {
                // Check file type
                if (file.type !== 'application/pdf') {
                    alert('Seuls les fichiers PDF sont acceptés.');
                    fileInput.value = '';
                    fileName.textContent = 'Aucun fichier choisi';
                    return false;
                }

                // Check file size (2MB max)
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                if (file.size > maxSize) {
                    alert('La taille du fichier dépasse la limite de 2Mo.');
                    fileInput.value = '';
                    fileName.textContent = 'Aucun fichier choisi';
                    return false;
                }

                return true;
            }

            // Form submit validation
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const motivation = document.getElementById('motivation').value.trim();

                if (!motivation) {
                    showNotification('Veuillez rédiger une lettre de motivation.', 'error');
                    return;
                }

                if (!fileInput.files.length) {
                    showNotification('Veuillez sélectionner un CV.', 'error');
                    return;
                }

                // Validate file again
                if (!validateFile(fileInput.files[0])) {
                    return;
                }

                // Create FormData for file upload
                const formData = new FormData(form);

                try {
                    // Send the application to the server
                    const response = await fetch('/submit_application', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Show success notification
                        showNotification('Votre candidature a été envoyée avec succès.', 'success');

                        // Redirect after 2 seconds
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 2000);
                    } else {
                        // Show error notification
                        showNotification('Une erreur est survenue lors de l\\'envoi de votre candidature.', 'error');
                    }
                } catch (error) {
                    console.error('Error submitting application:', error);
                    showNotification('Une erreur est survenue lors de l\\'envoi de votre candidature.', 'error');
                }
            });

            // Function to display notifications
            function showNotification(message, type = 'info') {
                const notificationContainer = document.createElement('div');
                notificationContainer.className = `notification \${type}`;
                notificationContainer.textContent = message;
                document.body.appendChild(notificationContainer);

                // Remove notification after 5 seconds
                setTimeout(() => {
                    notificationContainer.remove();
                }, 5000);
            }
        });
    </script>
    <style>
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 1rem;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 1200;
            max-width: 300px;
            color: white;
        }

        .notification.success {
            background-color: var(--primary-color);
        }

        .notification.error {
            background-color: var(--tertiary-color);
        }
    </style>
{% endblock %}

", "application/form.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\application\\form.html.twig");
    }
}
