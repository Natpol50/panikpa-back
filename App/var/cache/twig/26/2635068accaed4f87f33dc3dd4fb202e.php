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

/* offers/edit.html.twig */
class __TwigTemplate_43418fcbb6f99f9de01ae7fb9946bc9a extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "offers/edit.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Modifier l'offre - ";
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_enterprise", [], "any", false, false, false, 10), "html", null, true);
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_offer", [], "any", false, false, false, 10), "html", null, true);
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_title", [], "any", false, false, false, 10), "html", null, true);
        yield "</a></span>
        <span>Modification</span>
    </nav>

    <div class=\"create-offer-container\">
        <header class=\"create-offer-header\">
            <h1>Modifier l'offre : ";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_title", [], "any", false, false, false, 16), "html", null, true);
        yield "</h1>
            <p>Modifiez le formulaire ci-dessous pour mettre à jour cette offre.</p>
        </header>

        ";
        // line 20
        if ((array_key_exists("error", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["error"] ?? null)) > 0))) {
            // line 21
            yield "        <div class=\"error-message\">
            <ul>
                ";
            // line 23
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["error"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 24
                yield "                    <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            yield "            </ul>
        </div>
        ";
        }
        // line 29
        yield "
        <form id=\"edit-offer-form\" action=\"/offres/update\" method=\"POST\" class=\"create-offer-form\">
            <input type=\"hidden\" name=\"offerId\" value=\"";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_offer", [], "any", false, false, false, 31), "html", null, true);
        yield "\">
            
            <div class=\"form-section\">
                <h2>Informations générales</h2>
                
                <div class=\"form-group\">
                    <label for=\"title\">Titre de l'offre <span class=\"required\">*</span></label>
                    <input type=\"text\" id=\"title\" name=\"title\" value=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "title", [], "any", true, true, false, 38)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "title", [], "any", false, false, false, 38), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_title", [], "any", false, false, false, 38))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_title", [], "any", false, false, false, 38))), "html", null, true);
        yield "\" required maxlength=\"100\">
                </div>
                
                <div class=\"form-group\">
                    <label for=\"enterpriseId\">Entreprise <span class=\"required\">*</span></label>
                    <select id=\"enterpriseId\" name=\"enterpriseId\" required>
                        <option value=\"\">Sélectionnez une entreprise</option>
                        <!-- This will be populated with AJAX -->
                    </select>
                </div>
                
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"level\">Niveau d'études requis <span class=\"required\">*</span></label>
                        <select id=\"level\" name=\"level\" required>
                            <option value=\"\" disabled ";
        // line 53
        if (( !CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 53) &&  !CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", true, true, false, 53))) {
            yield "selected";
        }
        yield ">Sélectionnez un niveau</option>
                            <option value=\"Bac\" ";
        // line 54
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 54) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 54) == "Bac")) || (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 54) == "Bac"))) {
            yield "selected";
        }
        yield ">Bac</option>
                            <option value=\"Bac+2\" ";
        // line 55
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 55) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 55) == "Bac+2")) || (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 55) == "Bac+2"))) {
            yield "selected";
        }
        yield ">Bac+2</option>
                            <option value=\"Bac+3\" ";
        // line 56
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 56) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 56) == "Bac+3")) || (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 56) == "Bac+3"))) {
            yield "selected";
        }
        yield ">Bac+3</option>
                            <option value=\"Bac+4\" ";
        // line 57
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 57) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 57) == "Bac+4")) || (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 57) == "Bac+4"))) {
            yield "selected";
        }
        yield ">Bac+4</option>
                            <option value=\"Bac+5\" ";
        // line 58
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 58) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 58) == "Bac+5")) || (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 58) == "Bac+5"))) {
            yield "selected";
        }
        yield ">Bac+5</option>
                            <option value=\"Bac+3, Bac+5\" ";
        // line 59
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 59) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 59) == "Bac+3, Bac+5")) || (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 59) == "Bac+3, Bac+5"))) {
            yield "selected";
        }
        yield ">Bac+3, Bac+5</option>
                        </select>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"duration\">Durée <span class=\"required\">*</span></label>
                        <input type=\"text\" id=\"duration\" name=\"duration\" value=\"";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", true, true, false, 65)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", false, false, false, 65), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 65))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 65))), "html", null, true);
        yield "\" required placeholder=\"Ex: 3 mois, 6 mois, 1 an\">
                    </div>
                </div>
                
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"startDate\">Date de début <span class=\"required\">*</span></label>
                        <input type=\"date\" id=\"startDate\" name=\"startDate\" value=\"";
        // line 72
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "startDate", [], "any", true, true, false, 72)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "startDate", [], "any", false, false, false, 72), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_start", [], "any", false, false, false, 72))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_start", [], "any", false, false, false, 72))), "html", null, true);
        yield "\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"remuneration\">Rémunération</label>
                        <select id=\"remuneration\" name=\"remuneration\">
                            <option value=\"\" disabled ";
        // line 78
        if (( !CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remuneration", [], "any", true, true, false, 78) &&  !CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_remuneration", [], "any", true, true, false, 78))) {
            yield "selected";
        }
        yield ">L'offre est-elle rémunérée ?</option>
                            <option value=\"0\" ";
        // line 79
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remuneration", [], "any", true, true, false, 79) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remuneration", [], "any", false, false, false, 79) == "0")) || (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_remuneration", [], "any", false, false, false, 79) == "0"))) {
            yield "selected";
        }
        yield ">Non rémunéré</option>
                            <option value=\"1\" ";
        // line 80
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remuneration", [], "any", true, true, false, 80) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remuneration", [], "any", false, false, false, 80) == "1")) || (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_remuneration", [], "any", false, false, false, 80) > "0"))) {
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
                        <label for=\"cityId\">Ville <span class=\"required\">*</span></label>
                        <select id=\"cityId\" name=\"cityId\" required>
                            <option value=\"\">Sélectionnez une ville</option>
                            <!-- This will be populated with AJAX -->
                        </select>
                    </div>
                </div>
            </div>
            
            <div class=\"form-section\">
                <h2>Compétences</h2>
                
                <div id=\"tags-container\">
                    ";
        // line 104
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["tags"] ?? null)) > 0)) {
            // line 105
            yield "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["tags"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 106
                yield "                            <div class=\"tag-input-group\">
                                <div class=\"form-row\">
                                    <div class=\"form-group tag-input\">
                                        <label for=\"tags[";
                // line 109
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 109), "html", null, true);
                yield "]\">Compétence</label>
                                        <input type=\"text\" id=\"tags[";
                // line 110
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 110), "html", null, true);
                yield "]\" name=\"tags[]\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "tag_name", [], "any", false, false, false, 110), "html", null, true);
                yield "\" placeholder=\"Ex: PHP, JavaScript, Réseau...\">
                                    </div>
                                    
                                    <div class=\"form-group optional-checkbox\">
                                        <div class=\"checkbox-container\">
                                            <input type=\"checkbox\" id=\"optional_tags[";
                // line 115
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 115), "html", null, true);
                yield "]\" name=\"optional_tags[";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 115), "html", null, true);
                yield "]\" value=\"1\" ";
                if (CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "optional", [], "any", false, false, false, 115)) {
                    yield "checked";
                }
                yield ">
                                            <span class=\"checkbox-label\">Optionnelle</span>
                                            <button type=\"button\" class=\"remove-tag\">×</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 123
            yield "                    ";
        } else {
            // line 124
            yield "                        <div class=\"tag-input-group\">
                            <div class=\"form-row\">
                                <div class=\"form-group tag-input\">
                                    <label for=\"tags[0]\">Compétence</label>
                                    <input type=\"text\" id=\"tags[0]\" name=\"tags[]\" placeholder=\"Ex: PHP, JavaScript, Réseau...\">
                                </div>
                                
                                <div class=\"form-group optional-checkbox\">
                                    <div class=\"checkbox-container\">
                                        <input type=\"checkbox\" id=\"optional_tags[0]\" name=\"optional_tags[0]\" value=\"1\">
                                        <span class=\"checkbox-label\">Optionnelle</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
        }
        // line 140
        yield "                </div>
                
                <button type=\"button\" id=\"add-tag\" class=\"btn-secondary\">Ajouter une compétence</button>
            </div>
            
            <div class=\"form-section\">
                <h2>Description</h2>
                
                <div class=\"form-group\">
                    <label for=\"content\">Description détaillée de l'offre <span class=\"required\">*</span></label>
                    <textarea id=\"content\" name=\"content\" rows=\"10\" required>";
        // line 150
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "content", [], "any", true, true, false, 150)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "content", [], "any", false, false, false, 150), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_content", [], "any", false, false, false, 150))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_content", [], "any", false, false, false, 150))), "html", null, true);
        yield "</textarea>
                    <p class=\"form-hint\">Décrivez les missions, les responsabilités, le contexte et les objectifs du stage/alternance.</p>
                </div>
            </div>
            
            <div class=\"form-actions\">
                <a href=\"/offres/";
        // line 156
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_enterprise", [], "any", false, false, false, 156), "html", null, true);
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_offer", [], "any", false, false, false, 156), "html", null, true);
        yield "\" class=\"btn-secondary\">Annuler</a>
                <button type=\"submit\" class=\"btn-primary\">Enregistrer les modifications</button>
            </div>
        </form>

        <div class=\"danger-zone\">
            <h3>Zone de danger</h3>
            <div class=\"danger-content\">
                <p>La suppression de cette offre est irréversible et supprimera toutes les candidatures associées.</p>
                <button id=\"delete-offer-btn\" class=\"btn-danger\" data-offer-id=\"";
        // line 165
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_offer", [], "any", false, false, false, 165), "html", null, true);
        yield "\">
                    Supprimer l'offre
                </button>
            </div>
        </div>
    </div>
