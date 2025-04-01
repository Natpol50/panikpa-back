<?php

namespace App\Controllers;

use App\Core\RequestObject;

class AssetController extends BaseController
{
    /**
     * Redirect to the favicon
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function favicon(RequestObject $request): void
    {
        header('Location: /assets/img/PANIKPA.ico');
        exit;
    }
}