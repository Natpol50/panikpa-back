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

/* partials/cookies.html.twig */
class __TwigTemplate_4878daee2b1ad480c835d9cfbbd24cb9 extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<div class=\"cookie-banner\" id=\"cookieBanner\">
    <div class=\"cookie-content\">
        <div class=\"cookie-text\">
            <h2>Vos préférences en matière de cookies</h2>
            <p>
                Nous utilisons des cookies pour améliorer votre expérience sur notre site.
                Certains sont nécessaires au fonctionnement du site, tandis que d'autres nous
                permettent d'analyser son utilisation et de personnaliser nos services.
            </p>
        </div>
        <div class=\"cookie-actions\">
            <button class=\"cookie-btn accept\" onclick=\"acceptAllCookies()\">Tout accepter</button>
            <button class=\"cookie-btn customize\" onclick=\"openCookieSettings()\">Personnaliser</button>
            <button class=\"cookie-btn reject\" onclick=\"rejectNonEssentialCookies()\">Tout refuser</button>
        </div>
    </div>
</div>

<!-- Modal des paramètres de cookies -->
<div class=\"cookie-settings-modal\" id=\"cookieSettings\">
    <div class=\"modal-content\">
        <div class=\"modal-header\">
            <h2>Paramètres des cookies</h2>
            <button class=\"close-modal\" onclick=\"closeCookieSettings()\">&times;</button>
        </div>
        <div class=\"modal-body\">
            <div class=\"cookie-category\">
                <div class=\"category-header\">
                    <div>
                        <h3>Cookies nécessaires</h3>
                        <p>Ces cookies sont indispensables au fonctionnement du site.</p>
                    </div>
                    <label class=\"switch\">
                        <input type=\"checkbox\" checked disabled>
                        <span class=\"slider\"></span>
                    </label>
                </div>
            </div>

            <div class=\"cookie-category\">
                <div class=\"category-header\">
                    <div>
                        <h3>Cookies analytiques</h3>
                        <p>Nous aident à comprendre comment vous utilisez notre site.</p>
                    </div>
                    <label class=\"switch\">
                        <input type=\"checkbox\" id=\"analyticsCookies\">
                        <span class=\"slider\"></span>
                    </label>
                </div>
            </div>

            <div class=\"cookie-category\">
                <div class=\"category-header\">
                    <div>
                        <h3>Cookies de marketing</h3>
                        <p>Permettent d'afficher des publicités pertinentes.</p>
                    </div>
                    <label class=\"switch\">
                        <input type=\"checkbox\" id=\"marketingCookies\">
                        <span class=\"slider\"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class=\"modal-footer\">
            <button class=\"cookie-btn save\" onclick=\"saveCookiePreferences()\">Enregistrer mes choix</button>
        </div>
    </div>
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partials/cookies.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"cookie-banner\" id=\"cookieBanner\">
    <div class=\"cookie-content\">
        <div class=\"cookie-text\">
            <h2>Vos préférences en matière de cookies</h2>
            <p>
                Nous utilisons des cookies pour améliorer votre expérience sur notre site.
                Certains sont nécessaires au fonctionnement du site, tandis que d'autres nous
                permettent d'analyser son utilisation et de personnaliser nos services.
            </p>
        </div>
        <div class=\"cookie-actions\">
            <button class=\"cookie-btn accept\" onclick=\"acceptAllCookies()\">Tout accepter</button>
            <button class=\"cookie-btn customize\" onclick=\"openCookieSettings()\">Personnaliser</button>
            <button class=\"cookie-btn reject\" onclick=\"rejectNonEssentialCookies()\">Tout refuser</button>
        </div>
    </div>
</div>

<!-- Modal des paramètres de cookies -->
<div class=\"cookie-settings-modal\" id=\"cookieSettings\">
    <div class=\"modal-content\">
        <div class=\"modal-header\">
            <h2>Paramètres des cookies</h2>
            <button class=\"close-modal\" onclick=\"closeCookieSettings()\">&times;</button>
        </div>
        <div class=\"modal-body\">
            <div class=\"cookie-category\">
                <div class=\"category-header\">
                    <div>
                        <h3>Cookies nécessaires</h3>
                        <p>Ces cookies sont indispensables au fonctionnement du site.</p>
                    </div>
                    <label class=\"switch\">
                        <input type=\"checkbox\" checked disabled>
                        <span class=\"slider\"></span>
                    </label>
                </div>
            </div>

            <div class=\"cookie-category\">
                <div class=\"category-header\">
                    <div>
                        <h3>Cookies analytiques</h3>
                        <p>Nous aident à comprendre comment vous utilisez notre site.</p>
                    </div>
                    <label class=\"switch\">
                        <input type=\"checkbox\" id=\"analyticsCookies\">
                        <span class=\"slider\"></span>
                    </label>
                </div>
            </div>

            <div class=\"cookie-category\">
                <div class=\"category-header\">
                    <div>
                        <h3>Cookies de marketing</h3>
                        <p>Permettent d'afficher des publicités pertinentes.</p>
                    </div>
                    <label class=\"switch\">
                        <input type=\"checkbox\" id=\"marketingCookies\">
                        <span class=\"slider\"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class=\"modal-footer\">
            <button class=\"cookie-btn save\" onclick=\"saveCookiePreferences()\">Enregistrer mes choix</button>
        </div>
    </div>
</div>", "partials/cookies.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\partials\\cookies.html.twig");
    }
}
