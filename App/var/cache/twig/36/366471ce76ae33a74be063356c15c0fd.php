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

/* auth/register.html.twig */
class __TwigTemplate_dda7c8590db214fe60eeeb6bbbb8d3fb extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "auth/register.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Inscription - ";
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
    <div class=\"auth-container\">
    <div class=\"login-header\">
        <img src=\"/assets/img/PANIKPA.webp\" alt=\"Logo PANIKPA\" class=\"logo\">
        <h1>Créer un compte</h1>
        <p>Pour créer votre compte, veuillez remplir les informations ci dessous.</p>
    </div>

        <form id=\"register-form\" class=\"auth-form\" action=\"/new-account\" method=\"POST\">
            <div class=\"form-row\">
                <div class=\"form-section\">
                    <label for=\"civilite\">civilité :</label>
                    <select id=\"civilite\" name=\"civilite\" required>
                        <option value=\"\" disabled ";
        // line 19
        if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "civilite", [], "any", true, true, false, 19)) {
            yield "selected";
        }
        yield ">Madame/Monsieur</option>
                        <option value=\"Madame\" ";
        // line 20
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "civilite", [], "any", true, true, false, 20) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "civilite", [], "any", false, false, false, 20) == "Madame"))) {
            yield "selected";
        }
        yield ">Madame</option>
                        <option value=\"Monsieur\" ";
        // line 21
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "civilite", [], "any", true, true, false, 21) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "civilite", [], "any", false, false, false, 21) == "Monsieur"))) {
            yield "selected";
        }
        yield ">Monsieur</option>
                        <option value=\"Autre\" ";
        // line 22
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "civilite", [], "any", true, true, false, 22) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "civilite", [], "any", false, false, false, 22) == "Autre"))) {
            yield "selected";
        }
        yield ">Autre</option>
                    </select>
                </div>
                
                <div class=\"form-section\">
                    <label for=\"email\">identifiant :</label>
                    <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"exemple@exemple.com\" value=\"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "email", [], "any", true, true, false, 28)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "email", [], "any", false, false, false, 28), "")) : ("")), "html", null, true);
        yield "\" required>
                </div>
            </div>

            <div class=\"form-row\">
                <div class=\"form-section\">
                    <label for=\"firstName\">prénom :</label>
                    <input type=\"text\" id=\"firstName\" name=\"firstName\" placeholder=\"Votre prénom\" value=\"";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "firstName", [], "any", true, true, false, 35)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "firstName", [], "any", false, false, false, 35), "")) : ("")), "html", null, true);
        yield "\" required>
                </div>
                
                <div class=\"form-section\">
                    <label for=\"lastName\">nom :</label>
                    <input type=\"text\" id=\"lastName\" name=\"lastName\" placeholder=\"Votre nom\" value=\"";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "lastName", [], "any", true, true, false, 40)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "lastName", [], "any", false, false, false, 40), "")) : ("")), "html", null, true);
        yield "\" required>
                </div>
            </div>

            <div class=\"form-section user-type\">
                <span class=\"form-label\">Vous êtes :</span>
                <div class=\"radio-group\">
                    <label class=\"radio-label\">
                        <input type=\"radio\" name=\"userType\" value=\"etudiant\" ";
        // line 48
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "userType", [], "any", true, true, false, 48) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "userType", [], "any", false, false, false, 48) == "etudiant"))) {
            yield "checked";
        }
        yield ">
                        <span>étudiant</span>
                    </label>
                    <label class=\"radio-label\">
                        <input type=\"radio\" name=\"userType\" value=\"tuteur\" ";
        // line 52
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "userType", [], "any", true, true, false, 52) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "userType", [], "any", false, false, false, 52) == "tuteur"))) {
            yield "checked";
        }
        yield ">
                        <span>tuteur</span>
                    </label>
                    <label class=\"radio-label\">
                        <input type=\"radio\" name=\"userType\" value=\"basic\" ";
        // line 56
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "userType", [], "any", true, true, false, 56) && (CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "userType", [], "any", false, false, false, 56) == "basic"))) {
            yield "checked";
        }
        yield ">
                        <span>autre</span>
                    </label>
                </div>
            </div>

            <div id=\"student-type-section\" class=\"form-section\" style=\"display: none;\">
                <label for=\"studentType\">type de recherche :</label>
                <select id=\"studentType\" name=\"studentType\">
                    <option value=\"\" disabled selected>Sélectionnez votre type de recherche</option>
                    <option value=\"stage\">Stage</option>
                    <option value=\"alternance\">Alternance</option>
                </select>
            </div>
            
            <div class=\"form-section\">
                <label for=\"phone\">téléphone :</label>
                <input type=\"tel\" id=\"phone\" name=\"phone\" placeholder=\"Votre numéro de téléphone\" value=\"";
        // line 73
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "phone", [], "any", true, true, false, 73)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "phone", [], "any", false, false, false, 73), "")) : ("")), "html", null, true);
        yield "\" required>
            </div>

            <div class=\"form-section\">
                <label for=\"password\">mot de passe :</label>
                <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"Votre mot de passe...\" required minlength=\"8\">
            </div>
            
            <div class=\"form-section\">
                <label for=\"confirmPassword\">confirmer votre mot de passe :</label>
                <input type=\"password\" id=\"confirmPassword\" name=\"confirmPassword\" placeholder=\"Votre mot de passe...\" required minlength=\"8\">
            </div>

            <div class=\"form-actions\">
                <button type=\"submit\" class=\"btn-submit\">S'INSCRIRE</button>
            </div>
        </form>

        <div class=\"login-footer\">
            <p>Vous avez déjà un compte ? <a href=\"/login\">Vous connecter</a></p>
        </div>
    </div>
</div>
";
        yield from [];
    }

    // line 98
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 99
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const userTypeRadios = document.querySelectorAll('input[name=\"userType\"]');
            const studentTypeSection = document.getElementById('student-type-section');
            const studentTypeSelect = document.getElementById('studentType');

            // Function to toggle student type section
            function toggleStudentTypeSection() {
                const isStudentSelected = document.querySelector('input[name=\"userType\"][value=\"etudiant\"]:checked');
                
                if (isStudentSelected) {
                    studentTypeSection.style.display = 'block';
                    studentTypeSelect.required = true;
                } else {
                    studentTypeSection.style.display = 'none';
                    studentTypeSelect.required = false;
                    studentTypeSelect.selectedIndex = 0; // Reset selection
                }
            }

            // Add event listeners to all user type radio buttons
            userTypeRadios.forEach(radio => {
                radio.addEventListener('change', toggleStudentTypeSection);
            });

            // Initial check on page load
            toggleStudentTypeSection();

            // Form validation
            const registerForm = document.getElementById('register-form');
            registerForm.addEventListener('submit', (e) => {
                // Extra validation for student type
                const isStudentSelected = document.querySelector('input[name=\"userType\"][value=\"etudiant\"]:checked');
                const studentTypeSelected = studentTypeSelect.value;

                if (isStudentSelected && !studentTypeSelected) {
                    e.preventDefault();
                    alert('Veuillez sélectionner votre type de recherche.');
                    studentTypeSelect.focus();
                    return false;
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
        return "auth/register.html.twig";
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
        return array (  221 => 99,  214 => 98,  185 => 73,  163 => 56,  154 => 52,  145 => 48,  134 => 40,  126 => 35,  116 => 28,  105 => 22,  99 => 21,  93 => 20,  87 => 19,  72 => 6,  65 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "auth/register.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\auth\\register.html.twig");
    }
}
