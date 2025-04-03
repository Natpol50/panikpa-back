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

/* static/ourTeam.html.twig */
class __TwigTemplate_a9d1e64096a4b7a95e064a8152dc7981 extends Template
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
            'stylesheets' => [$this, 'block_stylesheets'],
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
        $this->parent = $this->loadTemplate("base.html.twig", "static/ourTeam.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
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

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "<div class=\"app\">
    <div class=\"container\">
        <nav class=\"breadcrumb\">
            <span><a href=\"/\">Accueil</a></span>
            <span>Notre équipe</span>
        </nav>
        <section class=\"cgu-content\">
            <h1>Notre équipe</h1>
            <p class=\"last-update\">Dernière mise à jour : 3 avril 2025</p>
            <div class=\"cgu-section\">
                <h2>Équipe Communication</h2>
                <p>
                    Notre équipe de communication est composée de professionnels passionnés qui s'assurent que notre plateforme reste accessible et conviviale pour tous les utilisateurs.
                </p>
                <ul>
                    <li><strong>Jean Dupont</strong> - Directeur de la Communication</li>
                    <li><strong>Marie Dubois</strong> - Responsable Marketing Digital</li>
                    <li><strong>Thomas Martin</strong> - Chargé des Relations Publiques</li>              
                </ul>
            </div>
            <div class=\"cgu-section\">
                <h2>Équipe Commerciale</h2>
                <p>
                    Notre équipe commerciale travaille en étroite collaboration avec nos partenaires entreprises pour offrir les meilleures opportunités de stage à nos étudiants.
                </p>
                <ul>
                    <li><strong>Sophie Lefèvre</strong> - Directrice Commerciale</li>
                    <li><strong>Julien Moreau</strong> - Responsable des Partenariats Entreprises</li>
                    <li><strong>Claire Petit</strong> - Chargée de Clientèle</li>
                </ul>
            </div>
            <div class=\"cgu-section\">
                <h2>Équipe Développement</h2>
                <p>
                    Notre équipe de développement s'assure que notre plateforme reste à la pointe de la technologie, offrant une expérience utilisateur optimale et sécurisée.
                </p>
                <ul>
                    <li><strong>Nathan Polette</strong> - Lead Développeur & Full-Stack</li>
                    <li><strong id=\"tonio-trigger\">Antoine Von Tokarski</strong> - Développeur Back</li>
                    <li><strong>Jeanne Guibert</strong> - Développeuse statique et reviews</li>
                </ul>
            </div>
            <div class=\"cgu-section\">
                <h2>Notre philosophie</h2>
                <p>
                    Chez PANIKPA, nous croyons que la diversité des compétences et des perspectives est la clé de notre succès. Notre équipe est composée de professionnels passionnés et dévoués, qui partagent une vision commune : faciliter l'accès des étudiants aux meilleures opportunités professionnelles.
                </p>
                <p>
                    Notre approche collaborative et notre engagement envers l'excellence nous permettent de continuer à innover et à améliorer constamment nos services pour répondre aux besoins évolutifs de nos utilisateurs.
                </p>
            </div>
        </section>
    </div>
</div>
";
        yield from [];
    }

    // line 60
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 61
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Préchargement du son
    const vineBoomSound = new Audio('/assets/sound/TONIO.mp3');
    
    // Référence à l'élément déclencheur
    const tonioTrigger = document.getElementById('tonio-trigger');
    
    // Fonction pour générer un nombre aléatoire dans une plage donnée
    function getRandomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    
    // Fonction pour créer et positionner l'image aléatoirement
    function createRandomTonioImage() {
        // Créer l'élément image
        const tonioImage = document.createElement('img');
        tonioImage.src = '/assets/img/TONIO.gif';
        tonioImage.alt = 'TONIO';
        tonioImage.className = 'tonio-easter-egg';
        
        // Définir une taille aléatoire (entre 100px et 500px)
        const size = getRandomNumber(100, 500);
        tonioImage.style.width = `\${size}px`;
        
        // Positionner aléatoirement sur la page
        const maxX = window.innerWidth - size;
        const maxY = window.innerHeight - size;
        tonioImage.style.position = 'fixed';
        tonioImage.style.left = `\${getRandomNumber(0, maxX)}px`;
        tonioImage.style.top = `\${getRandomNumber(0, maxY)}px`;
        
        // Rotation aléatoire (entre -30 et 30 degrés)
        const rotation = getRandomNumber(-30, 30);
        tonioImage.style.transform = `rotate(\${rotation}deg)`;
        
        // Ajouter un z-index élevé pour s'assurer que l'image est au-dessus des autres éléments
        tonioImage.style.zIndex = '9999';
        
        // Ajouter l'image au corps du document
        document.body.appendChild(tonioImage);
        
        // Redémarrer et jouer le son
        vineBoomSound.currentTime = 0; // Reset audio to the beginning
        vineBoomSound.play();
    }
    
    // Ajouter l'écouteur d'événement au clic
    tonioTrigger.addEventListener('click', createRandomTonioImage);
});

</script>
";
        yield from [];
    }

    // line 116
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 117
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
<style>
    .tonio-easter-egg {
        pointer-events: none; /* Pour éviter que l'image ne capte les événements de clic */
        transition: transform 0.3s ease;
    }
    
    #tonio-trigger {
        cursor: pointer;
        position: relative;
    }
    
    #tonio-trigger:hover {
        color: var(--primary-color);
    }
