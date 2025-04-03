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

/* enterprises/index.html.twig */
class __TwigTemplate_adebeaaad231cccffcb16621bd70bec2 extends Template
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
            'breadcrumb' => [$this, 'block_breadcrumb'],
            'content' => [$this, 'block_content'],
            'stylesheets' => [$this, 'block_stylesheets'],
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
        $this->parent = $this->loadTemplate("base.html.twig", "enterprises/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Entreprises - ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield from [];
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumb(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "<nav class=\"breadcrumb\">
    <span><a href=\"/\">Accueil</a></span>
    <span>Entreprises</span>
</nav>
";
        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 10
        yield "<div class=\"enterprises-container\">
    <div class=\"page-header\">
        <h1>Entreprises partenaires</h1>
        ";
        // line 13
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "isAuthenticated", [], "method", false, false, false, 13) && CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_company_creation"], "method", false, false, false, 13))) {
            // line 14
            yield "        <a href=\"/entreprises/create\" class=\"btn-add-enterprise\">
            <svg viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                <path d=\"M12 2v20m10-10H2\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
            </svg>
            Ajouter une entreprise
        </a>
        ";
        }
        // line 21
        yield "    </div>
    
    <div class=\"search-section\">
        <div class=\"form-row\">
            <div class=\"form-section\">
                <label for=\"search-query\">Rechercher une entreprise</label>
                <input type=\"text\" id=\"search-query\" placeholder=\"Nom d'entreprise, email...\" value=\"\">
            </div>
            <button type=\"button\" id=\"search-button\" class=\"btn-search\">Rechercher</button>
        </div>
    </div>

    <!-- Loading state -->
    <div id=\"loading-state\" class=\"loading-container\">
        <div class=\"spinner\"></div>
        <p>Chargement des entreprises...</p>
    </div>

    <!-- Error state -->
    <div id=\"error-state\" class=\"error-container\" style=\"display: none;\">
        <svg viewBox=\"0 0 24 24\" width=\"64\" height=\"64\">
            <path d=\"M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
        </svg>
        <h2>Erreur de chargement</h2>
        <p id=\"error-message\">Une erreur est survenue lors du chargement des entreprises.</p>
        <button id=\"retry-button\" class=\"btn-primary\">Réessayer</button>
    </div>

    <!-- Empty state -->
    <div id=\"empty-state\" class=\"empty-state\" style=\"display: none;\">
        <svg viewBox=\"0 0 24 24\" width=\"64\" height=\"64\">
            <path d=\"M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
        </svg>
        <h2>Aucune entreprise trouvée</h2>
        <p>Il n'y a pas d'entreprises correspondant à vos critères de recherche.</p>
        ";
        // line 56
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "isAuthenticated", [], "method", false, false, false, 56) && CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_company_creation"], "method", false, false, false, 56))) {
            // line 57
            yield "            <a href=\"/entreprises/create\" class=\"btn-add-enterprise-alt\">Ajouter une nouvelle entreprise</a>
        ";
        }
        // line 59
        yield "    </div>

    <!-- Enterprises grid -->
    <div id=\"enterprises-grid\" class=\"enterprises-grid\" style=\"display: none;\"></div>

    <!-- Pagination -->
    <div id=\"pagination\" class=\"pagination\" style=\"display: none;\">
        <div class=\"pagination-controls\">
            <button id=\"prev-page\" class=\"pagination-button\" disabled>Précédent</button>
            <span id=\"page-info\" class=\"page-info\">Page 1 sur 1</span>
            <button id=\"next-page\" class=\"pagination-button\" disabled>Suivant</button>
        </div>
    </div>
</div>
";
        yield from [];
    }

    // line 75
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 76
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
<style>
.enterprises-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.btn-add-enterprise {
    display: flex;
    align-items: center;
    background-color: var(--primary-color);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    text-decoration: none;
    gap: 0.5rem;
    
}

.enterprises-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.enterprise-card {
    background-color: var(--background-nav);
    border-radius: 8px;
    box-shadow: 0 2px 4px var(--shadow-color);
    padding: 1.5rem;
    transition: transform 0.3s ease;
}

.enterprise-card:hover {
    transform: translateY(-5px);
}

.card-header {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.enterprise-logo {
    width: 80px; /* We can keep this smaller for better layout */
    height: auto; /* Let height adjust based on image proportions */
    max-height: 80px; /* Limit maximum height */
    border-radius: 8px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--tag-background);
}

