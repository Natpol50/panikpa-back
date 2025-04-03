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
class __TwigTemplate_74ba8d3a68fcb41681d282ac31a21eeb extends Template
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
                        <img src=\"/assets/img/graducap.svg\" alt=\"Stage Icon\"  width=\"48\" height=\"48\" style=\"opacity: 0.4;\">
                    </div>
                </a>

                <a href=\"/offres/alternances\" class=\"choice-card\">
                    <div class=\"choice-content\">
                        <h2>Alternance</h2>
                        <p>Découvrez des opportunités en alternance pour allier études et travail.</p>
                    </div>
                    <div class=\"choice-icon\">
                    <br/>
                        <img src=\"/assets/img/contract.svg\" alt=\"Alternance Icon\"  width=\"48\" height=\"48\" style=\"opacity: 0.4;\">
                    </div>
                </a>
            </div>
        </section>
    </div>
";
        yield from [];
    }

    // line 40
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 41
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
        return array (  116 => 41,  109 => 40,  72 => 6,  65 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Offres - {{ parent() }}{% endblock %}

{% block content %}
    <div class=\"container\">
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
                        <img src=\"/assets/img/graducap.svg\" alt=\"Stage Icon\"  width=\"48\" height=\"48\" style=\"opacity: 0.4;\">
                    </div>
                </a>

                <a href=\"/offres/alternances\" class=\"choice-card\">
                    <div class=\"choice-content\">
                        <h2>Alternance</h2>
                        <p>Découvrez des opportunités en alternance pour allier études et travail.</p>
                    </div>
                    <div class=\"choice-icon\">
                    <br/>
                        <img src=\"/assets/img/contract.svg\" alt=\"Alternance Icon\"  width=\"48\" height=\"48\" style=\"opacity: 0.4;\">
                    </div>
                </a>
            </div>
        </section>
    </div>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
{% endblock %}", "offers/index.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\offers\\index.html.twig");
    }
}