</style>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "static/ourTeam.html.twig";
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
        return array (  205 => 117,  198 => 116,  139 => 61,  132 => 60,  73 => 4,  66 => 3,  54 => 2,  43 => 1,);
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
            <span>Notre équipe</span>
        </nav>
        <section class=\"cgu-content\">
            <h1>Notre équipe</h1>
            <p class=\"last-update\">Dernière mise à jour : 3 avril 2025</p>
            <div class=\"cgu-section\">
                <h2>Équipe Communication</h2>
                <p>
                    Notre équipe de communication est composée de professionnels passionnés qui s'assurent que notre plateforme reste accessible et conviviale pour tous les utilisateurs.
                </p>
                <ul>
                    <li><strong>Jean Dupont</strong> - Directeur de la Communication</li>
                    <li><strong>Marie Dubois</strong> - Responsable Marketing Digital</li>
                    <li><strong>Thomas Martin</strong> - Chargé des Relations Publiques</li>              
                </ul>
            </div>
            <div class=\"cgu-section\">
                <h2>Équipe Commerciale</h2>
                <p>
                    Notre équipe commerciale travaille en étroite collaboration avec nos partenaires entreprises pour offrir les meilleures opportunités de stage à nos étudiants.
                </p>
                <ul>
                    <li><strong>Sophie Lefèvre</strong> - Directrice Commerciale</li>
                    <li><strong>Julien Moreau</strong> - Responsable des Partenariats Entreprises</li>
                    <li><strong>Claire Petit</strong> - Chargée de Clientèle</li>
                </ul>
            </div>
            <div class=\"cgu-section\">
                <h2>Équipe Développement</h2>
                <p>
                    Notre équipe de développement s'assure que notre plateforme reste à la pointe de la technologie, offrant une expérience utilisateur optimale et sécurisée.
                </p>
                <ul>
                    <li><strong>Nathan Polette</strong> - Lead Développeur & Full-Stack</li>
                    <li><strong id=\"tonio-trigger\">Antoine Von Tokarski</strong> - Développeur Back</li>
                    <li><strong>Jeanne Guibert</strong> - Développeuse statique et reviews</li>
                </ul>
            </div>
            <div class=\"cgu-section\">
                <h2>Notre philosophie</h2>
                <p>
                    Chez PANIKPA, nous croyons que la diversité des compétences et des perspectives est la clé de notre succès. Notre équipe est composée de professionnels passionnés et dévoués, qui partagent une vision commune : faciliter l'accès des étudiants aux meilleures opportunités professionnelles.
                </p>
                <p>
                    Notre approche collaborative et notre engagement envers l'excellence nous permettent de continuer à innover et à améliorer constamment nos services pour répondre aux besoins évolutifs de nos utilisateurs.
                </p>
            </div>
        </section>
    </div>
</div>
{% endblock %}

{% block javascripts %}
{{ parent() }}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Préchargement du son
    const vineBoomSound = new Audio('/assets/sound/TONIO.mp3');
    
    // Référence à l'élément déclencheur
    const tonioTrigger = document.getElementById('tonio-trigger');
    
    // Fonction pour générer un nombre aléatoire dans une plage donnée
    function getRandomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    
    // Fonction pour créer et positionner l'image aléatoirement
    function createRandomTonioImage() {
        // Créer l'élément image
        const tonioImage = document.createElement('img');
        tonioImage.src = '/assets/img/TONIO.gif';
        tonioImage.alt = 'TONIO';
        tonioImage.className = 'tonio-easter-egg';
        
        // Définir une taille aléatoire (entre 100px et 500px)
        const size = getRandomNumber(100, 500);
        tonioImage.style.width = `\${size}px`;
        
        // Positionner aléatoirement sur la page
        const maxX = window.innerWidth - size;
        const maxY = window.innerHeight - size;
        tonioImage.style.position = 'fixed';
        tonioImage.style.left = `\${getRandomNumber(0, maxX)}px`;
        tonioImage.style.top = `\${getRandomNumber(0, maxY)}px`;
        
        // Rotation aléatoire (entre -30 et 30 degrés)
        const rotation = getRandomNumber(-30, 30);
        tonioImage.style.transform = `rotate(\${rotation}deg)`;
        
        // Ajouter un z-index élevé pour s'assurer que l'image est au-dessus des autres éléments
        tonioImage.style.zIndex = '9999';
        
        // Ajouter l'image au corps du document
        document.body.appendChild(tonioImage);
        
        // Redémarrer et jouer le son
        vineBoomSound.currentTime = 0; // Reset audio to the beginning
        vineBoomSound.play();
    }
    
    // Ajouter l'écouteur d'événement au clic
    tonioTrigger.addEventListener('click', createRandomTonioImage);
});

</script>
{% endblock %}

{% block stylesheets %}
{{ parent() }}
<style>
    .tonio-easter-egg {
        pointer-events: none; /* Pour éviter que l'image ne capte les événements de clic */
        transition: transform 0.3s ease;
    }
    
    #tonio-trigger {
        cursor: pointer;
        position: relative;
    }
    
    #tonio-trigger:hover {
        color: var(--primary-color);
    }
</style>
{% endblock %}", "static/ourTeam.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\static\\ourTeam.html.twig");
    }
}
