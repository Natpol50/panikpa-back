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

/* static/cgu.html.twig */
class __TwigTemplate_42eedf480c9de779987e6890dc05bd71 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "static/cgu.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Notre équipe - ";
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
        yield "
<div class=\"app\">
    <div class=\"container\">
        <nav class=\"breadcrumb\">
            <span><a href=\"/\">Accueil</a></span>
            <span>Conditions Générales d'Utilisation</span>
        </nav>

        <section class=\"cgu-content\">
            <h1>Conditions Générales d'Utilisation</h1>
            <p class=\"last-update\">Dernière mise à jour : 3 avril 2025</p>

            <div class=\"cgu-section\">
                <h2>1. Définitions</h2>
                <p>
                    Les termes suivants sont définis comme suit dans le cadre des présentes CGU :
                </p>
                <ul>
                    <li><strong>Plateforme :</strong> Le site web dédié à la mise en relation entre entreprises et stagiaires.</li>
                    <li><strong>Utilisateur :</strong> Toute personne naviguant sur la plateforme, qu'il s'agisse d'un étudiant, d'un stagiaire ou d'une entreprise.</li>
                    <li><strong>Services :</strong> Les fonctionnalités offertes par la plateforme, incluant la recherche de stages, la publication d'offres et la gestion des candidatures.</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>2. Objet</h2>
                <p>
                    Les présentes CGU ont pour objet de définir les conditions d'utilisation de la plateforme et des services proposés, ainsi que les droits et obligations des utilisateurs.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>3. Accès à la plateforme</h2>
                <p>
                    L'accès à la plateforme est gratuit pour les utilisateurs. Cependant, certaines fonctionnalités peuvent nécessiter la création d'un compte utilisateur.
                </p>
                <p>
                    Les utilisateurs s'engagent à fournir des informations exactes lors de leur inscription et à maintenir la confidentialité de leurs identifiants.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>4. Propriété intellectuelle</h2>
                <p>
                    Tous les contenus présents sur la plateforme (textes, images, logos, etc.) sont protégés par les lois relatives à la propriété intellectuelle. Toute reproduction ou utilisation non autorisée est strictement interdite.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>5. Protection des données personnelles</h2>
                <p>
                    Les données personnelles des utilisateurs sont collectées et traitées conformément à notre politique de confidentialité. Les utilisateurs disposent d'un droit d'accès, de rectification et de suppression de leurs données.
                </p>
                <p>
                    Les informations collectées sont utilisées exclusivement dans le cadre des services proposés par la plateforme.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>6. Responsabilités</h2>
                <p>
                    La plateforme agit en tant qu'intermédiaire entre les entreprises et les stagiaires. Elle ne peut être tenue responsable des relations contractuelles établies entre les parties.
                </p>
                <ul>
                    <li>Les utilisateurs sont responsables des informations qu'ils publient sur la plateforme.</li>
                    <li>La plateforme ne garantit pas la disponibilité ou la qualité des stages proposés.</li>
                    <li>Les utilisateurs doivent respecter les lois en vigueur dans le cadre de leur utilisation de la plateforme.</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>7. Modification des CGU</h2>
                <p>
                    La plateforme se réserve le droit de modifier les présentes CGU à tout moment. Les utilisateurs seront informés des modifications via une notification sur le site.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>8. Droit applicable</h2>
                <p>
                    Les présentes CGU sont régies par le droit applicable dans le pays où la plateforme est hébergée. En cas de litige, les parties s'engagent à rechercher une solution amiable avant toute action judiciaire.
                </p>
            </div>
        </section>
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
        return "static/cgu.html.twig";
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
        return array (  71 => 6,  64 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Notre équipe - {{ parent() }}{% endblock %}

{% block content %}

<div class=\"app\">
    <div class=\"container\">
        <nav class=\"breadcrumb\">
            <span><a href=\"/\">Accueil</a></span>
            <span>Conditions Générales d'Utilisation</span>
        </nav>

        <section class=\"cgu-content\">
            <h1>Conditions Générales d'Utilisation</h1>
            <p class=\"last-update\">Dernière mise à jour : 3 avril 2025</p>

            <div class=\"cgu-section\">
                <h2>1. Définitions</h2>
                <p>
                    Les termes suivants sont définis comme suit dans le cadre des présentes CGU :
                </p>
                <ul>
                    <li><strong>Plateforme :</strong> Le site web dédié à la mise en relation entre entreprises et stagiaires.</li>
                    <li><strong>Utilisateur :</strong> Toute personne naviguant sur la plateforme, qu'il s'agisse d'un étudiant, d'un stagiaire ou d'une entreprise.</li>
                    <li><strong>Services :</strong> Les fonctionnalités offertes par la plateforme, incluant la recherche de stages, la publication d'offres et la gestion des candidatures.</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>2. Objet</h2>
                <p>
                    Les présentes CGU ont pour objet de définir les conditions d'utilisation de la plateforme et des services proposés, ainsi que les droits et obligations des utilisateurs.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>3. Accès à la plateforme</h2>
                <p>
                    L'accès à la plateforme est gratuit pour les utilisateurs. Cependant, certaines fonctionnalités peuvent nécessiter la création d'un compte utilisateur.
                </p>
                <p>
                    Les utilisateurs s'engagent à fournir des informations exactes lors de leur inscription et à maintenir la confidentialité de leurs identifiants.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>4. Propriété intellectuelle</h2>
                <p>
                    Tous les contenus présents sur la plateforme (textes, images, logos, etc.) sont protégés par les lois relatives à la propriété intellectuelle. Toute reproduction ou utilisation non autorisée est strictement interdite.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>5. Protection des données personnelles</h2>
                <p>
                    Les données personnelles des utilisateurs sont collectées et traitées conformément à notre politique de confidentialité. Les utilisateurs disposent d'un droit d'accès, de rectification et de suppression de leurs données.
                </p>
                <p>
                    Les informations collectées sont utilisées exclusivement dans le cadre des services proposés par la plateforme.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>6. Responsabilités</h2>
                <p>
                    La plateforme agit en tant qu'intermédiaire entre les entreprises et les stagiaires. Elle ne peut être tenue responsable des relations contractuelles établies entre les parties.
                </p>
                <ul>
                    <li>Les utilisateurs sont responsables des informations qu'ils publient sur la plateforme.</li>
                    <li>La plateforme ne garantit pas la disponibilité ou la qualité des stages proposés.</li>
                    <li>Les utilisateurs doivent respecter les lois en vigueur dans le cadre de leur utilisation de la plateforme.</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>7. Modification des CGU</h2>
                <p>
                    La plateforme se réserve le droit de modifier les présentes CGU à tout moment. Les utilisateurs seront informés des modifications via une notification sur le site.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>8. Droit applicable</h2>
                <p>
                    Les présentes CGU sont régies par le droit applicable dans le pays où la plateforme est hébergée. En cas de litige, les parties s'engagent à rechercher une solution amiable avant toute action judiciaire.
                </p>
            </div>
        </section>
    </div>
</div>
{% endblock %}
", "static/cgu.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\static\\cgu.html.twig");
    }
}