</div>
";
        yield from [];
    }

    // line 174
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 175
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
    
    /* Danger Zone */
    .danger-zone {
        margin-top: 3rem;
        padding: 1.5rem;
        background-color: rgba(220, 53, 69, 0.05);
        border-radius: 8px;
        border: 1px solid rgba(220, 53, 69, 0.2);
    }

    .danger-zone h3 {
        color: var(--tertiary-color);
        margin-top: 0;
        margin-bottom: 1rem;
        font-size: 1.2rem;
    }

    .danger-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .danger-content p {
        margin: 0;
        color: var(--real-grey);
    }

    .btn-danger {
        background-color: var(--tertiary-color);
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
    }

    /* Remove tag button */
    .remove-tag {
        margin-left: auto;
        background: none;
        border: none;
        color: var(--tertiary-color);
        cursor: pointer;
        font-size: 1.2rem;
        padding: 0 0.5rem;
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
        
        .danger-content {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .btn-danger {
            width: 100%;
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

    // line 482
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 483
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Get DOM elements
        const addTagButton = document.getElementById('add-tag');
        const tagsContainer = document.getElementById('tags-container');
        const enterpriseSelect = document.getElementById('enterpriseId');
        const citySelect = document.getElementById('cityId');
        const deleteOfferBtn = document.getElementById('delete-offer-btn');

        // Set current enterprise and city
        const currentEnterpriseId = '";
        // line 494
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_enterprise", [], "any", false, false, false, 494), "html", null, true);
        yield "';
        const currentCityId = '";
        // line 495
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_city", [], "any", false, false, false, 495), "html", null, true);
        yield "';
        
        // Store available tags for autocomplete
        let availableTags = [];
        
        // Store available cities for autocomplete
        let availableCities = [];
        
        // Track tag count for adding new tags
        let tagCount = document.querySelectorAll('.tag-input-group').length;

        // Function to add a new tag input
        function addTagInput() {
            const tagInputGroup = document.createElement('div');
            tagInputGroup.className = 'tag-input-group';
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
            initTagAutocomplete(newInput);
            
            // Increment tag count
            tagCount++;
        }
        
        // Add event listener to the \"Add Tag\" button
        addTagButton.addEventListener('click', addTagInput);
        
        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-tag').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.tag-input-group').remove();
            });
        });
        
        // Fetch tags for autocomplete
        const fetchTags = async (query) => {
            try {
                const response = await fetch(`/API/tagsList?query=\${encodeURIComponent(query)}`);
                const tagsData = await response.json();
                availableTags = tagsData.map(tag => tag.name);
                
                // Initialize autocomplete on existing tag inputs
                document.querySelectorAll('[id^=\"tags[\"]').forEach(input => {
                    initTagAutocomplete(input);
                });
            } catch (error) {
                console.error('Error fetching tags for autocomplete:', error);
            }
        };
        
        // Function to initialize tag autocomplete
        function initTagAutocomplete(inputElement) {
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
        
        // Fetch enterprises for the select dropdown
        async function fetchEnterprises() {
            try {
                const response = await fetch('/API/enterpriseList');
                const enterprises = await response.json();
                
                // Clear the select options
                enterpriseSelect.innerHTML = '<option value=\"\">Sélectionnez une entreprise</option>';
                
                // Add the enterprises to the select
                enterprises.forEach(enterprise => {
                    const option = document.createElement('option');
                    option.value = enterprise.enterprise_id;
                    option.textContent = enterprise.enterprise_name;
                    option.selected = enterprise.enterprise_id === currentEnterpriseId;
                    enterpriseSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching enterprises:', error);
            }
        }
        
        // Fetch cities for the select dropdown
        async function fetchCities() {
            try {
                const response = await fetch('/API/citiesList');
                const cities = await response.json();
                availableCities = cities;
                
                // Clear the select options
                citySelect.innerHTML = '<option value=\"\">Sélectionnez une ville</option>';
                
                // Add the cities to the select
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id_city;
                    option.textContent = `\${city.city_name} - \${city.city_postal}`;
                    option.selected = city.id_city == currentCityId;
                    citySelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching cities:', error);
            }
        }
        
        // Initialize
        fetchTags('');
        fetchEnterprises();
        fetchCities();
        
        // Handle offer deletion
        if (deleteOfferBtn) {
            deleteOfferBtn.addEventListener('click', async () => {
                const offerId = deleteOfferBtn.getAttribute('data-offer-id');
                
                // Confirm deletion
                const confirmDelete = confirm('Êtes-vous sûr de vouloir supprimer cette offre ? Cette action est irréversible.');
                
                if (confirmDelete) {
                    try {
                        const response = await fetch(`/api/delete-offer?offerid=\${offerId}`, {
                            method: 'GET',
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
                                alert(data.message || 'Offre supprimée avec succès');
                            }
                            
                            // Redirect to offer page
                            setTimeout(() => {
                                window.location.href = '/offres/";
        // line 680
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_enterprise", [], "any", false, false, false, 680), "html", null, true);
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_offer", [], "any", false, false, false, 680), "html", null, true);
        yield "';
                            }, 1500);
                        } else {
                            // Show error notification
                            if (typeof addNotification === 'function') {
                                addNotification(data.message || 'Une erreur est survenue lors de la suppression', 'error');
                            } else {
                                alert(data.message || 'Une erreur est survenue lors de la suppression');
                            }
                        }
                    } catch (error) {
                        console.error('Error deleting offer:', error);
                        
                        // Show error notification
                        if (typeof addNotification === 'function') {
                            addNotification('Une erreur est survenue lors de la suppression de l\\'offre', 'error');
                        } else {
                            alert('Une erreur est survenue lors de la suppression de l\\'offre');
                        }
                    }
                }
            });
        }
        
        // Form validation
        const form = document.getElementById('edit-offer-form');
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validate required fields
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('invalid');
                } else {
                    field.classList.remove('invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                
                // Show error notification
                if (typeof addNotification === 'function') {
                    addNotification('Veuillez remplir tous les champs obligatoires', 'error');
                } else {
                    alert('Veuillez remplir tous les champs obligatoires');
                }
                
                // Scroll to the first invalid field
                const firstInvalid = form.querySelector('.invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
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
        return "offers/edit.html.twig";
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
        return array (  927 => 680,  739 => 495,  735 => 494,  721 => 483,  714 => 482,  403 => 175,  396 => 174,  383 => 165,  370 => 156,  361 => 150,  349 => 140,  331 => 124,  328 => 123,  300 => 115,  290 => 110,  286 => 109,  281 => 106,  263 => 105,  261 => 104,  232 => 80,  226 => 79,  220 => 78,  211 => 72,  201 => 65,  190 => 59,  184 => 58,  178 => 57,  172 => 56,  166 => 55,  160 => 54,  154 => 53,  136 => 38,  126 => 31,  122 => 29,  117 => 26,  108 => 24,  104 => 23,  100 => 21,  98 => 20,  91 => 16,  79 => 10,  73 => 6,  66 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Modifier l'offre - {{ parent() }}{% endblock %}

{% block content %}
<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span><a href=\"/offres\">Offres</a></span>
        <span><a href=\"/offres/{{ offer.id_enterprise }}{{ offer.id_offer }}\">{{ offer.offer_title }}</a></span>
        <span>Modification</span>
    </nav>

    <div class=\"create-offer-container\">
        <header class=\"create-offer-header\">
            <h1>Modifier l'offre : {{ offer.offer_title }}</h1>
            <p>Modifiez le formulaire ci-dessous pour mettre à jour cette offre.</p>
        </header>

        {% if error is defined and error|length > 0 %}
        <div class=\"error-message\">
            <ul>
                {% for message in error %}
                    <li>{{ message }}</li>
                {% endfor %}
            </ul>
        </div>
        {% endif %}

        <form id=\"edit-offer-form\" action=\"/offres/update\" method=\"POST\" class=\"create-offer-form\">
            <input type=\"hidden\" name=\"offerId\" value=\"{{ offer.id_offer }}\">
            
            <div class=\"form-section\">
                <h2>Informations générales</h2>
                
                <div class=\"form-group\">
                    <label for=\"title\">Titre de l'offre <span class=\"required\">*</span></label>
                    <input type=\"text\" id=\"title\" name=\"title\" value=\"{{ formData.title|default(offer.offer_title) }}\" required maxlength=\"100\">
                </div>
                
                <div class=\"form-group\">
                    <label for=\"enterpriseId\">Entreprise <span class=\"required\">*</span></label>
                    <select id=\"enterpriseId\" name=\"enterpriseId\" required>
                        <option value=\"\">Sélectionnez une entreprise</option>
                        <!-- This will be populated with AJAX -->
                    </select>
                </div>
                
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"level\">Niveau d'études requis <span class=\"required\">*</span></label>
                        <select id=\"level\" name=\"level\" required>
                            <option value=\"\" disabled {% if not formData.level is defined and not offer.offer_level is defined %}selected{% endif %}>Sélectionnez un niveau</option>
                            <option value=\"Bac\" {% if formData.level is defined and formData.level == 'Bac' or offer.offer_level == 'Bac' %}selected{% endif %}>Bac</option>
                            <option value=\"Bac+2\" {% if formData.level is defined and formData.level == 'Bac+2' or offer.offer_level == 'Bac+2' %}selected{% endif %}>Bac+2</option>
                            <option value=\"Bac+3\" {% if formData.level is defined and formData.level == 'Bac+3' or offer.offer_level == 'Bac+3' %}selected{% endif %}>Bac+3</option>
                            <option value=\"Bac+4\" {% if formData.level is defined and formData.level == 'Bac+4' or offer.offer_level == 'Bac+4' %}selected{% endif %}>Bac+4</option>
                            <option value=\"Bac+5\" {% if formData.level is defined and formData.level == 'Bac+5' or offer.offer_level == 'Bac+5' %}selected{% endif %}>Bac+5</option>
                            <option value=\"Bac+3, Bac+5\" {% if formData.level is defined and formData.level == 'Bac+3, Bac+5' or offer.offer_level == 'Bac+3, Bac+5' %}selected{% endif %}>Bac+3, Bac+5</option>
                        </select>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"duration\">Durée <span class=\"required\">*</span></label>
                        <input type=\"text\" id=\"duration\" name=\"duration\" value=\"{{ formData.duration|default(offer.offer_duration) }}\" required placeholder=\"Ex: 3 mois, 6 mois, 1 an\">
                    </div>
                </div>
                
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"startDate\">Date de début <span class=\"required\">*</span></label>
                        <input type=\"date\" id=\"startDate\" name=\"startDate\" value=\"{{ formData.startDate|default(offer.offer_start) }}\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label for=\"remuneration\">Rémunération</label>
                        <select id=\"remuneration\" name=\"remuneration\">
                            <option value=\"\" disabled {% if not formData.remuneration is defined and not offer.offer_remuneration is defined %}selected{% endif %}>L'offre est-elle rémunérée ?</option>
                            <option value=\"0\" {% if formData.remuneration is defined and formData.remuneration == '0' or offer.offer_remuneration == '0' %}selected{% endif %}>Non rémunéré</option>
                            <option value=\"1\" {% if formData.remuneration is defined and formData.remuneration == '1' or offer.offer_remuneration > '0' %}selected{% endif %}>Rémunéré</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class=\"form-section\">
                <h2>Localisation</h2>
                
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <label for=\"cityId\">Ville <span class=\"required\">*</span></label>
                        <select id=\"cityId\" name=\"cityId\" required>
                            <option value=\"\">Sélectionnez une ville</option>
                            <!-- This will be populated with AJAX -->
                        </select>
                    </div>
                </div>
            </div>
            
            <div class=\"form-section\">
                <h2>Compétences</h2>
                
                <div id=\"tags-container\">
                    {% if tags|length > 0 %}
                        {% for tag in tags %}
                            <div class=\"tag-input-group\">
                                <div class=\"form-row\">
                                    <div class=\"form-group tag-input\">
                                        <label for=\"tags[{{ loop.index0 }}]\">Compétence</label>
                                        <input type=\"text\" id=\"tags[{{ loop.index0 }}]\" name=\"tags[]\" value=\"{{ tag.tag_name }}\" placeholder=\"Ex: PHP, JavaScript, Réseau...\">
                                    </div>
                                    
                                    <div class=\"form-group optional-checkbox\">
                                        <div class=\"checkbox-container\">
                                            <input type=\"checkbox\" id=\"optional_tags[{{ loop.index0 }}]\" name=\"optional_tags[{{ loop.index0 }}]\" value=\"1\" {% if tag.optional %}checked{% endif %}>
                                            <span class=\"checkbox-label\">Optionnelle</span>
                                            <button type=\"button\" class=\"remove-tag\">×</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {% endfor %}
                    {% else %}
                        <div class=\"tag-input-group\">
                            <div class=\"form-row\">
                                <div class=\"form-group tag-input\">
                                    <label for=\"tags[0]\">Compétence</label>
                                    <input type=\"text\" id=\"tags[0]\" name=\"tags[]\" placeholder=\"Ex: PHP, JavaScript, Réseau...\">
                                </div>
                                
                                <div class=\"form-group optional-checkbox\">
                                    <div class=\"checkbox-container\">
                                        <input type=\"checkbox\" id=\"optional_tags[0]\" name=\"optional_tags[0]\" value=\"1\">
                                        <span class=\"checkbox-label\">Optionnelle</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {% endif %}
                </div>
                
                <button type=\"button\" id=\"add-tag\" class=\"btn-secondary\">Ajouter une compétence</button>
            </div>
            
            <div class=\"form-section\">
                <h2>Description</h2>
                
                <div class=\"form-group\">
                    <label for=\"content\">Description détaillée de l'offre <span class=\"required\">*</span></label>
                    <textarea id=\"content\" name=\"content\" rows=\"10\" required>{{ formData.content|default(offer.offer_content) }}</textarea>
                    <p class=\"form-hint\">Décrivez les missions, les responsabilités, le contexte et les objectifs du stage/alternance.</p>
                </div>
            </div>
            
            <div class=\"form-actions\">
                <a href=\"/offres/{{ offer.id_enterprise }}{{ offer.id_offer }}\" class=\"btn-secondary\">Annuler</a>
                <button type=\"submit\" class=\"btn-primary\">Enregistrer les modifications</button>
            </div>
        </form>

        <div class=\"danger-zone\">
            <h3>Zone de danger</h3>
            <div class=\"danger-content\">
                <p>La suppression de cette offre est irréversible et supprimera toutes les candidatures associées.</p>
                <button id=\"delete-offer-btn\" class=\"btn-danger\" data-offer-id=\"{{ offer.id_offer }}\">
                    Supprimer l'offre
                </button>
            </div>
        </div>
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
    
    /* Danger Zone */
    .danger-zone {
        margin-top: 3rem;
        padding: 1.5rem;
        background-color: rgba(220, 53, 69, 0.05);
        border-radius: 8px;
        border: 1px solid rgba(220, 53, 69, 0.2);
    }

    .danger-zone h3 {
        color: var(--tertiary-color);
        margin-top: 0;
        margin-bottom: 1rem;
        font-size: 1.2rem;
    }

    .danger-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .danger-content p {
        margin: 0;
        color: var(--real-grey);
    }

    .btn-danger {
        background-color: var(--tertiary-color);
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
    }

    /* Remove tag button */
    .remove-tag {
        margin-left: auto;
        background: none;
        border: none;
        color: var(--tertiary-color);
        cursor: pointer;
        font-size: 1.2rem;
        padding: 0 0.5rem;
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
        
        .danger-content {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .btn-danger {
            width: 100%;
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
        const enterpriseSelect = document.getElementById('enterpriseId');
        const citySelect = document.getElementById('cityId');
        const deleteOfferBtn = document.getElementById('delete-offer-btn');

        // Set current enterprise and city
        const currentEnterpriseId = '{{ offer.id_enterprise }}';
        const currentCityId = '{{ offer.id_city }}';
        
        // Store available tags for autocomplete
        let availableTags = [];
        
        // Store available cities for autocomplete
        let availableCities = [];
        
        // Track tag count for adding new tags
        let tagCount = document.querySelectorAll('.tag-input-group').length;

        // Function to add a new tag input
        function addTagInput() {
            const tagInputGroup = document.createElement('div');
            tagInputGroup.className = 'tag-input-group';
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
            initTagAutocomplete(newInput);
            
            // Increment tag count
            tagCount++;
        }
        
        // Add event listener to the \"Add Tag\" button
        addTagButton.addEventListener('click', addTagInput);
        
        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-tag').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.tag-input-group').remove();
            });
        });
        
        // Fetch tags for autocomplete
        const fetchTags = async (query) => {
            try {
                const response = await fetch(`/API/tagsList?query=\${encodeURIComponent(query)}`);
                const tagsData = await response.json();
                availableTags = tagsData.map(tag => tag.name);
                
                // Initialize autocomplete on existing tag inputs
                document.querySelectorAll('[id^=\"tags[\"]').forEach(input => {
                    initTagAutocomplete(input);
                });
            } catch (error) {
                console.error('Error fetching tags for autocomplete:', error);
            }
        };
        
        // Function to initialize tag autocomplete
        function initTagAutocomplete(inputElement) {
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
        
        // Fetch enterprises for the select dropdown
        async function fetchEnterprises() {
            try {
                const response = await fetch('/API/enterpriseList');
                const enterprises = await response.json();
                
                // Clear the select options
                enterpriseSelect.innerHTML = '<option value=\"\">Sélectionnez une entreprise</option>';
                
                // Add the enterprises to the select
                enterprises.forEach(enterprise => {
                    const option = document.createElement('option');
                    option.value = enterprise.enterprise_id;
                    option.textContent = enterprise.enterprise_name;
                    option.selected = enterprise.enterprise_id === currentEnterpriseId;
                    enterpriseSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching enterprises:', error);
            }
        }
        
        // Fetch cities for the select dropdown
        async function fetchCities() {
            try {
                const response = await fetch('/API/citiesList');
                const cities = await response.json();
                availableCities = cities;
                
                // Clear the select options
                citySelect.innerHTML = '<option value=\"\">Sélectionnez une ville</option>';
                
                // Add the cities to the select
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id_city;
                    option.textContent = `\${city.city_name} - \${city.city_postal}`;
                    option.selected = city.id_city == currentCityId;
                    citySelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching cities:', error);
            }
        }
        
        // Initialize
        fetchTags('');
        fetchEnterprises();
        fetchCities();
        
        // Handle offer deletion
        if (deleteOfferBtn) {
            deleteOfferBtn.addEventListener('click', async () => {
                const offerId = deleteOfferBtn.getAttribute('data-offer-id');
                
                // Confirm deletion
                const confirmDelete = confirm('Êtes-vous sûr de vouloir supprimer cette offre ? Cette action est irréversible.');
                
                if (confirmDelete) {
                    try {
                        const response = await fetch(`/api/delete-offer?offerid=\${offerId}`, {
                            method: 'GET',
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
                                alert(data.message || 'Offre supprimée avec succès');
                            }
                            
                            // Redirect to offer page
                            setTimeout(() => {
                                window.location.href = '/offres/{{ offer.id_enterprise }}{{ offer.id_offer }}';
                            }, 1500);
                        } else {
                            // Show error notification
                            if (typeof addNotification === 'function') {
                                addNotification(data.message || 'Une erreur est survenue lors de la suppression', 'error');
                            } else {
                                alert(data.message || 'Une erreur est survenue lors de la suppression');
                            }
                        }
                    } catch (error) {
                        console.error('Error deleting offer:', error);
                        
                        // Show error notification
                        if (typeof addNotification === 'function') {
                            addNotification('Une erreur est survenue lors de la suppression de l\\'offre', 'error');
                        } else {
                            alert('Une erreur est survenue lors de la suppression de l\\'offre');
                        }
                    }
                }
            });
        }
        
        // Form validation
        const form = document.getElementById('edit-offer-form');
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validate required fields
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('invalid');
                } else {
                    field.classList.remove('invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                
                // Show error notification
                if (typeof addNotification === 'function') {
                    addNotification('Veuillez remplir tous les champs obligatoires', 'error');
                } else {
                    alert('Veuillez remplir tous les champs obligatoires');
                }
                
                // Scroll to the first invalid field
                const firstInvalid = form.querySelector('.invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    });
</script>
{% endblock %}", "offers/edit.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\offers\\edit.html.twig");
    }
}
