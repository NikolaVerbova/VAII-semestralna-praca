<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Úvodná stránka – zobrazí pohľad App/Views/Home/index.view.php
 */
class HomeController extends BaseController
{
    public function index(Request $request): Response
    {
        return $this->html();
    }
}
