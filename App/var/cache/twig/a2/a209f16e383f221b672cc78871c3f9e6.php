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

/* user/profile.html.twig */
class __TwigTemplate_67bdb4132f1a79a1e2111d5a2b22d59b extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "user/profile.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Mon Profil - ";
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

            /* Responsive adjustments */
        @media screen and (max-width: 1024px) {
            .profile-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .profile-sidebar {
                margin-bottom: 2rem;
            }

            .tab-navigation {
                flex-wrap: wrap;
                justify-content: center;
            }

            .tab-button {
                flex: 1 1 auto;
                text-align: center;
                padding: 0.8rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .modal-content {
                width: 90%;
                margin: 5% auto;
            }
        }

        @media screen and (max-width: 768px) {
            .profile-container {
                grid-template-columns: 1fr;
            }

            .profile-sidebar {
                margin-bottom: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }

            .modal-content {
                width: 95%;
                margin: 5% auto;
            }

            .tab-navigation {
                flex-direction: column;
                align-items: stretch;
            }

            .tab-button {
                padding: 0.5rem;
                font-size: 0.9rem;
            }

            .danger-zone-content {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media screen and (max-width: 480px) {
            .profile-info h2 {
                font-size: 1.2rem;
            }

            .profile-info p {
                font-size: 0.9rem;
            }

            .btn-save,
            .btn-danger,
            .btn-cancel,
            .btn-crop {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .tab-button {
                font-size: 0.8rem;
                padding: 0.4rem;
            }

            .danger-message h4 {
                font-size: 1rem;
            }

            .danger-message p {
                font-size: 0.8rem;
            }
        }

        /* Profile page styles */
        .profile-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
        }
        
        /* Profile sidebar */
        .profile-sidebar {
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 2rem;
        }
        
        .profile-picture-container {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            overflow: hidden;
            background-color: var(--tag-background);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .profile-picture {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-picture-placeholder {
            font-size: 5rem;
            color: var(--primary-color);
        }
        
        .upload-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 0.5rem;
            text-align: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .profile-picture-container:hover .upload-overlay {
            opacity: 1;
        }
        
        .profile-info {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .profile-info h2 {
            margin: 0 0 0.5rem 0;
            color: var(--onyx);
        }
        
        .profile-info p {
            margin: 0;
            color: var(--real-grey);
        }
        
        .profile-actions a {
            display: block;
            text-align: center;
            color: var(--primary-color);
            text-decoration: none;
            padding: 0.5rem;
            transition: background-color 0.3s ease;
            border-radius: 4px;
        }
        
        .profile-actions a:hover {
            background-color: var(--tag-background);
        }
        
        /* Main content (form sections) */
        .profile-main {
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 2rem;
        }
        
        .tab-navigation {
            display: flex;
            border-bottom: 1px solid var(--tag-background);
            margin-bottom: 2rem;
        }
        
        .tab-button {
            padding: 1rem;
            border: none;
            background: none;
            font-weight: bold;
            color: var(--real-grey);
            cursor: pointer;
            position: relative;
            transition: color 0.3s ease;
        }
        
        .tab-button:hover {
            color: var(--primary-color);
        }
        
        .tab-button.active {
            color: var(--primary-color);
        }
        
        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .form-section {
            margin-bottom: 2rem;
        }
        
        .form-section h3 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            color: var(--onyx);
            border-bottom: 1px solid var(--tag-background);
            padding-bottom: 0.5rem;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
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
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            background-color: white;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--focus-shadow);
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 2rem;
        }
        
        .btn-save {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: filter 0.3s ease;
        }
        
        .btn-save:hover {
            filter: brightness(0.9);
        }
        
        /* Picture upload modal */
        .modal {
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
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--tag-background);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h2 {
            margin: 0;
            color: var(--onyx);
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--real-grey);
            cursor: pointer;
        }
        
        .cropper-container {
            margin-bottom: 1.5rem;
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
        
        .btn-crop {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .file-input {
            display: none;
        }
        
        .file-label {
            display: block;
            text-align: center;
            padding: 1rem;
            background-color: var(--tag-background);
            color: var(--primary-color);
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }
        
        /* Loading overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        
        .spinner {
            border: 5px solid var(--background-grey);
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .profile-container {
                grid-template-columns: 1fr;
            }
            
            .profile-sidebar {
                margin-bottom: 2rem;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .modal-content {
                width: 95%;
                margin: 5% auto;
            }
            .danger-zone-content {
                display:flex;
                align-items:center;
            }
        }
        /* Danger Zone Styles */
        .danger-zone-content {
            padding: 1.5rem;
            background-color: rgba(220, 53, 69, 0.05);
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .danger-alert {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .danger-icon {
            flex-shrink: 0;
            color: var(--tertiary-color);
            margin-top: 0.25rem;
        }

        .danger-message {
            margin-top: 3px;
        }
        .danger-message h4 {
            margin: 0 0 0.5rem 0;
            color: var(--tertiary-color);
        }

        .danger-message p {
            margin: 0;
            color: var(--real-grey);
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
        }

        .btn-danger:hover {
            filter: brightness(0.9);
        }

        /* Confirmation modal */
        .confirm-modal {
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

        .confirm-modal-content {
            background-color: var(--background-nav);
            margin: 15% auto;
            padding: 1.5rem;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .confirm-modal-header {
            margin-bottom: 1.5rem;
        }

        .confirm-modal-header h3 {
            margin: 0;
            color: var(--tertiary-color);
        }

        .confirm-modal-body {
            margin-bottom: 1.5rem;
        }

        .confirm-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .btn-cancel-delete {
            background-color: var(--real-lgrey);
            border: 1px solid var(--real-grey);
            color: var(--onyx);
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-confirm-delete {
            background-color: var(--tertiary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        /* Tags management styles */
        .tags-container {
            margin-top: 1rem;
        }

        .tags-input-container {
            margin-bottom: 1.5rem;
        }

        .tags-input-wrapper {
            display: flex;
            gap: 0.5rem;
        }

        .tags-input-wrapper input {
            flex: 1;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            background-color: white;
            font-size: 1rem;
        }

        .btn-add-tag {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
        }

        .tags-autocomplete {
            position: absolute;
            width: calc(100% - 120px);
            max-height: 200px;
            overflow-y: auto;
            background-color: white;
            border: 1px solid var(--real-grey);
            border-radius: 0 0 4px 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 100;
            display: none;
        }

        .autocomplete-item {
            padding: 0.8rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .autocomplete-item:hover, .autocomplete-item.selected {
            background-color: var(--tag-background);
        }

        .user-tags-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            min-height: 50px;
        }

        .user-tag {
            display: inline-flex;
            align-items: center;
            background-color: var(--tag-background);
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-size: 0.9rem;
            gap: 0.5rem;
        }

        .user-tag .remove-tag {
            cursor: pointer;
            color: var(--real-grey);
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .user-tag .remove-tag:hover {
            background-color: var(--real-grey);
            color: white;
        }

        .loading-tags {
            color: var(--real-grey);
            font-style: italic;
        }

        .empty-tags {
            color: var(--real-grey);
            font-style: italic;
        }
    </style>
";
        yield from [];
    }

    // line 673
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 674
        yield "<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span>Mon Profil</span>
    </nav>

    <div class=\"profile-container\">
        <!-- Profile Sidebar -->
        <div class=\"profile-sidebar\">
            <div class=\"profile-picture-container\">
                ";
        // line 684
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "profilePictureUrl", [], "any", false, false, false, 684)) {
            // line 685
            yield "                    <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "profilePictureUrl", [], "any", false, false, false, 685), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userFirstName", [], "any", false, false, false, 685), "html", null, true);
            yield "\" class=\"profile-picture\" id=\"profileImage\">
                ";
        } else {
            // line 687
            yield "
                ";
        }
        // line 689
        yield "                <div class=\"upload-overlay\" id=\"uploadOverlay\">
                    Changer la photo
                </div>
            </div>
            
            <div class=\"profile-info\">
                <h2>";
        // line 695
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userFirstName", [], "any", false, false, false, 695), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userName", [], "any", false, false, false, 695), "html", null, true);
        yield "</h2>
                <p>";
        // line 696
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userEmail", [], "any", false, false, false, 696), "html", null, true);
        yield "</p>
                <p>Type de recherche: 
                    ";
        // line 698
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userSearchType", [], "any", false, false, false, 698) == "none")) {
            // line 699
            yield "                        Non spécifié
                    ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 700
($context["user"] ?? null), "userSearchType", [], "any", false, false, false, 700) == "1")) {
            // line 701
            yield "                        Alternance
                    ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 702
($context["user"] ?? null), "userSearchType", [], "any", false, false, false, 702) == "0")) {
            // line 703
            yield "                        Stage
                    ";
        } else {
            // line 705
            yield "                        Non spécifié
                    ";
        }
        // line 707
        yield "                </p>
            </div>
            
            <div class=\"profile-actions\">
                <a href=\"/wishlist\">Ma Wishlist</a>
                <a href=\"/interactions\">Mes Candidatures</a>
                <a href=\"/logout\">Se déconnecter</a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class=\"profile-main\">
            <div class=\"tab-navigation\">
                <button class=\"tab-button active\" data-tab=\"profile-info\">Informations Personnelles</button>
                <button class=\"tab-button\" data-tab=\"password\">Mot de Passe</button>
                <button class=\"tab-button\" data-tab=\"danger-zone\">Zone de danger</button>
            </div>
            
            <!-- Profile Info Tab -->
            <div class=\"tab-content active\" id=\"profile-info\">
                <form action=\"/update-profile\" method=\"POST\">
                    <div class=\"form-section\">
                        <h3>Informations Personnelles</h3>
                        
                        <div class=\"form-row\">
                            <div class=\"form-group\">
                                <label for=\"firstName\">Prénom</label>
                                <input type=\"text\" id=\"firstName\" name=\"firstName\" value=\"";
        // line 734
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "firstName", [], "any", true, true, false, 734)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "firstName", [], "any", false, false, false, 734), CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userFirstName", [], "any", false, false, false, 734))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userFirstName", [], "any", false, false, false, 734))), "html", null, true);
        yield "\" required>
                            </div>
                            
                            <div class=\"form-group\">
                                <label for=\"lastName\">Nom</label>
                                <input type=\"text\" id=\"lastName\" name=\"lastName\" value=\"";
        // line 739
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "lastName", [], "any", true, true, false, 739)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "lastName", [], "any", false, false, false, 739), CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userName", [], "any", false, false, false, 739))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userName", [], "any", false, false, false, 739))), "html", null, true);
        yield "\" required>
                            </div>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"email\">Email</label>
                            <input type=\"email\" id=\"email\" name=\"email\" value=\"";
        // line 745
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "email", [], "any", true, true, false, 745)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "email", [], "any", false, false, false, 745), CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userEmail", [], "any", false, false, false, 745))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userEmail", [], "any", false, false, false, 745))), "html", null, true);
        yield "\" required>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"phone\">Téléphone</label>
                            <input type=\"tel\" id=\"phone\" name=\"phone\" value=\"";
        // line 750
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "phone", [], "any", true, true, false, 750)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "phone", [], "any", false, false, false, 750), CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userPhone", [], "any", false, false, false, 750))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userPhone", [], "any", false, false, false, 750))), "html", null, true);
        yield "\" required>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"searchType\">Type de recherche</label>
                            <select id=\"searchType\" name=\"searchType\">
                                <option value=\"none\" ";
        // line 756
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userSearchType", [], "any", false, false, false, 756) == "none")) {
            yield "selected";
        }
        yield ">Non spécifié</option>
                                <option value=\"0\" ";
        // line 757
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userSearchType", [], "any", false, false, false, 757) == "0")) {
            yield "selected";
        }
        yield ">Stage</option>
                                <option value=\"1\" ";
        // line 758
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userSearchType", [], "any", false, false, false, 758) == "1")) {
            yield "selected";
        }
        yield ">Alternance</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class=\"form-actions\">
                        <button type=\"submit\" class=\"btn-save\">Enregistrer les modifications</button>
                    </div>
                </form>

                <div class=\"form-section\">
                    <h3>Mes compétences et intérêts</h3>
                    
                    <div class=\"tags-container\">
                        <div class=\"tags-input-container\">
                            <label for=\"tagInput\">Ajouter une compétence ou un centre d'intérêt</label>
                            <div class=\"tags-input-wrapper\">
                                <input type=\"text\" id=\"tagInput\" placeholder=\"Exemple: PHP, JavaScript, UX Design...\">
                                <button type=\"button\" id=\"addTagBtn\" class=\"btn-add-tag\">Ajouter</button>
                            </div>
                            <div id=\"tagsAutocomplete\" class=\"tags-autocomplete\"></div>
                        </div>
                        
                        <div class=\"user-tags-list\" id=\"userTagsList\">
                            <div class=\"loading-tags\">Chargement des compétences...</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Password Tab -->
            <div class=\"tab-content\" id=\"password\">
                <form action=\"/change-password\" method=\"POST\">
                    <div class=\"form-section\">
                        <h3>Changer le mot de passe</h3>
                        
                        <div class=\"form-group\">
                            <label for=\"currentPassword\">Mot de passe actuel</label>
                            <input type=\"password\" id=\"currentPassword\" name=\"currentPassword\" required>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"newPassword\">Nouveau mot de passe</label>
                            <input type=\"password\" id=\"newPassword\" name=\"newPassword\" required minlength=\"8\">
                            <small>Le mot de passe doit contenir au moins 8 caractères</small>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"confirmPassword\">Confirmer le nouveau mot de passe</label>
                            <input type=\"password\" id=\"confirmPassword\" name=\"confirmPassword\" required minlength=\"8\">
                        </div>
                    </div>
                    
                    <div class=\"form-actions\">
                        <button type=\"submit\" class=\"btn-save\">Changer le mot de passe</button>
                    </div>
                </form>
            </div>

            <!-- Danger Zone Tab -->
            <div class=\"tab-content\" id=\"danger-zone\">
                <div class=\"form-section\">
                    <h3>Zone de danger</h3>
                    
                    <div class=\"danger-zone-content\">
                        <div class=\"danger-alert\">

                            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"danger-icon\" width=\"24\" height=\"24\" viewBox=\"-2 -3 24 24\"><path fill=\"currentColor\" d=\"m12.8 1.613l6.701 11.161c.963 1.603.49 3.712-1.057 4.71a3.2 3.2 0 0 1-1.743.516H3.298C1.477 18 0 16.47 0 14.581c0-.639.173-1.264.498-1.807L7.2 1.613C8.162.01 10.196-.481 11.743.517c.428.276.79.651 1.057 1.096M10 14a1 1 0 1 0 0-2a1 1 0 0 0 0 2m0-9a1 1 0 0 0-1 1v4a1 1 0 0 0 2 0V6a1 1 0 0 0-1-1\"/></svg>
                            <div class=\"danger-message\">
                                <h4>Supprimer mon compte</h4>
                                <p>La suppression de votre compte est définitive et ne peut pas être annulée. Toutes vos données personnelles, candidatures et wishlist seront supprimées.</p>
                            </div>
                        </div>
                        
                        <button type=\"button\" id=\"delete-account-btn\" class=\"btn-danger\" data-userid=\"";
        // line 832
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "userId", [], "any", false, false, false, 832), "html", null, true);
        yield "\">
                            Supprimer mon compte
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Picture Upload Modal -->
<div class=\"modal\" id=\"uploadModal\">
    <div class=\"modal-content\">
        <div class=\"modal-header\">
            <h2>Modifier votre photo de profil</h2>
            <button class=\"close-modal\">&times;</button>
        </div>
        <div class=\"modal-body\">
            <label for=\"profilePictureInput\" class=\"file-label\">Sélectionner une image</label>
            <input type=\"file\" id=\"profilePictureInput\" class=\"file-input\" accept=\"image/*\">
            
            <div class=\"cropper-container\">
                <img id=\"cropperImage\" style=\"display: none; max-width: 100%;\">
            </div>
            
            <div class=\"modal-actions\">
                <button class=\"btn-cancel\" id=\"cancelUpload\">Annuler</button>
                <button class=\"btn-crop\" id=\"cropImage\" disabled>Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class=\"loading-overlay\" id=\"loadingOverlay\">
    <div class=\"spinner\"></div>
    <p>Traitement en cours...</p>
