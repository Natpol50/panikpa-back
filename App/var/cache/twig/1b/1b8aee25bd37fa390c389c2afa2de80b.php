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

/* auth/reset-code.html.twig */
class __TwigTemplate_f49565e901b49383db77756dc1e33a66 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "auth/reset-code.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Vérification du code - ";
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
        <h1>Vérification du code</h1>
        <p>Veuillez saisir le code de réinitialisation reçu par email</p>
    </div>

    ";
        // line 13
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["error"] ?? null)) > 0)) {
            // line 14
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["error"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 15
                yield "            <div class=\"error-message\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "</div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            yield "    ";
        }
        // line 18
        yield "
    <form method=\"POST\" action=\"/verify-reset-code\" class=\"login-form\">
        <input type=\"hidden\" name=\"email\" value=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["email"] ?? null), "html", null, true);
        yield "\">
        
        <div class=\"form-group\">
            <label for=\"reset-code\">Code de réinitialisation</label>
            <input type=\"text\" id=\"reset-code\" name=\"resetCode\" required autofocus 
                   placeholder=\"Entrez le code reçu par email\" maxlength=\"6\" 
                   pattern=\"[0-9]{6}\" title=\"Le code doit contenir 6 chiffres\">
            <small class=\"form-hint\">Le code est composé de 6 chiffres et a été envoyé à votre adresse email</small>
        </div>

        <button type=\"submit\" class=\"login-btn\">Vérifier le code</button>
    </form>

    <div class=\"login-footer\">
        <p><a href=\"/forgot-password\">Demander un nouveau code</a></p>
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
        return "auth/reset-code.html.twig";
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
        return array (  103 => 20,  99 => 18,  96 => 17,  87 => 15,  82 => 14,  80 => 13,  71 => 6,  64 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "auth/reset-code.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\auth\\reset-code.html.twig");
    }
}
