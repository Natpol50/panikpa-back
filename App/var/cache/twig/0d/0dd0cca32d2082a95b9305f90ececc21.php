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

/* offers/create.html.twig */
class __TwigTemplate_312ad8a652d7e59b64af5cf5bfb356ff extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "offers/create.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Créer une offre - ";
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
        <span>Créer une offre</span>
    </nav>

    <div class=\"create-offer-container\">
        <header class=\"create-offer-header\">
            <h1>Créer une nouvelle offre</h1>
            <p>Remplissez le formulaire ci-dessous pour créer une nouvelle offre de stage ou d'alternance.</p>
        </header>

        <form class=\"create-offer-form\" method=\"POST\" action=\"/offres\">
            <div class=\"form-section\">
                <h2>Informations générales</h2>
                
                ";
        // line 23
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_admin"], "method", false, false, false, 23)) {
            // line 24
            yield "                <div class=\"form-group\">
                    <label for=\"enterprise\">[ADMIN] Sélectionnez une entreprise <span class=\"required\">*</span></label>
                    <select id=\"enterprise\" name=\"enterprise\" required>
                        <option value=\"\" disabled selected>Chargement des entreprises...</option>
                    </select>
                </div>
                ";
        }
        // line 31
        yield "                
                <div class=\"form-group\">
                    <label for=\"title\">Titre de l'offre <span class=\"required\">*</span></label>
                    <input type=\"text\" id=\"title\" name=\"title\" value=\"";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "title", [], "any", true, true, false, 34)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "title", [], "any", false, false, false, 34), "")) : ("")), "html", null, true);
        yield "\" required>
                </div>
                
                <div class=\"form-group\">
                    <label for=\"type\">Type d'offre <span class=\"required\">*</span></label>
                    <select id=\"type\" name=\"type\" required>
                        <option value=\"\" disabled ";
        // line 40
        if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "type", [], "any", true, true, false, 40)) {
            yield "selected";
        }
        yield ">Sélectionnez un type d'offre</option>
                        <option value=\"0\" ";
        // line 41
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "type", [], "any", true, true, false, 41) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "type", [], "any", false, false, false, 41) == "0"))) {
            yield "selected";
        }
        yield ">Stage</option>
                        <option value=\"1\" ";
        // line 42
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "type", [], "any", true, true, false, 42) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "type", [], "any", false, false, false, 42) == "1"))) {
            yield "selected";
        }
        yield ">Alternance</option>
                    </select>
                </div>
                
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"level\">Niveau d'études requis <span class=\"required\">*</span></label>
                        <select id=\"level\" name=\"level\" required>
                            <option value=\"\" disabled ";
        // line 50
        if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 50)) {
            yield "selected";
        }
        yield ">Sélectionnez un niveau</option>
                            <option value=\"Bac\" ";
        // line 51
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 51) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 51) == "Bac"))) {
            yield "selected";
        }
        yield ">Bac</option>
                            <option value=\"Bac +2\" ";
        // line 52
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 52) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 52) == "Bac +2"))) {
            yield "selected";
        }
        yield ">Bac +2</option>
                            <option value=\"Bac +3\" ";
        // line 53
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 53) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 53) == "Bac +3"))) {
            yield "selected";
        }
        yield ">Bac +3</option>
                            <option value=\"Bac +4\" ";
        // line 54
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 54) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 54) == "Bac +4"))) {
            yield "selected";
        }
        yield ">Bac +4</option>
                            <option value=\"Bac +5\" ";
        // line 55
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 55) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 55) == "Bac +5"))) {
            yield "selected";
        }
        yield ">Bac +5</option>
                            <option value=\"Bac +3, Bac +5\" ";
        // line 56
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 56) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 56) == "Bac +3, Bac +5"))) {
            yield "selected";
        }
        yield ">Bac +3, Bac +5</option>
                        </select>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"duration\">Durée <span class=\"required\">*</span></label>
                        <input type=\"text\" id=\"duration\" name=\"duration\" value=\"";
        // line 62
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", true, true, false, 62)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", false, false, false, 62), "")) : ("")), "html", null, true);
        yield "\" required placeholder=\"Ex: 3 mois, 6 mois, 1 an\">
                    </div>
                </div>
                
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"startDate\">Date de début <span class=\"required\">*</span></label>
                        <input type=\"date\" id=\"startDate\" name=\"startDate\" value=\"";
        // line 69
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "startDate", [], "any", true, true, false, 69)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "startDate", [], "any", false, false, false, 69), "")) : ("")), "html", null, true);
        yield "\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"remuneration\">Rémunération</label>
                        <select id=\"remuneration\" name=\"remuneration\">
                            <option value=\"\" disabled ";
        // line 75
        if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "Remuneration", [], "any", true, true, false, 75)) {
            yield "selected";
        }
        yield ">L'offre est-elle rémunérée ?</option>
                            <option value=\"0\" ";
        // line 76
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remuneration", [], "any", true, true, false, 76) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remuneration", [], "any", false, false, false, 76) == "0"))) {
            yield "selected";
        }
        yield ">Non rémunéré</option>
                            <option value=\"1\" ";
        // line 77
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remuneration", [], "any", true, true, false, 77) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remuneration", [], "any", false, false, false, 77) == "1"))) {
            yield "selected";
        }
        yield ">Rémunéré</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class=\"form-section\">
                <h2>Localisation</h2>
                
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"city\">Ville <span class=\"required\">*</span></label>
                        <input type=\"text\" id=\"city\" name=\"city\" value=\"";
        // line 89
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "city", [], "any", true, true, false, 89)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "city", [], "any", false, false, false, 89), "")) : ("")), "html", null, true);
        yield "\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"postalCode\">Code postal <span class=\"required\">*</span></label>
                        <input type=\"number\" id=\"postalCode\" name=\"postalCode\" value=\"";
        // line 94
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "postalCode", [], "any", true, true, false, 94)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "postalCode", [], "any", false, false, false, 94), "")) : ("")), "html", null, true);
        yield "\" required>
                    </div>
                </div>
            </div>
            
            <div class=\"form-section\">
                <h2>Compétences</h2>
                
                <div id=\"tags-container\">
                    <div class=\"tag-input-group\">
                        <div class=\"form-row\">
                            <div class=\"form-group tag-input\">
                                <label for=\"tags[0]\">Compétence</label>
                                <input type=\"text\" id=\"tags[0]\" name=\"tags[]\" value=\"";
        // line 107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "tags", [], "any", false, true, false, 107), 0, [], "array", true, true, false, 107)) ? (Twig\Extension\CoreExtension::default((($_v0 = CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "tags", [], "any", false, false, false, 107)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[0] ?? null) : null), "")) : ("")), "html", null, true);
        yield "\" placeholder=\"Ex: PHP, JavaScript, Réseau...\">
                            </div>
                            
                            <div class=\"form-group optional-checkbox\">
                                <label class=\"checkbox-container\">
                                    <input type=\"checkbox\" id=\"optional_tags[0]\" name=\"optional_tags[0]\" value=\"1\" ";
        // line 112
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "optional_tags", [], "any", false, true, false, 112), 0, [], "array", true, true, false, 112) && ((($_v1 = CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "optional_tags", [], "any", false, false, false, 112)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1[0] ?? null) : null) == "1"))) {
            yield "checked";
        }
        yield ">
                                    <span class=\"checkbox-label\">Optionnelle</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type=\"button\" id=\"add-tag\" class=\"btn-secondary\">Ajouter une compétence</button>
            </div>
            
            <div class=\"form-section\">
                <h2>Description</h2>
                
                <div class=\"form-group\">
                    <label for=\"description\">Description détaillée de l'offre <span class=\"required\">*</span></label>
                    <textarea id=\"description\" name=\"description\" rows=\"10\" required>";
        // line 128
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "description", [], "any", true, true, false, 128)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "description", [], "any", false, false, false, 128), "")) : ("")), "html", null, true);
        yield "</textarea>
                    <p class=\"form-hint\">Décrivez les missions, les responsabilités, le contexte et les objectifs du stage/alternance.</p>
                </div>
            </div>
            
            <div class=\"form-actions\">
                <a href=\"/offres\" class=\"btn-secondary\">Annuler</a>
                <button type=\"submit\" class=\"btn-primary\">Créer l'offre</button>
            </div>
        </form>
    </div>
