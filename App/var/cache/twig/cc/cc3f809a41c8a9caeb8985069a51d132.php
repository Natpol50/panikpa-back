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

/* auth/login.html.twig */
class __TwigTemplate_ef78549401e3105796564b9ab29a5108 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "auth/login.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Connexion - ";
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
        yield "
";
        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 10
        yield "<div class=\"login-container\">
    <div class=\"login-header\">
        <img src=\"/assets/img/PANIKPA.webp\" alt=\"Logo PANIKPA\" class=\"logo\">
        <h1>Connexion</h1>
        <p>Veuillez vous connecter pour accéder à votre compte</p>
    </div>

    <form method=\"POST\" action=\"/login\" class=\"login-form\">
        <div class=\"form-group\">
            <label for=\"email\">Email</label>
            <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"VeryfunEmail@panikpa.com\" value=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "email", [], "any", true, true, false, 20)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "email", [], "any", false, false, false, 20), "")) : ("")), "html", null, true);
        yield "\" required autocomplete=\"email\">
        </div>

        <div class=\"form-group\">
            <label for=\"password\">Mot de passe</label>
            <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"V3rySecur3Pa\$\$word\" required autocomplete=\"current-password\">
        </div>

        <div class=\"remember-me\">
            <input type=\"checkbox\" id=\"remember_me\" name=\"remember_me\" ";
        // line 29
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remember_me", [], "any", true, true, false, 29)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["formData"] ?? null), "remember_me", [], "any", false, false, false, 29), false)) : (false))) {
            yield "checked";
        }
        yield ">
            <label for=\"remember_me\">Se souvenir de moi</label>
        </div>

        <button type=\"submit\" class=\"login-btn\">Se connecter</button>
    </form>

    <div class=\"login-footer\">
        <p>Vous n'avez pas de compte ? <a href=\"/new-account\">Créer un compte</a></p>
        <p><a href=\"/forgot-password\">Mot de passe oublié ?</a></p>
    </div>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "auth/login.html.twig";
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
        return array (  109 => 29,  97 => 20,  85 => 10,  78 => 9,  72 => 6,  65 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "auth/login.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\auth\\login.html.twig");
    }
}