.enterprise-logo img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain; /* 'contain' preserves aspect ratio without cropping */
}

.placeholder-logo {
    font-size: 2rem;
    color: var(--primary-color);
}

.enterprise-details h2 {
    margin-bottom: 0.5rem;
    color: var(--primary-color);
}

.enterprise-contact, .enterprise-phone {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--real-grey);
    margin-bottom: 0.25rem;
}

.card-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.btn-view, .btn-edit {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    text-decoration: none;
    text-align: center;
    font-weight: bold;
}

.btn-view {
    background-color: var(--tag-background);
    color: var(--primary-color);
}

.btn-edit {
    background-color: var(--secondary-color);
    color: var(--secondary-text);
}

.empty-state, .error-container, .loading-container {
    text-align: center;
    padding: 3rem;
    background-color: var(--background-nav);
    border-radius: 8px;
    box-shadow: 0 2px 4px var(--shadow-color);
}

.empty-state svg, .error-container svg {
    color: var(--realsecondary-color);
    opacity: 0.5;
    margin-bottom: 1rem;
}

.btn-add-enterprise-alt {
    display: inline-block;
    margin-top: 1rem;
    background-color: var(--primary-color);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    text-decoration: none;
}

.btn-primary {
    display: inline-block;
    background-color: var(--primary-color);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    cursor: pointer;
    border: none;
    font-weight: bold;
    margin-top: 1rem;
}

