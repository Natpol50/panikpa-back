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

/* offers/index.html.twig */
class __TwigTemplate_67b647af52baaacb611fc2d3eeb9dbde extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "offers/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Offres - ";
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
        yield "    <div class=\"container\">
        <nav class=\"breadcrumb\">
            <span><a href=\"/\">Accueil</a></span>
            <span>Offres</span>
        </nav>

        <section class=\"offres-choices\">
            <h1>Choisissez le type d'offre</h1>
            <div class=\"choices-container\">
                <a href=\"/offres/stages\" class=\"choice-card\">
                    <div class=\"choice-content\">
                        <h2>Stages</h2>
                        <p>Recherchez des offres de stage adaptées à votre profil.</p>
                    </div>
                    <div class=\"choice-icon\">
                        <svg viewBox=\"0 0 24 24\" width=\"48\" height=\"48\">
                            <path d=\"M12 2L2 7v10l10 5 10-5V7l-10-5zM12 4.47L19.53 8 12 11.53 4.47 8 12 4.47zM4 9.38v6.24l7 3.5v-6.24L4 9.38zM13 19.12l7-3.5V9.38l-7 3.5v6.24z\" fill=\"currentColor\"/>
                        </svg>
                    </div>
                </a>

                <a href=\"/offres/alternances\" class=\"choice-card\">
                    <div class=\"choice-content\">
                        <h2>Alternance</h2>
                        <p>Découvrez des opportunités en alternance pour allier études et travail.</p>
                    </div>
                    <div class=\"choice-icon\">
                        <svg viewBox=\"0 0 24 24\" width=\"48\" height=\"48\">
                            <path d=\"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2V7zm0 8h2v2h-2v-2z\" fill=\"currentColor\"/>
                        </svg>
                    </div>
                </a>
            </div>
        </section>
    </div>
";
        yield from [];
    }

    // line 43
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 44
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "offers/index.html.twig";
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
        return array (  119 => 44,  112 => 43,  72 => 6,  65 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "offers/index.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\offers\\index.html.twig");
    }
}
