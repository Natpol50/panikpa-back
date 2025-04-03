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

/* static/RGPD.html.twig */
class __TwigTemplate_588f834eeeffa3101a1d7bc2cfbd3608 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "static/RGPD.html.twig", 1);
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
            <span>Politique de Protection des Données</span>
        </nav>

        <section class=\"cgu-content\">
            <h1>Politique de Protection des Données</h1>
            <p class=\"last-update\">Dernière mise à jour : 3 février 2025</p>

            <div class=\"cgu-section\">
                <h2>1. Collecte des données personnelles</h2>
                <p>
                    Dans le cadre de l'utilisation du site PANIKPA, nous sommes amenés à collecter certaines données personnelles vous concernant. 
                    Ces données sont essentielles pour vous fournir nos services de recherche de stage.
                </p>
                <ul>
                    <li><strong>Données d'identification :</strong> nom, prénom, civilité</li>
                    <li><strong>Coordonnées :</strong> adresse e-mail, numéro de téléphone</li>
                    <li><strong>Informations professionnelles :</strong> CV, lettre de motivation, certifications</li>
                    <li><strong>Données de connexion :</strong> identifiants, historique de navigation sur le site</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>2. Utilisation des données</h2>
                <p>Vos données personnelles sont utilisées pour :</p>
                <ul>
                    <li>Gérer votre compte et vos candidatures</li>
                    <li>Vous mettre en relation avec les entreprises</li>
                    <li>Personnaliser votre expérience utilisateur</li>
                    <li>Améliorer nos services et notre plateforme</li>
                    <li>Vous informer des offres correspondant à votre profil</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>3. Conservation des données</h2>
                <p>
                    Nous conservons vos données personnelles pendant la durée nécessaire aux finalités pour lesquelles elles ont été collectées. 
                    Cette durée peut varier selon le type de données :
                </p>
                <ul>
                    <li>Données de compte : jusqu'à la suppression de votre compte</li>
                    <li>Candidatures : 2 ans après la dernière candidature</li>
                    <li>Données de navigation : 13 mois maximum</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>4. Partage des données</h2>
                <p>Vos données peuvent être partagées avec :</p>
                <ul>
                    <li>Les entreprises auxquelles vous postulez</li>
                    <li>Nos sous-traitants techniques (hébergement, maintenance)</li>
                    <li>Les autorités compétentes sur demande légale</li>
                </ul>
                <p>Nous nous engageons à ne jamais vendre vos données personnelles à des tiers.</p>
            </div>

            <div class=\"cgu-section\">
                <h2>5. Sécurité des données</h2>
                <p>
                    Nous mettons en œuvre des mesures techniques et organisationnelles appropriées pour protéger
                    vos données personnelles contre toute forme de traitement non autorisé ou illégal, ainsi que contre la perte,
                    la destruction ou les dégâts d'origine accidentelle.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>6. Vos droits</h2>
                <p>Conformément à la réglementation en vigueur, vous disposez des droits suivants :</p>
                <ul>
                    <li>Droit d'accès à vos données</li>
                    <li>Droit de rectification des données inexactes</li>
                    <li>Droit à l'effacement de vos données</li>
                    <li>Droit à la limitation du traitement</li>
                    <li>Droit à la portabilité de vos données</li>
                    <li>Droit d'opposition au traitement</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>7. Exercer vos droits</h2>
                <p>
                    Pour exercer vos droits ou pour toute question relative à la protection de vos données personnelles, vous pouvez nous contacter :
                </p>
                <ul>
                    <li>Par email : <a href=\"/cdn-cgi/l/email-protection\" class=\"__cf_email__\" data-cfemail=\"f484869d8295978db484959a9d9f8495da979b99\">[email&#160;protected]</a></li>
                    <li>Par courrier : PANIKPA - Service Protection des Données - 4 place de boston | 14200 Hérouville-St-Clair</li>
                </ul>
                <p>Nous nous engageons à répondre à vos demandes dans un délai maximum de 30 ans ouvrés.</p>
            </div>

            <div class=\"cgu-section\">
                <h2>8. Modifications</h2>
                <p>
                    Nous nous réservons le droit de modifier cette politique de protection des données à tout moment. 
                    Les modifications prennent effet dès leur publication sur le site. 
                    Nous vous encourageons à consulter régulièrement cette page pour rester informé des éventuelles mises à jour.
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
        return "static/RGPD.html.twig";
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

{% block title %}Notre équipe - {{parent() }}{% endblock %}

