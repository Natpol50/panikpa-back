<?php

namespace App\Controllers;

use App\Services\Database;
use App\Core\RequestObject;

/**
 * StaticController - Handles cookies-related actions and static pages
 */
class StaticController extends BaseController
{ 
    public ?bool $cookie = null;
    private Database $database;

    /**
     * Create a new StaticController instance
     */
    public function __construct()
    {
        // Initialize database connection
        $this->database = new Database();
    }

    public function showCookiesPage(RequestObject $request)
    {
        echo $this->render('cookies');
    }
    
    public function acceptCookies(RequestObject $request)
    {
        setcookie("cookieAccepted", "true", time() + (365*24*60*60),"/");
        $this->cookie = true;

        header("Content-Type: application/json");
        echo json_encode(['message'=>'Cookies acceptés !'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function declineCookies(RequestObject $request)
    {
        setcookie("cookieAccepted", "", time() - 3600, "/");
        $this->cookie = false;

        header("Content-Type: application/json");
        echo json_encode(['message'=>'Cookies refusés !'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function checkCookiesStatus(RequestObject $request)
    {
        $statusCookie = $_COOKIE['cookieAccepted'] ?? null;
        $cookieAccepted = ($statusCookie === "true") ? true : (($statusCookie === "false") ? false : null);

        header('Content-Type: application/json');
        echo json_encode(['cookieAccepted'=> $cookieAccepted], JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function showCguPage(RequestObject $request)
    {
        echo $this->render('static/cgu');
    }

    public function showOurTeamPage(RequestObject $request)
    {
        echo $this->render('static/ourTeam');
    }

    public function showRgpdPage(RequestObject $request)
    {
        echo $this->render('static/RGPD');
    }

    public function showWhoAreWePage(RequestObject $request)
    {
        echo $this->render('static/whoareWe');
    }
}