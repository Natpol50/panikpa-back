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

/* home/index.html.twig */
class __TwigTemplate_dd8152faf4b7db5a9e1e2704500e04d2 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "home/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Accueil - ";
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
        yield "    <!-- Main Content -->
    <div class=\"main-content\">
        <section class=\"contact-section\">
            <h2>Nouvelles des contacts</h2>
            <div class=\"updates-container\" id=\"updates-container\">
                <div class=\"update-card loading-placeholder\">
                    <div class=\"placeholder-content\">
                        <div class=\"placeholder-header\"></div>
                        <div class=\"placeholder-text\"></div>
                        <div class=\"placeholder-tag\"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class=\"offres-section\">
            <h2>Offres pour vous</h2>
            <div class=\"offres-container\" id=\"offres-container\">
                <div class=\"offre-card loading-placeholder\">
                    <div class=\"placeholder-content\">
                        <div class=\"placeholder-header\"></div>
                        <div class=\"placeholder-text\"></div>
                        <div class=\"placeholder-text\"></div>
                        <div class=\"placeholder-tag\"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
";
        yield from [];
    }

    // line 37
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 38
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            try {
                // Fetch updates
                const updatesContainer = document.getElementById('updates-container');
                
                ";
        // line 45
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "isAuthenticated", [], "method", false, false, false, 45)) {
            // line 46
            yield "                    try {
                        const updatesResponse = await fetch('/API/latestupdates');
                        const updatesData = await updatesResponse.json();
                        
                        if (updatesData.success && updatesData.updates && updatesData.updates.length > 0) {
                            // Clear loading placeholders
                            updatesContainer.innerHTML = '';
                            
                            // Add updates
                            updatesData.updates.forEach(update => {
                                const updateCard = document.createElement('div');
                                updateCard.className = 'update-card';
                                updateCard.innerHTML = `
                                    <div class=\"update-header\">
                                        <h3>\${update.title} - \${update.company}</h3>
                                        <span class=\"update-time\">\${update.timestamp}</span>
                                    </div>
                                    <p>\${update.status === 'Accepté' ? 'Votre candidature a été acceptée' : 
                                        update.status === 'Refusé' ? 'Votre candidature a été refusée' :
                                        update.status === 'Entretien' ? `Entretien prévu le \${update.followupInterviewDate}` :
                                        'Votre candidature est en cours d\\'examen'}</p>
                                    <div class=\"tags\">
                                        <span class=\"\${update.statusClass}\">\${update.status}</span>
                                    </div>
                                `;
                                updatesContainer.appendChild(updateCard);
                            });
                        } else {
                            // No updates or error
                            updatesContainer.innerHTML = `
                                <div class=\"update-card\">
                                    <div class=\"update-header\">
                                        <h3>Aucune mise à jour</h3>
                                    </div>
                                    <p>Vous n'avez pas encore de candidatures en cours.</p>
                                </div>
                            `;
                        }
                    } catch (error) {
                        console.error('Error fetching updates:', error);
                        updatesContainer.innerHTML = `
                            <div class=\"update-card\">
                                <div class=\"update-header\">
                                    <h3>Erreur</h3>
                                </div>
                                <p>Impossible de charger les mises à jour des contacts.</p>
                            </div>
                        `;
                    }
                ";
        } else {
            // line 96
            yield "                    // Not authenticated
                    updatesContainer.innerHTML = `
                        <div class=\"update-card\">
                            <div class=\"update-header\">
                                <h3>Connexion requise</h3>
                            </div>
                            <p>Connectez-vous pour voir vos mises à jour.</p>
                            <div class=\"tags\">
                                <a href=\"/login\" class=\"tag\" style=\"text-decoration: none;\">Se connecter</a>
                            </div>
                        </div>
                    `;
                ";
        }
        // line 109
        yield "                
                // Fetch offers
                const offresContainer = document.getElementById('offres-container');
                
                try {
                    const offersResponse = await fetch('/API/favoffers');
                    const offersData = await offersResponse.json();
                    
                    if (offersData.success && offersData.offers && offersData.offers.length > 0) {
                        // Clear loading placeholders
                        offresContainer.innerHTML = '';
                        
                        // Add offers
                        offersData.offers.forEach(offer => {
                            const offerCard = document.createElement('div');
                            offerCard.className = `offre-card\${offer.highlighted ? ' highlighted' : ''}`;
                            offerCard.dataset.id = offer.reference;
                            
                            // Generate tags HTML
                            const tagsHTML = offer.tags.map(tag => 
                                `<span class=\"\${tag.optional ? 'tag_optional' : 'tag'}\">\${tag.name}</span>`
                            ).join(' ');
                            
                            offerCard.innerHTML = `
                                <div class=\"job-details\">
                                    <h3>\${offer.title}</h3>
                                    <p class=\"reference\">\${offer.company} | \${offer.location} | Réf. \${offer.reference}</p>
                                    <div class=\"tags\">
                                        <span class=\"tag\">\${offer.duration}</span>
                                        <span class=\"tag\">\${offer.level}</span>
                                        \${tagsHTML}
                                    </div>
                                </div>
                                <p>Commence le : \${offer.startDate}</p>
                                <p class=\"\${offer.remuneration === 0 ? 'remuneration_negative' : 'remuneration'}\">
                                    \${offer.remuneration === 0 ? 'Non Rémunéré' : 'Rémunéré'}
                                </p>
                                \${offer.highlighted ? '<p class=\"tag_star\">Candidat star !</p>' : ''}
                                \${offer.wishlisted ? '<p class=\"wishlist-badge\">Dans votre wishlist</p>' : ''}
                            `;
                            
                            // Add click event to navigate to offer details
                            offerCard.addEventListener('click', () => {
                                window.location.href = `/offres/\${offer.reference}`;
                            });
                            
                            offresContainer.appendChild(offerCard);
                        });
                    } else {
                        // No offers or error
                        offresContainer.innerHTML = `
                            <div class=\"offre-card\">
                                <div class=\"job-details\">
                                    <h3>Aucune offre disponible</h3>
                                </div>
                                <p>Aucune offre ne correspond à votre profil pour le moment.</p>
                            </div>
                        `;
                    }
                } catch (error) {
                    console.error('Error fetching offers:', error);
                    offresContainer.innerHTML = `
                        <div class=\"offre-card\">
                            <div class=\"job-details\">
                                <h3>Erreur</h3>
                            </div>
                            <p>Impossible de charger les offres recommandées.</p>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('General error:', error);
            }
        });
    </script>
";
        yield from [];
    }

    // line 186
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 187
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        /* Loading placeholders */
        .loading-placeholder {
            animation: pulse 1.5s infinite;
            background-color: var(--background-nav);
        }
        
        .placeholder-content {
            padding: 1rem;
        }
        
        .placeholder-header {
            height: 1.5rem;
            background-color: var(--real-grey);
            opacity: 0.2;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
        
        .placeholder-text {
            height: 1rem;
            background-color: var(--real-grey);
            opacity: 0.2;
            margin-bottom: 0.5rem;
            border-radius: 4px;
            width: 80%;
        }
        
        .placeholder-tag {
            height: 1.5rem;
            background-color: var(--real-grey);
            opacity: 0.2;
            margin-top: 1rem;
            border-radius: 15px;
            width: 30%;
        }
        
        @keyframes pulse {
            0% {
                opacity: 0.6;
            }
            50% {
                opacity: 0.8;
            }
            100% {
                opacity: 0.6;
            }
        }
        
        /* Make cards clickable */
        .offre-card {
            cursor: pointer;
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
        return "home/index.html.twig";
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
        return array (  281 => 187,  274 => 186,  194 => 109,  179 => 96,  127 => 46,  125 => 45,  114 => 38,  107 => 37,  73 => 6,  66 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Accueil - {{ parent() }}{% endblock %}

{% block content %}
    <!-- Main Content -->
    <div class=\"main-content\">
        <section class=\"contact-section\">
            <h2>Nouvelles des contacts</h2>
            <div class=\"updates-container\" id=\"updates-container\">
                <div class=\"update-card loading-placeholder\">
                    <div class=\"placeholder-content\">
                        <div class=\"placeholder-header\"></div>
                        <div class=\"placeholder-text\"></div>
                        <div class=\"placeholder-tag\"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class=\"offres-section\">
            <h2>Offres pour vous</h2>
            <div class=\"offres-container\" id=\"offres-container\">
                <div class=\"offre-card loading-placeholder\">
                    <div class=\"placeholder-content\">
                        <div class=\"placeholder-header\"></div>
                        <div class=\"placeholder-text\"></div>
                        <div class=\"placeholder-text\"></div>
                        <div class=\"placeholder-tag\"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            try {
                // Fetch updates
                const updatesContainer = document.getElementById('updates-container');
                
                {% if request.isAuthenticated() %}
                    try {
                        const updatesResponse = await fetch('/API/latestupdates');
                        const updatesData = await updatesResponse.json();
                        
                        if (updatesData.success && updatesData.updates && updatesData.updates.length > 0) {
                            // Clear loading placeholders
                            updatesContainer.innerHTML = '';
                            
                            // Add updates
                            updatesData.updates.forEach(update => {
                                const updateCard = document.createElement('div');
                                updateCard.className = 'update-card';
                                updateCard.innerHTML = `
                                    <div class=\"update-header\">
                                        <h3>\${update.title} - \${update.company}</h3>
                                        <span class=\"update-time\">\${update.timestamp}</span>
                                    </div>
                                    <p>\${update.status === 'Accepté' ? 'Votre candidature a été acceptée' : 
                                        update.status === 'Refusé' ? 'Votre candidature a été refusée' :
                                        update.status === 'Entretien' ? `Entretien prévu le \${update.followupInterviewDate}` :
                                        'Votre candidature est en cours d\\'examen'}</p>
                                    <div class=\"tags\">
                                        <span class=\"\${update.statusClass}\">\${update.status}</span>
                                    </div>
                                `;
                                updatesContainer.appendChild(updateCard);
                            });
                        } else {
                            // No updates or error
                            updatesContainer.innerHTML = `
                                <div class=\"update-card\">
                                    <div class=\"update-header\">
                                        <h3>Aucune mise à jour</h3>
                                    </div>
                                    <p>Vous n'avez pas encore de candidatures en cours.</p>
                                </div>
                            `;
                        }
                    } catch (error) {
                        console.error('Error fetching updates:', error);
                        updatesContainer.innerHTML = `
                            <div class=\"update-card\">
                                <div class=\"update-header\">
                                    <h3>Erreur</h3>
                                </div>
                                <p>Impossible de charger les mises à jour des contacts.</p>
                            </div>
                        `;
                    }
                {% else %}
                    // Not authenticated
                    updatesContainer.innerHTML = `
                        <div class=\"update-card\">
                            <div class=\"update-header\">
                                <h3>Connexion requise</h3>
                            </div>
                            <p>Connectez-vous pour voir vos mises à jour.</p>
                            <div class=\"tags\">
                                <a href=\"/login\" class=\"tag\" style=\"text-decoration: none;\">Se connecter</a>
                            </div>
                        </div>
                    `;
                {% endif %}
                
                // Fetch offers
                const offresContainer = document.getElementById('offres-container');
                
                try {
                    const offersResponse = await fetch('/API/favoffers');
                    const offersData = await offersResponse.json();
                    
                    if (offersData.success && offersData.offers && offersData.offers.length > 0) {
                        // Clear loading placeholders
                        offresContainer.innerHTML = '';
                        
                        // Add offers
                        offersData.offers.forEach(offer => {
                            const offerCard = document.createElement('div');
                            offerCard.className = `offre-card\${offer.highlighted ? ' highlighted' : ''}`;
                            offerCard.dataset.id = offer.reference;
                            
                            // Generate tags HTML
                            const tagsHTML = offer.tags.map(tag => 
                                `<span class=\"\${tag.optional ? 'tag_optional' : 'tag'}\">\${tag.name}</span>`
                            ).join(' ');
                            
                            offerCard.innerHTML = `
                                <div class=\"job-details\">
                                    <h3>\${offer.title}</h3>
                                    <p class=\"reference\">\${offer.company} | \${offer.location} | Réf. \${offer.reference}</p>
                                    <div class=\"tags\">
                                        <span class=\"tag\">\${offer.duration}</span>
                                        <span class=\"tag\">\${offer.level}</span>
                                        \${tagsHTML}
                                    </div>
                                </div>
                                <p>Commence le : \${offer.startDate}</p>
                                <p class=\"\${offer.remuneration === 0 ? 'remuneration_negative' : 'remuneration'}\">
                                    \${offer.remuneration === 0 ? 'Non Rémunéré' : 'Rémunéré'}
                                </p>
                                \${offer.highlighted ? '<p class=\"tag_star\">Candidat star !</p>' : ''}
                                \${offer.wishlisted ? '<p class=\"wishlist-badge\">Dans votre wishlist</p>' : ''}
                            `;
                            
                            // Add click event to navigate to offer details
                            offerCard.addEventListener('click', () => {
                                window.location.href = `/offres/\${offer.reference}`;
                            });
                            
                            offresContainer.appendChild(offerCard);
                        });
                    } else {
                        // No offers or error
                        offresContainer.innerHTML = `
                            <div class=\"offre-card\">
                                <div class=\"job-details\">
                                    <h3>Aucune offre disponible</h3>
                                </div>
                                <p>Aucune offre ne correspond à votre profil pour le moment.</p>
                            </div>
                        `;
                    }
                } catch (error) {
                    console.error('Error fetching offers:', error);
                    offresContainer.innerHTML = `
                        <div class=\"offre-card\">
                            <div class=\"job-details\">
                                <h3>Erreur</h3>
                            </div>
                            <p>Impossible de charger les offres recommandées.</p>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('General error:', error);
            }
        });
    </script>
{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        /* Loading placeholders */
        .loading-placeholder {
            animation: pulse 1.5s infinite;
            background-color: var(--background-nav);
        }
        
        .placeholder-content {
            padding: 1rem;
        }
        
        .placeholder-header {
            height: 1.5rem;
            background-color: var(--real-grey);
            opacity: 0.2;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
        
        .placeholder-text {
            height: 1rem;
            background-color: var(--real-grey);
            opacity: 0.2;
            margin-bottom: 0.5rem;
            border-radius: 4px;
            width: 80%;
        }
        
        .placeholder-tag {
            height: 1.5rem;
            background-color: var(--real-grey);
            opacity: 0.2;
            margin-top: 1rem;
            border-radius: 15px;
            width: 30%;
        }
        
        @keyframes pulse {
            0% {
                opacity: 0.6;
            }
            50% {
                opacity: 0.8;
            }
            100% {
                opacity: 0.6;
            }
        }
        
        /* Make cards clickable */
        .offre-card {
            cursor: pointer;
        }
    </style>
{% endblock %}", "home/index.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\home\\index.html.twig");
    }
}
