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
        $this->parent = $this->loadTemplate("base.html.twig", "offers/edit.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
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
    <span><a href=\"/offres\">Offres</a></span>
    <span><a href=\"/offres/";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_offer", [], "any", false, false, false, 7), "html", null, true);
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_title", [], "any", false, false, false, 7), "html", null, true);
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
    <div class=\"offer-edit-container\">
        <h1>Modifier l'offre : ";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_title", [], "any", false, false, false, 14), "html", null, true);
        yield "</h1>
        ";
        // line 15
        if ((array_key_exists("error", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["error"] ?? null)) > 0))) {
            // line 16
            yield "        <div class=\"error-container\">
            <ul>
                ";
            // line 18
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["error"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 19
                yield "                    <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            yield "            </ul>
        </div>
    ";
        }
        // line 24
        yield "
    <form id=\"edit-offer-form\" action=\"/offres/update\" method=\"POST\" class=\"offer-form\">
        <input type=\"hidden\" name=\"offerId\" value=\"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_offer", [], "any", false, false, false, 26), "html", null, true);
        yield "\">
        
        <div class=\"form-row\">
            <div class=\"form-group\">
                <label for=\"title\">Titre de l'offre *</label>
                <input 
                    type=\"text\" 
                    id=\"title\" 
                    name=\"title\" 
                    placeholder=\"Titre de l'offre\" 
                    value=\"";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "title", [], "any", true, true, false, 36)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "title", [], "any", false, false, false, 36), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_title", [], "any", false, false, false, 36))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_title", [], "any", false, false, false, 36))), "html", null, true);
        yield "\" 
                    required 
                    maxlength=\"100\"
                >
                <small class=\"form-hint\">Requis, maximum 100 caractères</small>
            </div>
            
            <div class=\"form-group\">
                <label for=\"remuneration\">Rémunération (€)</label>
                <input 
                    type=\"number\" 
                    id=\"remuneration\" 
                    name=\"remuneration\" 
                    placeholder=\"Montant de la rémunération\" 
                    value=\"";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remuneration", [], "any", true, true, false, 50)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remuneration", [], "any", false, false, false, 50), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_remuneration", [], "any", false, false, false, 50))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_remuneration", [], "any", false, false, false, 50))), "html", null, true);
        yield "\" 
                    min=\"0\"
                    step=\"0.01\"
                >
                <small class=\"form-hint\">Optionnel, montant en euros</small>
            </div>
        </div>

        <div class=\"form-row\">
            <div class=\"form-group\">
                <label for=\"level\">Niveau d'études requis *</label>
                <select id=\"level\" name=\"level\" required>
                    <option value=\"\">Sélectionnez un niveau</option>
                    <option value=\"Bac+1\" ";
        // line 63
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 63)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 63), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 63))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 63))) == "Bac+1")) {
            yield "selected";
        }
        yield ">Bac+1</option>
                    <option value=\"Bac+2\" ";
        // line 64
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 64)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 64), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 64))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 64))) == "Bac+2")) {
            yield "selected";
        }
        yield ">Bac+2</option>
                    <option value=\"Bac+3\" ";
        // line 65
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 65)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 65), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 65))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 65))) == "Bac+3")) {
            yield "selected";
        }
        yield ">Bac+3</option>
                    <option value=\"Bac+4\" ";
        // line 66
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 66)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 66), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 66))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 66))) == "Bac+4")) {
            yield "selected";
        }
        yield ">Bac+4</option>
                    <option value=\"Bac+5\" ";
        // line 67
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 67)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 67), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 67))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 67))) == "Bac+5")) {
            yield "selected";
        }
        yield ">Bac+5</option>
                    <option value=\"Bac+3, Bac+5\" ";
        // line 68
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", true, true, false, 68)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "level", [], "any", false, false, false, 68), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 68))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_level", [], "any", false, false, false, 68))) == "Bac+3, Bac+5")) {
            yield "selected";
        }
        yield ">Bac+3, Bac+5</option>
                </select>
                <small class=\"form-hint\">Requis</small>
            </div>
            
            <div class=\"form-group\">
                <label for=\"duration\">Durée du stage *</label>
                <select id=\"duration\" name=\"duration\" required>
                    <option value=\"\">Sélectionnez une durée</option>
                    <option value=\"1 mois\" ";
        // line 77
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", true, true, false, 77)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", false, false, false, 77), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 77))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 77))) == "1 mois")) {
            yield "selected";
        }
        yield ">1 mois</option>
                    <option value=\"2 mois\" ";
        // line 78
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", true, true, false, 78)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", false, false, false, 78), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 78))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 78))) == "2 mois")) {
            yield "selected";
        }
        yield ">2 mois</option>
                    <option value=\"3 mois\" ";
        // line 79
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", true, true, false, 79)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", false, false, false, 79), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 79))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 79))) == "3 mois")) {
            yield "selected";
        }
        yield ">3 mois</option>
                    <option value=\"4 mois\" ";
        // line 80
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", true, true, false, 80)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", false, false, false, 80), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 80))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 80))) == "4 mois")) {
            yield "selected";
        }
        yield ">4 mois</option>
                    <option value=\"5 mois\" ";
        // line 81
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", true, true, false, 81)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", false, false, false, 81), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 81))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 81))) == "5 mois")) {
            yield "selected";
        }
        yield ">5 mois</option>
                    <option value=\"6 mois\" ";
        // line 82
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", true, true, false, 82)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", false, false, false, 82), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 82))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 82))) == "6 mois")) {
            yield "selected";
        }
        yield ">6 mois</option>
                    <option value=\"Plus de 6 mois\" ";
        // line 83
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", true, true, false, 83)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "duration", [], "any", false, false, false, 83), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 83))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_duration", [], "any", false, false, false, 83))) == "Plus de 6 mois")) {
            yield "selected";
        }
        yield ">Plus de 6 mois</option>
                </select>
                <small class=\"form-hint\">Requis</small>
            </div>
        </div>

        <div class=\"form-row\">
            <div class=\"form-group\">
                <label for=\"startDate\">Date de début *</label>
                <input 
                    type=\"date\" 
                    id=\"startDate\" 
                    name=\"startDate\" 
                    value=\"";
        // line 96
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "startDate", [], "any", true, true, false, 96)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "startDate", [], "any", false, false, false, 96), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_start", [], "any", false, false, false, 96))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_start", [], "any", false, false, false, 96))), "html", null, true);
        yield "\" 
                    required
                >
                <small class=\"form-hint\">Requis</small>
            </div>
            
            <div class=\"form-group\">
                <label for=\"enterpriseId\">Entreprise *</label>
                <select id=\"enterpriseId\" name=\"enterpriseId\" required>
                    <option value=\"\">Sélectionnez une entreprise</option>
                    <!-- This will be populated with AJAX -->
                </select>
                <small class=\"form-hint\">Requis</small>
            </div>
        </div>

        <div class=\"form-row\">
            <div class=\"form-group\">
                <label for=\"cityId\">Ville *</label>
                <select id=\"cityId\" name=\"cityId\" required>
                    <option value=\"\">Sélectionnez une ville</option>
                    <!-- This will be populated with AJAX -->
                </select>
                <small class=\"form-hint\">Requis</small>
            </div>
        </div>

        <div class=\"form-group\">
            <label for=\"content\">Description *</label>
            <textarea 
                id=\"content\" 
                name=\"content\" 
                placeholder=\"Description détaillée de l'offre\" 
                rows=\"10\"
                required
            >";
        // line 131
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "content", [], "any", true, true, false, 131)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "content", [], "any", false, false, false, 131), CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_content", [], "any", false, false, false, 131))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "offer_content", [], "any", false, false, false, 131))), "html", null, true);
        yield "</textarea>
            <small class=\"form-hint\">Requis, description détaillée de l'offre</small>
        </div>

        <div class=\"tags-section\">
            <h3>Compétences requises</h3>
            <div id=\"tags-container\">
                ";
        // line 138
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["tags"] ?? null)) > 0)) {
            // line 139
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["tags"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 140
                yield "                        <div class=\"tag-item\">
                            <div class=\"form-row\">
                                <div class=\"form-group\">
                                    <input 
                                        type=\"text\" 
                                        name=\"tags[]\" 
                                        placeholder=\"Compétence\" 
                                        value=\"";
                // line 147
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "tag_name", [], "any", false, false, false, 147), "html", null, true);
                yield "\" 
                                        class=\"tag-input\"
                                    >
                                </div>
                                <div class=\"form-group tag-optional\">
                                    <label class=\"checkbox-container\">
                                        Optionnel
                                        <input 
                                            type=\"checkbox\" 
                                            name=\"optional_tags[]\" 
                                            value=\"1\" 
                                            ";
                // line 158
                if (CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "optional", [], "any", false, false, false, 158)) {
                    yield "checked";
                }
                // line 159
                yield "                                        >
                                        <span class=\"checkmark\"></span>
                                    </label>
                                </div>
                                <button type=\"button\" class=\"btn-remove-tag\">Supprimer</button>
                            </div>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['tag'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 167
            yield "                ";
        } else {
            // line 168
            yield "                    <div class=\"tag-item\">
                        <div class=\"form-row\">
                            <div class=\"form-group\">
                                <input 
                                    type=\"text\" 
                                    name=\"tags[]\" 
                                    placeholder=\"Compétence\" 
                                    class=\"tag-input\"
                                >
                            </div>
                            <div class=\"form-group tag-optional\">
                                <label class=\"checkbox-container\">
                                    Optionnel
                                    <input 
                                        type=\"checkbox\" 
                                        name=\"optional_tags[]\" 
                                        value=\"1\"
                                    >
                                    <span class=\"checkmark\"></span>
                                </label>
                            </div>
                            <button type=\"button\" class=\"btn-remove-tag\">Supprimer</button>
                        </div>
                    </div>
                ";
        }
        // line 193
        yield "            </div>
            <button type=\"button\" id=\"add-tag\" class=\"btn-add-tag\">+ Ajouter une compétence</button>
        </div>

        <div class=\"form-actions\">
            <button type=\"submit\" class=\"btn-primary\">Enregistrer les modifications</button>
            <a href=\"/offres/";
        // line 199
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_offer", [], "any", false, false, false, 199), "html", null, true);
        yield "\" class=\"btn-secondary\">Annuler</a>
        </div>
    </form>

    <div class=\"danger-zone\">
        <h3>Zone de danger</h3>
        <div class=\"danger-content\">
            <p>La suppression de cette offre est irréversible et supprimera toutes les candidatures associées.</p>
            <button id=\"delete-offer-btn\" class=\"btn-danger\" data-offer-id=\"";
        // line 207
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_offer", [], "any", false, false, false, 207), "html", null, true);
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

    // line 215
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 216
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
<style>
.offer-edit-container {
max-width: 800px;
margin: 0 auto;
background-color: var(--background-nav);
padding: 2rem;
border-radius: 8px;
box-shadow: 0 2px 4px var(--shadow-color);
}
.error-container {
        background-color: rgba(220, 53, 69, 0.1);
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
    }

    .error-container ul {
        margin: 0;
        padding-left: 1.5rem;
        color: var(--tertiary-color);
    }

    .offer-form {
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

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 0.8rem;
        border: 1px solid var(--real-grey);
        border-radius: 4px;
        background-color: white;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px var(--focus-shadow);
    }

    .form-hint {
        font-size: 0.8rem;
        color: var(--real-grey);
    }

    .tags-section {
        margin-top: 1rem;
    }

    .tags-section h3 {
        margin-top: 0;
        margin-bottom: 1rem;
        font-size: 1.2rem;
        color: var(--onyx);
    }

    .tag-item {
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--tag-background);
    }

    .tag-optional {
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: normal;
        cursor: pointer;
    }

    .checkmark {
        position: relative;
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 1px solid var(--real-grey);
        border-radius: 3px;
    }

    .checkbox-container input:checked ~ .checkmark:after {
        content: \"\";
        position: absolute;
        left: 6px;
        top: 2px;
        width: 4px;
        height: 8px;
        border: solid var(--primary-color);
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .checkbox-container input {
        position: absolute;
        opacity: 0;
        height: 0;
        width: 0;
    }

    .btn-remove-tag {
        background-color: var(--tag-background);
        color: var(--tertiary-color);
        border: none;
        padding: 0.5rem;
        border-radius: 4px;
        cursor: pointer;
        align-self: flex-end;
    }

    .btn-add-tag {
        background-color: var(--tag-background);
        color: var(--primary-color);
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 1rem;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
    }

    .btn-primary,
    .btn-secondary {
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

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 1rem;
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
</style>
";
        yield from [];
    }

    // line 445
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 446
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
<script>
document.addEventListener('DOMContentLoaded', () => {
// Get DOM elements
const addTagBtn = document.getElementById('add-tag');
const tagsContainer = document.getElementById('tags-container');
const enterpriseSelect = document.getElementById('enterpriseId');
const citySelect = document.getElementById('cityId');
const deleteOfferBtn = document.getElementById('delete-offer-btn');

// Set current enterprise and city
        const currentEnterpriseId = '";
        // line 457
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_enterprise", [], "any", false, false, false, 457), "html", null, true);
        yield "';
        const currentCityId = '";
        // line 458
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offer"] ?? null), "id_city", [], "any", false, false, false, 458), "html", null, true);
        yield "';

        // Function to add a new tag input
        function addTagInput() {
            const tagItem = document.createElement('div');
            tagItem.className = 'tag-item';
            tagItem.innerHTML = `
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <input 
                            type=\"text\" 
                            name=\"tags[]\" 
                            placeholder=\"Compétence\" 
                            class=\"tag-input\"
                        >
                    </div>
                    <div class=\"form-group tag-optional\">
                        <label class=\"checkbox-container\">
                            Optionnel
                            <input 
                                type=\"checkbox\" 
                                name=\"optional_tags[]\" 
                                value=\"1\"
                            >
                            <span class=\"checkmark\"></span>
                        </label>
                    </div>
                    <button type=\"button\" class=\"btn-remove-tag\">Supprimer</button>
                </div>
            `;
            tagsContainer.appendChild(tagItem);
            
            // Add event listener to the remove button
            const removeBtn = tagItem.querySelector('.btn-remove-tag');
            removeBtn.addEventListener('click', function() {
                tagItem.remove();
            });
            
            // Add autocomplete to the new tag input
            const tagInput = tagItem.querySelector('.tag-input');
            initTagAutocomplete(tagInput);
        }
        
        // Add event listener to the \"Add Tag\" button
        addTagBtn.addEventListener('click', addTagInput);
        
        // Add event listeners to existing remove buttons
        document.querySelectorAll('.btn-remove-tag').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.tag-item').remove();
            });
        });
        
        // Initialize tag autocomplete
        function initTagAutocomplete(input) {
            // This is a placeholder for tag autocomplete functionality
            // You can implement it using a library like jQuery UI Autocomplete
            // Or with a custom implementation using the API endpoint for tags
        }
        
        // Initialize existing tag inputs with autocomplete
        document.querySelectorAll('.tag-input').forEach(input => {
            initTagAutocomplete(input);
        });
        
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
                
                // Clear the select options
                citySelect.innerHTML = '<option value=\"\">Sélectionnez une ville</option>';
                
                // Add the cities to the select
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id_city;
                    option.textContent = `\${city.city_name} - \${city.city_postal}`;
                    option.selected = city.id_city === currentCityId;
                    citySelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching cities:', error);
            }
        }
        
        // Fetch the enterprises and cities
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
                            }
                            
                            // Redirect to home page
                            setTimeout(() => {
                                window.location.href = '/';
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
        return array (  700 => 458,  696 => 457,  682 => 446,  675 => 445,  441 => 216,  434 => 215,  421 => 207,  410 => 199,  402 => 193,  375 => 168,  372 => 167,  359 => 159,  355 => 158,  341 => 147,  332 => 140,  327 => 139,  325 => 138,  315 => 131,  277 => 96,  259 => 83,  253 => 82,  247 => 81,  241 => 80,  235 => 79,  229 => 78,  223 => 77,  209 => 68,  203 => 67,  197 => 66,  191 => 65,  185 => 64,  179 => 63,  163 => 50,  146 => 36,  133 => 26,  129 => 24,  124 => 21,  115 => 19,  111 => 18,  107 => 16,  105 => 15,  101 => 14,  97 => 12,  90 => 11,  79 => 7,  74 => 4,  67 => 3,  55 => 2,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Modifier l'offre - {{ parent() }}{% endblock %}
{% block breadcrumb %}
<nav class=\"breadcrumb\">
    <span><a href=\"/\">Accueil</a></span>
    <span><a href=\"/offres\">Offres</a></span>
    <span><a href=\"/offres/{{ offer.id_offer }}\">{{ offer.offer_title }}</a></span>
    <span>Modification</span>
</nav>
{% endblock %}
{% block content %}
<div class=\"container\">
    <div class=\"offer-edit-container\">
        <h1>Modifier l'offre : {{ offer.offer_title }}</h1>
        {% if error is defined and error|length > 0 %}
        <div class=\"error-container\">
            <ul>
                {% for message in error %}
                    <li>{{ message }}</li>
                {% endfor %}
            </ul>
        </div>
    {% endif %}

    <form id=\"edit-offer-form\" action=\"/offres/update\" method=\"POST\" class=\"offer-form\">
        <input type=\"hidden\" name=\"offerId\" value=\"{{ offer.id_offer }}\">
        
        <div class=\"form-row\">
            <div class=\"form-group\">
                <label for=\"title\">Titre de l'offre *</label>
                <input 
                    type=\"text\" 
                    id=\"title\" 
                    name=\"title\" 
                    placeholder=\"Titre de l'offre\" 
                    value=\"{{ formData.title|default(offer.offer_title) }}\" 
                    required 
                    maxlength=\"100\"
                >
                <small class=\"form-hint\">Requis, maximum 100 caractères</small>
            </div>
            
            <div class=\"form-group\">
                <label for=\"remuneration\">Rémunération (€)</label>
                <input 
                    type=\"number\" 
                    id=\"remuneration\" 
                    name=\"remuneration\" 
                    placeholder=\"Montant de la rémunération\" 
                    value=\"{{ formData.remuneration|default(offer.offer_remuneration) }}\" 
                    min=\"0\"
                    step=\"0.01\"
                >
                <small class=\"form-hint\">Optionnel, montant en euros</small>
            </div>
        </div>

        <div class=\"form-row\">
            <div class=\"form-group\">
                <label for=\"level\">Niveau d'études requis *</label>
                <select id=\"level\" name=\"level\" required>
                    <option value=\"\">Sélectionnez un niveau</option>
                    <option value=\"Bac+1\" {% if formData.level|default(offer.offer_level) == 'Bac+1' %}selected{% endif %}>Bac+1</option>
                    <option value=\"Bac+2\" {% if formData.level|default(offer.offer_level) == 'Bac+2' %}selected{% endif %}>Bac+2</option>
                    <option value=\"Bac+3\" {% if formData.level|default(offer.offer_level) == 'Bac+3' %}selected{% endif %}>Bac+3</option>
                    <option value=\"Bac+4\" {% if formData.level|default(offer.offer_level) == 'Bac+4' %}selected{% endif %}>Bac+4</option>
                    <option value=\"Bac+5\" {% if formData.level|default(offer.offer_level) == 'Bac+5' %}selected{% endif %}>Bac+5</option>
                    <option value=\"Bac+3, Bac+5\" {% if formData.level|default(offer.offer_level) == 'Bac+3, Bac+5' %}selected{% endif %}>Bac+3, Bac+5</option>
                </select>
                <small class=\"form-hint\">Requis</small>
            </div>
            
            <div class=\"form-group\">
                <label for=\"duration\">Durée du stage *</label>
                <select id=\"duration\" name=\"duration\" required>
                    <option value=\"\">Sélectionnez une durée</option>
                    <option value=\"1 mois\" {% if formData.duration|default(offer.offer_duration) == '1 mois' %}selected{% endif %}>1 mois</option>
                    <option value=\"2 mois\" {% if formData.duration|default(offer.offer_duration) == '2 mois' %}selected{% endif %}>2 mois</option>
                    <option value=\"3 mois\" {% if formData.duration|default(offer.offer_duration) == '3 mois' %}selected{% endif %}>3 mois</option>
                    <option value=\"4 mois\" {% if formData.duration|default(offer.offer_duration) == '4 mois' %}selected{% endif %}>4 mois</option>
                    <option value=\"5 mois\" {% if formData.duration|default(offer.offer_duration) == '5 mois' %}selected{% endif %}>5 mois</option>
                    <option value=\"6 mois\" {% if formData.duration|default(offer.offer_duration) == '6 mois' %}selected{% endif %}>6 mois</option>
                    <option value=\"Plus de 6 mois\" {% if formData.duration|default(offer.offer_duration) == 'Plus de 6 mois' %}selected{% endif %}>Plus de 6 mois</option>
                </select>
                <small class=\"form-hint\">Requis</small>
            </div>
        </div>

        <div class=\"form-row\">
            <div class=\"form-group\">
                <label for=\"startDate\">Date de début *</label>
                <input 
                    type=\"date\" 
                    id=\"startDate\" 
                    name=\"startDate\" 
                    value=\"{{ formData.startDate|default(offer.offer_start) }}\" 
                    required
                >
                <small class=\"form-hint\">Requis</small>
            </div>
            
            <div class=\"form-group\">
                <label for=\"enterpriseId\">Entreprise *</label>
                <select id=\"enterpriseId\" name=\"enterpriseId\" required>
                    <option value=\"\">Sélectionnez une entreprise</option>
                    <!-- This will be populated with AJAX -->
                </select>
                <small class=\"form-hint\">Requis</small>
            </div>
        </div>

        <div class=\"form-row\">
            <div class=\"form-group\">
                <label for=\"cityId\">Ville *</label>
                <select id=\"cityId\" name=\"cityId\" required>
                    <option value=\"\">Sélectionnez une ville</option>
                    <!-- This will be populated with AJAX -->
                </select>
                <small class=\"form-hint\">Requis</small>
            </div>
        </div>

        <div class=\"form-group\">
            <label for=\"content\">Description *</label>
            <textarea 
                id=\"content\" 
                name=\"content\" 
                placeholder=\"Description détaillée de l'offre\" 
                rows=\"10\"
                required
            >{{ formData.content|default(offer.offer_content) }}</textarea>
            <small class=\"form-hint\">Requis, description détaillée de l'offre</small>
        </div>

        <div class=\"tags-section\">
            <h3>Compétences requises</h3>
            <div id=\"tags-container\">
                {% if tags|length > 0 %}
                    {% for tag in tags %}
                        <div class=\"tag-item\">
                            <div class=\"form-row\">
                                <div class=\"form-group\">
                                    <input 
                                        type=\"text\" 
                                        name=\"tags[]\" 
                                        placeholder=\"Compétence\" 
                                        value=\"{{ tag.tag_name }}\" 
                                        class=\"tag-input\"
                                    >
                                </div>
                                <div class=\"form-group tag-optional\">
                                    <label class=\"checkbox-container\">
                                        Optionnel
                                        <input 
                                            type=\"checkbox\" 
                                            name=\"optional_tags[]\" 
                                            value=\"1\" 
                                            {% if tag.optional %}checked{% endif %}
                                        >
                                        <span class=\"checkmark\"></span>
                                    </label>
                                </div>
                                <button type=\"button\" class=\"btn-remove-tag\">Supprimer</button>
                            </div>
                        </div>
                    {% endfor %}
                {% else %}
                    <div class=\"tag-item\">
                        <div class=\"form-row\">
                            <div class=\"form-group\">
                                <input 
                                    type=\"text\" 
                                    name=\"tags[]\" 
                                    placeholder=\"Compétence\" 
                                    class=\"tag-input\"
                                >
                            </div>
                            <div class=\"form-group tag-optional\">
                                <label class=\"checkbox-container\">
                                    Optionnel
                                    <input 
                                        type=\"checkbox\" 
                                        name=\"optional_tags[]\" 
                                        value=\"1\"
                                    >
                                    <span class=\"checkmark\"></span>
                                </label>
                            </div>
                            <button type=\"button\" class=\"btn-remove-tag\">Supprimer</button>
                        </div>
                    </div>
                {% endif %}
            </div>
            <button type=\"button\" id=\"add-tag\" class=\"btn-add-tag\">+ Ajouter une compétence</button>
        </div>

        <div class=\"form-actions\">
            <button type=\"submit\" class=\"btn-primary\">Enregistrer les modifications</button>
            <a href=\"/offres/{{ offer.id_offer }}\" class=\"btn-secondary\">Annuler</a>
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
.offer-edit-container {
max-width: 800px;
margin: 0 auto;
background-color: var(--background-nav);
padding: 2rem;
border-radius: 8px;
box-shadow: 0 2px 4px var(--shadow-color);
}
.error-container {
        background-color: rgba(220, 53, 69, 0.1);
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
    }

    .error-container ul {
        margin: 0;
        padding-left: 1.5rem;
        color: var(--tertiary-color);
    }

    .offer-form {
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

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 0.8rem;
        border: 1px solid var(--real-grey);
        border-radius: 4px;
        background-color: white;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px var(--focus-shadow);
    }

    .form-hint {
        font-size: 0.8rem;
        color: var(--real-grey);
    }

    .tags-section {
        margin-top: 1rem;
    }

    .tags-section h3 {
        margin-top: 0;
        margin-bottom: 1rem;
        font-size: 1.2rem;
        color: var(--onyx);
    }

    .tag-item {
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--tag-background);
    }

    .tag-optional {
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: normal;
        cursor: pointer;
    }

    .checkmark {
        position: relative;
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 1px solid var(--real-grey);
        border-radius: 3px;
    }

    .checkbox-container input:checked ~ .checkmark:after {
        content: \"\";
        position: absolute;
        left: 6px;
        top: 2px;
        width: 4px;
        height: 8px;
        border: solid var(--primary-color);
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .checkbox-container input {
        position: absolute;
        opacity: 0;
        height: 0;
        width: 0;
    }

    .btn-remove-tag {
        background-color: var(--tag-background);
        color: var(--tertiary-color);
        border: none;
        padding: 0.5rem;
        border-radius: 4px;
        cursor: pointer;
        align-self: flex-end;
    }

    .btn-add-tag {
        background-color: var(--tag-background);
        color: var(--primary-color);
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 1rem;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
    }

    .btn-primary,
    .btn-secondary {
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

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 1rem;
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
</style>
{% endblock %}
{% block javascripts %}
{{ parent() }}
<script>
document.addEventListener('DOMContentLoaded', () => {
// Get DOM elements
const addTagBtn = document.getElementById('add-tag');
const tagsContainer = document.getElementById('tags-container');
const enterpriseSelect = document.getElementById('enterpriseId');
const citySelect = document.getElementById('cityId');
const deleteOfferBtn = document.getElementById('delete-offer-btn');

// Set current enterprise and city
        const currentEnterpriseId = '{{ offer.id_enterprise }}';
        const currentCityId = '{{ offer.id_city }}';

        // Function to add a new tag input
        function addTagInput() {
            const tagItem = document.createElement('div');
            tagItem.className = 'tag-item';
            tagItem.innerHTML = `
                <div class=\"form-row\">
                    <div class=\"form-group\">
                        <input 
                            type=\"text\" 
                            name=\"tags[]\" 
                            placeholder=\"Compétence\" 
                            class=\"tag-input\"
                        >
                    </div>
                    <div class=\"form-group tag-optional\">
                        <label class=\"checkbox-container\">
                            Optionnel
                            <input 
                                type=\"checkbox\" 
                                name=\"optional_tags[]\" 
                                value=\"1\"
                            >
                            <span class=\"checkmark\"></span>
                        </label>
                    </div>
                    <button type=\"button\" class=\"btn-remove-tag\">Supprimer</button>
                </div>
            `;
            tagsContainer.appendChild(tagItem);
            
            // Add event listener to the remove button
            const removeBtn = tagItem.querySelector('.btn-remove-tag');
            removeBtn.addEventListener('click', function() {
                tagItem.remove();
            });
            
            // Add autocomplete to the new tag input
            const tagInput = tagItem.querySelector('.tag-input');
            initTagAutocomplete(tagInput);
        }
        
        // Add event listener to the \"Add Tag\" button
        addTagBtn.addEventListener('click', addTagInput);
        
        // Add event listeners to existing remove buttons
        document.querySelectorAll('.btn-remove-tag').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.tag-item').remove();
            });
        });
        
        // Initialize tag autocomplete
        function initTagAutocomplete(input) {
            // This is a placeholder for tag autocomplete functionality
            // You can implement it using a library like jQuery UI Autocomplete
            // Or with a custom implementation using the API endpoint for tags
        }
        
        // Initialize existing tag inputs with autocomplete
        document.querySelectorAll('.tag-input').forEach(input => {
            initTagAutocomplete(input);
        });
        
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
                
                // Clear the select options
                citySelect.innerHTML = '<option value=\"\">Sélectionnez une ville</option>';
                
                // Add the cities to the select
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id_city;
                    option.textContent = `\${city.city_name} - \${city.city_postal}`;
                    option.selected = city.id_city === currentCityId;
                    citySelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching cities:', error);
            }
        }
        
        // Fetch the enterprises and cities
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
                            }
                            
                            // Redirect to home page
                            setTimeout(() => {
                                window.location.href = '/';
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
