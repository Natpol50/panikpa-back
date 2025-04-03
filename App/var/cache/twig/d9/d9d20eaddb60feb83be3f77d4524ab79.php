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
            <p class=\"last-update\">Dernière mise à jour : 1er février 2025</p>

            <div class=\"cgu-section\">
                <h2>1. Définitions</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae eros quis nisl aliquam aliquet. 
                    Phasellus in ex nec massa venenatis rhoncus.
                </p>
                <ul>
                    <li><strong>Site :</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    <li><strong>Utilisateur :</strong> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                    <li><strong>Services :</strong> Ut enim ad minim veniam, quis nostrud exercitation ullamco.</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>2. Objet</h2>
                <p>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>3. Accès au site</h2>
                <p>
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                    totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                    dicta sunt explicabo.
                </p>
                <p>
                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                    sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>4. Propriété intellectuelle</h2>
                <p>
                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>5. Protection des données personnelles</h2>
                <p>
                    Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. 
                    Et harum quidem rerum facilis est et expedita distinctio.
                </p>
                <p>
                    Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod
                    maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>6. Responsabilités</h2>
                <p>
                    Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et
                    voluptates repudiandae sint et molestiae non recusandae.
                </p>
                <ul>
                    <li>Itaque earum rerum hic tenetur a sapiente delectus</li>
                    <li>Ut aut reiciendis voluptatibus maiores alias consequatur</li>
                    <li>Aut perferendis doloribus asperiores repellat</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>7. Modification des CGU</h2>
                <p>
                     Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                    sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>8. Droit applicable</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat.
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
            <p class=\"last-update\">Dernière mise à jour : 1er février 2025</p>

            <div class=\"cgu-section\">
                <h2>1. Définitions</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae eros quis nisl aliquam aliquet. 
                    Phasellus in ex nec massa venenatis rhoncus.
                </p>
                <ul>
                    <li><strong>Site :</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    <li><strong>Utilisateur :</strong> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                    <li><strong>Services :</strong> Ut enim ad minim veniam, quis nostrud exercitation ullamco.</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>2. Objet</h2>
                <p>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>3. Accès au site</h2>
                <p>
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                    totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                    dicta sunt explicabo.
                </p>
                <p>
                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                    sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>4. Propriété intellectuelle</h2>
                <p>
                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>5. Protection des données personnelles</h2>
                <p>
                    Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. 
                    Et harum quidem rerum facilis est et expedita distinctio.
                </p>
                <p>
                    Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod
                    maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>6. Responsabilités</h2>
                <p>
                    Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et
                    voluptates repudiandae sint et molestiae non recusandae.
                </p>
                <ul>
                    <li>Itaque earum rerum hic tenetur a sapiente delectus</li>
                    <li>Ut aut reiciendis voluptatibus maiores alias consequatur</li>
                    <li>Aut perferendis doloribus asperiores repellat</li>
                </ul>
            </div>

            <div class=\"cgu-section\">
                <h2>7. Modification des CGU</h2>
                <p>
                     Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                    sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                </p>
            </div>

            <div class=\"cgu-section\">
                <h2>8. Droit applicable</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat.
                </p>
            </div>
        </section>
    </div>
</div>
{% endblock %}", "static/cgu.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\static\\cgu.html.twig");
    }
}