.pagination {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

.pagination-controls {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.page-info {
    color: var(--real-grey);
}

.pagination-prev, .pagination-next {
    padding: 0.5rem 1rem;
    background-color: var(--tag-background);
    color: var(--primary-color);
    text-decoration: none;
    border-radius: 4px;
    border: none;
    font-weight: bold;
    cursor: pointer;
}

.pagination-prev:disabled, .pagination-next:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Loading spinner */
.spinner {
    width: 40px;
    height: 40px;
    margin: 0 auto 1rem;
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    border-top: 4px solid var(--primary-color);
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.search-section {
    margin-bottom: 2rem;
}

#search-query {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid var(--real-grey);
    border-radius: 4px;
    background-color: white;
    font-size: 1rem;
}

.btn-search {
    background-color: var(--primary-color);
    border: none;
    color: white;
    padding: 0.5rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    text-decoration: none;
    height: 50%;
    bottom: 0px;
    margin-top: 2.25rem;
}

/* Responsive fixes */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .btn-add-enterprise {
        width: 100%;
        justify-content: center;
    }
    
    .form-row {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-search {
        width: 100%;
        height: 100%
    }
}
</style>
";
        yield from [];
    }

    // line 327
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 328
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
<script>
document.addEventListener('DOMContentLoaded', () => {
    // DOM elements
    const searchQueryInput = document.getElementById('search-query');
    const searchButton = document.getElementById('search-button');
    const loadingState = document.getElementById('loading-state');
    const errorState = document.getElementById('error-state');
    const errorMessage = document.getElementById('error-message');
    const emptyState = document.getElementById('empty-state');
    const enterprisesGrid = document.getElementById('enterprises-grid');
    const pagination = document.getElementById('pagination');
    const prevPageButton = document.getElementById('prev-page');
    const nextPageButton = document.getElementById('next-page');
    const pageInfo = document.getElementById('page-info');
    const retryButton = document.getElementById('retry-button');
    
    // State variables
    let currentPage = 1;
    let totalPages = 1;
    let pageSize = 9;
    let currentQuery = '';
    
    // Check if user is authenticated with permission to modify
    const canModify = ";
        // line 352
        yield ((((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "isAuthenticated", [], "method", false, false, false, 352) && CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_modify_comp_info"], "method", false, false, false, 352)) && CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "hasPermission", ["perm_admin"], "method", false, false, false, 352))) ? ("true") : ("false"));
        yield ";
    
    // Fetch enterprises from API
    const fetchEnterprises = async (page = 1, query = '') => {
        showLoadingState();
        
        try {
            // Build API URL
            const url = `/API/entreprises?page=\${page}&pageSize=\${pageSize}&query=\${encodeURIComponent(query)}`;
            
            // Fetch data
            const response = await fetch(url);
            
            if (!response.ok) {
                throw new Error(`HTTP error! Status: \${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.success) {
                // Update state
                currentPage = data.pagination.currentPage;
                totalPages = data.pagination.totalPages;
                
                // Process data
                if (data.data && data.data.length > 0) {
                    renderEnterprises(data.data);
                    updatePagination();
                    showEnterprisesGrid();
                } else {
                    showEmptyState();
                }
            } else {
                throw new Error(data.message || 'An error occurred while fetching data');
            }
        } catch (error) {
            console.error('Error fetching enterprises:', error);
            showErrorState(error.message);
        }
    };
    
    // Render enterprises to the grid
    const renderEnterprises = (enterprises) => {
        // Clear the grid
        enterprisesGrid.innerHTML = '';
        
        // Create cards for each enterprise
        enterprises.forEach(enterprise => {
            const card = document.createElement('div');
            card.className = 'enterprise-card';
            
            // Determine logo content
            let logoContent = '';
            if (enterprise.enterprise_photo_url) {
                logoContent = `<img src=\"\${enterprise.enterprise_photo_url}\" alt=\"\${enterprise.enterprise_name}\">`;
            } else {
                logoContent = `<div class=\"placeholder-logo\">\${enterprise.enterprise_name.charAt(0).toUpperCase()}</div>`;
            }
            
            // Build card HTML
            card.innerHTML = `
                <div class=\"card-header\">
                    <div class=\"enterprise-logo\">
                        \${logoContent}
                    </div>
                    <div class=\"enterprise-details\">
                        <h2>\${enterprise.enterprise_name}</h2>
                        <p class=\"enterprise-contact\">
                            <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                <path d=\"M22 12h-4l-3 3-3-3H7\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                                <path d=\"M12 22l10-10M2 12l10 10M10 2l4 4-4 4\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                            </svg>
                            \${enterprise.enterprise_email}
                        </p>
                        <p class=\"enterprise-phone\">
                            <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                <path d=\"M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z\" />
                            </svg>
                            \${enterprise.enterprise_phone}
                        </p>
                    </div>
                </div>
                <div class=\"card-actions\">
                    <a href=\"/entreprises/\${enterprise.id_enterprise}\" class=\"btn-view\">Voir détails</a>
                    \${canModify ? `<a href=\"/entreprises/\${enterprise.id_enterprise}/edit\" class=\"btn-edit\">Modifier</a>` : ''}
                </div>
            `;
            
            // Add the card to the grid
            enterprisesGrid.appendChild(card);
        });
    };
    
    // Update pagination controls
    const updatePagination = () => {
        // Update page info text
        pageInfo.textContent = `Page \${currentPage} sur \${totalPages}`;
        
        // Update button states
        prevPageButton.disabled = currentPage <= 1;
        nextPageButton.disabled = currentPage >= totalPages;
        
        // Show pagination if there are multiple pages
        pagination.style.display = totalPages > 1 ? 'flex' : 'none';
    };
    
    // Show/hide UI states
    const showLoadingState = () => {
        loadingState.style.display = 'block';
        errorState.style.display = 'none';
        emptyState.style.display = 'none';
        enterprisesGrid.style.display = 'none';
        pagination.style.display = 'none';
    };
    
    const showErrorState = (message = 'Une erreur est survenue lors du chargement des entreprises.') => {
        loadingState.style.display = 'none';
        errorState.style.display = 'block';
        errorMessage.textContent = message;
        emptyState.style.display = 'none';
        enterprisesGrid.style.display = 'none';
        pagination.style.display = 'none';
    };
    
    const showEmptyState = () => {
        loadingState.style.display = 'none';
        errorState.style.display = 'none';
        emptyState.style.display = 'block';
        enterprisesGrid.style.display = 'none';
        pagination.style.display = 'none';
    };
    
    const showEnterprisesGrid = () => {
        loadingState.style.display = 'none';
        errorState.style.display = 'none';
        emptyState.style.display = 'none';
        enterprisesGrid.style.display = 'grid';
    };
    
    // Event listeners
    searchButton.addEventListener('click', () => {
        currentPage = 1;
        currentQuery = searchQueryInput.value.trim();
        fetchEnterprises(currentPage, currentQuery);
    });
    
    searchQueryInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            currentPage = 1;
            currentQuery = searchQueryInput.value.trim();
            fetchEnterprises(currentPage, currentQuery);
        }
    });
    
    prevPageButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            fetchEnterprises(currentPage, currentQuery);
        }
    });
    
    nextPageButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            fetchEnterprises(currentPage, currentQuery);
        }
    });
    
    retryButton.addEventListener('click', () => {
        fetchEnterprises(currentPage, currentQuery);
    });
    
    // Initial fetch
    fetchEnterprises();
});
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "enterprises/index.html.twig";
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
        return array (  464 => 352,  437 => 328,  430 => 327,  175 => 76,  168 => 75,  149 => 59,  145 => 57,  143 => 56,  106 => 21,  97 => 14,  95 => 13,  90 => 10,  83 => 9,  74 => 4,  67 => 3,  55 => 2,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Entreprises - {{ parent() }}{% endblock %}
{% block breadcrumb %}
<nav class=\"breadcrumb\">
    <span><a href=\"/\">Accueil</a></span>
    <span>Entreprises</span>
</nav>
{% endblock %}
{% block content %}
<div class=\"enterprises-container\">
    <div class=\"page-header\">
        <h1>Entreprises partenaires</h1>
        {% if request.isAuthenticated() and request.hasPermission('perm_company_creation') %}
        <a href=\"/entreprises/create\" class=\"btn-add-enterprise\">
            <svg viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                <path d=\"M12 2v20m10-10H2\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
            </svg>
            Ajouter une entreprise
        </a>
        {% endif %}
    </div>
    
    <div class=\"search-section\">
        <div class=\"form-row\">
            <div class=\"form-section\">
                <label for=\"search-query\">Rechercher une entreprise</label>
                <input type=\"text\" id=\"search-query\" placeholder=\"Nom d'entreprise, email...\" value=\"\">
            </div>
            <button type=\"button\" id=\"search-button\" class=\"btn-search\">Rechercher</button>
        </div>
    </div>

    <!-- Loading state -->
    <div id=\"loading-state\" class=\"loading-container\">
        <div class=\"spinner\"></div>
        <p>Chargement des entreprises...</p>
    </div>

    <!-- Error state -->
    <div id=\"error-state\" class=\"error-container\" style=\"display: none;\">
        <svg viewBox=\"0 0 24 24\" width=\"64\" height=\"64\">
            <path d=\"M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
        </svg>
        <h2>Erreur de chargement</h2>
        <p id=\"error-message\">Une erreur est survenue lors du chargement des entreprises.</p>
        <button id=\"retry-button\" class=\"btn-primary\">Réessayer</button>
    </div>

    <!-- Empty state -->
    <div id=\"empty-state\" class=\"empty-state\" style=\"display: none;\">
        <svg viewBox=\"0 0 24 24\" width=\"64\" height=\"64\">
            <path d=\"M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
        </svg>
        <h2>Aucune entreprise trouvée</h2>
        <p>Il n'y a pas d'entreprises correspondant à vos critères de recherche.</p>
        {% if request.isAuthenticated() and request.hasPermission('perm_company_creation') %}
            <a href=\"/entreprises/create\" class=\"btn-add-enterprise-alt\">Ajouter une nouvelle entreprise</a>
        {% endif %}
    </div>

    <!-- Enterprises grid -->
    <div id=\"enterprises-grid\" class=\"enterprises-grid\" style=\"display: none;\"></div>

    <!-- Pagination -->
    <div id=\"pagination\" class=\"pagination\" style=\"display: none;\">
        <div class=\"pagination-controls\">
            <button id=\"prev-page\" class=\"pagination-button\" disabled>Précédent</button>
            <span id=\"page-info\" class=\"page-info\">Page 1 sur 1</span>
            <button id=\"next-page\" class=\"pagination-button\" disabled>Suivant</button>
        </div>
    </div>
</div>
{% endblock %}

{% block stylesheets %}
{{ parent() }}
<style>
.enterprises-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.btn-add-enterprise {
    display: flex;
    align-items: center;
    background-color: var(--primary-color);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    text-decoration: none;
    gap: 0.5rem;
    
}

.enterprises-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.enterprise-card {
    background-color: var(--background-nav);
    border-radius: 8px;
    box-shadow: 0 2px 4px var(--shadow-color);
    padding: 1.5rem;
    transition: transform 0.3s ease;
}

.enterprise-card:hover {
    transform: translateY(-5px);
}

.card-header {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.enterprise-logo {
    width: 80px; /* We can keep this smaller for better layout */
    height: auto; /* Let height adjust based on image proportions */
    max-height: 80px; /* Limit maximum height */
    border-radius: 8px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--tag-background);
}

.enterprise-logo img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain; /* 'contain' preserves aspect ratio without cropping */
}

.placeholder-logo {
    font-size: 2rem;
    color: var(--primary-color);
}

.enterprise-details h2 {
    margin-bottom: 0.5rem;
    color: var(--primary-color);
}

.enterprise-contact, .enterprise-phone {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--real-grey);
    margin-bottom: 0.25rem;
}

.card-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.btn-view, .btn-edit {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    text-decoration: none;
    text-align: center;
    font-weight: bold;
}

.btn-view {
    background-color: var(--tag-background);
    color: var(--primary-color);
}

.btn-edit {
    background-color: var(--secondary-color);
    color: var(--secondary-text);
}

.empty-state, .error-container, .loading-container {
    text-align: center;
    padding: 3rem;
    background-color: var(--background-nav);
    border-radius: 8px;
    box-shadow: 0 2px 4px var(--shadow-color);
}

.empty-state svg, .error-container svg {
    color: var(--realsecondary-color);
    opacity: 0.5;
    margin-bottom: 1rem;
}

.btn-add-enterprise-alt {
    display: inline-block;
    margin-top: 1rem;
    background-color: var(--primary-color);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    text-decoration: none;
}

.btn-primary {
    display: inline-block;
    background-color: var(--primary-color);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    cursor: pointer;
    border: none;
    font-weight: bold;
    margin-top: 1rem;
}

.pagination {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

.pagination-controls {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.page-info {
    color: var(--real-grey);
}

.pagination-prev, .pagination-next {
    padding: 0.5rem 1rem;
    background-color: var(--tag-background);
    color: var(--primary-color);
    text-decoration: none;
    border-radius: 4px;
    border: none;
    font-weight: bold;
    cursor: pointer;
}

.pagination-prev:disabled, .pagination-next:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Loading spinner */
.spinner {
    width: 40px;
    height: 40px;
    margin: 0 auto 1rem;
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    border-top: 4px solid var(--primary-color);
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.search-section {
    margin-bottom: 2rem;
}

#search-query {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid var(--real-grey);
    border-radius: 4px;
    background-color: white;
    font-size: 1rem;
}

.btn-search {
    background-color: var(--primary-color);
    border: none;
    color: white;
    padding: 0.5rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    text-decoration: none;
    height: 50%;
    bottom: 0px;
    margin-top: 2.25rem;
}

/* Responsive fixes */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .btn-add-enterprise {
        width: 100%;
        justify-content: center;
    }
    
    .form-row {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-search {
        width: 100%;
        height: 100%
    }
}
</style>
{% endblock %}

{% block javascripts %}
{{ parent() }}
<script>
document.addEventListener('DOMContentLoaded', () => {
    // DOM elements
    const searchQueryInput = document.getElementById('search-query');
    const searchButton = document.getElementById('search-button');
    const loadingState = document.getElementById('loading-state');
    const errorState = document.getElementById('error-state');
    const errorMessage = document.getElementById('error-message');
    const emptyState = document.getElementById('empty-state');
    const enterprisesGrid = document.getElementById('enterprises-grid');
    const pagination = document.getElementById('pagination');
    const prevPageButton = document.getElementById('prev-page');
    const nextPageButton = document.getElementById('next-page');
    const pageInfo = document.getElementById('page-info');
    const retryButton = document.getElementById('retry-button');
    
    // State variables
    let currentPage = 1;
    let totalPages = 1;
    let pageSize = 9;
    let currentQuery = '';
    
    // Check if user is authenticated with permission to modify
    const canModify = {{ request.isAuthenticated() and request.hasPermission('perm_modify_comp_info') and request.hasPermission('perm_admin') ? 'true' : 'false' }};
    
    // Fetch enterprises from API
    const fetchEnterprises = async (page = 1, query = '') => {
        showLoadingState();
        
        try {
            // Build API URL
            const url = `/API/entreprises?page=\${page}&pageSize=\${pageSize}&query=\${encodeURIComponent(query)}`;
            
            // Fetch data
            const response = await fetch(url);
            
            if (!response.ok) {
                throw new Error(`HTTP error! Status: \${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.success) {
                // Update state
                currentPage = data.pagination.currentPage;
                totalPages = data.pagination.totalPages;
                
                // Process data
                if (data.data && data.data.length > 0) {
                    renderEnterprises(data.data);
                    updatePagination();
                    showEnterprisesGrid();
                } else {
                    showEmptyState();
                }
            } else {
                throw new Error(data.message || 'An error occurred while fetching data');
            }
        } catch (error) {
            console.error('Error fetching enterprises:', error);
            showErrorState(error.message);
        }
    };
    
    // Render enterprises to the grid
    const renderEnterprises = (enterprises) => {
        // Clear the grid
        enterprisesGrid.innerHTML = '';
        
        // Create cards for each enterprise
        enterprises.forEach(enterprise => {
            const card = document.createElement('div');
            card.className = 'enterprise-card';
            
            // Determine logo content
            let logoContent = '';
            if (enterprise.enterprise_photo_url) {
                logoContent = `<img src=\"\${enterprise.enterprise_photo_url}\" alt=\"\${enterprise.enterprise_name}\">`;
            } else {
                logoContent = `<div class=\"placeholder-logo\">\${enterprise.enterprise_name.charAt(0).toUpperCase()}</div>`;
            }
            
            // Build card HTML
            card.innerHTML = `
                <div class=\"card-header\">
                    <div class=\"enterprise-logo\">
                        \${logoContent}
                    </div>
                    <div class=\"enterprise-details\">
                        <h2>\${enterprise.enterprise_name}</h2>
                        <p class=\"enterprise-contact\">
                            <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                <path d=\"M22 12h-4l-3 3-3-3H7\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                                <path d=\"M12 22l10-10M2 12l10 10M10 2l4 4-4 4\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"/>
                            </svg>
                            \${enterprise.enterprise_email}
                        </p>
                        <p class=\"enterprise-phone\">
                            <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\">
                                <path d=\"M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z\" />
                            </svg>
                            \${enterprise.enterprise_phone}
                        </p>
                    </div>
                </div>
                <div class=\"card-actions\">
                    <a href=\"/entreprises/\${enterprise.id_enterprise}\" class=\"btn-view\">Voir détails</a>
                    \${canModify ? `<a href=\"/entreprises/\${enterprise.id_enterprise}/edit\" class=\"btn-edit\">Modifier</a>` : ''}
                </div>
            `;
            
            // Add the card to the grid
            enterprisesGrid.appendChild(card);
        });
    };
    
    // Update pagination controls
    const updatePagination = () => {
        // Update page info text
        pageInfo.textContent = `Page \${currentPage} sur \${totalPages}`;
        
        // Update button states
        prevPageButton.disabled = currentPage <= 1;
        nextPageButton.disabled = currentPage >= totalPages;
        
        // Show pagination if there are multiple pages
        pagination.style.display = totalPages > 1 ? 'flex' : 'none';
    };
    
    // Show/hide UI states
    const showLoadingState = () => {
        loadingState.style.display = 'block';
        errorState.style.display = 'none';
        emptyState.style.display = 'none';
        enterprisesGrid.style.display = 'none';
        pagination.style.display = 'none';
    };
    
    const showErrorState = (message = 'Une erreur est survenue lors du chargement des entreprises.') => {
        loadingState.style.display = 'none';
        errorState.style.display = 'block';
        errorMessage.textContent = message;
        emptyState.style.display = 'none';
        enterprisesGrid.style.display = 'none';
        pagination.style.display = 'none';
    };
    
    const showEmptyState = () => {
        loadingState.style.display = 'none';
        errorState.style.display = 'none';
        emptyState.style.display = 'block';
        enterprisesGrid.style.display = 'none';
        pagination.style.display = 'none';
    };
    
    const showEnterprisesGrid = () => {
        loadingState.style.display = 'none';
        errorState.style.display = 'none';
        emptyState.style.display = 'none';
        enterprisesGrid.style.display = 'grid';
    };
    
    // Event listeners
    searchButton.addEventListener('click', () => {
        currentPage = 1;
        currentQuery = searchQueryInput.value.trim();
        fetchEnterprises(currentPage, currentQuery);
    });
    
    searchQueryInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            currentPage = 1;
            currentQuery = searchQueryInput.value.trim();
            fetchEnterprises(currentPage, currentQuery);
        }
    });
    
    prevPageButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            fetchEnterprises(currentPage, currentQuery);
        }
    });
    
    nextPageButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            fetchEnterprises(currentPage, currentQuery);
        }
    });
    
    retryButton.addEventListener('click', () => {
        fetchEnterprises(currentPage, currentQuery);
    });
    
    // Initial fetch
    fetchEnterprises();
});
</script>
{% endblock %}", "enterprises/index.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\enterprises\\index.html.twig");
    }
}
