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

/* static/whoareWe.html.twig */
class __TwigTemplate_14e5cb8bd2deec00cdb4f28152fe86a0 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "static/whoareWe.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Qui sommes-nous ? - ";
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
        yield "<div class=\"app\">
    <div class=\"container\">
        <nav class=\"breadcrumb\">
            <span><a href=\"/\">Accueil</a></span>
            <span>Qui sommes-nous ?</span>
        </nav>

        <section class=\"cgu-content\">
            <h1>Qui sommes-nous ?</h1>
            <p class=\"last-update\">Dernière mise à jour : 5 février 2025</p>

            <div class=\"cgu-section\">
                <h2>Notre mission</h2>
                <p>
                    Nous sommes une plateforme dédiée à connecter les étudiants et les jeunes professionnels avec des entreprises à la recherche de talents. 
                    Notre mission est de simplifier la recherche d'alternance et de stage en offrant un espace où les candidats et les recruteurs peuvent 
                    se rencontrer facilement et efficacement. Depuis notre lancement, nous avons aidé des milliers d'étudiants à trouver des opportunités 
                    qui correspondent à leurs aspirations professionnelles.
                </p>
                <p>
                    Grâce à notre expertise et à notre réseau d'entreprises partenaires, nous proposons des solutions adaptées aux besoins de chacun. 
                    Que vous soyez étudiant à la recherche de votre première expérience ou une entreprise en quête de nouveaux talents, nous sommes là 
                    pour vous accompagner à chaque étape du processus.
                </p>
            </div>
                
            <div class=\"cgu-section\">
                <h2>Nos engagements</h2>
                <p>
                    Nous nous engageons à offrir une plateforme fiable et intuitive pour faciliter la mise en relation entre candidats et recruteurs. 
                    Notre priorité est de garantir une expérience utilisateur optimale et de promouvoir des opportunités de qualité. Nous travaillons 
                    en étroite collaboration avec nos partenaires pour nous assurer que chaque offre publiée répond aux attentes des candidats.
                </p>
                <p>
                    En tant qu'acteur responsable, nous valorisons l'inclusion, la diversité et l'égalité des chances. Nous croyons fermement que chaque 
                    individu mérite d'avoir accès à des opportunités qui lui permettront de développer ses compétences et de contribuer pleinement 
                    à la société. Nous croyons que le succès durable repose sur des pratiques éthiques et une vision à long terme. Rejoignez-nous 
                    dans notre mission de créer un avenir meilleur, ensemble.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>Notre approche</h2>
                <p>
                    Notre plateforme utilise une technologie de pointe pour mettre en relation les étudiants avec les entreprises qui correspondent le mieux à leurs compétences et aspirations. Nous nous efforçons de rendre le processus de recherche de stage aussi simple et efficace que possible.
                </p>
                <ul>
                    <li><strong>Personnalisation :</strong> Nous adaptons les résultats en fonction du profil et des préférences de chaque utilisateur.</li>
                    <li><strong>Transparence :</strong> Nous fournissons des informations complètes et précises sur les entreprises et les offres disponibles.</li>
                    <li><strong>Accompagnement :</strong> Nous offrons des ressources et des conseils pour aider les étudiants à préparer leur candidature.</li>
                </ul>
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
        return "static/whoareWe.html.twig";
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

{% block title %}Qui sommes-nous ? - {{ parent() }}{% endblock %}

{% block content %}
<div class=\"app\">
    <div class=\"container\">
        <nav class=\"breadcrumb\">
            <span><a href=\"/\">Accueil</a></span>
            <span>Qui sommes-nous ?</span>
        </nav>

        <section class=\"cgu-content\">
            <h1>Qui sommes-nous ?</h1>
            <p class=\"last-update\">Dernière mise à jour : 5 février 2025</p>

            <div class=\"cgu-section\">
                <h2>Notre mission</h2>
                <p>
                    Nous sommes une plateforme dédiée à connecter les étudiants et les jeunes professionnels avec des entreprises à la recherche de talents. 
                    Notre mission est de simplifier la recherche d'alternance et de stage en offrant un espace où les candidats et les recruteurs peuvent 
                    se rencontrer facilement et efficacement. Depuis notre lancement, nous avons aidé des milliers d'étudiants à trouver des opportunités 
                    qui correspondent à leurs aspirations professionnelles.
                </p>
                <p>
                    Grâce à notre expertise et à notre réseau d'entreprises partenaires, nous proposons des solutions adaptées aux besoins de chacun. 
                    Que vous soyez étudiant à la recherche de votre première expérience ou une entreprise en quête de nouveaux talents, nous sommes là 
                    pour vous accompagner à chaque étape du processus.
                </p>
            </div>
                
            <div class=\"cgu-section\">
                <h2>Nos engagements</h2>
                <p>
                    Nous nous engageons à offrir une plateforme fiable et intuitive pour faciliter la mise en relation entre candidats et recruteurs. 
                    Notre priorité est de garantir une expérience utilisateur optimale et de promouvoir des opportunités de qualité. Nous travaillons 
                    en étroite collaboration avec nos partenaires pour nous assurer que chaque offre publiée répond aux attentes des candidats.
                </p>
                <p>
                    En tant qu'acteur responsable, nous valorisons l'inclusion, la diversité et l'égalité des chances. Nous croyons fermement que chaque 
                    individu mérite d'avoir accès à des opportunités qui lui permettront de développer ses compétences et de contribuer pleinement 
                    à la société. Nous croyons que le succès durable repose sur des pratiques éthiques et une vision à long terme. Rejoignez-nous 
                    dans notre mission de créer un avenir meilleur, ensemble.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>Notre approche</h2>
                <p>
                    Notre plateforme utilise une technologie de pointe pour mettre en relation les étudiants avec les entreprises qui correspondent le mieux à leurs compétences et aspirations. Nous nous efforçons de rendre le processus de recherche de stage aussi simple et efficace que possible.
                </p>
                <ul>
                    <li><strong>Personnalisation :</strong> Nous adaptons les résultats en fonction du profil et des préférences de chaque utilisateur.</li>
                    <li><strong>Transparence :</strong> Nous fournissons des informations complètes et précises sur les entreprises et les offres disponibles.</li>
                    <li><strong>Accompagnement :</strong> Nous offrons des ressources et des conseils pour aider les étudiants à préparer leur candidature.</li>
                </ul>
            </div>
        </section>
    </div>
</div>
{% endblock %}", "static/whoareWe.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\static\\whoAreWe.html.twig");
    }
}