</div>

<!-- Confirmation Modal for Account Deletion -->
<div class=\"confirm-modal\" id=\"confirmDeleteModal\">
    <div class=\"confirm-modal-content\">
        <div class=\"confirm-modal-header\">
            <h3>Confirmer la suppression</h3>
        </div>
        <div class=\"confirm-modal-body\">
            <p>Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
            <p>Toutes vos données personnelles, candidatures et wishlist seront supprimées définitivement.</p>
        </div>
        <div class=\"confirm-modal-actions\">
            <button class=\"btn-cancel-delete\" id=\"cancelDeleteBtn\">Annuler</button>
            <button class=\"btn-confirm-delete\" id=\"confirmDeleteBtn\">Supprimer définitivement</button>
        </div>
    </div>
</div>
";
        yield from [];
    }

    // line 889
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 890
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js\"></script>
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css\">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                console.log('Tab button clicked');
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to clicked button
                this.classList.add('active');

                // Show corresponding content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Profile picture upload functionality
        const uploadOverlay = document.getElementById('uploadOverlay');
        const uploadModal = document.getElementById('uploadModal');
        const closeModalButton = document.querySelector('.close-modal');
        const cancelUploadButton = document.getElementById('cancelUpload');
        const profilePictureInput = document.getElementById('profilePictureInput');
        const cropperImage = document.getElementById('cropperImage');
        const cropButton = document.getElementById('cropImage');
        const loadingOverlay = document.getElementById('loadingOverlay');

        let cropper;

        // Open modal when clicking the upload overlay
        uploadOverlay.addEventListener('click', function() {
            console.log('Upload overlay clicked');
            uploadModal.style.display = 'block';
        });

        // Close modal functions
        function closeModal() {
            uploadModal.style.display = 'none';

            // Destroy cropper if it exists
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }

            // Reset file input
            profilePictureInput.value = '';
            cropperImage.style.display = 'none';
            cropButton.disabled = true;
        }

        closeModalButton.addEventListener('click', closeModal);
        cancelUploadButton.addEventListener('click', closeModal);

        // Close modal when clicking outside content
        window.addEventListener('click', function(event) {
            if (event.target === uploadModal) {
                closeModal();
            }
        });

        // Handle file selection
        profilePictureInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];

                // Check file type
                if (!file.type.match('image.*')) {
                    alert('Veuillez sélectionner une image');
                    return;
                }

                // Check file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert('L\\'image est trop volumineuse. Maximum 5 Mo.');
                    return;
                }

                // Create object URL for the file
                const URL = window.URL || window.webkitURL;
                const imageUrl = URL.createObjectURL(file);

                // Display the image and initialize cropper
                cropperImage.src = imageUrl;
                cropperImage.style.display = 'block';
                cropButton.disabled = false;

                // Destroy previous cropper if it exists
                if (cropper) {
                    cropper.destroy();
                }

                // Initialize Cropper.js with a 1:1 aspect ratio
                cropper = new Cropper(cropperImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    restore: false,
                    guides: true,
                    center: true,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false
                });
            }
        });

        // Handle crop and upload
        cropButton.addEventListener('click', async function() {
            if (!cropper) {
                return;
            }

            // Show loading overlay
            loadingOverlay.style.display = 'flex';

            try {
                // Get cropped canvas
                const canvas = cropper.getCroppedCanvas({
                    width: 300,
                    height: 300,
                    fillColor: '#fff',
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high'
                });

                if (!canvas) {
                    throw new Error('Failed to crop image');
                }

                // Get crop data for server
                const cropData = cropper.getData(true); // true = rounded values

                // Convert canvas to blob
                const blob = await new Promise(resolve => {
                    canvas.toBlob(resolve, 'image/png');
                });

                if (!blob) {
                    throw new Error('Failed to convert canvas to blob');
                }

                // Create FormData
                const formData = new FormData();
                formData.append('profilePicture', blob, 'profile.png');
                formData.append('cropX', cropData.x);
                formData.append('cropY', cropData.y);
                formData.append('cropWidth', cropData.width);
                formData.append('cropHeight', cropData.height);

                // Send to server
                const response = await fetch('/upload-profile-picture', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    // Update profile picture
                    const profileImage = document.getElementById('profileImage');
                    const profilePlaceholder = document.getElementById('profilePlaceholder');

                    if (profileImage) {
                        profileImage.src = data.url + '?t=' + new Date().getTime(); // Add timestamp to avoid caching
                    } else {
                        // Create new image if placeholder is showing
                        const newImage = document.createElement('img');
                        newImage.src = data.url + '?t=' + new Date().getTime();
                        newImage.alt = 'Profile Picture';
                        newImage.className = 'profile-picture';
                        newImage.id = 'profileImage';

                        const container = document.querySelector('.profile-picture-container');
                        container.innerHTML = '';
                        container.appendChild(newImage);
                        container.appendChild(uploadOverlay);
                    }

                    // Show success notification
                    if (typeof addNotification === 'function') {
                        addNotification(data.message, 'success');
                    } else {
                        alert(data.message);
                    }

                    // Close modal
                    closeModal();
                } else {
                    throw new Error(data.message || 'Failed to upload profile picture');
                }
            } catch (error) {
                console.error('Error uploading profile picture:', error);

                // Show error notification
                if (typeof addNotification === 'function') {
                    addNotification(error.message || 'Une erreur est survenue. Veuillez réessayer.', 'error');
                } else {
                    alert(error.message || 'Une erreur est survenue. Veuillez réessayer.');
                }
            } finally {
                // Hide loading overlay
                loadingOverlay.style.display = 'none';
            }
        });

        // Password validation
        const newPasswordInput = document.getElementById('newPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        confirmPasswordInput?.addEventListener('input', function() {
            if (newPasswordInput.value !== this.value) {
                this.setCustomValidity('Les mots de passe ne correspondent pas');
            } else {
                this.setCustomValidity('');
            }
        });

        newPasswordInput?.addEventListener('input', function() {
            if (confirmPasswordInput.value !== '' && confirmPasswordInput.value !== this.value) {
                confirmPasswordInput.setCustomValidity('Les mots de passe ne correspondent pas');
            } else {
                confirmPasswordInput.setCustomValidity('');
            }
        });

        // Delete account functionality
        const deleteAccountBtn = document.getElementById('delete-account-btn');
        const confirmDeleteModal = document.getElementById('confirmDeleteModal');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        // Open confirmation modal when delete button is clicked
        deleteAccountBtn?.addEventListener('click', function() {
            console.log('Delete button clicked');
            confirmDeleteModal.style.display = 'block';
        });

        // Close modal when cancel button is clicked
        cancelDeleteBtn?.addEventListener('click', function() {
            confirmDeleteModal.style.display = 'none';
        });

        // Close modal when clicking outside content
        window.addEventListener('click', function(event) {
            if (event.target === confirmDeleteModal) {
                confirmDeleteModal.style.display = 'none';
            }
        });

        // Handle account deletion confirmation
        confirmDeleteBtn?.addEventListener('click', async function() {
            // Show loading overlay
            loadingOverlay.style.display = 'flex';

            try {
                const userId = deleteAccountBtn.getAttribute('data-userid');

                // Send delete request to server
                const response = await fetch(`/delete-user/\${userId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Show success notification
                    if (typeof addNotification === 'function') {
                        addNotification(data.message, 'success');
                    } else {
                        alert(data.message);
                    }

                    // Redirect if needed
                    if (data.redirect) {
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 2000); // Give time to see the success message
                    }
                } else {
                    throw new Error(data.message || 'Failed to delete account');
                }
            } catch (error) {
                console.error('Error deleting account:', error);

                // Show error notification
                if (typeof addNotification === 'function') {
                    addNotification(error.message || 'Une erreur est survenue. Veuillez réessayer.', 'error');
                } else {
                    alert(error.message || 'Une erreur est survenue. Veuillez réessayer.');
                }
            } finally {
                // Hide loading overlay
                loadingOverlay.style.display = 'none';

                // Close modal
                confirmDeleteModal.style.display = 'none';
            }
        });

        // User tags management
        const tagInput = document.getElementById('tagInput');
        const addTagBtn = document.getElementById('addTagBtn');
        const userTagsList = document.getElementById('userTagsList');
        const tagsAutocomplete = document.getElementById('tagsAutocomplete');

        let tags = [];
        let autocompleteItems = [];
        let selectedAutocompleteIndex = -1;

        // Load user tags on page load
        async function loadUserTags() {
            try {
                const response = await fetch('/API/user/tags');
                const data = await response.json();

                if (data.success) {
                    tags = data.tags.map(tag => ({
                        id: tag.id_tag,
                        name: tag.tag_name
                    }));
                    renderUserTags();
                } else {
                    throw new Error(data.message || 'Failed to load tags');
                }
            } catch (error) {
                console.error('Error loading user tags:', error);
                userTagsList.innerHTML = '<div class=\"empty-tags\">Erreur lors du chargement des compétences.</div>';
            }
        }

        // Render user tags in the UI
        function renderUserTags() {
            if (tags.length === 0) {
                userTagsList.innerHTML = '<div class=\"empty-tags\">Aucune compétence ajoutée. Commencez à en ajouter !</div>';
                return;
            }

            userTagsList.innerHTML = tags.map(tag => `
                <div class=\"user-tag\" data-id=\"\${tag.id}\">
                    \${tag.name}
                    <span class=\"remove-tag\" title=\"Supprimer\" onclick=\"removeTag(\${tag.id})\">×</span>
                </div>
            `).join('');
        }

        // Add a tag to the user
        async function addTag(tagName) {
            if (!tagName.trim()) return;

            try {
                const response = await fetch('/API/user/tags/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ tagName: tagName.trim() })
                });

                const data = await response.json();

                if (data.success && data.tag) {
                    // Add to local tags array
                    tags.push(data.tag);
                    renderUserTags();

                    // Clear input
                    tagInput.value = '';

                    // Show success notification
                    if (typeof addNotification === 'function') {
                        addNotification(data.message, 'success');
                    }
                } else {
                    throw new Error(data.message || 'Failed to add tag');
                }
            } catch (error) {
                console.error('Error adding tag:', error);
                if (typeof addNotification === 'function') {
                    addNotification('Erreur lors de l\\'ajout de la compétence: ' + error.message, 'error');
                }
            }
        }

        // Remove a tag from the user
        async function removeTag(tagId) {
            try {
                const response = await fetch('/API/user/tags/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ tagId })
                });

                const data = await response.json();

                if (data.success) {
                    // Remove from local tags array
                    tags = tags.filter(tag => tag.id !== tagId);
                    renderUserTags();

                    // Show success notification
                    if (typeof addNotification === 'function') {
                        addNotification(data.message, 'success');
                    }
                } else {
                    throw new Error(data.message || 'Failed to remove tag');
                }
            } catch (error) {
                console.error('Error removing tag:', error);
                if (typeof addNotification === 'function') {
                    addNotification('Erreur lors de la suppression de la compétence: ' + error.message, 'error');
                }
            }
        }

        // Load tag autocomplete options
        async function loadTagAutocomplete(query) {
            if (!query.trim() || query.length < 2) {
                tagsAutocomplete.style.display = 'none';
                return;
            }

            try {
                const response = await fetch(`/API/tagsList?query=\${encodeURIComponent(query)}`);
                const data = await response.json();

                // Filter out tags that user already has
                const userTagIds = tags.map(tag => tag.id);
                autocompleteItems = data.filter(tag => !userTagIds.includes(tag.id));

                if (autocompleteItems.length > 0) {
                    renderAutocomplete();
                    tagsAutocomplete.style.display = 'block';
                } else {
                    tagsAutocomplete.style.display = 'none';
                }
            } catch (error) {
                console.error('Error loading tag autocomplete:', error);
                tagsAutocomplete.style.display = 'none';
            }
        }

        // Render autocomplete suggestions
        function renderAutocomplete() {
            tagsAutocomplete.innerHTML = autocompleteItems
                .map((tag, index) => `
                    <div class=\"autocomplete-item \${index === selectedAutocompleteIndex ? 'selected' : ''}\"
                        data-index=\"\${index}\"
                        onclick=\"selectAutocompleteItem(\${index})\">
                        \${tag.name}
                    </div>
                `)
                .join('');
        }

        // Select an autocomplete item
        function selectAutocompleteItem(index) {
            if (index >= 0 && index < autocompleteItems.length) {
                const selectedTag = autocompleteItems[index];
                tagInput.value = selectedTag.name;
                tagsAutocomplete.style.display = 'none';
                addTag(selectedTag.name);
            }
        }

        // Initialize tag management
        if (tagInput && addTagBtn && userTagsList) {
            // Load tags on page load
            loadUserTags();

            // Add tag button click handler
            addTagBtn.addEventListener('click', () => {
                addTag(tagInput.value);
            });

            // Input for autocomplete
            tagInput.addEventListener('input', () => {
                loadTagAutocomplete(tagInput.value);
                selectedAutocompleteIndex = -1;
            });

            // Enter key to add tag
            tagInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();

                    if (selectedAutocompleteIndex >= 0) {
                        selectAutocompleteItem(selectedAutocompleteIndex);
                    } else {
                        addTag(tagInput.value);
                    }
                }
            });

            // Keyboard navigation for autocomplete
            tagInput.addEventListener('keydown', (e) => {
                if (!tagsAutocomplete.style.display || tagsAutocomplete.style.display === 'none') {
                    return;
                }

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    selectedAutocompleteIndex = Math.min(selectedAutocompleteIndex + 1, autocompleteItems.length - 1);
                    renderAutocomplete();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    selectedAutocompleteIndex = Math.max(selectedAutocompleteIndex - 1, -1);
                    renderAutocomplete();
                } else if (e.key === 'Escape') {
                    tagsAutocomplete.style.display = 'none';
                    selectedAutocompleteIndex = -1;
                }
            });

            // Hide autocomplete on click outside
            document.addEventListener('click', (e) => {
                if (!tagInput.contains(e.target) && !tagsAutocomplete.contains(e.target)) {
                    tagsAutocomplete.style.display = 'none';
                    selectedAutocompleteIndex = -1;
                }
            });

            // Expose removeTag function globally for the onclick handlers
            window.removeTag = removeTag;
            window.selectAutocompleteItem = selectAutocompleteItem;
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
        return "user/profile.html.twig";
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
        return array (  1039 => 890,  1032 => 889,  971 => 832,  892 => 758,  886 => 757,  880 => 756,  871 => 750,  863 => 745,  854 => 739,  846 => 734,  817 => 707,  813 => 705,  809 => 703,  807 => 702,  804 => 701,  802 => 700,  799 => 699,  797 => 698,  792 => 696,  786 => 695,  778 => 689,  774 => 687,  766 => 685,  764 => 684,  752 => 674,  745 => 673,  73 => 6,  66 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Mon Profil - {{ parent() }}{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>

            /* Responsive adjustments */
        @media screen and (max-width: 1024px) {
            .profile-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .profile-sidebar {
                margin-bottom: 2rem;
            }

            .tab-navigation {
                flex-wrap: wrap;
                justify-content: center;
            }

            .tab-button {
                flex: 1 1 auto;
                text-align: center;
                padding: 0.8rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .modal-content {
                width: 90%;
                margin: 5% auto;
            }
        }

        @media screen and (max-width: 768px) {
            .profile-container {
                grid-template-columns: 1fr;
            }

            .profile-sidebar {
                margin-bottom: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }

            .modal-content {
                width: 95%;
                margin: 5% auto;
            }

            .tab-navigation {
                flex-direction: column;
                align-items: stretch;
            }

            .tab-button {
                padding: 0.5rem;
                font-size: 0.9rem;
            }

            .danger-zone-content {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media screen and (max-width: 480px) {
            .profile-info h2 {
                font-size: 1.2rem;
            }

            .profile-info p {
                font-size: 0.9rem;
            }

            .btn-save,
            .btn-danger,
            .btn-cancel,
            .btn-crop {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .tab-button {
                font-size: 0.8rem;
                padding: 0.4rem;
            }

            .danger-message h4 {
                font-size: 1rem;
            }

            .danger-message p {
                font-size: 0.8rem;
            }
        }

        /* Profile page styles */
        .profile-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
        }
        
        /* Profile sidebar */
        .profile-sidebar {
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 2rem;
        }
        
        .profile-picture-container {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            overflow: hidden;
            background-color: var(--tag-background);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .profile-picture {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-picture-placeholder {
            font-size: 5rem;
            color: var(--primary-color);
        }
        
        .upload-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 0.5rem;
            text-align: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .profile-picture-container:hover .upload-overlay {
            opacity: 1;
        }
        
        .profile-info {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .profile-info h2 {
            margin: 0 0 0.5rem 0;
            color: var(--onyx);
        }
        
        .profile-info p {
            margin: 0;
            color: var(--real-grey);
        }
        
        .profile-actions a {
            display: block;
            text-align: center;
            color: var(--primary-color);
            text-decoration: none;
            padding: 0.5rem;
            transition: background-color 0.3s ease;
            border-radius: 4px;
        }
        
        .profile-actions a:hover {
            background-color: var(--tag-background);
        }
        
        /* Main content (form sections) */
        .profile-main {
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 2rem;
        }
        
        .tab-navigation {
            display: flex;
            border-bottom: 1px solid var(--tag-background);
            margin-bottom: 2rem;
        }
        
        .tab-button {
            padding: 1rem;
            border: none;
            background: none;
            font-weight: bold;
            color: var(--real-grey);
            cursor: pointer;
            position: relative;
            transition: color 0.3s ease;
        }
        
        .tab-button:hover {
            color: var(--primary-color);
        }
        
        .tab-button.active {
            color: var(--primary-color);
        }
        
        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .form-section {
            margin-bottom: 2rem;
        }
        
        .form-section h3 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            color: var(--onyx);
            border-bottom: 1px solid var(--tag-background);
            padding-bottom: 0.5rem;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
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
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            background-color: white;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--focus-shadow);
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 2rem;
        }
        
        .btn-save {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: filter 0.3s ease;
        }
        
        .btn-save:hover {
            filter: brightness(0.9);
        }
        
        /* Picture upload modal */
        .modal {
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
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--tag-background);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h2 {
            margin: 0;
            color: var(--onyx);
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--real-grey);
            cursor: pointer;
        }
        
        .cropper-container {
            margin-bottom: 1.5rem;
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
        
        .btn-crop {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .file-input {
            display: none;
        }
        
        .file-label {
            display: block;
            text-align: center;
            padding: 1rem;
            background-color: var(--tag-background);
            color: var(--primary-color);
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }
        
        /* Loading overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        
        .spinner {
            border: 5px solid var(--background-grey);
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .profile-container {
                grid-template-columns: 1fr;
            }
            
            .profile-sidebar {
                margin-bottom: 2rem;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .modal-content {
                width: 95%;
                margin: 5% auto;
            }
            .danger-zone-content {
                display:flex;
                align-items:center;
            }
        }
        /* Danger Zone Styles */
        .danger-zone-content {
            padding: 1.5rem;
            background-color: rgba(220, 53, 69, 0.05);
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .danger-alert {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .danger-icon {
            flex-shrink: 0;
            color: var(--tertiary-color);
            margin-top: 0.25rem;
        }

        .danger-message {
            margin-top: 3px;
        }
        .danger-message h4 {
            margin: 0 0 0.5rem 0;
            color: var(--tertiary-color);
        }

        .danger-message p {
            margin: 0;
            color: var(--real-grey);
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
        }

        .btn-danger:hover {
            filter: brightness(0.9);
        }

        /* Confirmation modal */
        .confirm-modal {
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

        .confirm-modal-content {
            background-color: var(--background-nav);
            margin: 15% auto;
            padding: 1.5rem;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .confirm-modal-header {
            margin-bottom: 1.5rem;
        }

        .confirm-modal-header h3 {
            margin: 0;
            color: var(--tertiary-color);
        }

        .confirm-modal-body {
            margin-bottom: 1.5rem;
        }

        .confirm-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .btn-cancel-delete {
            background-color: var(--real-lgrey);
            border: 1px solid var(--real-grey);
            color: var(--onyx);
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-confirm-delete {
            background-color: var(--tertiary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        /* Tags management styles */
        .tags-container {
            margin-top: 1rem;
        }

        .tags-input-container {
            margin-bottom: 1.5rem;
        }

        .tags-input-wrapper {
            display: flex;
            gap: 0.5rem;
        }

        .tags-input-wrapper input {
            flex: 1;
            padding: 0.8rem;
            border: 1px solid var(--real-grey);
            border-radius: 4px;
            background-color: white;
            font-size: 1rem;
        }

        .btn-add-tag {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
        }

        .tags-autocomplete {
            position: absolute;
            width: calc(100% - 120px);
            max-height: 200px;
            overflow-y: auto;
            background-color: white;
            border: 1px solid var(--real-grey);
            border-radius: 0 0 4px 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 100;
            display: none;
        }

        .autocomplete-item {
            padding: 0.8rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .autocomplete-item:hover, .autocomplete-item.selected {
            background-color: var(--tag-background);
        }

        .user-tags-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            min-height: 50px;
        }

        .user-tag {
            display: inline-flex;
            align-items: center;
            background-color: var(--tag-background);
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-size: 0.9rem;
            gap: 0.5rem;
        }

        .user-tag .remove-tag {
            cursor: pointer;
            color: var(--real-grey);
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .user-tag .remove-tag:hover {
            background-color: var(--real-grey);
            color: white;
        }

        .loading-tags {
            color: var(--real-grey);
            font-style: italic;
        }

        .empty-tags {
            color: var(--real-grey);
            font-style: italic;
        }
    </style>
{% endblock %}

{% block content %}
<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span>Mon Profil</span>
    </nav>

    <div class=\"profile-container\">
        <!-- Profile Sidebar -->
        <div class=\"profile-sidebar\">
            <div class=\"profile-picture-container\">
                {% if user.profilePictureUrl %}
                    <img src=\"{{ user.profilePictureUrl }}\" alt=\"{{ user.userFirstName }}\" class=\"profile-picture\" id=\"profileImage\">
                {% else %}

                {% endif %}
                <div class=\"upload-overlay\" id=\"uploadOverlay\">
                    Changer la photo
                </div>
            </div>
            
            <div class=\"profile-info\">
                <h2>{{ user.userFirstName }} {{ user.userName }}</h2>
                <p>{{ user.userEmail }}</p>
                <p>Type de recherche: 
                    {% if user.userSearchType == 'none' %}
                        Non spécifié
                    {% elseif user.userSearchType == '1' %}
                        Alternance
                    {% elseif user.userSearchType == '0' %}
                        Stage
                    {% else %}
                        Non spécifié
                    {% endif %}
                </p>
            </div>
            
            <div class=\"profile-actions\">
                <a href=\"/wishlist\">Ma Wishlist</a>
                <a href=\"/interactions\">Mes Candidatures</a>
                <a href=\"/logout\">Se déconnecter</a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class=\"profile-main\">
            <div class=\"tab-navigation\">
                <button class=\"tab-button active\" data-tab=\"profile-info\">Informations Personnelles</button>
                <button class=\"tab-button\" data-tab=\"password\">Mot de Passe</button>
                <button class=\"tab-button\" data-tab=\"danger-zone\">Zone de danger</button>
            </div>
            
            <!-- Profile Info Tab -->
            <div class=\"tab-content active\" id=\"profile-info\">
                <form action=\"/update-profile\" method=\"POST\">
                    <div class=\"form-section\">
                        <h3>Informations Personnelles</h3>
                        
                        <div class=\"form-row\">
                            <div class=\"form-group\">
                                <label for=\"firstName\">Prénom</label>
                                <input type=\"text\" id=\"firstName\" name=\"firstName\" value=\"{{ formData.firstName|default(user.userFirstName) }}\" required>
                            </div>
                            
                            <div class=\"form-group\">
                                <label for=\"lastName\">Nom</label>
                                <input type=\"text\" id=\"lastName\" name=\"lastName\" value=\"{{ formData.lastName|default(user.userName) }}\" required>
                            </div>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"email\">Email</label>
                            <input type=\"email\" id=\"email\" name=\"email\" value=\"{{ formData.email|default(user.userEmail) }}\" required>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"phone\">Téléphone</label>
                            <input type=\"tel\" id=\"phone\" name=\"phone\" value=\"{{ formData.phone|default(user.userPhone) }}\" required>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"searchType\">Type de recherche</label>
                            <select id=\"searchType\" name=\"searchType\">
                                <option value=\"none\" {% if user.userSearchType == 'none' %}selected{% endif %}>Non spécifié</option>
                                <option value=\"0\" {% if user.userSearchType == '0' %}selected{% endif %}>Stage</option>
                                <option value=\"1\" {% if user.userSearchType == '1' %}selected{% endif %}>Alternance</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class=\"form-actions\">
                        <button type=\"submit\" class=\"btn-save\">Enregistrer les modifications</button>
                    </div>
                </form>

                <div class=\"form-section\">
                    <h3>Mes compétences et intérêts</h3>
                    
                    <div class=\"tags-container\">
                        <div class=\"tags-input-container\">
                            <label for=\"tagInput\">Ajouter une compétence ou un centre d'intérêt</label>
                            <div class=\"tags-input-wrapper\">
                                <input type=\"text\" id=\"tagInput\" placeholder=\"Exemple: PHP, JavaScript, UX Design...\">
                                <button type=\"button\" id=\"addTagBtn\" class=\"btn-add-tag\">Ajouter</button>
                            </div>
                            <div id=\"tagsAutocomplete\" class=\"tags-autocomplete\"></div>
                        </div>
                        
                        <div class=\"user-tags-list\" id=\"userTagsList\">
                            <div class=\"loading-tags\">Chargement des compétences...</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Password Tab -->
            <div class=\"tab-content\" id=\"password\">
                <form action=\"/change-password\" method=\"POST\">
                    <div class=\"form-section\">
                        <h3>Changer le mot de passe</h3>
                        
                        <div class=\"form-group\">
                            <label for=\"currentPassword\">Mot de passe actuel</label>
                            <input type=\"password\" id=\"currentPassword\" name=\"currentPassword\" required>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"newPassword\">Nouveau mot de passe</label>
                            <input type=\"password\" id=\"newPassword\" name=\"newPassword\" required minlength=\"8\">
                            <small>Le mot de passe doit contenir au moins 8 caractères</small>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"confirmPassword\">Confirmer le nouveau mot de passe</label>
                            <input type=\"password\" id=\"confirmPassword\" name=\"confirmPassword\" required minlength=\"8\">
                        </div>
                    </div>
                    
                    <div class=\"form-actions\">
                        <button type=\"submit\" class=\"btn-save\">Changer le mot de passe</button>
                    </div>
                </form>
            </div>

            <!-- Danger Zone Tab -->
            <div class=\"tab-content\" id=\"danger-zone\">
                <div class=\"form-section\">
                    <h3>Zone de danger</h3>
                    
                    <div class=\"danger-zone-content\">
                        <div class=\"danger-alert\">

                            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"danger-icon\" width=\"24\" height=\"24\" viewBox=\"-2 -3 24 24\"><path fill=\"currentColor\" d=\"m12.8 1.613l6.701 11.161c.963 1.603.49 3.712-1.057 4.71a3.2 3.2 0 0 1-1.743.516H3.298C1.477 18 0 16.47 0 14.581c0-.639.173-1.264.498-1.807L7.2 1.613C8.162.01 10.196-.481 11.743.517c.428.276.79.651 1.057 1.096M10 14a1 1 0 1 0 0-2a1 1 0 0 0 0 2m0-9a1 1 0 0 0-1 1v4a1 1 0 0 0 2 0V6a1 1 0 0 0-1-1\"/></svg>
                            <div class=\"danger-message\">
                                <h4>Supprimer mon compte</h4>
                                <p>La suppression de votre compte est définitive et ne peut pas être annulée. Toutes vos données personnelles, candidatures et wishlist seront supprimées.</p>
                            </div>
                        </div>
                        
                        <button type=\"button\" id=\"delete-account-btn\" class=\"btn-danger\" data-userid=\"{{ user.userId }}\">
                            Supprimer mon compte
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Picture Upload Modal -->
<div class=\"modal\" id=\"uploadModal\">
    <div class=\"modal-content\">
        <div class=\"modal-header\">
            <h2>Modifier votre photo de profil</h2>
            <button class=\"close-modal\">&times;</button>
        </div>
        <div class=\"modal-body\">
            <label for=\"profilePictureInput\" class=\"file-label\">Sélectionner une image</label>
            <input type=\"file\" id=\"profilePictureInput\" class=\"file-input\" accept=\"image/*\">
            
            <div class=\"cropper-container\">
                <img id=\"cropperImage\" style=\"display: none; max-width: 100%;\">
            </div>
            
            <div class=\"modal-actions\">
                <button class=\"btn-cancel\" id=\"cancelUpload\">Annuler</button>
                <button class=\"btn-crop\" id=\"cropImage\" disabled>Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class=\"loading-overlay\" id=\"loadingOverlay\">
    <div class=\"spinner\"></div>
    <p>Traitement en cours...</p>
</div>

<!-- Confirmation Modal for Account Deletion -->
<div class=\"confirm-modal\" id=\"confirmDeleteModal\">
    <div class=\"confirm-modal-content\">
        <div class=\"confirm-modal-header\">
            <h3>Confirmer la suppression</h3>
        </div>
        <div class=\"confirm-modal-body\">
            <p>Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
            <p>Toutes vos données personnelles, candidatures et wishlist seront supprimées définitivement.</p>
        </div>
        <div class=\"confirm-modal-actions\">
            <button class=\"btn-cancel-delete\" id=\"cancelDeleteBtn\">Annuler</button>
            <button class=\"btn-confirm-delete\" id=\"confirmDeleteBtn\">Supprimer définitivement</button>
        </div>
    </div>
</div>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js\"></script>
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css\">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                console.log('Tab button clicked');
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to clicked button
                this.classList.add('active');

                // Show corresponding content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Profile picture upload functionality
        const uploadOverlay = document.getElementById('uploadOverlay');
        const uploadModal = document.getElementById('uploadModal');
        const closeModalButton = document.querySelector('.close-modal');
        const cancelUploadButton = document.getElementById('cancelUpload');
        const profilePictureInput = document.getElementById('profilePictureInput');
        const cropperImage = document.getElementById('cropperImage');
        const cropButton = document.getElementById('cropImage');
        const loadingOverlay = document.getElementById('loadingOverlay');

        let cropper;

        // Open modal when clicking the upload overlay
        uploadOverlay.addEventListener('click', function() {
            console.log('Upload overlay clicked');
            uploadModal.style.display = 'block';
        });

        // Close modal functions
        function closeModal() {
            uploadModal.style.display = 'none';

            // Destroy cropper if it exists
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }

            // Reset file input
            profilePictureInput.value = '';
            cropperImage.style.display = 'none';
            cropButton.disabled = true;
        }

        closeModalButton.addEventListener('click', closeModal);
        cancelUploadButton.addEventListener('click', closeModal);

        // Close modal when clicking outside content
        window.addEventListener('click', function(event) {
            if (event.target === uploadModal) {
                closeModal();
            }
        });

        // Handle file selection
        profilePictureInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];

                // Check file type
                if (!file.type.match('image.*')) {
                    alert('Veuillez sélectionner une image');
                    return;
                }

                // Check file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert('L\\'image est trop volumineuse. Maximum 5 Mo.');
                    return;
                }

                // Create object URL for the file
                const URL = window.URL || window.webkitURL;
                const imageUrl = URL.createObjectURL(file);

                // Display the image and initialize cropper
                cropperImage.src = imageUrl;
                cropperImage.style.display = 'block';
                cropButton.disabled = false;

                // Destroy previous cropper if it exists
                if (cropper) {
                    cropper.destroy();
                }

                // Initialize Cropper.js with a 1:1 aspect ratio
                cropper = new Cropper(cropperImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    restore: false,
                    guides: true,
                    center: true,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false
                });
            }
        });

        // Handle crop and upload
        cropButton.addEventListener('click', async function() {
            if (!cropper) {
                return;
            }

            // Show loading overlay
            loadingOverlay.style.display = 'flex';

            try {
                // Get cropped canvas
                const canvas = cropper.getCroppedCanvas({
                    width: 300,
                    height: 300,
                    fillColor: '#fff',
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high'
                });

                if (!canvas) {
                    throw new Error('Failed to crop image');
                }

                // Get crop data for server
                const cropData = cropper.getData(true); // true = rounded values

                // Convert canvas to blob
                const blob = await new Promise(resolve => {
                    canvas.toBlob(resolve, 'image/png');
                });

                if (!blob) {
                    throw new Error('Failed to convert canvas to blob');
                }

                // Create FormData
                const formData = new FormData();
                formData.append('profilePicture', blob, 'profile.png');
                formData.append('cropX', cropData.x);
                formData.append('cropY', cropData.y);
                formData.append('cropWidth', cropData.width);
                formData.append('cropHeight', cropData.height);

                // Send to server
                const response = await fetch('/upload-profile-picture', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    // Update profile picture
                    const profileImage = document.getElementById('profileImage');
                    const profilePlaceholder = document.getElementById('profilePlaceholder');

                    if (profileImage) {
                        profileImage.src = data.url + '?t=' + new Date().getTime(); // Add timestamp to avoid caching
                    } else {
                        // Create new image if placeholder is showing
                        const newImage = document.createElement('img');
                        newImage.src = data.url + '?t=' + new Date().getTime();
                        newImage.alt = 'Profile Picture';
                        newImage.className = 'profile-picture';
                        newImage.id = 'profileImage';

                        const container = document.querySelector('.profile-picture-container');
                        container.innerHTML = '';
                        container.appendChild(newImage);
                        container.appendChild(uploadOverlay);
                    }

                    // Show success notification
                    if (typeof addNotification === 'function') {
                        addNotification(data.message, 'success');
                    } else {
                        alert(data.message);
                    }

                    // Close modal
                    closeModal();
                } else {
                    throw new Error(data.message || 'Failed to upload profile picture');
                }
            } catch (error) {
                console.error('Error uploading profile picture:', error);

                // Show error notification
                if (typeof addNotification === 'function') {
                    addNotification(error.message || 'Une erreur est survenue. Veuillez réessayer.', 'error');
                } else {
                    alert(error.message || 'Une erreur est survenue. Veuillez réessayer.');
                }
            } finally {
                // Hide loading overlay
                loadingOverlay.style.display = 'none';
            }
        });

        // Password validation
        const newPasswordInput = document.getElementById('newPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        confirmPasswordInput?.addEventListener('input', function() {
            if (newPasswordInput.value !== this.value) {
                this.setCustomValidity('Les mots de passe ne correspondent pas');
            } else {
                this.setCustomValidity('');
            }
        });

        newPasswordInput?.addEventListener('input', function() {
            if (confirmPasswordInput.value !== '' && confirmPasswordInput.value !== this.value) {
                confirmPasswordInput.setCustomValidity('Les mots de passe ne correspondent pas');
            } else {
                confirmPasswordInput.setCustomValidity('');
            }
        });

        // Delete account functionality
        const deleteAccountBtn = document.getElementById('delete-account-btn');
        const confirmDeleteModal = document.getElementById('confirmDeleteModal');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        // Open confirmation modal when delete button is clicked
        deleteAccountBtn?.addEventListener('click', function() {
            console.log('Delete button clicked');
            confirmDeleteModal.style.display = 'block';
        });

        // Close modal when cancel button is clicked
        cancelDeleteBtn?.addEventListener('click', function() {
            confirmDeleteModal.style.display = 'none';
        });

        // Close modal when clicking outside content
        window.addEventListener('click', function(event) {
            if (event.target === confirmDeleteModal) {
                confirmDeleteModal.style.display = 'none';
            }
        });

        // Handle account deletion confirmation
        confirmDeleteBtn?.addEventListener('click', async function() {
            // Show loading overlay
            loadingOverlay.style.display = 'flex';

            try {
                const userId = deleteAccountBtn.getAttribute('data-userid');

                // Send delete request to server
                const response = await fetch(`/delete-user/\${userId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Show success notification
                    if (typeof addNotification === 'function') {
                        addNotification(data.message, 'success');
                    } else {
                        alert(data.message);
                    }

                    // Redirect if needed
                    if (data.redirect) {
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 2000); // Give time to see the success message
                    }
                } else {
                    throw new Error(data.message || 'Failed to delete account');
                }
            } catch (error) {
                console.error('Error deleting account:', error);

                // Show error notification
                if (typeof addNotification === 'function') {
                    addNotification(error.message || 'Une erreur est survenue. Veuillez réessayer.', 'error');
                } else {
                    alert(error.message || 'Une erreur est survenue. Veuillez réessayer.');
                }
            } finally {
                // Hide loading overlay
                loadingOverlay.style.display = 'none';

                // Close modal
                confirmDeleteModal.style.display = 'none';
            }
        });

        // User tags management
        const tagInput = document.getElementById('tagInput');
        const addTagBtn = document.getElementById('addTagBtn');
        const userTagsList = document.getElementById('userTagsList');
        const tagsAutocomplete = document.getElementById('tagsAutocomplete');

        let tags = [];
        let autocompleteItems = [];
        let selectedAutocompleteIndex = -1;

        // Load user tags on page load
        async function loadUserTags() {
            try {
                const response = await fetch('/API/user/tags');
                const data = await response.json();

                if (data.success) {
                    tags = data.tags.map(tag => ({
                        id: tag.id_tag,
                        name: tag.tag_name
                    }));
                    renderUserTags();
                } else {
                    throw new Error(data.message || 'Failed to load tags');
                }
            } catch (error) {
                console.error('Error loading user tags:', error);
                userTagsList.innerHTML = '<div class=\"empty-tags\">Erreur lors du chargement des compétences.</div>';
            }
        }

        // Render user tags in the UI
        function renderUserTags() {
            if (tags.length === 0) {
                userTagsList.innerHTML = '<div class=\"empty-tags\">Aucune compétence ajoutée. Commencez à en ajouter !</div>';
                return;
            }

            userTagsList.innerHTML = tags.map(tag => `
                <div class=\"user-tag\" data-id=\"\${tag.id}\">
                    \${tag.name}
                    <span class=\"remove-tag\" title=\"Supprimer\" onclick=\"removeTag(\${tag.id})\">×</span>
                </div>
            `).join('');
        }

        // Add a tag to the user
        async function addTag(tagName) {
            if (!tagName.trim()) return;

            try {
                const response = await fetch('/API/user/tags/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ tagName: tagName.trim() })
                });

                const data = await response.json();

                if (data.success && data.tag) {
                    // Add to local tags array
                    tags.push(data.tag);
                    renderUserTags();

                    // Clear input
                    tagInput.value = '';

                    // Show success notification
                    if (typeof addNotification === 'function') {
                        addNotification(data.message, 'success');
                    }
                } else {
                    throw new Error(data.message || 'Failed to add tag');
                }
            } catch (error) {
                console.error('Error adding tag:', error);
                if (typeof addNotification === 'function') {
                    addNotification('Erreur lors de l\\'ajout de la compétence: ' + error.message, 'error');
                }
            }
        }

        // Remove a tag from the user
        async function removeTag(tagId) {
            try {
                const response = await fetch('/API/user/tags/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ tagId })
                });

                const data = await response.json();

                if (data.success) {
                    // Remove from local tags array
                    tags = tags.filter(tag => tag.id !== tagId);
                    renderUserTags();

                    // Show success notification
                    if (typeof addNotification === 'function') {
                        addNotification(data.message, 'success');
                    }
                } else {
                    throw new Error(data.message || 'Failed to remove tag');
                }
            } catch (error) {
                console.error('Error removing tag:', error);
                if (typeof addNotification === 'function') {
                    addNotification('Erreur lors de la suppression de la compétence: ' + error.message, 'error');
                }
            }
        }

        // Load tag autocomplete options
        async function loadTagAutocomplete(query) {
            if (!query.trim() || query.length < 2) {
                tagsAutocomplete.style.display = 'none';
                return;
            }

            try {
                const response = await fetch(`/API/tagsList?query=\${encodeURIComponent(query)}`);
                const data = await response.json();

                // Filter out tags that user already has
                const userTagIds = tags.map(tag => tag.id);
                autocompleteItems = data.filter(tag => !userTagIds.includes(tag.id));

                if (autocompleteItems.length > 0) {
                    renderAutocomplete();
                    tagsAutocomplete.style.display = 'block';
                } else {
                    tagsAutocomplete.style.display = 'none';
                }
            } catch (error) {
                console.error('Error loading tag autocomplete:', error);
                tagsAutocomplete.style.display = 'none';
            }
        }

        // Render autocomplete suggestions
        function renderAutocomplete() {
            tagsAutocomplete.innerHTML = autocompleteItems
                .map((tag, index) => `
                    <div class=\"autocomplete-item \${index === selectedAutocompleteIndex ? 'selected' : ''}\"
                        data-index=\"\${index}\"
                        onclick=\"selectAutocompleteItem(\${index})\">
                        \${tag.name}
                    </div>
                `)
                .join('');
        }

        // Select an autocomplete item
        function selectAutocompleteItem(index) {
            if (index >= 0 && index < autocompleteItems.length) {
                const selectedTag = autocompleteItems[index];
                tagInput.value = selectedTag.name;
                tagsAutocomplete.style.display = 'none';
                addTag(selectedTag.name);
            }
        }

        // Initialize tag management
        if (tagInput && addTagBtn && userTagsList) {
            // Load tags on page load
            loadUserTags();

            // Add tag button click handler
            addTagBtn.addEventListener('click', () => {
                addTag(tagInput.value);
            });

            // Input for autocomplete
            tagInput.addEventListener('input', () => {
                loadTagAutocomplete(tagInput.value);
                selectedAutocompleteIndex = -1;
            });

            // Enter key to add tag
            tagInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();

                    if (selectedAutocompleteIndex >= 0) {
                        selectAutocompleteItem(selectedAutocompleteIndex);
                    } else {
                        addTag(tagInput.value);
                    }
                }
            });

            // Keyboard navigation for autocomplete
            tagInput.addEventListener('keydown', (e) => {
                if (!tagsAutocomplete.style.display || tagsAutocomplete.style.display === 'none') {
                    return;
                }

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    selectedAutocompleteIndex = Math.min(selectedAutocompleteIndex + 1, autocompleteItems.length - 1);
                    renderAutocomplete();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    selectedAutocompleteIndex = Math.max(selectedAutocompleteIndex - 1, -1);
                    renderAutocomplete();
                } else if (e.key === 'Escape') {
                    tagsAutocomplete.style.display = 'none';
                    selectedAutocompleteIndex = -1;
                }
            });

            // Hide autocomplete on click outside
            document.addEventListener('click', (e) => {
                if (!tagInput.contains(e.target) && !tagsAutocomplete.contains(e.target)) {
                    tagsAutocomplete.style.display = 'none';
                    selectedAutocompleteIndex = -1;
                }
            });

            // Expose removeTag function globally for the onclick handlers
            window.removeTag = removeTag;
            window.selectAutocompleteItem = selectAutocompleteItem;
        }
    });
</script>

{% endblock %}", "user/profile.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\user\\profile.html.twig");
    }
}
