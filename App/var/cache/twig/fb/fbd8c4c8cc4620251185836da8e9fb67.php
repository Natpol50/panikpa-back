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

/* auth/reset-password.html.twig */
class __TwigTemplate_2e88889293da4f6bc9a2832d94565796 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "auth/reset-password.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "    Réinitialisation de mot de passe - ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield "
";
        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 8
        yield "<div class=\"login-container\">
    <div class=\"login-header\">
        <img src=\"/assets/img/PANIKPA.png\" alt=\"Logo PANIKPA\" class=\"logo\">
        <h1>Réinitialisation de mot de passe</h1>
        <p>Veuillez saisir un nouveau mot de passe</p>
    </div>

    <form method=\"POST\" action=\"/reset-password\" class=\"login-form\">
        <input type=\"hidden\" name=\"token\" value=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["token"] ?? null), "html", null, true);
        yield "\">
        <input type=\"hidden\" name=\"email\" value=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["email"] ?? null), "html", null, true);
        yield "\">

        <div class=\"form-group\">
            <label for=\"password\">Nouveau mot de passe</label>
            <input 
                type=\"password\" 
                id=\"password\" 
                name=\"password\" 
                placeholder=\"Saisissez votre nouveau mot de passe\" 
                required 
                minlength=\"8\" 
                autocomplete=\"new-password\">
        </div>

        <div class=\"form-group\">
            <label for=\"confirmPassword\">Confirmez le nouveau mot de passe</label>
            <input 
                type=\"password\" 
                id=\"confirmPassword\" 
                name=\"confirmPassword\" 
                placeholder=\"Confirmez votre nouveau mot de passe\" 
                required 
                minlength=\"8\" 
                autocomplete=\"new-password\">
        </div>

        <button type=\"submit\" class=\"login-btn\">Réinitialiser le mot de passe</button>
    </form>

    <div class=\"login-footer\">
        <p><a href=\"/login\">Retour à la connexion</a></p>
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
        return "auth/reset-password.html.twig";
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
        return array (  88 => 17,  84 => 16,  74 => 8,  67 => 7,  59 => 4,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "auth/reset-password.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\auth\\reset-password.html.twig");
    }
}