</div>
";
        yield from [];
    }

    // line 142
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 143
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        /* Create offer container */
        .create-offer-container {
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        /* Header */
        .create-offer-header {
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .create-offer-header h1 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .create-offer-header p {
            color: var(--real-grey);
        }
        
        /* Form sections */
        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--real-lgrey);
        }
        
        .form-section:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .form-section h2 {
            color: var(--onyx);
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
        }
        
        /* Form groups */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
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
        
        .required {
            color: var(--tertiary-color);
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            background-color: white;
        }
        
        .form-group textarea {
            resize: vertical;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--focus-shadow);
        }
        
        /* Checkbox styling */
        .checkbox-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-top: 2rem;
        }
        
        .checkbox-container input {
            width: auto;
            margin-right: 0.5rem;
        }
        
        .checkbox-label {
            font-weight: normal;
        }
        
        /* Tag input group */
        .tag-input-group {
            margin-bottom: 1rem;
        }
        
        /* Hint text */
        .form-hint {
            font-size: 0.9rem;
            color: var(--real-grey);
            margin-top: 0.5rem;
        }
        
        /* Form actions */
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 3rem;
        }
        
        .btn-secondary, .btn-primary {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-secondary {
            background-color: var(--tag-background);
            color: var(--primary-color);
        }
        
        /* Error message */
        .error-message {
            background-color: #ffebee;
            border-left: 4px solid var(--tertiary-color);
            padding: 1rem;
            margin-bottom: 2rem;
            color: var(--tertiary-color);
        }
        
        .error-message ul {
            margin: 0;
            padding-left: 1.5rem;
        }
        
        /* Improved responsiveness */
        @media screen and (max-width: 992px) {
            .form-row {
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }
            
            .create-offer-container {
                padding: 1.75rem;
            }
        }
        
        @media screen and (max-width: 768px) {
            .create-offer-container {
                padding: 1.5rem;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 1rem;
            }
            
            .form-actions .btn-secondary,
            .form-actions .btn-primary {
                width: 100%;
                text-align: center;
            }
            
            .checkbox-container {
                margin-top: 1rem;
            }
        }
        
        @media screen and (max-width: 480px) {
            .create-offer-container {
                padding: 1rem;
            }
            
            .create-offer-header h1 {
                font-size: 1.5rem;
            }
            
            .form-section h2 {
                font-size: 1.2rem;
            }
            
            .form-group input,
            .form-group select,
            .form-group textarea {
                padding: 0.6rem;
                font-size: 0.95rem;
            }
            
            .btn-secondary, .btn-primary {
                padding: 0.7rem 1.2rem;
                font-size: 0.95rem;
            }
        }

        /* Autocomplete styling */
        input[list] {
            position: relative;
        }

        datalist {
            position: absolute;
            max-height: 200px;
            overflow-y: auto;
            background-color: white;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            box-shadow: 0 2px 4px var(--shadow-color);
            z-index: 10;
        }

        datalist option {
            padding: 8px 10px;
            cursor: pointer;
        }

        datalist option:hover {
            background-color: var(--tag-background);
        }
    </style>
";
        yield from [];
    }

    // line 392
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 393
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Get DOM elements
        const addTagButton = document.getElementById('add-tag');
        const tagsContainer = document.getElementById('tags-container');
        const cityInput = document.getElementById('city');
        const postalCodeInput = document.getElementById('postalCode');

        // Initial tag count
        let tagCount = 1;

        // Store available tags for autocomplete
        let availableTags = [];

        // Store available cities for autocomplete
        let availableCities = [];

        // Fetch tags for autocomplete
        const fetchTags = async (query) => {
            try {
                const response = await fetch(`/api/tagsList?query=\${encodeURIComponent(query)}`);
                const tagsData = await response.json();
                availableTags = tagsData.map(tag => tag.name);

                // Initialize autocomplete on existing tag inputs
                document.querySelectorAll('[id^=\"tags[\"]').forEach(input => {
                    initializeTagAutocomplete(input);
                });
            } catch (error) {
                console.error('Error fetching tags for autocomplete:', error);
            }
        };

        // Fetch cities for autocomplete
        const fetchCities = async (query) => {
            try {
                const response = await fetch(`/api/citiesList?query=\${encodeURIComponent(query)}`);
                const citiesData = await response.json();
                availableCities = citiesData;

                // Initialize city autocomplete
                initializeCityAutocomplete();
            } catch (error) {
                console.error('Error fetching cities for autocomplete:', error);
            }
        };

        // Initial fetch for tags and cities
        fetchTags('');
        fetchCities('');

        // Add tag button click handler
        addTagButton.addEventListener('click', () => {
            // Create new tag input group
            const tagInputGroup = document.createElement('div');
            tagInputGroup.className = 'tag-input-group';

            // Create tag input with unique ID based on tagCount
            tagInputGroup.innerHTML = `
                <div class=\"form-row\">
                    <div class=\"form-group tag-input\">
                        <label for=\"tags[\${tagCount}]\">Compétence</label>
                        <input type=\"text\" id=\"tags[\${tagCount}]\" name=\"tags[]\" placeholder=\"Ex: PHP, JavaScript, Réseau...\">
                    </div>

                    <div class=\"form-group optional-checkbox\">
                        <div class=\"checkbox-container\" style=\"display: flex; align-items: center; margin-top: 2rem;\">
                            <input type=\"checkbox\" id=\"optional_tags[\${tagCount}]\" name=\"optional_tags[\${tagCount}]\" value=\"1\">
                            <span class=\"checkbox-label\">Optionnelle</span>
                            <button type=\"button\" class=\"remove-tag\" style=\"margin-left: auto; background: none; border: none; color: var(--tertiary-color); cursor: pointer;\">
                                &times;
                            </button>
                        </div>
                    </div>
                </div>
            `;

            // Add to container
            tagsContainer.appendChild(tagInputGroup);

            // Add remove button handler
            const removeButton = tagInputGroup.querySelector('.remove-tag');
            removeButton.addEventListener('click', () => {
                tagInputGroup.remove();
            });

            // Initialize autocomplete on the new tag input
            const newInput = tagInputGroup.querySelector(`input[id=\"tags[\${tagCount}]\"]`);
            initializeTagAutocomplete(newInput);

            // Increment tag count
            tagCount++;
        });

        // Function to initialize tag autocomplete
        function initializeTagAutocomplete(inputElement) {
            if (!inputElement || !availableTags.length) return;

            // Create a datalist element for autocomplete
            const datalistId = `autocomplete-tag-\${Math.random().toString(36).substr(2, 9)}`;
            let datalist = document.createElement('datalist');
            datalist.id = datalistId;

            // Populate datalist with available tags
            availableTags.forEach(tag => {
                const option = document.createElement('option');
                option.value = tag;
                datalist.appendChild(option);
            });

            // Add datalist to the DOM
            document.body.appendChild(datalist);

            // Connect input to datalist
            inputElement.setAttribute('list', datalistId);

            // Add input event listener for dynamic fetching
            inputElement.addEventListener('input', (event) => {
                fetchTags(event.target.value);
            });
        }

        // Function to initialize city autocomplete
        function initializeCityAutocomplete() {
            if (!cityInput || !postalCodeInput || !availableCities.length) return;

            // Create datalist for city autocomplete
            const cityDatalistId = 'autocomplete-city';
            let cityDatalist = document.getElementById(cityDatalistId);

            if (!cityDatalist) {
                cityDatalist = document.createElement('datalist');
                cityDatalist.id = cityDatalistId;
                document.body.appendChild(cityDatalist);
            }

            // Populate city datalist
            const uniqueCities = [...new Set(availableCities.map(city => city.city_name))];
            uniqueCities.forEach(cityName => {
                const option = document.createElement('option');
                option.value = cityName;
                cityDatalist.appendChild(option);
            });

            // Connect city input to datalist
            cityInput.setAttribute('list', cityDatalistId);

            // Create datalist for postal code autocomplete
            const postalDatalistId = 'autocomplete-postal';
            let postalDatalist = document.getElementById(postalDatalistId);

            if (!postalDatalist) {
                postalDatalist = document.createElement('datalist');
                postalDatalist.id = postalDatalistId;
                document.body.appendChild(postalDatalist);
            }

            // Populate postal code datalist
            const uniquePostalCodes = [...new Set(availableCities.map(city => city.city_postal))];
            uniquePostalCodes.forEach(postalCode => {
                const option = document.createElement('option');
                option.value = postalCode;
                postalDatalist.appendChild(option);
            });

            // Connect postal code input to datalist
            postalCodeInput.setAttribute('list', postalDatalistId);

            // City input event listener
            cityInput.addEventListener('input', () => {
                const selectedCity = cityInput.value;
                const matchedCity = availableCities.find(city => city.city_name === selectedCity);

                if (matchedCity) {
                    postalCodeInput.value = matchedCity.city_postal;
                }
            });

            // Postal code input event listener
            postalCodeInput.addEventListener('input', () => {
                const selectedPostal = postalCodeInput.value;
                const matchedCity = availableCities.find(city => city.city_postal === selectedPostal);

                if (matchedCity) {
                    cityInput.value = matchedCity.city_name;
                }
            });

            // Add input event listener for dynamic fetching
            cityInput.addEventListener('input', (event) => {
                fetchCities(event.target.value);
            });
        }

        // Admin-only code for enterprise dropdown
        ";
        // line 589
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_admin"], "method", false, false, false, 589)) {
            // line 590
            yield "            const enterpriseDropdown = document.getElementById('enterprise');

            // Fetch enterprise list
            fetch('/api/enterpriseList')
                .then(response => response.json())
                .then(data => {
                    // Clear existing options
                    enterpriseDropdown.innerHTML = '<option value=\"\" disabled selected>Sélectionnez une entreprise</option>';

                    // Populate dropdown with enterprise data
                    data.forEach(enterprise => {
                        const option = document.createElement('option');
                        option.value = enterprise.enterprise_id;
                        option.textContent = `\${enterprise.enterprise_name} (\${enterprise.enterprise_id})`;
                        enterpriseDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching enterprise list:', error);
                    enterpriseDropdown.innerHTML = '<option value=\"\" disabled>Erreur lors du chargement des entreprises</option>';
                });
        ";
        }
        // line 612
        yield "    });
</script>

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "offers/create.html.twig";
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
        return array (  802 => 612,  778 => 590,  776 => 589,  576 => 393,  569 => 392,  315 => 143,  308 => 142,  290 => 128,  269 => 112,  261 => 107,  245 => 94,  237 => 89,  220 => 77,  214 => 76,  208 => 75,  199 => 69,  189 => 62,  178 => 56,  172 => 55,  166 => 54,  160 => 53,  154 => 52,  148 => 51,  142 => 50,  129 => 42,  123 => 41,  117 => 40,  108 => 34,  103 => 31,  94 => 24,  92 => 23,  73 => 6,  66 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Créer une offre - {{ parent() }}{% endblock %}

{% block content %}
<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span><a href=\"/offres\">Offres</a></span>
        <span>Créer une offre</span>
    </nav>

    <div class=\"create-offer-container\">
        <header class=\"create-offer-header\">
            <h1>Créer une nouvelle offre</h1>
            <p>Remplissez le formulaire ci-dessous pour créer une nouvelle offre de stage ou d'alternance.</p>
        </header>

        <form class=\"create-offer-form\" method=\"POST\" action=\"/offres\">
            <div class=\"form-section\">
                <h2>Informations générales</h2>
                
                {% if request.hasPermission('perm_admin') %}
                <div class=\"form-group\">
                    <label for=\"enterprise\">[ADMIN] Sélectionnez une entreprise <span class=\"required\">*</span></label>
                    <select id=\"enterprise\" name=\"enterprise\" required>
                        <option value=\"\" disabled selected>Chargement des entreprises...</option>
                    </select>
                </div>
                {% endif %}
                
                <div class=\"form-group\">
                    <label for=\"title\">Titre de l'offre <span class=\"required\">*</span></label>
                    <input type=\"text\" id=\"title\" name=\"title\" value=\"{{ formData.title|default('') }}\" required>
                </div>
                
                <div class=\"form-group\">
                    <label for=\"type\">Type d'offre <span class=\"required\">*</span></label>
                    <select id=\"type\" name=\"type\" required>
                        <option value=\"\" disabled {% if not formData.type is defined %}selected{% endif %}>Sélectionnez un type d'offre</option>
                        <option value=\"0\" {% if formData.type is defined and formData.type == '0' %}selected{% endif %}>Stage</option>
                        <option value=\"1\" {% if formData.type is defined and formData.type == '1' %}selected{% endif %}>Alternance</option>
                    </select>
                </div>
                
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"level\">Niveau d'études requis <span class=\"required\">*</span></label>
                        <select id=\"level\" name=\"level\" required>
                            <option value=\"\" disabled {% if not formData.level is defined %}selected{% endif %}>Sélectionnez un niveau</option>
                            <option value=\"Bac\" {% if formData.level is defined and formData.level == 'Bac' %}selected{% endif %}>Bac</option>
                            <option value=\"Bac +2\" {% if formData.level is defined and formData.level == 'Bac +2' %}selected{% endif %}>Bac +2</option>
                            <option value=\"Bac +3\" {% if formData.level is defined and formData.level == 'Bac +3' %}selected{% endif %}>Bac +3</option>
                            <option value=\"Bac +4\" {% if formData.level is defined and formData.level == 'Bac +4' %}selected{% endif %}>Bac +4</option>
                            <option value=\"Bac +5\" {% if formData.level is defined and formData.level == 'Bac +5' %}selected{% endif %}>Bac +5</option>
                            <option value=\"Bac +3, Bac +5\" {% if formData.level is defined and formData.level == 'Bac +3, Bac +5' %}selected{% endif %}>Bac +3, Bac +5</option>
                        </select>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"duration\">Durée <span class=\"required\">*</span></label>
                        <input type=\"text\" id=\"duration\" name=\"duration\" value=\"{{ formData.duration|default('') }}\" required placeholder=\"Ex: 3 mois, 6 mois, 1 an\">
                    </div>
                </div>
                
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"startDate\">Date de début <span class=\"required\">*</span></label>
                        <input type=\"date\" id=\"startDate\" name=\"startDate\" value=\"{{ formData.startDate|default('') }}\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"remuneration\">Rémunération</label>
                        <select id=\"remuneration\" name=\"remuneration\">
                            <option value=\"\" disabled {% if not formData.Remuneration is defined %}selected{% endif %}>L'offre est-elle rémunérée ?</option>
                            <option value=\"0\" {% if formData.remuneration is defined and formData.remuneration == '0' %}selected{% endif %}>Non rémunéré</option>
                            <option value=\"1\" {% if formData.remuneration is defined and formData.remuneration == '1' %}selected{% endif %}>Rémunéré</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class=\"form-section\">
                <h2>Localisation</h2>
                
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"city\">Ville <span class=\"required\">*</span></label>
                        <input type=\"text\" id=\"city\" name=\"city\" value=\"{{ formData.city|default('') }}\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"postalCode\">Code postal <span class=\"required\">*</span></label>
                        <input type=\"number\" id=\"postalCode\" name=\"postalCode\" value=\"{{ formData.postalCode|default('') }}\" required>
                    </div>
                </div>
            </div>
            
            <div class=\"form-section\">
                <h2>Compétences</h2>
                
                <div id=\"tags-container\">
                    <div class=\"tag-input-group\">
                        <div class=\"form-row\">
                            <div class=\"form-group tag-input\">
                                <label for=\"tags[0]\">Compétence</label>
                                <input type=\"text\" id=\"tags[0]\" name=\"tags[]\" value=\"{{ formData.tags[0]|default('') }}\" placeholder=\"Ex: PHP, JavaScript, Réseau...\">
                            </div>
                            
                            <div class=\"form-group optional-checkbox\">
                                <label class=\"checkbox-container\">
                                    <input type=\"checkbox\" id=\"optional_tags[0]\" name=\"optional_tags[0]\" value=\"1\" {% if formData.optional_tags[0] is defined and formData.optional_tags[0] == '1' %}checked{% endif %}>
                                    <span class=\"checkbox-label\">Optionnelle</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type=\"button\" id=\"add-tag\" class=\"btn-secondary\">Ajouter une compétence</button>
            </div>
            
            <div class=\"form-section\">
                <h2>Description</h2>
                
                <div class=\"form-group\">
                    <label for=\"description\">Description détaillée de l'offre <span class=\"required\">*</span></label>
                    <textarea id=\"description\" name=\"description\" rows=\"10\" required>{{ formData.description|default('') }}</textarea>
                    <p class=\"form-hint\">Décrivez les missions, les responsabilités, le contexte et les objectifs du stage/alternance.</p>
                </div>
            </div>
            
            <div class=\"form-actions\">
                <a href=\"/offres\" class=\"btn-secondary\">Annuler</a>
                <button type=\"submit\" class=\"btn-primary\">Créer l'offre</button>
            </div>
        </form>
    </div>
</div>
{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        /* Create offer container */
        .create-offer-container {
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        /* Header */
        .create-offer-header {
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .create-offer-header h1 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .create-offer-header p {
            color: var(--real-grey);
        }
        
        /* Form sections */
        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--real-lgrey);
        }
        
        .form-section:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .form-section h2 {
            color: var(--onyx);
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
        }
        
        /* Form groups */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
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
        
        .required {
            color: var(--tertiary-color);
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            background-color: white;
        }
        
        .form-group textarea {
            resize: vertical;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--focus-shadow);
        }
        
        /* Checkbox styling */
        .checkbox-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-top: 2rem;
        }
        
        .checkbox-container input {
            width: auto;
            margin-right: 0.5rem;
        }
        
        .checkbox-label {
            font-weight: normal;
        }
        
        /* Tag input group */
        .tag-input-group {
            margin-bottom: 1rem;
        }
        
        /* Hint text */
        .form-hint {
            font-size: 0.9rem;
            color: var(--real-grey);
            margin-top: 0.5rem;
        }
        
        /* Form actions */
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 3rem;
        }
        
        .btn-secondary, .btn-primary {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-secondary {
            background-color: var(--tag-background);
            color: var(--primary-color);
        }
        
        /* Error message */
        .error-message {
            background-color: #ffebee;
            border-left: 4px solid var(--tertiary-color);
            padding: 1rem;
            margin-bottom: 2rem;
            color: var(--tertiary-color);
        }
        
        .error-message ul {
            margin: 0;
            padding-left: 1.5rem;
        }
        
        /* Improved responsiveness */
        @media screen and (max-width: 992px) {
            .form-row {
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }
            
            .create-offer-container {
                padding: 1.75rem;
            }
        }
        
        @media screen and (max-width: 768px) {
            .create-offer-container {
                padding: 1.5rem;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 1rem;
            }
            
            .form-actions .btn-secondary,
            .form-actions .btn-primary {
                width: 100%;
                text-align: center;
            }
            
            .checkbox-container {
                margin-top: 1rem;
            }
        }
        
        @media screen and (max-width: 480px) {
            .create-offer-container {
                padding: 1rem;
            }
            
            .create-offer-header h1 {
                font-size: 1.5rem;
            }
            
            .form-section h2 {
                font-size: 1.2rem;
            }
            
            .form-group input,
            .form-group select,
            .form-group textarea {
                padding: 0.6rem;
                font-size: 0.95rem;
            }
            
            .btn-secondary, .btn-primary {
                padding: 0.7rem 1.2rem;
                font-size: 0.95rem;
            }
        }

        /* Autocomplete styling */
        input[list] {
            position: relative;
        }

        datalist {
            position: absolute;
            max-height: 200px;
            overflow-y: auto;
            background-color: white;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            box-shadow: 0 2px 4px var(--shadow-color);
            z-index: 10;
        }

        datalist option {
            padding: 8px 10px;
            cursor: pointer;
        }

        datalist option:hover {
            background-color: var(--tag-background);
        }
    </style>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Get DOM elements
        const addTagButton = document.getElementById('add-tag');
        const tagsContainer = document.getElementById('tags-container');
        const cityInput = document.getElementById('city');
        const postalCodeInput = document.getElementById('postalCode');

        // Initial tag count
        let tagCount = 1;

        // Store available tags for autocomplete
        let availableTags = [];

        // Store available cities for autocomplete
        let availableCities = [];

        // Fetch tags for autocomplete
        const fetchTags = async (query) => {
            try {
                const response = await fetch(`/api/tagsList?query=\${encodeURIComponent(query)}`);
                const tagsData = await response.json();
                availableTags = tagsData.map(tag => tag.name);

                // Initialize autocomplete on existing tag inputs
                document.querySelectorAll('[id^=\"tags[\"]').forEach(input => {
                    initializeTagAutocomplete(input);
                });
            } catch (error) {
                console.error('Error fetching tags for autocomplete:', error);
            }
        };

        // Fetch cities for autocomplete
        const fetchCities = async (query) => {
            try {
                const response = await fetch(`/api/citiesList?query=\${encodeURIComponent(query)}`);
                const citiesData = await response.json();
                availableCities = citiesData;

                // Initialize city autocomplete
                initializeCityAutocomplete();
            } catch (error) {
                console.error('Error fetching cities for autocomplete:', error);
            }
        };

        // Initial fetch for tags and cities
        fetchTags('');
        fetchCities('');

        // Add tag button click handler
        addTagButton.addEventListener('click', () => {
            // Create new tag input group
            const tagInputGroup = document.createElement('div');
            tagInputGroup.className = 'tag-input-group';

            // Create tag input with unique ID based on tagCount
            tagInputGroup.innerHTML = `
                <div class=\"form-row\">
                    <div class=\"form-group tag-input\">
                        <label for=\"tags[\${tagCount}]\">Compétence</label>
                        <input type=\"text\" id=\"tags[\${tagCount}]\" name=\"tags[]\" placeholder=\"Ex: PHP, JavaScript, Réseau...\">
                    </div>

                    <div class=\"form-group optional-checkbox\">
                        <div class=\"checkbox-container\" style=\"display: flex; align-items: center; margin-top: 2rem;\">
                            <input type=\"checkbox\" id=\"optional_tags[\${tagCount}]\" name=\"optional_tags[\${tagCount}]\" value=\"1\">
                            <span class=\"checkbox-label\">Optionnelle</span>
                            <button type=\"button\" class=\"remove-tag\" style=\"margin-left: auto; background: none; border: none; color: var(--tertiary-color); cursor: pointer;\">
                                &times;
                            </button>
                        </div>
                    </div>
                </div>
            `;

            // Add to container
            tagsContainer.appendChild(tagInputGroup);

            // Add remove button handler
            const removeButton = tagInputGroup.querySelector('.remove-tag');
            removeButton.addEventListener('click', () => {
                tagInputGroup.remove();
            });

            // Initialize autocomplete on the new tag input
            const newInput = tagInputGroup.querySelector(`input[id=\"tags[\${tagCount}]\"]`);
            initializeTagAutocomplete(newInput);

            // Increment tag count
            tagCount++;
        });

        // Function to initialize tag autocomplete
        function initializeTagAutocomplete(inputElement) {
            if (!inputElement || !availableTags.length) return;

            // Create a datalist element for autocomplete
            const datalistId = `autocomplete-tag-\${Math.random().toString(36).substr(2, 9)}`;
            let datalist = document.createElement('datalist');
            datalist.id = datalistId;

            // Populate datalist with available tags
            availableTags.forEach(tag => {
                const option = document.createElement('option');
                option.value = tag;
                datalist.appendChild(option);
            });

            // Add datalist to the DOM
            document.body.appendChild(datalist);

            // Connect input to datalist
            inputElement.setAttribute('list', datalistId);

            // Add input event listener for dynamic fetching
            inputElement.addEventListener('input', (event) => {
                fetchTags(event.target.value);
            });
        }

        // Function to initialize city autocomplete
        function initializeCityAutocomplete() {
            if (!cityInput || !postalCodeInput || !availableCities.length) return;

            // Create datalist for city autocomplete
            const cityDatalistId = 'autocomplete-city';
            let cityDatalist = document.getElementById(cityDatalistId);

            if (!cityDatalist) {
                cityDatalist = document.createElement('datalist');
                cityDatalist.id = cityDatalistId;
                document.body.appendChild(cityDatalist);
            }

            // Populate city datalist
            const uniqueCities = [...new Set(availableCities.map(city => city.city_name))];
            uniqueCities.forEach(cityName => {
                const option = document.createElement('option');
                option.value = cityName;
                cityDatalist.appendChild(option);
            });

            // Connect city input to datalist
            cityInput.setAttribute('list', cityDatalistId);

            // Create datalist for postal code autocomplete
            const postalDatalistId = 'autocomplete-postal';
            let postalDatalist = document.getElementById(postalDatalistId);

            if (!postalDatalist) {
                postalDatalist = document.createElement('datalist');
                postalDatalist.id = postalDatalistId;
                document.body.appendChild(postalDatalist);
            }

            // Populate postal code datalist
            const uniquePostalCodes = [...new Set(availableCities.map(city => city.city_postal))];
            uniquePostalCodes.forEach(postalCode => {
                const option = document.createElement('option');
                option.value = postalCode;
                postalDatalist.appendChild(option);
            });

            // Connect postal code input to datalist
            postalCodeInput.setAttribute('list', postalDatalistId);

            // City input event listener
            cityInput.addEventListener('input', () => {
                const selectedCity = cityInput.value;
                const matchedCity = availableCities.find(city => city.city_name === selectedCity);

                if (matchedCity) {
                    postalCodeInput.value = matchedCity.city_postal;
                }
            });

            // Postal code input event listener
            postalCodeInput.addEventListener('input', () => {
                const selectedPostal = postalCodeInput.value;
                const matchedCity = availableCities.find(city => city.city_postal === selectedPostal);

                if (matchedCity) {
                    cityInput.value = matchedCity.city_name;
                }
            });

            // Add input event listener for dynamic fetching
            cityInput.addEventListener('input', (event) => {
                fetchCities(event.target.value);
            });
        }

        // Admin-only code for enterprise dropdown
        {% if request.hasPermission('perm_admin') %}
            const enterpriseDropdown = document.getElementById('enterprise');

            // Fetch enterprise list
            fetch('/api/enterpriseList')
                .then(response => response.json())
                .then(data => {
                    // Clear existing options
                    enterpriseDropdown.innerHTML = '<option value=\"\" disabled selected>Sélectionnez une entreprise</option>';

                    // Populate dropdown with enterprise data
                    data.forEach(enterprise => {
                        const option = document.createElement('option');
                        option.value = enterprise.enterprise_id;
                        option.textContent = `\${enterprise.enterprise_name} (\${enterprise.enterprise_id})`;
                        enterpriseDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching enterprise list:', error);
                    enterpriseDropdown.innerHTML = '<option value=\"\" disabled>Erreur lors du chargement des entreprises</option>';
                });
        {% endif %}
    });
</script>

{% endblock %}", "offers/create.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\offers\\create.html.twig");
    }
}
