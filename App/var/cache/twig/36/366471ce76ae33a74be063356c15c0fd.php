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
        yield "Créer un compte - ";
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
        yield "<div class=\"login-container\">
    <div class=\"login-header\">
        <img src=\"/assets/img/PANIKPA.png\" alt=\"Logo PANIKPA\" class=\"logo\">
        <h1>Créer un compte</h1>
        <p>Rejoignez notre plateforme pour accéder aux offres de stages</p>
    </div>

    ";
        // line 13
        if (($context["error"] ?? null)) {
            // line 14
            yield "    <div class=\"error-message\">
        ";
            // line 15
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "
    </div>
    ";
        }
        // line 18
        yield "
    <form method=\"POST\" action=\"/new-account\" class=\"login-form\">
        <div class=\"form-group\">
            <label for=\"lastName\">Nom</label>
            <input type=\"text\" id=\"lastName\" name=\"lastName\" required>
        </div>

        <div class=\"form-group\">
            <label for=\"firstName\">Prénom</label>
            <input type=\"text\" id=\"firstName\" name=\"firstName\" required>
        </div>

        <div class=\"form-group\">
            <label for=\"email\">Email</label>
            <input type=\"email\" id=\"email\" name=\"email\" required>
        </div>

        <div class=\"form-group\">
            <label for=\"phone\">Téléphone</label>
            <input type=\"tel\" id=\"phone\" name=\"phone\" required>
        </div>

        <div class=\"form-group\">
            <label for=\"password\">Mot de passe</label>
            <input type=\"password\" id=\"password\" name=\"password\" required minlength=\"8\">
        </div>

        <div class=\"form-group\">
            <label for=\"confirmPassword\">Confirmer le mot de passe</label>
            <input type=\"password\" id=\"confirmPassword\" name=\"confirmPassword\" required minlength=\"8\">
        </div>

        <button type=\"submit\" class=\"login-btn\">Créer mon compte</button>
    </form>

    <div class=\"login-footer\">
        <p>Vous avez déjà un compte ? <a href=\"/login\">Se connecter</a></p>
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
        return array (  91 => 18,  85 => 15,  82 => 14,  80 => 13,  71 => 6,  64 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "auth/register.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\auth\\register.html.twig");
    }
}