{% block content %}

<div class=\"app\">
    <div class=\"container\">
        <nav class=\"breadcrumb\">
            <span><a href=\"/\">Accueil</a></span>
            <span>Politique de Protection des Données</span>
        </nav>

        <section class=\"cgu-content\">
            <h1>Politique de Protection des Données</h1>
            <p class=\"last-update\">Dernière mise à jour : 3 février 2025</p>

            <div class=\"cgu-section\">
                <h2>1. Collecte des données personnelles</h2>
                <p>
                    Dans le cadre de l'utilisation du site PANIKPA, nous sommes amenés à collecter certaines données personnelles vous concernant. 
                    Ces données sont essentielles pour vous fournir nos services de recherche de stage.
                </p>
                <ul>
                    <li><strong>Données d'identification :</strong> nom, prénom, civilité</li>
                    <li><strong>Coordonnées :</strong> adresse e-mail, numéro de téléphone</li>
                    <li><strong>Informations professionnelles :</strong> CV, lettre de motivation, certifications</li>
                    <li><strong>Données de connexion :</strong> identifiants, historique de navigation sur le site</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>2. Utilisation des données</h2>
                <p>Vos données personnelles sont utilisées pour :</p>
                <ul>
                    <li>Gérer votre compte et vos candidatures</li>
                    <li>Vous mettre en relation avec les entreprises</li>
                    <li>Personnaliser votre expérience utilisateur</li>
                    <li>Améliorer nos services et notre plateforme</li>
                    <li>Vous informer des offres correspondant à votre profil</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>3. Conservation des données</h2>
                <p>
                    Nous conservons vos données personnelles pendant la durée nécessaire aux finalités pour lesquelles elles ont été collectées. 
                    Cette durée peut varier selon le type de données :
                </p>
                <ul>
                    <li>Données de compte : jusqu'à la suppression de votre compte</li>
                    <li>Candidatures : 2 ans après la dernière candidature</li>
                    <li>Données de navigation : 13 mois maximum</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>4. Partage des données</h2>
                <p>Vos données peuvent être partagées avec :</p>
                <ul>
                    <li>Les entreprises auxquelles vous postulez</li>
                    <li>Nos sous-traitants techniques (hébergement, maintenance)</li>
                    <li>Les autorités compétentes sur demande légale</li>
                </ul>
                <p>Nous nous engageons à ne jamais vendre vos données personnelles à des tiers.</p>
            </div>

            <div class=\"cgu-section\">
                <h2>5. Sécurité des données</h2>
                <p>
                    Nous mettons en œuvre des mesures techniques et organisationnelles appropriées pour protéger
                    vos données personnelles contre toute forme de traitement non autorisé ou illégal, ainsi que contre la perte,
                    la destruction ou les dégâts d'origine accidentelle.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>6. Vos droits</h2>
                <p>Conformément à la réglementation en vigueur, vous disposez des droits suivants :</p>
                <ul>
                    <li>Droit d'accès à vos données</li>
                    <li>Droit de rectification des données inexactes</li>
                    <li>Droit à l'effacement de vos données</li>
                    <li>Droit à la limitation du traitement</li>
                    <li>Droit à la portabilité de vos données</li>
                    <li>Droit d'opposition au traitement</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>7. Exercer vos droits</h2>
                <p>
                    Pour exercer vos droits ou pour toute question relative à la protection de vos données personnelles, vous pouvez nous contacter :
                </p>
                <ul>
                    <li>Par email : <a href=\"/cdn-cgi/l/email-protection\" class=\"__cf_email__\" data-cfemail=\"f484869d8295978db484959a9d9f8495da979b99\">[email&#160;protected]</a></li>
                    <li>Par courrier : PANIKPA - Service Protection des Données - 4 place de boston | 14200 Hérouville-St-Clair</li>
                </ul>
                <p>Nous nous engageons à répondre à vos demandes dans un délai maximum de 30 ans ouvrés.</p>
            </div>

            <div class=\"cgu-section\">
                <h2>8. Modifications</h2>
                <p>
                    Nous nous réservons le droit de modifier cette politique de protection des données à tout moment. 
                    Les modifications prennent effet dès leur publication sur le site. 
                    Nous vous encourageons à consulter régulièrement cette page pour rester informé des éventuelles mises à jour.
                </p>
            </div>
        </section>
    </div>
</div>
{% endblock %}", "static/RGPD.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\static\\RGPD.html.twig");
    }
}
